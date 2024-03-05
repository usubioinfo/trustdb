<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Interactome Network Visualization of the predicted PPIs using Interactomics tool.">
      <meta name="author" content="Raghav Kataria">

      <!-- App title -->
        <title>Interactome Visualization - TRustDB</title>

      <!-- App Favicon -->
      <link rel="shortcut icon" href="assets/images/gallery/favicon.ico">

      <!-- START SIGMA IMPORTS -->
      <script src="assets/js/sigma.min.js"></script>
      <!-- END SIGMA IMPORTS -->
      <script src="assets/js/sigma.parsers.json.js"></script>
      <script src="assets/js/sigma.layout.forceAtlas2/supervisor.js"></script>
      <script src="assets/js/sigma.layout.forceAtlas2/worker.js"></script>
      <script src="assets/js/sigma.plugins.dragNodes.js"></script>

      <script src="assets/js/sigma.parallelEdges/utils.js"></script>
      <script src="assets/js/sigma.parallelEdges/sigma.canvas.edges.curve.js"></script>
      <script src="assets/js/sigma.parallelEdges/sigma.canvas.edges.curvedArrow.js"></script>
      <script src="assets/js/sigma.parallelEdges/sigma.canvas.edgehovers.curve.js"></script>
      <script src="assets/js/sigma.parallelEdges/sigma.canvas.edgehovers.curvedArrow.js"></script>
      <script src="assets/js/sigma.plugins.relativeSize.js"></script>
      <script src="assets/js/sigma.exporters.svg.js"></script>

      <script src="assets/js/sigma.layout.noverlap/sigma.layout.noverlap.js"></script>
      <script src="assets/js/sigma.plugins.animate/sigma.plugins.animate.js"></script>
      <script
			  src="https://code.jquery.com/jquery-3.6.0.js"
			  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			  crossorigin="anonymous"></script>
      <!--
      <script src="assets/js/sigma.renderers.customEdgeShapes/sigma.canvas.edges.dashed.js"></script>
      <script src="assets/js/sigma.renderers.customEdgeShapes/sigma.canvas.edges.dotted.js"></script>
      <script src="assets/js/sigma.renderers.customEdgeShapes/sigma.canvas.edges.parallel.js"></script>
      <script src="assets/js/sigma.renderers.customEdgeShapes/sigma.canvas.edges.tapered.js"></script>
      <script src="assets/js/sigma.renderers.customEdgeShapes/sigma.canvas.edgehovers.dashed.js"></script>
      <script src="assets/js/sigma.renderers.customEdgeShapes/sigma.canvas.edgehovers.dotted.js"></script>
      <script src="assets/js/sigma.renderers.customEdgeShapes/sigma.canvas.edgehovers.parallel.js"></script>
      <script src="assets/js/sigma.renderers.customEdgeShapes/sigma.canvas.edgehovers.tapered.js"></script>
      -->
      <!-- App CSS -->
      <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
      <!-- Switchery css -->
      <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

      <!-- Bootstrap CSS -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
      <div id="container">
        <style>
          #graph-container {
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            position: absolute;

          }

          #panel {
            top: 10px;
            left: 10px;
            position: fixed;
            background-color: #efefef;
            height: 900px;
            width: 300px;
            padding:  5px;
            border-style: solid;
            border-color: #c9c9c9;
          }

          #bottomPanel {
            bottom: 10px;
            left: 10px;
            position: fixed;
            background-color: #efefef;
            height: 320px;
            width: 400px;
          }

          #legendsPanel {
            top: 10px;
            right: 10px;
            position: fixed;
            background-color: #efefef;
            height: 710px;
            width: 400px;
            border-style: solid;
            border-color: #c9c9c9;
          }

          .ntable{
            display:block;
            width:100%;
            overflow-x: auto;
            max-height: 580px;
            border: none;
            padding: 5px 2px;
          }

          
        </style>
        
        <div id="graph-container"></div>
      

        <div id="panel" >
          <h4><b class="text-muted2" style="color: #FD7E14">Protein</b></h4>
          <b id="protein-name"> </b>
          <hr>
          <h5 style="color: #6f42c1;margin-bottom: 1px;" >Description</h5>
          <b id="protein-description">  </b>
          <br>
          <h5 style="color: #6f42c1;margin-bottom: 1px;" >Organism</h5>
          <b id="protein-organism" style="font-style: italic;"> </b>
          <br>
          <h5 style="color: #6f42c1;margin-bottom: 1px;" >Degree</h5>
          <b id="protein-degree">  </b>
          
          <hr>
          <h6><b class="text-muted2" style="color: #039cfd">Network Layout</b></h4>
          <button id="layout" class="btn btn-purple waves-effect waves-light" type="button">Force Atlas</button>
          <!--<button id="layoutNO" class="btn btn-purple waves-effect waves-light" type="button">Noverlap</button>-->
          <br><br>
          <h6><b class="text-muted2" style="color: #039cfd">Export Network</b></h4>
          <button id="export" class="btn btn-info waves-effect waves-light" type="button">SVG</button>
          <?php
          $namer = $_GET['result'];
          $downloadFile = "tmp/" . $namer . "_Output.json";echo ' <a id="downloadNetBtn" href="'.$downloadFile.'" target="_blank" class="btn btn-info waves-effect waves-light"download> JSON </a>';
          ?>
          <hr>
          
          <h4><b class="text-muted2" style="color: #FD7E14">Legend</b></h4>
          <h6><b class="text-muted2" style="color: #FD7E14">Edges</b></h6>
          <span style='font-size:18px;color: #7fa3b3;'>&#10074; <span style='color: #000000;'>HPIDB</span></span><br>
          <span style='font-size:18px;color: #fd9a9f;'>&#10074; <span style='color: #000000;'>MINT</span></span><br>
          <span style='font-size:18px;color: #bfbfbe;'>&#10074; <span style='color: #000000;'>DIP</span></span><br>
          <span style='font-size:18px;color: #f7eda0;'>&#10074; <span style='color: #000000;'>BioGRID</span></span><br>
          <span style='font-size:18px;color: #7fc8a3;'>&#10074; <span style='color: #000000;'>IntAct</span></span><br>
          <span style='font-size:18px;color: #a77fa1;'>&#10074; <span style='color: #000000;'>STRING</span></span><br>
          <span style='font-size:18px;color: #111111;'>&#10074; <span style='color: #000000;'>PHI-base</span></span><br>
          <hr>

          <h6><b class="text-muted2" style="color: #FD7E14">Nodes</b></h6>
          <span style='font-size:18px;color: #2200ff;'>&#9679;</span><span id="spanHost1" style='font-size:16px;color: #2200ff;'> Host Proteins</span><br>
          <span style='font-size:18px;color: #b80009;'>&#9679;</span><span id="spanPathogen1" style='font-size:16px;color: #b80009;'> Pathogen Proteins</span>
          <br>
        </div>
        <div id="legendsPanel">
          <label for="searchid">Search:</label>
        <input id='searchid'  type="text" name='searchid' placeholder="Enter ID to filter Network">  <button id= 'unetwork' class='btn btn-sm btn-primary'>Update Network</button>
                    <table id= 'network-table' class='table table-bordered ntable'>
           
            
          </table>

        </div>
        
      </div>

      <?php
      // Start the session
      //header("Access-Control-Allow-Origin: *");
      ini_set('display_errors',0);
      $namer = $_GET['result'];
      $nfile = "tmp/" . $namer . "_Output.txt";
      $filename = "tmp/" . $namer . "_Output.json";
      $taskInfo = "tmp/" . $namer . "_OutputTaskInfo.txt";

      $taskFile = fopen($taskInfo,"r");
      $line = fgets($taskFile);
      $lineExploded = explode(" ", $line);
      $comparisonType = $lineExploded[0];

      $line = fgets($taskFile);

      $line = fgets($taskFile);
      $lineExploded = explode(": ", $line);
      $speciesA = $lineExploded[1];

      $line = fgets($taskFile);
      $lineExploded = explode(": ", $line);
      $speciesB = $lineExploded[1];

      $line = fgets($taskFile);
      $lineExploded = explode(": ", $line);
      $speciesC = $lineExploded[1];

      ?>


      <script >
      /**
       * Here is just a basic example on how to properly display a graph
       * exported from Gephi as a JSON file, with the JSON Exporter plugin from
       * the Oxford Internet Institute:
       *
       *  > https://marketplace.gephi.org/plugin/json-exporter/
       *
       * The plugin sigma.parsers.json can load and parse the JSON graph file,
       * and instantiate sigma when the graph is received.
       *
       * The object given as the second parameter is the base of the instance
       * configuration object. The plugin will just add the "graph" key to it
       * before the instanciation.
       */

      $( document ).ready(function() {
      var filename = <?php  echo(json_encode($filename)); ?>;
      let id = document.getElementById('searchid').value
      console.log(id)
      var comparisonType = <?php  echo(json_encode($comparisonType)); ?>;

      var speciesA = <?php  echo(json_encode($speciesA)); ?>;
      var speciesB = <?php  echo(json_encode($speciesB)); ?>;
      var speciesC = <?php  echo(json_encode($speciesC)); ?>;

      console.log(comparisonType);

      if(comparisonType=="Host"){
        document.getElementById("spanHost1").innerHTML = speciesA;
        document.getElementById("spanHost2").innerHTML = speciesB;
        document.getElementById("spanPathogen1").innerHTML = speciesC;

        document.getElementById("spanPathogen2").style.display = "none";
        document.getElementById("spanPathogen").style.display = "none";

      } else if(comparisonType=="Pathogen"){
        document.getElementById("spanPathogen1").innerHTML = speciesA;
        document.getElementById("spanPathogen2").innerHTML = speciesB;
        document.getElementById("spanHost1").innerHTML = speciesC;

        document.getElementById("spanHost2").style.display = "none";
        document.getElementById("spanHost").style.display = "none";
        document.getElementById("brHost").style.display = "none";
      }
    
      
        
        Networking(filename)
        
        $('#unetwork').on('click', function() {
        $('#graph-container').empty()
        let id = document.getElementById('searchid').value
        console.log(id)
        filterNetwork(filename, id)

      } ) 

      
    })

    


        function filterNetwork(filename, id){

  

        $.get(filename, function(data){
            const ndata = JSON.stringify(data)
            const narr = JSON.parse(ndata)
            
            console.log(id)
              const edgedata = narr.edges.filter((item) => {
              return item.id.includes(id)
             })
             let dn = []
             let newNode = []
              const getdn = narr.edges.filter((item) => {
              if ( item.id.includes(id)){
                if (item.source.includes(id)){
                  dn.push(item.target)
                }
                if (item.target.includes(id)){
                  dn.push(item.source)
                }
              }
              
            })
              newNode.push (narr.nodes.filter((item) => {
              return item.id.includes(id)
             })[0])
            

             for (i in dn){

            newNode.push(  narr.nodes.filter((item) => {
              return item.id.includes(dn[i])
                                 
                })[0])
              }


             const newData = {'nodes': [...new Set(newNode)], 'edges': edgedata}
            // console.log(narr.nodes)

              let tableContent = '';

              tableContent += ` 
              <thead>
              <tr>
                <td><b>Host</b></td>
                <td><b>Pathogen</b></td>
              </tr>
            </thead>
              `
              edgedata.map((item, index)=>{
                tableContent +=`<tr>
                <td>${item.source}</td>
                <td>${item.target}</td>
                </tr>`

              })

              $("#network-table").html(tableContent);


Network(newData)


})
}

function Networking (filename){
  $.get(filename, function(data){
            const ndata = JSON.stringify(data)
            const narr = JSON.parse(ndata)
            // const newData = {'nodes': [...new Set(newNode)], 'edges': edgedata}
const newEdge = [...new Set(narr.edges)]
console.log(newEdge)
            let tableContent = '';

tableContent += ` 
<thead>
<tr>
  <td><b>Host</b></td>
  <td><b>Pathogen</b></td>
</tr>
</thead>
`

narr.edges.map((item, index)=>{
  tableContent +=`<tr>
  <td>${item.source}</td>
  <td>${item.target}</td>
  </tr>`

})

$("#network-table").html(tableContent);

Network(narr)
  })

}


function Network (networkdata){

        s = new sigma({         graph: networkdata,        container: 'graph-container',        settings: {            defaultNodeColor: '#ec5148'        }});
        s.graph.nodes().forEach(function(node, i, a){
          node.x = Math.cos(Math.PI * 2 * i / a.length);
          node.y = Math.sin(Math.PI * 2 * i / a.length);
        });
        s.settings({
          edgeColor: 'default',
          defaultEdgeColor: '#ec5148',
          defaultEdgeArrow: 'source',
          borderSize: 1,
          defaultEdgeType: 'curvedArrow'
        });

        var dragListener = sigma.plugins.dragNodes(s, s.renderers[0]);

        dragListener.bind('startdrag', function(event){
          //console.log(event);
        });
        dragListener.bind('drag', function(event){
          //console.log(event);
        });
        dragListener.bind('drop', function(event){
          //console.log(event);
        });
        dragListener.bind('dragend', function(event){
          //console.log(event);
        });

        sigma.plugins.relativeSize(s, 1);
        s.refresh();

        s.startForceAtlas2({linLogMode: true});
        window.setTimeout(function() {s.killForceAtlas2()}, 2000);

        var force = false;
        
        document.getElementById('layout').onclick = function() {
          if (!force)
            s.startForceAtlas2({linLogMode: true, slowdown:10});
          else
            s.stopForceAtlas2();
          force = !force;
        };


        document.getElementById('export').onclick = function() {
          var output = s.toSVG({download: true, filename: 'mygraph.svg', size:1000});
        };


        allNodes = s.graph.nodes();
        firstNode = allNodes[1];

        document.getElementById("protein-name").innerHTML = firstNode.label;
        document.getElementById("protein-organism").innerHTML = firstNode.organism;
        document.getElementById("protein-degree").innerHTML = s.graph.degree(firstNode.label);

        var formData = new FormData();
        formData.append("accession", firstNode.label);
        var request = new XMLHttpRequest();
        request.open("POST", "http://127.0.1.1:80/trustdb/queryTrustNetwork.php",true);

        request.onload = function () {
        if (request.readyState === request.DONE) {
            if (request.status === 200) {
                    resultTask = request.response;
                    document.getElementById("protein-description").innerHTML = request.responseText;
                }
            }
        };
        request.send(formData);


        s.bind('overNode outNode clickNode doubleClickNode rightClickNode', function (e){
          document.getElementById("protein-name").innerHTML = e.data.node.label;
          document.getElementById("protein-organism").innerHTML = e.data.node.organism;
          document.getElementById("protein-degree").innerHTML = s.graph.degree(e.data.node.label);

          var formData = new FormData();
          formData.append("accession", e.data.node.label);
          var request = new XMLHttpRequest();
          request.open("POST", "http://127.0.1.1:80/trustdb/queryTrustNetwork.php",true);

          request.onload = function () {
          if (request.readyState === request.DONE) {
              if (request.status === 200) {
                      resultTask = request.response;
                      document.getElementById("protein-description").innerHTML = request.responseText;
                  }
              }
          };
          request.send(formData);
        })

}

      </script>
    </body>
</html>