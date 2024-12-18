<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styleA.css">
    <script>
        
function validateSignInForm() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    
    if (username === '') {
        alert('Username is required.');
        return false;
    }

    
    if (password === '') {
        alert('Password is required.');
        return false;
    }

    return true; 
}

        </script>
</head>
<body>
<?php include("header.html")?>

    
    <main>
        <h2>Sign In</h2>
        <form id="signin-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <!-- ghayart el email bel username ⚠️⚠️ -->
            <label for="username">Username:</label> 
            <input type="username" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Sign In</button>
        </form>
    </main>
     
    
    
    <?php 
        if (!empty($_REQUEST)){
            $dbhost = 'localhost'; $dbuser='root'; $dbpass=''; $dbname='SetGhalya';
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $query = "select * from user where username='".$_REQUEST["username"]."'";
            $result = mysqli_query($conn, $query);
            if ($result && $result->num_rows !== 0){
                $row = mysqli_fetch_assoc($result);
                if($_REQUEST["password"] == $row["password"]){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['user_id'] = $row["user_id"];
                    $_SESSION['avatar'] = $row["avatar"];
                    header("Location: profile.php");
                    exit;
                }
                else{
                    echo "<p>Incorrect Password</p>";
                }
            }
            else{
                echo "<p>We couldn't find an account with that username. <a href='sign_up.html'> Sign up instead? </a></p>";
            }
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