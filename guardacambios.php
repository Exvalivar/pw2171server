<?php
	include("utilerias.php");
	$conexion=conecta();
	$u=GetSQLValueString($_POST["txtUsuario"],"text");
	$n=GetSQLValueString($_POST["txtNombre"],"text");
	$c=GetSQLValueString($_POST["txtClave"],"text");
	$d=GetSQLValueString($_POST["txtDepto"],"int");
	$v=GetSQLValueString($_POST["txtVigencia"],"int");
	$cambio=sprintf("update usuarios set nombre=%s, clave=%s, departamento=%d, vigencia=%d where usuario=%s",$n,$c,$d,$v,$u);
	mysql_query($cambio);
	if(mysql_affected_rows()>0){
		print("Está kawaii (Usuario cambiado)");
	}
	else{
		print("Usuario no cambiado");
	}
?>