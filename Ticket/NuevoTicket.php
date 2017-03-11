<?
include_once("../libs/consultas.php");
$sesion = $_POST['sesion'];
$modulo = $_POST['modulo'];
$clave = $_POST['clave'];
$accion = $_POST['accion'];
$submodulo = $_POST['submodulo'];
$consultas = new Consultas();
$funcion="Modifica".$modulo;  
$required="required";
$row['TicEstatus']=1;
//Solo para modificar
//Si no esta activo lo manda al Login.
$Activo = $consultas->verificaSesion($sesion);
//Sacar la clave del usuario logeado
$Usuario = $consultas->DatosUsuarios($sesion);

$cliente = $consultas->DatosCliente($Usuario[0]);


$row['tag']="default_Socio.jpg";

//Traer clave Este Ticket ya existe
if($clave!=""){
    $diabled="disabled";$required="";
    $row=$consultas->Modificacion("DatosTicket",$clave);
    $cliente = $consultas->DatosCliente($row['UsuCve']);
   
    $mensaje='<div class="panel-group" id="accordion">'; $i=0;
    $estatus=($row['TicEstatus']=="0" ? "checked disabled" : "" );

  /* Los Mensajes Escritos */
    $ticket=$consultas->DatosM("DatosTicketDetalle",$clave);
    if($ticket[0]==1)
    while ($fila=mysql_fetch_array($ticket[1])) {
        $in="";  $images='';
          /*Vamos a sacar las imagenes de Cada mensaje*/
          $imagenes=$consultas->DatosM("ImagenesTicket",$fila[0]);
        if($imagenes[0]==1)
           while ($img=mysql_fetch_array($imagenes[1])) {
            $images.='<a  href="../imagenes/tickets/'.$img[1].'" target="_blank">'.$img[1].'</a><br>';  
        }

    $mensaje.='<div class="panel panel-success"><div class="panel-heading"><h4 class="panel-title">
         '.$fila[2].'  '.$fila[6].' '.$fila[7].'</h4></div>
               <div id="collapse1'.$fila[0].'" class="panel-collapse collapse in">
              <div class="panel-body">'.$fila[4].'<br>'.$images.' </div></div></div>';
    
  }

$mensaje.="<div>";

}


?>
 

              
              <h3>Ticket </h3>
              <div class="col-md-12">

                <form id="DatosClientes" action="#"  method="post">
                    <div class="row">
                    <div class="col-md-2">
                     <label>Folio</label>
                   </div><div class="col-md-4">
                    <input type="text" name="clave" id="clave" disabled tabindex="1" class="form-control" placeholder="#Folio" value="<?= $clave ?>">
                    <input type="hidden" name="mailUsuario" id="mailUsuario" value="<?=$Usuario[2]?>"  />
                    <input type="hidden" name="nombreCliente" id="nombreCliente" value="<?=$cliente[1].' '.$cliente[2]?>"  />
                    <input type="hidden" name="mailCliente" id="mailCliente" value="<?=$cliente[11]?>"  />
                    <input type="hidden" name="tipoUsuario" id="tipoUsuario" value="<?=$Usuario[3]?>"  />
                   
                    <input type="hidden" name="nombreUsuario" id="nombreUsuario" value="<?=$Usuario[1]?>"  />
                    
                  </div>
                  </div>  
                  <div class="row">
                      <div class="col-md-4">
                     <label>Nombre </label>
                   <input type="text" name="nombre" id="nombre" value="<?=$row['TicNombre']?>" required class="form-control" placeholder="Nombre Completo" <?=$diabled?> >
                    </div>
                     <div class="col-md-4">
                     <label>Correo </label>
                    <input type="email" name="email" id="email" value="<?=$row['TicMail']?>" required class="form-control" placeholder="Email" <?=$diabled?> >
                    </div>
                  </div>
                  

                  <div class="row">
                     <div class="col-md-10">
                    <label>Asunto</label>
                    <input type="text" name="titulo" required id="titulo" tabindex="1" class="form-control" <?=$diabled?> placeholder="Titulo" value="<?= $row['TicTitulo'];?>">
                    </div>
                  </div>
                   <div class="row">
                      <div class="col-md-4">
                     <label>Departamento</label>
                      <select class="form-control" id='departamento' name='departamento' required <?=$diabled?>>
                       <?= $consultas->generaCombo("CboArea",$row['TicDepartamento'],$parametro) ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                     <label>Servicio</label>
                      <select class="form-control" id='servicio' name='servicio' required <?=$diabled?>>
                        <option value="">(Seleccion)</option>
                       <?= $consultas->generaCombo("CboServisCliente",$row['TicServicio'],array($cliente[0])) ?>
                      </select>
                    </div>

                  </div>

                  
                  <div class="row">
                   <div class="col-md-12">
                     <label>Descripcion</label>
                      <textarea class="form-control" rows="5" id="descripcion" <?=$required?>></textarea>
                  </div></div>
                     <div class="row"> 
                 <div class="col-md-12">
                     <label>Subir Imagen</label>
                        <input id="NombreFile" name="NombreFile" type="hidden" >
                        <input id="Imagen" name="Imagen[]" type="file" multiple class="file">
                        <br>
                  </div>
                </div>
              <?php  if($clave!=""){ ?>
                 <div class="row">
                      <div class="col-md-5">
                     <label>Marcar Como Resuelto</label>
                      <input type="checkbox" id="status" name="status"  <?=$estatus?> >
                    </div>
                  </div> 
               <? } ?>    
                 <? if($row['TicEstatus']=="1"){ ?>
                  <div class="form-group">
                    <div class="btn-group" role="group" aria-label="Acciones">
                        <button type="submit" class="btn btn-success btn-lg" name="register-submit" id="guardar" class="form-control btn btn-register">Guardar</button>
                    </div>
                    
                  </div>
                   <? } ?>   

                </form> 
              </div> 
              <div class="row"><br></div>
           <?=$mensaje?>

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
               var status=($("#status").is(":checked") ? "0" : "1");
              var accion="NuevoTicket";
              var areas=$("#departamento").val().split("|");
              if($("#clave").val()!="") var accion="ModificaTicket";
         
              var campos = { 
              "clave"     : $("#clave").val(),   
              "usucve"    : $("#Usucve").val(), 
              "nombre"    : $("#nombre").val(),
              "emailTicket"   : $("#email").val(), 
              "asunto"    : $("#titulo").val(), 
              "depto"     : areas[0],
              "servicio"  : $("#servicio").val(),
              "mensaje"   : $("#descripcion").val(),
              "correoArea"    : areas[1],
              "mailUscve" : $("#mailUsuario").val(),
              "accion"    : accion,
              "modulo"    : $("#modulos").val(),
              "NameCusto" : $("#nombreCliente").val(),
              "mailCliente" : $("#mailCliente").val(),
              "status"    : status,
              "NameUsuario" : $("#nombreUsuario").val(),
              "tipoUsuario" : $("#tipoUsuario").val(),
              "fotos"     : fotos
            
                }; 
            
            
               Guardar(campos,Parametros,"ServerT.php",$("#modulos").val(),pagina);
          
              }

  }); 







});

   


    

</script>  
