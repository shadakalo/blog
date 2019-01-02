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
    if (!isset($_GET['postid']) && $_GET['postid'] == NULL) {
        echo "<script> window.location : 'postlist.php'</script>";
    }else{
        $id= $_GET['postid'];

       $query = "select * from tbl_post where id = '$id'"; // to unlink image or delete image from folder......
       $read  = $db->select($query);
       if ($read) {
        	while ($result = $read->fetch_assoc()) {
        		
        		$img = $result['image'];
        		unlink($img);

        	}
        }

        $queryd = "delete from tbl_post where id = '$id'"; 
        $delr   = $db->delete($queryd);
        if ($delr) {
        	 echo "<script>alert('Data deleted successfully');</script>";
        	 echo "<script> window.location = 'postlist.php' ;</script>";
        }else{
        	echo "<script>alert('Data not deleted successfully');</script>";
        	 echo "<script> window.location = 'postlist.php' ;</script>";
        }


    }

?>
