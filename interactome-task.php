<?php
// Start the session
ini_set('display_errors', 1);
error_reporting(1);

include 'dictionary.php';

$coverageA= $_POST['coverageA'];
$evalueA= $_POST['evalueA'];
$identityA= $_POST['identityA'];
$coverageB= $_POST['coverageB'];
$evalueB= $_POST['evalueB'];
$identityB= $_POST['identityB'];

$speciesA1= $_POST['speciesA1'];
$speciesB1= $_POST['speciesB1'];

$database= $_POST['database'];
$emailAddress= $_POST['emailAddress'];
$namer= $_POST['namer'];

$outfileA1B1 = $namer."_A1B1Output.txt";
$outfile = $namer."_Output.txt";
$outfileNET = $namer."_Output.json";

$databaseList = explode("_",$database);

$infoTaskFile = fopen("tmp/".$namer."_OutputTaskInfo.txt", "w") or die("Unable to open file!");
//$infoText = "Host interactome comparison results \n";

fwrite($infoTaskFile, $infoText);

$infoText = "Databases:";
fwrite($infoTaskFile, $infoText);
for ($i = 0; $i < sizeof($databaseList); $i++) {
	$databaseName = trim($databaseList[$i]);
	$infoText = "  $databaseName  ";
	if($i<sizeof($databaseList)-1){
		$infoText = "  $databaseName,";
	}
	fwrite($infoTaskFile, $infoText);
}

$infoText = "\n";
fwrite($infoTaskFile, $infoText);


$infoText = "Host: $speciesDictionary[$speciesA1]\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Minimum Identity (%): $identityA\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Minimum Coverage (%): $coverageA\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Expected value: $evalueA\n";
fwrite($infoTaskFile, $infoText);

$infoText = "Pathogen: $speciesDictionary[$speciesB1]\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Minimum Identity (%): $identityB\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Minimum Coverage (%): $coverageB\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Expected value: $evalueB\n";
fwrite($infoTaskFile, $infoText);

$infoText = "Email address provided: <span id=\"email-span\">$emailAddress</span>\n\n";
fwrite($infoTaskFile, $infoText);

fclose($infoTaskFile);

for ($i = 0; $i < sizeof($databaseList); $i++) {

	$outQueryA1B1 = "tmp/".$speciesA1."vs".$speciesB1."_".$databaseList[$i]."_ea".$evalueA."_ia".$identityA."_ca".$coverageA."_eb".$evalueB."_ib".$identityB."_cb".$coverageB.".txt";

	$queryA1B1 = "Rscript interologMatching.R ".$speciesA1." ".$speciesB1." ".$databaseList[$i]." ".$evalueA." ".$identityA." ".$coverageA." ".$evalueB." ".$identityB." ".$coverageB;

	if(!file_exists($outQueryA1B1)){
		exec($queryA1B1, $outputA1B1, $return_varA1B1);
	}
}

for ($i = 0; $i < sizeof($databaseList); $i++) {

	$catA1B1 = "cat tmp/".$speciesA1."vs".$speciesB1."_".$databaseList[$i]."_ea".$evalueA."_ia".$identityA."_ca".$coverageA."_eb".$evalueB."_ib".$identityB."_cb".$coverageB.".txt >> tmp/".$outfileA1B1;

	exec($catA1B1, $outputA1B1, $return_varA1B1);	
}

exec("cat tmp/".$outfileA1B1." > tmp/".$outfile, $outputTable, $return_varTable);



###JSON	 Network

$fileTabularA1B1 = fopen("tmp/".$outfileA1B1,"r");

### Arrays to create json object
$netNodes = array();
$netEdges = array();
$nodesAdded = array();
$netElements = array();
$edgesCounts = array();

while(! feof($fileTabularA1B1)){
    $line = fgets($fileTabularA1B1);
    if($line != false && $line != '\n' && trim($line) != ''){
        $separatedLine = explode("\t",$line);

        $hostId = $separatedLine[2];
        $pathogenId = $separatedLine[3];
        $database = $separatedLine[4];
        $speciesHost = $speciesDictionary[$separatedLine[5]];
	    $speciesPathogen = $speciesDictionary[trim($separatedLine[6])];
        $edgeLabel = $hostId."pp".$pathogenId;

        $databaseColor = '#FFFFFF';

    	if(trim($database)=="hpidb"){
			$databaseColor = '#7fa3b3';
		} else if(trim($database)=="mintdb"){
			$databaseColor = '#fd9a9f';
		} else if(trim($database)=="dipdb"){
			$databaseColor = '#bfbfbe';
		} else if(trim($database)=="biogriddb"){
			$databaseColor = '#f7eda0';
		} else if(trim($database)=="intactdb"){
			$databaseColor = '#7fc8a3';
		}  else if(trim($database)=="stringdb"){
			$databaseColor = '#a77fa1';
		}  else if(trim($database)=="phibasedb"){
			$databaseColor = '#111111';
		}

		$countEdges = 0;

		if(!in_array($edgeLabel,$edgesCounts)){
			$countEdges = intval($edgesCounts[$edgeLabel]);
			$edgesCounts[$edgeLabel] = intval($edgesCounts[$edgeLabel]) + 1;
		} else {
			$edgesCounts[$edgeLabel] = 1;
		}


		$nodeHostArray = array('id' => $hostId, 'label' => $hostId, 'color' => 'rgb(34,0,255)', 'organism' => $speciesHost);
		$nodePathogenArray = array('id' => $pathogenId, 'label' => $pathogenId, 'color' => 'rgb(184,0,9)', 'organism' => $speciesPathogen);


		$edgeArray = array('id' => $hostId.$pathogenId.trim($database).$countEdges, 'label' => $edgeLabel, 'source' => $hostId, 'target' => $pathogenId, 'color' => $databaseColor, 'type' => 'curvedArrow', 'count' => $countEdges);

		if(!in_array($hostId,$nodesAdded)){
			$netNodes[] = $nodeHostArray;
			array_push($nodesAdded,$hostId);
		}

		if(!in_array($pathogenId,$nodesAdded)){
			$netNodes[] = $nodePathogenArray;
			array_push($nodesAdded,$pathogenId);
		}
		$netEdges[] = $edgeArray;

    }
}

fclose($fileTabularA1B1);

unlink("tmp/".$outfileA1B1);

$netElements= array('nodes' => $netNodes,'edges' => $netEdges);
$simpleJson = json_encode($netElements, JSON_PRETTY_PRINT);

$netFile = fopen("tmp/".$outfileNET, "w") or die("Unable to open file!");
fwrite($netFile, $simpleJson);
fclose($netFile);

if($emailAddress != "noemail"){
	$msgEmail = "Your Interactome search job at TRustDB is done! \nPlease go to https://kaabil.net/trustdb/interactome-results.php?result=$namer to see it.";
	$msgEmail = wordwrap($msgEmail,70);
	$from = "noreply@kaabil.net";
	$headers = "From: $from"; 
	$mail= mail($emailAddress,"Interactome TRustDB results",$msgEmail,$headers,'-f '.$from);
	if($mail){
	  //echo "Email sent";
	}else{
	  //echo "Something went wrong with Mail."; 
	}
}

print_r($namer);
//print_r($_FILES);
//echo($_POST['evalue']);

?>