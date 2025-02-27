<?php
  session_start();  //check if the user logged to prevent him from reinserting his informations
  if (!isset($_SESSION['uid'])) {

    header("Location: login.php");
    exit(); 
  } // Redirect to login page if not logged in
$uid=$_SESSION['uid'];
 
  include "yabconn.php";
  



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
.m{
display:flex;
justify-content: space-around;
}
.e1,.e2,.e3{
background-color:rgba(255, 34, 0, 0.285);
height:150px;
width:150px;
border-radius: 15px;
display: flex; 
            justify-content: center; 
            align-items: center;
}
.navbar-header {
    display: flex;
    align-items: center;  /* Centers the logo vertically */
    padding-left: 10px;   /* Adjust spacing from the left */
}

.navbar-brand {
    padding: 0; /* Remove Bootstrap default padding */
    margin: 0;
}

.navbar-brand img {
    max-width: 150px; /* Adjust as needed */
    height: auto;
    margin-left: 0px; /* Moves the image closer to the left */
    margin-top: 0; /* Ensures it is at the top */
}

    </style>
</head>
<body>

<!-- Container Fluid -->
<div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-default text-center">
        <div class="container-fluid">
            <!-- Brand Image -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                <img src="images/to-list logo.png" alt="Brand Logo" class="img-responsive">
                </a>
            </div>
            <!-- Logout Button -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="text-center" style="margin-top: 10px;">
                        <img src="user-icon.jpg" alt="User Icon" class="img-circle" style="width: 50px; height: 50px;"> <!-- Replace with your user icon -->
                        <br>
                        <a href="logout.php">
                            <button class="btn btn-danger navbar-btn" style="margin-top: 5px;">Logout</button>
                        </a>
                        
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Jumbotron Section -->
    <div class="jumbotron text-center" style="background-color: #1edbdb;">

<?php
$uid=$_SESSION['uid'];//the code*
$q="SELECT firstname,lastname,email,password,department FROM personalinfor WHERE UID=$uid";
$result=mysqli_query($connection, $q);
$row=mysqli_fetch_assoc($result);


echo "<table>";
    echo "<tr>";
    echo "<td style='padding-left: 470px;'><h1>Hello</h1></td>";
    echo "<td style='padding-left: 20px;'><h1>{$row['firstname']}</h1></td>"; // Adding left padding for space
    echo "</tr>";
    echo "</table>";
    ?>
        <h2>Welcome to Our Web Application!</h2>
        <p>This web application is designed to boost your productivity and help you stay organized. With features like a Pomodoro timer for effective time management, a to-do list for tracking tasks, and a progress tracker to visualize your achievements, it provides a comprehensive solution for managing your daily activities. Enjoy a user-friendly interface that makes task management effortless! Feel free to adjust any part of it to better fit your vision!</p>
    </div>
    
    
</div>


<div class="jumbotron" style="background-color: rgba(26, 82, 223, 0.9);">
    <center><h2 style="margin-top:10px;margin-bottom:20px;">App Features</h2></center>
    <center><p>Explore the features, customize your settings, and enjoy a seamless experience!</p></center>
    <div class="m">
        <div class="e1" style="text-align:center;">
            <a href="pomodoro/Untitled-1.php">
                <img src="images/pomo.png" style="height:140px; width:140px; border-radius: 15px;">
            </a>
        </div>
        <div class="e2" style="text-align:center;">
            <a href="to-do list.php">
                <img src="images/todo.png" style="height:140px; width:140px; border-radius: 15px;">
            </a>
        </div>
        <div class="e3" style="text-align:center;">
            <a href="to-do list/to-do list.php">
                <img src="images/track.png" style="height:140px; width:140px; border-radius: 15px;">
            </a>
        </div>
    </div>
</div>


<div id="contact"class="container-fluid">
    <div class="row" class="fixed-row"style="background-color:#0c1084b7; border-radius: 10px; padding: 10px; margin: 1px 0;">
    <h2 id="skills" class="text-center"style="margin-bottom: 25PX;;"><strong>Contact As.</strong></h2>
    <div class="row text-center">
        <div class="col-xs-6 col-md-3">
            <a href="https://github.com/Yabowerk/Yabowerk/tree/main" target="_blank">
                <img src="https://img.icons8.com/ios-filled/50/000000/github.png" alt="GitHub" />
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="https://t.me/yourusername" target="_blank">
                <img src="https://img.icons8.com/ios-filled/50/000000/telegram-app.png" alt="Telegram" />
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="https://facebook.com/yourusername" target="_blank">
                <img src="https://img.icons8.com/ios-filled/50/000000/facebook-new.png" alt="Facebook" />
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="mailto:youremail@example.com">
                <img src="https://img.icons8.com/ios-filled/50/000000/email.png" alt="Email" />
            </a>
        </div>
       <STRONG><center STYLE="font-size:18px;">2017EC/2024GC &COPY</center></STRONG> 
    </div>
</div>

<style>
    .contact-icons a {
        margin: 0 15px;
        font-size: 30px;
        color: black;
        transition: color 0.3s;
    }
    .contact-icons a:hover {
        color: #007bff;
    }
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>

