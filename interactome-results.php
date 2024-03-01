<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Host-pathogen Interactome Results">
        <meta name="author" content="Raghav Kataria">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/gallery/favicon.ico">

        <!-- App title -->
        <title>Interactome - TRustDB</title>

        <!-- Plugins css-->
        <link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />


        <!-- DataTables -->
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

        <!-- Sigma js -->


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-DCNJT2KP9D"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-DCNJT2KP9D');
        </script>



    </head>

<?php

header("Access-Control-Allow-Origin: *");



?>

    <body>

<!-- Navigation Bar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="container-fluid pl-5">
    <div class="row w-100 pl-4">

    <div class="col">
        <a class="" href="https://kaabil.net">
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

<!-- End Navigation Bar-->





        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
<?php


ini_set('display_errors', 0);

$namer = $_GET['result'];

$running_bool = file_exists('tmp/' . $namer . '_OutputTaskInfo.txt'); ///if exist is running
$finished_bool = file_exists('tmp/' . $namer . '_Output.txt'); ///if exist is finished

$empty_results = true;


if($finished_bool){

    $num_interactions = sizeof(file('tmp/' . $namer . '_Output.txt'));

    if($num_interactions > 0){
        $empty_results = false;
    }

    if(!($empty_results)){

        $filenameInfo = 'tmp/' . $namer . '_OutputTaskInfo.txt';

        $fileInfo = fopen($filenameInfo,"r");
        $odd = true;

        echo "<div class='card m-b-20' style='background-color: #ffdb99; border-color: #333;'>";
        echo "<div class='card-body'>";
        $lineNumber = 1;

        while(! feof($fileInfo)){
            $line = fgets($fileInfo);
            if($line != false && $line != '\n' && trim($line) != ''){

                if($lineNumber==1){
                    echo "<h5 class='card-title' style='color:#ff3a19;'>".$line."</h5>";
                } else if($lineNumber==2){
                    echo "<h6 style='font-style: italic;' 'color:#ff3a19;'>".$line."</h6>";
                } else if($lineNumber==3 || $lineNumber==4 || $lineNumber==5 ){
                    $separatedLine = explode(";",$line);

                    if($lineNumber==3 || $lineNumber==4 ){
                        echo "<b>".$separatedLine[0]."; </b>".$separatedLine[1]."</span>";
                    } else {
                        echo "<b>".$separatedLine[0]."; </b>".$separatedLine[1]."</span></br></br>";
                    }
                
                } else if($lineNumber==6){
                    echo "<h6 style='font-style: italic;' 'color:#ff3a19;'>".$line."</h6>";

                } else if($lineNumber==7 || $lineNumber==8 || $lineNumber==9 ){
                    $separatedLine = explode(";",$line);

                    if($lineNumber==7 || $lineNumber==8 ){
                        echo "<b>".$separatedLine[0]."; </b>".$separatedLine[1]."</span>";
                    } else {
                        echo "<b>".$separatedLine[0]."; </b>".$separatedLine[1]."</span></br></br>";
                    }

                } else if($lineNumber==10){
                    echo "<h6 style='color:#ff3a19;'>".$line."</h6>";
                    }

            }
            $lineNumber = $lineNumber +1;
        }

        // while(! feof($fileInfo)){
        //     $line = fgets($fileInfo);
        //     if($line != false && $line != '\n' && trim($line) != ''){

        //         if($lineNumber==1){
        //             echo "<h5 class='card-title' style='color:#ff3a19;'>".$line."</h5>";
        //         } else if($lineNumber==2){
        //             echo "<h6 style='color:#ff3a19;'>".$line."</h6>";
        //         } else if($lineNumber==3 || $lineNumber==4 || $lineNumber==5 ){
        //             $separatedLine = explode(":",$line);

        //             if($lineNumber==3 || $lineNumber==4 ){
        //                 echo "<b >".$separatedLine[0].":</b><span style='font-style: italic;''>".$separatedLine[1]. "</span>  ";
        //             } else {
        //                 echo "<b >".$separatedLine[0].":</b><span style='font-style: italic;'>".$separatedLine[1]. "</span></br>";
        //             }
                    
        //         } else {
        //             if($lineNumber == 6 || $lineNumber == 10){
        //                 echo "<b style='color:#ff3a19;'>".$line."</b></br>";
        //             } else {
        //                 $separatedLine = explode(":",$line);
        //                 echo "<b>".$separatedLine[0].":</b>".$separatedLine[1]. "";
        //             }

        //             if($lineNumber == 9 || $lineNumber == 13 ){
        //                 echo "</br>";
        //             }
        //         }

        //     }
        //     $lineNumber = $lineNumber +1;
        // }

        echo "</div>";
        echo "</div>";

        echo "</div>";
        echo "<div class='col-md-5'>
            <button id='seeNetwork' type='button' class='btn btn-block btn-lg btn-info waves-effect waves-light'><i class='ion-network' style='font-size: 195px'></i> Network Visualization</button>";
        echo "</div>";

        fclose($fileInfo);
    }
}

?>

                </div>

                <div class="card-box">
<?php

if($finished_bool && !($empty_results)){


    $namer = $_GET['result'];
    $filenameInfo = 'tmp/' . $namer . '_Output.txt';

    $num_interactions = sizeof(file($filenameInfo));

    if($num_interactions<=10000){
        echo '                         <table id="datatable-buttons" class="table table-striped table-bordered"  cellspacing="0" width="100%">';
        echo '                          <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Host: activate to sort column descending" style="width: 169px;">Host Protein</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Pathogen: activate to sort column ascending" style="width: 248px;">Pathogen Protein</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Database: activate to sort column ascending" style="width: 121px;">Database</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Host organism: activate to sort column ascending" style="width: 121px;">Host Interactor</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" aria-label="Pathogen organism: activate to sort column ascending" style="width: 121px;">Pathogen Interactor</th>
                                        </tr>
                                    </thead>';

    } else {
        echo '                         <table class="table">';
        echo '                          <thead>
                                        <tr>
                                            <th>Host</th>
                                            <th>Pathogen</th>
                                            <th>Database</th>
                                            <th>Host Interactor</th>
                                            <th>Pathogen Interactor</th>
                                        </tr>
                                    </thead>';

    }

    $fileTabular = fopen($filenameInfo,"r");
    $odd = true;
    include 'dictionary.php';
    while(! feof($fileTabular)){
        $line = fgets($fileTabular);
        if($line != false && $line != '\n' && trim($line) != ''){
            $separatedLine = explode("\t",$line);
            if($odd){
                echo '<tr role="row" class="odd">';
            } else {
                echo '<tr role="row" class="even">';
            }
            // echo '<td class="sorting_1"><a href="https://plants.ensembl.org/Multi/Search/Results?species=all;idx=;q=' . $separatedLine[2] . '" target="_blank">'. $separatedLine[2] .'</a></td>';
            // echo '<td><a href="http://fungi.ensembl.org/Multi/Search/Results?species=all;idx=;q=' . $separatedLine[3] . '" target="_blank">'. $separatedLine[3] .'</a></td>';
            echo '<td>' . $separatedLine[2] . '</td>';
            echo '<td>' . $separatedLine[3] . '</td>';
            echo '<td>' . $separatedLine[4] . '</td>';
            
          
            ///Links to respective PPI databases///
            
            if($separatedLine[4]=="mintdb") {
            	echo '<td class="sorting_1"><a href="https://www.uniprot.org/uniprot/' . $separatedLine[1] . '" target="_blank">'. $separatedLine[1] .'</a></td>';
            	echo '<td class="sorting_1"><a href="https://www.uniprot.org/uniprot/' . $separatedLine[0] . '" target="_blank">'. $separatedLine[0] .'</a></td>';
            }
            if($separatedLine[4]=="hpidb") {
            	echo '<td class="sorting_1"><a href="https://www.uniprot.org/uniprot/' . $separatedLine[1] . '" target="_blank">'. $separatedLine[1] .'</a></td>';
            	echo '<td class="sorting_1"><a href="https://www.uniprot.org/uniprot/' . $separatedLine[0] . '" target="_blank">'. $separatedLine[0] .'</a></td>';
            }
            if($separatedLine[4]=="stringdb") {
            	echo '<td class="sorting_1"><a href="https://string-db.org/network/' . $separatedLine[1] . '" target="_blank">'. $separatedLine[1] .'</a></td>';
            	echo '<td class="sorting_1"><a href="https://string-db.org/network/' . $separatedLine[0] . '" target="_blank">'. $separatedLine[0] .'</a></td>';
            }
            if($separatedLine[4]=="intactdb") {
            	echo '<td class="sorting_1"><a href="https://www.ebi.ac.uk/intact/imex/main.xhtml?query=' . $separatedLine[1] . '" target="_blank">'. $separatedLine[1] .'</a></td>';
            	echo '<td class="sorting_1"><a href="https://www.ebi.ac.uk/intact/imex/main.xhtml?query=' . $separatedLine[0] . '" target="_blank">'. $separatedLine[0] .'</a></td>';
            }
            if($separatedLine[4]=="dipdb") {
            	echo '<td class="sorting_1"><a href="https://dip.doe-mbi.ucla.edu/dip/DIPview.cgi?PK=' . trim(explode("|", $separatedLine[1])[0], "DIP-") . '" target="_blank">'. explode("|", $separatedLine[1])[0] .'</a></td>';
            	echo '<td class="sorting_1"><a href="https://dip.doe-mbi.ucla.edu/dip/DIPview.cgi?PK=' . trim(explode("|", $separatedLine[0])[0], "DIP-") . '" target="_blank">'. explode("|", $separatedLine[0])[0] .'</a></td>';
            }
            if($separatedLine[4]=="phibasedb") {
            	echo '<td class="sorting_1"><a href="https://www.uniprot.org/uniprot/' . $separatedLine[1] . '" target="_blank">'. $separatedLine[1] .'</a></td>';
            	echo '<td class="sorting_1"><a href="https://www.uniprot.org/uniprot/' . $separatedLine[0] . '" target="_blank">'. $separatedLine[0] .'</a></td>';
            }
            if($separatedLine[4]=="biogriddb") {
            	echo '<td class="sorting_1"><a href="https://www.ncbi.nlm.nih.gov/search/all/?term=' . $separatedLine[1] . '" target="_blank">'. $separatedLine[1] .'</a></td>';
            	echo '<td class="sorting_1"><a href="https://www.ncbi.nlm.nih.gov/search/all/?term=' . $separatedLine[0] . '" target="_blank">'. $separatedLine[0] .'</a></td>';
            }
            

            echo '</tr>';
            
        }
      }
    fclose($fileTabular);

} else if($finished_bool && $empty_results){

    echo '<h1 style="color: #039cfd;">End of the session.</h1><h2 style="color: #1bb99a;">No successfull Host-Pathogen Interactions were predicted using Interolog method on this dataset, please try other options and resubmit. Thanks.</h2>';

}  else if($running_bool){

    header("Refresh: 30;");
    echo '<h1 style="color: #039cfd;">RUNNING.</h1><h2 style="color: #1bb99a;">This page will refresh in 30 seconds.</h2>';

} else{

    header("Refresh: 60;");
    echo '<h1 style="color: #039cfd;">QUEUED or INACTIVE.</h1><h2 style="color: #1bb99a;">This page will refresh in 60 seconds.</h2>';

}

?>
                                </tbody>
                            </table>
                </div>




                <!-- end row -->

            </div> <!-- container -->


            <!-- Footer -->
            <footer class="footer">
                © 2022 &nbsp|&nbsp <a  href="https://www.usu.edu"  target="_blank">Utah State University</a> &nbsp|&nbsp  <a href="https://kaabil.net"  target="_blank">Kaundal Artificial Intelligence & Advanced Bioinformatics Laboratory</a> &nbsp|&nbsp <a href="https://www.psc.usu.edu"  target="_blank">Department of Plants, Soils, and Climate</a> &nbsp|&nbsp <a href="https://www.biosystems.usu.edu"  target="_blank">Center for Integrated BioSystems </a>
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

        <script src="assets/js/config.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

               /*
                const email = document.getElementById('email-span').textContent;

                const messageBody = window.location.href;
                const password = EPASSWORD;
                const subjectLine = "TRustDB Interactome Results";
                const recipient = email;
                const user = 'TRustDB';

                const body = {
                    password,
                    messageBody,
                    subjectLine,
                    recipient,
                    user
                }

                axios.post('https://kaabil.net/api/email/send', body)
                    .then(res => {
                        console.log(res);
                    })
                    .catch(err => {
                        console.log('Error');
                        console.log(err);
                    })
                */

                // Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });


                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
         
            } );
         
            
            
           

            $("#seeNetwork").click(function() {
                var resultUrl = "https://kaabil.net/trustdb/network-interactome.php?result=" + <?php  echo(json_encode($namer)); ?>;
                window.open(resultUrl);
            });

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
