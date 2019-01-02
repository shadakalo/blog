<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<?php
   if (!isset($_GET['id']) || $_GET['id'] == NULL) {
      echo "<script> window.location = 'admininbox.php'</script>";
   }else{
        $id = $_GET['id'];
         }
    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Compose</h2>
                <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                       $to = $fr->validation($_POST['to']);
                       $from = $fr->validation($_POST['from']);
                       $sub = $fr->validation($_POST['sub']);
                       $msg = $fr->validation($_POST['msg']);

                       $sendmail = mail($to, $sub, $msg, $from);
                       if ($sendmail) {
                           echo "<span style='color:green;'>Message sent successfully...</span>";
                       }else{
                            echo "<span style='color:red;'>Message not sent !!!</span>";
                       }

                    }

                ?>
                <div class="block"> 
                 <form action="" method="post" >
                    <table class="form">  
                    <?php

                        $query = "select * from tbl_contact where id='$id'";
                        $read  = $db->select($query);
                        if ($read) {
                            while ($result = $read->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name="to" value="<?php  echo $result['email'];?>" class="medium" readonly/>
                            </td>
                        </tr>
                        <?php }} ?>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="from" placeholder="Enter email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="sub" placeholder="Enter Subject..." class="medium" />
                            </td>
                        </tr>
                     
                      
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="msg"></textarea>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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