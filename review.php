<?php
	include("includes/config.php");
	include("includes/classes/Review.php");
	include("includes/classes/Constants.php"); 
	include("includes/header.php");

	if(isset($_SESSION['userId'])) {
		$userId=$_SESSION['userId'];		
	}
	if (isset($_GET['id'])){
		$_SESSION['productId']= $_GET['id'];
	}
	$review = new Review($userId,$_SESSION['productId'],$con);
	include("includes/handlers/review-handler.php");
?>
	<div id="reviewContainer" style="text-align: center; padding-top: 200px; ">
		<form id="reviewForm" action="review.php" method="Post">
			<p>
				<label for="reviewText">Review </label>
				<br>
				<textarea id="reviewText" name="reviewText" type="text"  style="color: black; height: 70px; width: 800px;" required></textarea>
			</p>
			<?php echo $review->getError(Constants::$alreadyReviewed)."<br>"; ?>
			<?php echo $review->getError(Constants::$reviewLength)."<br>"; ?>
			<br>
			<button type="submit" name="reviewButton" style="color: black">SUBMIT</button>
		</form>
	</div>
<?php
		if(isset($_POST['reviewButton']) && empty(($review->errorArray))==true){
			echo '<p style="text-align: center;">Thanks for the review !</p>';
			echo '<p style="text-align: center;">We detected your review was '.$review->getSentiment().'</p>';
		} 
?>

<?php
 include("includes/footer.php"); 
?>
