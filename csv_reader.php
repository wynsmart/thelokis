<?php 
header("Content-Type: text/html;charset=utf-8");
$filename = $_POST['filename'];
// echo $filename;
$file = fopen($filename, "r");
if ($file) {
	$parsedArray = array();
	while ($line = fgetcsv($file)) {
		array_push($parsedArray, $line);
	}
	fclose($file);
	echo json_encode($parsedArray);
}
?>