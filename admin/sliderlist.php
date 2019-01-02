<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>NO.</th>
							<th>Title</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$query = "select * from tbl_slider ";

						$result = $db->select($query);
						if ($result) {
							$i=0;
							while ($post = $result->fetch_assoc()) {
								
							$i++;

					?>



						<tr class="odd gradeX">
							<td ><?php echo $i?></td>
							<td ><?php echo $post['title']?></td>
							<td ><img src="<?php echo $post['image']?>" height = 30px; width = 50px;></td>
							<td>
								 

<?php

	if ($_SESSION['role']== 1 || $_SESSION['role'] == 3) {
		
?>

								 <a href="editslider.php?sid=<?php echo $post['id']?>">Edit</a> ||
								 <a onclick="return confirm('Are you sure ??');" href="delslide.php?sid=<?php echo $post['id']?>">Delete</a>
<?php }else { echo "You can not take any action";} ?>
							 </td>
						</tr>


					<?php
							}//end while
						}else{ echo "<span class='error'> NO Slide to show ..</span></br>"; } //end if else
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