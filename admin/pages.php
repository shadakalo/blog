<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<style type="text/css">
    .delb{


        background-color: #DDDDDD;       
        padding: 6px 14px;
        margin-left: 10px;

    }
    .delb a{
        color: #444444;
        font-weight: normal;
        font-size: 20px;
    }

</style>



<?php

   if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
      echo "<script> window.location = 'adminindex.php'</script>";
   }else{
        $id = $_GET['pageid'];

       
        }
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Page</h2>
                <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                        $name      = mysqli_real_escape_string( $db->link, $_POST['name']);
                        $body      = mysqli_real_escape_string( $db->link, $_POST['body']);
                       
                       

                        if ($name == '' || $body == '') {
                            
                            echo "<span class='error'> Fields can not be empty .....</span>";

                        } else{

                            $query = "Update tbl_page set name = '$name', body = '$body' where id = '$id'";
                            $updated_rows = $db->update($query);

                            if ($updated_rows) {
                             echo "<span class='success'>Page Updated Successfully.</span>";
                            }else {
                             echo "<span class='error'>Page is  Not Updated !</span>";
                            }
                        }

                    }

                ?>
                <div class="block"> 
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">  
                     <?php

                    $querypage = "select * from tbl_page where id='$id'";
                    $readp = $db->select($querypage);
                    if ($readp) {
                        while ($resultp = $readp->fetch_assoc()) {
                        
                     ?>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $resultp['name'] ?>" class="medium" />
                            </td>
                        </tr>                  
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $resultp['body'] ?></textarea>
                            </td>
                        </tr>
                       <?php     }
                                   } 
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="delb"><a onclick="return confirm('Are you sure ??');" href="deletepage.php?id=<?php echo $id ;?>">Delete</a></span>
                            </td>
                        </tr>

                    </table>
                    </form>
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