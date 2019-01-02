<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Theme</h2>
               <div class="block copyblock"> 

               <?php



                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $theme = $_POST['theme'];
                        $query = "UPDATE tbl_theme SET theme = '$theme'  where id = '1' ";
                        $updated_rows = $db->update($query);

                             if ($updated_rows) {
                               echo "<span class='success'>Theme changed Successfully.</span>";
                              }else {
                                echo "<span class='error'>Theme is  Not Updated !</span>";
                              }
                          
                    
                    }
               ?>

               <?php
                    $queryr = "select * from tbl_theme where id='1'";
                    $read   = $db->select($queryr);
                    $result = mysqli_fetch_assoc($read);
                    $thm   = ucfirst($result['theme']);
               ?>
       
                <h3>Current Theme is : <?php echo $thm; ?> </h3>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="radio" name="theme" value="default"  <?php if ($thm == 'Default') { echo "checked";} ?>/> Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="theme" value="green" <?php if ($thm == 'Green') { echo "checked";} ?>/> Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="theme" value="red" <?php if ($thm == 'Red') { echo "checked";} ?> /> Red
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="change" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php' ?>