<?php 

	$coordenada_x = $_GET['x'];
	$coordenada_y = $_GET['y'];
	
	$connection = "host=localhost port=5432 dbname=ejemplossig2 user=postgres password=fromsky";
	$conecta=pg_connect($connection);

	$sql_spat = "select nombre_hda,area,cultivo,codigo  from lotes
where ST_Intersects(the_geom , ( GeometryFromText('POINT (' || $coordenada_x || ' ' || $coordenada_y || ')',  -1) ) )
and  the_geom IS NOT NULL  limit 1;";

	$sqr = pg_exec($conecta, $sql_spat);	
	if(pg_numrows($sqr)==0)
	{
		echo "La consulta no arrojo ningun resultado, favor dar click sobre un lote !";
	}
else
	{
		$campo1 = pg_result($sqr,0,0);
		$campo2 = pg_result($sqr,0,1);
		$campo3 = pg_result($sqr,0,2);
		$campo4 = pg_result($sqr,0,3);
		
		echo "Hacienda: $campo1 - Area: $campo2 - Cultivo: $campo3  - Codigo: $campo4";
	}

?>