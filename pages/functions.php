<?php

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

function register($login, $pass, $email)
{
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));

    if ($login == "" || $pass == "" || $email == "") {
        echo "<h3><span style= 'color: red;'>Fill all required fields!</span></h3>";
        return false;
    }

    if (strlen($login) < 3 || strlen($login) > 30) {
        echo "<h3><span style= 'color: red;'>";
        return false;
    }

    $queryInsertUser = 'insert into users (login, pass, email, roleid) values ("' . $login . '", "' . md5($pass) . '", "' . $email . '", 2)';
    $link = connect();
    mysqli_query($link, $queryInsertUser);
    $error = mysqli_errno($link);
    if ($error) {
        if ($error == 1062) {
            echo "<h3><span style= 'color: red;'>";
        } else {
            echo "<h3><span style= 'color: red;'>";
        }
        return false;
    }
    return true;
}
