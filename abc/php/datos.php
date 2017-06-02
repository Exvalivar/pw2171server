<?php
	//http://localhost/pw2171server/abc/php/datos.php?opcion=valida&usuario=pw&clave=null

	require("utilerias.php");
	function valida(){
		$respuesta=false;
		$conexion=conecta();
		$u=GetSQLValueString($_POST["usuario"],"text");
		$c=GetSQLValueString(md5($_POST["clave"]),"text");
		$consulta=sprintf("select usuario,clave from usuarios where usuario=%s and clave=%s limit 1",$u,$c);
		$resultado=mysql_query($consulta);
		if(mysql_num_rows($resultado)>0){
			$respuesta=true;
		}
		$salidaJSON = array('respuesta' => $respuesta);
		print(json_encode($salidaJSON));
	}
	function datosUsuario(){
		$respuesta=false;
		$conexion=conecta();
		$u=GetSQLValueString($_POST["usuario"],"text");
		$consulta=sprintf("select * from usuarios where usuario=%s", $usuario);
	}
	//menú principal
	$opcion=$_POST["opcion"];
	switch ($opcion) {
		case 'valida':
			valida();
			break;
		case 'datosusuario':
			datosUsuario();
		default:
			# code...
			break;
	}
?>