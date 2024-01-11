<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Interolog-based protein-protein interactions between wheat and Puccinia species.">
        <meta name="author" content="Raghav Kataria">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/gallery/favicon.ico">

        <!-- App title -->
        <title>Triticum-Puccinia interactions : TRustDB</title>

        <!-- Plugins css-->
        <link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Custom box css -->
        <link href="assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-DCNJT2KP9D"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-DCNJT2KP9D');
        </script>


    </head>


    <body>

<!-- Navigation Bar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">

<div class="container-fluid pl-5">
<div class="row w-100 pl-4">

  <div class="col">
    <a class="" href="https://bioinfo.usu.edu">
      <img src='assets/images/kaabil_logo.png' height="70" alt="">
    </a>
  </div>
  <div class="col-5">

  </div>
  <div class="col-auto">
      <!-- <a href="index.html"><img src='assets/images/gallery/wheat_fav.png' height="40px"></a> -->
      <!-- <a href="index.html"><img src='assets/images/gallery/triticum_logo.png' height="75px"></a> -->
      <a href="https://www.usu.edu/"><img src='assets/images/gallery/usu-logo1.png' height="70px"></a>
  </div>
</div>
</div>
</nav>

<nav class="container-fluid usu-bg pl-5">
<div class="row py-3 pl-5">
<div class="col-auto pt-2">
    <a href="index.html" class="rk-nav-item"><i class="zmdi zmdi-home"></i> Home</a>
</div>

<div class="col-auto pt-2">
    <div class="dropdown">
        <div class="rk-nav-item dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="pe-7s-hammer"></i> Tools
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="interolog-wheat.html">Interactomics</a>
            <a class="dropdown-item" href="searchTrustDB.html">Advanced search module</a>
            <a class="dropdown-item" href="blast-submittion.html">BLAST search</a>
        </div>
      </div>
</div>

<div class="col-auto pt-2">
    <div class="dropdown">
        <div class="rk-nav-item dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="zmdi zmdi-format-list-bulleted"></i> Features
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="triticumHPI.php">Host-pathogen interactions</a>
            <div class="dropdown-divider"></div>
        
            <h6 class="ml-3" style="color:black"><b>Host</b></h6>
            <a class="dropdown-item" href="transcriptionFactors.php">Transcription Factors</a>
            <a class="dropdown-item" href="localizationHost.php">Subcellular Localization Annotations</a>
            <a class="dropdown-item" href="geneontologyHost.php">Gene Ontology (GO) Term Annotations</a>
            <a class="dropdown-item" href="domainsHost.php">Functional Domain Mappings (InterPro)</a>
            <hr>
        
            <h6 class="ml-3" style="color:black"><b>Pathogen</b></h6>
            <a class="dropdown-item" href="ortholog.php"><i>Puccinia</i> species Orthologs</a>
            <a class="dropdown-item" href="localization.php">Subcellular Localization Annotations</a>
            <a class="dropdown-item" href="geneontology.php">Gene Ontology (GO) Term Annotations</a>
            <a class="dropdown-item" href="domains.php">Functional Domain Mappings (InterPro)</a>
            <a class="dropdown-item" href="effector.php">Effector Proteins</a>
            <a class="dropdown-item" href="secretory.php">Secretory Proteins</a>
            <a class="dropdown-item" href="effectors.php">Effector and Secretory Proteins</a>
        </div>
      </div>
</div>

<div class="col-auto pt-2">
    <a href="genomicInformation.html" class="rk-nav-item"><i class="fa fa-database"></i> Datasets</a>
</div>

<div class="col-auto pt-2">
    <a href="help.html" class="rk-nav-item"><i class="ion-document-text"></i> User guide </a>
</div>

<div class="col-auto ml-auto">
  <form role="search" class="form-inline text-right">
      <select class="form-control select2 mr-2" id="searchSelect">
          <optgroup label="Puccinia species [Infecting Triticum]">
              <option value="pug99">Puccinia graminis Ug99</option>
              <option value="pgt21">Puccinia graminis 21-0</option>
          </optgroup>
      </select>
      <input id="proteinTOsearch" placeholder="Search e.g: 'GMQ_00017T0'" class="form-control mr-2" type="text">
      <a id="proteinSender" href=""><i class="fa fa-search" style="color:rgb(38, 92, 194)"></i></a>
    </form>
</div>
</div>
</nav>

<!-- End Navigation Bar-->




        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">How this data was obtained?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <p>
                                    The pre-calculated interactions were obtained by performing Interolog-based computational approach on <i>Triticum aestivum</i> and <i>Puccinia</i> proteomes.
                                </p>

                                <p>
                                    <b>Step 1:</b> The whole proteomes of <i>T. aestivum</i> and <i>Puccinia</i> species were BLAST searched against the known (standard) protein-protein interaction databases (DIP, BioGRID, HPIDB, IntAct, MINT, PHI-base, and STRING).
                                </p>

                                <p>
                                    <b>Step 2:</b> 112 BLAST parameter combinations were randomly generated on the basis of <u>sequence identity</u> (30%, 40%, 50%, 60%), <u>evalue</u> (1e-10, 1e-50, 1e-05, 1e-04, 1e-20, 1e-30, 1e-25), and <u>sequence coverage</u> (40%, 50%, 60%, 80%).
                                </p>

                                <p>
                                    <b>Step 3:</b> The combination with <b>identity >= 30%, evalue <= 1e-04, and coverage >= 40%</b> was considered as the best combination as the highest number of <i>Puccinia</i> effector proteins were identified in the interactions predicted using this combination.
                                </p>

                                <hr>

                                <p>
                                    We have also provided the respective interaction databases, in reference to which these interactions have been predicted.
                                </p>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-xl-8">
                        <h4 class="page-title"><i>Triticum aestivum</i> - <i>Puccinia</i> interactions <i class="zmdi zmdi-info-outline" style="font-size: 25px" data-toggle="modal" data-target="#modal"></i></h4>
                    </div>
                </div>

                <!-- end row --> 

                <div class="col-12">
                    <div class="card-box">
                        <!-- <div class="row">
                            <div class="col-md-5" id="speciesSelect" >
                                <select class="form-control select2" id="pseudomonasI" style="font-style: italic;">
                                    <optgroup label="Host species [Susceptible]" >
                                        <option value="Medicago sativa">Alfalfa</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-5" id="buttonSearch" >
                                <button type="button" class="btn btn-twitter waves-effect waves-light">
                                    <span class="btn-label"><i class="zmdi zmdi-search"></i></span>Search
                                </button>
                            </div>

                            <div class="col-md-2" id="downloadDiv" hidden="true">
                                <a id="downloadQueryBtn" href="" target="_blank" class="btn btn-purple waves-effect waves-light"download> Download Result <i class="fa fa-download" style="font-size: 20px"></i></a>
                            </div>

                        </div> -->
                        <br>

                        <table id="tableEffectors" class="table"  cellspacing="0" width="100%" style="font-size: 14px">
                            <thead class='thead-dark'>
                                <tr role="row">
                                    <th>Host protein</th>
                                    <th>Pathogen protein</th>
                                    <th>Host species</th>
                                    <th>Pathogen strain</th>
                                    <th style="width: 140px;">Interaction database</th>
                                </tr>
                            </thead>

<?php
// Start the session
ini_set('display_errors', 1);
error_reporting(1);
require("config.php");

$species= $_POST['species'];
$namer= $_POST['namer'];

$outfile = "tmp/".$namer."_OutputQuery.txt";

$link = mysqli_connect('localhost:3306', DB_USER, DB_PASSWORD) or die('Could not connect to mysql');
$link->set_charset("utf8");
mysqli_select_db($link,'trustdb') or die('Could not select database');

$query = 'SELECT * FROM HPIinterolog';
// WHERE hostSpecies="'.$species.'"';
// print_r($query);
$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

// $tabularFile = fopen($outfile, "w") or die("Unable to open file!");

while ($lineQueryResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){

    $triticumProtein = $lineQueryResult['hostProtein'];
    $pucciniaProtein = $lineQueryResult['pathogenProtein'];
    $hostSpecies = $lineQueryResult['hostSpecies'];
    $pathogenSpecies = $lineQueryResult['pathogenSpecies'];
    $source = $lineQueryResult['source'];

    //$line = $triticumProtein ."\t". $pucciniaProtein ."\t". $hostSpecies."\t". $pathogenSpecies."\t". $source;
    
    echo '<tr >';
    echo '<td><a href="https://plants.ensembl.org/Multi/Search/Results?species=all;idx=;q=' . $triticumProtein . '" target="_blank"> ' .$triticumProtein.' </a></td>';
    echo '<td><a href="https://fungi.ensembl.org/Multi/Search/Results?species=all;idx=;q=' . $pucciniaProtein . '" target="_blank">' . $pucciniaProtein . '</a></td>';
    //echo '<td ">' . $pucciniaProtein . '</td>';
    echo '<td ">' . $hostSpecies . '</td>';
    echo '<td ">' . $pathogenSpecies . '</td>';
    echo '<td ">' . $source . '</td>';
    echo '</tr >';
	// print_r($line);
	// print_r('\n');

//
	//fwrite($tabularFile, $line);
	//fwrite($tabularFile, PHP_EOL);

}

mysqli_free_result($result);
mysqli_close($link);
//fclose($tabularFile);
// print_r($namer);

?>
                            
                        </table>
                    </div>
                </div> <!-- end row -->

            </div> <!-- container -->


            <!-- Footer -->
            <footer class="footer">
                © 2022 &nbsp|&nbsp <a  href="https://www.usu.edu"  target="_blank">Utah State University</a> &nbsp|&nbsp  <a href="https://bioinfo.usu.edu"  target="_blank">Kaundal Artificial Intelligence & Advanced Bioinformatics Laboratory</a> &nbsp|&nbsp <a href="https://www.psc.usu.edu"  target="_blank">Department of Plants, Soils, and Climate</a> &nbsp|&nbsp <a href="https://www.biosystems.usu.edu"  target="_blank">Center for Integrated BioSystems </a>
            </footer>
           
            <!-- End Footer -->

        </div> <!-- End wrapper -->

        

<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script><!-- Tether for Bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>

<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
<script src="assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>


<!-- file uploads js -->
<script src="assets/plugins/fileuploads/js/dropify.min.js"></script>

<!-- Modal-Effect -->
<script src="assets/plugins/custombox/js/custombox.min.js"></script>
<script src="assets/plugins/custombox/js/legacy.min.js"></script>

<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!-- Required datatable js -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>


<script type="text/javascript">

$(document).ready(function() {
    $('#tableEffectors').DataTable( {
        buttons: [
            'copy', 'excel', 'pdf'
                ]
    } );
} );
</script>

    </body>
</html>
