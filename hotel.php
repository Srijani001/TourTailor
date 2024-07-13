<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
    ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Tour Tailor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
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
<?php include('includes/header.php');?>
<br>
<div style="text-align:center; ">
<h1 style="font-family: Times New Roman, Times, serif; font-weight: bold; color: blue">Hotel Food And Lodging</h1>
<label for="address">Address:</label>
    <input type="text" id="address" name="address"><br><br>
    <button onclick="findTouristPlaces()">Find Hotel</button>
</div>
    <script>
    function findTouristPlaces() {
        const address = document.getElementById('address').value;
        const query = encodeURIComponent(`Hotels and Resturants near ${address}`);
        const googleSearchURL = `https://www.google.com/search?q=${query}`;
        window.location.href=googleSearchURL;
    }
    </script>

    <?php
}
?>