var E= {
    Entries:[]
}

function readFile(input) {
    var fr = new FileReader();
    const read=fr.readAsText(input.files[0])
    
    fr.onload = function(e) {
        const data = JSON.parse(e.currentTarget.result)
        //console.log(data)
        
        var url=0
        const getDomain = (url) => {
            url = new URL(url).hostname
            return url;
        }

       
        for (var i in data.log.entries) {
            var entries = {};
            url = data.log.entries[i].request.url


            entries.startedDateTime = data.log.entries[i].startedDateTime
            entries.serverIPAddress = data.log.entries[i].serverIPAddress
            entries.timings= {};
            entries.request = {};
            entries.response = {};
            entries.response.headers = {};
            entries.request.headers = {};

            
            entries.timings.wait= data.log.entries[i].timings.wait
            entries.request.method = data.log.entries[i].request.method
            entries.request.url = getDomain(url)
            entries.response.status = data.log.entries[i].response.status
            entries.response.statusText = data.log.entries[i].response.statusText
            

            for(var z=0; z<data.log.entries[i].request.headers.length; z++){
                if(data.log.entries[i].request.headers[z].name == "host" || data.log.entries[i].request.headers[z].name == "Host"){
                    entries.request.headers.name1=(data.log.entries[i].request.headers[z].name)
                    entries.request.headers.value1=(data.log.entries[i].request.headers[z].value)
                    
                } 
                
                if(data.log.entries[i].request.headers[z].name === "content-type" || data.log.entries[i].request.headers[z].name === "Content-Type"){
                    entries.request.headers.name2=(data.log.entries[i].request.headers[z].name)
                    entries.request.headers.value2=(data.log.entries[i].request.headers[z].value)
                } 
                
                if(data.log.entries[i].request.headers[z].name === "cache-control" || data.log.entries[i].request.headers[z].name === "Cache-Control"){
                    entries.request.headers.name3=(data.log.entries[i].request.headers[z].name)
                    entries.request.headers.value3=(data.log.entries[i].request.headers[z].value)
                } 
                
                if(data.log.entries[i].request.headers[z].name === "Expires" || data.log.entries[i].request.headers[z].name === "expires"){
                    entries.request.headers.name4=(data.log.entries[i].request.headers[z].name)
                    entries.request.headers.value4=(data.log.entries[i].request.headers[z].value)
                }
                
            }
             
            
                for(var z=0; z<data.log.entries[i].response.headers.length; z++){

                    if(data.log.entries[i].response.headers[z].name === "content-type" || data.log.entries[i].response.headers[z].name === "Content-Type"){
                        entries.response.headers.name1=(data.log.entries[i].response.headers[z].name)
                        entries.response.headers.value1=(data.log.entries[i].response.headers[z].value)
                    }

                    if(data.log.entries[i].response.headers[z].name === "cache-control" || data.log.entries[i].response.headers[z].name === "Cache-Control"){
                        entries.response.headers.name2=(data.log.entries[i].response.headers[z].name)
                        entries.response.headers.value2=(data.log.entries[i].response.headers[z].value)
                    }

                    if(data.log.entries[i].response.headers[z].name == "pragma" || data.log.entries[i].response.headers[z].name == "Pragma"){
                        entries.response.headers.name3=(data.log.entries[i].response.headers[z].name)
                        entries.response.headers.value3=(data.log.entries[i].response.headers[z].value)
                    }

                    if(data.log.entries[i].response.headers[z].name == "expires" || data.log.entries[i].response.headers[z].name == "Expires"){
                        entries.response.headers.name4=(data.log.entries[i].response.headers[z].name)
                        entries.response.headers.value4=(data.log.entries[i].response.headers[z].value)
                    }

                    if(data.log.entries[i].response.headers[z].name == "last-modified"  || data.log.entries[i].response.headers[z].name == "Last-Modified"){
                        entries.response.headers.name5=(data.log.entries[i].response.headers[z].name)
                        entries.response.headers.value5=(data.log.entries[i].response.headers[z].value)
                    }
            }
            E.Entries.push(entries)
        }

         console.log(E)



         
        

        };

        fr.onerror = function() {
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
               
    
    