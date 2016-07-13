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
    <head>
        <meta charset="UTF-8"/>
       
       <link href="../boostrap/css/signin.css" rel="stylesheet">
       </head>

        <div class="row">
              <div class="col-md-6 col-md-offset-3">

                <h3>Ticket </h3>
                <form id="Formulario" method="post" role="form">
                  <? if($accion=="Modifica".$modulo){ ?>
                   <div class="form-group">
                     <span>ID</span>
                    <input type="text" name="Usucve" id="Usucve" disabled tabindex="1" class="form-control" placeholder="Id" value="<?= $clave ?>">
                  </div>  <? }?>
                   <div class="form-group">
                     <span>Area</span>
                    <select class="form-control" id='area' name='area'>
                     <?= $consultas->generaCombo("Area",$seleccionado,$parametro) ?>
                    </select>
                  </div>
                   <div class="form-group">
                     <span>Prioridad</span>
                    <select class="form-control" id='prioridad' name='prioridad'>
                     <?= $consultas->generaCombo("Prioridad",$seleccionado,$parametro) ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <span>Titulo</span>
                    <input type="text" name="titulo" id="titulo" tabindex="1" class="form-control" placeholder="Titulo" value="<?= $titulo;?>">
                  </div>
                   
                   <div class="form-group">
                     <span>Descripcion</span>
                      <textarea class="form-control" rows="5" id="descripcion"></textarea>
                  </div>

                 <div class="form-group">
                   <span>Subir Imagen</span>
                    <input id="Imagen" class="file" type="file"  data-min-file-count="1">
                  </div>
                  
                   <? if($accion=="Modifica".$modulo){ ?> 
                    <div class="form-group">
                       <span>Activo</span>
                    <input type="checkbox" aria-label="Activo" name="Activo" id="Activo" tabindex="1" <?= $checked; ?>  >
                  </div>
                  <? } ?>
                  <div class="form-group"></div>

               <div class="form-group">
                <div class='input-group date'>
                  <span>Fecha de Cierre</span>
                    <input type='text' class="form-control" id="fecha" />
                    </div>
                </div>

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
             

<form id="frmModulos" name="frmModulos" action="" method="POST">
			<input type="hidden" name="sesion" id="sesion" value="<?= $sesion; ?>">
			<input type="hidden" name="modulos" id="modulos" value="<?= $modulo; ?>">
      <input type="hidden" name="accion" id="accion" value="<?= $accion; ?>">
      <input type="hidden" name="submodulo" id="submodulo" value="<?= $submodulo; ?>">
      <input type="hidden" name="clave" id="clave" value="<?= $clave; ?>">
</form>


<script type="text/javascript">

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
        language: 'es',
        overwriteInitial: true,
        uploadUrl: 'otro',
        showClose: false,
        showCaption: false,
        showUpload: true,
        showCaption: false,
        maxFileSize: 1500,
        browseLabel: 'subir Imagen',
        allowedFileExtensions : ['jpg','png'],
        showPreview : true,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });

});

   


    

</script>  
