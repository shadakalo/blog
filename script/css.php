<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
 <?php
        $queryr = "select * from tbl_theme where id='1'";
        $read   = $db->select($queryr);
        $result = mysqli_fetch_assoc($read);
        $thm   = $result['theme'];
        if ($thm == 'default') {
            echo '<link rel="stylesheet" href="theme/default.css">';
         }elseif ($thm == 'green') {
           echo '<link rel="stylesheet" href="theme/green.css">';
         }elseif ($thm == 'red') {
            echo '<link rel="stylesheet" href="theme/red.css">';
         }
?>