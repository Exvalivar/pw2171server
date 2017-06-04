<?php
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
		print json_encode($salidaJSON);
	}
	function datosUsuario(){
		$respuesta=false;
		$conexion=conecta();
		$u=GetSQLValueString($_POST["usuario"],"text");
		$consulta=sprintf("select * from usuarios where usuario=%s limit 1", $u);
		$resultado=mysql_query($consulta);
		$nombre="";
		$clave="";
		$depto=0;
		$vigencia=0;
		if(mysql_num_rows($resultado)>0){
			$respuesta=true;
			if($registro=mysql_fetch_array($resultado)){
				$nombre=$registro["nombre"];
				$clave=$registro["clave"];
				$depto=$registro["departamento"];
				$vigencia=$registro["vigencia"];
			}
		}
		$salidaJSON = array('respuesta' 	=> $respuesta,
		 					'nombre' 		=> $nombre,
		 					'clave' 		=> $clave,
		 					'departamento' 	=> $depto,
		 					'vigencia' 		=> $vigencia);
		print json_encode($salidaJSON);
	}
	function alta(){
		$respuesta=false;
		$conexion=conecta();
		$u=GetSQLValueString($_POST["usuario"],"text");
		$n=GetSQLValueString($_POST["nombre"],"text");
		$c=GetSQLValueString(md5($_POST["clave"]),"text");
		$d=GetSQLValueString($_POST["departamento"],"int");
		$v=GetSQLValueString($_POST["vigencia"],"int");
		//Buscar si existe
		$busca=sprintf("select usuario from usuarios where usuario=%s",$u);
		$resultadoBusca=mysql_query($busca);
		if(mysql_num_rows($resultadoBusca)==0){//si no existe
			$inserta=sprintf("insert into usuarios values(default,%s,%s,%s,%d,%d)",$u,$n,$c,$d,$v);
			mysql_query($inserta);
			if(mysql_affected_rows()>0){
				$respuesta=true;
			}
		}
		$salidaJSON = array('respuesta' => $respuesta);
		print json_encode($salidaJSON);
	}
	function baja(){
		$respuesta=false;
		$conexion=conecta();
		$u=GetSQLValueString($_POST["usuario"],"text");
		$elimina=sprintf("delete from usuarios where usuario=%s",$u);
		mysql_query($elimina);
		if(mysql_affected_rows()>0){
				$respuesta=true;
		}
		$salidaJSON = array('respuesta' => $respuesta);
		print json_encode($salidaJSON);
	}
	function cambio(){
		$respuesta=false;
		$conexion=conecta();
		$u=GetSQLValueString($_POST["usuario"],"text");
		$n=GetSQLValueString($_POST["nombre"],"text");
		$c=GetSQLValueString(md5($_POST["clave"]),"text");
		$d=GetSQLValueString($_POST["departamento"],"int");
		$v=GetSQLValueString($_POST["vigencia"],"int");
		$cambio=sprintf("update usuarios set nombre=%s, clave=%s, departamento=%d, vigencia=%d where usuario=%s",$n,$c,$d,$v,$u);
		mysql_query($cambio);
		if(mysql_affected_rows()>0){
			$respuesta=true;
		}
		$salidaJSON = array('respuesta' => $respuesta);
		print json_encode($salidaJSON);
	}
	function consulta(){
		$respuesta=false;
		$conexion=conecta();
		$consulta=sprintf("select * from usuarios order by usuario");
		$resultado=mysql_query($consulta);
		$renglones="<tr>";
		$renglones.="<th>Usuario</th>";
		$renglones.="<th>Nombre</th>";
		$renglones.="<th>Departamento</th>";
		$renglones.="<th>Vigencia</th>";
		$renglones.="</tr>";
		//$resultado es un dataset
		if(mysql_num_rows($resultado)>0){//hay registros
			while ($registro=mysql_fetch_array($resultado)) {
				$renglones.="<tr>";
				$renglones.="<td>".$registro["usuario"]."</td>";
				$renglones.="<td>".$registro["nombre"]."</td>";
				$renglones.="<td>".$registro["departamento"]."</td>";
				$renglones.="<td>".$registro["vigencia"]."</td>";
				$renglones.="</tr>";
			}
			$respuesta=true;
		}
		else{
			//print("sin datos :C");
			$renglones.="<tr><td colspan=4>Sin Registros</td></tr>";
		}


		$salidaJSON=array('respuesta'=>$respuesta,'renglones'=>$renglones); 
		print json_encode($salidaJSON);
	}
	//menú principal
	$opcion=$_POST["opcion"];
	switch ($opcion) {
		case 'valida':
			valida();
			break;
		case 'datosusuario':
			datosUsuario();
			break;
		case 'alta':
			alta();
			break;
		case 'baja':
			baja();
			break;
		case 'cambio':
			cambio();
			break;
		case 'consulta':
			consulta();
			break;
		default:
			# code...
			break;
	}
?>