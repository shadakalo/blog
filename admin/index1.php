
<?php
	include "../lib/session.php";
	session::init();
?>
<?php
	include "../lib/Database.php";
	include "../helpers/format.php";
	include "../config/config.php";
?>
<?php
	// creating objects 
	$db = new Database;
	$fr = new format;
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

<!--getting user data from form-->
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		$username = $fr->validation($_POST['username']);
		$password = $fr->validation(md5($_POST['password']));

		$username = mysqli_real_escape_string( $db->link, $username);
		$password = mysqli_real_escape_string( $db->link, $password);

		$query = "select * from tbl_user where username = '$username' and password = '$password'";
		$result = $db->select($query);
		if ($result != false) {
			$value = mysqli_fetch_array($result);
			$row   = mysqli_num_rows($result);

			if ($row>0) {
				session::set('login',true);
				session::set('userid',$value['id']);
				session::set('role',$value['role']);
				session::set('username',$value['username']);
				echo "<script>window.location='adminindex.php';</script>"; 
			}else{
				echo "<span style='color:red'>Username/Password Incorrect</span>";
			}
		}else{
				echo "<span style='color:red'>Username/Password Incorrect</span>";
		}

	}
?>
		<form action="#" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgetpass.php">|| Forget Password ||</a>
		</div><!-- button -->
		<div class="button">
			
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>