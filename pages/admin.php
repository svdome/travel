<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <!--Countries-->
        <?php
        $link = connect();
        $selectCountries = 'select * from countries order by id asc';
        $res = mysqli_query($link, $selectCountries);
        echo '<form action="index.php?page=4" method="post" class="input-group" id="formcountry">';
        echo '<table class="table table-striped">';
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo '<tr>';
            echo '<td>' . $row[0] . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td><input type="checkbox" name="cb' . $row[0] . '"></td>';
            echo '</tr>';
        }
        echo '</table>';
        mysqli_free_result($res);
        echo '<input type="text" name="country" placeholder="Country">';
        echo '<input type="submit" name="addcountry" value="Add" class="btn btn-sm btn-info">';
        echo '<input type="submit" name="delcountry" value="Delete" class="btn btn-sm btn-warning">';
        echo '</form>';

        if (isset($_POST['addcountry'])) {
            $country = trim(htmlspecialchars($_POST['country']));
            if ($country == "") exit();
            $insertCountry = 'insert into countries (country) values ("' . $country . '")';
            mysqli_query($link,  $insertCountry);
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }
        if (isset($_POST['delcountry'])) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 2) == 'cb') {
                    $id = substr($key, 2);
                    $delete = 'delete from countries where id =' . $id;
                    mysqli_query($link, $delete);
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
        $selectCities = 'select cities.id, cities.city, countries.country from countries, cities where cities.countryid = countries.id order by id asc';
        $res = mysqli_query($link, $selectCities);
        echo '<table class="table table-striped">';
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo '<tr>';
            echo '<td>' . $row[0] . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td>' . $row[2] . '</td>';
            echo '<td><input type="checkbox" name="ci' . $row[0] . '"></td>';
            echo '</tr>';
        }
        echo '</table>';
        mysqli_free_result($res);
        $res = mysqli_query($link, 'select * from countries');
        echo '<select name="countryname" class="form-control">';
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
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
            $insertCity = 'insert into cities (city, countryid) values ("' . $city . '", ' . $countryid . ')';
            mysqli_query($link,  $insertCity);
            $error = mysqli_errno($link);
            if ($error) {
                echo 'Error code: ' . $error . '<br>';
                exit();
            }
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }

        if (isset($_POST['delcity'])) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 2) == 'ci') {
                    $id = substr($key, 2);
                    $del = 'delete from cities where id =' . $id;
                    mysqli_query($link, $del);
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

    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 right">
        <!--Images-->

    </div>
</div>