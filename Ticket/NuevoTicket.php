<?
include_once("../libs/consultas.php");
$sesion = $_POST['sesion'];
$modulo = $_POST['modulo'];
$clave = $_POST['clave'];
$accion = $_POST['accion'];
$submodulo = $_POST['submodulo'];
$consultas = new Consultas();
$funcion="Modifica".$modulo;  //Solo para modificar
//Si no esta activo lo manda al Login.
$Activo = $consultas->verificaSesion($sesion);
//Sacar la clave del usuario logeado
$Usuario = $consultas->DatosUsuarios($sesion);

$cliente = $consultas->DatosCliente($Usuario[0]);


$row['tag']="default_Socio.jpg";
if($accion==$funcion){
  //Vamos a traer todos los datos del Usuario  
    $checked="";
    $Usuarios=$consultas->$funcion($clave);
 
    $clave=$Usuarios['UsuCve'];
    $nombre=$Usuarios['UsuNombre'];
    $apellidos=$Usuarios['UsuApellidos'];
    $mail=$Usuarios['UsuMail'];
    $password=$Usuarios['UsuPassword'];
    $activo=$Usuarios['UsuActivo'];
    $seleccionado=$Usuarios['UsuTipo'];
    if($activo=="1") $checked="checked";
}
?>
 

                <h3>Ticket </h3>
              <div class="col-md-12">

                <form id="DatosClientes" action="#"  method="post">
                    <div class="row">
                    <div class="col-md-2">
                     <label>Folio</label>
                   </div><div class="col-md-4"> <input type="text" name="clave" id="clave" disabled tabindex="1" class="form-control" placeholder="#Folio" value="<?= $clave ?>">
                  </div>
                  </div>  
                  <div class="row">
                      <div class="col-md-4">
                     <label>Nombre </label>
                   <input type="text" name="nombre" id="nombre" value="" required class="form-control" placeholder="Nombre Completo" >
                    </div>
                     <div class="col-md-4">
                     <label>Correo </label>
                    <input type="email" name="email" id="email" value="" required class="form-control" placeholder="Email" >
                    </div>
                  </div>
                  

                  <div class="row">
                     <div class="col-md-10">
                    <label>Asunto</label>
                    <input type="text" name="titulo" required id="titulo" tabindex="1" class="form-control" placeholder="Titulo" value="<?= $titulo;?>">
                    </div>
                  </div>
                   <div class="row">
                      <div class="col-md-4">
                     <label>Departamento</label>
                      <select class="form-control" id='departamento' name='departamento' required>
                       <?= $consultas->generaCombo("CboArea",$area,$parametro) ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                     <label>Servicio</label>
                      <select class="form-control" id='servicio' name='servicio' required>
                        <option value="">(Seleccion)</option>
                       <?= $consultas->generaCombo("CboServisCliente","",array($cliente[0])) ?>
                      </select>
                    </div>

                  </div>
                   
              
                  <div class="row">
                   <div class="col-md-12">
                     <label>Descripcion</label>
                      <textarea class="form-control" rows="5" id="descripcion"  required></textarea>
                  </div></div>
                     <div class="row"> 
                 <div class="col-md-12">
                     <label>Subir Imagen</label>
                        <input id="NombreFile" name="NombreFile" type="hidden" >
                        <input id="Imagen" name="Imagen[]" type="file" multiple class="file">
                        <br>
                  </div>
                </div>     

                  <div class="form-group">
                    <div class="btn-group" role="group" aria-label="Acciones">
                       <? if($accion=="Modifica".$modulo){ ?> 
                        <button type="button" class="btn btn-danger btn-lg" name="Eliminar" id="Eliminar">Eliminar</button>
                         <? } ?> 
                        <button type="submit" class="btn btn-success btn-lg" name="register-submit" id="guardar" class="form-control btn btn-register">Guardar</button>
                    </div>
                    
                  </div>

                </form> 
              </div>
            </div>

              <div class="col-md-6"></div>

      




<form id="frmModulos" name="frmModulos" action="Inicio.php" method="POST">
    <input type="hidden" name="sesion" id="sesion" value="<? print $sesion;?>">
    <input type="hidden" name="modulos" id="modulos" value="<? print $modulo;?>">
      <input type="hidden" name="accion" id="accion" value="<? print $accion;?>">
      <input type="hidden" name="submodulo" id="submodulo" value="<? print $submodulo;?>">
      <input type="hidden" name="modcve" id="modcve" value="<? print $modcve;?>">
</form>


<script type="text/javascript">
var claveFoto="<?= $row['foto']; ?>";
var NombreFoto="<?= $row['tag']; ?>";
var NameFile=""; var IdFile="";
var pagina="ListadoTicket.php?param=1";
$(function(){

  var Parametros = {   
        "sesion"    : $("#sesion").val(), 
        "modulo"    : $("#modulos").val(),
        "submodulo"  : "Listado"+$("#modulos").val(),
        "accion"    : "Listado"+$("#modulos").val()
    }; 


     $("#Eliminar").click(function(){
     
       var datos = {   
        "sesion"    : $("#sesion").val(), 
        "clave"    : $("#Usucve").val(), 
        "accion"      :"Eliminar"
      }; 

      if (confirm("Esta Seguro de Eliminar el Registro")){
             Eliminar(datos,Parametros,"ServerU");
      }

     });
   


     $('#Imagen').fileinput({
       showRemove: false,
         initialPreview: [
                  <?= $previewImage; ?>
                  ],
  
                 initialPreviewConfig: [
                   <?= $claves_fotos ?>
                ],
        initialPreviewAsData: true,
        uploadUrl: 'upload.php',
        deleteUrl: 'upload.php',
        language: 'es',
        allowedFileExtensions : ['jpg', 'png','jpeg','gif'],        


        overwriteInitial: false,
        browseLabel: 'Buscar Imagen',
        uploadLabel:'Guardar Archivo',
        maxFileSize: 20600,

       
        autoReplace: false,
       // maxFileCount: 3,
        uploadAsync: true,


       // previewFileType:'any'
        browseOnZoneClick: false,

 
         deleteExtraData: {
                      accion:"Delete",
                      clave:$("#Imagen").attr("value"),
                      nombre:NombreFoto,
                      ticket: $("#socio").val()
                 },

                
                uploadExtraData: {
                  accion:"Upload",
                  subaccion:"Socio",
                  ticket: $("#clave").val(),
                  clave:$("#Imagen").attr("value")
                }

       

    }).on('fileuploaded', function(e, params) {
              var nombre=params.response["nombre"];
                  NameFile+=nombre;
                  IdFile+=params.response['clave']+",";
                  alert(IdFile);
                 $("#NombreFile").val(nombre);
                 //$(".input-group-btn").disabled();
                 $("#Imagen").attr("value",IdFile);
               // console.log('File sorted params', params);

    }).on('fileclear', function(e, params) {
     campos={
                  "accion":"Delete",
                  "nombre":$("#lbImagen").html(),
                  "clave": $("#Imagen").attr("value"),
                  "subaccion": "Socio",
                  "socio" : $("#socio").val()
                  
                };

                 $.post('upload.php',campos,function(datos){
                     var res = eval('(' + datos + ')');
                     if(res.respuesta=="OK"){
                        
                       alert("Se han Eliminado el Archivo.");
                     }else{
                      alert(res.mensaje);
                     }
                    
                  }).fail(function (){
                    alert("error ");

                    //evento.preventDefault();  
                  }).on('filebatchuploadcomplete',function(){
                    alert("Prueba de complete");

                  }).on('filebatchuploadsuccess',function(){
                    alert("prueba de succes");

                  });

        
         });


   $("#DatosClientes").validate({

              submitHandler: function(form) {
                 if($("#Imagen").attr("value")==undefined || $("#Imagen").attr("value")=="") var fotos=""
                else {
                  var fotos=$("#Imagen").attr("value");
                    fotos=fotos+"0";
                }
                
              var accion="NuevoTicket";
              var areas=$("#departamento").val().split("-");
              if($("#clave").val()!="") var accion="ModificaTicket";
         
              var campos = { 
              "clave"     : $("#clave").val(),   
              "usucve"    : $("#Usucve").val(), 
              "nombre"    : $("#nombre").val(),
              "email"     : $("#email").val(), 
              "asunto"    : $("#titulo").val(), 
              "depto"     : areas[0],
              "servicio"  : $("#servicio").val(),
              "mensaje"   : $("#descripcion").val(),
              "correo"    : areas[1],
              "accion"    : accion,
              "modulo"    : $("#modulos").val(),
              "fotos"     : fotos
            
                }; 
            
            
               Guardar(campos,Parametros,"ServerT.php",$("#modulos").val(),pagina);
          
              }

  }); 







});

   


    

</script>  
