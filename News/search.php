<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <!-- <h2 class="page-heading">Search : Search Term</h2> -->
                    <?php
                    if (isset($_GET['search'])) {
                        $search_term = $_GET['search'];
                    } else {
                        header("Location:" . $hostname);
                    }

                    ?>
                    <h2 class="page-heading"><?php echo "Search : ". $search_term; ?></h2>

                    <?php
                    $offset = 0;
                    $limit = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT * FROM post INNER JOIN category ON post.category=category.category_id INNER JOIN user ON post.author=user.user_id WHERE post.title LIKE '%{$search_term}%' ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";

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
                                                    <a href='author.php?search=<?php echo $row['author'] ?>'><?php echo $row['username']; ?></a>
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
                        $sql = "SELECT * FROM post where post.title LIKE '%{$search_term}%' ";
                        $query = mysqli_query($conn, $sql);
                        // $row = mysqli_fetch_assoc($query);

                        if (mysqli_num_rows($query) > 0) {

                            $totalRecord = mysqli_num_rows($query);

                            $totalPage = ceil($totalRecord / $limit);
                            echo "<ul class='pagination admin-pagination'>";
                            if ($page > 1) {
                                echo "<li><a href='search.php?search='.$search_term.'&page=" . ($page - 1) . "'>Pre</a></li>";
                            }
                            for ($i = 1; $i <= $totalPage; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class=' . $active . '><a href="search.php?search=' . $search_term . '&page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($totalPage > $page) {
                                echo '<li><a href="author.php?search=' . $search_term . '&page=' . ($page + 1) . '">Next</a></li>';
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