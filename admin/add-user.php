<?php include "header.php"; ?>
<?php
include_once('config.php');

if (isset($_POST['save'])) {
    // echo "<script>alert('Clicked')</script>";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['user'];
    $password = $_POST['password'];
    $rol = $_POST['role'];

    $seleQuery = 'SELECT * FROM user';
    $result = mysqli_query($conn, $seleQuery);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($username == $row['username']) {
                echo "<script language='javascript'>alert('Username already exist');window.location='users.php';</script>";
                exit;
            }
        }
    }
   
    $sql = "INSERT INTO user(first_name, last_name, username, password, role) VALUES('{$fname}', '{$lname}', '{$username}', '{$password}', '{$rol}')";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    echo '<script language="javascript">';
                    echo 'alert("Data Inserted Successfully !")';
                    echo '</script>';
                    header("Location:users.php");
                } else {
                    echo "<script>alert('Data not inserted ')</script>";
                }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>