<?php
include_once('config.php');
if (empty($_FILES['logo']['name'])) {
    $file_name = $_POST['old_logo'];
} else {
    $error = array();
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
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
        move_uploaded_file($file_temp, "images/" . $file_name);
    } else {
        print_r($error);
        die();
    }
}

$sql = "UPDATE `settings` SET `websitename`='{$_POST["website_name"]}', `logo` = '{$file_name}', `footerdes` = '{$_POST["footerdesc"]}' ";
$query = mysqli_query($conn, $sql);
if ($query) {
    header("Location:" . $hostname . "admin/post.php");
} else {
    echo mysqli_error($conn);
    echo "Note updated";
}
?>