<?php
	include "lib/Database.php";
	include "helpers/format.php";
	include "config/config.php";
?>
<?php
	// creating objects 
	$db = new Database;
	$fr = new format;
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="./favicon.ico?v1" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico?v1" type="image/x-icon" /> 
<?php
	if (isset($_GET['pageid'])) {
		$id    = $_GET['pageid'];
		$query = "select * from tbl_page where id='$id'";
		$read  = $db->select($query);
		if ($read) {
			while ($result = $read->fetch_assoc()) {
				
?>
	<title> <?php echo $result['name'];?> - <?php echo TITLE;?></title>
<?php  	
	}}}elseif (isset($_GET['id'])) {
		$id    = $_GET['id'];
		$query = "select * from tbl_post where id='$id'";
		$read  = $db->select($query);
		if ($read) {
			while ($result = $read->fetch_assoc()) {
?>
	<title> <?php echo $result['title'];?> - <?php echo TITLE;?></title>
<?php
	}}}	else{
?>
	<title> <?php echo $fr->title();?> - <?php echo TITLE;?></title>
<?php		
	}
?>

	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
    <meta name="keywords" content="">

<?php

	if (isset($_GET['id'])) {
		$kid = $_GET['id'];
		$queryk = "select * from tbl_post where id = '$kid'";
		$readk  =  $db->select($queryk);
		if ($readk) {
			while ($resultk = $readk->fetch_assoc()) {
				
?>
	<meta name="keywords" content="<?php echo $resultk['tag'] ?>">
<?php	} }	}else{ ?>

	<meta name="keywords" content="<?php echo KEYWORDS ?>">

<?php } ?>












	
	<meta name="author" content="Delowar">
	<?php include "script/css.php";	?>
	<?php include "script/js.php";	?>



<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
			<?php
			    $query = "select * from title_slogan where id='1'" ;//selecting all data from db (title slogan logo)
			    $read  = $db->select($query);
			    if ($read ) {
			        while ($result = $read->fetch_assoc()) {  
			?>

				<img src="admin/<?php echo $result['logo'] ;?>" alt="Logo"/>
				<h2><?php echo $result['title'] ;?></h2>
				<p><?php echo $result['slogan'] ;?></p>
			<?php
					}//end while
				}//end if
			?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
			<?php
			    $querys = "select * from tbl_social where id='1'" ;//selecting all data from db (title slogan logo)
			    $reads  = $db->select($querys);
			    if ($reads ) {
			        while ($results = $reads->fetch_assoc()) {  
			?>
				<a href="<?php echo $results['fb'] ;?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $results['tw'] ;?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $results['ln'] ;?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $results['gg'] ;?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			<?php }} ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>

	<?php
		$act = $fr->title();
	?>
		<li><a <?php   if ($act == 'Home') { echo "id='active'"; } ?> href="index.php">Home</a></li>
			<?php
			    $query = "select * from tbl_page " ;//selecting all data from db (title slogan logo)
			    $readp  = $db->select($query);
			    if ($readp ) {
			        while ($resultp = $readp->fetch_assoc()) {  
			?>
		   <li><a
		   		<?php
		   			if (isset($_GET['pageid']) && $_GET['pageid'] == $resultp['id']) {
		   				echo "id='active'";
		   			}
		   		?>
		    href="page.php?pageid=<?php echo $resultp['id'];?>"><?php echo $resultp['name']; ?></a></li>

		<?php }}?>
		<li><a <?php   if ($act == 'Contact') { echo "id='active'"; } ?> href="contact.php">Contact</a></li>
	</ul>
</div>