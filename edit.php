<?php

require 'dbConnection.php';
require 'helper.php';



$id = $_GET['id'];

$sql = "select id,title,content,date from blog where id = $id";
$op  = mysqli_query($con,$sql);

$data= mysqli_fetch_assoc($op); 







if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['title']);
    $title    = Clean($_POST['title'],1,0);
    $content   = Clean($_POST['content'],0,2);


    # Validate ...... 

    $errors = [];

# validate title
    if (empty($title)) {
        $errors['title'] = "Field Required";
    } elseif (!filter_var($title, FILTER_SANITIZE_STRING)) {
        $errors['title']   = "Invalid title";
    }
    

#validate >> content
if(empty($content))
{
    $errors['errorcontent']='required content';
}elseif(strlen($content)<50){
    $errors['errorcontent']='length must be >50 character';  

}
#validate >>date
if(empty($date)){
    $errors['errordate'] = "Field Required"; 

}
   


    


    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

        # DB CODE .......  

        $sql = "update blog set title = '$title' , content= '$content' , date='$date' where  id = $id";

        $op  =  mysqli_query($con,$sql);


        if($op){

          $_SESSION['Message']  = 'Raw Updated'; 

          header("Location: index.php");



        }else{
            echo 'Error Try Again '.mysqli_error($con);
        }

        mysqli_close($con);

    }
}




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Edit Account</h2>

        <form action="edit.php?id=<?php echo $id;?>" method="post">

            <div class="form-group">
                <label for="exampleInputName">title</label>
                <input type="text" class="form-control" required id="exampleInputTitle" aria-describedby="" name="title"  value= "<?php echo $data['title'];?>"  placeholder="Enter title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">content</label>
                <input type="email" class="form-control" required id="exampleInputContent" aria-describedby="contentHelp" name="content" value= "<?php echo $data['content'];?>" placeholder="Enter content">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">date</label>
                <input type="date" class="form-control" required id="exampleInputDate" aria-describedby="dateHelp" name="date" value= "<?php echo $data['date'];?>" placeholder="Enter date">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>


</body>

</html> 