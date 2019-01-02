<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
<?php

   if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
      echo "<script> window.location : 'catlist.php'</script>";
   }else{
        $id = $_GET['catid'];
        // delete query
		 $delquery="delete from tbl_category where id='$id'" ;
		 $delcat = $db->delete($delquery);
		 if ($delcat) {
			   echo "<span class='success'> Category deleted successfully</span></br>";
				}else{
				 echo "<span class='error'> Category is not deleted ..</span></br>";
   		 }
    }
?>
                <div class="block">       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query  = "select * from tbl_category order by id";
						$result = $db->select($query);
						if ($result) {
							$i=0;
							while ($read=$result->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php  echo $i ; ?></td>
							<td><?php  echo $read['name']; ?></td>
							<td>

								<?php
                                if ($_SESSION['role'] ==1 || $_SESSION['role'] ==3) {
                                    # code...
                                
                         		   ?>

								<a href="editcat.php?catid=<?php echo $read['id']; ?>">Edit</a> ||
									<a onclick="return confirm('Are you sure ??');" href="catlist.php?catid=<?php  echo $read['id']; ?>">Delete</a>

								<?php }else{
									echo 'No Action';
									} ?>
							</td>
						</tr>
					<?php
							}//end while
								}//end if
					?>
					</tbody>
				</table>
               </div>
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