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
                    if(isset($_GET['aid'])){
                        $aut_id=$_GET['aid'];

                    }
                    else{
                        header("Location:" . $hostname);
                    }
                    $sql = "SELECT * FROM post INNER JOIN user ON post.author=user.user_id where post.author='{$aut_id}' ";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($query)

                    ?>
                    <h2 class="page-heading"><?php echo $row['username'] ?></h2>

                    <?php
                    $offset = 0;
                    $limit = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT * FROM post INNER JOIN category ON post.category=category.category_id INNER JOIN user ON post.author=user.user_id WHERE post.author={$aut_id} ORDER BY post.author DESC LIMIT {$offset}, {$limit}";
                    $result = mysqli_query($conn, $sql) or die("Query Failed : Category");
                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href='single.php?post_id=<?php echo $row['post_id'] ?>'><img src="<?php echo "admin/upload/" . $row['post_img'] ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?post_id=<?php echo $row['post_id'] ?>'><?php echo $row['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $row['category'] ?>'><?php echo $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?php echo $row['author'] ?>'><?php  echo $row['username'];?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 200); ?>
                                            </p>
                                            <a class='read-more pull-right' href="single.php?post_id=<?php echo $row['post_id']; ?>">read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                    <?php
                        if (mysqli_num_rows($query) > 0) {

                            $totalRecord = mysqli_num_rows($query);

                            $totalPage = ceil($totalRecord / $limit);
                            echo "<ul class='pagination admin-pagination'>";
                            if ($page > 1) {
                                echo "<li><a href='author.php?aid='.$aut_id.'&page=" . ($page - 1) . "'>Pre</a></li>";
                            }
                            for ($i = 1; $i <= $totalPage; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class=' . $active . '><a href="author.php?aid=' . $aut_id . '&page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($totalPage > $page) {
                                echo '<li><a href="author.php?aid=' . $aut_id . '&page=' . ($page + 1) . '">Next</a></li>';
                            }
                        }

                        echo "</ul>";
                    } else {
                        echo "<h2 class='text-center'>Post not Available</h2>";
                    }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>