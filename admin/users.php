<?php include "header.php"; ?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        include_once('config.php');
                        $limit=3;
                        if(isset($_GET['id'])){
                            $page=$_GET['id'];
                        }
                        else{
                            $page=1;
                        }
                        $offset=($page-1)*$limit; 
                        $sql = "SELECT * FROM user LIMIT $offset, $limit";
                        $query = mysqli_query($conn, $sql);
                        $cnt = 1;
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {

                        ?>
                                <tr>
                                    <td class='id'><?php echo $cnt ?></td>
                                    <td><?php echo $row['first_name'] ." ". $row['last_name'];  ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php if ($row['role'] == 1) {
                                            echo 'Admin';
                                        } else {
                                            echo 'Normal';
                                        }; ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>

                        <?php
                                $cnt++;
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                $sql1="SELECT * FROM user";
                $result=mysqli_query($conn,$sql1);
                 $TotalNoOfData=mysqli_num_rows($result);
                  $toalPage=ceil($TotalNoOfData/$limit);
                 echo "<ul class='pagination admin-pagination'>";
                        if($page > 1){
                            echo '<li><a href="users.php?id='.($page-1).'">Pre</a></li>';

                        }
                 for($i=1; $i<=$toalPage; $i++){
                    if($i==$page){
                        $active="active";
                    }
                    else{
                        $active="";
                    }
                    echo '<li class='.$active.'><a href="users.php?id='.$i.'">'.$i.'</a></li>';
                 }
                 if($toalPage>$page){
                    echo '<li><a href="users.php?id='.($page+1).'">Next</a></li>';
                 }
                 echo "</ul> ";
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>