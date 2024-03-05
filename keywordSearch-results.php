<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Protein description results">
        <meta name="author" content="Raghav Kataria">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/gallery/favicon.ico">

        <!-- App title -->
        <title>TRustDB- Keyword search Result</title>


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
      <a id="proteinSender" href=""><i class="fa fa-search" style="color:rgb(197, 223, 81)"></i></a>
    </form>
</div>
</div>
</nav>
<!-- End Navigation Bar-->




        <!-- ============================================================== 
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <?php

                $namer = $_GET['result'];

                $outfile = "tmp/".$namer."_KeywordQuery.txt";

                $emptyfile = true;
                $num_records = sizeof(file($outfile));

                if($num_records > 0){
                    $emptyfile = false;
                }

                if(!$emptyfile){

                    

                    echo '<div class="row">';
                    echo '    <div class="col-sm-12">';
                    echo '        <h4 class="page-title"> Keyword Search Result  </h4>';
                    echo '    </div>';
                    echo '</div>';

                    echo '<div class="col-12">';
                    echo '    <div class="card-box" >';

                    echo '                         <table id="datatable-buttons" class="table mb-0"  style="font-size:14px;" cellspacing="0" width="100%">';
                    echo '                          <thead class="thead-light">
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Accession: activate to sort column ascending" style="width: 180px;">Protein ID</th>    
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Strain: activate to sort column descending" style="width: 200px;">Strain</th>
                                            <!--<th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Replicon: activate to sort column ascending" style="width: 100px;">Replicon</th>-->
                                            <!--<th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Replicon accession: activate to sort column ascending" style="width: 121px;">Replicon accession</th>-->
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Gene coordinates: activate to sort column descending" style="width: 169px;">Gene coordinates</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Length: activate to sort column ascending" style="width: 100px;">Length</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 250px;">Description</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Gene name: activate to sort column ascending" style="width: 121px;">Gene ID</th> 
                                        </tr>
                                    </thead>
                                    <tbody style="font-size:14px;">';

                    $fileTabular = fopen($outfile,"r");
                    $odd = true;
                    while(! feof($fileTabular)){
                        $line = fgets($fileTabular);
                        if($line != false && $line != '\n' && trim($line) != ''){
                            $separatedLine = explode("\t",$line);
                            if($odd){
                                echo '<tr role="row" class="odd">';
                            } else {
                                echo '<tr role="row" class="odd">';
                            }
                            //echo '<td>' . $speciesDictionary[$separatedLine[0]] . '</td>';
                            //echo '<td>' . $separatedLine[0] . '</td>';
                            echo '<td class="sorting_1"><a href="http://127.0.1.1:80/trustdb/proteinSearchQuery.php?protein='.$separatedLine[3].'&species=' . $separatedLine[0] . '" target="_blank">'. $separatedLine[3] .'</a></td>';
                            echo '<td>' . "<i>Pgt</i> Ug99" . '</td>';
                            // echo '<td>' . $separatedLine[1] . '</td>';
                            // echo '<td>' . $separatedLine[2] . '</td>';
                            echo '<td>' . $separatedLine[4] . '</td>';
                            echo '<td>' . $separatedLine[5] . '</td>';
                            echo '<td>' . $separatedLine[6] . '</td>';
                            echo '<td><a href="https://www.ncbi.nlm.nih.gov/gene/' . $separatedLine[7] . '" target="_blank">'. $separatedLine[7] . '</a></td>';
                            echo '</tr>';

                            
                        }
                      }
                    fclose($fileTabular);

                    echo '    </tbody>';
                    echo ' </table>';


                    echo '    </div>';
                    echo ' </div><!-- end col-->';


                } 
                else {
                    echo '        <div class="card m-b-20 card-body" style="margin-top:100px;">';
                    echo '<h1 style="color: #039cfd;">ACCESSION NOT FOUND.</h1><h2 style="color: #1bb99a;">No record was found in TRustDB that matched your query, please retry with another accession. Thanks.</h2>';
                    echo '</div>';

                }

                ?>
                <!-- end row -->



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
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!-- Counter Up  -->

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

        

        <script>

            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
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
