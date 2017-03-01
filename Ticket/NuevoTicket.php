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

                <form id="Formulario" method="post" role="form">
                  <? if($accion=="Modifica".$modulo){ ?>
                   <div class="row">
                    <div class="col-md-2">
                     <label>ID</label>
                   </div><div class="col-md-4"> <input type="text" name="Usucve" id="Usucve" disabled tabindex="1" class="form-control" placeholder="Id" value="<?= $clave ?>">
                  </div>
                  </div>  <? }?>
                   <div class="row">
                      <div class="col-md-4">
                     <label>Area</label>
                      <select class="form-control" id='area' name='area'>
                       <?= $consultas->generaCombo("Area",$area,$parametro) ?>
                      </select>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-4">
                     <label>Prioridad</label>
                    <select class="form-control" id='prioridad' name='prioridad'>
                     <?= $consultas->generaCombo("Prioridad",$prioridad,$parametro) ?>
                    </select> </div>
                  </div>

                  <div class="row">
                     <div class="col-md-4">
                    <label>Titulo</label>
                    <input type="text" name="titulo" id="titulo" tabindex="1" class="form-control" placeholder="Titulo" value="<?= $titulo;?>">
                    </div>
                  </div>
                 <div class="row"> 
                 <div class="col-md-11">
                   <label>Subir Imagen</label>
                     <input id="Imagen" name="Imagen[]" class="file" type="file" multiple class="file-loading" data-preview-file-type="text" >
                  </div>
                </div>
                  <div class="row">
                   <div class="col-md-12">
                     <label>Descripcion</label>
                      <textarea class="form-control" rows="5" id="descripcion" ></textarea>
                  </div></div>

                  
                   <? if($accion=="Modifica".$modulo){ ?> 
                    <div class="form-group">
                       <label>Activo</label>
                    <input type="checkbox" aria-label="Activo" name="Activo" id="Activo" tabindex="1" <?= $checked; ?>  >
                  </div>
                  <? } ?>
                  <div class="form-group"></div>
              <? if($Tipousuario=="2"){ ?> 
               <div class="form-group">
                <div class='input-group date'>
                  <label>Fecha de Cierre</label>
                    <input type='text'  id="fecha" readonly="true"/>
                    </div>
                  <div class="form-group">
                     <label>Observaciones para Resolver el Problema</label>
                      <textarea class="form-control" rows="5" id="descripcion" style="width: 574px;"></textarea>
                  </div>   
                </div> <? } ?> 

                  <div class="form-group">
                    <div class="btn-group" role="group" aria-label="Acciones">
                       <? if($accion=="Modifica".$modulo){ ?> 
                        <button type="button" class="btn btn-danger btn-lg" name="Eliminar" id="Eliminar">Eliminar</button>
                         <? } ?> 
                        <button type="button" class="btn btn-success btn-lg" name="register-submit" id="guardar" class="form-control btn btn-register">Guardar</button>
                    </div>
                    
                  </div>

                </form> 
              </div>
            </div>

              <div class="col-md-6"></div>

      




<form id="frmModulos" name="frmModulos" action="" method="POST">
			<input type="hidden" name="sesion" id="sesion" value="<?= $sesion; ?>">
			<input type="hidden" name="modulos" id="modulos" value="<?= $modulo; ?>">
      <input type="hidden" name="accion" id="accion" value="<?= $accion; ?>">
      <input type="hidden" name="submodulo" id="submodulo" value="<?= $submodulo; ?>">
      <input type="hidden" name="clave" id="clave" value="<?= $clave; ?>">
</form>


<script type="text/javascript">
var claveFoto="<?= $row['foto']; ?>";
var NombreFoto="<?= $row['tag']; ?>";

$(function(){

  var Parametros = {   
        "sesion"    : $("#sesion").val(), 
        "modulo"    : $("#modulos").val(),
        "submodulo"  : "Listado"+$("#modulos").val(),
        "accion"    : "Listado"+$("#modulos").val()
    }; 


     $("#guardar").click(function(){
        var datos = {   
        "sesion"    : $("#sesion").val(), 
        "clave"    : $("#Usucve").val(), 
        "nombre"    : $("#nombre").val(),
        "apellidos" : $("#apellidos").val(), 
        "email"     : $("#email").val(), 
        "password"  : $("#password").val(), 
        "tipoUsuario" : $("#tipoUsuario").val(),
        "modulo"      : $("#modulos").val(),
        "activo"      :($("#Activo").is(":checked") ? "1": "0"),
        "accion"      : $("#accion").val()
    }; 
        Guardar(datos,Parametros,"ServerU");
     });

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
   
    $( "#fecha" ).datepicker();

     $('#Imagen').fileinput({
         initialPreview: [
                  <?= $previewImage; ?>
                  ],
  
                 initialPreviewConfig: [
                   <?= $claves_fotos ?>
                ],
                //initialPreviewAsData: true,
                uploadUrl: 'upload.php',
                deleteUrl: 'upload.php',
        language: 'es',
        allowedFileExtensions : ['jpg', 'png','jpeg'],        


        overwriteInitial: false,
        browseLabel: 'Agregar Imagen',
        uploadLabel:'Subir Archivo',
        maxFileSize: 20600,

       
        autoReplace: false,
       // maxFileCount: 3,
        uploadAsync: true,


       // previewFileType:'any'
        //browseOnZoneClick: false,

        showUpload: true,
 
         deleteExtraData: {
                      accion:"Delete",
                      clave:$("#Imagen").attr("value"),
                      nombre:NombreFoto,
                      socio: $("#socio").val()
                 },

                
                uploadExtraData: {
                  accion:"Upload",
                  subaccion:"Socio",
                  socio: $("#clave").val(),
                  clave:$("#Imagen").attr("value")
                }

       

    }).on('fileuploaded', function(e, params) {
              var nombre=params.response["nombre"];
                  NameFile+=nombre;
                  IdFile+=params.response['clave']+",";

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










});

   


    

</script>  
