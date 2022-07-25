<?
include_once "function.php";
$link =connect();
$hid = $_GET['hid'];
$select = 'SELECT cnt.country as "country", ct.city as "city", h.hotel as "hotel", h.cost as "price", h.stars as "stars", h.id as "hotelid"
from hotels h, cities ct, countries cnt
where h.cityid=ct.id and h.countryid=cnt.id and h.cityid='.$hid;
$res = mysqli_query($link, $select);


echo '<table width="100%" class="table table-striped tbtours text-center">';
echo '<thead style="font-weight: bold;"><td>Hotel</td><td>Country</td><td>City</td><td>Price</td><td>Stars</td><td>Link</td></thead>';
while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row['hotel'] . '</td><td>' . $row['country'] . '</td><td>' . $row['city'] . '</td><td>' . $row['price'] . '</td><td>' . $row['stars'] . '</td><td><a href="pages/hotelinfo.php?hotel=' . $row['hotelid'] . '" target="_blank">More info</a></td>';
    echo '</tr>';
}
mysqli_free_result($res);
echo '</table><br>';