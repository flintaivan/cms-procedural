 <?php


if(isset($_GET['p_id'])) {
    $postEditId = $_GET['p_id'];
}
    
    
    $query = "SELECT * FROM posts WHERE post_id = {$postEditId}";
    $selectPostQuery = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($selectPostQuery)) {
                                
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
}

if(isset($_POST['update_post'])) {
    
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    if(empty($post_image)) {
        
        $query = "SELECT * FROM posts WHERE post_id = {$postEditId}";
        $selectImage = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($selectImage)) {
            
            $post_image = $row['post_image'];
        }
    }
    
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$postEditId}";
    
    $updatePost = mysqli_query($connection, $query);
    
    confirm($updatePost);
    
    echo "<div class='alert alert-success' role='alert'>";    
    echo "Post updated: " . " " . "<a href='../post.php?p_id={$post_id}'>View Post</a>" . " or " . "<a href='posts.php'>Edit More Posts</a>";
    echo "</div>";

}



?>
   
   
   
   
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
    </div>
    
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <br>
        <select name="post_category" id="post_category">
            <?php
            
            $query = "SELECT * FROM categories";
            $selectCat = mysqli_query($connection, $query);
            
            confirm($selectCat);
            
            while($row = mysqli_fetch_assoc($selectCat)) {
                
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
                
            }
            
            
            ?>
            
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select name="post_status" id="">
            <option value='<?php echo $post_status ?>'><?php echo $post_status ?></option>
            <?php 
            
            if($post_status == 'Published'){
                echo "<option value='Draft'>Draft</option>"; 
            } else {
                echo "<option value='Published'>Published</option>";
            }
            
            ?>
            
        </select>
    </div>
       
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <br>
        <img width="150" src="../images/<?php echo $post_image; ?>">
        <input type="file" name="post_image">
    </div>
       
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
       
    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
       
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>