<?php

include_once "functions.php";

//$link = connect();
$db = new PDO('mysql: host=localhost; dbname=travels', 'root', 'root');
$cid = $_GET['cid'];
//$select = 'SELECT * from cities where countryid=' .  $cid;
$res=$db->query('SELECT * from cities where countryid=' .  $cid);
$row = $res->fetch(PDO::FETCH_ASSOC);
echo '<option value="0">select city</option>';
while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    echo '<option value="' . $row['id'] . '">' . $row['city'] . '</option>';
}

//mysqli_free_result($res);
