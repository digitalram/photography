<?php

	$curPage = explode('?',$_SERVER['REQUEST_URI']);
    
			//decides which page to display
			switch($curPage[1]) {
				case 'id=master.php': 
				case 'id=master_friday.php': 
				case 'id=master_saturday.php': 
				case 'id=reviewer.php':
				case 'id=reviewee.php':
				case 'id=individual.php':
					break;
					default:
					$display = 'style="display:none;"';
				}
?>


<div class="pdf" <?php echo $display;?>>
	<a class="button" href="index.php" onclick="return false;"><</a>
	<p><a href="index.php" onclick="return false;">Print this Schedule (to download schedule, print as a PDF).</a></p>
</div>