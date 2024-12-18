<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($username) && !empty($email) && !empty($message)) {
        

        header("Location: index.php");
        exit(); 
    } else {
        echo "<script>alert('Please fill in all the required fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styleA.css">
    <script>
        function validateContactForm() {
            const name = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();

            if (name === '') {
                alert('Name is required.');
                return false;
            }
            if (email === '') {
                alert('Email is required.');
                return false;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }
            if (message === '') {
                alert('Message is required.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
            include("header_logged_in.html");
        } else {
            include("header.html");
        }
    ?>

    <main>
        <h2>Contact Us</h2>
        <form id="contactForm" action="contact_us.php" method="POST" onsubmit="return validateContactForm();">
            <label for="username">Your Name:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Send</button>
        </form>
    </main>

    
    <footer>
        <p>&copy; 2024 SetGhalya. All rights reserved.</p>
        <p>
            <a href="#">Privacy Policy</a> | 
            <a href="#">Terms of Service</a> 
        </p>   
    </footer>
</body>
</html>
