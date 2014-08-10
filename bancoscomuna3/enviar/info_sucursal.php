<?php 

 include_once('configuracion.php');

 
  $idbanco = $_GET['idp']; 
  
  $br = "<br>";
 
 $sql2= "select gid,nombre,direccion,telefono,municipio,horario,categoria,key  from ". TABLA_BANCOSCAJEROS ." where gid= ".$idbanco.";";
 $eje=pg_exec($conecta,$sql2);
 
 //for($nu=0; $nu<pg_numrows($eje) ; $nu++)
 if($eje)
{
	$resultado1 = pg_result($eje, 0, 0);	
    $resultado2 = pg_result($eje, 0, 1);
	$resultado3 = pg_result($eje, 0, 2);
	$resultado4 = pg_result($eje, 0, 3);
	$resultado5 = pg_result($eje, 0, 4);
	$resultado6 = pg_result($eje, 0, 5);
	$resultado7 = pg_result($eje, 0, 6);
	$resultado8 = pg_result($eje, 0, 7);
    echo "<img src='imagenes/bancos/".getIcono($resultado7)."' width=280 height=150 /><br>";
    echo "<b>NOMBRE: </b>".$resultado2.$br;
	echo "<b>DIRECCIÓN: </b>".$resultado3.$br;
	echo "<b>TELEFONO: </b>".$resultado4.$br;
	echo "<b>MUNICIPIO: </b>".$resultado5.$br;
	echo "<b>HORARIO: </b>".$resultado6.$br;
	echo "<b>SUCURSAL DE: </b>".$resultado7.$br;
	echo "<br><font color='blue'><b>PRODUCTOS/SERVICIOS OFRECIDOS</b></font><br>";
	
	$sql3= "select servicio1,servicio2,servicio3,servicio4,servicio5,servicio6,servicio7,servicio8,adicional from ". TABLA_SERVICIOS ." where id_bco=".$idbanco.";";
	$eje3=pg_exec($conecta,$sql3);
 
	if($eje3)
	{
		$resultado1 = pg_result($eje3, 0, 0);
		$resultado2 = pg_result($eje3, 0, 1);
		$resultado3 = pg_result($eje3, 0, 2);
		$resultado4 = pg_result($eje3, 0, 3);
		$resultado5 = pg_result($eje3, 0, 4);
		$resultado6 = pg_result($eje3, 0, 5);
		$resultado7 = pg_result($eje3, 0, 6);
		$resultado8 = pg_result($eje3, 0, 7);
		$resultado9 = pg_result($eje3, 0, 8);
		echo "<b> + ".strtoupper(getProduServi($resultado1,$conecta)) ."</b><br>";
		echo "<b> + ".strtoupper(getProduServi($resultado2,$conecta)) ."</b><br>";	
		echo "<b> + ".strtoupper(getProduServi($resultado3,$conecta)) ."</b><br>";	
		echo "<b> + ".strtoupper(getProduServi($resultado4,$conecta)) ."</b><br>";	
		echo "<b> + ".strtoupper(getProduServi($resultado5,$conecta)) ."</b><br>";	
		echo "<b> + ".strtoupper(getProduServi($resultado6,$conecta)) ."</b><br>";	
		echo "<b> + ".strtoupper(getProduServi($resultado7,$conecta)) ."</b><br>";	
		echo "<b> + ".strtoupper(getProduServi($resultado8,$conecta)) ."</b><br>";	
		echo "<font color='red'><b> * ".($resultado9)."</b></font><br>";			
	} 

}

 
		
    /*
	"CITIBANK"
"BANCO AGRARIO"
"BANCO DE CREDITO"
"COLMENA"
"ABN AMRO BANK"
"BANCO DE LA REPUBLICA"
"BBVA"
"BANCOLOMBIA"
"DAVIVIENDA"
"AV VILLAS"
"CAJA SOCIAL"
"SERVIBANCA"
"COLPATRIA"
"BANCO POPULAR"
"GNB SUDAMERIS"
"BANCO DE OCCIDENTE"
"BANCO DE BOGOTA"
"BANCO SANTANDER"


	*/ 
	function getIcono($text)
	{
	   $img = "";
	   switch($text)
	   {
			case "CITIBANK":{ $img = "14.gif"; break; }
			case "BANCO AGRARIO":{$img = "4.gif"; break;}
			case "BANCO DE CREDITO":{$img = "18.gif"; break;}
			case "COLMENA":{$img = "11.gif"; break;}
			case "ABN AMRO BANK":{$img = "1.gif"; break;}
			case "BANCO DE LA REPUBLICA":{$img = "17.gif"; break;}
			case "BBVA":{$img = "13.gif"; break;}
			case "BANCOLOMBIA":{$img = "11.gif"; break;}
			case "DAVIVIENDA":{$img = "21.gif"; break;}
			case "AV VILLAS":{$img = "2.gif"; break;}
			case "CAJA SOCIAL":{$img = "9.gif"; break;}
			case "SERVIBANCA":{$img = "23.gif"; break;}
			case "COLPATRIA":{$img = "15.gif"; break;}
			case "BANCO POPULAR":{$img = "7.gif"; break;}
			case "GNB SUDAMERIS":{$img = "20.gif"; break;}
			case "BANCO DE OCCIDENTE":{$img = "6.gif"; break;}
			case "BANCO DE BOGOTA":{$img = "10.gif"; break;}
			case "BANCO SANTANDER":{$img = "8.gif"; break;}
	   }
	   
	   return $img;
	} 


    function getProduServi($idse,$conecta)
	{
		$res = "";
		$sql4= "select productos from ". TABLA_PRODUCTOS ." where id_serv=".$idse.";";
		$eje4=pg_exec($conecta,$sql4);
		
	
		
		if($eje4)
		{
			$resultadox = pg_result($eje4, 0, 0);
			$res = $resultadox;
		}else{echo "la consulta arrojo un error !!";}
		return $resultadox;
	}	
			
 

?>