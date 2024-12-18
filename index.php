<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Ghalya</title>
    <link rel="stylesheet" href="styleA.css">
    <script src="script.js"></script>
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
    
    <main>
        
        <h2 class="explore-title">Taste the Heart of Egypt: Culinary Adventures by City</h2>
        <div class="categories">
            <?php
            

        $dbhost = 'localhost'; $dbuser='root'; $dbpass=''; $dbname='SetGhalya';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query = "select * from category;";
        $result = mysqli_query($conn, $query);
        if ($result){
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='category'>
                        <a href='list_recipe.php?id={$row['category_id']}'>
                             <div class='circle'>
                                 <img src='{$row['photo']}' alt='{$row['category_name']}'>
                                 <h3>{$row['category_name']}</h3>
                             </div>
                         </a>
                       </div>";
            }
        }
            ?>
            
        </div>

        
<div class="video-section">
   
    <iframe width="600" height="400" src="https://www.youtube.com/embed/PytC6IVP79s" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<div class="music-table" >
<h1>Know More About Egypt</h1>
        <table class="music-table">
            <thead>
                <tr>
                    <th>Instrument</th>
                    <th>Description</th>
                    <th>Sound Characteristics</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Oud</td>
                    <td>A stringed instrument similar to a lute, used in Arabic music.</td>
                    <td>Deep, warm sound with a rich tone.</td>
                </tr>
                <tr>
                    <td>Tabla (Darbuka)</td>
                    <td>A goblet-shaped drum, widely used in Middle Eastern music.</td>
                    <td>Sharp, percussive beats, with a range of tones.</td>
                </tr>
                <tr>
                    <td>Kanun</td>
                    <td>A zither-like instrument with a range of strings.</td>
                    <td>Bright, shimmering sound produced by plucking strings.</td>
                </tr>
                <tr>
                    <td>Nay</td>
                    <td>A reed flute, integral to traditional Arabic music.</td>
                    <td>Soft, breathy, and ethereal tones.</td>
                </tr>
                <tr>
                    <td>Violin</td>
                    <td>Used in Egyptian orchestras, blending with traditional music.</td>
                    <td>Smooth, expressive sound, blending well with other instruments.</td>
                </tr>
                <tr>
                    <td>Riq</td>
                    <td>A small tambourine-like instrument used in Middle Eastern music.</td>
                    <td>Light, jingling sound with sharp rhythmical beats.</td>
                </tr>
                <tr>
                    <td>Mizmar</td>
                    <td>A double-reed wind instrument, similar to an oboe.</td>
                    <td>Loud, shrill sound, often associated with folk dances.</td>
                </tr>
            </tbody>
        </table>
    </div>    
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
