<?php include "header.php";
include_once('config.php');
$id = $_GET['id'];

$quer = "SELECT * FROM category WHERE category_id='{$id}'";
$slctQuery = mysqli_query($conn, $quer);
$row = mysqli_fetch_assoc($slctQuery);
$category = $row['category_name'];

if (isset($_POST['update_cat'])) {
    $category_name = $_POST['cat_name'];
    $sql = "UPDATE category SET `category_name` = '{$category_name}' where category_id='{$id}'";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    if ($result) {
        header("Location:category.php");
    } else {
        echo "<script>alert('Facing some error..Please try again')</script>";
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" class="form-control" value="<?php echo $category ?>" placeholder="" required>
                    </div>
                    <input type="submit" name="update_cat" class="btn btn-primary" value="Update" required />
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>