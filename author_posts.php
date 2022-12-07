<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            
            
            <div class="col-md-8">
               
               <h1 class="page-header">
                    All Posts by: 
                    <small>Treba pisat post autor</small>
                </h1>
                
                <?php 
                
                if(isset($_GET['p_id'])) {
                    
                    $post_id = $_GET['p_id'];
                    $post_author = $_GET['author'];
                    
                }
                    
                    $query = "SELECT * FROM posts WHERE post_author = '{$post_author}'";
                    $selectPost = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($selectPost)) {
                        
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    
                
                
                
                ?>
                
                <!-- Blog Post -->

                <!-- Title -->
                <h1><a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></h1>


                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content ?></p>

                <hr>

                <!-- Blog Comments -->
                <?php } ?>
                
                <?php 
                
                if(isset($_POST['create_comment'])) {
                    
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                        
                    $query = "INSERT INTO comments(comment_post_id, comment_date, comment_author, comment_email, comment_content, comment_status) ";
                    $query .= "VALUES({$post_id}, now(), '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unnaproved')";
                    
                    $createComment = mysqli_query($connection, $query);
                
                    
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    $query .= "WHERE post_id = {$post_id}";
                    $updateCommentCount = mysqli_query($connection, $query);
                        
                } else {
                    
                    echo "<script>alert('Fields cannot be empty!')</script>";
                        
                }
                    

                
                }
                ?>
                
                
                



            </div>
            
            

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>


<?php include "includes/footer.php"; ?>