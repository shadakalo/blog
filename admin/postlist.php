<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%"   style="text-align: center;">NO.</th>
							<th width="10%"  style="text-align: center;">Title</th>
							<th width="15%"  style="text-align: center;">Description</th>
							<th width="10%"  style="text-align: center;">Category</th>
							<th width="10%"  style="text-align: center;">Image</th>
							<th width="10%"  style="text-align: center;">Author</th>
							<th width="10%"  style="text-align: center;">Tag</th>
							<th width="10%"  style="text-align: center;">Date</th>
							<th width="15%"  style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$query = "select tbl_post.* , tbl_category.name from tbl_post inner join tbl_category on tbl_post.cat = tbl_category.id order by tbl_post.title desc";

						$result = $db->select($query);
						if ($result) {
							$i=0;
							while ($post = $result->fetch_assoc()) {
								
							$i++;

					?>



						<tr class="odd gradeX">
							<td ><?php echo $i?></td>
							<td style="text-align: center;"><?php echo $post['title']?></td>
							<td> <?php echo $fr->textShorten($post['body'],30);?></td>
							<td style="text-align: center;"><?php echo $post['name']?></td>
							<td style="text-align: center;"><img src="<?php echo $post['image']?>" height = 30px; width = 50px;></td>
							<td style="text-align: center;"><?php echo $post['author']?></td>
							<td style="text-align: center;"><?php echo $post['tag']?></td>
							<td><?php echo $fr->formatDate($post['date']) ;?></td>
							<td>
								 <a href="viewpost.php?postid=<?php echo $post['id']?>">View</a>

<?php

	if ($_SESSION['userid'] == $post['userid'] || $_SESSION['role'] == 1) {
		

?>



								  ||
								 <a href="editpost.php?postid=<?php echo $post['id']?>">Edit</a> ||
								 <a onclick="return confirm('Are you sure ??');" href="delpost.php?postid=<?php echo $post['id']?>">Delete</a>
<?php } ?>
							 </td>
						</tr>


					<?php
							}//end while
						}else{ echo "<span class='error'> NO post to show ..</span></br>"; } //end if else
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