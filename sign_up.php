<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styleA.css">
    <script>
       
function validateSignUpForm() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm-password').value.trim();

   
    if (username === '') {
        alert('Username is required.');
        return false;
    }
    if (username.length < 3) {
        alert('Username must be at least 3 characters long.');
        return false;
    }

    
    if (password === '') {
        alert('Password is required.');
        return false;
    }
    if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        return false;
    }

    
    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true; 
}
    </script>
</head>
<body>
    <?php include("header.html")?>

    <main>
        <h2>Sign Up</h2>
        <form id="signup-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="return validateSignUpForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm_password" required>

            <button type="submit">Sign Up</button>
        </form>
    </main>
    
<?php
$host = 'localhost';
$dbname = 'SetGhalya';
$dbuser = 'root';
$dbpass = '';

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form data is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);

        // Check if passwords match
        if ($password !== $confirmPassword) {
            echo "<p>Passwords do not match.</p>";
            exit;
        }

        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            echo "<p>Username already exists. Please choose a different one.</p>";
        } else {
            
            $stmt = $pdo->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);

            echo "<p>Sign-up successful. You can now log in.</p>";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
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
