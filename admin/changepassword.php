<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php

    $id = $_SESSION['userid'];
    $msg = "";

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Password</h2>
                <div class="block">

<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $pass1 = md5($_POST['pass1']);
    $pass2 = md5($_POST['pass2']);


     $querypage = "select * from tbl_user where id='$id' and password = '$pass1' ";
     $readp = $db->select($querypage);
     if ($readp != false) {
        
        $queryupdate = "update tbl_user set password = '$pass2' where id = '$id'";
        $readd = $db->update($queryupdate);

        $msg = "<span style='color:green'>Password Changed !!!</span>";

     }else{

         $msg = "<span style='color:red'>Incorrect Old Password!!!</span>";
     }


}

?>

                 <form action="" method="post">
                    <?php

                        if ($msg != "") {
                            echo $msg;
                        }

                    ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Old Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter Old Password..."  name="pass1" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>New Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter New Password..." name="pass2" class="medium" />
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
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
 <?php include 'inc/footer.php'?>
