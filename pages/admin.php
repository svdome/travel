<?php
// проверка ключа администратора
if (!isset($_SESSION['radmin'])) {
    echo "<h3><span style='color: red;'>Only for Admins!</span></h3>";
    exit();
}
?>

<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <!--Countries-->
        <?php
        //$link = connect();
        //$selectCountries = 'SELECT * from countries order by id asc';
        //$res = mysqli_query($link, $selectCountries);
        $db = new PDO('mysql: host=localhost; dbname=travels', 'root', 'root');
        $res=$db->query('select * from countries order by id asc');


        echo '<form action="index.php?page=4" method="post" class="input-group" id="formcountry">';
        echo '<table class="table table-striped">';
        //while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        while ($row = $res->fetch(PDO::FETCH_NUM)) {

            echo '<tr>';
            echo '<td>' . $row[0] . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td><input type="checkbox" name="cb' . $row[0] . '"></td>';
            echo '</tr>';
        }
        echo '</table>';
        //mysqli_free_result($res);
        echo '<input type="text" name="country" placeholder="Country">';
        echo '<input type="submit" name="addcountry" value="Add" class="btn btn-sm btn-info">';
        echo '<input type="submit" name="delcountry" value="Delete" class="btn btn-sm btn-warning">';
        echo '</form>';

        if (isset($_POST['addcountry'])) {
            $country = trim(htmlspecialchars($_POST['country']));
            if ($country == "") exit();
            //$insertCountry = 'INSERT into countries (country) values ("' . $country . '")';
            //mysqli_query($link,  $insertCountry);
            $exec=$db->exec('INSERT into countries (country) values ("' . $country . '")');

            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }
        if (isset($_POST['delcountry'])) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 2) == 'cb') {
                    $id = substr($key, 2);
                    //$delete = 'DELETE from countries where id =' . $id;
                    //mysqli_query($link, $delete);
                    $exec=$db->exec('DELETE from countries where id =' . $id);
                }
            }
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }
        ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 right">
        <!--Cities-->
        <?php
        echo '<form action="index.php?page=4" method="post" class="input-group" id="formcity">';
        //$selectCities = 'SELECT cities.id, cities.city, countries.country
        //from countries, cities
        //where cities.countryid = countries.id order by id asc';
        //$res = mysqli_query($link, $selectCities);
        $db = new PDO('mysql: host=localhost; dbname=travels', 'root', 'root');
        $res=$db->query('SELECT cities.id, cities.city, countries.country 
        from countries, cities 
        where cities.countryid = countries.id order by id asc');

        echo '<table class="table table-striped">';
        //while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        while ($row = $res->fetch(PDO::FETCH_NUM)) {
            echo '<tr>';
            echo '<td>' . $row[0] . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td>' . $row[2] . '</td>';
            echo '<td><input type="checkbox" name="ci' . $row[0] . '"></td>';
            echo '</tr>';
        }
        echo '</table>';
        //mysqli_free_result($res);
        //$res = mysqli_query($link, 'SELECT * from countries');
        $res=$db->query('SELECT * from countries');
        echo '<select name="countryname" class="form-control">';
        //while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        while ($row = $res->fetch(PDO::FETCH_NUM)) {
            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        }
        echo '</select>';
        echo '<input type="text" name="city" placeholder="City">';
        echo '<input type="submit" name="addcity" value="Add" class="btn btn-sm btn-info">';
        echo '<input type="submit" name="delcity" value="Delete" class="btn btn-sm btn-warning">';
        echo '</form>';

        if (isset($_POST['addcity'])) {
            $city = trim(htmlspecialchars($_POST['city']));
            if ($city == "") exit();
            $countryid = $_POST['countryname'];
            //$insertCity = 'INSERT into cities (city, countryid) values ("' . $city . '", ' . $countryid . ')';
            //mysqli_query($link,  $insertCity);
            $exec=$db->exec('INSERT into cities (city, countryid) values ("' . $city . '", ' . $countryid . ')');

            /**$error = mysqli_errno($link);
            if ($error) {
                echo 'Error code: ' . $error . '<br>';
                exit();
            }*/
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }

        if (isset($_POST['delcity'])) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 2) == 'ci') {
                    $id = substr($key, 2);
                    //$del = 'DELETE from cities where id =' . $id;
                    //mysqli_query($link, $del);
                    $exec=$db->exec('DELETE from cities where id =' . $id);
                }
            }
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }
        ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <!--Hotels-->
        <?php
        echo '<form action="index.php?page=4" method="post" class="input-group" id="formhotel">';
        //$selectHotels = 'SELECT cities.id, cities.city, hotels.id, hotels.hotel,
        //hotels.cityid, hotels.countryid, hotels.stars, hotels.cost, hotels.info, countries.id, countries.country, images.imagepath
        //from cities, hotels, countries, images
        //where hotels.cityid=cities.id and hotels.countryid=countries.id and hotels.id=images.hotelid';
        //$res = mysqli_query($link, $selectHotels);
        $res=$db->query('SELECT cities.id, cities.city, hotels.id, hotels.hotel, 
        hotels.cityid, hotels.countryid, hotels.stars, hotels.cost, hotels.info, countries.id, countries.country, images.imagepath
        from cities, hotels, countries, images 
        where hotels.cityid=cities.id and hotels.countryid=countries.id and hotels.id=images.hotelid');

        //$error = mysqli_errno($link);
        //echo $error; //1054
        //место для вывода ошибки запроса

        echo '<table class ="table" width="100%">';
        //while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        while ($row = $res->fetch(PDO::FETCH_NUM)) {
            echo '<tr>';
            echo '<td>' . $row[2] . '</td>';
            echo '<td>' . $row[1] . '-' . $row[9] . '</td>';
            echo '<td>' . $row[3] . '</td>';
            echo '<td>' . $row[6] . '</td>';
            echo '<td><img src = "../' . $row[10] . '" alt="foto hotel" width="100px" height="100px"></td>'; // Добавление фото отеля
            echo '<td><input type="checkbox" name="hb' . $row[2] . '"></td>';
            echo '</tr>';
        }
        echo '</table>';
        //mysqli_free_result($res);

        //$selectCC = 'SELECT cities.id, cities.city, countries.country, countries.id
        //from countries, cities
        //where cities.countryid=countries.id';
        //$res = mysqli_query($link, $selectCC);
        $res=$db->query('SELECT cities.id, cities.city, countries.country, countries.id
        from countries, cities 
        where cities.countryid=countries.id');

        $linkCityToCountry = [];
        echo '<select name="hcity" class=" ">'; //?
        //while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        while ($row = $res->fetch(PDO::FETCH_NUM)) {
            echo '<option value="' . $row[0] . '">' . $row[1] . " : " . $row[2] . '</option>';
            $linkCityToCountry[$row[0]] = $row[3];
        }
        echo '</select>';

        echo '<input type="text" name="hotel" placeholder="Hotel">';
        echo '<input type="text" name="cost" placeholder="Cost">';
        echo '&nbsp;&nbsp;Stars: <input type="number" name="stars" min="1" max ="5">';
        echo '<br><textarea name ="info" placeholder="Description"></textarea><br>';
        echo '<input type="submit" name="addhotel" value="Add" class="btn btn-sm btn-info">';
        echo '<input type="submit" name="delhotel" value="Delete" class="btn btn-sm btn-warning">';
        echo '</form>';
        //mysqli_free_result($res);
        // обработчик добавления отелей
        if (isset($_POST['addhotel'])) {
            $hotel = trim(htmlspecialchars($_POST['hotel']));
            $cost = trim(htmlspecialchars($_POST['cost']));
            $stars = intval($_POST['stars']);
            $info = trim(htmlspecialchars($_POST['info']));
            if ($hotel == " " || $cost == " " || $stars == " ") {
                exit();
            }
            $cityid = $_POST['hcity'];
            $countryid = $linkCityToCountry[$cityid];
            //$insertHotel = 'INSERT into hotels (hotel, cityid, countryid, stars, cost, info)
            //                values ("' . $hotel . '",' . $cityid . ',' . $countryid . ',' . $stars . ',' . $cost . ',"' . $info . '")';
            //mysqli_query($link,  $insertHotel);
            $exec=$db->exec('INSERT into hotels (hotel, cityid, countryid, stars, cost, info) 
                            values ("' . $hotel . '",' . $cityid . ',' . $countryid . ',' . $stars . ',' . $cost . ',"' . $info . '")');

            /**$error = mysqli_errno($link);
            if ($error) {
                echo 'Error code add: ' . $error . '<br>';
                exit();
            }*/
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }
        // обработчик удаления отелей
        if (isset($_POST['delhotel'])) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 2) == 'hb') {
                    $idc = substr($key, 2);
                    //$del = 'DELETE from hotels where id =' . $idc;
                    //mysqli_query($link, $del);
                    $exec=$db->exec('DELETE from hotels where id =' . $idc);
                    /**$error = mysqli_errno($link);
                    if ($error) {
                        echo 'Error code delete: ' . $error . '<br>';
                        exit();
                    }*/
                }
            }
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }

        ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 right">
        <!--Images-->
        <?php

        echo '<form action="index.php?page=4" method="post" enctype ="multipart/form-data" class="input-group">';
        echo '<select name="hotelid">';
        //$select = 'SELECT hotels.id, countries.country, cities.city, hotels.hotel
        //            from countries, cities, hotels
        //            where countries.id= hotels.countryid and cities.id=hotels.cityid
        //            order by countries.country';
        //$res = mysqli_query($link, $select);
        $res=$db->query('SELECT hotels.id, countries.country, cities.city, hotels.hotel
                    from countries, cities, hotels 
                    where countries.id= hotels.countryid and cities.id=hotels.cityid 
                    order by countries.country');
        //while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        while ($row = $res->fetch(PDO::FETCH_NUM)) {
            echo '<option value="' . $row[0] . '">';
            echo $row[1] . '/' . $row[2] . '/' . $row[3];
            echo '</option>';
        }
        mysqli_free_result($res);
        echo '<input type="file" name="file[]" multiple accept="image/*">';
        echo '<input type="submit" name="addimage" value="Add" class = "btn btn-sm btn-info">';
        echo '</select>';
        echo '</form>';
        if (isset($_REQUEST['addimage'])) {
            foreach ($_FILES['file']['name'] as $key => $value) {
                if ($_FILES['file']['error'][$key] != 0) {
                    echo '<script>alert("Upload file error:' . $value . '")</script>';
                    continue;
                }
                if (move_uploaded_file($_FILES['file']['tmp_name'][$key], 'images/' . $value)) {
                    //$ins = 'INSERT into images(hotelid, imagepath) values (' . $_REQUEST['hotelid'] . ', "images/' . $value . '")';
                    //mysqli_query($link, $ins);
                    $exec=$db->exec('INSERT into images(hotelid, imagepath) values (' . $_REQUEST['hotelid'] . ', "images/' . $value . '")');

                }
                //mysqli_free_result($ins); 
            }
        }
        ?>
    </div>
</div>