<?php
include("utilerias.php");
	function validausuario($usuario,$clave){
					//			computadora,usuario,contra
		// $conexion=mysql_connect("localhost","root","");
		// mysql_select_db("pw2171");
		$conexion=conecta();
		$usuario=GetSQLValueString($usuario,"text");
		$clave=GetSQLValueString(md5($clave),"text");
		$consulta=sprintf("select usuario, clave from usuarios where usuario=%s and clave=%s",$usuario,$clave);
		//$consulta="select usuario,clave from usuarios where usuario=".$usuario." and clave=".$clave." limit 1";
		$resultado=mysql_query($consulta);
		if(mysql_num_rows($resultado)>0){
			// print("Bienvenido ".$usuario."-sama");
			print("<a href='altas.php'>Altas</a> <br>");
			print("<a href='bajas.php'>Bajas</a> <br>");
			//print("<a href='cambios.php'>Cambios</a> <br>");
			print("<a href='consultas.php'>Consultas</a> <br>");
		}
		else{
			print("Usuario y/o contraseña incorrectos");
		}
	}
	if(isset($_POST["txtUsuario"])&&isset($_POST["txtClave"])){
		$usuario=$_POST["txtUsuario"];
		$clave=$_POST["txtClave"];
		validausuario($usuario,$clave);
		//print($usuario);
		//print($clave);
	}
	else{
		print("<a href='acceso.html'> Valida tus datos </a>");
	}
?>