<?php
$server="localhost";
$user="root";
$password="";
$database="productivity";

$connection=mysqli_connect($server,$user,$password,$database);
if(!$connection){
die("unable to connect with the database");

}

?>