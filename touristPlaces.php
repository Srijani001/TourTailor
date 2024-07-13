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
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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
<h1 style="font-family: Times New Roman, Times, serif; font-weight: bold; color: blue">Nearby Tourist Places</h1>
<br>

  <!-- <h1>Nearby Tourist Places Finder</h1> -->
   <label for="address">Address:</label>
    <input type="text" id="address" name="address"><br><br>
    <button onclick="findTouristPlaces()">Find Tourist Places</button>
    <!-- <h2>Nearby Tourist Places</h2>
    <iframe id="searchResults" width="100%" height="600px"></iframe -->

    <script>
    function findTouristPlaces() {
        const address = document.getElementById('address').value;
        const query = encodeURIComponent(`tourist places near ${address}`);
        const googleSearchURL = `https://www.google.com/search?q=${query}`;
        window.location.href =googleSearchURL;
        // document.getElementById('searchResults').src = googleSearchURL;
    }
    </script>
</div>
    <?php
}
?>