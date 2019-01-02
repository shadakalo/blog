<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<style type="text/css">
    .left{
        float: left;width: 70%;
    }
    .right{
        float: right;width: 30%;
    }


</style> 
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>

<!-- update -->
<?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $title      = $fr->validation($_POST['title']);
                        $slogan     = $fr->validation($_POST['slogan']);
                        $title      = mysqli_real_escape_string( $db->link, $title);
                        $slogan     = mysqli_real_escape_string( $db->link, $slogan);
                       

                        $permited  = array('png');
                        $file_name = $_FILES['logo']['name'];
                        $file_size = $_FILES['logo']['size'];
                        $file_temp = $_FILES['logo']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "images/".$unique_image;

                         if ($slogan == '' || $title == '' ) {
                            
                            echo "<span class='error'> Fields can not be empty .....</span>";

                        }else{

                                if(!empty($file_name)){
                                        if ($file_size >1048567) {

                                             echo "<span class='error'>Image Size should be less then 1MB!</span>";

                                        } elseif (in_array($file_ext, $permited) === false) {

                                             echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";

                                         } else{

                                            move_uploaded_file($file_temp, $uploaded_image);
                                            $queryup = "UPDATE title_slogan 
                                                      SET      
                                                      title     = '$title',
                                                      slogan    = '$slogan',
                                                      logo      = '$uploaded_image'
                                                      where id = '1' ";

                                            $updated_rows = $db->update($queryup);
                                            if ($updated_rows) {
                                             echo "<span class='success'>Post Updated Successfully.</span>";
                                            }else {
                                             echo "<span class='error'>Post Not Updated !</span>";
                                            }
                                        }
                                }else{

                                                  $queryup = "UPDATE title_slogan 
                                                      SET 
                                                      title  = '$title',
                                                      slogan   = '$slogan'
                                                      where id = '1' ";

                                            $updated_rows = $db->update($queryup);

                                            if ($updated_rows) {
                                             echo "<span class='success'>Data Updated Successfully.</span>";
                                            }else {
                                             echo "<span class='error'>Data Not Updated !</span>";
                                            }

                                 }
                       } 
                    }
?>
<?php
    $query = "select * from title_slogan where id='1'" ;//selecting all data from db (title slogan logo)
    $read  = $db->select($query);
    if ($read ) {
        while ($result = $read->fetch_assoc()) {  
?>

                <div class="block sloginblock">    
                    <div class="left">           
                  <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'] ;?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan'] ;?>"  name="slogan" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" />
                            </td>
                        </tr>

						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                    <div class="right">
                        <img src="<?php echo $result['logo'] ;?>"  height="200px" width="200px" >
                    </div>
                </div>
            </div>
        </div>
 <?php
                    }//end while
                }//endif

            ?>
<?php include 'inc/footer.php'?>
