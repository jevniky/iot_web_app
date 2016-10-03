<?php
include 'database/conn.php';
include 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>IoT partizani</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body onload="init();">
    <div class="container">
      <h1>Partizani IoT home</h1>
      <!-- Main table for devices and values -->
      <table class="table" id="devices">
        <tr>
          <th>Serial No.</th>
          <th>Device type</th>
          <th>IP address</th>
          <th>Location</th>
          <th>State</th>
          <th>Value</th>
        </tr>
        <!-- CPU line -->
        <!-- TODO Does this have to be here? -->
        <tr>
          <td>N/A</td>
          <td>CPU</td>
          <td>192.168.0.12</td>
          <td>N/A</td>
          <td>
            <div class="conn_status" id="cpu_state"></div>
          </td>
          <td>N/A</td>
        </tr>
        <!-- List devices from database -->
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
        } ?>
      </table>
      <!-- END Main table -->
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mqttws31.js"></script>
    <script type="text/javascript" src="js/mymqtt.js"></script>
  </body>
</html>
