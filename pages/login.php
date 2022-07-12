<?php
// создание формы для аутентификации

if (isset($_SESSION['ruser'])) {
    $page = '';
    if (isset($_GET['page'])) {
        $page = '?page=' . $_GET['page'];
    }
    echo '<form action="index.php' . $page . '" class="form-inline pull-right" method="post">';
    echo '<h4>Hello, <span>' . $_SESSION['ruser'] . '</span>&nbsp; <input type="submit" value="Logout" id="ex" name="ex" class="btn btn-default btn-xs"></h4>';
    echo '</form>';

    if (isset($_POST['ex'])) {
        unset($_SESSION['ruser']);
        unset($_SESSION['radmin']);
        echo '<script>window.location.reload()</script>';
    }
} else {
    if (isset($_POST['press'])) {
        if (login($_POST['login'], $_POST['pass'])) {
            echo '<script>window.location.reload()</script>';
        }
    } else {
        $page = '';
        if (isset($_GET['page'])) {
            $page = '?page=' . $_GET['page'];
        }
        echo '<form action="index.php' . $page . '" class="form-inline pull-right" method="post">';
        echo '<input type="text" name="login" size="10" class="" placeholder="login">';
        echo '<input type="password" name="pass" size="10" class="" placeholder="password">';
        echo '<input type="submit" id="press" value="Login" class="btn btn-default btn-xs" name="press">';
        echo '</form>';
    }
}
