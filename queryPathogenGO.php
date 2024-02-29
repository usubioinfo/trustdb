<?php
// Start the session
ini_set('display_errors', 1);
error_reporting(1);
require("config.php");

// Set headers to allow all origins
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

$species= $_POST['species'];
$namer= $_POST['namer'];

$outfile = "tmp/".$namer."_OutputQuery.txt";

$link = mysqli_connect('localhost:3306', DB_USER, DB_PASSWORD) or die('Could not connect to mysql');
$link->set_charset("utf8");
mysqli_select_db($link,'trustdb') or die('Could not select database');

$query = 'SELECT * FROM ipscan_go WHERE species="'.$species.'"';

$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));


$tabularFile = fopen($outfile, "w") or die("Unable to open file!");

while ($lineQueryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	$accession = $lineQueryResult['accession'];
	$goTerms = $lineQueryResult['goTerms'];
	$interproAcc = $lineQueryResult['interproAcc'];
	$interproDesc = $lineQueryResult['interproDesc'];


	$line = $accession ."\t". $goTerms ."\t". $interproAcc ."\t". $interproDesc ;
	print_r($line);
	print_r('\n');


	fwrite($tabularFile, $line);
	fwrite($tabularFile, PHP_EOL);

}


mysqli_free_result($result);

mysqli_close($link);
fclose($tabularFile);

print_r($namer);

?>
