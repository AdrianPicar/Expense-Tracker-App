<?php
include_once "header.php";
include_once "authenticate.php";

$_SESSION["budget"] = 20000;

function format_number($num){
    return number_format($num, 2, ".", ",");
}
?>

<!--html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

</head>  
<body-->

<div class="container theme-showcase">
  <h1>Calendar</h1>
<div id="holder" class="row" ></div>
</div>

<?php
include_once "footer.php";
?>