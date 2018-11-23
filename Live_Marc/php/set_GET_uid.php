<?php
	if(isset($_GET['uid'])) {
		echo $_GET['uid'];
	} else {
		echo $_SESSION['uid'];
	}
	?>