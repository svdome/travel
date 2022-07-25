function showCities(countryid) {
    if (countryid === "0") {
        document.getElementById('citylist').innerHTML = "";
    }
    //создаем AJAX обьект
    var ao = new XMLHttpRequest();
    ao.onreadystatechange = function () {
        if (ao.readyState === 4 && ao.status === 200) {
            document.getElementById('citylist').innerHTML = ao.responseText;
        }
    }
    ao.open('GET', "../pages/ajaxcities.php?cid=" + countryid, true);
    ao.send(null);
}




function showHotels(cityid) {
    if (cityid === "0") {
        document.getElementById('h').innerHTML = "";
    }
    //создаем AJAX обьект
    var ao = new XMLHttpRequest();
    ao.onreadystatechange = function () {
        if (ao.readyState === 4 && ao.status === 200) {
            document.getElementById('h').innerHTML = ao.responseText;
        }
    }
    ao.open('GET', "../pages/ajaxhotels.php?hid=" + cityid, true);
    ao.send(null);
}