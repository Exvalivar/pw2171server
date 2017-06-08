<?php
	require("utilerias.php");
	
	function guardar(){
		$respuesta=false;
		$conexion=conecta();
		$nc=GetSQLValueString($_POST["numcontrol"],"int");
		$n=GetSQLValueString($_POST["nombre"],"text");
		$c=GetSQLValueString($_POST["carrera"],"text");
		$f=GetSQLValueString($_POST["fecha"],"text");
		$h=GetSQLValueString($_POST["hora"],"text");
		$cu=GetSQLValueString($_POST["cubiculo"],"int");
		//si liberado es igual a 1, entonces se puede apartar
		$existe=sprintf("select hora, cubiculo, liberado from estudiantes where hora=%s and cubiculo=%d and liberado=0 limit 1", $h,$cu);
		$resutladoBusca=mysql_query($existe);
		if(mysql_num_rows($resutladoBusca)==0){
			$inserta=sprintf("insert into estudiantes values(default,%d,%s,%s,%s,%s,%d,default)",$nc,$n,$c,$f,$h,$cu);
			mysql_query($inserta);
		
			if(mysql_affected_rows()>0){
				$respuesta=true;
			}
		}
		$salidaJSON= array('respuesta' => $respuesta);
		print json_encode($salidaJSON);
	}
	function liberar(){
		$respuesta=false;
		$conexion=conecta();
		$h=GetSQLValueString($_POST["hora"],"text");
		$cu=GetSQLValueString($_POST["cubiculo"],"int");
		//si liberado es igual a 1, entonces se puede apartar
		$actuliza=sprintf("update estudiantes set liberado=1 where hora=%s and cubiculo=%d and liberado=0", $h, $cu);
		mysql_query($actuliza);
	
		if(mysql_affected_rows()>0){
			$respuesta=true;
		}
		$salidaJSON= array('respuesta' => $respuesta);
		print json_encode($salidaJSON);
	}
	function eliminar(){
		$respuesta=false;
		$conexion=conecta();
		$h=GetSQLValueString($_POST["hora"],"text");
		$cu=GetSQLValueString($_POST["cubiculo"],"int");
		//si liberado es igual a 1, entonces se puede apartar
		$elimina=sprintf("delete from estudiantes where hora=%s and cubiculo=%d", $h, $cu);
		mysql_query($elimina);
	
		if(mysql_affected_rows()>0){
			$respuesta=true;
		}
		$salidaJSON= array('respuesta' => $respuesta);
		print json_encode($salidaJSON);
	}
	function consultar(){
		$respuesta=false;

		$conexion=conecta();

		$consulta=sprintf("select t2.* from (select hora, cubiculo, max(id) as Id from estudiantes group by hora, cubiculo) t1 join estudiantes t2 on t1.id=t2.Id");

		$resultado=mysql_query($consulta);

		$tabla="";

		if(mysql_num_rows($resultado)>0){//hay registros
			while ($registro=mysql_fetch_array($resultado)) {
				$tabla.= $registro["Hora"]." ".$registro["Cubiculo"]." ".$registro["liberado"]." ";
			}
			$respuesta=true;
		}

		$salidaJSON=array('respuesta'=>$respuesta,'tabla'=>$tabla); 
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
		case 'consultar':
			consultar();
			break;
		default:
			# code...
			break;
	}
?>