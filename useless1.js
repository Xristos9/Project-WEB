var arr = [[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]] // Δημιουργία δυσδιάστατου πίνακα
var IP=[]

$.getJSON("http://ip-api.com/json/?fields=61439", 
	function(data) { 
      
      arr[16].push(data.query)
      arr[17].push(data.lat)
      arr[18].push(data.lon)
      arr[19].push(data.isp)
    
      
     
})


function readFile(input) {
    var file = new FileReader();
    const read=file.readAsText(input.files[0])
    
    file.onload = function(e) {
        const data = JSON.parse(e.currentTarget.result)
        //console.log(data)
        
        


        var url=0
        const getDomain = (url) => {
            url = new URL(url).hostname
            return url;
        }

        
        for(var i in data.log.entries){
            url = data.log.entries[i].request.url
            arr[0].push(data.log.entries[i].startedDateTime)
            arr[1].push(data.log.entries[i].timings.wait)
            arr[2].push(data.log.entries[i].serverIPAddress)
            arr[3].push(data.log.entries[i].request.method)
            arr[4].push(getDomain(url))
            arr[5].push(data.log.entries[i].response.status);
            arr[6].push(data.log.entries[i].response.statusText)

        

        
            for(var z in data.log.entries[i].request.headers){

                if(data.log.entries[i].request.headers[z].name == "host" || data.log.entries[i].request.headers[z].name == "Host"){
                    arr[7].push(data.log.entries[i].request.headers[z].value)
                }
                
                if(data.log.entries[i].request.headers[z].name === "content-type" || data.log.entries[i].request.headers[z].name === "Content-Type"){
                    arr[8].push(data.log.entries[i].request.headers[z].value)
                }

                if(data.log.entries[i].request.headers[z].name === "cache-control" || data.log.entries[i].request.headers[z].name === "Cache-Control"){
                    arr[9].push(data.log.entries[i].request.headers[z].value)
                }

                if(data.log.entries[i].request.headers[z].name === "Expires" || data.log.entries[i].request.headers[z].name === "expires"){
                    arr[10].push(data.log.entries[i].request.headers[z].value)
                }
            }

            
            for(var z in data.log.entries[i].response.headers){

            if(data.log.entries[i].response.headers[z].name === "content-type" || data.log.entries[i].response.headers[z].name === "Content-Type"){
                arr[11].push(data.log.entries[i].response.headers[z].value)
            }

                if(data.log.entries[i].response.headers[z].name === "cache-control" || data.log.entries[i].response.headers[z].name === "Cache-Control"){
                    arr[12].push(data.log.entries[i].response.headers[z].value)
                }

                if(data.log.entries[i].response.headers[z].name == "pragma" || data.log.entries[i].response.headers[z].name == "Pragma"){
                    arr[13].push(data.log.entries[i].response.headers[z].value)
                }

                if(data.log.entries[i].response.headers[z].name == "expires" || data.log.entries[i].response.headers[z].name == "Expires"){
                    arr[14].push(data.log.entries[i].response.headers[z].value)
                }

                if(data.log.entries[i].response.headers[z].name == "last-modified"  || data.log.entries[i].response.headers[z].name == "Last-Modified"){
                    arr[15].push(data.log.entries[i].response.headers[z].value)
                }
            }

        }
        
        //arr[16].push(IP)

        
    
        console.log(arr)
    
    
    var myJSONText = JSON.stringify(arr)
    //console.log(myJSONText)
    document.getElementById("up").addEventListener("click", function() {
        $.ajax({ 
            url: "upload.php",
            type: "POST",  
            data: {kati: myJSONText}, 
            success: function(res) { 
                    console.log(res)
                } 
        })
    })

    }
    


    file.onerror = function() {
        console.log(reader.error)
    }
   


}



function onDownload(){
    download(JSON.stringify(arr,null,2), "json-file-name.json", "application/json");
}
   
function download(content, fileName, contentType) {
    const a = document.createElement("a");
    const file = new Blob([content], { type: contentType });
    a.href = URL.createObjectURL(file);
    a.download = fileName;
    a.click();
}





