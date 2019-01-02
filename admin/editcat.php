<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
   
   if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
      echo "<script> window.location : 'catlist.php'</script>";
   }else{
        $id = $_GET['catid'];
   }


?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit category</h2>
               <div class="block copyblock"> 
            <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                        $name = $fr->validation($_POST['name']);
                        $name = mysqli_real_escape_string( $db->link, $name);

                        if (empty($name)) {
                           echo "<span class='error'> Field can not be empty....</span>";
                        }else{
                            $query = "UPDATE tbl_category SET name = '$name' where id = '$id'" ;
                            $updatecat = $db->update($query);
                            if ($updatecat) {
                                echo "<span class='success'> Category updated successfully</span>";
                            }else{
                                echo "<span class='error'> Category is not updated ..</span>";
                            }
                        }
                    }
               ?>   

            <?php
                //getting value from database to show it in edit page ....
                $query = "select * from tbl_category  where id ='$id'";
                $category = $db->select($query);
                $result = mysqli_fetch_assoc($category);  
            ?>
                 <form action="" method="post">
                    <table class="form">	
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'] ; ?>" class="medium" />
                            </td>
                        </tr>                
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                
                    </table>
                    </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php' ?>