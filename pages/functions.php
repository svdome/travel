<?php

// Реализация функции подключения к БД
function connect(
    $host = 'localhost',
    $user = 'root',
    $pass = 'root',
    $dbname = 'travels'
) {
    $link = mysqli_connect($host, $user, $pass) or die('connection error');
    mysqli_select_db($link, $dbname) or die('DB open error');
    mysqli_query($link, "set names 'utf8'");
    return $link;
}

// Реализация функции регистрации.
function register($login, $pass, $email)
{
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));

    if ($login == "" || $pass == "" || $email == "") {
        echo "<h3><span style='color: red;'>Fill all required fields!</span></h3>";
        return false;
    }

    if (strlen($login) < 3 || strlen($login) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo "<h3><span style='color: red;'>Values length must be between 3 and 30</span></h3>";
        return false;
    }

    // Добавление регистрационных данных в БД.
    $queryInsertUser = 'insert into users (login, pass, email, roleid) values ("' . $login . '", "' . md5($pass) . '", "' . $email . '", 2)';
    $link = connect();
    mysqli_query($link, $queryInsertUser);
    $error = mysqli_errno($link);
    if ($error) {
        if ($error == 1062) {
            echo "<h3><span style='color: red;'>This login is already taken!</span></h3";
        } else {
            echo "<h3><span style='color: red;'>Error code: {$error}!</span></h3";
        }
        return false;
    }
    return true;
}

// реализация функции аутентификации
function login($log, $pass)
{
    $log = trim(htmlspecialchars($log));
    $pass = trim(htmlspecialchars($pass));

    if ($log == "" || $pass == "") {
        echo "<h3><span style='color: red;'>Fill all required fields!</span></h3>";
        return false;
    }
    if (strlen($log) < 3 || strlen($log) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo "<h3><span style='color: red;'>Values length must be between 3 and 30</span></h3>";
        return false;
    }
    $link = connect();
    $sel = 'SELECT * from users where login="' . $log . '" and pass="' . md5($pass) . '" ';
    $res = mysqli_query($link, $sel);
    if ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $_SESSION['ruser'] = $log;
        if ($row['roleid'] == 1) {
            $_SESSION['radmin'] = $log;
        }
        return true;
    } else {
        echo "<h3><span style='color: red;'>No such User!</span></h3>";
        return false;
    }
}
