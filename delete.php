<?php
    session_start(); //starts the session
	include('conexion.php');
    if($_SESSION['user']){ //checks if user is logged in
    }
    else {
       header("location:index.php"); //redirects if user is not logged in.
    }

    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
	   $link = mysqli_connect($myHost,$myUser,$myPw) or die(mysql_error()); //connect to server
       mysqli_select_db($link,"first_db") or die("cannot connect to database"); //Connect to database
       $id = $_GET['id'];
       mysqli_query($link,"DELETE FROM list WHERE id='$id'");
       header("location:home.php");
    }
?>