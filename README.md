HCC by IdleMan
---------------------------------
contributing to the Web interface for controlling electrical outlet.

- Connect to the interface : login "admin", "admin" (you can change your login in configuration)
- Manage places and add engines
- Adding an engine, choose a type "outlet or electric switch"
- Specify power engine, and average duration
- Add a radio code for your engine (to your sender)

Go to constant.php and define the pin of your raspberry and a learning code for the chacon device
	
	//Numéro WiringPi du pin raspberry branché a l'emetteur radio
	define('PIN',0);
	//Code télécommande du raspberry (ne dois pas exceder les 2^26)
	define('SENDER',12352611);

change permissions for the script sending order to your outlet : radioEmission

sudo chmod 4777 radioEmission

and www-data for hcc : sudo chown -R www-data:www-data /var/www/hcc

* adding information of consommation


more on http://blog.idleman.fr/raspberry-pi-12-allumer-des-prises-distance/