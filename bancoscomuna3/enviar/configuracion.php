 <?php
	
	define('SERVIDOR','localhost');
	define('PORT','5432');
	define('USUARIO','postgres');
	define('PASSWORD','postgres');
	
	define('BASEDATOS','bancosc3');
	
	define('MAPFILE','comuna3.map');
	
	define('TABLA_BANCOSCAJEROS','bancaj_comuna3');
	define('TABLA_BARRIOS','barrios_comuna3');
	
	define('TABLA_SERVICIOS','c3_servicios');
	define('TABLA_PRODUCTOS','c3_productos');
	
	define('COMUNA3_CONEXIONPOSTGRES','user='.USUARIO.' password='.PASSWORD.' dbname='.BASEDATOS.' host='.SERVIDOR.'');
	
	$connection = "host=".SERVIDOR." port=5432 dbname=".BASEDATOS." user=".USUARIO." password=".PASSWORD."";
	$conecta=pg_connect($connection);

?>