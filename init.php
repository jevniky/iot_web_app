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

echo '<table class="table">';
echo '<tr><th>Serial No.</th><th>Device type</th><th>IP address</th><th>State</th><th>Location</th><th>Value</th></tr>';
foreach ($devices as $key => $device) {
  echo "<tr>";
  foreach ($device as $index => $value) {
    if ( "online" == $index ) {
      if ( 1 == $value ) {
        echo '<td id="'.$device['sn'].'_state">ON</td>';
      } else {
        echo '<td id="'.$device['sn'].'_state">OFF</td>';
      }
    } else if ( "location" == $index ) {
      if ( "" == $value ) {
        echo "<td>N/A</td>";
      } else {
        echo "<td>".$value."</td>";
      }
    } else {
      echo "<td>".$value."</td>";
    }
  }
  // Cell for mesured value
  echo '<td id="'.$device['sn'].'_val">N/A</td>';
  echo "</tr>";
}
echo '</table>';
?>
