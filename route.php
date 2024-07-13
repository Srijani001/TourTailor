<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    ?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Tour Tailor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <script
            type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- Custom Theme files -->
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--animate-->
        <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
        <script src="js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        <!--//end-animate-->
    </head>

    <body>
        <?php include ('includes/header.php'); ?>
        <br>
        <div style="text-align:center; ">
            <h1 style="font-family: Times New Roman, Times, serif; font-weight: bold; color: blue">Find Route</h1>
            <h3>Select Transportation Type</h3>
            <select style="width: 250px" name="transport" onchange="trans()" id="transport">
                <option value="drive">Drive</option>
                <option value="aeroplane">Airplane</option>
                <option value="train">Train</option>
            </select>
            <br>
            <br>
            <div id="map" style="width: 70%; height: 600px; margin:auto;"></div>

            <br>
            <br>
            <div id="flightinfo" style="display:none">
            <?php include ('areo.php') ?>
            </div>
            <div id="traininfo" style="display:none">
            <h3>Coming Soon...</h3>
            </div>
        </div>
            <!-- <div style="margin: 20px;">
                <input type="text" id="start" placeholder="Start Location">
                <input type="text" id="end" placeholder="End Location">
                <button id="routeButton">Get Route</button>
            </div> -->
            

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-control-geocoder/1.13.0/Control.Geocoder.min.js"></script>
            <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
            <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

            <script>
                // Initialize the map
                var map = L.map('map').setView([22.5744, 88.3629], 10);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Initialize the routing control
                var control = L.Routing.control({
                    waypoints: [],
                    routeWhileDragging: true,
                    geocoder: L.Control.Geocoder.nominatim()
                }).addTo(map);

                // Auto-complete function using Nominatim geocoder
                var startInput = document.getElementById('start');
                var endInput = document.getElementById('end');
                var geocoder = L.Control.Geocoder.nominatim();

                function autoComplete(input, callback) {
                    input.addEventListener('input', function () {
                        geocoder.geocode(input.value, function (results) {
                            callback(results);
                        });
                    });
                }

                function selectAddress(results, input) {
                    var list = document.createElement('ul');
                    list.style.position = 'absolute';
                    list.style.backgroundColor = 'white';
                    list.style.border = '1px solid #ccc';
                    results.forEach(function (result) {
                        var item = document.createElement('li');
                        item.innerText = result.name;
                        item.style.padding = '5px';
                        item.style.cursor = 'pointer';
                        item.addEventListener('click', function () {
                            input.value = result.name;
                            document.body.removeChild(list);
                        });
                        list.appendChild(item);
                    });
                    document.body.appendChild(list);
                }

                autoComplete(startInput, function (results) {
                    selectAddress(results, startInput);
                });

                autoComplete(endInput, function (results) {
                    selectAddress(results, endInput);
                });

                document.getElementById('routeButton').addEventListener('click', function () {
                    var startValue = startInput.value;
                    var endValue = endInput.value;
                    geocoder.geocode(startValue, function (startResults) {
                        geocoder.geocode(endValue, function (endResults) {
                            if (startResults.length > 0 && endResults.length > 0) {
                                var startLatLng = startResults[0].center;
                                var endLatLng = endResults[0].center;
                                control.setWaypoints([
                                    L.latLng(startLatLng.lat, startLatLng.lng),
                                    L.latLng(endLatLng.lat, endLatLng.lng)
                                ]);
                            } else {
                                alert('Please enter valid start and end locations');
                            }
                        });
                    });
                });
            </script>
        

    <script>
        function trans() {
            var t = document.getElementById('transport').value;
            if(t=="drive"){
                document.getElementById('map').style.display = 'block';
                document.getElementById('flightinfo').style.display = 'none';
                document.getElementById('traininfo').style.display = 'none';
            }
            else if(t=="aeroplane"){
                document.getElementById('map').style.display = 'none';
                document.getElementById('traininfo').style.display = 'none';
                document.getElementById('flightinfo').style.display = 'block';
                
            }
            else{
                document.getElementById('map').style.display = 'none';
                document.getElementById('flightinfo').style.display = 'none';
                document.getElementById('traininfo').style.display = 'block';
            }
        }
    </script>
    </body>

</html>
    <?php
}
?>