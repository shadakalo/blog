<?php
	include "inc/header.php";
	include "inc/slider.php";
?>	
<!--PAGINATION-->
<?php
	$post_num = 3;
	if(isset($_GET['page'])){
		$page = mysqli_real_escape_string( $db->link,$_GET['page']);
	}else{
		$page = 1;
	}
	$start_from = ($page-1)*$post_num;
?>
<!--PAGINATION-->
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		<!--sql query to read post from DB ........ -->
<?php
	$query = "select * from tbl_post limit $start_from, $post_num";
	$post = $db->select($query);
	//start of if condition to check $post is empty or not .........
	if ($post) {
	//starting while loop in order to fetch all data to show..........
		while ($read = $post->fetch_assoc()) {
?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php  echo $read['id'] ; ?>"><?php  echo $read['title'] ;   ?></a></h2>
				<h4><?php echo $fr->formatDate($read['date']) ;   ?> By <a href="#"><?php  echo $read['author'] ;   ?></a></h4>
				 <a href="#"><img src="admin/<?php  echo $read['image'] ;?>" alt="post image"   width = 220px;   height = 140px; /></a>
				<p>
					<?php  echo $fr->textShorten($read['body']) ;   ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php  echo $read['id'] ;   ?>">Read More</a>
				</div>
			</div>
<?php }//end while ?>

	<!-- PAGINATION -->
<?php
	// query in order to get total rows for pagination 
	$query 		 = "select * from tbl_post ";
	$result		 = $db->select($query); 
	$total_row 	 = mysqli_num_rows($result);
	$total_page  = ceil($total_row/$post_num);
	echo "<span class=pagination><a href='index.php?page=1'>".'first page'."</a>";
	for ($i=1; $i <=$total_page ; $i++) { 
		echo "<a href='index.php?page=".$i."'>".$i."</a>";
	}
	echo "<a href='index.php?page=$total_page'>".'last page'."</a></span>";
?>
	<!-- PAGINATION -->
<?php 
		// end if
		}else{ header("Location: 404.php"); }//end ifelse.........
?>

</div>
<?php	
	include "inc/sidebar.php";
	include "inc/footer.php";
?>