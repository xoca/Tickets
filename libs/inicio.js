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


function Guardar(datos,Parametros,server,modulo,pagina){

  $.post("../"+modulo+"/"+server+"", datos, function(data) { 
         var res = eval('(' + data + ')');
         if(res.respuesta=="OK"){
          alert("Los cambios se han guardado Correctamente");
          //Tiene mandarlo al listado o pagina de inicio
         $( "#modulo" ).load('/tickets/'+modulo+'/'+pagina,Parametros);

         }else {
          alert("Ha ocurrido un error al intentar guardar los datos "+res.mensaje)
         }

    }).fail(function() {
    
      alert( "Ha ocurrido un error al intentar guardar los datos." );
  
   });


}



function Eliminar(datos,Parametros,server,pagina){

  $.post(""+server+".php", datos, function(data) { 
         var res = eval('(' + data + ')');
         if(res.respuesta=="OK"){
          alert("Se ha eliminado el registrado");
          //Tiene mandarlo al listado o pagina de inicio
          $( "#modulo" ).load('/tickets/'+Parametros['modulo']+'/'+pagina+'.php',Parametros);

         }else
         alert("Ha ocurrido el siguiente error "+res.mensaje)

        }); 


}

function menu_Horizontales(li){

  var datos = {   
        "sesion"       : $("#sesion").val(), 
        "accion"       : "menu_horizontales",
        "clavemodulo"  :  $("#"+li.id).attr("modcve"),
        'clave'        : $("#"+li.id).attr("clave") 
    };
  
    $.post("Server.php", datos, function(data) { 
      var data = eval('(' + data + ')');
     $("#menu_horizontal").html(data.menu);
    }); 



}

function modulos(obj){
   menu_Horizontales(obj);
   

   var modulo=$("#"+obj.id).attr("modulo");
   var submodulo=$("#"+obj.id).attr("submodulo");
   var url=$("#"+obj.id).attr("url");
   var modcve=$("#"+obj.id).attr("modcve");
   
   var parametros={
          'sesion':$("#sesion").val(),
          'usucve':$("#Usucve").val(),
          'modulo':modulo,
          'modcve':modcve,
          'submodulo':submodulo,
          'clave' : $("#"+obj.id).attr("clave")
 
   };



   $("#modulo").load('/tickets/'+modulo+'/'+url+'',parametros, function(response, status, xhr) {
              if (status == "error") {
                var msg = "Lo siento no encontre lo que buscabas: ";
                $("#modulo").html(msg + xhr.status + " " + xhr.statusText);
              }
         });    
}


function CargarFiltro(page,qry,parametros){

      var datos = {   
        "sesion"      : $("#sesion").val(), 
        "NumPagina"   : page,
        "modulo"      : $("#modulos").val(),
        "accion"      : "Paginador",
        "submodulo"   : $("#submodulo").val(),
        "parametros"  : parametros,
         "qry"        : qry
       };
  
   $.post("Server.php", datos, function(data) { 
         var res = eval('(' + data + ')');
           $("#bodyGrid").html(res.datos).fadeIn('slow');
           $("#paginador").html(res.paginador).fadeIn('slow');
          //location.reload();
          //Tiene mandarlo al listado o pagina de inicio

      }); 
}


function Editar(obj){
     
var modulo=$("#modulos").val();
var pagina=$("#paginared").val();
   var parametros={
          'sesion'    : $("#sesion").val(),
          'clave'     : $("#"+obj.id).attr("clave"),
          'submodulo' : $("#submodulo").val(),
          'modcve'    : $("#modcve").val(),
          'modulo'    : modulo

   };

   $("#modulo").load('/tickets/'+modulo+'/'+pagina+'.php',parametros, function(response, status, xhr) {
              if (status == "error") {
                var msg = "Lo siento no encontre lo que buscabas: ";
                $("#modulo").html(msg + xhr.status + " " + xhr.statusText);
              }
         });    





}

function cambiarRol(parametros,server){

  $.post(""+server+"",parametros,function(datos,status,xhr){
       var res = eval('(' + datos + ')');
        if(res.tabla!="") $("#tblPermisos").html(res.tabla);

  });

}


function Servicios(){
        var datos=[];
      var servicios={};

      $(".ServiciosDiv").each(function(){
        var position=3;
        //Este Id viene de los subservicios agregados dinamicamente
        if($(this)[0].id.indexOf("ServicioSub")==0){ 
          var checked=$(this).children()[0].childNodes[1];
           position=0;
       }else   var checked=$(this).children()[0].childNodes[3];
          
          //Los que este checked sacamos las demas informacion de ese renglon
          if(checked.checked){
             servicios={
                    'id_servicio'  : checked.value,
                    'url'        : $(this).children()[1].childNodes[position].value,
                    'Finicio'      : $(this).children()[2].childNodes[position].value,
                    'Ffin'         : $(this).children()[3].childNodes[position].value,
                    'Frenovacion'  : $(this).children()[4].childNodes[position].value
                   
               };
             
               datos.push(servicios);

          }
          

         });

      return datos;

}
