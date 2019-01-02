<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<style type="text/css">
    
.msg{

    border: 1px solid #B3B3B3;
    width: 530px;
    text-align: justify;
    padding: 10px ;
    color: black;

}

</style>
<?php
   if (!isset($_GET['id']) || $_GET['id'] == NULL) {
      echo "<script> window.location = 'inbox.php'</script>";
   }else{
        $id = $_GET['id'];
         }
    
?>
<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         echo "<script> window.location = 'inbox.php'</script>";
    }

?>

        <div class="grid_10">
		    <div class="box round first grid">
                <h2>Message</h2>
                <div class="block"> 
<?php

    $query = "select * from tbl_contact where id='$id'";
    $read  = $db->select($query);
    if ($read) {
        while ($result = $read->fetch_assoc()) {
?>
                 <form action="" method="post">
                    <table class="form">  
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php  echo $result['fname'].' '.$result['lname'];   ?>" class="medium" readonly  />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php  echo $result['email'] ?>" class="medium"  readonly/>
                            </td>
                        </tr>  
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php  echo $fr->formatDate($result['date']); ?>" class="medium" readonly/>
                            </td>
                        </tr>                       
                       
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <div class="msg"><p><?php  echo $result['body'] ?></p></div>
                                
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
<?php }} ?>
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