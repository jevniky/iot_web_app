<?php
// Get all connected online devices from DB
$devices = array();

$sql = "SELECT * FROM `devices`";
$result = $conn->query($sql);
if ( $result->num_rows > 0 ){
  while ( $row = $result->fetch_assoc() ){
    $devices[] = array('sn'       => $row["sn"],
                       'type'     => $row["type"],
                       'ip'       => $row["ip"],
                       'location' => $row["location"],
                       'state'    => $row["state"],
                       'value'    => 'N/A'); // a value column. First N/A, later it will be filled according to mqtt message
  }
}
?>
