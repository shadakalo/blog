<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<style type="text/css">
.msg{

    border: 1px solid #B3B3B3;
    width: 515px;
    text-align: justify;
    padding: 10px ;
    color: black;

}</style>
<?php
    
    if (!isset($_GET['userid']) && $_GET['userid'] == NULL) {
        echo "<script> window.location = 'userlist.php'</script>";
    }else{
        $id= $_GET['userid'];
    }

?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>User Profile</h2>
<?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            
                         echo "<script> window.location = 'userlist.php'</script>";
                   }
 ?>

                <div class="block"> 
                 <form action="" method="post" >
                    <table class="form"> 

<?php

    $query = "select * from tbl_user where id='$id' ";
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
                                <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium"  readonly/>
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
                        <tr >
                            <td><label>Role</label></td>
                            <td>

                            <input type="text" name="role" value="<?php 


                                    if ($result['role'] == 1) {
                                        echo "Admin";
                                    }elseif ($result['role'] == 2) {
                                        echo "Author";
                                    }else{
                                        echo "Editor";
                                    }
                              

                             ?>" class="medium" readonly/>

                            <td>
                            </td>
                        </tr>                 
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Detail</label>
                            </td>
                            <td>
                                <div class="msg"><?php echo $result['details']; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
<?php }} ?>
                    </table>
                    </form>
                </div>
            </div>
        </div>

       
<?php include 'inc/footer.php'?>