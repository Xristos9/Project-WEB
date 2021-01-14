<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Leaflet Heatmap Layer Plugin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
	<link rel="stylesheet" type="text/css" href="heatmap.css"> 
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	<script src="heatmap.js"></script>
	<script src="leaflet-heatmap.js"></script>
</head>
<body>
 
    <?php
        include "header.php";
    ?>

    <div id="map"></div>

    <script>
		var testData1 = {
            data:[]
        }
		<?php
        include "select.php";
        ?>

		window.onload = function() {
			var kati=[]			
			// Access the array elements 
			var passedArray = <?php echo json_encode($a); ?>; 
			// console.log(passedArray)
			
			
			var counts = {};
			passedArray.forEach(function(x) { counts[x] = (counts[x] || 0)+1; });

			// console.log(counts)
			
			const unique = [...new Set(passedArray)];
			// console.log(unique)

			// ip-api endpoint URL
			const endpoint = 'http://ip-api.com/batch';

            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
				// Result array
				var response = JSON.parse(this.responseText);
                        
                for(var i in response){
                    data={}
                    data.lat = response[i].lat
                    data.lng = response[i].lon
                    data.count = counts[unique[i]]
                    testData1.data.push(data)
                }
			};
			var data = JSON.stringify(unique);

			xhr.open('POST', endpoint, false);
			xhr.send(data);
				
			console.log(testData1)

			var baseLayer = L.tileLayer(
			'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
				attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
				maxZoom: 18
			}
			);

			var cfg = {
			// radius should be small ONLY if scaleRadius is true (or small radius is intended)
			"radius": 0.8,
			"maxOpacity": .8, 
			// scales the radius based on map zoom
			"scaleRadius": true, 
			// if set to false the heatmap uses the global maximum for colorization
			// if activated: uses the data maximum within the current map boundaries 
			//   (there will always be a red spot with useLocalExtremas true)
			"useLocalExtrema": true,
			// which field name in your data represents the latitude - default "lat"
			latField: 'lat',
			// which field name in your data represents the longitude - default "lng"
			lngField: 'lng',
			// which field name in your data represents the data value - default "value"
			valueField: 'count'
			};


			var heatmapLayer = new HeatmapOverlay(cfg);

			var map = new L.Map('map', {
			center: new L.LatLng(38.246361, 21.734966),
			zoom: 4,
			layers: [baseLayer, heatmapLayer]
			});

			heatmapLayer.setData(testData1);

			// make accessible for debugging
			// layer = heatmapLayer;
		}; 

	</script>

	<!-- page footer -->
    <?php
        include "footer.php";
    ?>
    <!-- /page footer -->
</body>
</html>



