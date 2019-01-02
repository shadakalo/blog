<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
<?php
	$query = "select * from tbl_category";
	$category = $db->select($query);
	//start of if condition to check $post is empty or not .........
	if ($category) {
	//starting while loop in order to fetch all data to show..........
		while ($read = $category->fetch_assoc()) {
?>

						<li><a href="posts.php?catid=<?php echo $read['id'];?>"><?php echo $read['name'];?></a></li>
<?php 
		}//endwhile
	}else{ echo "<li>NO CATEGORY TO SHOW</li>"; }
?>							
					</ul>
			</div>


			<div class="samesidebar clear">
				<h2>Latest articles</h2>
<?php
	$queryp = "select * from tbl_post limit 5";
	$sidepost = $db->select($queryp);
	//start of if condition to check $post is empty or not .........
	if ($sidepost) {
	//starting while loop in order to fetch all data to show..........
		while ($result = $sidepost->fetch_assoc()) {
?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php  echo $result['id'] ; ?>"><?php  echo $result['title'] ;   ?></a></h3>
						<a href="#"><img src="admin/<?php  echo $result['image'] ; ?>" alt="post image"/></a>
						<p><?php  echo $fr->textShorten($result['body'] ,120) ;   ?></p>	
					</div>	
<?php 
		}//endwhile
		// end if
		}else{ header("Location: 404.php"); }//end ifelse.........
?>
			</div>
		</div>
