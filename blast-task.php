<?php
// Start the session
session_start();

#ini_set('display_errors',1);

$weightMatrix= $_POST['weightMatrix'];
$evalue= $_POST['evalue'];
$numberResults= $_POST['numberResults'];
$database= $_POST['database'];
$typeSeq= $_POST['typeSeq'];

$emailAddress= $_POST['emailAddress'];
$blastType= $_POST['blastType'];

$namer = microtime(true);

$inFilename= '/var/www/html/trustdbV1/tmp/' . $namer . '_BlastInput.txt';
#$inFilename= '/var/www/trustdbV1/tmp/' . microtime(true).'_BlastInput.txt';
$outFilename= '/var/www/html/trustdbV1/tmp/' . $namer . '_BlastOutput.asn';
$outFilenamePairwise= '/var/www/html/trustdbV1/tmp/' . $namer . '_BlastOutputPairwise.txt';
$outFilenameTabular= '/var/www/html/trustdbV1/tmp/' . $namer . '_BlastOutputTabular.txt';
$outFilenameAlignments= '/var/www/html/trustdbV1/tmp/' . $namer . '_BlastOutputAlignments.txt';
$outInfoFilename= '/var/www/html/trustdbV1/tmp/' . $namer . '_TaskInfo.txt';



$blastInstruction = $blastType . " -db BlastDB/".$database;


if($typeSeq == "file"){
	if (!copy($_FILES['sequences']['tmp_name'], $inFilename)) {
	    echo "Unable to open file!...\n";
	}

} else if($typeSeq == "text"){
	$sequences= $_POST['sequences'];
	$fastafile = fopen($inFilename, "w") or die("Unable to open file!");
	$fastaTxt = $sequences;
	fwrite($fastafile, $fastaTxt);
	fclose($fastafile);
} 

$blastInstruction .= " -query " . $inFilename;

$blastInstruction .= " -evalue " . $evalue . " -matrix " . $weightMatrix . " -out " . $outFilename ;

if($numberResults != ">50"){
	$blastInstruction .= " -num_alignments " . $numberResults . " -num_descriptions " . $numberResults;
}

$blastInstruction .= " -outfmt 11 ";

$blastPairwiseFormatInstruction = "blast_formatter -archive ". $outFilename . " -outfmt 0 -out " . $outFilenamePairwise;
$blastTabularFormatInstruction = "blast_formatter -archive ". $outFilename . " -outfmt 6 -out " . $outFilenameTabular;
$blastAlignmentsFormatInstruction = "blast_formatter -archive ". $outFilename . " -outfmt 1 -out " . $outFilenameAlignments;
//unlink($inFilename);



//print_r($blastInstruction);

exec($blastInstruction, $output, $return_var);
exec($blastPairwiseFormatInstruction, $output, $return_var);
exec($blastTabularFormatInstruction, $output, $return_var);
exec($blastAlignmentsFormatInstruction, $output, $return_var);



if($emailAddress != "noemail"){
	$msgEmail = "Your BLAST job at TRustDB is completed! \nPlease go to https://bioinfo.usu.edu/trustdb/blast-results.php?result=$namer to see it.";
	$msgEmail = wordwrap($msgEmail,70);
	$from = "noreply@bioinfo.usu.edu";
	$headers = "From: $from"; 
	$mail= mail($emailAddress,"TRustDB BLAST results",$msgEmail,$headers,'-f '.$from);
	if($mail){
	  //echo "Email sent";
	}else{
	  //echo "Something went wrong with Mail."; 
	}
}


$infoTaskFile = fopen($outInfoFilename, "w") or die("Unable to open file!");
$infoText = "Database: $database\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Blast type: $blastType\n";
fwrite($infoTaskFile, $infoText);
$infoText = "WeightMatrix: $weightMatrix\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Expected value: $evalue\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Number of results per query (maximum): $numberResults\n";
fwrite($infoTaskFile, $infoText);
$infoText = "Email address provided: <span id=\"email-span\">$emailAddress</span>\n\n";
fwrite($infoTaskFile, $infoText);
fclose($infoTaskFile);

#file_put_contents($outFilename, $file_data);

print_r($namer);
//print_r($_FILES);

//echo($_POST['evalue']);


session_destroy();

?>
