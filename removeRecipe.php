<?php
    session_start();
    $dbhost = 'localhost'; $dbuser='root'; $dbpass=''; $dbname='SetGhalya';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "delete from user_recipe where recipe_id= {$_REQUEST["recipe_id"]} and user_id={$_SESSION['user_id']}";
    mysqli_query($conn, $query);
    header("Location: profile.php");
    exit;
?>