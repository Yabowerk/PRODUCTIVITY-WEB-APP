<?php
include('yabconn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        .jumbotron {
            width: 50%;
            height: auto; /* Adjust height based on content */
            background-color: rgba(30, 196, 113, 0.5);
            margin: 0 auto;
            transition: all 0.3s ease; /* Smooth transition for hover effects */
            border-radius: 10px; /* Add rounded corners */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow by default */
        }
        .jumbotron:hover {
            background-color: rgba(30, 196, 113, 0.7); /* Darker green on hover */
            transform: scale(1.02); /* Slightly enlarge the container on hover */
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
        }
        body {
            background-image: url('path/to/your/image.jpg'); /* Replace with the path to your image */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Prevent repeating */
            height: 100vh; /* Ensure full height */
            margin: 0; /* Remove default margin */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-default text-center navbar-fixed-top" style="margin:0px;border-radius:10px;">
        <div class="container-fluid">
            <!-- Brand Image -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img src="brand-logo.png" alt="Brand Logo" style="width: 100px; height: auto;"> <!-- Replace with your logo -->
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid custom-container" style="margin-top: 60px;">
        <!-- Jumbotron with Hover Effect -->
        <div class="jumbotron" style="margin-top: 10%;">
            <center><h1>SIGN IN</h1></center>
            <div class="panel-body">

                <?php
                // Check if form data is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Get the form data from POST request

                    $firstname = $_POST['firstName'];
                    $lastname = $_POST['lastName'];
                    $email = $_POST['email'];
                    $psw = $_POST['password'];
                    $dep = $_POST['department'];
                  
                  
                   
                   
                
                    // Prepare an SQL query to insert data into the database
                    $sql = "INSERT INTO personalinfor(firstname,lastname,email,password,department) VALUES ('$firstname','$lastname','$email','$psw','$dep')";
                
                    // Execute the query
                    if (mysqli_query($connection, $sql)) {
                        echo "YOU HAVE SIGNED IN SUCCESSFULLY!! PRESS THE LOGIN BUTTON";
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }
                
                    // Close the database connection
                    mysqli_close($connection);
                }
                ?>












                <form role="form" action="signin.php" method="POST"> <!-- Update action as needed -->
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="First Name" name="firstName" type="text" required autofocus="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Last Name" name="lastName" type="text" required="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="enter your email" name="email" type="email" required="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" required="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Department (Type here)" name="department" type="text" required="">
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox"> Remember Me
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="container">
                            <div class="row">
                                <!-- Change Login button to link -->
                                <div class="col-sm-6">
                                    <a href="login.php" class="btn btn-lg btn-success btn-block">Login</a> <!-- Update URL to your login page -->
                                </div>
                                <!-- Optional Sign Up Button -->
                                <div class="col-sm-6">
                                   <button type="submit" class="btn btn-lg btn-info btn-block">Sign Up</button><!-- Link to sign up page if needed -->
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div> 
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="asset/jquery.min.js"></script> 
    <script src="asset/bootstrap/js/bootstrap.min.js"></script> 
</body>
</html>
