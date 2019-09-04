<?php include("includes/header.php"); ?>
<h1 style="margin-left: 20px; margin-right: 100px; display: block;">Dashboard</h1>
<?php
$result=mysqli_query($con,"SELECT productId,COUNT(*) FROM reviews GROUP BY productId ");
$axis_x=array();
$axis_y=array();
while ($row=mysqli_fetch_array($result)){
	array_push($axis_x,$row['productId']);
	array_push($axis_y,$row['COUNT(*)']);
}
$axis_x="[".rtrim(implode(',', $axis_x), ',')."]";
$axis_y="[".rtrim(implode(',', $axis_y), ',')."]";

$result=mysqli_query($con,"SELECT productId,COUNT(*) FROM reviews WHERE sentiment='Positive' GROUP BY productId ORDER BY productId");
$px=array();
$pn=array();
while ($row=mysqli_fetch_array($result)){
	array_push($px,$row['productId']);
	array_push($pn,$row['COUNT(*)']);
}
$px="[".rtrim(implode(',', $px), ',')."]";
$pn="[".rtrim(implode(',', $pn), ',')."]";

$result=mysqli_query($con,"SELECT productId,COUNT(*) FROM reviews WHERE sentiment='Negative' GROUP BY productId ORDER BY productId");
$nx=array();
$nn=array();
while ($row=mysqli_fetch_array($result)){
	array_push($nx,$row['productId']);
	array_push($nn,$row['COUNT(*)']);
}
$nx="[".rtrim(implode(',', $nx), ',')."]";
$nn="[".rtrim(implode(',', $nn), ',')."]";
?>

<div style="width: 40%; margin: 30px; float: left;">
	<h3 style="text-align: center;">Product Id vs No. of Reviews</h3>
	<canvas id="lineChart" height="400" width="600" "></canvas>
<?php

echo '
	<script>
		$(document).ready(function() {
			const CHART = document.getElementById("lineChart");
			console.log(CHART);
			let lineChart = new Chart( CHART, {
				type : "line",
				data: {
        		labels: '.$axis_x.',
		        datasets: [
        			{
            		label: "Number of Reviews",
            		backgroundColor: "rgba(75, 72, 192,0.3)",
            		borderColor: "rgb(75, 72, 192)",
            		data: '.$axis_y.',
        			}
        	    ]
        	    }
        	});
	});
	</script>';
?>
</div>

<div style="width: 40%; float: right; margin: 30px;">
<h3 style="text-align: center;">Positive Reviews Distribution</h3>
<canvas id="pieChart" height="200" width="400" "></canvas>
<?php
echo '
	<script>
		$(document).ready(function() {
			const CHART = document.getElementById("pieChart");
			console.log(CHART);
        	let pieChart = new Chart( CHART, {
				type : "doughnut",
				data: {
        		labels: '.$px.',
		        datasets: [
        			{
            		label: "Number of Reviews", 
          backgroundColor:["rgba(0, 221, 32,0.8)","rgba(73, 179, 93,0.8)","rgba(214, 217, 52,0.8)","rgba(3, 148, 109,0.8)","rgba(149, 179, 9,0.8)","rgba(59, 90, 19,0.8)"],
            		borderColor:"rgba(0,0,0,0)",
            		data: '.$pn.',
        			}
        	    ]
        	    }

		});
	});
	</script>';
?>
</div>

<div style="width: 40%; float: right; margin: 30px;">
<h3 style="text-align: center;">Negative Reviews Distribution</h3>
<canvas id="donutChart" height="200" width="400" "></canvas>
<?php
echo '
	<script>
		$(document).ready(function() {
			const CHART = document.getElementById("donutChart");
			console.log(CHART);
        	let donutChart = new Chart( CHART, {
				type : "doughnut",
				data: {
        		labels: '.$nx.',
		        datasets: [
        			{
            		label: "Number of Reviews", 
  backgroundColor:["rgba(207, 31, 41,0.8)","rgba(175,90,30,0.8)","rgba(204, 21, 28,0.8)","rgba(144, 21, 29,0.8)","rgba(255, 85, 0,0.8)","rgbproductId.8)"],
            		borderColor:"rgba(0,0,0,0)",
            		data: '.$nn.',
        			}
        	    ]
        	    }

		});
	});
	</script>';
?>
</div>
	

<?php include("includes/footer.php"); ?>