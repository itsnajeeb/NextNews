<?php include "header.php";
include_once('config.php');

if(isset($_POST['add_categosy'])){
    $categoryName=$_POST['cat'];
    $sql="INSERT INTO category(category_name) VALUES('{$categoryName}')";
    $query=mysqli_query($conn,$sql);
    if($query){
        header("Location:category.php");
    }
    else{
        echo "Getting some error";
    }
}
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="add_categosy" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
