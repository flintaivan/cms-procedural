
<?php 


if(isset($_POST['checkBoxArray'])) {
    
    foreach($_POST['checkBoxArray'] as $checkBoxValue) {
        $bulkOptions = $_POST['bulkOptions'];
        
        switch($bulkOptions) {
                
            case 'Published':
                $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$checkBoxValue}";
                $bulkPublish = mysqli_query($connection, $query);
                break;
                
            case 'Draft':
                $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$checkBoxValue}";
                $bulkDraft = mysqli_query($connection, $query);
                break;
                
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$checkBoxValue}";
                $selectPosts = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($selectPosts)) {
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES('{$post_category}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
                
                $copyQuery = mysqli_query($connection, $query);
                if(!$copyQuery) {
                    die("Query Failed" . mysqli_error($connection));
                }
                
                break;
                
            case 'Delete':
                $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
                $bulkDelete = mysqli_query($connection, $query);
                break;
        }
    }
}




?>



<form action="" method="post">

                            
                            <table class="table table-hover">
                            <div id="bulkOptionContainer" class="col-xs-4">
                                
                                <select class="form-control" name="bulkOptions" id="">
                                    
                                    <option value="">Select Options</option>
                                    <option value="Published">Publish</option>
                                    <option value="Draft">Draft</option>
                                    <option value="clone">Clone</option>
                                    <option value="Delete">Delete</option>
                                </select>
                                
                                
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                            </div>
                             <thead>
                                 <tr>
                                     <th><input id="selectAllBoxes" type="checkbox"></th>
                                     <th>Id</th>
                                     <th>Author</th>
                                     <th>Title</th>
                                     <th>Category</th>
                                     <th>Status</th>
                                     <th class="text-center">Image</th>
                                     <th>Tags</th>
                                     <th>Comments</th>
                                     <th>Date</th>
                                 </tr>
                             </thead>
                             <tbody>
                               
                                
                                <?php
                                 
                            if(isset($_GET['delete'])) {
                                
                                $getPostId = $_GET['delete'];
                                $query = "DELETE FROM posts WHERE post_id = {$getPostId}";
                                $deletePostQuery = mysqli_query($connection, $query);
                                header("Location: posts.php");
                            }
                                 
                            if(isset($_GET['publish'])) {
                                
                                $postId = $_GET['publish'];
                                
                                $query = "UPDATE posts SET post_status = 'Published' WHERE post_id = {$postId}";
                                $publishPost = mysqli_query($connection, $query);
                                header("Location: posts.php");
                            }
                            
                            $query = "SELECT * FROM posts ORDER BY post_id DESC";
                            $selectAllPosts = mysqli_query($connection, $query);
                                 
                            
                            while($row = mysqli_fetch_assoc($selectAllPosts)) {
                                
                                $post_id = $row['post_id'];
                                $post_author = $row['post_author'];
                                $post_title = $row['post_title'];
                                $post_category = $row['post_category_id'];
                                $post_status = $row['post_status'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_date = $row['post_date'];
                                
                                echo "<tr>";
                                
                                ?>
                                
                                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
                                
                                <?php

                                echo "<td>{$post_id}</td>";
                                echo "<td>{$post_author}</td>";
                                echo "<td>{$post_title}</td>";
                                
                            $query = "SELECT * FROM categories WHERE cat_id = {$post_category}";
                            $findCat = mysqli_query($connection, $query);
                                
                            while($row = mysqli_fetch_assoc($findCat)) {
                                
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                            
                                
                                echo "<td>{$cat_title}</td>";
                            }
                                echo "<td>{$post_status}</td>";
                                echo "<td><img width='150' class='img-responsive' src='../images/{$post_image}' alt='{$post_image}'></td>";
                                echo "<td>{$post_tags}</td>";
                                echo "<td>{$post_comment_count}</td>";
                                echo "<td>{$post_date}</td>";
                                echo "<td><a href='?publish={$post_id}'>Publish</a></td>";
                                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                                echo "<td><a href='?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='?delete={$post_id}'>Delete</a></td>";
                                echo "</tr>";
                                
                            }
                            
                            ?>
                            
                            
                             </tbody>
                         </table>
</form>