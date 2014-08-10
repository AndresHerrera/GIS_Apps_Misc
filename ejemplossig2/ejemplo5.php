
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Ejemplo 5 - Ejemplo con visor MSCROSS - CAPTURA COORDENADAS CON CLICK</title>
		<link rel="stylesheet" type="text/css" href="misc/img/dc.css">
		<script src="misc/lib/mscross-1.1.9.js" type="text/javascript"></script>
	    <style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:162px;
	height:158px;
	z-index:101;
	left: 681px;
	top: 26px;
}
#Layer2 {
	position:absolute;
	width:141px;
	height:215px;
	z-index:102;
	left: 681px;
	top: 216px;
	background-color: #CCCCCC;
}
-->
        </style>
</head>
	<body>

<b>Click sobre el mapa, despues de seleccionar la opción (i) - boton verde </b>
	
		  <div class="mscross" style="overflow: hidden; width: 600px; height: 500px; -moz-user-select: none; position: relative;" id="dc_main"> </div>
		  <div id="Layer2">
		  
		  <form name="select_layers">
               <p align="left">
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[0]" value="lotes">
					<strong>lotes</strong>
                <br>
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[1]" value="vias">
					<strong>vias</strong>            
				<br>
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[2]" value="rios">
					<strong>rios</strong>
				<br>
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[3]" value="poblacion">
					<strong>poblacion</strong>
				<br>
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[4]" value="thiessen">
					<strong>thiessen</strong>
				<br>
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[5]" value="reservorio">
					<strong>reservorio</strong>
				<br>
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[6]" value="pluviometros">
					<strong>pluviometros</strong>
				<br>
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[7]" value="lotes_a">
					<strong>lotes_a</strong>
				<br>
					<input CHECKED onClick="chgLayers()" type="checkbox" name="layer[8]" value="buffer">
					<strong>buffer</strong>
            </form>
		  
		  
		  
		  
		  

		  
		  
		  </div>
		  <div id="Layer1">
		    <div  style="overflow: auto; width: 140px; height: 140px; -moz-user-select: none; position: relative; z-index: 100;" id="dc_main2"> </div>
	    </div>


		<script type="text/javascript">
			//<![CDATA[	
				myMap1 = new msMap( document.getElementById("dc_main"), 'standardRight' );
				myMap1.setCgi( '/cgi-bin/mapserv.exe' );
				myMap1.setMapFile( '/ms4w/Apache/htdocs/ejemplossig2/ejemplo1.map' );
				myMap1.setFullExtent( 1088767.75  ,1090961.875 ,889144.4375 );
				
				/*
					Mapserver: [minx] [miny] [maxx] [maxy]
					Mscross:   setFullExtent(Xmin, Xmax, Ymin)
				*/  
				 
				 
				myMap1.setLayers( 'lotes vias rios poblacion thiessen reservorio pluviometros lotes_a buffer' );
				
				myMap2 = new msMap( document.getElementById("dc_main2") );
				myMap2.setActionNone();
				myMap2.setFullExtent( 1088767.75  ,1090961.875 ,889144.4375  );
				myMap2.setMapFile( '/ms4w/Apache/htdocs/ejemplossig2/ejemplo1.map' );
				myMap2.setLayers( 'lotes vias rios poblacion thiessen reservorio pluviometros ' );
				myMap1.setReferenceMap(myMap2);
				
				
				
				var infola = new msTool('Obtener Informacion Elemento', infolay, 'misc/img/info_32.png', query);myMap1.getToolbar(0).addMapTool(infola);
				
				
				myMap1.redraw();  myMap2.redraw();
				chgLayers();
				
				var seleclayer = -1;
				var lyactive= false;
				var lejendactive= false;
				
				function chgLayers()
				{
					var list = "Layers ";
					var objForm = document.forms[0];
					for(i=0; i<document.forms[0].length; i++)
					{
						if( objForm.elements["layer[" + i + "]"].checked )
						{
							list = list + objForm.elements["layer[" + i + "]"].value + " ";
						}
					}
					myMap1.setLayers( list );
					myMap1.redraw();
				}
				
			var seleccionado = false;function infolay(e, map){map.getTagMap().style.cursor = "crosshair"; seleccionado = true;}	
				
				
			function query(event, map, x, y, xx, yy)
			{ 
				if(seleccionado)
				{ 
					alert("Click sobre el mapa en las coordenadas mapa : x: " + x + " y: " + y + " y reales :  x: " + xx + " y:  " + yy);
					seleccionado = false;
					map.getTagMap().style.cursor = "default"; 
				}
			}

		//]]>
		</script>
		
	
		
		
	  
		
	</body>
	
</html>