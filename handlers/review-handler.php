<?php

if(isset($_POST['reviewButton'])) {
	$wasSuccessful=$review->review($_POST['reviewText']);
	if($wasSuccessful == true){
		header("Location:browse.php");
	}
}

?>
