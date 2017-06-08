/*const rq = require('electron-require');
const main = rq.remote('./main.js');

const $ = require('jquery');


const ipc = require('electron').ipcRenderer;
const btnPDF = document.getElementById('btnPDF');
btnPDF.addEventListener('click', function(event){
  ipc.send('print-to-pdf');
});*/

var iniciaApp = function(){
	var btnID="";
	var hour="";
	var cubic="";
	//alert("hola Ripardo guapo PD:gracias");
	var cargaApartados=function(){
		var parametros="opcion=consultar";

		var cargaCub=$.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		cargaCub.done(function(data){
			if(data.respuesta){
				alert("carga dsad");
				var registros= data.tabla.split(" ");
				//alert(registros);
				for (var i = 0; i < registros.length-1; i+=3) {
					var hora="";
					if(registros[i].substring(0,1)!=0){
						hora=registros[i].substring(0,2);
					}
					else{
						hora=registros[i].substring(1,2);
					}
					var btn="btnC"+registros[i+1]+hora;

					if(registros[i+2]==1){
						$("#"+btn).css("background","lightBLUE");
					}
					else{
						$("#"+btn).css("background","RED");
					}
				}
			}
			else{
				alert("no carga dsadas");
			}
		});

		cargaCub.fail(function(jqError,textStatus){
			alert("Error asdasdas:"+textStatus)
		});
	}

	var guardar=function(){
		var numcon=$("#txtNumControl").val();
		var nombre=$("#txtNombre").val();
		var carrera=$("#txtCarrera").val();
		var fecha=$("#txtFecha").val();
		var hora=hour;
		var cubiculo=cubic;
		var parametros="opcion=guardar"+
					   "&numcontrol="+numcon+
					   "&nombre="+nombre+
					   "&carrera="+carrera+
					   "&fecha="+fecha+
					   "&hora="+hora+
					   "&cubiculo="+cubiculo;
		
		var altaEstudiante=$.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});

		altaEstudiante.done(function(data){
			if(data.respuesta==true){
				alert("El estudiante a apartado un cubiculo");
				$("#"+btnID).css("background","RED");
			}
			else{
				alert("Cubiculo ocupado ???");
			}
		});

		altaEstudiante.fail(function(jqError,textStatus){
			alert("Error:"+textStatus)
		});
	}
	var liberar=function(){
	    var hora=$("#txtHora").val();
	    var cubiculo=$("#txtCubiculo").val();
	    var parametros="opcion=liberar"+
	             "&hora="+hora+
	             "&cubiculo="+cubiculo;
	    
	    var liberaEstudiante=$.ajax({
	      method:"POST",
	      url:"php/datos.php",
	      data:parametros,
	      dataType:"json"
	    });

	    liberaEstudiante.done(function(data){
	      if(data.respuesta==true){
	        alert("Cubiculo liberado");
	        $("#"+btnID).css("background","lightBLUE");
	      }
	      else{
	        alert("Nada que liberar aqui :v");
	      }
	    });

	    liberaEstudiante.fail(function(jqError,textStatus){
	      alert("Error:"+textStatus)
	    });
  	}
  //----------------------------------------------------------
	var eliminar=function(){
	    var hora=$("#txtHora").val();
	    var cubiculo=$("#txtCubiculo").val();
	    var parametros="opcion=eliminar"+
	             "&hora="+hora+
	             "&cubiculo="+cubiculo;
	    
	    var eliminaEstudiante=$.ajax({
	      method:"POST",
	      url:"php/datos.php",
	      data:parametros,
	      dataType:"json"
	    });

	    eliminaEstudiante.done(function(data){
	      if(data.respuesta==true){
	        alert("Cubiculo eliminado D:");
	        $("#"+btnID).css("background","BLACK");
	      }
	      else{
	        alert("Nada que eliminar aqui :v");
	      }
    });

    eliminaEstudiante.fail(function(jqError,textStatus){
      alert("Error:"+textStatus)
    });
	}
	var mostrar=function(){
		btnID=String(this.id);
		cubic=btnID.substring(4,5);
		hour=btnID.substring(5)+":00";
		$("#txtHora").val(hour);
		$("#txtCubiculo").val(cubic);
		$("#secEstudiantes").show("slow");

		var parametros="opcion=consultarTxt";

		var cargaDatos=$.ajax({
			method:"POST",
			url:"php/datos.php",
			data:parametros,
			dataType:"json"
		});
		cargaDatos.done(function(data){
			if(data.respuesta){
				//alert("carga dsadx2");
				var registros= data.tabla.split(" ");
				//alert(registros);
				for (var i = 0; i < registros.length-1; i+=6) {
					var hora="";
					if(registros[i].substring(0,1)!=0){
						hora=registros[i].substring(0,2);
					}
					else{
						hora=registros[i].substring(1,2);
					}
					var btn="btnC"+registros[i+1]+hora;

					if(btn==btnID){
						$("#txtNumControl").val(registros[i+2]);
						$("#txtNombre").val(registros[i+3]);
						$("#txtCarrera").val(registros[i+4]);
						$("#txtFecha").val(registros[i+5]);
					}
				}
			}
		});
		cargaDatos.fail(function(jqError,textStatus){
			alert("Error asdasdas:"+textStatus);
		});
	}

	/*function getId(id){
			return id;
	}*/

	//$("#btnBajas").on("click",bajas);
	//$("#btnConsultas").on("click",consulta);


	//DECLARACIÓN DE EVENTO DE CAMPOS

	/*$("#txtNumControl").on("keypress",teclaNumControl);
	$("#txtNombre").on("keypress",teclaNombre);
	$("#txtCarrera").on("keypress",teclaCarrera);
	$("#txtFecha1").on("keypress",teclaFecha1);
	$("#txtFecha2").on("keypress",teclaFecha2);
	$("#txtHora").on("keypress",teclaHora);*/
	//$("#txtCubiculo").on("keypress",teclaCubiculo);
	$(document).ready(cargaApartados);
	$("#btnGuardar").on("click",guardar);
	$("#btnLiberar").on("click",liberar);
  	$("#btnEliminar").on("click",eliminar);
	//ciclo para agregarle escuchadores a los botones
	for (var i = 1; i <= 10; i++) {
		for (var j = 7; j <= 17; j++) {
			var btn="#btnC"+i+j;
			$(btn).on("click",mostrar);
		}
	}
}
$(document).ready(iniciaApp);
