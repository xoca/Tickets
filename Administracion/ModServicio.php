<?
include_once("../libs/consultas.php");
$sesion = $_POST['sesion'];
$modulo = $_POST['modulo'];
$submodulo = $_POST['submodulo'];
$modcve = $_POST['modcve'];
$clave = $_POST['clave'];
$consultas = new Consultas();
$Activo = $consultas->verificaSesion($sesion);


	if(isset($_POST['clave'])){
		$row=$consultas->Modificacion("DatosServicios",$clave);
		
	} 

?>

       	<div class="row">
		<div class="col-md-12 text-center">
			<div class="panel panel-success" style="margin-top:30px">
				<div class="panel-heading">SERVICIOS</div>

			</div>
		</div>

    </div>
    <div class="row">
   <div class="col-md-4">
            <a id="ModServicios"  url="servicios.php" submodulo="<?=$submodulo;?>" modcve="<?=$modcve;?>" modulo="<?=$modulo;?>" onclick="modulos(this);" href="#">Regresar</a>
        </div>
    </div>
    
    
		<div id="NuevoServicios" class="row">
			 <div class="col-md-12">
			 <form id="DatosServicios" action="#"  method="post">
			 	<div class="row">
			 		      <div class="col-md-2">
				          <label>clave</label>   
				            	</div> 
				          <div class="col-md-2">
				           <input type="text" id="clave" name="clave" placeholder="ID" value="<?=$row['id']?>" class="form-control" disabled/>
				         
				          </div>

			 	</div>
			 			<div class="row">
				          <div class="col-md-2">
				          <label>Nombre</label>   
				            </div>
				          <div class="col-md-4">
     					<input type="text" id="nombre" name="nombre" value="<?=$row['cat_nombre']?>" placeholder="Nombre" class="form-control" required/>
				          </div>
				         
				      </div>
				       <div class="row">
				       		<?php	if(isset($_POST['clave'])){ ?>
					   	<div class="col-md-2">
					    	<label name="Nombre"  class="control-label">Estatus</label>
					 		</div>
							<div class="col-md-1">    <input type="Checkbox"   name="status" id="status" type='text' class="form" value="" <?php echo ($row['cat_status']=="1" ? "checked" : "" ) ?>/>					  	
							</div>
				
					<?php } ?>
   					  	
   					  </div>	 
				      <div class="row">
				      	<br>
				      	<div class="col-md-4">
						 <input type="submit" class="btn btn-success btn" value="Guardar" id="btnClienteNuevo">
						</div>
						<?php	if(isset($_POST['clave'])){ ?>
						<div class="col-md-3">
				        <button type="button" class="btn btn-danger btn" name="Eliminar" id="Eliminar">Eliminar</button>
                      	</div>  <? } ?>
				      </div>
				      <div class="row">
				      	<br>
					</div>
		     </form>  
		</div>
	</div>

             

<form id="frmModulos" name="frmModulos" action="Inicio.php" method="POST">
	  <input type="hidden" name="sesion" id="sesion" value="<? print $sesion;?>">
	  <input type="hidden" name="modulos" id="modulos" value="<? print $modulo;?>">
      <input type="hidden" name="accion" id="accion" value="<? print $accion;?>">
      <input type="hidden" name="submodulo" id="submodulo" value="<? print $submodulo;?>">
      <input type="hidden" name="modcve" id="modcve" value="<? print $modcve;?>">
</form>



<script type="text/javascript">
var pagina="servicios.php";
var status=1;
  var Parametros = {   
        "sesion"    : $("#sesion").val(), 
        "modulo"    : $("#modulos").val(),
        "submodulo" : $("#submodulo").val(),
        "modcve"	: $("#modcve").val()
    }; 


     $(function(){

	        
	        $("#DatosServicios").validate({

	            submitHandler: function(form) {
	            	
	            		 if($("#clave").val()==""){
						    var accion="NuevoServicios";

						  }else{
						     var accion="ModificaServicios";
						      status=($("#status").is(":checked") ? "1" : "0");
						 }


					  campos={
					  		"clave"		 : $("#clave").val(),
					        "nombre"     : $("#nombre").val(),
					        'status'	 : status,
					        "sesion"    : $("#sesion").val(), 
					        "modulo"    : $("#modulos").val(),
					        "submodulo" : $("#submodulo").val(),
					        "modcve"	: $("#modcve").val(),
					        "usucve"	: $("#Usucve").val(),
					        'accion'     : accion
					      };
	          
	          
	             Guardar(campos,Parametros,"ServerAd.php",$("#modulos").val(),pagina);
	        
	            }

	         }); 




	});


 $("#Eliminar").click(function(){
     var tablas=[];
    var condiciones={
     	"tabla":"servicios",
     	"condicion": " and id="+$("#clave").val()+" "
     	
     	};
     	tablas.push(condiciones);
      
       var datos = {   
        "sesion"   : $("#sesion").val(), 
        "clave"    : $("#clave").val(), 
        "usucve"   : $("#Usucve").val(),
        "accion"   : "Eliminar",
        "tablas"   : tablas
      }; 

      if (confirm("Esta Seguro de Eliminar el Registro")){
             Eliminar(datos,Parametros,"Server",pagina);
      }

       
      

     });

</script>    
