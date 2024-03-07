<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Functional domains of Triticum aestivum proteins.">
        <meta name="author" content="Raghav Kataria">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/gallery/favicon.ico">

        <!-- App title -->
        <title>Host Domains - TRustDB</title>

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
    <a class="" href="http://127.0.1.1:80">
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
                                <p>This is a list of functional domains of <i>Triticum aestivum</i> proteins, predicted using the InterProScan software package.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-xl-12">
                        <h4 class="page-title">Functional Domain Mappings (InterPro) <i class="zmdi zmdi-info-outline" style="font-size: 25px" data-toggle="modal" data-target="#modal"></i></h4>
                    </div>
                </div>

                <!-- end row --> 

                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-5" id="speciesSelect" >
                                <select class="form-control select2" id="triticumI" style="font-style: italic;">
                                <optgroup label="Triticum species [Susceptible to stem rust]" style="font-style: italic;">
                                        <option value="Taestivum">Triticum aestivum</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-5" id="buttonSearch" >
                                <button type="button" class="btn btn-twitter waves-effect waves-light">
                                    <span class="btn-label"><i class="zmdi zmdi-search"></i></span>View
                                </button>
                            </div>

                            <div class="col-md-2" id="downloadDiv" hidden="true">
                                <a id="downloadQueryBtn" href="" target="_blank" class="btn btn-purple waves-effect waves-light"download> Download Result <i class="fa fa-download" style="font-size: 20px"></i></a>
                            </div>

                        </div>
                        <br>

                        <table id="tableDomains" class="table"  cellspacing="0" width="100%" style="font-size: 14px">
                            <thead class='thead-dark'>
                                <tr role="row">
                                    <th>Accession</th>
                                    <th>Source</th>
                                    <th>Domain</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTable">
                                
                            </tbody>
                            
                        </table>
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


                //Buttons examples
                var table = $('#tableDomains').DataTable({});
                var buttonSearch = document.getElementById("buttonSearch");
                buttonSearch.click();


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

            $("#buttonSearch").click(function() {


            var formData = new FormData();

            var namer = new Date().valueOf();
            formData.append("namer", namer);

            formData.append("species", $('select#triticumI').val());
                
            var request = new XMLHttpRequest();
            request.open("POST", "queryTriticumDom.php",true);
            request.onload = function () {
                if (request.readyState === request.DONE) {
                    if (request.status === 200) {
                        resultTask = request.response;
                        var queryResult = request.responseText;
                        var lines = queryResult.split("\\n");

                        var tableString  = '';

                        example = lines[0].split("\t");
                        //console.log(example[0]);
                        
                        for(i = 0; i< lines.length-1; i++){

                            record = lines[i].split("\t");

                            tableString  = tableString + '<tr>';
                            tableString  = tableString + '<td><a href="https://fungi.ensembl.org/Multi/Search/Results?species=all;idx=;q=' + record[0] + '" target="_blank">' + record[0] + '</a></td>';
                            tableString  = tableString + '<td>'+record[1]+'</td>';
                            tableString  = tableString + '<td>'+record[2]+'</td>';
                            tableString  = tableString + '<td>'+record[3]+'</td>';
                            tableString  = tableString + '</tr>';

       
                        }

                        $('#tableDomains').DataTable().clear();
                        $('#tableDomains').DataTable().destroy();

                        document.getElementById('bodyTable').innerHTML = tableString;

                        $('#tableDomains').DataTable({"pageLength": 25});

                        var namer = lines[lines.length-1];
                        document.getElementById('downloadQueryBtn').href = "tmp/" + namer + "_OutputQuery.txt";
                        document.getElementById('downloadDiv').hidden = false;


                    }
                }
            };
            request.send(formData);


            });


        </script>

    </body>
</html>
