<?php
// Start the session
ini_set('display_errors', 1);
error_reporting(1);
require("config.php");

// Set headers to allow all origins
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

$namer= $_POST['namer'];

$keyword= $_POST['keyword'];
$speciesName= $_POST['species'];

$minLength= $_POST['minLength'];
$maxLength= $_POST['maxLength'];
$sstart= $_POST['sstart'];
$ssend= $_POST['ssend'];

$subloc= $_POST['subloc'];


$outfile = "tmp/".$namer."_KeywordQuery.txt";

$accessionsFound = array();

$link = mysqli_connect('localhost:3306', DB_USER, DB_PASSWORD) or die('Could not connect to mysql');
$link->set_charset("utf8");
mysqli_select_db($link,'trustdb') or die('Could not select database');


$query = 'SELECT * FROM oldNewPuccinia WHERE oldAccesion LIKE "%'.$keyword.'%"';

$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

while($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	if(!in_array($queryResult['newAccesion'],$accessionsFound)){
		array_push($accessionsFound,$queryResult['newAccesion']);
	}
}

mysqli_free_result($result);


$query = 'SELECT * FROM proteinDescription WHERE locus_tag LIKE "%'.$keyword.'%" OR accession LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%"';

$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	if(!in_array($queryResult['accession'],$accessionsFound)){
		array_push($accessionsFound,$queryResult['accession']);
	}

}

mysqli_free_result($result);


###HPI

$query = 'SELECT * FROM HPIinterolog WHERE hostProtein LIKE "%'.$keyword.'%"';
$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	if(!in_array($queryResult['pathogenProtein'],$accessionsFound)){
		array_push($accessionsFound,$queryResult['pathogenProtein']);
	}

}

mysqli_free_result($result);


### Effectors

$query = 'SELECT * FROM effectors WHERE description LIKE "%'.$keyword.'%" OR accessions LIKE "%'.$keyword.'%"';
$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	if(!in_array($queryResult['locusAlt'],$accessionsFound)){
		array_push($accessionsFound,$queryResult['locusAlt']);
	}

}

mysqli_free_result($result);


###Localization

$query = 'SELECT * FROM localizations WHERE location LIKE "%'.$keyword.'%" OR location="'.trim($subloc).'"';

if($subloc=="ALL"){
	$query = 'SELECT * FROM localizations WHERE location LIKE "%'.$keyword.'%"';
}

$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	if(!in_array($queryResult['accession'],$accessionsFound)){
		array_push($accessionsFound,$queryResult['accession']);
	}

}

mysqli_free_result($result);



# GO & Domain

$query = 'SELECT * FROM ipscan_go WHERE signatureAccesion LIKE "%'.$keyword.'%" OR signatureDescription LIKE "%'.$keyword.'%" OR interproAcc LIKE "%'.$keyword.'%" OR interproDesc LIKE "%'.$keyword.'%"';
$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	if(!in_array($queryResult['accession'],$accessionsFound)){
		array_push($accessionsFound,$queryResult['accession']);
	}

}

mysqli_free_result($result);



# Final Description Query & SubLoc

$query = 'SELECT * FROM proteinDescription NATURAL JOIN localizations WHERE accession IN ("'.implode('","', $accessionsFound).'") AND length BETWEEN '.$minLength.' AND '.$maxLength.' AND sstart >='.$sstart.' AND send <='.$ssend.' AND location="'.trim($subloc).'" AND species="'.$speciesName.'"';

if($subloc=="ALL"){

	$query = 'SELECT * FROM proteinDescription WHERE accession IN ("'.implode('","', $accessionsFound).'") AND length BETWEEN '.$minLength.' AND '.$maxLength.' AND sstart >='.$sstart.' AND send <='.$ssend.' AND species="'.$speciesName.'"';

	if($speciesName=="ALL"){
		$query ='SELECT * FROM proteinDescription WHERE accession IN ("'.implode('","', $accessionsFound).'") AND length BETWEEN '.$minLength.' AND '.$maxLength.' AND sstart >='.$sstart.' AND send <='.$ssend;

	}

} elseif($speciesName=="ALL"){
	$query ='SELECT * FROM proteinDescription NATURAL JOIN localizations WHERE accession IN ("'.implode('","', $accessionsFound).'") AND length BETWEEN '.$minLength.' AND '.$maxLength.' AND sstart >='.$sstart.' AND send <='.$ssend.' AND location="'.trim($subloc).'" ';
}



$tabularFile = fopen($outfile, "w") or die("Unable to open file!");

$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	$species = $queryResult['species'];
	$replicon = $queryResult['chromosome'];
	$repliconAccesion = $queryResult['accesionNCBI'];
	$accession = $queryResult['accession'];
	$coordinates = $queryResult['sstart']."-".$queryResult['send'];
	$length = $queryResult['length'];
	$description = $queryResult['description'];
	$genename = $queryResult['geneid'];
	$locus_new = $queryResult['locus_tag'];

	$line = $species."\t". $replicon."\t". $repliconAccesion."\t". $accession."\t". $coordinates."\t". $length."\t". $description. "\t".$genename."\t".$locus_new."\t";

	fwrite($tabularFile, $line);
	fwrite($tabularFile, PHP_EOL);

}

mysqli_free_result($result);

fclose($tabularFile);


mysqli_close($link);



print_r($namer);



?>
