	
	

<?php
	function curPageName() {
		$var1 = split('=',$_SERVER['REQUEST_URI']);
		return $var1[1];
	}

	$curPage = curPageName();
?>

    <div id="top_header">
        
        <header>
        	<a href="index.php"><img src="images/logo.gif" /></a>
            <h1>portfolio review schedule</h1>
            
        </header>
        <nav id="top_nav">
            <ul>
                
                <li <?php if($curPage == 'reviewer.php'){
                    echo 'id="active"';} ?> ><a href="reviewer.php">reviewer schedule</a></li>
                
                <li <?php if($curPage == 'reviewee.php'){
                    echo 'id="active"';} ?> ><a href="reviewee.php">reviewee schedule</a></li>

               <li class="master" <?php if($curPage == 'master.php'){
                    echo 'id="active"';} ?> ><a href="master.php">master schedule</a>
                   	 	<ul>
                        	<li><a href="master_friday.php">friday schedule</a></li>
                            <li><a href="master_saturday.php">saturday schedule</a></li>
                        
                        </ul>
                    
                    </li>

               
            </ul>
            
        </nav>
        
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
