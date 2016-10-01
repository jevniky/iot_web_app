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

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body onload="init();">
    <div class="container">
      <h1>Partizani home</h1>
      <div id="conn_status"></div>
      <div id="conn">&nbsp</div>
      <?php


      ?>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mqttws31.js" type="text/javascript"></script>
    <script src="js/mymqtt.js" type="text/javascript"></script>

  </body>
</html>
