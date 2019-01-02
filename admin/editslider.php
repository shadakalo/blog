<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<?php
    if (!isset($_GET['sid']) && $_GET['sid'] == NULL) {
        echo "<script> window.location = 'sliderlist.php'</script>";
    }else{
        $id= $_GET['sid'];
    }

?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Slider</h2>
                <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                        
                        $title      = mysqli_real_escape_string( $db->link, $_POST['title']);
                        
                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_temp = $_FILES['image']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "images/slider/".$unique_image;
                       

                        if ($title == '' ) {
                            
                            echo "<span class='error'> Fields can not be empty .....</span>";

                        }else{

                                if(!empty($file_name)){
                                        if ($file_size >1048567) {

                                             echo "<span class='error'>Image Size should be less then 1MB!</span>";

                                        } elseif (in_array($file_ext, $permited) === false) {

                                             echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";

                                         } else{

                                            move_uploaded_file($file_temp, $uploaded_image);
                                            $query = "UPDATE tbl_slider 
                                                      SET 
                                                      
                                                      title  = '$title',
                                                      image  = '$uploaded_image'
                                                      where id = '$id' ";

                                            $updated_rows = $db->update($query);
                                            if ($updated_rows) {
                                             echo "<span class='success'>Slider Updated Successfully.</span>";
                                            }else {
                                             echo "<span class='error'>Slider is Not Updated !</span>";
                                            }
                                        }
                                }else{

                                                  $query = "UPDATE tbl_post 
                                                      SET 
                                                      title  = '$title',
                                                      where id = '$id' ";

                                            $updated_rows = $db->update($query);

                                            if ($updated_rows) {
                                             echo "<span class='success'>Slider Updated Successfully.</span>";
                                            }else {
                                             echo "<span class='error'>Slider is Not Updated !</span>";
                                            }

                                }
                       } 
                    }

                ?>
                <div class="block">
                <?php

                    $pquery = "select * from tbl_slider where id=$id";
                    $presult = $db->select($pquery);
                    if ($presult) {
                        while ($pread = $presult->fetch_assoc()) {
                            
                ?>



                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">  
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $pread['title']?>" class="medium" />
                            </td>
                        </tr>
                     
                        
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $pread['image']?>" width=220px; height = 120px;><br/>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>

                    </table>
                    </form>
                    <?php
                           }//end while
                    }//endif
                    ?>
                </div>
            </div>
        </div>
 <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
        <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>
<!-- /TinyMCE -->
       
<?php include 'inc/footer.php'?>