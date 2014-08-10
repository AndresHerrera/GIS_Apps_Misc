<?php

	if (!extension_loaded("MapScript"))
	{	 
		dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
	}
	
	$jMap = ms_newMapObj("ejemplo1.map");
	$jImagen = $jMap->draw();
	$url_imagen = $jImagen->saveWebImage();
?>
<HTML>
	<HEAD>
		<TITLE>Ejemplo 1 - Mapserver / Curso de Modelo de Datos</TITLE>
	</HEAD>
	<BODY>
		<center>
			<IMG SRC=<?php echo $url_imagen; ?> border=1 >
		</center>
	</BODY>
</HTML>