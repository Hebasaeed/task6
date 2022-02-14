<?php 

require 'dbConnection.php';

 $id = $_GET['id'];

 $sql = "delete from blog where id = $id";

 $op = mysqli_query($con,$sql);


 if($op){
    $Message =  'Raw Removed';
 }else{
    $Message = 'Error Try Again';
 }
 

  $_SESSION['Message'] = $Message;


   header("location: index.php");


?> 