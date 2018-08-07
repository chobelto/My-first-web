<?php
    session_start();
	include('conexion.php');
	$username = $_POST['username'];
    $password = $_POST['password'];
    
    $bool = true;
	$link = mysqli_connect($myHost,$myUser,$myPw) or die(mysql_error()); //connect to server
	
    
    
	mysqli_select_db($link,"first_db") or die("Cannot connect to database"); //Connect to database
	
    
	$query = mysqli_query($link, "Select * from users WHERE username='$username'"); //Query the users table
    
	$exists = mysqli_num_rows($query);
    $table_users = "";
    $table_password = "";
    if($exists > 0) //IF there are no returning rows or no existing username
    {
       while($row = mysqli_fetch_assoc($query)) // display all rows from query
       {
          $table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
          $table_password = $row['password']; // the first password row is passed on to $table_password, and so on until the query is finished
       }
       if(($username == $table_users) && ($password == $table_password))// checks if there are any matching fields
       {
          if($password == $table_password)
          {
             $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
             header("location: home.php"); // redirects the user to the authenticated home page
          }
       }
       else
       {
        Print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
       }
    }
    else
    {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
?>