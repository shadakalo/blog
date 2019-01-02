<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php

    $userid = $_SESSION['userid'];
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>My Profile</h2>
<?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                        
                        $username = $fr->validation($_POST['username']);
                        $email    = $fr->validation($_POST['email']);
                        $details  = $_POST['details'];

                        $username = mysqli_real_escape_string( $db->link, $username);
                        $email = mysqli_real_escape_string( $db->link, $email);

                        if (empty($username) || $email == NULL || $details == NULL) {
                            
                            echo "<span class='error'> Fields can not be empty .....</span>";
                        }else{

                             $query = "UPDATE tbl_user
                                        SET 
                                        username = '$username',
                                        email = '$email',
                                        details = '$details' 
                                        where id = '$userid'" ;
                            $updatecat = $db->update($query);
                            if ($updatecat) {
                                echo "<span class='success'> Profile updated successfully</span>";
                            }else{
                                echo "<span class='error'>Something went wrong ..</span>";
                            }

                        }

                    }
 ?>

                <div class="block"> 
                 <form action="" method="post" >
                    <table class="form"> 

<?php

    $query = "select * from tbl_user where id='$userid' and role = '$role'";
    $read = $db->select($query);
    if ($read) {
        # code...
        while ($result = $read->fetch_assoc()) {

?> 
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>   
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" readonly/>
                            </td>
                        </tr>                 
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Detail</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details"><?php echo $result['details']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
<?php }} ?>
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