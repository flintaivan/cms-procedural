<?php

if(isset($_POST['create_post'])) {
    
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    //$post_comment_count = 4;
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
    
    $createPostQuery = mysqli_query($connection, $query);
    
    confirm($createPostQuery);
    
    
    $post_id = mysqli_insert_id($connection);
 
    /*
    $query = "SELECT * FROM posts";
    $selectPostId = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($selectPostId)) {
        
        $post_id = $row['post_id'];
    }
    */
    echo "<div class='alert alert-success' role='alert'>";    
    echo "Post Created: " . " " . "<a href='../post.php?p_id={$post_id}'>View Post</a>" . " or " . "<a href='posts.php'>Edit Posts</a>";
    echo "</div>";
}



?>
   

   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <br>
        <select name="post_category" id="">
            
            <?php 
            
            $query = "SELECT * FROM categories";
            $showCat = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_assoc($showCat)) {
                
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            
            
            
            ?>
            
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select name="post_status" id="">
           <option value="Draft">Select Options</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
        </select>
    </div>
       
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
       
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
       
    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>
       
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>

</form>