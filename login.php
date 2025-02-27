<?php
  include "yabconn.php";
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" style="margin:0px;border-radius:10px;">
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
                <div class="container-fluid text-center" style="margin-top: 10px; margin-right:10px;">
                    <img src="user-icon.jpg" alt="User Icon" class="img-circle" style="width: 50px; height: 50px;">
                    <br>
                    <button class="btn btn-danger navbar-btn" style="margin-top: 5px;">Logout</button>
                </div>
            </li>
        </ul>
    </div>
</nav>


    <div class="container-fluid custom-container" style="margin-top: 60px;">
      <div class="jumbotron" style="margin-top: 10%;">
       <center><h1>LOGIN</h1></center>
        <div class="panel-body">


    
        
        <?php
        //This code prevents SQL injection by using prepared statements. Instead of directly putting user input into the SQL query, it uses placeholders (?) and binds the actual input later with bind_param(). This ensures that the input is treated as plain data, not executable SQL code
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize user input
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $psw = $_POST['password'];
        
            // Use a prepared statement
            $stmt = $connection->prepare("SELECT * FROM personalinfor WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Check if the password matches
                if ($psw == $row['password']) { // Direct comparison (NOT RECOMMENDED)
                    $_SESSION['uid'] = $row['uid'];
                    header("Location: ai.php");
                    exit();
                } else {
                    // Specific message for incorrect password
                    echo "INCORRECT PASSWORD";
                }
            } else {
                // Specific message for unregistered email
                echo "UNREGISTERED EMAIL";
            }
        
            $stmt->close(); // Close the prepared statement
        }
        ?>











            <form role="form" action="login.php" method="POST">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                        </label>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                     <div class="container">
                        <div class="row">
                        <div class="col-sm-6">
    <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
</div>

                            <div class="col-sm-6"><a href="signin.php" class="btn btn-lg btn-success btn-block">Sign In</a></div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div> 
      </div> 
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="asset/jquery.min.js"></script> 
    <script type="text/javascript" src="asset/bootstrap/js/bootstrap.min.js"></script> 
</body>
</html>
