<?php

include_once "functions.php";

$link = connect();
$cid = $_GET['cid'];
$select = 'SELECT * from cities where countryid=' .  $cid;
$res = mysqli_query($link, $select);
echo '<option value="0">select city</option>';
while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    echo '<option value="' . $row['id'] . '">' . $row['city'] . '</option>';
}

mysqli_free_result($res);
