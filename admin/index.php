<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

       
       
       
       
       
       
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            
                            <?php 
                            
                             
                            
                            ?>
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'>
                       <?php 
                      
                      $query = "SELECT * FROM posts";
                      $selectPosts = mysqli_query($connection, $query);
                      $postCount = mysqli_num_rows($selectPosts);
                      
                      echo $postCount;
                      
                      
                      
                      ?>
                       
                       
                       </div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'>
                         
                         <?php
                         
                         $query = "SELECT * FROM comments";
                         $selectComments = mysqli_query($connection, $query);
                         $countComments = mysqli_num_rows($selectComments);
                         
                         echo $countComments;
                         
                         
                         
                         ?>
                         
                         
                     </div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'>
                        
                        <?php
                        
                        $query = "SELECT * FROM users";
                        $selectUsers = mysqli_query($connection, $query);
                        $countUsers = mysqli_num_rows($selectUsers);
                        
                        echo $countUsers;
                        
                        ?>
                        
                        </div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                        <?php 
                            
                            $query = "SELECT * FROM categories";
                            $selectCats = mysqli_query($connection, $query);
                            $countCats = mysqli_num_rows($selectCats);
                            
                            echo $countCats;
                            
                            ?>
                        
                        </div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
                </div>
                
                
                <?php 
                
                
                $query = "SELECT * FROM posts WHERE post_status = 'Draft'";
                $selectDraftPosts = mysqli_query($connection, $query);
                $postDraftCount = mysqli_num_rows($selectDraftPosts);
                
                $query = "SELECT * FROM posts WHERE post_status = 'Published'";
                $selectPublishedPosts = mysqli_query($connection, $query);
                $postPublishCount = mysqli_num_rows($selectPublishedPosts);

                
                $query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
                $selectUnnComm = mysqli_query($connection, $query);
                $unnCommCount = mysqli_num_rows($selectUnnComm);
                
                $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                $selectSubs = mysqli_query($connection, $query);
                $subsCount = mysqli_num_rows($selectSubs);
                
                ?>
                
                
                
                
                <!-- /.row -->
                
                <div class="row">
                   
                   <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Count'],
            
            <?php 
            
            $element_text = ['All Posts', 'Active Post', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
            $element_count = [$postCount, $postPublishCount, $postDraftCount, $countComments, $unnCommCount, $countUsers, $subsCount, $countCats];
            
            for($i = 0; $i < 8; $i++) {
                
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }
            
            
            
            ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
                   
<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    
                    
                    
                    
                </div>
                
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>
