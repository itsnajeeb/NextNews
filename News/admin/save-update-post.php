<?php
include_once('config.php');
if (empty($_FILES['new_image']['name'])) {
    $file_name = $_POST['old_image'];
} else {
    $error = array();
    $file_name = $_POST['new_image']['name'];
    $file_size = $_POST['new_image']['size'];
    $file_temp = $_POST['new_image']['tmp_name'];
    $file_type = $_POST['new_image']['type'];
    $exp = explode(',', $file_name);
    $file_ext = end($exp);

    $extention = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $extention) === false) {
        $error[] = "This extention file not allowed, please choose a JPG or PNG file";
    }
    if ($file_size > 2097152) {
        $error[] = "File Size must be 2MB or lower";
    }
    if (empty($error) == true) {
        move_uploaded_file($file_temp, "upload/" . $file_name);
    } else {
        print_r($error);
        die();
    }
}
$post_id = $_POST['post_id'];
$title = $_POST['post_title'];
$postdesc = $_POST['postdesc'];
$category = $_POST['category'];


// echo $category=mysqli_real_escape_string($conn, $_POST['category']);

$sql = "UPDATE `post` SET `title`='{$title}', `description`='{$postdesc}', `category`='{$category}' WHERE `post_id`='{$post_id}'";
// $sql.="UPDATE category SET post = post + 1 WHERE category_id  ='{$category}'";
// echo $sql;
$query = mysqli_query($conn, $sql);
if ($query) {
    header("Location:" . $hostname . "admin/post.php");
} else {
    echo mysqli_error($conn);
    // echo "<script>alert('Post Not update')</script>";
    // header("Location:".$hostname."/admin/update-post.php");
    echo "Note updated";
}
