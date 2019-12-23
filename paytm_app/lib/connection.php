<?php
 $con = mysqli_connect('localhost','heylaapp_app','O+E7vVgBr#{}','heylaapp_app');
 if (mysqli_connect_errno()) // Check connection
  {   
      echo "Failed to connect to MySQL: " . mysqli_connect_error();  
  } else {
      //echo "Connected";
  }
?>