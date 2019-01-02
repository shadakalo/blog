<?php
	include "inc/header.php";
?>
<style type="text/css">
	
	.error{
		color: red;
	}
	.suc{
		color: green;
	}
</style>

<?php
	$error = "";
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		$fname = $fr->validation($_POST['fname']);
		$lname = $fr->validation($_POST['lname']);
		$email = $fr->validation($_POST['email']);
		$body = $fr->validation($_POST['body']);

		$fname = mysqli_real_escape_string( $db->link, $fname);
		$lname = mysqli_real_escape_string( $db->link, $lname);
		$email = mysqli_real_escape_string( $db->link, $email);
		$body = mysqli_real_escape_string( $db->link, $body);


		if (empty($fname)) {	

			$error = '<span class = error>Firstname Can not be empty....</span>';

		}elseif (empty($lname)) {

			$error = '<span class = error>Lastname Can not be empty....</span>';

		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$error = '<span class = error>Invalid Email....</span>';

		}elseif (empty($body)) {
			$error = '<span class = error>Message Can not be empty...</span>';
		}else{
			
			$query = "insert into tbl_contact(fname,lname,email,body) values('$fname','$lname','$email','$body')";
			$insert = $db->insert($query);
			if ($insert) {
				$msg =  '<span class = suc>Message Send Successfully....</span>';
			}

		}


}	
?>




	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if (empty($msg)) {
						echo $error;
					}else{
						echo $msg; 
					}

				 ?>
					

			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="fname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
		
<?php
	
	include "inc/sidebar.php";
	include "inc/footer.php";

?>