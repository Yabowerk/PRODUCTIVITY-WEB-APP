<?php
session_start();
if (!isset($_SESSION['uid'])) { 
    header("Location:../login.php"); 
    exit();
}
include "yabconn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <style>
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
<div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-default text-center navbar-fixed-top" style="margin:0px;border-radius:10px;">
        <div class="container-fluid">
            <!-- Brand Image -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                <img src="../images/to-list logo.png" alt="Brand Logo" class="img-responsive">
                </a>
            </div>
            <!-- Logout Button -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="text-center" style="margin-top: 10px;">
                        <img src="user-icon.jpg" alt="User Icon" class="img-circle" style="width: 50px; height: 50px;"> <!-- Replace with your user icon -->
                        <br>
                        <a href="../logout.php">
                            <button class="btn btn-danger navbar-btn" style="margin-top: 5px;">Logout</button>
                        </a>
                        
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    </div>

<!-- Full-Width Jumbotron Section -->

<div class="jumbotron text-center" style="padding-top: 80px; padding-bottom: 30px; margin-top: 70px; background-color: #1edbdb;">
    <h1>Pomodoro Timer: Boost Your Productivity</h1>
    <p style="margin-top: 20px;">Take control of your time and boost your productivity with our Pomodoro Timer application. Designed to help you stay focused and organized, this tool allows you to set work and break intervals, customize alarm sounds, and visually track your progress with an intuitive circular timer. Whether you're working, studying, or managing tasks, this app is your perfect companion for effective time management. Start your journey toward better focus and efficiency today! This version is concise, engaging, and directly speaks to the user.</p>
</div>



      <div class="container">
        <h1>Pomodoro Timer</h1>
        
        <!-- Circular timer display with SVG -->
        <div class="timer-circle text-center">
            <svg width="150" height="150">
                <circle cx="75" cy="75" r="70" stroke="#e94e77" stroke-width="10" fill="none"></circle>
                <circle id="progress-ring" cx="75" cy="75" r="70" stroke="#4caf50" stroke-width="10" fill="none" stroke-dasharray="440" stroke-dashoffset="440"></circle>
            </svg>
            <div id="timer-display">25:00</div>
        </div>

        <div class="settings">
            <div>
                <label for="work-time">Work Time (minutes):</label>
                <input type="number" id="work-time" value="25" min="1" max="60">
            </div>

            <div>
                <label for="break-time">Break Time (minutes):</label>
                <input type="number" id="break-time" value="5" min="1" max="60">
            </div>

            <div>
                <label for="alarm-sound">Select Alarm Sound:</label>
                <select id="alarm-sound">
                    <option value="audio/beep.mp3">Beep Sound</option>
                    <option value="audio/sound2.mp3">Alarm 2</option>
                    <option value="audio/sound3.mp3">Alarm 3</option>
                </select>
            </div>
        </div>

        <!-- Control Buttons -->
        <button id="start-btn">Start</button>
        <button id="pause-btn">Pause</button> <!-- Pause Button -->
        <button id="reset-btn">Reset</button>

        <!-- Audio elements for sounds -->
        <audio id="alarm-sound-1" src="audio/beep.mp3"></audio>
        <audio id="alarm-sound-2" src="audio/sound2.mp3"></audio>
        <audio id="alarm-sound-3" src="audio/sound3.mp3"></audio>
    </div>

    <!-- About Us Section -->
<div class="container-fluid text-center aboutas" style="margin-top: 30px;background-color: #0c1084b7;margin-left: 10px;margin-right: 10px;border-radius: 10px;">
    <h2>About Us</h2>
    <p>Welcome to our Pomodoro Timer application! We are dedicated to helping you manage your time effectively and efficiently.</p>
    <p>Our mission is to provide you with tools that enhance productivity, allowing you to focus on what matters most. Whether you're studying, working, or just trying to stay organized, our app is designed with you in mind.</p>
    <p>Join us on this journey towards better time management and productivity!</p>
</div>

    <script src="script.js"></script> <!-- Link to your JavaScript file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
