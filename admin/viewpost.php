<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<?php
    if (!isset($_GET['postid']) && $_GET['postid'] == NULL) {
        echo "<script> window.location = 'postid.php'</script>";
    }else{
        $id= $_GET['postid'];
    }

?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>View Post</h2>
                <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                         echo "<script> window.location = 'postlist.php'</script>";
                        
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
                                <label>Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $pread['image']?>" width=200px; height = 100px;><br/>
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
                                <input type="submit" name="submit" Value="OK" />
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