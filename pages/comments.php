<?php
// проверка зарегестрированности пользователя
if (!isset($_SESSION['radmin'])) {
    echo "<h3><span style='color: red;'>Comments can only be left by registered users!</span></h3>";
    exit();
} else {
    echo "<h3><span style='color: green;'>Leave your comment about the hotel!</span></h3>";
}
?>

<h2>Select Country, City, Hotel</h2>
<hr>
<?php
//$link = connect();
$db = new PDO('mysql: host=localhost; dbname=travels', 'root', 'root');
echo '<form action="index.php?page=2" method="post">';
echo '<select name="countryid" class="col-sm-3 col-md-3 col-lg-3">';
//$res = mysqli_query($link, 'SELECT * from countries order by country');
$res=$db->query('SELECT * from countries order by country');
echo '<option value="0">Select country... </option>';
//while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . $row['id'] . '">' . $row['country'] . '</option>';
}
//mysqli_free_result($res);
echo '<input type="submit" name="selcountry" value="Select Country" class="btn btn-xs btn-primary">';
echo '</select>';
//------------------------------------------------------------------------------------------------------------
// выбор страны
if (isset($_POST['selcountry'])) {
    echo '<br>';
    $countryid = $_POST['countryid'];
    if ($countryid == 0) {
        exit();
    }
    //$res = mysqli_query($link, 'SELECT * from cities where countryid=' . $countryid . ' order by city');
    $res=$db->query('SELECT * from cities where countryid=' . $countryid . ' order by city');
    echo '<select name="cityid" class="col-sm-3 col-md-3 col-lg-3">';
    echo '<option value="0">Select city...</option>';
    //while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['id'] . '">' . $row['city'] . '</option>';
    }
    //mysqli_free_result($res);
    echo '</select>';
    echo '<input type="submit" name="selcity" value= "Select City" class="btn btn-xs btn-primary">';
}

//------------------------------------------------------------------------------------------------------------
//выбор города
if (isset($_POST['selcity'])) {
    echo '<br>';
    $cityid = $_POST['cityid'];
    if ($cityid == 0) {
        exit();
    }
    //$select = 'SELECT * from hotels where hotels.cityid=' . $cityid . ' order by hotel';
    $res=$db->query( 'SELECT * from hotels where hotels.cityid=' . $cityid . ' order by hotel');
    //$res = mysqli_query($link, $select)
    //$error = mysqli_errno($link);
    //место для вывода ошибки запроса
    echo '<select name="hotelid" class="col-sm-3 col-md-3 col-lg-3">';
    echo '<option value="0">Select hotel...</option>';
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['id'] . '">' . $row['hotel'] . '</option>';
    }
    //mysqli_free_result($res);
    echo '</select>';
    echo '<input type="submit" name="selhotel" value= "Select Hotel" class="btn btn-xs btn-primary">';
}
echo '</form>';
//---------------------------------------------------------------------------------------------------------------
// выбор отеля
if (isset($_POST['selhotel'])) {
    $hotelid = $_POST['hotelid'];
    //$select = 'SELECT cnt.country as "country", ct.city as "city", h.hotel as "hotel"
    //from hotels h, cities ct, countries cnt
    //where h.cityid=ct.id and h.countryid=cnt.id and h.id=' . $hotelid;
    $res=$db->query( 'SELECT cnt.country as "country", ct.city as "city", h.hotel as "hotel"
    from hotels h, cities ct, countries cnt
    where h.cityid=ct.id and h.countryid=cnt.id and h.id=' . $hotelid);
    //$res = mysqli_query($link, $select);
    $row = $res->fetch(PDO::FETCH_ASSOC);
    //$error = mysqli_errno($link);
    //echo $error;
    //место для вывода ошибки запроса

    if ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $arruser = [];
        $arruser['user'] = $_SESSION['ruser'];
        $text = file_get_contents('pages/text_comments.txt'); //читаем текстовый файл
        file_put_contents('pages/text_comments.txt', $text . date('d-m-Y') . ', User: '. $arruser['user'] .', Hotel: '. $row['hotel'] .', Country: '. $row['country'] .', City: '. $row['city'].', ');
    }
    //mysqli_free_result($res);
    echo '</table><br>';
    echo '<h3>leave your comment</h3>';
}
// добавление коментария

echo '<form action="" method="post">';
echo '<br><textarea name ="comment" placeholder="Comment" widht="100px"></textarea><br>';
echo '<input type="submit" name="addcomment" value="Add" class="btn btn-sm btn-info">';
echo '</form>';

if (isset($_POST['addcomment'])) {
    $comment = trim(htmlspecialchars($_POST['comment']));

    if ($comment == " ") {
        exit();
    }
    $text = file_get_contents('pages/text_comments.txt'); //читаем текстовый файл
    file_put_contents('pages/text_comments.txt', $text . $comment. '<br>'); // добавляем коментарий


    echo "<script>";
    echo "window.location=document.URL;";
    echo "</script>";
}
?>
<h2>User comments</h2>
<?php
echo file_get_contents('pages/text_comments.txt');
?>
<hr>