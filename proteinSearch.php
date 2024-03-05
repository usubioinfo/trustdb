<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Protein description">
        <meta name="author" content="Raghav Kataria">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/gallery/favicon.ico">

        <!-- App title -->
        <title>TRustDB- Protein search</title>


        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

        <style type="text/css">
            p.closeCategory {
                margin-bottom:2px;
            }
        </style>


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

	<?php
          // Start the session
          //header("Access-Control-Allow-Origin: *");
          ini_set('display_errors',0);
          $accession = $_GET['protein'];
          $species = $_GET['species'];

          include 'dictionary.php';

          $outfile = "tmp/".$accession."_".$species.".txt";
          $fasta = "tmp/".$accession."_".$species.".fasta";
          

        ?>

<!-- End Navigation Bar-->



        <!-- ============================================================== 
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container" style="width: 75%; padding-top: 20px;">

                <!-- Page-Title -->
                <?php

                $DOMFound = array();
                $ISFound = array();

                if(file_exists($outfile)){


                    echo '<div class="row">';
                    echo '    <div class="col-xs-12 col-lg-12 col-xl-7">';
                    echo '        <div id="basicPanel" class="card m-b-20 card-body" style="height:460px;">';


                    $fileTabular = fopen($outfile,"r");
                    $line = fgets($fileTabular);
                    echo '    <h5 style=" color: #008000;">'.$line.'</h5>';
                    echo '<hr>';

                    $strain = fgets($fileTabular);
                    echo '    <h6>Strain: </h6><i>'.$speciesDictionary[trim($strain)].'</i>';
                    echo '<hr>';
                    echo '<br>';

                    $description = fgets($fileTabular);
                    $replicon = fgets($fileTabular);
                    $repliconAcc = fgets($fileTabular);
                    $locus_new = fgets($fileTabular);
                    $genomicRange = fgets($fileTabular);
                    $length = fgets($fileTabular);
                    $geneName = fgets($fileTabular);
                    $oldlocus = fgets($fileTabular);

                    $HPIFound = array();
                    $SEFound = array();
                    $SLFound = "";
                    $HLBFound = array();
                    $PSEFound = array();
                    $annot = array();

                    while(! feof($fileTabular)){
                        $line = fgets($fileTabular);
                        if(substr($line, 0,4)=="HPI:"){
                            array_push($HPIFound, $line);
                        } elseif(substr($line, 0,3)=="SE\t"){
                            array_push($SEFound, $line);
                        } elseif(substr($line, 0,3)=="SL:"){
                            $lineExploded = explode(":",$line);
                            $SLFound = $lineExploded[1];
                        } elseif(substr($line, 0,3)=="IS\t"){
                            $lineExploded = explode("\t",$line);

                            $domLine = $lineExploded[1];
                            $domLineExploded = explode("_",$domLine);

                            if(!in_array($lineExploded[1],$DOMFound) & !empty(trim($domLineExploded[1]))){
                                array_push($DOMFound, $lineExploded[1]);
                            }

                            $goTerms = explode("|",$lineExploded[2]);
                            foreach ($goTerms as &$value){
                                if(!in_array($value,$GOFound) & trim($value) != ""){
                                    array_push($GOFound, $value);
                                }
                            }
                            
                            if(!in_array($lineExploded[3],$ISFound) & !empty(trim($lineExploded[3]))){
                                array_push($ISFound, $lineExploded[3]);
                            }
                        } elseif(substr($line, 0,4)=="HLB\t"){
                            $lineExploded = explode("\t",$line);
                            array_push($HLBFound, $line);
                            array_push($annot, $lineExploded[1]);

                        } elseif(substr($line, 0,4)=="PSE:"){
                            array_push($PSEFound, $line);
                        }
                    }


                    echo '<div class="row">';
                    echo '<div class="col-md-5">';
                    echo '    <h6>Description: </h6><p>'.$description.'</p>';
                    // echo '    <h6>Location: </h6><p>'.$SLFound.'</p>';
                    // echo '    <h6>Replicon: </h6><p>'.$replicon.'</p>';
                    echo '    <h6>NCBI Reference Sequence: </h6><p><a href="https://www.ncbi.nlm.nih.gov/nuccore/'.$repliconAcc.'?report=graph" target="_blank"> '.$repliconAcc.'</a></p>';
                    echo '</div>';

                    echo '<div class="col-md-5">';
                    echo '    <h6>Position in replicon (bp): </h6><p>'.$genomicRange.'</p>';
                    echo '    <h6>Length: </h6><p>'.$length.'</p>';
                    echo '    <h6>Locus tag: </h6><p>'.$locus_new.'</p>';
                    echo '</div>';

                    echo '</div>';
                    echo '<hr>';
                    echo '        </div>';
                    echo '    </div><!-- end col-->';

                    echo '    <div class="col-xs-12 col-lg-12 col-xl-5">';

                    echo '        <div id="annotPanel" class="card m-b-20 card-body" style="height:400px; overflow-y:scroll;">';
                    echo '<hr>';

                    // echo '    <h6>Subcellular localization: </h6>';
                    // if(strlen($SLFound) > 0){
                    //     echo '    <p class="closeCategory">'.$SLFound.'</p>';
                    // }
                    // echo '<hr>';

                    echo '    <h6> <b>InterProScan:</b> </h6>';
                    echo '<hr>';

                    echo '    <h6> Annotations </h6>';
                    if(count($ISFound) > 0){
                        
                        foreach ($ISFound as &$value){

                            $interproRecord = explode("_",$value);
                            if(!empty(trim($interproRecord[0]))){

                                echo '    <p class="closeCategory"><a href="https://www.ebi.ac.uk/interpro/entry/InterPro/'.$interproRecord[0].'/" target="_blank">'. $interproRecord[0] .'</a>: '.$interproRecord[1].'</p>';
                            }


                        }
                        
                    }

                    echo '<hr>';

                    echo '    <h6> Functional domains </h6>';
                    if(count($DOMFound) > 0){
                        
                        foreach ($DOMFound as &$value){

                            $domainRecord = explode("_",$value);
                            if(!empty(trim($domainRecord[1]))){

                                echo '    <p class="closeCategory">'. $domainRecord[0] .': '.$domainRecord[1].'</p>';
                            }


                        }
                        
                    }

                    echo '<hr>';

                    echo '    <h6> Gene Ontology </h6>';

                    if(count($GOFound) > 0){
                        
                        echo '    <p class="closeCategory">';

                        foreach ($GOFound as &$value){
                             
                            $goRecord = explode("_",$value);
                            if(!empty(trim($goRecord[0]))){

                                echo '<a href="http://amigo.geneontology.org/amigo/term/'.$goRecord[0].'" target="_blank">'. $goRecord[0].'</a> ';
                            }


                        }

                        echo '</p>';
                        
                    }

                    echo '<hr>';
                    
                    echo '        </div>';
                    echo '    </div><!-- end col-->';
                    echo '</div>';

                    $furtherAnnot = count($SEFound) + count($HLBFound) + count($HPIFound);

                    if($furtherAnnot > 0 ){
                        echo ' <div class="card m-b-20 card-body">';

                        if(count($SEFound) > 0){

                            echo '<hr>';

                            
                            foreach ($SEFound as &$value){

                                $SERecord = explode("\t",$value);
                                if(!in_array($SERecord[1],$annot)){
                                    if(!empty(trim($SERecord[1]))){

                                        $pmids = $SERecord[2];
                                        $pmidArray = explode(", ", $pmids);
                                        $pmidString = "";
                                        foreach ($pmidArray as &$valuePMC){
                                            $pmidString = $pmidString.'<a href="https://www.ncbi.nlm.nih.gov/pubmed/'.trim($valuePMC).'" target="_blank">'.trim($valuePMC).'</a>, ';
                                        }
                                        $pmidString = substr($pmidString,0,strlen($pmidString)-2);

                                        echo '    <p>'. $SERecord[1] .' ('.$pmidString.') </p>';
                                    }
                                }
                                


                            }

                            
                        }

                        if(count($HLBFound) > 0){

                            echo '<hr>';
                            
                            foreach ($HLBFound as &$value){

                                $HLBRecord = explode("\t",$value);
                                if(!empty(trim($HLBRecord[1]))){

                                    $pmids = $HLBRecord[2];
                                    $pmidString = "";

                                    if(!strpos($pmids,"http")){
                                        $pmidArray = explode(", ", $pmids);
                                        
                                        foreach ($pmidArray as &$valuePMC){
                                            $pmidString = $pmidString.'<a href="https://www.ncbi.nlm.nih.gov/pubmed/'.trim($valuePMC).'" target="_blank">'.trim($valuePMC).'</a>, ';
                                        }
                                        $pmidString = substr($pmidString,0,strlen($pmidString)-2);
                                    } else {
                                        $pmidString = '<a href="'.$pmids.'" target="_blank">Link to reference</a>';
                                    }

                                    echo '    <p>'. $HLBRecord[1] .' ('.$pmidString.') </p>';
                                }


                            }

                            
                        }

                        if(count($HPIFound) > 0){

                            echo '<hr>';

                            echo '    <h6>Host-pathogen interactions: </h6>';
                            
                            foreach ($HPIFound as &$value){


                                $hpiRecord = explode(":",$value);
                                if(!empty(trim($hpiRecord[3]))){

                                    $pmids = $hpiRecord[2];
                                    $pmidString = "";

                                    if($pmids != 'Manuscript in preparation'){
                                        $pmidArray = explode(", ", $pmids);
                                        
                                        foreach ($pmidArray as &$valuePMC){
                                            $pmidString = $pmidString.'<a href="https://www.ncbi.nlm.nih.gov/pubmed/'.trim($valuePMC).'" target="_blank">'.trim($valuePMC).'</a>, ';
                                        }
                                        $pmidString = substr($pmidString,0,strlen($pmidString)-2);
                                    } else {
                                        $pmidString = 'Predicted with <a href="http://127.0.1.1:80/PredHPI/" target="_blank">PredHPI</a>';
                                    }

                                    echo '    <p class="closeCategory">'.$hpiRecord[3].' ('.$pmidString.')</p>';
                                }


                            }
                            
                        }

        

                        echo '<hr>';

                        echo '</div>';


                    }
                    

                    echo ' <div class="card m-b-20 card-body">';
                    
                    echo '    <h5 style=" color: #008000;">Sequence</h5>';
                    echo '<hr>';
                    $fastaFile = fopen($fasta,"r");
                    $line = fgets($fastaFile);
                    echo $line;
                    echo '<br>';
                    $sequence = '';
                    while(! feof($fastaFile)){
                        $line = fgets($fastaFile);
                        $sequence = $sequence.trim($line);
                    }

                    echo $sequence;

                    echo '</div>';


                } else {
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


        <?php
          
          $countAnnot = count($ISFound) + count($DOMFound);
          
        ?>
        <script type="text/javascript">

            $(document).ready(function(){

                var countAnnot = <?php  echo(json_encode($countAnnot)); ?>;

                console.log(countAnnot);

                if(countAnnot==0){

                } else if(countAnnot > 0 & countAnnot <= 6){

                    document.getElementById("basicPanel").style.height = "460px";
                    document.getElementById("annotPanel").style.height = "460px";


                } else if(countAnnot <= 9){

                    document.getElementById("basicPanel").style.height = "550px";
                    document.getElementById("annotPanel").style.height = "550px";

                } else if(countAnnot <= 18){

                    document.getElementById("basicPanel").style.height = "650px";
                    document.getElementById("annotPanel").style.height = "650px";

                }  else {

                    document.getElementById("basicPanel").style.height = "800px";
                    document.getElementById("annotPanel").style.height = "800px";

                } 


                });


        </script>


        

        <script>
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
