<?php

function connect(
    $host = 'localhost',
    $user = 'root',
    $pass = '123',
    $dbname = 'travels'
)
{
    $link = mysqli_connect($host, $user, $pass) or die('connection error');
    mysqli_select_db($link, $dbname) or die('DB open error');
    mysqli_query($link, "set names 'utf8'");
    return $link;
}