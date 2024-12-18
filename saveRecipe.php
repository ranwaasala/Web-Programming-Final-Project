<?php 
    session_start();
    $user_id;
    $recipe_id;


    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
            $user_id = $_SESSION["user_id"];
    }
    else{
        header("Location: sign_up.html");
        exit;
    }

    if(!empty($_REQUEST)){
        $recipe_id = $_REQUEST["recipe_id"];
    }  

    if(isset($user_id) && isset($recipe_id)){
        $dbhost = 'localhost'; $dbuser='root'; $dbpass=''; $dbname='SetGhalya';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $isSavedQuery = "select * from user_recipe where user_id={$user_id} AND recipe_id={$recipe_id}";
        $result = mysqli_query($conn, $isSavedQuery);
            if ($result && $result->num_rows === 0){
                $query = "insert into user_recipe (user_id, recipe_id) values ({$user_id}, {$recipe_id})";
                mysqli_query($conn, $query);
            }
            else{
                header("Location: recipe.php?id={$recipe_id}&msg=You have already saved this recipe!");
                exit();
            }
            header("Location: recipe.php?id={$recipe_id}");
    }
    
    
?>