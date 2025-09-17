<?php 
include("config.php");
$id=$_GET['id'];
$sql="DELETE  FROM user where user_id=$id";
$query=mysqli_query($conn, $sql) or die("Delete Query failed ");
if($query){
    header("Location:users.php");
}
else{
    echo "Data not delete";
}
?>