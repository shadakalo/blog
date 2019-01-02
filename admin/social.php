<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Social Media</h2>
<?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $fb      = $fr->validation($_POST['facebook']);
                        $tw      = $fr->validation($_POST['twitter']);
                        $ln      = $fr->validation($_POST['linkedin']);
                        $gg      = $fr->validation($_POST['googleplus']);
                        $fb      = mysqli_real_escape_string( $db->link, $fb);
                        $tw      = mysqli_real_escape_string( $db->link, $tw);
                        $ln      = mysqli_real_escape_string( $db->link, $ln);
                        $gg      = mysqli_real_escape_string( $db->link, $gg);


                        if ($fb == '' || $tw == '' || $ln == '' || $gg == '') {
                            
                            echo "<span class='error'> Fields can not be empty .....</span>";

                        }else{

                                             $queryup = "UPDATE tbl_social 
                                                      SET 
                                                      fb   = '$fb',
                                                      tw   = '$tw',
                                                      ln   = '$ln',
                                                      gg   = '$gg'
                                                      where id = '1' ";

                                            $updated_rows = $db->update($queryup);

                                            if ($updated_rows) {
                                             echo "<span class='success'>Data Updated Successfully.</span>";
                                            }else {
                                             echo "<span class='error'>Data Not Updated !</span>";
                                            }
                        }
                    }    

?>

                <div class="block">               
                 <form action="" method="post" >



<?php
    $query = "select * from tbl_social where id='1'" ;//selecting all data from db (title slogan logo)
    $read  = $db->select($query);
    if ($read ) {
        while ($result = $read->fetch_assoc()) {  
?>
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook"  value="<?php echo $result['fb'] ;?>"  class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter"  value="<?php echo $result['tw'] ;?>"  class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin"  value="<?php echo $result['ln'] ;?>"  class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="googleplus"  value="<?php echo $result['gg'] ;?>"  class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
<?php
          }
        }
?>                    
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include 'inc/footer.php'?>