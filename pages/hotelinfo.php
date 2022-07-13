<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/info.css">
</head>

<body>
    <?
    include_once "functions.php";
    if (isset($_GET['hotel'])) {
        $hotel = $_GET['hotel'];
        $link = connect();
        $select = 'SELECT * from hotels where id=' . $hotel;
        $res = mysqli_query($link, $select);
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $hname = $row['hotel'];
        $hstars = $row['stars'];
        $hcost = $row['cost'];
        $hinfo = $row['info'];
        mysqli_free_result($res);
        echo '<h2 class="text-uppercase text-center">' . $hname . '</h2>';
        echo '<div class="row"><div class="col-md-6 text-center">';
        $select = 'SELECT imagepath from images where hotelid=' . $hotel;
        $res = mysqli_query($link, $select);
        echo '<span class="label label-info">Watch your pictures</span>';
        echo '<ul id="gallery">';
        $i = 0;
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            echo '<li><img src="../'. $row['imagepath'] . '" alt="image hotel"></li>';
            echo '<li>Hotel:' . $hname . '</li>';
            echo '<li>Stars:' . $hstars . '</li>';
            echo '<li>Price:' . $hcost  . '</li>';
            echo '<li>Info:' . $hinfo . '</li>';
            
        }
        mysqli_free_result($res);
        echo '</ul>';
    }
    ?>

</body>

</html>