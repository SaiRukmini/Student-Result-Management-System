<?php
$telugu = $_GET['telugu'];
$hindi = $_GET['hindi'];
$english = $_GET['english'];
$maths = $_GET['maths'];
$science = $_GET['science'];
$social = $_GET['social'];
// Start the session if it's not already started
/*if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Retrieve session variables for each subject's marks
$telugu = isset($_SESSION['marks']['telugu']) ? $_SESSION['marks']['telugu'] : 0;
$hindi = isset($_SESSION['marks']['hindi']) ? $_SESSION['marks']['hindi'] : 0;
$english = isset($_SESSION['marks']['english']) ? $_SESSION['marks']['english'] : 0;
$maths = isset($_GET['maths']) ? intval($_GET['maths']) : 0; // Retrieve Maths marks from URL parameter
$science = isset($_SESSION['marks']['science']) ? $_SESSION['marks']['science'] : 0;
$social = isset($_SESSION['marks']['social']) ? $_SESSION['marks']['social'] : 0;*/

$totalMarks = [$telugu, $hindi, $english, $maths, $science, $social];

$dataPoints = array( 
	array("y" => $telugu, "label" => "Telugu" ),
	array("y" => $hindi, "label" => "Hindi" ),
	array("y" => $english, "label" => "English" ),
	array("y" => $maths, "label" => "Maths" ),
	array("y" => $science, "label" => "Science" ),
	array("y" => $social, "label" => "Social" )
);
?>

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		theme: "light2",
		title:{
			text: "Performance Graph"
		},
		axisY: {
			title: "Marks Secured",
			minimum: 0,
			maximum: 100,
			interval: 10
		},
		data: [{
			type: "column",
			yValueFormatString: "#,##0.##",
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>
