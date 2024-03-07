<?php
// Start the session
ini_set('display_errors', 1);
error_reporting(1);
require("config.php");

$proteinName= $_GET['protein'];
$speciesName= $_GET['species'];

$proteinAccesion = $proteinName;

$link = mysqli_connect('localhost:3306', DB_USER, DB_PASSWORD) or die('Could not connect to mysql');
$link->set_charset("utf8");
mysqli_select_db($link,'trustdb') or die('Could not select database');


$query = 'SELECT * FROM oldNewPuccinia WHERE oldAccesion LIKE "%'.$proteinName.'%"';
$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
if($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$proteinName= trim($queryResult['newAccesion']);
}
mysqli_free_result($result);



$query = 'SELECT * FROM proteinDescription WHERE (locus_tag LIKE "%'.$proteinName.'%" OR accession LIKE "%'.$proteinName.'%") AND species="'.$speciesName.'"';


$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

if ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	$outfile = "tmp/".$queryResult['accession']."_".$speciesName.".txt";
	$fasta = "tmp/".$queryResult['accession']."_".$speciesName.".fasta";

	$tabularFile = fopen($outfile, "w") or die("Unable to open file!");

	fwrite($tabularFile, $queryResult['accession']);
	fwrite($tabularFile, PHP_EOL);

	fwrite($tabularFile, $queryResult['species']);
	fwrite($tabularFile, PHP_EOL);

	fwrite($tabularFile, $queryResult['description']);
	fwrite($tabularFile, PHP_EOL);

	fwrite($tabularFile, $queryResult['chromosome']);
	fwrite($tabularFile, PHP_EOL);

	fwrite($tabularFile, $queryResult['accesionNCBI']);
	fwrite($tabularFile, PHP_EOL);

	fwrite($tabularFile, $queryResult['locus_tag']);
	fwrite($tabularFile, PHP_EOL);

	fwrite($tabularFile, $queryResult['sstart']."-".$queryResult['send']);
	fwrite($tabularFile, PHP_EOL);


	fwrite($tabularFile, $queryResult['length']);
	fwrite($tabularFile, PHP_EOL);

	///fwrite($tabularFile, $queryResult['locus']);
	///fwrite($tabularFile, PHP_EOL);

	$proteinAccesion = $queryResult['accession'];
	$proteinTAG = $queryResult['locus_tag'];

	mysqli_free_result($result);


	$query = 'SELECT * FROM oldNewPuccinia WHERE newAccesion LIKE "%'.$proteinTAG.'%"';
	$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

	if($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		fwrite($tabularFile, $queryResult['oldAccesion']);
		fwrite($tabularFile, PHP_EOL);
	}
	mysqli_free_result($result);

	###HPI

	$query = 'SELECT * FROM HPIinterolog WHERE pathogenProtein="'.$proteinAccesion.'" AND pathogenSpecies="'.str_replace("_"," ",$speciesName).'"';
	$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

	while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		
		fwrite($tabularFile, "HPI:".$queryResult['hostProtein']." interacts With ".$queryResult['pathogenProtein']);
		fwrite($tabularFile, PHP_EOL);

	}

	mysqli_free_result($result);


	### Effectors

	$query = 'SELECT * FROM effectors WHERE accessions="'.$proteinTAG.'" AND species="'.$speciesName.'"';
	$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

	while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		
		fwrite($tabularFile, "SE\t".$queryResult['category']."\t".$queryResult['source']);
		fwrite($tabularFile, PHP_EOL);

	}

	mysqli_free_result($result);

	###Localization

	$query = 'SELECT * FROM localizations WHERE accession="'.$proteinAccesion.'" AND species="'.$speciesName.'"';
	//print_r($query);
	$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

	while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		
		fwrite($tabularFile, "SL:".$queryResult['location']);
		fwrite($tabularFile, PHP_EOL);

	}

	mysqli_free_result($result);

	###GO and Domain

	$query = 'SELECT * FROM ipscan_go WHERE accession="'.$proteinAccesion.'" AND species="'.$speciesName.'"';
	$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

	while ($queryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		
		fwrite($tabularFile, "IS\t".$queryResult['signatureAccesion']."_".$queryResult['signatureDescription']."\t".$queryResult['goTerms']."\t".$queryResult['interproAcc']."_".$queryResult['interproDesc']);
		fwrite($tabularFile, PHP_EOL);

	}

	mysqli_free_result($result);


	mysqli_free_result($result);
	mysqli_close($link);
	fclose($tabularFile);

	$getSequence = "samtools faidx ProteomesFASTA/".$speciesName.".faa ".$proteinAccesion;
    exec($getSequence,$commandOutput,$returnVar);

    file_put_contents($fasta, implode("\n",$commandOutput));

}

	


header("Location: proteinSearch.php?protein=".$proteinAccesion."&species=".$speciesName);


?>
