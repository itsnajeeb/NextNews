<?php
include_once('config.php');
$id=$_GET['id'];
$sql="DELETE FROM post WHERE post_id = '{$id}'";
$result=mysqli_query($conn,$sql);
if($result){
    header("Location:".$hostname."/admin/post.php");
}
else{
    echo "<script>alert('Ddata not delete ')</script>";
}
?>