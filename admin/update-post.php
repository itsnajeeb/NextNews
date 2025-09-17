<?php include "header.php";
include_once('config.php');
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php   
        $id=$_GET['id']; 
        $sql="SELECT * FROM post WHERE `post_id`='{$id}'";
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_assoc($query)){
          $category_id=$row['category'];
        ?>
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $id; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                  <?php echo $row['description'];
                  ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php   $sql1="SELECT * FROM category ";
                     $query1=mysqli_query($conn,$sql1);
                    if(mysqli_num_rows($query1)>0){
                        while($row1=mysqli_fetch_assoc($query1)){
                            if($row1['category_id']==$category_id){
                                echo $selected="selected";
                            }
                            else{
                                $selected="";
                            }
                            echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                        }
                    }
                    
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new_image">
                <img  src="upload/<?php echo $row['post_img'] ?>" height="150px">
                <input type="hidden" name="old_image" value="<?php echo $row['post_img'] ?>">
            </div>
            <?php
               }
            }
            ?>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
