<?php
	include "inc/header.php";
?>
<!--getting data from url-->
<?php
	$searchid = mysqli_real_escape_string( $db->link, $_GET['search']);
	if (!isset($searchid) || $searchid == NULL) {
		echo "<script> window.location = '404.php'</script>";
	}else{
		$search = $searchid;
	}
?>
		<div class="contentsection contemplete clear">
			<div class="maincontent clear">
		<!--sql query to read searched post from DB ........ -->
<?php
	$query = "select * from tbl_post where title like '%$search%' or body like '%$search%' ";
	$catpost = $db->select($query);
	//start of if condition to check $catpost is empty or not .........
	if ($catpost) {
	//starting while loop in order to fetch all data to show..........
		while ($read = $catpost->fetch_assoc()) {
?>
					<div class="samepost clear">
						<h2><a href="post.php?id=<?php  echo $read['id'] ; ?>"><?php  echo $read['title'] ;   ?></a></h2>
						<h4><?php echo $fr->formatDate($read['date']) ;   ?> By <a href="#"><?php  echo $read['author'] ;   ?></a></h4>
						 <a href="#"><img src="admin/<?php  echo $read['image'] ; ?>" alt="post image"/></a>
						<p>
							<?php  echo $fr->textShorten($read['body']) ;   ?>
						</p>
						<div class="readmore clear">
							<a href="post.php?id=<?php  echo $read['id'] ;   ?>">Read More</a>
						</div>
					</div>
<?php 
	}//end catpost while
		}else{ echo "No Matched Data"; }//end catpost ifelse
?>
			</div>
<?php	
	include "inc/sidebar.php";
	include "inc/footer.php";
?>