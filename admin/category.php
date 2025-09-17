<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        include_once('config.php');
                        $limit = 4;
                        // $page=$_GET['page'];
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        $sql = "SELECT * FROM category LIMIT $offset, $limit";
                        $query = mysqli_query($conn, $sql);
                        $cnt = 1;
                        if (mysqli_num_rows($query)) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                // $row['category_name'];
                        ?>
                                <tr>
                                    <td class='id'><?php echo $cnt; ?></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td><?php echo $row['post']; ?></td>
                                    <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                                $cnt++;
                            }
                        } else {
                            echo "<h2>No Data Found !</h2>";
                        }
                        ?>


                    </tbody>
                </table>
                <?php
                $sql1 = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql1);
                $totalRow = mysqli_num_rows($result);
                $TotalPage = ceil($totalRow / $limit);
                echo " <ul class='pagination admin-pagination'>";
                if($page>1){
                    echo '<li><a href="category.php?page='.($page-1).'">Pre</a></li>';
                }
                for ($i = 1; $i <= $TotalPage; $i++) {
                    if ($page == $i) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                    echo '<li class=' . $active . '><a href="category.php?page=' . $i . '">' . $i . '</a></li>';
                }
                if($page != $TotalPage){
                    echo '<li><a href="category.php?page='.($page+1).'">Next</a></li>';
                }
                echo "</ul>";
                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>