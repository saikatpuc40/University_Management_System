<?php
include '../connection.php';

if(isset($_POST['confirm_delete'])){
    $id=$_POST['user_id'];
    echo $id;
    $sql= "DELETE FROM students where id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo 'Successfully Delete';
    }
    else{
        echo 'NOt Successful';
    }
}


?>