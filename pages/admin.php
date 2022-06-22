<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <!--Countries-->
        <?php
        $link = connect();
        $selectCountries = 'select*from countries order by id asc';
        $res = mysqli_query($link, $selectCountries);
        echo '<form action="indx.php?page=4" method="post" class="input-group" id="formcountry">';
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
        if(isset($_POST['addcountry'])) {
            $country = trim(htmlspecialchars($_POST['country']));
            if ($country =="") exit();
            $insertCountry = 'insert into countries (country) values ("' . $country . '")';
            mysqli_query($link,  $insertCountry);
            echo "<script>";

            echo "</script>";
        }
        if(isset($_POST['delcountry'])) {
            foreach($)
                if(substr($key, 0, 2) == 'cb') {
                    $id=substr($key, 2);
                    $delete= 'delete from countries wher id ='. $id;
                    mysqli_query($link, $delete);
                }
        }
        ?>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 right">
            <!--Cities-->
            <?php
                echo 'form action="index.php?page=4" method="post" class="input-group" id="formcity">';
                $selectCities = 'select cities.id, cities.city, countries.country from countries, cities where cities.countryid = countries.id order by id asc';
                $res = mysqli_query($link,$selectCities);
                echo '<form action="indx.php?page=4" method="post" class="input-group" id="formcountry">';
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
                $res = mysqli_query($link, 'select*from countries');
                echo '<select name="countryname" class="form-control">';
                while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                    echo '<option value="' .$row[0].'">'.
                }
                
                echo '<input type="text" name="country" placeholder="Country">';
                echo '<input type="submit" name="addcountry" value="Add" class="btn btn-sm btn-info">';
                echo '<input type="submit" name="delcountry" value="Delete" class="btn btn-sm btn-warning">';
                echo '</form>';
            ?>

        </div>
        <hr>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 left">
            <!--Hotels-->
        </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 right">
            <!--Images-->
        </div>
    </div>