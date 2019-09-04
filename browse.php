<?php 
	include("includes/header.php"); 
?>
	<div id="searchBarContainer">
		<div id="searchBar">
			<a href="search.php" class="searchBox">
				<img src="assets/images/icons/search.png" class="icon" alt="Search">
			</a>
		</div>
	</div>

	<div id="viewContainer">
			<div id="sideBar">
			</div>
			<div id="viewArea">
				<?php 
				$productQuery=mysqli_query($con,"SELECT * FROM products ORDER BY RAND() LIMIT 12");
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
	</div>
<?php include("includes/footer.php") ?>