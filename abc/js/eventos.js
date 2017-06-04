var iniciaApp = function(){
	var entrar=function(){
		var usuario=$("#txtUsuario").val();
		var clave  =$("#txtClave").val();
		var parametros="opcion=valida"+
						"&usuario="+usuario+
						"&clave="+clave+
						"&id="+Math.random();
		var validaEntrada = $.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		validaEntrada.done(function(data){
			if(data.respuesta==true){
				$("#datosUsuario").hide("slow");
				$("nav").show("slow");
				$("#secUsuarios").show("slow");
			}
		});
		validaEntrada.fail(function(jqError,textStatus){
			alert("Solicitud fallida: "+textStatus);
		});
	}
	var teclaUsuario=function(tecla){
		if(tecla.which==13){
			$("#txtClave").focus();
		}
	}
	var teclaClave=function(tecla){
		if(tecla.which==13){
			entrar();
		}
	}
	var datosUsuario=function(){
		var usuario=$("#txtNomUsuario").val();
		var parametros="opcion=datosusuario"+
						"&usuario="+usuario+
						"&id="+Math.random();
		var du=$.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		du.done(function(data){
			if(data.respuesta==true){
				$("#txtNomNombre").val(data.nombre);
				$("#txtNomClave").val(data.clave);
				$("#txtNomDepto").val(data.departamento);
				$("#txtNomVigencia").val(data.vigencia);
			}
			else{
				$("#txtNomNombre").focus();
			}
		});
		du.fail(function(jqError,textStatus){
			alert("corre por tu bida: "+textStatus);
		});
	}
	var teclaNomUsuario=function(tecla){

		if(tecla.which==13){
			//alert("hola");
			datosUsuario();
		}
	}
	var altas=function(){
		var usuario=$("#txtNomUsuario").val();
		var nombre=$("#txtNomNombre").val();
		var clave=$("#txtNomClave").val();
		var depto=$("#txtNomDepto").val();
		var vigencia=$("#txtNomVigencia").val();
		var parametros="opcion=alta"+
						"&usuario="+usuario+
						"&nombre="+nombre+
						"&clave="+clave+
						"&departamento="+depto+
						"&vigencia="+vigencia+
						"&id="+Math.random();
		var altaUsuario=$.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		altaUsuario.done(function(data){
			if (data.respuesta==true){
				alert("Usuario dado de alta");
				$("#txtNomNombre").val("");
				$("#txtNomClave").val("");
				$("#txtNomDepto").val("");
				$("#txtNomVigencia").val("");
			}
			else{
				alert("usuario existente  no se pudo registrar");
			}
		});
		altaUsuario.fail(function(jqError,textStatus){
			alert("ya valistes krnal: "+textStatus);
		});
	}
	var bajas = function(){
		var usuario=$("#txtNomUsuario").val();
		var parametros="opcion=baja"+
						"&usuario="+usuario+
						"&id="+Math.random();
		var bajaUsuario=$.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		bajaUsuario.done(function(data){
			if (data.respuesta==true){
				alert("Usuario dado de baja");
			}
			else{
				alert("vales verga diego");
			}
		});
		bajaUsuario.fail(function(jqError,textStatus){
			alert("ya valistes krnal: "+textStatus);
		});
	}
	var cambios = function(){
		var usuario=$("#txtNomUsuario").val();
		var nombre=$("#txtNomNombre").val();
		var clave=$("#txtNomClave").val();
		var depto=$("#txtNomDepto").val();
		var vigencia=$("#txtNomVigencia").val();
		var parametros="opcion=cambio"+
						"&usuario="+usuario+
						"&nombre="+nombre+
						"&clave="+clave+
						"&departamento="+depto+
						"&vigencia="+vigencia+
						"&id="+Math.random();
		var cambioUsuario=$.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		cambioUsuario.done(function(data){
			if (data.respuesta==true){
				alert("Cambio realizado exitosamente");
			}
			else{
				alert("hubo pedos mentales");
			}
		});
		cambioUsuario.fail(function(jqError,textStatus){
			alert("cambiate de carrera uwu: "+textStatus);
		});
	}
	var consultas = function(){
		var parametros="opcion=consulta"+
						"&id="+Math.random();
		var consultaUsuarios=$.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		//alert("la wea fome");
		consultaUsuarios.done(function(data){
			if (data.respuesta==true){
				
				$("#tblConsultas").html(data.renglones);
				$("#tblConsultas").show("slow");
				$("#secUsuarios").hide("slow");
			}
			else{
				alert("no hay anda wey");
			}
		});
		consultaUsuarios.fail(function(jqError,textStatus){
			alert("we hay un error we: "+textStatus);
		});
	}
	var inicio=function(){
		$("#secConsultas").hide();
		$("#secUsuarios").show("slow");
		$("#txtNomUsuario").focus();
	}
	//sección de declaración de eventows
	$("#btnEntrar").on("click",entrar);
	$("#txtUsuario").on("keypress",teclaUsuario);
	$("#txtClave").on("keypress",teclaClave)
	$("#txtNomUsuario").on("keypress",teclaNomUsuario);
	$("#btnAltas").on("click",altas);
	$("#btnBajas").on("click",bajas);
	$("#btnCambios").on("click",cambios);
	$("#btnConsultas").on("click",consultas);
	$("#btnInicio").on("click",inicio);
}
$(document).ready(iniciaApp);