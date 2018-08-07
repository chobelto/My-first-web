<?php
    session_start();
	include('conexion.php');
    if($_SESSION['user']){
    }
    else{ 
       header("location:index.php");
    }

     if($_SERVER['REQUEST_METHOD'] == "POST")
    {
       $details = $_POST['details'];
       $time = strftime("%X"); //time
       $date = strftime("%B %d, %Y"); //date
       $decision = "no";
	
	   $link = mysqli_connect($myHost,$myUser,$myPw) or die(mysql_error()); //connect to server
       
       mysqli_select_db($link,"first_db") or die("Cannot connect to database"); //Connect to database
       foreach($_POST['public'] as $each_check) //gets the data from the checkbox
       {
          if($each_check != null){ //checks if checkbox is checked
             $decision = "yes"; // sets the value
          }
       }

       mysqli_query($link,"INSERT INTO list(details, date_posted, time_posted, public) VALUES ('$details','$date','$time','$decision')"); //SQL query
       header("location:home.php");
    }
    else
    {
       header("location:home.php");
    }
?>