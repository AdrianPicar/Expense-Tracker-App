<?php
// Start the session
session_start();

include_once 'classes/database.php';
include_once 'classes/user.php';
include_once 'classes/entry.php';

$database = new Database();
$db = $database->getConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Tracker - Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/bootstrap-datepicker.css">
    <link rel="stylesheet" href="styles/calendar.css">
</head>
<body style="padding:25px;">
<div class="">
    <div class="">
        <a href="home.php">Welcome <?php echo $_SESSION["username"]?></a>
        <br>
        <a href="add_entry.php">Add Entry</a>
        <br>
        <a href="view_entries.php">View Entries</a>
        <br>
        <a href="view_calendar.php">View Calendar</a>
        <br>
        <a href="logout.php">Logout</a>
    </div>
</div>