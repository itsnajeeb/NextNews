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
                    $limit = 3;

                    // echo $page=$_GET['page'];
                    if(isset($_GET['page'])){
                        $page=$_GET['page'];
                    }
                    else{
                        $page=1;
                    }
                    $offset=($page-1)*$limit;
                    $sql = "SELECT * FROM post INNER JOIN category ON post.category=category.category_id INNER JOIN user ON post.author=user.user_id LIMIT $offset,$limit";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // echo $row['title'];

                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?post_id=<?php echo $row['post_id']; ?>"><img src="<?php echo "./admin/upload/" . $row['post_img'] ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href="single.php?post_id=<?php echo $row['post_id']; ?>"> <?php echo $row['title']; ?> </a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $row['category'] ?>'><?php echo $row['category_name'] ?></a>
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
                                            <p class="description">
                                                <?php echo $row['description']; ?>
                                            </p>
                                            <!-- <a href="author.php?aid=' . $aut_id . '&page=' . $i . '">' . $i . '</a> -->
                                            <a class='read-more pull-right' href="single.php?cid=<?php echo $row['category_id'] . "&post_id=".$row['post_id'] ?>">read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    else{
                        echo "<h2 class='text-center'>Not Post yet</h2>";
                    }
                    ?>

                    <?php
                    $sql1 = "SELECT * FROM post ";
                    $result1 = mysqli_query($conn, $sql1);
                    $rowCount = mysqli_num_rows($result1);
                    $totalPage = ceil($rowCount / $limit);
                    echo "<ul class='pagination'>";
                    if($page>1){
                        echo '<li><a href="index.php?page='.($page-1).'">Pre</a></li>';
                    }
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if($i==$page){
                            $active="active";
                        }
                        else{
                            $active="";
                        }
                            echo '<li class="'.$active.'"><a href="index.php?page='.$i.'">' . $i . '</a></li>';
                    }
                    if($page< $totalPage){
                        echo '<li><a href="index.php?page='.($page+1).'">Next</a></li>';

                    }
                    ?>
                    </ul>

                    <!-- <li class="active"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>