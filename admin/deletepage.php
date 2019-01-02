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
<?php
    if (!isset($_GET['id']) && $_GET['id'] == NULL) {
        echo "<script> window.location = 'adminindex.php'</script>";
    }else{
        $id= $_GET['id'];

        $queryd = "delete from tbl_page where id = '$id'"; 
        $delr   = $db->delete($queryd);
        if ($delr) {
        	 echo "<script>alert('Page deleted successfully');</script>";
        	 echo "<script> window.location = 'adminindex.php' ;</script>";
        }else{
        	echo "<script>alert('Page not deleted successfully');</script>";
        	 echo "<script> window.location = 'adminindex.php' ;</script>";
        }


    }

?>
