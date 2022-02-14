<?php

session_start();
$server="localhost";
$dbName="blog";//in my sql
$dbUser="root";//default
$dbPassword="";//default
$con= mysqli_connect($server,$dbUser,$dbPassword,$dbName);

if(!$con){
    die ('ERROR  : ' . mysqli_connect_error());
}