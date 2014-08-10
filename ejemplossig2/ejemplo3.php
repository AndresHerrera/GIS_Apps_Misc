<?php
	if (!extension_loaded("MapScript"))
	{ 
		dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
	}

	$mapObject = ms_newMapObj("");
	$mapObject->set("name","Ejemplo3");
	//$mapObject->set("shapepath","C:/ms4w/Apache/htdocs/ejemplossig2/shapes/");


	$mapObject->setSize(700,500);
	$mapObject->setExtent(1088767.75 , 889144.4375 , 1090961.875  , 891220);

	$mapObject->web->set( "imagepath" , "C:/ms4w/Apache/htdocs/ejemplossig2/tmp/" );
	$mapObject->web->set( "imageurl", "tmp/" );

	
	
	$conexion_basedatos="user=postgres password=fromsky dbname=ejemplossig2 host=localhost";
	
	
	
	
	// Creamos un Layer  poligono y seteamos sus propiedades 
	$layerPoligono = ms_newLayerObj($mapObject);
	$layerPoligono->set( "name", "lotes");
	$layerPoligono->set( "type", MS_LAYER_POLYGON);
	$layerPoligono->set( "status", MS_ON);
	$layerPoligono->set("connectiontype",MS_POSTGIS);
	$layerPoligono->set("connection",$conexion_basedatos);
	$layerPoligono ->set("data","the_geom from (select *  from lotes ) as mzyum using unique gid using srid=-1");
	$clasePoligono = ms_newClassObj($layerPoligono);
	$estiloPoligono = ms_newStyleObj($clasePoligono);
	$estiloPoligono->color->setRGB(255,123,0);
	$estiloPoligono->outlinecolor->setRGB(0, 0, 0);
	
	// Creamos un Layer Linea y seteamos sus propiedades 
	
	$layerLineas = ms_newLayerObj($mapObject);
	$layerLineas->set( "name", "vias");
	$layerLineas->set( "type", MS_LAYER_LINE);
	$layerLineas->set( "status", MS_ON);
	$layerLineas->set("connectiontype",MS_POSTGIS);
	$layerLineas->set("connection",$conexion_basedatos);
	$layerLineas ->set("data","the_geom from (select *  from vias) as mzyum using unique gid using srid=-1");
	$claseLineas = ms_newClassObj($layerLineas);
	$estiloLineas = ms_newStyleObj($claseLineas);
	$estiloLineas->color->setRGB(0,0,0);
	$estiloLineas->outlinecolor->setRGB(0, 0, 0);
	
	
	
	// Creamos un Layer Linea y seteamos sus propiedades 
	
	$layerLineas = ms_newLayerObj($mapObject);
	$layerLineas->set( "name", "rios");
	$layerLineas->set( "type", MS_LAYER_LINE);
	$layerLineas->set( "status", MS_ON);
	$layerLineas->set("connectiontype",MS_POSTGIS);
	$layerLineas->set("connection",$conexion_basedatos);
	$layerLineas ->set("data","the_geom from (select *  from rios) as mzyum using unique gid using srid=-1");
	$claseLineas = ms_newClassObj($layerLineas);
	$estiloLineas = ms_newStyleObj($claseLineas);
	$estiloLineas->color->setRGB(0 ,0 ,255);
	$estiloLineas->outlinecolor->setRGB(0, 0, 0);
	
	
	// Creamos un Layer  poligono y seteamos sus propiedades 
	$layerPoligono = ms_newLayerObj($mapObject);
	$layerPoligono->set( "name", "poblacion");
	$layerPoligono->set( "type", MS_LAYER_POLYGON);
	$layerPoligono->set( "status", MS_ON);
	$layerPoligono->set("connectiontype",MS_POSTGIS);
	$layerPoligono->set("connection",$conexion_basedatos);
	$layerPoligono ->set("data","the_geom from (select *  from poblacion ) as mzyum using unique gid using srid=-1");
	$clasePoligono = ms_newClassObj($layerPoligono);
	$estiloPoligono = ms_newStyleObj($clasePoligono);
	$estiloPoligono->color->setRGB(190 ,190 ,190);
	$estiloPoligono->outlinecolor->setRGB(0, 0, 0);
	
	
	// Creamos un Layer  poligono y seteamos sus propiedades 
	$layerPoligono = ms_newLayerObj($mapObject);
	$layerPoligono->set( "name", "thiessen");
	$layerPoligono->set( "type", MS_LAYER_POLYGON);
	$layerPoligono->set( "status", MS_ON);
	$layerPoligono->set("connectiontype",MS_POSTGIS);
	$layerPoligono->set("connection",$conexion_basedatos);
	$layerPoligono ->set("data","the_geom from (select *  from thiessen ) as mzyum using unique gid using srid=-1");
	$clasePoligono = ms_newClassObj($layerPoligono);
	$estiloPoligono = ms_newStyleObj($clasePoligono);
	//$estiloPoligono->color->setRGB(190 ,190 ,190);
	$estiloPoligono->outlinecolor->setRGB(255 , 0, 255);
	
	
	// Creamos un Layer  poligono y seteamos sus propiedades 
	$layerPoligono = ms_newLayerObj($mapObject);
	$layerPoligono->set( "name", "reservorio");
	$layerPoligono->set( "type", MS_LAYER_POLYGON);
	$layerPoligono->set( "status", MS_ON);
	$layerPoligono->set("connectiontype",MS_POSTGIS);
	$layerPoligono->set("connection",$conexion_basedatos);
	$layerPoligono ->set("data","the_geom from (select *  from reservorio ) as mzyum using unique gid using srid=-1");
	$clasePoligono = ms_newClassObj($layerPoligono);
	$estiloPoligono = ms_newStyleObj($clasePoligono);
	$estiloPoligono->color->setRGB(0 ,0 ,255);
	$estiloPoligono->outlinecolor->setRGB(255, 0, 255);
	
	
	// Creamos un Layer puntos y seteamos sus propiedades 
	$layerPuntos = ms_newLayerObj($mapObject);
	$layerPuntos->set( "name", "pluviometros");
	$layerPuntos->set( "type", MS_LAYER_POINT);
	$layerPuntos->set( "status", MS_ON);
	$layerPuntos->set("connectiontype",MS_POSTGIS);
	$layerPuntos->set("connection",$conexion_basedatos);
	$layerPuntos ->set("data","the_geom FROM pluviometros as puntos using unique gid using SRID=-1");
	$clasePuntos = ms_newClassObj($layerPuntos);
	$estiloPuntos = ms_newStyleObj($clasePuntos);
	$symbolid = ms_newSymbolObj($mapObject, "star");
    $oSymbol = $mapObject->getsymbolobjectbyid($symbolid);
    $oSymbol->setpoints(Array(0 ,.375 , .35, .375,.5, 0,.65, .375,1 ,.375,.75, .625,.875 ,1,.5 ,.75,.125, 1,.25 ,.625));
    $oSymbol->set("filled",MS_TRUE);
    $oSymbol->set("inmapfile", MS_TRUE);
    $estiloPuntos->color->setRGB(0 ,34 ,125);
	$estiloPuntos->outlinecolor->setRGB(0 ,255, 0);	
	$estiloPuntos->set("symbolname", "star");
    $estiloPuntos->set("size", "10");
	
	
	// Creamos un Layer  poligono y seteamos sus propiedades 
	$layerPoligono = ms_newLayerObj($mapObject);
	$layerPoligono->set( "name", "lotes_a");
	$layerPoligono->set( "type", MS_LAYER_POLYGON);
	$layerPoligono->set( "status", MS_ON);
	$layerPoligono->set("connectiontype",MS_POSTGIS);
	$layerPoligono->set("connection",$conexion_basedatos);
	$layerPoligono ->set("data","the_geom from (select * from lotes where area > 10 ) as mzyum using unique gid using srid=-1");
	$clasePoligono = ms_newClassObj($layerPoligono);
	$estiloPoligono = ms_newStyleObj($clasePoligono);
	$estiloPoligono->color->setRGB(255, 0,0);
	$estiloPoligono->outlinecolor->setRGB(98 ,0 ,111);
	
	
	// Creamos un Layer  poligono y seteamos sus propiedades 
	$layerPoligono = ms_newLayerObj($mapObject);
	$layerPoligono->set( "name", "buffer");
	$layerPoligono->set( "type", MS_LAYER_POLYGON);
	$layerPoligono->set( "status", MS_ON);
	$layerPoligono->set( "transparency", 20);
	$layerPoligono->set("connectiontype",MS_POSTGIS);
	$layerPoligono->set("connection",$conexion_basedatos);

	//Por aqui capturo mediante POST, el tamaño del buffer a generar.
	
	if(isset($_POST['tamano_buffer']))
	{
		//Si hay un valor asignado lo asigno a una variable que llamo $nuevo_tamano_buffer
		$nuevo_tamano_buffer = $_POST['tamano_buffer'];
		$layerPoligono ->set("data","the_geom from (select gid, buffer(the_geom, $nuevo_tamano_buffer) as the_geom  from pluviometros) as mzyum using unique gid using srid=-1");
	}
else
	{
		//Si no hay un valor asignado uso el que esta por defecto
		$layerPoligono ->set("data","the_geom from (select gid, buffer(the_geom, 200) as the_geom  from pluviometros) as mzyum using unique gid using srid=-1");
	}
	
	
	
	$clasePoligono = ms_newClassObj($layerPoligono);
	$estiloPoligono = ms_newStyleObj($clasePoligono);
	$estiloPoligono->color->setRGB(0 ,0 ,255);
	$estiloPoligono->outlinecolor->setRGB(0 ,0, 0);
	
	
	
	
				
	$mapImage = $mapObject->draw();
	$urlImage = $mapImage->saveWebImage();

?>

<html>

	<head>
		<title>Ejemplo 3 de Archivo que no usa .MAP y se convierte en dimamico el buffer</title>
	</head>
	
	<body>
		
	
		<br>
		<div align="center">
			Digite un numero entre <b>10 y 1000 </b>y despues haga click en generar buffer
			<br>
			<form name="formulario" action="ejemplo3.php" target="_parent" method="post">
				<input type="text" name="tamano_buffer"><br><br>
				<input type="submit" value="Generar Buffer">
			</form>
		</div> 
		
		<br>
		
		<img src="<?php echo $urlImage; ?>" border="1" >

	</body>
	
</html>