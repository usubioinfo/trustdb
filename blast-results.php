<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="BLAST results for the input sequences at TRustDB.">
        <meta name="author" content="Raghav Kataria">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/gallery/favicon.ico">

        <!-- App title -->
        <title>BLAST Results - TRustDB</title>

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

        <?php
	    #ini_set('display_errors',1);
        // Start the session
        $namer = $_GET['result'];
        $filename = '/var/www/html/trustdbV1/tmp/' . $namer . '_BlastOutputPairwise.txt';
        $blastOutput = file_get_contents($filename);
        ?>


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
    <a class="" href="http://127.0.1.1:80">
      <img src='assets/images/kaabil_logo.png' height="70" alt="">
    </a>
  </div>
  <div class="col-5">

  </div>
  <div class="col-auto">
      <!-- <a href="index.html"><img src='assets/images/gallery/favicon.ico' height="40px"></a> -->
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


                <!-- Page-Title -->
                <div class="row">
                    <div class="col-xl-8">
                        <h4 class="page-title">BLAST Results</h4>
                    </div>
                </div>

                <!-- end row --> 

                <div class="col-12">
                    <div class="card-box">

                        <ul class="nav nav-pills m-b-10" id="myTabalt" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="summarized-tab1" data-toggle="tab" href="#summarized" role="tab" aria-controls="summarized" aria-expanded="true" aria-selected="true">Summarized</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="detailed-tab1" data-toggle="tab" href="#detailed1" role="tab" aria-controls="detailed" aria-selected="false">Detailed</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabaltContent">
                            <div role="tabpanel" class="tab-pane fade in active show" id="summarized" aria-labelledby="summarized-tab">
                                <div class="card-box table-responsive">
                                    <p class="text-dark">
<?php

$namer = $_GET['result'];
$filenameInfo = '/var/www/html/trustdbV1/tmp/' . $namer . '_TaskInfo.txt';

$fileInfo = fopen($filenameInfo,"r");
$line = fgets($fileInfo);
$odd = true;
while(! feof($fileInfo)){
    $line = fgets($fileInfo);
    if($line != false && $line != '\n' && trim($line) != ''){
        $separatedLine = explode(":",$line);
        if($odd){
            echo "<b>".$separatedLine[0].":</b>".$separatedLine[1]. ", ";
            $odd = false;
        } else {
            echo "<b>".$separatedLine[0].":</b>".$separatedLine[1]. "</br>";
            $odd = true;
        }
    }
  }
fclose($fileInfo);

?>
                                    </p>
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Query: activate to sort column descending" style="width: 169px;">Query</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Hit: activate to sort column ascending" style="width: 248px;">Hit</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Score: activate to sort column ascending" style="width: 121px;">Score</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Identity: activate to sort column ascending" style="width: 56px;">Identity</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Length: activate to sort column ascending" style="width: 114px;">Length</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Evalue: activate to sort column ascending" style="width: 96px;">Evalue</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php

$namer = $_GET['result'];
$filenameInfo = '/var/www/html/trustdbV1/tmp/' . $namer . '_BlastOutputTabular.txt';

$fileTabular = fopen($filenameInfo,"r");
$odd = true;
while(! feof($fileTabular)){
    $line = fgets($fileTabular);
    if($line != false && $line != '\n' && trim($line) != ''){
        $separatedLine = explode("\t",$line);
        if($odd){
            echo '<tr role="row" class="odd">';
        } else {
            echo '<tr role="row" class="even">';
        }
        echo '<td class="sorting_1">' . $separatedLine[0] . '</td>';
        echo '<td>' . $separatedLine[1] . '</td>';
        echo '<td>' . $separatedLine[11] . '</td>';
        echo '<td>' . $separatedLine[2] . '</td>';
        echo '<td>' . $separatedLine[3] . '</td>';
        echo '<td>' . $separatedLine[10] . '</td>';
        echo '</tr>';
        
    }
  }
fclose($fileTabular);

?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php  $namer = $_GET['result'];$downloadFile = "tmp/" . $namer . "_BlastOutputAlignments.txt";echo '<a href="'.$downloadFile.'" download>(Download the alignments)</a>'; ?>
                            </div>
                            <div class="tab-pane fade" id="detailed1" role="tabpanel" aria-labelledby="detailed-tab">
                                <div id="blast-multiple-alignments"></div>
                                <div id="blast-alignments-table"></div>
                                <div id="blast-single-alignment"></div>
                            </div>
                        </div>
                    </div>


                </div>


                <!-- end row -->

            </div> <!-- container -->


            <!-- Footer -->
            <footer class="footer">
                © 2022 &nbsp|&nbsp <a  href="https://www.usu.edu"  target="_blank">Utah State University</a> &nbsp|&nbsp  <a href="http://127.0.1.1:80"  target="_blank">Kaundal Artificial Intelligence & Advanced Bioinformatics Laboratory</a> &nbsp|&nbsp <a href="https://www.psc.usu.edu"  target="_blank">Department of Plants, Soils, and Climate</a> &nbsp|&nbsp <a href="https://www.biosystems.usu.edu"  target="_blank">Center for Integrated BioSystems </a>
            </footer>
            <!-- End Footer -->

        


        </div> <!-- End wrapper -->




        

        <!-- jQuery  -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

        <script type="text/javascript" src="assets/js/html2canvas.js"></script>  
        <script type="text/javascript" src="assets/js/blaster.min.js"></script>   

        

        
        <script type="text/javascript">
            
            var blasterjs = require("biojs-vis-blasterjs");
            var blastOutput = <?php  echo(json_encode($blastOutput)); ?>;
            //console.log("We came here");
            //console.log(blastOutput);
            var instance = new blasterjs({
             string: blastOutput,
             multipleAlignments: "blast-multiple-alignments",
             alignmentsTable: "blast-alignments-table",
             singleAlignment: "blast-single-alignment"
            });
          
        </script>

        <script src="assets/js/config.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                const email = document.getElementById('email-span').textContent;

                const messageBody = window.location.href;
                const password = EPASSWORD;
                const subjectLine = "TRustDB BLAST Results";
                const recipient = email;
                const user = 'TRustDB';

                const body = {
                    password,
                    messageBody,
                    subjectLine,
                    recipient,
                    user
                }

                axios.post('http://127.0.1.1:80/api/email/send', body)
                    .then(res => {
                        console.log(res);
                    })
                    .catch(err => {
                        console.log('Error');
                        console.log(err);
                    })


                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

            $("#proteinTOsearch").on('input', function() {
                var proteinName = $(this).val();

                if($.trim(proteinName)!=""){
                    $('#proteinSender').attr('href', "proteinSearchQuery.php?protein="+$.trim(proteinName)+"&species="+$('select#searchSelect').val());
                }
            });


            $("#searchSelect").change(function() {
                $('#proteinSender').attr('href', "proteinSearchQuery.php?protein="+$.trim($('input#proteinTOsearch').val())+"&species="+$(this).val());
            });


        </script>

    </body>
</html>
