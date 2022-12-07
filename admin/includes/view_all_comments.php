


<table class="table table-hover">
    
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
       
<?php  

        
if(isset($_GET['delete'])) {
    
    $comment_id = $_GET['delete'];
    
    $query = "DELETE FROM comments WHERE comment_id = $comment_id";
    $deleteComment = mysqli_query($connection, $query);
    header("Location: comments.php");
}
        
if(isset($_GET['unapprove'])){
    
    $comment_id = $_GET['unapprove'];
    
    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$comment_id}";
    $unapproveComment = mysqli_query($connection, $query);
    header("Location: comments.php");
}
        
if(isset($_GET['approve'])){
    
    $comment_id = $_GET['approve'];
    
    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id}";
    $unapproveComment = mysqli_query($connection, $query);
    header("Location: comments.php");
}


$query = "SELECT * FROM comments ORDER BY comment_id DESC";
$showComments = mysqli_query($connection, $query);
        
while($row = mysqli_fetch_assoc($showComments)) {
    
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_date = $row['comment_date'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_content = substr($row['comment_content'], 0, 30);
    $comment_status = $row['comment_status'];
    

    echo "<tr>";
    echo "  <td>{$comment_id}</td>";
    echo "  <td>{$comment_author}</td>";
    echo "  <td>{$comment_content}</td>";
    echo "  <td>{$comment_email}</td>";
    echo "  <td>{$comment_status}</td>";
    
    $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
    $commentPost = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($commentPost)) {
        
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        echo "  <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
    }
    
    

    
    
    echo "  <td>{$comment_date}</td>";
    echo "  <td><a href='?approve={$comment_id}'>Approve</a></td>";
    echo "  <td><a href='?unapprove={$comment_id}'>Unapprove</a></td>";
    echo "  <td><a href='?delete={$comment_id}'>Delete</a></td>";
    echo "</tr>";

?>
        
<?php } ?>
    </tbody>
    
</table>