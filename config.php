<?php

   // Database configuration    
   $hostname = "localhost"; 
   $username = "c1035665"; 
   $password = "Tarun123"; 
   $dbname   = "tradesmandb";
    
   // Create database connection 
   $con = new mysqli($hostname, $username, $password, $dbname); 
    
   // Check connection 
   if ($con->connect_error) { 
       die("Connection failed: " . $con->connect_error); 
   }

?>