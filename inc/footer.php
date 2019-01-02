

	
	</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>

	<?php
		$act = $fr->title();
	?>
		<li><a href="index.php">Home</a></li>
			<?php
			    $query = "select * from tbl_page " ;//selecting all data from db (title slogan logo)
			    $readp  = $db->select($query);
			    if ($readp ) {
			        while ($resultp = $readp->fetch_assoc()) {  
			?>
		   <li><a
		   		
		    href="page.php?pageid=<?php echo $resultp['id'];?>"><?php echo $resultp['name']; ?></a></li>

		<?php }}?>
		<li><a  href="contact.php">Contact</a></li>
	</ul>
	  </div>
<?php
    $query = "select * from tbl_cpyr8 where id='1'" ;//selecting all data from db (title slogan logo)
    $read  = $db->select($query);
    if ($read ) {
        while ($result = $read->fetch_assoc()) {  
?>
	  <p>&copy; <?php echo $result['note']."  ".date('Y')  ?> </p>
<?php }} ?>
	</div>
	<div class="fixedicon clear">
	<?php
			    $querys = "select * from tbl_social where id='1'" ;//selecting all data from db (title slogan logo)
			    $reads  = $db->select($querys);
			    if ($reads ) {
			        while ($results = $reads->fetch_assoc()) {  
	?>
		<a href="<?php echo $results['fb'] ;?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $results['tw'] ;?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $results['ln'] ;?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $results['gg'] ;?>"><img src="images/gl.png" alt="GooglePlus"/></a>
	<?php }} ?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
<script id="dsq-count-scr" src="//developerhut.disqus.com/count.js" async></script>
</body>
</html>