var E= []

$.getJSON("http://ip-api.com/json/?fields=61439", 
		function(data) { 
			info={}                
					
			info.ip = data.query
			info.lat = data.lat
			info.lon = data.lon
			info.par = data.isp
			E.push(info)
		})
		
function readFile(input) {
	var file = new FileReader()
	const read=file.readAsText(input.files[0])
	
	file.onload = function(e) {
		const data = JSON.parse(e.currentTarget.result)
		//console.log(data)
		
		var url=0
		const getDomain = (url) => {
			url = new URL(url).hostname
			return url;
		}

		for (var i in data.log.entries) {
			var entries = {}
			url = data.log.entries[i].request.url
			
			entries.startedDateTime = data.log.entries[i].startedDateTime
			entries.serverIPAddress = data.log.entries[i].serverIPAddress
			entries.timingsWait= data.log.entries[i].timings.wait
			entries.method = data.log.entries[i].request.method
			entries.url = getDomain(url)
			entries.status = data.log.entries[i].response.status
			entries.statusText = data.log.entries[i].response.statusText
			

			for(var z in data.log.entries[i].request.headers){
				
				if(data.log.entries[i].request.headers[z].name === "host" || data.log.entries[i].request.headers[z].name === "Host"){
					entries.host=(data.log.entries[i].request.headers[z].value)
					
				} 
				
				if(data.log.entries[i].request.headers[z].name === "content-type" || data.log.entries[i].request.headers[z].name === "Content-Type"){
					entries.RqContentType=(data.log.entries[i].request.headers[z].value)
				} 
				if(data.log.entries[i].request.headers[z].name === "cache-control" || data.log.entries[i].request.headers[z].name === "Cache-Control"){
				   entries.RqCacheControl=(data.log.entries[i].request.headers[z].value)
				} 
				if(data.log.entries[i].request.headers[z].name === "Expires" || data.log.entries[i].request.headers[z].name === "expires"){
					entries.RqExpires=(data.log.entries[i].request.headers[z].value)
				}
				
				
			}
			 
			
			for(var y in data.log.entries[i].response.headers){

				if(data.log.entries[i].response.headers[y].name === "content-type" || data.log.entries[i].response.headers[y].name === "Content-Type"){
					entries.RsContentType=(data.log.entries[i].response.headers[y].value)
				}

				if(data.log.entries[i].response.headers[y].name === "cache-control" || data.log.entries[i].response.headers[y].name === "Cache-Control"){
					entries.RsCacheControl=(data.log.entries[i].response.headers[y].value)
				}

				if(data.log.entries[i].response.headers[y].name === "pragma" || data.log.entries[i].response.headers[y].name === "Pragma"){
					entries.pragma=(data.log.entries[i].response.headers[y].value)
				}

				if(data.log.entries[i].response.headers[y].name === "expires" || data.log.entries[i].response.headers[y].name === "Expires"){
					entries.RsExpires=(data.log.entries[i].response.headers[y].value)
				}

				if(data.log.entries[i].response.headers[y].name === "last-modified"  || data.log.entries[i].response.headers[y].name === "Last-Modified"){
					entries.lastModified=(data.log.entries[i].response.headers[y].value)
				}
				if(data.log.entries[i].response.headers[y].name === "Age" || data.log.entries[i].response.headers[y].name === "age"){
					entries.age=(data.log.entries[i].response.headers[y].value)
				}
			}
			E.push(entries)


			
		}

	   
		console.log(E)
	   

		
			

		var myJSONText = JSON.stringify(E,null,2)
		//console.log(myJSONText)
		document.getElementById("up").addEventListener("click", function() {
			$.ajax({ 
				url: "upload.php",
				type: "POST",  
				data: {kati:myJSONText}, 
				success: function(res) { 
						console.log(res)
						
					} 
			}); 
		});
	};


	file.onerror = function() {
		console.log(reader.error);
	};

}


function onDownload(){
	download(JSON.stringify(E,null,2), "json-file-name.json", "application/json");

}
   
function download(content, fileName, contentType) {
	const a = document.createElement("a");
	const file = new Blob([content], { type: contentType });
	a.href = URL.createObjectURL(file);
	a.download = fileName;
	a.click();
}
		   


