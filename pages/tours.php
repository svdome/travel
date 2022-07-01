<h2>Select Tours</h2>
<hr>
<?php
$link = connect();
echo '<form action="index.php?page=1" method ="post">';
echo '<select name="countryid" class="col-sm3 col-md-3 col-lg-3">';
$res = mysqli_query($link, 'SELECT*from countries order by country');
echo '<option value="0">Select country... </option>';
while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    echo '<option value="' . $row['id'] . '">' . $row['country'] . '</option>';
}
mysqli_free_result($res);
echo '<input type="submit" name="selcountry" value="Select Country" class="btn btn-xs btn-primary">';
echo '</select>';

if (isset($_POST['selcountry'])) {
    echo '<br>';
    $countryid = $_POST['countryid'];
    if ($countryid == 0) {
        exit();
    }
    $res = mysqli_query($link, "SELECT * from cities where countryid='. $counryid .'  order by city");
    echo '<select name="cityid" class="col-sm3 col-md-3 col-lg-3">';
    echo '<option value="0">Select city...</option>';
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        echo '<option value="' . $row['id'] . '">' . $row['city'] . '</option>';
    }
    mysqli_free_result($res);
    echo '</select>';
    echo '<input type="submit" name="selcity" value= "Select City" class="btn btn-xs btn-primary">';
}
echo '</form>';
//------------------------------------------------------------------------------------------------------------
if (isset($_POST['selcity'])) {
    echo '<br>';
    $cityid = $_POST['cityid'];
    if ($cityid == 0) {
        exit();
    }
    $res = mysqli_query($link, 'SELECT cities.city, hotels.hotel, hotels.stars, countries.country
    from cities, hotels, countries
    where hotels.cityid=cities.id and hotels.countryid=counries.id');


    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        echo  $row['hotel'] . ' ' . $row['country'] . '' . $row['city'] . ' ' . $row['cost'] . '' . $row['stars'];
    }

    mysqli_free_result($res);
}
//---------------------------------------------------------------------------------------------------------------


