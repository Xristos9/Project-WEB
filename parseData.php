<?php
require __DIR__ . '/vendor/autoload.php'; //composer requirement

set_time_limit(10000);
session_start();

$json_a = \JsonMachine\JsonMachine::fromFile("uploads/" . basename($_FILES["fileToUpload"]["name"]));

$userID = $_SESSION["id"];
$conn = DBconnect();

//for data table
$stmt =$conn->prepare("INSERT INTO data (userID, heading, verticalAccuracy, velocity, accuracy, longitudeE7, latitudeE7, altitude, timestampMs, likelyActivity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiiiddiis", $userID, $heading, $verticalAccuracy, $velocity, $accuracy, $longitudeE7, $latitudeE7, $altitude, $timestampMs, $likelyActivity);

//for activity table
$stmt2 =$conn->prepare("INSERT INTO activitytype (entryID, timestampMs, type, confidence) VALUES (?, ?, ?, ?)");
$stmt2->bind_param("iisi", $last_id, $timestampMs_a, $type_a, $confidence_a);

foreach ($json_a as $key => $value) {
    if ($key == "locations") {
        foreach ($value as $key => $value) {
            //$last_new_id = newDBEntrydata($conn, $userID); //nea eggrafi
            $latitudeE7 = $value["latitudeE7"]/10000000;
            // echo "latitude: " . $latitudeE7 . "<br>";
            $longitudeE7 = $value["longitudeE7"]/10000000;
            // echo "longitude: " . $longitudeE7 . "<br>";
            // kopsimo syntetagmenwn me perissotero apo 0.05 dekadika psifia apostasi apo to kentro tis patras (38230462,21753150 +- 0.05).
            if (!(($latitudeE7 > 38.2804620)||($latitudeE7 < 38.1804620)||($longitudeE7 > 21.8031500)||($longitudeE7 < 21.7031500))) {
                $timestampMs = $value["timestampMs"];
                $accuracy = $value["accuracy"];
                if (empty($value["altitude"])) $altitude = 0;
                else $altitude = $value["altitude"];
                if (empty($value["verticalAccuracy"])) $verticalAccuracy = 0;
                else $verticalAccuracy = $value["verticalAccuracy"];
                if (empty($value["velocity"])) $velocity = 0;
                else $velocity = $value["velocity"];
                if (empty($value["heading"])) $heading = 0;
                else $heading = $value["heading"];

                foreach ($value as $key => $value) {
                    $last_id = mysqli_insert_id($conn);
                    if ($key != "activity") {
                        //ta vasika, ektos tou activity
                        //insertDataToDB($conn, $key, $value, $last_new_id, "data");
                    } else {
                        foreach ($value as $key => $value) {
                            $timestampMs_a = $value["timestampMs"];

                            foreach ($value as $key => $value) {
                                if (is_array($value)) {
                                    $max_conf=0;
                                    $likelyActivity="";
                                    foreach ($value as $key => $value) {
                                        $type_a = $value["type"];
                                        $confidence_a = $value["confidence"];
                                        $stmt2->execute();
                                        if ($type_a=="UNKNOWN"||$type_a=="IN_VEHICLE"||$type_a=="ON_FOOT"||$type_a=="STILL"||$type_a=="ON_BICYCLE") {
                                            if ($confidence_a > $max_conf) {
                                                $max_conf = $confidence_a;
                                                $likelyActivity = $type_a;
                                            }
                                        }
                                        else { $likelyActivity = "UNKNOWN"; }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $stmt->execute();
        }
    }
}
//enimerosi tis vasis gia to pote egine to teleutaio upload
$stmt3 = $conn->prepare("UPDATE users SET last_upload = ? WHERE userID = ?");
$last_upload=date('U')*1000;
$stmt3->bind_param("is", $last_upload, $_SESSION["id"]);
$stmt3->execute();

DBdisconnect($conn);

unlink("uploads/" . basename($_FILES["fileToUpload"]["name"]));
header("location: ../welcome.php");


// **********************************************************************
function newDBEntrydata($conn, $userID)
{

    // create data table entry
    $sql = "INSERT INTO data (userID) VALUES ($userID)";

    // Did it work?
    if (mysqli_query($conn, $sql)) {
        //echo "<br>New record created in table data<br>";
        $last_id = mysqli_insert_id($conn);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    return $last_id;
}

// *******************************************************************
function newDBEntryActivitytype($conn, $last_new_id, $timestampMs_a, $type_a, $confidence_a)
{

    // SQL insert
    $sql = "INSERT INTO activityType (entryID, timestampMs, type, confidence)
    VALUES ($last_new_id, $timestampMs_a, '$type_a', $confidence_a)";

    // Did it work?
    if (mysqli_query($conn, $sql)) {
        ;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// **********************************************************************
function insertDataToDB($conn, $key, $value, $last_id, $table)
{

    // SQL insert
    $sql = "UPDATE $table
    SET $key = $value
    WHERE entryID = $last_id";

    // Did it work?
    if (mysqli_query($conn, $sql)) {
        ;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// *************************************************************************

function DBconnect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function DBdisconnect($conn)
{
    mysqli_close($conn);
}

?>
