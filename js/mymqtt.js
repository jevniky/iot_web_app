// MQTT websocket enabled broker
var broker = "192.168.0.12";
var port = 9001;
var clientID = "webClient_" + parseInt(Math.random() * 100, 10); // pridane nahodne cislo kvoli jedinecnej identifikacii uzivatela. Viac pripojeni cez webstranku.

// Create a client instance
var client = new Paho.MQTT.Client(broker, port, clientID);

// set callback handlers
client.onConnectionLost = onConnectionLost;
client.onMessageArrived = onMessageArrived;

var power = 0;

// in case of lost connection
function onConnectionLost(responseObject) {
  document.getElementById("cpu_state").style.backgroundColor = "#bc0000";
};

// in case of a message arrival
function onMessageArrived(message) {
  console.log(message.destinationName+" "+message.payloadString);
  var device_sn = "";
  // split the topic
  var topic_split = message.destinationName.split("/")
  if ( "clients" == topic_split[0] ) {
    device_sn = topic_split[1]; // The second part of the topic must be the SN
    if ( "state" == topic_split[2] ) { // If the topic is about device state
      if ( "0" == message.payloadString ) { // If the device went offline
        if ( document.getElementById(device_sn+"_state") != null ) { // If the element with this ID even exists
          document.getElementById(device_sn+"_state").style.backgroundColor = "#bc0000";
        } else {
          new_device();
        }
      } else if ( "1" == message.payloadString ) { // If the device went offline
        if ( document.getElementById(device_sn+"_state") != null ) { // If the element with this ID even exists
          document.getElementById(device_sn+"_state").style.backgroundColor = "#009700"; // In case if the device went back on, and it was still in the table
        } else {
          new_device();
        }
      }
    } else if ( "info" == topic_split[2] ) { // Info part
      if ( "ip" == topic_split[3] ) { // IP read
        if ( document.getElementById(device_sn+"_state") != null ) { // If the element with this ID even exists
          document.getElementById(device_sn+"_ip").innerHTML = message.payloadString; // Print the IP
        }
      }
    }
  } else if ( "tempout" == topic_split[1] ) {
    device_sn = topic_split[0]; // The first part of the topic must be the SN
    var temperature = parseFloat(message.payloadString).toFixed(2); // The payload then must be the temperature measurement
    if ( document.getElementById(device_sn+"_value") != null ) {
      document.getElementById(device_sn+"_value").innerHTML = temperature; // Parse this value to the corespondig cell
    }
  } else {
    // NOTE Sth is wrong - bad topic
  }
};

var options = {
  timeout: 3,
  onSuccess: function () {
    document.getElementById("cpu_state").style.backgroundColor = "#009700";
    // Connection succeeded; subscribe to our topic, you can add multile lines of these
    client.subscribe("clients/#", {qos: 0});
    //client.subscribe("clients/+/info", {qos: 0});
    client.subscribe('+/tempout', {qos: 0});
  },
  onFailure: function (message) {
    // document.getElementById("conn").innerHTML = "Connection failed: " + message.errorMessage;
    document.getElementById("cpu_state").style.backgroundColor = "#bc0000";
  }
};

function init() {
  client.connect(options);
};

function new_device() {
  if ( document.getElementById(device_sn+"_value") != null ) {
    var table = document.getElementById("devices"); // Get the devices table
    var row = table.insertRow(-1); // insert row on a first position (on a very top)
    var cell = row.insertCell(0);
    cell.setAttribute("colspan", "2");
    cell.setAttribute("id", "new_device");
    cell.innerHTML = '<i class="fa fa-exclamation" aria-hidden="true"></i> \
    <i class="fa fa-exclamation" aria-hidden="true"></i> \
    <i class="fa fa-exclamation" aria-hidden="true"></i> New device. <a href="index.php">Refresh</a>';
    row.insertCell(1);
    row.insertCell(2);
    row.insertCell(3);
    row.insertCell(4);
  }
}
