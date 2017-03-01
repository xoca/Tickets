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

if($_POST['clave']!=""){ 
    //Vamos a traer todos los datos del Usuario  
    $checked="NADA";
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

<link href="../boostrap/css/signin.css" rel="stylesheet">
        <div class="row">
              <div class="col-md-6 col-md-offset-3">

                <h3>Usuarios </h3>
                <form id="Formulario" data-toggle="validator" action="/inicio/nuevo" method="post" role="form">
                  <? if($accion=="Modifica".$modulo){ ?>
                   <div class="form-group">
                     <span>ID</span>
                    <input type="text" name="Usucve" id="Usucve" disabled tabindex="1" class="form-control" placeholder="Id" value="<?= $clave ?>">
                  </div>  <? }?>

                  <div class="form-group">
                    <span>Nombre</span>
                    <input type="text" name="nombre" id="nombre" tabindex="1" class="form-control" placeholder="Nombre" value="<?= $nombre;?>">
                  </div>
                   <div class="form-group">
                     <span>Apellidos</span>
                    <input type="text" name="apellidos" id="apellidos" tabindex="1" class="form-control" placeholder="Apellidos" value="<?= $apellidos; ?>">
                  </div>
                  <div class="form-group">
                    <span>Correo</span>
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo Electronico" value="<?= $mail;?>">
                  </div>
                  <div class="form-group">
                     <span>Contraseña</span>
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?= $password ?>">
                  </div>
                
                  <div class="form-group">
                     <span>Tipo Usuario</span>
                    <select class="form-control" id='tipoUsuario' name='tipoUsuario'>
                     <?= $consultas->generaCombo("tipoUsuario",$seleccionado,$parametro) ?>
                    </select>
                  </div>
                   <? if($accion=="Modifica".$modulo){ ?> 
                    <div class="form-group">
                       <span>Activo</span>
                    <input type="checkbox" aria-label="Activo" name="Activo" id="Activo" tabindex="1" <?= $checked; ?>  >
                  </div>
                  <? } ?>
                  
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
             

<form id="frmModulos" name="frmModulos" action="Inicio.php" method="POST">
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
   
   

});


</script>  

