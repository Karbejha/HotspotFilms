<?php
  $conn = mysqli_connect("localhost","root","","sourcecodester_omsdb");
  if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
?>
