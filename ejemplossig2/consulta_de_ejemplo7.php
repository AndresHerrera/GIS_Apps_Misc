<?php

if (!extension_loaded("MapScript"))
	{	 
		dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
	}

@include_once('config.php');
	
header("Content-type: image/gif");

$map = ms_newMapObj($_GET['map']);
$size = explode(" ",$_GET['mapsize']);
$map->setSize($size[0], $size[1]);

$extent = explode(" ",$_GET['mapext']);
$map->setExtent($extent[0], $extent[1], $extent[2], $extent[3]);

$layerslist=$_GET['layers'];
for ($layer = 0; $layer < $map->numlayers; $layer++) 
{
    $lay = $map->getLayer($layer);
    if ((strpos($layerslist,($map->getLayer($layer)->name)) !== false) 
        or (($map->getLayer($layer)->group != "") and 
        (strpos($layerslist,($map->getLayer($layer)->group)) !== false)))
		{
        $lay->set(status,MS_ON);
       } 
	else 
	{
        $lay->set(status,MS_OFF);
    }
}




$conexion_basedatos="host=localhost dbname=ejemplossig2 user=postgres password=fromsky";

//Solo si he seleccionado algun boton que consulta lotes con areas mayores de 
if(isset($_GET['area']))
{

	$parametro_area = $_GET['area'];
	$layerPoligono=$map->getLayerByName("lotes_a");
	$layerPoligono->set( "name", "lotes_a");
	$layerPoligono->set( "type", MS_LAYER_POLYGON);
	$layerPoligono->set( "status", MS_ON);
	$layerPoligono->set("connectiontype",MS_POSTGIS);
	$layerPoligono->set("connection",$conexion_basedatos);
	$layerPoligono ->set("data","the_geom from (select * from lotes where area > $parametro_area ) as mzyum using unique gid using srid=-1");
	$clasePoligono = ms_newClassObj($layerPoligono);
	$estiloPoligono = ms_newStyleObj($clasePoligono);
	$estiloPoligono->color->setRGB(255 ,233,0);
	$estiloPoligono->outlinecolor->setRGB(0 ,0, 34);
}


if(isset($_GET['buffer_gen']))
{

	$parametro_buffer = $_GET['buffer_gen'];
	$layerPoligono=$map->getLayerByName("lotes_a");
	$layerPoligono->set( "name", "lotes_a");
	$layerPoligono->set( "type", MS_LAYER_POLYGON);
	$layerPoligono->set( "status", MS_ON);
	$layerPoligono->set("connectiontype",MS_POSTGIS);
	$layerPoligono->set("connection",$conexion_basedatos);
	$layerPoligono->set( "transparency", 20);
	$layerPoligono ->set("data","the_geom from (select gid, buffer(the_geom, $parametro_buffer) as the_geom  from pluviometros) as mzyum using unique gid using srid=-1");
	$clasePoligono = ms_newClassObj($layerPoligono);
	$estiloPoligono = ms_newStyleObj($clasePoligono);
	$estiloPoligono->color->setRGB(255 ,233,0);
	$estiloPoligono->outlinecolor->setRGB(0 ,0, 34);
}	
	
	
	
	



$image=$map->draw();
$imagename=$image->saveWebImage();

$image = imagecreatefromgif("/ms4w/Apache/htdocs/ejemplossig2/".$imagename);

imagegif($image);

?>



