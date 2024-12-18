<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style_profile.css"> 
</head>
<body>
<?php include("header_logged_in.html") ?>

    
    
    
    <div class="profile-container">
        
        <div class="profile-header">
            <?php echo "<img src='{$_SESSION['avatar']}' alt='Profile Image' class='profile-image' id='profileImage'>";?>
            <?php echo "<p class='profile-username' id='username'>{$_SESSION['username']}</p>";?>
        </div>

       
        <div class="saved-recipes">
        <h2> Saved Recipes</h2>
            <ul>
                <?php 
                    $dbhost = 'localhost'; $dbuser='root'; $dbpass=''; $dbname='SetGhalya';
                    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $query = " select recipe_name, recipe_id from recipe where recipe_id in (select recipe_id from user_recipe where user_id=".$_SESSION["user_id"].")";
                    $result = mysqli_query($conn, $query);
                    if ($result){
                        while ($row = mysqli_fetch_assoc($result)){
                           echo "<li><a href='recipe.php?id={$row['recipe_id']}'>{$row["recipe_name"]}</a>
                           <form style='margin: initial; padding: initial; border: initial; border-radius: initial; background-color: initial' method='POST' action='removeRecipe.php'>
                           <input type='hidden' name='recipe_id' value='{$row['recipe_id']}'>
                           <button type='submit' class='remove-recipe'>Remove</button>
                           </form>
                           </li>";
                        } 
                    }
                ?>
            </ul>
        </div>

        <div class="add-recipe">
            <h2>Add Recipe</h2>  
            <form method='POST' action="addRecipe.php" enctype="multipart/form-data" style='margin: initial; padding: initial; border: initial; border-radius: initial; background-color: initial'>
            <label for="recipe-name">Recipe Name:</label>
            <input type="text" name="recipe-name" id="recipe-name" placeholder="Enter Recipe Name">

            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" placeholder="Enter Ingredients" required></textarea>

            <label for="instructions">Instructions:</label>
            <textarea id="instructions" name="instructions" placeholder="Enter Instructions" required></textarea>

            <label for="recipe-image">Recipe Image:</label>
            <input type="file" name="recipe-image" id="recipe-image">

            <label for="category">Recipe Category:</label>
            <select name="category" id="vategory" style="width: 92%; padding: 10px; margin-bottom: 15px; border: 1px solid #000000; border-radius: 5px;">
            <option value="1">Alexandria</option>
            <option value="2">Cairo</option>
            <option value="3">Aswan</option>
            <option value="4">Luxor</option>
            <option value="5">Port Said</option>
            <option value="6">Ismalia</option>
            </select>
            
            <label for="calories">Calories:</label>
            <input type="number" name="calories" id="calories" placeholder="Enter Calories">

            <button type='submit'>Save Recipe</button>
            </form>
        </div>

        

        <div class="edit-profile">
            <h2>Edit Profile</h2>
            <form method="POST" action="editProfile.php" enctype="multipart/form-data" style='margin: initial; padding: initial; border: initial; border-radius: initial; background-color: initial'>
                <label for="profile-picture">Change Profile Picture:</label>
                <input type="file" id="profile-picture" name="pp">

                <label for="username">Change Username:</label>
                <input type="text" id="username" name="username" placeholder="New Username">

                <label for="password">Change Password:</label>
                <input type="password" id="password" name="password" placeholder="New Password">
                <button type='submit' name='submit' class="save-changes">Save Changes</button>
            </form>
        </div>  
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