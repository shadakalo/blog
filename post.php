<?php
	include "inc/header.php";
?>


<!-- getting id from index page-->
<?php
	$postid = mysqli_real_escape_string( $db->link, $_GET['id']);
	if (!isset($postid) || $postid == NULL) {
		header("Location: 404.php");
	}else{
		$id = $postid;
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
<!--fetching dta from DB-->
<?php
	$query = "select * from tbl_post where id=$id";
	$post = $db->select($query);
	if ($post) {
	while ($read=$post->fetch_assoc()) {
			$cat = $read['cat'] ;//saving cat id for selecting catagories below
?>

				<h2><?php  echo $read['title'] ;   ?></a></h2>
				<h4><?php echo $fr->formatDate($read['date']) ;   ?> By <a href="#"><?php  echo $read['author'] ;   ?></a></h4>
				<img src="admin/<?php  echo $read['image'] ; ?>" alt="MyImage"/>
				<p><?php  echo $read['body'] ;   ?></p>
<?php } //end while?>
<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://developerhut.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            	
			<div class="relatedpost clear">
				<h2>Related articles</h2>
<!--catagories-->
<?php
		$querycat = "select * from tbl_post where cat=$cat";
		$catagories = $db->select($querycat);
		if ($catagories) {
			while ($readcat=$catagories->fetch_assoc()) {
?>

					<a href="#"><img src="admin/<?php  echo $readcat['image'] ; ?>" alt="post image"/></a>
<?php 
	}//end cat while
		}else{ echo "NO CATEGORY TO SHOW"; }//end cat ifelse
?>		
<!--catagories-->	
			</div>
	</div>
		</div>
<?php
	//end if
	}else{ header("Location: 404.php");}	//end if else
?>		
	


<?php
	include "inc/sidebar.php";
	include "inc/footer.php";
?>