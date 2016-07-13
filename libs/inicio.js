$(function() 
{
   
    $("#cerrar").click(function(){
     
      var datos = {   
        "sesion"    : $("#sesion").val(), 
        "accion"    : "cerrar",
        "clave"     :  0
    };
  
        $.post("Server.php", datos, function(data) { 
         var res = eval('(' + data + ')');
          if(res.resul=="OK"){
            window.location="index.php";
          }
        }); 

    });



});


function Guardar(datos,Parametros,server){

  $.post("../Usuarios/"+server+".php", datos, function(data) { 
         var res = eval('(' + data + ')');
         if(res.respuesta=="OK"){
          alert("Los cambios se han guardado Correctamente");
          //Tiene mandarlo al listado o pagina de inicio
         $( "#modulo" ).load('/tickets/Usuarios/Listado'+$("#modulos").val()+'.php',Parametros);

         }

        }); 


}



function Eliminar(datos,Parametros,server){

  $.post("../Usuarios/"+server+".php", datos, function(data) { 
         var res = eval('(' + data + ')');
         if(res.respuesta=="OK"){
          alert("Se ha eliminado el registrado");
          //Tiene mandarlo al listado o pagina de inicio
         $( "#modulo" ).load('/tickets/Usuarios/Listado'+$("#modulos").val()+'.php',Parametros);

         }

        }); 


}

function menu_Horizontales(li){

  var datos = {   
        "sesion"    : $("#sesion").val(), 
        "accion"    : "menu_horizontales",
        "clave"     :  $("#"+li.id).attr("modcve") 
    };
  
    $.post("Server.php", datos, function(data) { 
      var data = eval('(' + data + ')');
     $("#menu_horizontal").html(data.menu);
    }); 



}

function modulos(obj){
   var modulo=$("#"+obj.id).attr("modulo");
   var accion=$("#"+obj.id).attr("accion");
   var submodulo=obj.id;
   var parametros={
          'sesion':$("#sesion").val(),
          'usucve':$("#Usucve").val(),
          'submodulo':submodulo,
          'modulo':modulo,
          'accion':submodulo
 
   };

   $("#modulo").load('/tickets/'+modulo+'/'+submodulo+'.php',parametros, function(response, status, xhr) {
              if (status == "error") {
                var msg = "Lo siento no encontre lo que buscabas: ";
                $("#modulo").html(msg + xhr.status + " " + xhr.statusText);
              }
         });    
}


function CargarFiltro(page){

      var datos = {   
        "sesion"    : $("#sesion").val(), 
        "NumPagina"    : page,
        "modulo"      : $("#modulos").val(),
        "accion"      : $("#submodulo").val(),
        "submodulo"   : $("#submodulo").val()
       };
  
   $.post("Server.php", datos, function(data) { 
         var res = eval('(' + data + ')');
           $("#bodyGrid"+$("#modulos").val()).html(res.datos).fadeIn('slow');
           $("#paginador"+$("#modulos").val()).html(res.paginador).fadeIn('slow');
          //location.reload();
          //Tiene mandarlo al listado o pagina de inicio

        }); 
}


function Editar(obj){

var modulo=$("#"+obj.id).attr("modulo");
var accion="Modifica"+modulo;
var submodulo="Nuevo"+modulo;  //Para editar la Pagina todas las paginas empiezen con Nuevo y modulo
   
   var parametros={
          'sesion':$("#sesion").val(),
          'clave':$("#"+obj.id).attr("clave"),
          'submodulo':submodulo,
          'modulo':modulo,
          'accion':accion
 
   };

   $("#modulo").load('/tickets/'+modulo+'/'+submodulo+'.php',parametros, function(response, status, xhr) {
              if (status == "error") {
                var msg = "Lo siento no encontre lo que buscabas: ";
                $("#modulo").html(msg + xhr.status + " " + xhr.statusText);
              }
         });    

}

