<?php

if(isset($_POST['create_user'])) {
    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    // $user_image = $_FILES['user_image']['name'];
    // $user_image_temp = $_FILES['user_image'];
    
    // move_uploaded_file($user_image_temp, "../images/$user_image");
    
    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";
    $query .= "VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";
    
    $createUserQuery = mysqli_query($connection, $query);
    
    confirm($createUserQuery);
    
    echo "<div class='alert alert-success' role='alert'>";    
    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
    echo "</div>";
}



?>
   

   <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="user_firstname">First Name:</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
      
    <div class="form-group">
        <label for="user_role">User Role</label>
        <br>
        <select name="user_role" id="">
           <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    
    <!--
    <div class="form-group">
        <label for="user_image">Image</label>
        <input type="file" name="user_image">
    </div>
    -->
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>  
    
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
       
    <div class="form-group">
        <label for="user_pass">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
       
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>

</form>