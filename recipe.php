<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipe</title>
    <link rel="stylesheet" href="style_recipe.css">
</head>
<body>

<?php
    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
        include("header_logged_in.html");
    } else {
        include("header.html");
    }
?>

<?php
if (isset($_REQUEST["msg"])) {
    echo "<br>" . htmlspecialchars($_REQUEST['msg']);
}
?>

<?php
if (!empty($_REQUEST["id"])) {
    $dbhost = 'localhost'; 
    $dbuser = 'root'; 
    $dbpass = ''; 
    $dbname = 'SetGhalya';
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $recipe_id = (int)$_REQUEST["id"]; 
    $query = "SELECT * FROM recipe WHERE recipe_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userid = $row["user_id"];

        
        echo "<div class='center-image'>";
        echo "<img src='{$row['photo']}' alt='Recipe Image' class='recipe-image-centered'>";
        echo "</div>";
        echo "<h2>{$row['recipe_name']} ({$row['calories']} kcal per serving)</h2>";
        
        echo "<h4>Ingredients</h4><ul>";
        $ingredients = explode("\n", $row['ingredients']); 
        foreach ($ingredients as $ingredient) {
            echo "<li>$ingredient</li>";
        }
        echo "</ul>";

        echo "<h4>Instructions</h4><ul>";
        $instructions = explode("\n", $row['instructions']); 
        foreach ($instructions as $instruction) {
            echo "<li>$instruction</li>";
        }
        echo "</ul>";

        
        $query2 = "SELECT username FROM user WHERE user_id = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $userid);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            echo "<p>Posted by: {$row2['username']}</p>";
        }

        // Save recipe button
        echo "<form method='POST' action='saveRecipe.php'>
                <input type='hidden' name='recipe_id' value='{$row['recipe_id']}'>
                <center> <button type='submit' class='save-button'>Save Recipe</button> </center> 
              </form>";
    } else {
        echo "<p>Recipe not found.</p>";
    }
    
    $conn->close();
}
?>

<footer>
    <p>&copy; 2024 SetGhalya. All rights reserved.</p>
    <p>
        <a href="#">Privacy Policy</a> | 
        <a href="#">Terms of Service</a>
    </p>
</footer>

</body>
</html>
