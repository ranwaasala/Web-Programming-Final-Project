<?php
    session_start();

    $dbhost = 'localhost'; $dbuser = 'root'; $dbpass = ''; $dbname = 'SetGhalya';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_REQUEST["ingredients"], $_REQUEST["instructions"], $_REQUEST["category"], $_REQUEST["calories"], $_REQUEST["recipe-name"])) {
        if ($_REQUEST["ingredients"] !== "" && $_REQUEST["instructions"] !== "" && $_REQUEST["category"] !== "" && $_REQUEST["calories"] !== "" && $_REQUEST["recipe-name"] !== "") {
            if (isset($_FILES['recipe-image']) && $_FILES['recipe-image']['error'] === UPLOAD_ERR_OK) {
                
                $file_tmp = $_FILES['recipe-image']['tmp_name'];
                $file_name = $_FILES['recipe-image']['name'];
                $file_type = mime_content_type($file_tmp);

                // Allowed file types
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                $upload_dir = 'images/';

                if (in_array($file_type, $allowed_types)) {
                    $new_file_name = uniqid() . "_" . basename($file_name);
                    $target_file = $upload_dir . $new_file_name;
                    move_uploaded_file($file_tmp, $target_file);

                    $image_path = $target_file;

                    // Use prepared statement to insert data
                    $stmt = $conn->prepare("INSERT INTO recipe (recipe_name, ingredients, instructions, photo, category_id, calories, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssiii", $recipe_name, $ingredients, $instructions, $photo, $category_id, $calories, $user_id);

                    // Bind user inputs
                    $recipe_name = $_REQUEST['recipe-name'];
                    $ingredients = $_REQUEST['ingredients'];
                    $instructions = $_REQUEST['instructions'];
                    $photo = $image_path;
                    $category_id = $_REQUEST['category'];
                    $calories = $_REQUEST['calories'];
                    $user_id = $_SESSION["user_id"];

                    $stmt->execute();
                    $stmt->close();

                    header("Location: profile.php");
                }
            }
        }
    }
?>
