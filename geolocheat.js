var testData = {
    data: []
}


var passedArray = <?php echo json_encode($sampleArray); ?>





const a = ["150.140.129.14", "185.6.76.42", "52.85.156.59"]
// List of IP addresses to query, up to 100
var IPs = a

// ip-api endpoint URL
var endpoint = 'http://ip-api.com/batch';

var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // Result array
        var response = JSON.parse(this.responseText);
        // console.log(response);
        response.forEach(function (item) {
            kati ={}
            kati.lat = item.lat
            kati.lon = item.lon
            testData.data.push(kati)
            
            
        });
        
    }
};
var data = JSON.stringify(IPs);
// console.log("sending:", data);

xhr.open('POST', endpoint, true);
xhr.send(data);
console.log(testData)