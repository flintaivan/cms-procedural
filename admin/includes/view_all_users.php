


<table class="table table-hover">
    
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
       
<?php  

if(isset($_GET['delete'])) {
    
    $userId = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = $userId";
    $deleteUser = mysqli_query($connection, $query);
    header("Location: users.php");
}
        
if(isset($_GET['change_to_admin'])) {
    
    $userID = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$userID}";
    $toAdmin = mysqli_query($connection, $query);
    header("Location: users.php");
}
if(isset($_GET['change_to_sub'])) {
    
    $userID = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$userID}";
    $toAdmin = mysqli_query($connection, $query);
    header("Location: users.php");
}


$query = "SELECT * FROM users ORDER BY user_id DESC";
$showUsers = mysqli_query($connection, $query);
        
while($row = mysqli_fetch_assoc($showUsers)) {
    
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    

    echo "<tr>";
    echo "  <td>{$user_id}</td>";
    echo "  <td>{$username}</td>";
    echo "  <td>{$user_firstname}</td>";
    echo "  <td>{$user_lastname}</td>";
    echo "  <td>{$user_email}</td>";
    echo "  <td>{$user_role}</td>";
    echo "  <td><a href='?change_to_admin={$user_id}'>Admin</a></td>";
    echo "  <td><a href='?change_to_sub={$user_id}'>Subscriber</a></td>";
    echo "  <td><a href='?source=edit_user&edit={$user_id}'>Edit</a></td>";
    echo "  <td><a href='?delete={$user_id}'>Delete</a></td>";
    echo "</tr>";

?>
        
<?php } ?>
    </tbody>
    
</table>