<?php
session_start();
include ('config.php');
if(isset($_FILES['fileToUpload'])){
    $error=array();
     $filename = $_FILES['fileToUpload']['name'];
     $filetype = $_FILES['fileToUpload']['type'];
     $tmp= explode(".", $filename);
     $file_ext=  end($tmp);
     $filesize=$_FILES['fileToUpload']['size'];
     $tempname=$_FILES['fileToUpload']['tmp_name'];

    $extention=array("jpeg", "jpg", "JPG", "png");
    if(in_array($file_ext,$extention)===false){
         $error[]="This extention file not allowed, Please choose only jpeg, jpg, png";
    }
    if($filesize > 2097152){
        echo $error="File sieze is to large. Please Upload maximum 2MB";
    }
    if(empty($error)== true){
        move_uploaded_file($tempname,"upload/".$filename);
    }else{
        echo $error[]="we facing some error to uploading pic.. please try again";
        die();
    }
}
$title=mysqli_real_escape_string($conn, $_POST['post_title']);
$description=mysqli_real_escape_string($conn, $_POST['postdesc']);
$category=mysqli_real_escape_string($conn, $_POST['category']);
$date=date("d M Y");
echo $author=$_SESSION['user_id'];
 $sql="INSERT INTO post(title, description, category, post_date, author, post_img) VALUES('{$title}','{$description}', {$category}, '{$date}', {$author},'{$filename}');";

 $sql.="UPDATE category SET post = post + 1 WHERE category_id  ='{$category}'";
if(mysqli_multi_query($conn,$sql)){
    header("Location:".$hostname."/admin/post.php");
}else{
    echo "Query failed";
}