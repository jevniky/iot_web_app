<?php
include 'database/conn.php';
include 'init.php';
?>
<?php
foreach ($devices as $key => $device) { // Loop through devices found in DB
  echo "<tr>"; // new row
  foreach ($device as $column => $cell) { // loop through each device and print out information
    if ( "state" == $column ) { // If the column is state, put there an icon, instead of text.
      echo '<td>';
      echo  '<div class="conn_status" id="'.$device['sn'].'_state"></div>'; // the status icon
      echo '</td>';
    } else { // Else print what is saved in the DB
      echo '<td id="'.$device['sn'].'_'.$column.'">'.$cell.'</td>';
    }
  }
  echo "</tr>"; // end row
}
?>
