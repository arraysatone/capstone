<?php
	/*
	*    ArraysAtOne Capstone 2018 - Maple Leaf Foods
	*
	*    Kevin Baumgartner
	*    Jesse Berube
	*    Marc Harquail
	*    Alex Ireland
	*
	* * * * * * * * * * * * * * * * * * * * * * * * *
	*
	*    set_GET_uid.php
	*    
	*    Alex Ireland
	*
	*/
	if(isset($_GET['uid'])) {
		echo $_GET['uid'];
	} else {
		echo $_SESSION['uid'];
	}
	?>