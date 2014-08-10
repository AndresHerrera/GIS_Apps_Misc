

<script>

function dibujarMapa(accion)
{
   window.location.href = 'index.php?ejecutar=true&accion=' + accion;
}

function verEstableByID(ifd)
{
	var googlewin=dhtmlwindow.open("googlebox", "iframe", "info_sucursal.php?idp="+ifd, "Información Sucursal Bancaria - COMUNA 3", "width=590px,height=350px,resize=1,scrolling=1,center=1,left=150px,top=10px", "recal")

	//alert(ifd);
}

</script>

<?php

    include_once('configuracion.php');

	if (!extension_loaded("MapScript"))
	{	 
		dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
	}

	$mapObject = ms_newMapObj(MAPFILE);
	$defSize=3;
	$checkPan="CHECKED";
	

	
	
	
	$espacio = $HTTP_POST_VARS["zoom"]*$HTTP_POST_VARS["zsize"];
	//echo $espacio;
	
	//CAPA DE PUNTOS QUE REPRESENTA LOS DELITOS
	
	$layerPuntos = ms_newLayerObj($mapObject);
	$layerPuntos->set( "name", "Puntos");
	$layerPuntos->set( "type", MS_LAYER_POINT);
	$layerPuntos->set( "status", MS_ON);
	$layerPuntos->set("connectiontype",MS_POSTGIS);
	$layerPuntos->set("connection",COMUNA3_CONEXIONPOSTGRES);
	
	$layerPuntos->set( "data", "the_geom FROM (select * from ".TABLA_BANCOSCAJEROS.") as punto using unique gid using SRID=-1");
	
	$layerPuntos->set("labelitem","marca"); 
	$layerPuntos->set("labelcache","ON");
	
	$clasePuntos = ms_newClassObj($layerPuntos);
	$clasePuntos ->set('name',"Bancos Comuna 3" );
	
	$layerPuntos->set("classitem", "key");
	$clasePuntos->setexpression("/3/"); 
	
	
	
	if ($espacio>0)
	{
		$labelPuntos = $clasePuntos->label;
		$labelPuntos->set("type", "truetype");
		$labelPuntos->set("font", "sans");
		$labelPuntos->set("position", "ll");
		$labelPuntos->set("partials", "false");
		$labelPuntos->set("force", "false");
		$labelPuntos->set("size", "8");
	}
	
	$estiloPuntos = ms_newStyleObj($clasePuntos);
	$estiloPuntos->color->setRGB(0 ,34 ,125);
	$estiloPuntos->outlinecolor->setRGB(255 ,255, 0);	
	$estiloPuntos->set("symbolname", "3_ico");
    $estiloPuntos->set("size", "15");
	
	
	
	$clasePuntos2 = ms_newClassObj($layerPuntos);
	$clasePuntos2 ->set('name',"Cajeros Comuna 3" );
	
	$layerPuntos->set("classitem", "key");
	$clasePuntos2->setexpression("/6/"); 
	
	if ($espacio>0)
	{
		$labelPuntos2 = $clasePuntos2->label;
		$labelPuntos2->set("type", "truetype");
		$labelPuntos2->set("font", "sans");
		$labelPuntos2->set("position", "cc");
		$labelPuntos2->set("partials", "false");
		$labelPuntos2->set("force", "false");
		$labelPuntos2->set("size", "8");
	}
	
	$estiloPuntos2 = ms_newStyleObj($clasePuntos2);
	$estiloPuntos2->color->setRGB(12 ,32 ,125);
	$estiloPuntos2->outlinecolor->setRGB(0 ,255, 0);	
	$estiloPuntos2->set("symbolname", "6_ico");
    $estiloPuntos2->set("size", "15");
	
	
	
	if($_GET['ejecutar'] == 'true')
	{
	    $accion = $_GET['accion'];
		
		if ( $accion != -1)
		{
		
		$saccion = split ("-",$accion);
		
		$maccion = $saccion[0];
		$vaccion = $saccion[1];
		$faccion = $saccion[2];
		
		
		 $fecha = $_POST['fecha'];
		 $hora = $_POST['hora'];
		 
		 
		$layerPuntos = ms_newLayerObj($mapObject);
		$layerPuntos->set( "name", "Puntos");
		$layerPuntos->set( "type", MS_LAYER_POINT);
		$layerPuntos->set( "status", MS_ON);
		$layerPuntos->set("connectiontype",MS_POSTGIS);
		$layerPuntos->set("connection",COMUNA3_CONEXIONPOSTGRES);
		
		
		if($faccion!='9999')
		{
			if($maccion=='barrio')
			{
				$sqlpostgres ="the_geom FROM ( select * from ".TABLA_BANCOSCAJEROS." as d where intersects(d.the_geom , (select the_geom from barrios_comuna3 where gid=$vaccion) ) ) as punto using unique gid using SRID=-1";
			    $sql_tabla = "select * from ".TABLA_BANCOSCAJEROS." as d where intersects(d.the_geom , (select the_geom from barrios_comuna3 where gid=$vaccion) ) order by nombre asc";
			}
			
			if($maccion=='marca')
			{
				$sqlpostgres ="the_geom FROM ( select * from ".TABLA_BANCOSCAJEROS." as d where marca='$vaccion' ) as punto using unique gid using SRID=-1";
			    $sql_tabla = "select * from ".TABLA_BANCOSCAJEROS." as d where marca='$vaccion' order by nombre asc";
			}
			
			if($maccion=='key')
			{
				$sqlpostgres ="the_geom FROM ( select * from ".TABLA_BANCOSCAJEROS." as d where key='$vaccion' ) as punto using unique gid using SRID=-1";
			    $sql_tabla = "select * from ".TABLA_BANCOSCAJEROS." as d where key='$vaccion' order by nombre asc";
			}
		
		}
	else
		{
		   
		  
		}
		
		$layerPuntos->set( "data", $sqlpostgres);
	
	    $layerPuntos->set("labelitem","gid"); 	
	    $layerPuntos->set("labelcache","ON");
	
	    $clasePuntos = ms_newClassObj($layerPuntos);
	    $clasePuntos ->set('name',"Resultado Consulta" );
		$estiloPuntos = ms_newStyleObj($clasePuntos);
		
		$random = 255;//(rand()%255)+1;
		$random2 = 0;//(rand()%255)+1;
		$random3 = 0;//((rand()%255)+1;
		
		switch($maccion)
		{	
			case 'barrio':{ $colorP= array("a"=>"$random","b"=>"$random3","c"=>"$random2","d"=>"$random2","e"=>"$random3","f"=>"$random","g"=>"point","h"=>25); break;}
			default:{ $colorP= array("a"=>"$random","b"=>"$random3","c"=>"$random2","d"=>"$random2","e"=>"$random3","f"=>"$random","g"=>"point","h"=>21); break;}
		}
		
		$estiloPuntos->color->setRGB($colorP['a'] ,$colorP['b'] ,$colorP['c']);
		$estiloPuntos->outlinecolor->setRGB($colorP['a'] ,$colorP['b'] ,$colorP['c']);	
		$estiloPuntos->set("symbolname", $colorP["g"]);
		$estiloPuntos->set("size", $colorP["h"]);

		
		
	 }  
	
	}
	
	
	
	//delitos_comuna2
	 
	
	if($_POST)
	{
		//Bloque que permite encender y apagar las capas
		$item = $_REQUEST["layerselector"];
		$allLayersObject=$mapObject->getAllLayerNames();
		foreach ($allLayersObject as $idx => $layer) 
		{								
			$layerObject=$mapObject->getLayerByName($layer);
			if( sizeof( $item ) > 0 )
			{
				if (in_array( $layerObject->name, $item ))
				{
					if(($layerObject->name != "Norte") )
					{
						$layerObject->set( "status", MS_ON );
					}
				}
			else
				{
					if(($layerObject->name != "Norte") )
					{
						$layerObject->set( "status", MS_OFF );
					}
				}
			}
		}
	}
		
		
	if ( isset($HTTP_POST_VARS["mapa_x"]) && isset($HTTP_POST_VARS["mapa_y"])&& !isset($HTTP_POST_VARS["full"]) ) 
	{
		$arrayExtent = explode(" ",$HTTP_POST_VARS["extent"]); 
		
		$mapObject->setextent($arrayExtent[0],$arrayExtent[1],$arrayExtent[2],$arrayExtent[3]);
		
		$pointObject = ms_newpointObj();
		$pointObject->setXY($HTTP_POST_VARS["mapa_x"],$HTTP_POST_VARS["mapa_y"]);

		$extentRectObject = ms_newrectObj();
		$extentRectObject->setextent($arrayExtent[0],$arrayExtent[1],$arrayExtent[2],$arrayExtent[3]);

		$zoomFactor = $HTTP_POST_VARS["zoom"]*$HTTP_POST_VARS["zsize"];
		
		if ($zoomFactor == 0) 
		{
			$zoomFactor = 1;
            $checkPan = "CHECKED";
			$checkZout = "";
			$checkZin = "";
			$checkClick = "";
		} 
	else 
		if ($zoomFactor < 0) 
		{
            $checkPan = "";
			$checkZout = "CHECKED";
			$checkZin = "";
			$checkClick = "";
		} 
	else 
		{
            $checkPan = "";
            $checkZout = "";
			$checkZin = "CHECKED";
			$checkClick = "";
		}

		$defSize = abs($zoomFactor);
		
		if( $_REQUEST["zoom"] != "click") 
		 {
			$mapObject->zoompoint($zoomFactor,$pointObject,$mapObject->width,$mapObject->height,$extentRectObject);
		 }
	else
		{ 
		}

		
	}

	$mapImage = $mapObject->draw();
	$urlImage = $mapImage->saveWebImage();
	
	$mapLegend = $mapObject->drawLegend();
	$urlLegend = $mapLegend->saveWebImage(MS_GIF, 0, 0, -1);
		
	$mapScale = $mapObject->drawScaleBar();
	$urlScale = $mapScale->saveWebImage(MS_GIF, 0, 0, -1);
	
	$keyMapImage = $mapObject->drawreferencemap();
	$urlKeyMap = $keyMapImage->saveWebImage(MS_GIF, 0, 0, -1);
		
	
	$printExtentHTML = $mapObject->extent->minx." ".$mapObject->extent->miny." " .$mapObject->extent->maxx." ".$mapObject->extent->maxy;
	
	
	if ( isset($_REQUEST["zoom"]) && $_REQUEST["zoom"]=="info") 
	{
		 	$checkClick = "CHECKED";
		 	$checkPan = "";
			$checkZout = "";
            $checkZin = "";
		 
			$dfKeyMapXMin = $mapObject->extent->minx;
			$dfKeyMapYMin = $mapObject->extent->miny;
			$dfKeyMapXMax = $mapObject->extent->maxx;
			$dfKeyMapYMax = $mapObject->extent->maxy;
	
			$dfWidthPix = doubleval($mapImage->width);
			$dfHeightPix = doubleval($mapImage->height);
			
			$nClickGeoX = GMapPix2Geo($_REQUEST['mapa_x'], 0, $dfWidthPix,  $dfKeyMapXMin, $dfKeyMapXMax, 0);
			$nClickGeoY = GMapPix2Geo($_REQUEST["mapa_y"], 0, $dfHeightPix, $dfKeyMapYMin, $dfKeyMapYMax, 1);
			
			$my_point = ms_newpointObj();
			$my_point->setXY($nClickGeoX,$nClickGeoY);
		     	
	}
	
	

?>
<HTML>
<HEAD>
<title>VISUALIZACION DE SUCURSALES BANCARIAS EN LA COMUNA 3 DE SANTIAGO DE CALI.</title>
<style type="text/css">
<!--
.style3 {font-size: 18px; font-weight: bold; }
-->
</style>
<link rel="stylesheet" href="windowfiles/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="windowfiles/dhtmlwindow.js" > </script>
</HEAD>
<BODY>




<CENTER>

<img src="imagenes/titulo_aplicacion.jpg"/>

<FORM METHOD="POST" id="myForm" name="frmlayerselector" ACTION="<?php echo $HTTP_SERVER_VARS['PHP_SELF']?>">
  <table width="900" height="544" border="0" cellpadding="1" cellspacing="1" bordercolor="#000000">
    <tr>
      
	  <td width="200px" rowspan="2" scope="col" valign="top" border="1"  bordercolor="#000000" >
	    
		<table border="0"  width="100%"  align="center" cellpadding="0" cellspacing="0" bordercolor="#ffffff">
        
		<!-- <tr>
		  <td><input type=RADIO name="zoom" value=info <?php echo $checkClick; ?>>          </td>
          <td><h3><span class="style3"><img src="librerias/img/moreInfo.gif"/></span></h3></td>
		  <!--<td><h3><span class="style3"><img src="librerias/img/mActionIdentify.png"/> Consultar </span></h3></td>-->
          
        <!-- </tr>-->
		
		<tr>
          <td><input type=RADIO name="zoom" value=0 <?php echo $checkPan; ?>>          </td>
		  <td><h3><span class="style3"> <img src="librerias/img/pan.gif"/></span></h3></td>
		  <!--<td><h3><span class="style3"> <img src="librerias/img/mActionPan.png"/>  Mover </span></h3></td>-->
          
        </tr>
        <tr>
		
		  <td><input type=RADIO name="zoom" value=1 <?php echo $checkZin; ?>>          </td>
          <!--<td><h3><span class="style3"> <img src="librerias/img/mActionZoomIn.png"/>  Acercar </span></h3></td>-->
		  <td><h3><span class="style3"> <img src="librerias/img/zoomIn.gif"/></span></h3></td>
          
        </tr>
        <tr>
          <td><input type=RADIO name="zoom" value=-1 <?php echo $checkZout; ?>>          </td>
		  <!--<td><h3><span class="style3"> <img src="librerias/img/mActionZoomOut.png"/>  Alejar </span></h3></td>-->
		  
		   <td><h3><span class="style3"> <img src="librerias/img/zoomOut.gif"/><img src="sep.png"/></span></h3></td>
          
        </tr>
        
		
		<!--
		<tr>
          <td><h3><span class="style3"> Zoom Size </span></h3></td>
          <td>
		  -->
		  <input type=hidden  name="zsize" value="<?php echo $defSize; ?>"  size=2>        

<!--
		  </td>
        </tr>-->
       	   
	      <!-- <tr>
          <td> <h3>Full Extent </h3></td>
          <td><input type=SUBMIT name="full" value="Go"   size=2>          
		  </td>-->
		  
		  
        </table>
        <br>
		<!--
        <table width="140" height="151" border="1" align="center" valign="top" cellpadding="2" cellspacing="2" bordercolor="#000000">
 
		  <tr>
            <th scope="col"><img src="<?php echo $urlKeyMap; ?>" border="0" ></th>
          </tr>
		  
		  
		   <tr>
            <th scope="col" align="left" valign="top">
							
														
				<?php 
								
					$allLayersObject=$mapObject->getAllLayerNames();
					foreach ($allLayersObject as $idx => $layer) 
					{
						$layerObject=$mapObject->getLayerByName($layer);
						if ($layerObject->status==MS_ON) 
						{
							if(($layerObject->name != "Norte") )
								{
									$Class = $layerObject->getClass(0);											
									echo "<input type='checkbox' value='{$layerObject->name}'  name='layerselector[]' onClick='document.frmlayerselector.submit();' checked>";
									echo "<span>{$Class->name}</span><br /> ";
								}
						}
					else
						{
						    if(($layerObject->name != "Norte") )
								{
									$Class = $layerObject->getClass(0);
									echo "<input type='checkbox' value='{$layerObject->name}' name='layerselector[]'onClick='document.frmlayerselector.submit();'  > ";
									echo "<span>{$Class->name}</span><br /> ";
								}
						}
					}
							
					?>			
					</th>
          </tr>
		  
		  <tr>
            <th scope="col"><img src="<?php echo $urlLegend; ?>" alt="leyenda" border="0" ></th>
          </tr>
		  
		  
		  
		  
        </table>
		
		-->
		
		</td>
		
		
      <td width="78%" height="499" scope="col"><div align="center"> <input type=IMAGE name="mapa" src="<?php echo $urlImage; ?>" border=1></div>
	  </td>
	  
	  <td valign="top">
	  
	
	  
	  <b>Ver sucursales del barrio:</b><br>
	  <select onChange="dibujarMapa(this.value);" >
	   <option value='-1' >--- Seleccionar ---</option>
	   <?php 
			$sql2= "select nom_barrio , gid from ". TABLA_BARRIOS . " order by nom_barrio asc;" ;
		    $eje=pg_exec($conecta,$sql2);		  
	
			for($nu=0; $nu<pg_numrows($eje) ; $nu++)
			{
				$resultado1 = pg_result($eje, $nu, 0);	
                $resultado2 = pg_result($eje, $nu, 1);					
				echo "<option value='barrio-$resultado2' >$resultado1</option>";
			}
		?>
		

	  </select>
	  <br>
	  
	  
	  <b>Ver sucursales del banco:</b><br>
	  <select onChange="dibujarMapa(this.value);" >
	   <option value='-1' >--- Seleccionar ---</option>
	   <?php 
			$sql2= "select marca from ". TABLA_BANCOSCAJEROS . "  group by 1 order by marca asc;" ;
		    $eje=pg_exec($conecta,$sql2);		  
	
			for($nu=0; $nu<pg_numrows($eje) ; $nu++)
			{
				$resultado1 = pg_result($eje, $nu, 0);	
                //$resultado2 = pg_result($eje, $nu, 1);					
				echo "<option value='marca-$resultado1' >$resultado1</option>";
			}
		?>
		

	  </select>
	  
	  
	  
	   <br>
	  
	  
	  <b>Ver todos los:</b><br>
	  <select onChange="dibujarMapa(this.value);" >
	   <option value='-1' >--- Seleccionar ---</option>
	    <option value='key-3' >Bancos</option>
		 <option value='key-6' >Cajeros</option>
	  </select>
	  
	 
	  
	 	  <br>
	  
	  
	          <table width="140" height="151" border="1" align="center" valign="top" cellpadding="2" cellspacing="2" bordercolor="#000000">
 
		  <tr>
            <th scope="col"><img src="<?php echo $urlKeyMap; ?>" border="0" ></th>
          </tr>
		  
		  
		   <tr>
            <th scope="col" align="left" valign="top">
							
														
				<?php 
								
					$allLayersObject=$mapObject->getAllLayerNames();
					foreach ($allLayersObject as $idx => $layer) 
					{
						$layerObject=$mapObject->getLayerByName($layer);
						if ($layerObject->status==MS_ON) 
						{
							if(($layerObject->name != "Norte") )
								{
									$Class = $layerObject->getClass(0);											
									echo "<input type='checkbox' value='{$layerObject->name}'  name='layerselector[]' onClick='document.frmlayerselector.submit();' checked>";
									echo "<span>{$Class->name}</span><br /> ";
								}
						}
					else
						{
						    if(($layerObject->name != "Norte") )
								{
									$Class = $layerObject->getClass(0);
									echo "<input type='checkbox' value='{$layerObject->name}' name='layerselector[]'onClick='document.frmlayerselector.submit();'  > ";
									echo "<span>{$Class->name}</span><br /> ";
								}
						}
					}
							
					?>			
					</th>
          </tr>
		  
		  <tr>
            <th scope="col"><img src="<?php echo $urlLegend; ?>" alt="leyenda" border="0" ></th>
          </tr>
		  
		  
		  
		  
        </table>
	  

	  </td>
	  
    </tr>
	
	
	 
	
	
	
    <tr>
      <td scope="col"><div align="center"><img src="<?php echo $urlScale; ?>" border="0" ></div>
	  </td>
    </tr>
  </table>
  <INPUT TYPE=HIDDEN NAME="extent" VALUE="<?php echo $printExtentHTML; ?>">
</FORM>

<?php  

if($sql_tabla != ""){

$sqlresult = pg_exec($conecta, $sql_tabla);

		

echo "<table border='1' width='100%'>";

if( pg_numrows($sqlresult) > 0)
{	
	$fields = pg_numrows($sqlresult);
	$rows = pg_numfields($sqlresult);
	
	//datos cabecera
	echo "<tr bgcolor='blue'>";
	for($c=0; $c<$rows;$c++)
	{
		$titlef = pg_field_name($sqlresult, $c);
		if($titlef !="the_geom" and  $titlef !="gid"  and  $titlef  and  $titlef !="key" and  $titlef !="categoria")
		{
			echo "<th>". strtoupper($titlef) ."</th>";
			if($c == 1)
			{
				echo "<th> SERVICIOS </th>";
			}
		}
	}
	echo "</tr>";
	
    //datos tabla	
	for($a=0; $a<$fields;$a++)
	{		
		echo "<tr>";
		for($c=0; $c<$rows;$c++)
		{
			$titlef = pg_field_name($sqlresult, $c);
			if($titlef=="gid")
			{ 
			   $ddd = pg_result($sqlresult,$a,$c);
			}
			if($titlef !="the_geom" and  $titlef !="gid"  and  $titlef !="key"  and  $titlef !="categoria" )
			{
				$res = pg_result($sqlresult,$a,$c);
				echo "<td> $res</td>";
				if($c == 1)
				{
					echo "<td> <a href='#' onClick='verEstableByID($ddd);'>Ver Servicios </a> </td>";
				}
			}
		}
		echo "</tr>";
	}	
	echo "</table>";	
}
else
{
	echo "<b>La consulta no retorno ningun resultado !!</b>";
	echo "<script>alert('No existe registro alguno de sucursal bancaria o cajero en esta zona de la ciudad !! ');</script>";
}
}
?>


</CENTER>
</BODY>
</HTML>


<?php

function GMapPix2Geo($nPixPos, $dfPixMin, $dfPixMax, $dfGeoMin, $dfGeoMax, $nInversePix) 
{
    $dfWidthGeo = $dfGeoMax - $dfGeoMin;
    $dfWidthPix = $dfPixMax - $dfPixMin;
   	$dfPixToGeo = $dfWidthGeo / $dfWidthPix;

    if (!$nInversePix)
        $dfDeltaPix = $nPixPos - $dfPixMin;
    else
        $dfDeltaPix = $dfPixMax - $nPixPos;

    $dfDeltaGeo = $dfDeltaPix * $dfPixToGeo;
	$dfPosGeo = $dfGeoMin + $dfDeltaGeo;
	return ($dfPosGeo);
}

?>