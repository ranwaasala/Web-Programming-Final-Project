<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe List</title>
    <link rel="stylesheet" href="styleA.css">
   
</head>

<body>

<?php
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
                include("header_logged_in.html");
            }
            else{
                include("header.html");
            }
    ?>

    
    <div class="container">
        <h2>Recipe List</h2>
        <ul class="recipe-list">
            <!-- <li class="recipe-item">
                <img src="file:///C:/Users/HP/Pictures/Screenshots/OmAli.png" alt="Om Ali">
                <a href="recipe.html">Om Ali</a>
            </li>
            <li class="recipe-item">
                <img src="file:///C:/Users/HP/Pictures/Screenshots/fattah.png" alt="Fattah">
                <a href="recipe.html">Fattah</a>
            </li>
            <li class="recipe-item">
                <img src="file:///C:/Users/HP/Pictures/Screenshots/m.png" alt="Molokhya">
                <a href="recipe.html">Molokhya</a>
            </li>
            <li class="recipe-item">
                <img src="file:///C:/Users/HP/Pictures/Screenshots/roz.png" alt="Roz Moamar">
                <a href="recipe.html">Roz Moamar</a>
            </li>
            <li class="recipe-item">
                <img src="file:///C:/Users/HP/Pictures/Screenshots/kofta.png" alt="Kofta">
                <a href="recipe.html">Kofta</a>
            </li> -->
            <?php
            if(!empty($_REQUEST["id"])){
                $dbhost = 'localhost'; $dbuser='root'; $dbpass=''; $dbname='SetGhalya';
                $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $query = "select * from recipe where category_id=".$_REQUEST["id"];
                $result = mysqli_query($conn, $query);
                if ($result){
                    while($row = mysqli_fetch_assoc($result)){
                        echo " <li class='recipe-item'>
                                <img src='{$row['photo']}' alt='{$row['recipe_name']}'>
                                <a href='recipe.php?id={$row['recipe_id']}'> {$row['recipe_name']} </a>
                                </li>";
                    }
                }
            }
            ?>
        </ul>
    </div>

    
    <footer>
        <p>&copy; 2024 SetGhalya. All rights reserved.</p>
        <p>
            <a href="#">Privacy Policy</a> | 
            <a href="#">Terms of Service</a> 
        </p>   
    </footer>

</body>
</html>
