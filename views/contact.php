<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 13.01.2018
 * Time: 14:10
 */
?>

<h1>Kde nás najdete</h1>
<div id="googleMap" style="width:100%;height:400px;"></div>

<!-- java script na mapu-->
<script>
    function myMap() {
        var mapProp= {
            center:new google.maps.LatLng(49.6370447,13.1748194),
            zoom: 15,
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>

<!--
<script src="AIzaSyD2yQW8WR3e9BTvlp2TnOkbq_M6rK2AeuI"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2yQW8WR3e9BTvlp2TnOkbq_M6rK2AeuI&callback=myMap"></script>

<body>
<h2>Majitel stránky</h2>
Jan Rychlík
<h3>Adresa</h3>
<p>Šeříková 785<br>
Stod<br>
333 01</p>

<h3>Kontaktní údaje</h3>
<p> tel: 333 444 545<br>
    e-mail:<a href="mailto:rychlikj@students.zcu.cz">rychlikj@students.zcu.cz</a></p>
</body>



