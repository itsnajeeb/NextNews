<?php
include_once('config.php');
$id=$_GET['id'];
$sql="DELETE FROM category WHERE category_id='{$id}'";
$result=mysqli_query($conn,$sql) or die("Query Failed");
if($result){
    echo "<script>alert('Category deleted Successfully ');</script>";
    header("Location:category.php");
}
else{
    echo "<script>alert('Data not deleted')</script>";
}
?>