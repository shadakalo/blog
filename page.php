<?php
	
	include "inc/header.php";
	
?>

<?php
   $pageid = mysqli_real_escape_string( $db->link, $_GET['pageid']);
   if (!isset($pageid) || $pageid == NULL) {
      echo "<script> window.location = '404.php'</script>";
   }else{
        $id = $pageid;
        }
?>
<?php
			    $query = "select * from tbl_page where id='$id'" ;//selecting all data from db (title slogan logo)
			    $readp  = $db->select($query);
			    if ($readp ) {
			        while ($resultp = $readp->fetch_assoc()) {  
?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $resultp['name']; ?></h2>
	
				<p><?php echo $resultp['body']; ?></p>
			</div>

		</div>

<?php }}?>

<?php
	
	include "inc/sidebar.php";
	include "inc/footer.php";

?>