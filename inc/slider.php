<div class="slidersection templete clear">
        <div id="slider" >

        <?php

        	$query = "select * from tbl_slider";
        	$read  = $db->select($query);
        	if ($read) {
        		while ($result = $read->fetch_assoc()) {
        		

        ?>
            <a href="#" style="height: 25px;"><img  src="admin/<?php echo $result['image']?>" alt="nature 1" title="<?php echo $result['title']  ?>" /></a>

        <?php
          		}
        	}

        ?>
        </div>

</div>