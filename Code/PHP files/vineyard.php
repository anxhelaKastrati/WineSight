<?php
 
$dataPoints = array(
	array("y" => 10, "label" => "month1"),
	array("y" => 12, "label" => "month2"),
	array("y" => 15, "label" => "month3"),
	array("y" => 20, "label" => "month4"),
	array("y" => 21, "label" => "month5"),
	array("y" => 22, "label" => "month6"),
	array("y" => 24, "label" => "month7")
);
 
?>

<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Sugar level"
	},
	axisY: {
		title: "Brix"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<style>

   .go {
                width: 70%; 
                padding: 10px; 
                text-align: right;
            }
   .go a {

                text-decoration: none;
                background: blue;
                color: white;
                font-size: 14px;
                border-radius: 5px;
                padding: 5px;
            }
	#chartContainer{
		height: 270px; 
		width: 40%;
		position:relative;
		bottom:870px;
		left:700px;
	}
</style>
</head>
<body>
<div class="go">
<a href="specialist.php">Go back</a>
</div>
<img src="12.png" style="width:50%">

<div id="chartContainer"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>