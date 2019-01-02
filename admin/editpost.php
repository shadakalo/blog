<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<?php
    if (!isset($_GET['postid']) && $_GET['postid'] == NULL) {
        echo "<script> window.location : 'postid.php'</script>";
    }else{
        $id= $_GET['postid'];
    }

?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                        $cat        = mysqli_real_escape_string( $db->link, $_POST['cat']);
                        $title      = mysqli_real_escape_string( $db->link, $_POST['title']);
                        $body       = mysqli_real_escape_string( $db->link, $_POST['body']);
                        $tag        = mysqli_real_escape_string( $db->link, $_POST['tag']);
                        $author     = mysqli_real_escape_string( $db->link, $_POST['author']);

                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_temp = $_FILES['image']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "images/".$unique_image;
                       

                        if ($cat == '' || $title == '' || $body == '' || $tag == '' || $author == '') {
                            
                            echo "<span class='error'> Fields can not be empty .....</span>";

                        }else{

                                if(!empty($file_name)){
                                        if ($file_size >1048567) {

                                             echo "<span class='error'>Image Size should be less then 1MB!</span>";

                                        } elseif (in_array($file_ext, $permited) === false) {

                                             echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";

                                         } else{

                                            move_uploaded_file($file_temp, $uploaded_image);
                                            $query = "UPDATE tbl_post 
                                                      SET 
                                                      cat    = '$cat',
                                                      title  = '$title',
                                                      body   = '$body',
                                                      image  = '$uploaded_image',
                                                      author = '$author',
                                                      tag    = '$tag'
                                                      where id = '$id' ";

                                            $updated_rows = $db->update($query);
                                            if ($updated_rows) {
                                             echo "<span class='success'>Post Updated Successfully.</span>";
                                            }else {
                                             echo "<span class='error'>Post Not Updated !</span>";
                                            }
                                        }
                                }else{

                                                  $query = "UPDATE tbl_post 
                                                      SET 
                                                      cat    = '$cat',
                                                      title  = '$title',
                                                      body   = '$body',
                                                      author = '$author',
                                                      tag    = '$tag'
                                                      where id = '$id' ";

                                            $updated_rows = $db->update($query);

                                            if ($updated_rows) {
                                             echo "<span class='success'>Post Updated Successfully.</span>";
                                            }else {
                                             echo "<span class='error'>Post Not Updated !</span>";
                                            }

                                }
                       } 
                    }

                ?>
                <div class="block">
                <?php

                    $pquery = "select * from tbl_post where id=$id";
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
                                <label>Category</label>
                            </td>     
                            <td>
                                <select id="select" name="cat">
                                 <option value="">select category</option>
                    <?php
                        $query  = "select * from tbl_category ";
                        $result =$db->select($query);
                        if ($result) {
                            while ($cate=$result->fetch_assoc())
                            {
                     ?>  
                                    <option 
                                <?php
                                 // to show the category
                                  if ($pread['cat'] == $cate['id']) {
                                 ?>
                                    selected="selected";
                                 <?php } ?>
                                    value="<?php echo $cate['id'] ?>"><?php echo $cate['name'] ?>
                                    </option>
                    <?php
                          }//end while
                        }//end if 
                    ?>
                                </select>
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
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $pread['body']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tag</label>
                            </td>
                            <td>
                                <input type="text" name="tag" value="<?php echo $pread['tag']?>" class="medium" />
                            </td>
                        </tr><tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $pread['author']?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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