<?php include 'header.php';
include_once('admin/config.php');
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php
                        if(isset($_GET['post_id'])){
                            $id=$_GET['post_id'];
                        $sql = "SELECT * FROM post INNER JOIN category ON post.category=category.category_id INNER JOIN user ON post.author=user.user_id WHERE post.post_id='$id'";
                        $result=mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result)){
                                while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row['title'] ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?php echo $row['category_name'] ?>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row['author'] ?>'><?php echo $row['username'] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date'] ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="<?php echo "admin/upload/".$row['post_img']?>" alt=""/>
                            <p class="description">
                                <?php echo $row['description']; ?>
                            </p>
                        </div>
                        <?php
                          }
                        }
                        }
                        else{
                            header("Location:index.php");
                        }
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
