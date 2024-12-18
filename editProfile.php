<?php
    session_start();
    $dbhost = 'localhost'; $dbuser='root'; $dbpass=''; $dbname='SetGhalya';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_REQUEST["username"]) && $_REQUEST["username"]!=""){
        $new_username = $_REQUEST["username"];
        $query = "update user set username='{$new_username}' where user_id={$_SESSION['user_id']}";
        mysqli_query($conn, $query);
        $_SESSION["username"] = $new_username;
    }
   

    if (isset($_REQUEST["password"]) && $_REQUEST["password"]!=""){
        $new_password = $_REQUEST["password"];
        $query = "update user set password='{$new_password}' where user_id={$_SESSION['user_id']}";
        mysqli_query($conn, $query); 
    }

    if (isset($_FILES['pp']) && $_FILES['pp']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['pp']['tmp_name'];
        $file_name = $_FILES['pp']['name'];
        $file_type = mime_content_type($file_tmp);

        // Allowed file types
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $upload_dir = 'images/';

        // Validate file type
        if (in_array($file_type, $allowed_types)) {
            // Generate a unique file name to avoid overwriting
            $new_file_name = uniqid() . "_" . basename($file_name);
            $target_file = $upload_dir . $new_file_name;

            // Move the uploaded file to the target directory
            move_uploaded_file($file_tmp, $target_file);
               

            // Store the file path in the database
            $image_path = $target_file;
            $query = "update user set avatar='{$image_path}' where user_id={$_SESSION['user_id']}";
            mysqli_query($conn, $query);
            $_SESSION['avatar'] = $image_path;
        }
        else{
            echo "invalid file type";
        }
        echo "failed to upload photo";
    }
    

        
    
    header("Location: profile.php");
    exit;
?>