<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>To kalitero site</title>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
    <link rel="stylesheet" type="text/css" href="uploadHAR.css">
</head>


<body>
   
    <?php
        include "header.php";
    ?>
    
    
    <h1>ΠΑΜΕ ΛΙΓΟ!!!</h1>
    
    <input type="file" 
           accept=".json, .har" 
           onchange="readFile(this)">
    
    <br>
    <br>
    
    <button onclick="onDownload()">Download</button>
    
    <br>
    <br>
    
    <button id="up">Upload to server</button>
    
    <br>
    <br>
    
    <div id="output"></div>
       
    <!-- <script src="IP.js"></script> -->
    
    <script src="upload.js"></script>
    
    </script>

    
    <!-- page wrapper -->
    <div class="page-wrapper">
            
    </div>
    <!-- /page wrapper -->
    
      
    <!-- page footer -->
    <?php
        include "footer.php";
    ?>
    <!-- /page footer -->
</body>

</html>


