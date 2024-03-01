<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Triticum aestivum transcription factors in the predicted PPIs.">
    <meta name="author" content="Raghav Kataria">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="assets/images/gallery/favicon.ico">

    <!-- App title -->
    <title>Transcription Factors - TRustDB</title>

    <!-- Plugins css-->
    <link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

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

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- DataTables js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#tableEffectors').DataTable({});
            $('#buttonSearch').on('click', function() {
                performSearch();
            });
        });

        function performSearch() {
            var formData = new FormData();
            var namer = new Date().valueOf();
            formData.append("namer", namer);
            formData.append("species", $('select#triticumI').val());

            $.ajax({
                url: "https://kaabil.net/trustdb/queryWheatTF.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log('Data fetched successfully.');
                    processQueryResult(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data: ' + error);
                }
            });
        }

        function processQueryResult(queryResult) {
            var lines = queryResult.split("\\n");
            var tableString = '';

            for(i = 0; i < lines.length - 1; i++){
                var record = lines[i].split("\t");
                tableString += '<tr>';
                tableString += '<td><a href="https://plants.ensembl.org/Multi/Search/Results?species=all;idx=;q=' + record[0] + ';site=ensemblunit" target="_blank">' + record[0] + '</a></td>';
                tableString += '<td><a href="http://planttfdb.gao-lab.org/family.php?fam=' + record[1] + '" target="_blank">' + record[1] + '</a></td>';
                tableString += '<td><a href="https://www.genome.jp/dbget-bin/www_bget?' + record[2] + '" target="_blank">' + record[2] + '</a></td>';
                tableString += '<td>' + record[3] + '</td>';
                tableString += '</tr>';
            }

            $('#tableEffectors').DataTable().clear();
            $('#tableEffectors').DataTable().destroy();
            document.getElementById('bodyTable').innerHTML = tableString;
            $('#tableEffectors').DataTable({"pageLength": 25});

            var namer = lines[lines.length - 1];
            document.getElementById('downloadQueryBtn').href = "tmp/" + namer + "_OutputQuery.txt";
            document.getElementById('downloadDiv').hidden = false;
        }
    </script>
</head>
<body>
    <!-- Your HTML content goes here, including the navigation bar, modal, and table structure -->
    <!-- The rest of your HTML content -->
</body>
</html>
