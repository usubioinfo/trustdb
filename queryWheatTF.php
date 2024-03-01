<?php
// Start the session
ini_set('display_errors', 1);
error_reporting(1);
require("config.php");

// Set headers to allow all origins (be cautious with this in a production environment)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

$species = $_POST['species'] ?? '';
$namer = $_POST['namer'] ?? '';

if (!$species || !$namer) {
    echo "<script>console.log('Error: Missing species or namer in POST data.');</script>";
    exit;
}

$outfile = "tmp/" . $namer . "_OutputQuery.txt";

// Attempt database connection and select
$link = @mysqli_connect('localhost:3306', DB_USER, DB_PASSWORD);

if (!$link) {
    echo "<script>console.log('Error: Unable to connect to MySQL. " . mysqli_connect_error() . "');</script>";
    exit;
}

$link->set_charset("utf8");

if (!mysqli_select_db($link, 'trustdb')) {
    echo "<script>console.log('Error: Could not select database.');</script>";
    exit;
}

$query = "SELECT * FROM transcriptionFactors WHERE species='" . mysqli_real_escape_string($link, $species) . "'";

$result = mysqli_query($link, $query);

if (!$result) {
    echo "<script>console.log('Query Error: " . mysqli_error($link) . "');</script>";
    mysqli_close($link);
    exit;
}

$tabularFile = fopen($outfile, "w");
if (!$tabularFile) {
    echo "<script>console.log('File Error: Unable to open file.');</script>";
    mysqli_free_result($result);
    mysqli_close($link);
    exit;
}

while ($lineQueryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $accession = $lineQueryResult['accession'];
    $family = $lineQueryResult['TF_family'];
    $keggid = $lineQueryResult['keggID'];
    $keggdes = $lineQueryResult['description'];

    $line = $accession . "\t" . $family . "\t" . $keggid . "\t" . $keggdes;
    fwrite($tabularFile, $line . PHP_EOL);
}

fclose($tabularFile);
mysqli_free_result($result);
mysqli_close($link);

echo "<script>console.log('Data fetched successfully.');</script>";
?>
