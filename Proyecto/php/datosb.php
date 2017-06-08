<?php
	//http://localhost/pw2171server/abc/php/datos.php?opcion=valida&usuario=pw&clave=null
	require("utilerias.php");
	
	function guardar(){
		$respuesta=false;
		$conexion=conecta();
		$nc=GetSQLValueString($_POST["numcontrol"],"int");
		$n=GetSQLValueString($_POST["nombre"],"text");
		$c=GetSQLValueString($_POST["carrera"],"text");
		$f1=GetSQLValueString($_POST["fecha1"],"text");
		$f2=GetSQLValueString($_POST["fecha2"],"text");
		$h=GetSQLValueString($_POST["hora"],"text");
		$cu=GetSQLValueString($_POST["cubiculo"],"int");
		//si liberado es igual a 1, entonces se puede apartar
		$existe=sprintf("select hora, cubiculo, liberado from estudiantes where hora=%s and cubiculo=%d and liberado=0 limit 1", $h,$cu);
		$resutladoBusca=mysql_query($existe);
		if(mysql_num_rows($resutladoBusca)==0){
			$inserta=sprintf("insert into estudiantes values(default,%d,%s,%s,%s,%s,%s,%d,default)",$nc,$n,$c,$f1,$f2,$h,$cu);
			mysql_query($inserta);
		
			if(mysql_affected_rows()>0){
				$respuesta=true;
			}
		}
		$salidaJSON= array('respuesta' => $respuesta);
		print json_encode($salidaJSON);
	}

	//menú principal
	$opcion=$_POST["opcion"];
	switch ($opcion) {
		case 'guardar':
			guardar();
			break;
		case 'liberar':
			liberar();
			break;
		case 'eliminar':
			eliminar();
			break;
		default:
			# code...
			break;
	}
?>