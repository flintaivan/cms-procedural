<?php 


function confirm($result) {
    
    global $connection;
    if(!$result) {
        echo "<div class='alert alert-danger' role='alert'>";
        die("Query FAILED!" . mysqli_error($connection));
        echo "</div>";
    } else {
    }
}

function insertCategories() {
    
    global $connection;
    
    if(isset($_POST['submit'])) {
                            
        $cat_title = $_POST['cat_title'];
                            
            if($cat_title == "" || empty($cat_title)) {
                echo "<div class='alert alert-danger' role='alert'>";
                echo "This field should not be empty";
                echo "</div>";
            } else {
                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUES('{$cat_title}')";
                $addCategory = mysqli_query($connection, $query);
                                
                echo "<div class='alert alert-success' role='alert'>";
                echo "Category added successfuly!";
                echo "</div>";
                                
                if(!$addCategory) {
                    
                }
                                
            }
                            
                            
                            
    }
}

function findAllCategories() {
    
    global $connection;
    // SELECT ALL CATEGORIES QUERY
    $query = "SELECT * FROM categories";
    $selectAllCats = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($selectAllCats)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
        }
}

function deleteCategory() {
    
    global $connection;
    if(isset($_GET['delete'])) {
                                        
    $getCatId = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$getCatId}";
    $deleteCat = mysqli_query($connection, $query);
    header("Location: categories.php");
    
    }
}






?>