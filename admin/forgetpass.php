<?php
 session_start();
 if ($_SESSION['login'] == false) {
    echo "<script>window.location='index.php';</script>"; 
 }
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
<title>Recover Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

<!--getting user data from form-->
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		$email = $fr->validation($_POST['email']);
		$email = mysqli_real_escape_string( $db->link, $email);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<span class='error'> Enter valid email ..</span>";
        }else{

        	$query = "select * from tbl_user where email = '$email'";
        	$read  = $db->select($query);
        	if ($read == false) {
        		echo "<span class='error'> Email doesn't exists  ..</span>";
        	}else{

        		while ($result = $read->fetch_assoc()) {
        			$userid = $result['id'];
        			$name = $result['username'];
        			
        		}
        		$text = substr($email, '0','3');
        		$rand = rand(10000,99999);
        		$newpass = "$text$rand";
        		$newpass = md5($newpass);

        		$querypass = "UPDATE tbl_user SET password = '$newpass' where id = '$userid'" ;
                $updatepass = $db->update($querypass);


                $to       = "$email";
                $from     = "shadakaloths@gmail.com";
                $headers   = "From : $from\n";
                $headers .= 'MIME-Version: 1.0';
				$headers .= 'Content-type: text/html; charset=iso-8859-1';
				$subject = "New Password!!!";
				$message =	"your new password is".$newpass;

                $sendmail = mail($to, $subject, $message, $headers);


                if ($sendmail) {
                	echo "<span class='success'> Please check your mail for password</span>";
                }else{
                	echo "<span class='error'> Something went wrong try again ...</span>";
                }



        	}


        }
		

	}
?>
		<form action="" method="post">
			<h1>Recover Password</h1>
			<div>
				<input type="text" placeholder="Enter your email...." required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send" />
			</div>
		</form><!-- form -->

		<div class="button">
			<a href="login.php">|| Login ||</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>