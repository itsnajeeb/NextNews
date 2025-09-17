<?php include "header.php"; ?>
<?php
include_once('config.php');
$id=$_GET['id'];
$sql="SELECT * FROM user WHERE user_id='$id'";
$query=mysqli_query($conn,$sql) or die("Query Failed");
$row=mysqli_fetch_assoc($query);
if(isset($_POST['update'])){
    echo $userid= mysqli_real_escape_string($conn, $_POST['user_id']); echo"<br>";
    echo $fname= mysqli_real_escape_string($conn, $_POST['f_name']); echo"<br>";
    echo $lname= mysqli_real_escape_string($conn, $_POST['l_name']); echo"<br>";
    echo $username= mysqli_real_escape_string($conn, $_POST['username']); echo"<br>";
    echo $role= mysqli_real_escape_string($conn, $_POST['role']); echo"<br>";
    $sql="UPDATE user SET `first_name`='{$fname}', `last_name`='{$lname}', `username`='{$username}', `role`='{$role}' WHERE user_id='{$userid}'";
   $updQuery= mysqli_query($conn,$sql) or die("Update query Failed");
   if($updQuery){
    echo "Result Updated Successfully";
    header("Location:users.php");
   }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php
                                if($row['role']==1){
                                        echo "<option value='1' selected >Admin</option>
                                              <option value='0'>Normal</option>";
                                }
                                else{
                                    echo "<option value='1'>Admin</option>
                                    <option value='0' selected>Normal</option>";                             }
                          ?>
                          </select>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php 
                  ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
