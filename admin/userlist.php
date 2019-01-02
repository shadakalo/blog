<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
 <?php

 	if (isset($_GET['delid'])) {

 		$id = $_GET['delid'];
 		$queryd = "delete from tbl_user where id = '$id'"; 
        $delr   = $db->delete($queryd);
        if ($delr) {
        	echo "<span class='success'> User deleted successfully</span>";
        }else{
        	 echo "<span class='error'>Something went wrong ..</span>";
        }
 	}


 ?>

                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%"   >NO.</th>
							<th width="15%"  >Username</th>
							<th width="20%" style="text-align: center;">Email</th>
							<th width="25%"  style="text-align: center;">Details</th>
							<th width="15%"  >Role</th>
							<th width="15%"  > Action</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$query = "select * from tbl_user order by id";

						$result = $db->select($query);
						if ($result) {
							$i=0;
							while ($post = $result->fetch_assoc()) {
								
							$i++;

					?>



						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $post['username']?></td>
							<td><?php echo $post['email']?></td>
							<td><?php echo $fr->textShorten($post['details'],50);?></td>
							<td><?php
									if ($post['role'] == 1) {
										echo "Admin";
									}elseif ($post['role'] == 2) {
										echo "Author";
									}else{
										echo "Editor";
									}
							 	?></td>
							<td>
								 <a href="viewuser.php?userid=<?php echo $post['id']?>">View</a>

								 <?php
						                    if ($_SESSION['userid'] == '1') {
						            ?>
								 
								  ||
								 <a onclick="return confirm('Are you sure ??');" href="?delid=<?php echo $post['id']?>">Delete</a>
								 <?php } ?>
							 </td>
						</tr>


					<?php
							}//end while
						}else{ echo "<span class='error'> NO User to show ..</span></br>"; } //end if else
					?>	

					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>

	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>

<?php include 'inc/footer.php'?>