<?php
	include "inc/header.php";
	include "inc/slider.php";
?>
<!--getting cat id from url-->
<?php
	$catid = mysqli_real_escape_string( $db->link, $_GET['catid']);
	if (!isset($catid) || $catid == NULL) {
		header("Location: 404.php");
	}else{
		$id =$catid;
	}
?>
		<div class="contentsection contemplete clear">
			<div class="maincontent clear">
		<!--sql query to read category post from DB ........ -->
<?php
	$query = "select * from tbl_post where cat=$id";
	$catpost = $db->select($query);
	//start of if condition to check $post is empty or not .........
	if ($catpost) {
	//starting while loop in order to fetch all data to show..........
		while ($read = $catpost->fetch_assoc()) {
?>
					<div class="samepost clear">
						<h2><a href="post.php?id=<?php  echo $read['id'] ; ?>"><?php  echo $read['title'] ;   ?></a></h2>
						<h4><?php echo $fr->formatDate($read['date']) ;   ?> By <a href="#"><?php  echo $read['author'] ;   ?></a></h4>
						 <a href="#"><img src="admin/<?php  echo $read['image'] ; ?>" alt="post image" width = 220px;   height = 140px;/></a>
						<p>
							<?php  echo $fr->textShorten($read['body']) ;   ?>
						</p>
						<div class="readmore clear">
							<a href="post.php?id=<?php  echo $read['id'] ;   ?>">Read More</a>
						</div>
					</div>
<?php 
	}//end catpost while
		}else{ echo "NO Post TO SHOW"; }//end catpost ifelse
?>
			</div>
<?php	
	include "inc/sidebar.php";
	include "inc/footer.php";
?>