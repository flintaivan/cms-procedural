<form action="" method="post">
                                <div class="form-group">
                                   <label for="cat-title">Edit Category</label>
                            
                    <?php 
                            
                            if(isset($_GET['edit'])) {
                                
                                $cat_id = $_GET['edit'];
                                $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                                $selectCatId = mysqli_query($connection, $query);
                                
                                while($row = mysqli_fetch_assoc($selectCatId)) {
                                    
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    
                                    ?>
                              <input value="<?php if(isset($cat_title)) echo $cat_title; ?>" class="form-control" type="text" name="cat_title">
                                
                            <?php  } } ?>
                            <?php 
                                    
                                //UPDATE QUERY
                                    
                                if(isset($_POST['update'])) {
                                    
                                    $cat_title = $_POST['cat_title'];
                                    $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";
                                    $updateCatQuery = mysqli_query($connection, $query);
                                        if(!$updateCatQuery) {
                                            die("Query FAILED!" . mysqli_error($connection));
                                        }
                                }   
                                    
                                    
                                    
                                    ?>
                            
                                    
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                                </div>