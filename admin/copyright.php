<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
        <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $note      = $fr->validation($_POST['note']);
                        $note      = mysqli_real_escape_string( $db->link, $note);
                        


                        if ($note == '') {
                            
                            echo "<span class='error'> Fields can not be empty .....</span>";

                        }else{

                                             $queryup = "UPDATE tbl_cpyr8 
                                                      SET 
                                                      note   = '$note'
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
                <div class="block copyblock"> 
                 <form action="" method="post" >
<?php
    $query = "select * from tbl_cpyr8 where id='1'" ;//selecting all data from db (title slogan logo)
    $read  = $db->select($query);
    if ($read ) {
        while ($result = $read->fetch_assoc()) {  
?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
<?php
    }}
?>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include 'inc/footer.php'?>
