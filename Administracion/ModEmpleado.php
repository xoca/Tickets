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
	$empleado=$consultas->Modificacion("DatosEmpleados",$clave);
	
} 


?>

       	<div class="row">
		<div class="col-md-12 text-center">
			<div class="panel panel-success" style="margin-top:30px">
				<div class="panel-heading">EDITAR EMPLEADOS </div>

			</div>
		</div>

    </div>
    <div class="row">
   <div class="col-md-4">
            <a id="ModEmpleados"  url="empleados.php" submodulo="<?=$submodulo;?>" modcve="<?=$modcve;?>" modulo="<?=$modulo;?>" onclick="modulos(this);" href="#">Regresar</a>
        </div>
    </div>
    
    
		<div id="NuevoCliente" class="row">
			 <div class="col-md-11 col-md-offset-2">
			 <form id="DatosClientes" action="#"  method="post">
			 	<div class="row">
			 		      <div class="col-md-2">
				          <label>clave</label>   
				             <input type="text" id="clave" name="clave" placeholder="ID" value="<?=$empleado['emp_id']?>" class="form-control" disabled/>
				         	  <input type="hidden" id="id_usuario" name="id_usuario" placeholder="ID" value="<?=$empleado['id_usuario']?>" class="form-control" disabled/>
				         
				          </div>

			 	</div>
			 			<div class="row">
				          <div class="col-md-4">
				          <label>Nombre Empleado</label>   
				             <input type="text" id="nombre" name="nombre" value="<?=$empleado['emp_nombre']?>" placeholder="Nombre" class="form-control" required/>
				          </div>
				           <div class="col-md-4">
				           <label>Apellidos</label>   
				             <input type="text" id="apellidos" name="apellidos" value="<?=$empleado['emp_apellidos']?>" placeholder="Apellidos" class="form-control" required/>
				          </div>
				      </div>

				     <div class="row">
				     	 <div class="col-md-4">
				           <label>Direccion</label>    
				             <input type="text" id="direccion" name="direccion" value="<?=$empleado['emp_domicilio']?>" placeholder="direccion" class="form-control" />
				          </div>
				           <div class="col-md-4">
				           <label>C.P</label>    
				             <input type="text" id="cp" name="cp" placeholder="Codigo Postal" value="<?=$empleado['emp_cp']?>" class="form-control number" />
				          </div>

				     </div>
				      	<div class="row">
				      		 <div class="col-md-4">
				           <label>Ciudad</label>    
				             <input type="text" id="ciudad" name="ciudad" value="<?=$empleado['emp_ciudad']?>" placeholder="Ciudad / Municipio/Delegacion" class="form-control" />
				          </div>
				  		
				      		 <div class="col-md-4">
				           <label>Estado</label>    
				             <input type="text" id="estado" name="estado" value="<?=$empleado['emp_estado']?>" placeholder="Estado" class="form-control" />
				          </div>
				  		</div>

				      <div class="row">
				      		
				  		</div><div class="row">
				      		 <div class="col-md-4">
				           <label>Telefono</label>    
				             <input type="text" id="telefono" name="telefono" value="<?=$empleado['telefono']?>" placeholder="Telefono" class="form-control" />
				          </div>
				      		 <div class="col-md-4">
				           <label>Celular</label>    
				             <input type="text" id="celular" name="celular" placeholder="Celular" value="<?=$empleado['celular']?>" class="form-control" required/>
				          </div>
				  		
				  		</div>
		
				         <div class="row">
				          	
				           <div class="col-md-4">
				          <label>Departamento</label>  
				          	<select id="cboarea" name="cboarea" class="form-control">
							<?= $consultas->generaCombo("Area",$empleado['id_area'],''); ?>	
							</select> 
				            
				           </div>
				          <div class="col-md-4">
				          	  <label>Puesto</label>
				          	<select id="cbopuesto" name="cbopuesto" class="form-control">
							<?= $consultas->generaCombo("cboPuestos",$empleado['id_puesto'],''); ?>	
							</select>

				          </div>
				      </div>
				      <div class="row">
				          	
				           <div class="col-md-4">
				          <label>Correo</label>   
				             <input type="email" id="correo" name="correo" placeholder="Correo" value="<?=$empleado['emp_correo']?>" class="form-control" required/>
				          </div>
				         

				      </div>
				        <div class="row">
   					  	
					   	
   					
   					  		<?php	if(isset($_POST['clave'])){ ?>
					   	<div class="col-md-2">
					    	<label name="Nombre"  class="control-label">Estatus</label>
					 	    <input type="Checkbox"   name="status" id="status" type='text' class="form" value="" <?php echo ($empleado['emp_status']=="1" ? "checked" : "" ) ?>/>					  	
						</div>
				
							<?php } ?>
   					  	
   					  </div>	
   					

				      <div class="row"><br></div>
				      <div class="row col-md-11">
				         <div class="panel panel-success">
						      <div class="panel-heading">Datos Para el inicio de Sesion</div>
						      <div class="panel-body">
						      	<div class="row">
						      		<p>Estos datos son muy importantes debido que el empleado podra entrar al sistema con su correo electronico y contraseña</p>
						      	</div>
						           <div class="row">
					    <div class="col-md-4">
				          <label>Nombre Usuario</label>   
				             <input type="text" id="nickname" name="nickname" value="<?=$empleado['UsuNombre']?>" placeholder="Nombre de Usuario" class="form-control" required/>
				          </div>
				          	
				           <div class="col-md-4">
				          <label>Correo</label>   
				             <input type="email" id="mail" name="mail" value="<?=$empleado['UsuMail']?>" placeholder="Correo" class="form-control" required/>
				          </div>
				              <div class="col-md-4">
				          <label>Contraseña</label>   
				             <input type="pass" id="pass" name="pass" value="<?=$empleado['UsuPassword']?>" placeholder="Contraseña" class="form-control" required/>
				          </div>
				      </div>
				      <div class="row">
				      	 <div class="col-md-4">
				          	  <label>Tipo de Usuario</label>
				          	<select id="cboTipo" name="cboTipo" class="form-control">
							<?= $consultas->generaCombo("cboTipoUsuario",$empleado['UsuTipo'],''); ?>	
							</select>

				          </div>
				      </div>

						      </div>
   						 </div>
   					  </div>


				      <div class="row">
				      	<div class="col-md-4">
						 <input type="submit" class="btn btn-success btn" value="Guardar" id="btnClienteNuevo">
						</div>
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
var pagina="empleados";
var status=1;
var consecutivo=false;
     $(function(){

  var Parametros = {   
        "sesion"    : $("#sesion").val(), 
        "modulo"    : $("#modulos").val(),
        "submodulo" : $("#submodulo").val(),
        "modcve"	: $("#modcve").val()
    }; 
        	
	   
 if($("#clave").val()=="") var accion="NuevoEmpleado";
	else	var accion="ModificaEmpleado";
	    


	    $("#correo").blur(function(){
	    	$("#mail").val($(this).val());

	    });	
	        
	        $("#DatosClientes").validate({

	            submitHandler: function(form) {
	          
	            if($("#clave").val()==""){
						    var accion="NuevoEmpleado";

						  }else{
						     var accion="ModificaEmpleado";
						      status=($("#status").is(":checked") ? "1" : "0");
						 }


					  campos={
					  		"clave"		 : $("#clave").val(),
					  		"nombre"     : $("#nombre").val(),
					        "apellidos"  : $("#apellidos").val(),
					        "cp"         : $("#cp").val(),
					        "direccion"  : $("#direccion").val(),
					        "telefono"   : $("#telefono").val(),
					        "celular"    : $("#celular").val(),
					        "ciudad"     : $("#ciudad").val(),
					        "estado"     : $("#estado").val(),
					        "area"       : $("#cboarea").val(),
					        "puesto"      : $("#cbopuesto").val(),

					        "correo"     : $("#correo").val(),
					        "mail"       : $("#mail").val(),
					        "pass"       : $("#pass").val(),
					        "tipo"       : $("#cboTipo").val(),
					        "usuario"    : $("#nickname").val(),
					        "id_usuario" : $("#id_usuario").val(),
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

 


</script>    
