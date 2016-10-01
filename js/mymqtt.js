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
  document.getElementById("conn_status").style.backgroundColor = "#bc0000";
  document.getElementById("conn").innerHTML = "connection lost: " + responseObject.errorMessage;
};
// in case of a message arrival
function onMessageArrived(message) {
  var device_sn = "";
  // split the topic
  var topic_split = message.destinationName.split("/")
  if ( "clients" == topic_split[0] ) {
    device_sn = topic_split[1]; // The second part of the topic must be the SN
    if ( "state" == topic_split[2] ) { // If the topic is about device state
      if ( "0" == message.payloadString ) { // If the device went offline
        document.getElementById(device_sn+"_state").innerHTML = "OFF";
      } else if ( "1" == message.payloadString ) { // If the device went offline
        document.getElementById(device_sn+"_state").innerHTML = "ON"; // Just in case if the device went back on, and it was still in the table
      }
    }
  } else if ( "tempout" == topic_split[1] ) {
    device_sn = topic_split[0]; // The first part of the topic must be the SN
    var temperature = parseFloat(message.payloadString).toFixed(2); // The payload then must be the temperature measurement
    document.getElementById(device_sn+"_val").innerHTML = temperature; // Parse this value to the corespondig cell
  } else {
    // TODO Sth is wrong - bad topic
  }


// check for topic of a message (destination name)
switch(message.destinationName){
  case "power":
    power = parseFloat(message.payloadString);
    document.getElementById("power").innerHTML = power.toFixed(1);
    break;
  case "powerWeb":
    power = parseFloat(message.payloadString);
    document.getElementById("power").innerHTML = power.toFixed(1);
    break;
  case "temperature":
    //var temperature = message.payloadString;
    document.getElementById("temperature").innerHTML = parseFloat(message.payloadString).toFixed(2)
    break;
  };
};

var options = {
  timeout: 3,
  onSuccess: function () {
    document.getElementById("conn_status").style.backgroundColor = "#009700";
    document.getElementById("conn").innerHTML = "Connected";
    // Connection succeeded; subscribe to our topic, you can add multile lines of these
    client.subscribe("power", {qos: 0});
    client.subscribe("powerWeb", {qos: 0});
  },
  onFailure: function (message) {
    document.getElementById("conn").innerHTML = "Connection failed: " + message.errorMessage;
  }
};

function init() {
  client.connect(options);
};
