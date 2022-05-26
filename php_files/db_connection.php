<?php
   
   function OpenCon(){
      $dbhost = "localhost";
      $dbuser = "root";
      $dbpass = "Test2000";
      $db = "dbproject";
      
      $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
      
      //echo "Connected successfully";
      return $conn;
   }
   
   function CloseCon($conn){
      $conn -> close();
   } 
   
   
    OpenCon();

?>