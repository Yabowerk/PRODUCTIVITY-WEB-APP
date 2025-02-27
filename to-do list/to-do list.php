<?php
session_start();
if (!isset($_SESSION['uid'])) { 
    header("Location:../login.php"); 
    exit();
}
include "../yabconn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="Untitled-1.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
</head>
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
<body>
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

    <!-- Full-Width Jumbotron Section -->

<div class="jumbotron text-center" style="padding-top: 80px; padding-bottom: 30px; margin-top: 100px;background-color: #1edbdb;">
    <h1>Effortlessly Manage Your Tasks</h1>
    <p>Here, you can take control of your tasks with our intuitive To-Do List feature. Effortlessly add new tasks, mark them as complete, and keep everything organized at your fingertips. Plus, with our Progress Tracker, you'll gain valuable insights into your productivity by monitoring your total tasks, completed items, and overall progress percentage. Let’s enhance your efficiency and help you achieve your goals!</p>
    <p>Explore the features, customize your settings, and enjoy a seamless experience!</p>
</div>
</div>

    <div class="container-fluid todo"style="margin-top:25px;margin-left:20px;margin-right:20px;">
        <center><h1>To-Do List</h1></center>
        <input type="text" id="task-input" placeholder="Add a new task..." />
        <button id="add-task-btn"><i class="fas fa-plus"></i></button> <!-- Plus icon for adding tasks -->
        
        <ul id="task-list"></ul> <!-- Task list will be populated here -->

        <div class="progress-tracker">
            <h2>Progress Tracker</h2>
            <table id="progress-table">
                <thead>
                    <tr>
                        <th>Total Tasks</th>
                        <th>Completed Tasks</th>
                        <th>Progress (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="total-tasks">0</td>
                        <td id="completed-tasks">0</td>
                        <td id="progress-percentage">0%</td>
                    </tr>
                </tbody>
            </table>
            <canvas id="progress-chart" width="400" height="200"></canvas>
        </div>

    </div>
    <div class="container-fluid" style="margin-top: 30px;">
        <div class="jumbotron text-center">
            <h2>Contact Us</h2>
            <p>If you have any questions or feedback, please fill out the form below:</p>
            

            <?php
            // Check if form data is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get the form data from POST request

                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];
             
              
              
               
               
            
                // Prepare an SQL query to insert data into the database
                $sql = "INSERT INTO contactus(name,email,message) VALUES ('$name','$email','$message')";
            
                // Execute the query
                if (mysqli_query($connection, $sql)) {
                    echo "New user added successfully!";
                } else {
                    echo "Error: " . mysqli_error($connection);
                }
            
                // Close the database connection
                mysqli_close($connection);
            }
            ?>


            <form style="max-width: 600px; margin: 0 auto;"role="form" action="to-do list.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Enter your message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script src="todo.js"></script> <!-- Link to your JavaScript file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
