<?php include "header.php";
include_once('config.php');
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Website settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <?php
                $sql = "SELECT * FROM settings";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                        <form action="save-setting-data.php" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="post_title">Website Name</label>
                                <input type="text" name="website_name" value="<?php echo $row['websitename'] ?>" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Post image</label>
                                <input type="file" name="logo" >
                                <!-- <input type="submit" name="submit" class="btn btn-primary" value="Save" required /> -->
                                <img src="./images/<?php echo $row['logo']; ?>" alt="">
                                <input type="hidden" name="old_logo" value="<?php echo $row['logo'];  ?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Footer Description</label>
                                <textarea name="footerdesc" class="form-control" rows="5" required><?php echo $row['footerdes'] ?></textarea>
                            </div>
                            <button class="btn btn-primary" name="update">UPDATE</button>
                        </form>
                <?php
                    }
                }
                ?>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>