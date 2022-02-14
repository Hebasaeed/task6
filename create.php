<?php

require 'helper.php';
require 'dbconnection.php';



if($_SERVER['REQUEST_METHOD']=="POST"){
    $title    =  Clean($_POST['title'],1,0);
    $content  =  Clean( $_POST['content'],1,0);
    $date =  Clean($_POST['date'],0,2);
    


$errors=[];
#validate >>title 
if(empty($title)){
    $errors['errortitle']='required title';
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


// image   
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_FILES['image']['name'])) {

        $imgName  = $_FILES['image']['name'];
        $imgTemp  = $_FILES['image']['tmp_name'];//path
        $imgType  = $_FILES['image']['type'];   
/// search ext.
        $nameArray =  explode('.', $imgName);
        $imgExtension =  strtolower(end($nameArray));

        $imgFinalName = time() . rand() . '.' . $imgExtension;

        $allowedExt = ['png', 'jpg'];

        if (in_array($imgExtension, $allowedExt)) {
            

            $disPath = 'uploadsimg/' . $imgFinalName;

            if (move_uploaded_file($imgTemp, $disPath)) {
                echo 'File Uploaded'.'<br>';
            } else {
                echo 'Error In Uploading Try Again';
            }
        } else {
            echo 'InValid Extension';
        }
    } else {

        echo ' Image Required';
    }
}



//////////////////////////
#check
if(count($errors)>0){
    foreach($errors as $key=>$value){
        echo $key.' = '.$value .'<br>';
    }

}else{
   // echo 'valid data ...successful'.'<br>';
 
   $sql = "insert into blog (title,content,date) values ('$title','$content','$date')";
    $op = mysqli_query($con,$sql);
    if($op){
        echo 'raw inserted';
    
    }else{
        echo 'error try again =>'. mysqli_error($con);
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" enctype="multipart/form-data" >

            <div class="form-group">
                <label for="exampleInputName">title</label>
                <input type="text" class="form-control" id="exampleInputName"   required aria-describedby=""   name="title" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">content </label>
                <input type="text" class="form-control" id="exampleInputEmail1"  required aria-describedby="emailHelp" name="content" placeholder="Enter title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">date </label>
                <input type="text" class="form-control" id="exampleInputEmail1"  required aria-describedby="emailHelp" name="date" placeholder="Enter date">
            </div>


            <h2>Upload File</h2>
            
            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn btn-primary">submit</button>
        </form>
    </div>


    <br>

</body>

</html>  
 
