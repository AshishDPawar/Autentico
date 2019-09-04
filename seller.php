<?php 
	include("includes/header.php"); 
	if (isset($_GET['id'])){
		$sellerId= $_GET['id'];
	}
	else{
		header("Location: browse.php");
	}
?>

<div id="heading">
	<h1>
		<?php
			$sellerQuery=mysqli_query($con,"SELECT * FROM sellers WHERE sellerId='$sellerId'");
			$seller=mysqli_fetch_array($sellerQuery);
			$name=$seller['name'];
			echo $name;
		?>
	</h1>
</div>
<hr style="width: 100%;">
<div id="productsArea">
	<?php 
	$productQuery=mysqli_query($con,"SELECT * FROM products WHERE sellerId=$sellerId ORDER BY RAND() LIMIT 12");
	while($row=mysqli_fetch_array($productQuery)){
		echo "<a href='product.php?id=" .$row['id'] . "'>
				<div class='card'>
					<div class='image'>
						<img src='"  .  $row['imagePath']  .  "' >
					</div>
	  				<div class='cardContainer'>
	    				<h4><b>"  .$row['name'].  "</b></h4> 
	    				<p>Rs. "  .$row['price'].  "</p> 
	  		    	</div>
	  		    </a>	 
	  		  </div>";
	}
	?>
</div>

<?php include("includes/footer.php"); ?>