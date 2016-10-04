# iot_web_app
Web application for the IoT project

The web page is on a local web server. After it's loaded, it connects to an mqtt broker.

It loads all the sensors, nodes and devices from database and displays it as a table of devices, including CPU (which is the web, database and mqtt server). The online/offline state of individual devices is shown as red or green circle in each table row.

When a device that is already in the database, and been offline connects, the red "LED" in the corresponding row becomes green, the IP address of this device is loaded and, if it is a sensor node, the web application displays a measured value in the same row.

If a device, not yet in the database, connects, the application notifies the user with a new table row saying there is a new device connected to the network and the user is prompted to refresh the application.

If the connected device goes suddenly offline, the "LED" turns red again.

