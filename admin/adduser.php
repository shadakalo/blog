<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
    if ($_SESSION['role'] != 1) {
        echo "<script> window.location = 'adminindex.php'</script>";
    }
 ?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 

               <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
                        $username = $fr->validation($_POST['username']);
                        $password = $fr->validation(md5($_POST['password']));
                        $email     = $fr->validation($_POST['email']);
                        $role     = $fr->validation($_POST['role']);

                        $username = mysqli_real_escape_string( $db->link, $username);
                        $password = mysqli_real_escape_string( $db->link, $password);
                        $email     = mysqli_real_escape_string( $db->link, $email);
                        $role     = mysqli_real_escape_string( $db->link, $role);
   
                        if (empty($username) || empty($password) || empty($role) || empty($email)  ) {
                           echo "<span class='error'> Field can not be empty....</span>";
                        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                           echo "<span class='error'> Enter valid email ..</span>";
                        }else{

                            $queryc = "select * from tbl_user where email ='$email'";
                            $readc = $db->select($queryc);
                            if ($readc != false) {
                                echo "<span class='error'> Email Already Exists ..</span>";
                            }else{

                                $query = "INSERT INTO tbl_user(username,password,role,email) VALUES('$username','$password','$role','$email')" ;
                                $insertcat = $db->insert($query);
                                if ($insertcat) {
                                    echo "<span class='success'> User created successfully</span>";
                                }else{
                                    echo "<span class='error'> something went wrong ..</span>";
                                }

                            }

                        }
                    }
               ?>
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter Username..." class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="text" name="password" placeholder="Enter password..." class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" placeholder="Enter email..." class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Role</label>
                            </td>
                            <td>
                                <select id="select" name="role">
                                  <option value="">select category</option>
                                  <option value="1">Admin</option>
                                  <option value="2">Author</option>
                                  <option value="3">Editor</option>
                                </select>
                            </td>
                        </tr>
                        <tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php' ?>