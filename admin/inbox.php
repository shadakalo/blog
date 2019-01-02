<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<style type="text/css">
	tr th{
		 text-align: center;
	}
</style>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
<?php

	if (isset($_GET['seenid'])  ){
		$seenid = $_GET['seenid'];
		$query = "UPDATE tbl_contact SET status = '1' where id = '$seenid'" ;
        $updatemsg = $db->update($query);
        if ($updatemsg) {
           	 echo "<script>alert('Message sent to seen box successfully');</script>";
        	 echo "<script> window.location = 'inbox.php' ;</script>";
         }else{
           echo "<span class='error'> something went wrong ..</span>";
         }
	}

?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th style="text-align: center;" >Serial No.</th>
							<th style="text-align: center;">Name</th>
							<th style="text-align: center;">Email</th>
							<th style="text-align: center;">Message</th>
							<th style="text-align: center;">Date</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
<?php
	$query = "select * from tbl_contact where status ='0' ";
	$read  = $db->select($query);
	$i=0;
	if ($read) {
	 	while ($result = $read->fetch_assoc()) {
			$i++;
	 	
?>
						<tr class="odd gradeX">
							<td style="text-align: center;"> <?php echo $i ;?></td>
							<td><?php echo $result['fname'].' '.$result['lname']?></td>
							<td><?php echo $result['email'] ;?></td>
							<td><?php echo $fr->textShorten($result['body'],30) ;?></td>
							<td><?php echo $fr->formatDate($result['date']) ;?></td>
							<td><a href="view.php?id=<?php echo $result['id'] ;?>">View</a> || <a href="reply.php?id=<?php echo $result['id'] ;?>">Reply </a>|| <a onclick="return confirm('Are you sure ??');" href="?seenid=<?php echo $result['id'] ;?>">Seen</a></td>
						</tr>
<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Seen Messages</h2>
<?php

	if (isset($_GET['delid'])  ){
		$delid = $_GET['delid'];
		$query = "delete from tbl_contact where id = '$delid'" ;
        $delmsg = $db->delete($query);
        if ($delmsg) {
           echo "<span class='success'> Message deleted  successfully</span>";
         }else{
           echo "<span class='error'> something went wrong ..</span>";
         }
	}

?>
                <div class="block">        
                      <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th style="text-align: center;" >Serial No.</th>
							<th style="text-align: center;">Name</th>
							<th style="text-align: center;">Email</th>
							<th style="text-align: center;">Message</th>
							<th style="text-align: center;">Date</th>
							<th >Action</th>
						</tr>
					</thead>
					<tbody>
<?php
	$query = "select * from tbl_contact where status ='1' ";
	$read  = $db->select($query);
	$i=0;
	if ($read) {
	 	while ($result = $read->fetch_assoc()) {
			$i++;
	 	
?>
						<tr class="odd gradeX">
							<td style="text-align: center;"> <?php echo $i ;?></td>
							<td><?php echo $result['fname'].' '.$result['lname']?></td>
							<td><?php echo $result['email'] ;?></td>
							<td><?php echo $fr->textShorten($result['body'],30) ;?></td>
							<td><?php echo $fr->formatDate($result['date']) ;?></td>
							<td><a href="view.php?id=<?php echo $result['id'] ;?>">View</a> ||<a onclick="return confirm('Are you sure ??');" href="?delid=<?php echo $result['id'] ;?>">Delete</a></td>
						</tr>
<?php }} ?>
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

<?php include 'inc/footer.php' ?>
