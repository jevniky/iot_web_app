<?php
// NOTE Print out only online devices? I guess so...
// TODO check continuously which devices are online.

// Get all connected online devices from DB
$devices = array();

$sql = "SELECT * FROM devices WHERE `type` = 'thermometer' AND `online` = 1";
$result = $conn->query($sql);
if ( $result->num_rows > 0 ){
  while ( $row = $result->fetch_assoc() ){
    $devices[] = array('sn'       => $row["sn"],
                       'type'     => $row["type"],
                       'ip'       => $row["ip"],
                       'online'   => $row["online"],
                       'location' => $row["location"]);
  }
}
?>
