<?php 
  //connect
  $connect = mysqli_connect("localhost", "zeika", "passwordis123", "pizza_statement");
  //check connection
  if(!$connect) {
    echo "connect fail: ".mysqli_error;
  }
 	
 ?>