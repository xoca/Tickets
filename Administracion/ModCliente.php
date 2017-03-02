<?
include_once("../libs/consultas.php");
$sesion = $_POST['sesion'];
$modulo = $_POST['modulo'];
$submodulo = $_POST['submodulo'];
$modcve = $_POST['modcve'];
$clave = "-1";
$consultas = new Consultas();
$Activo = $consultas->verificaSesion($sesion);


if(isset($_POST['clave'])){
	$clave = $_POST['clave'];
	$cliente=$consultas->Modificacion("DatosCliente",$clave);
	
} 

//Mostrar los servicios registrados y pueden elegir
$servicios=$consultas->DatosM("Servicios",$clave);
$htmlServicios="";
if($servicios[0]==1)
while ($row=mysql_fetch_array($servicios[1])) {
	$checked=($row['ser_cliente']!="" ? "checked" : "");
		$htmlServicios.='<div class="row ServiciosDiv">
							    	<div class="col-md-1">
							    	 <br>
						          		 <input type="checkbox" id="servicio'.$row[0].'" '.$checked.' name="servicios" value="'.$row[0].'" />
						          		</div>
						          		<div class="col-md-2">
						          		 <label><br>'.$row[1].'</label>
						          		</div>
						          	<div class="col-md-3">
						          	<label>URL</label>
						          		 <input type="text" id="url'.$row[0].'" name="servisDatos" value="'.$row['ser_url'].'" class="form-control" placeholder="http://www.google.com" />
						          		</div>
						          		<div class="col-md-2">
						          		<label>Fecha Inicio</label>
						          	  <input  name="fechas" id="fechaIni'.$row[0].'" type="text" class="form-control date" value="'.$row['fecha_inicio'].'"/>
						          		</div>	
						          		<div class="col-md-2">
						          		<label>Fecha Final</label>
						          	  <input  name="fechas" id="fechafin'.$row[0].'" type="text" class="form-control date" value="'.$row['fecha_fin'].'"/>
						          		</div>
						          		<div class="col-md-2">
						          		<label>F. Renovacion</label>
						          	  <input  name="fechas" id="fechaRen'.$row[0].'" type="text" class="form-control date" value="'.$row['fecha_renovacion'].'"/>
						          		</div>		
				    		 		 </div>';
	
}
					  

else echo $errorServicios=$servicios[1];

?>

       	<div class="row">
		<div class="col-md-12 text-center">
			<div class="panel panel-success" style="margin-top:30px">
				<div class="panel-heading">EDITAR CLIENTE </div>

			</div>
		</div>

    </div>
    <div class="row">
   <div class="col-md-4">
            <a id="ModEmpleados"  url="clientes.php" submodulo="<?=$submodulo;?>" modcve="<?=$modcve;?>" modulo="<?=$modulo;?>" onclick="modulos(this);" href="#">Regresar</a>
        </div>
    </div>
    
    
		<div id="NuevoCliente" class="row">
			 <div class="col-md-12">
			 <form id="DatosClientes" action="#"  method="post">
			 	<div class="row">
			 		      <div class="col-md-2">
				          <label>clave</label>   
				             <input type="text" id="clave" name="clave" placeholder="ID" value="<?=$cliente['cl_id']?>" class="form-control" disabled/>
				         	  <input type="hidden" id="id_usuario" name="id_usuario" placeholder="ID" value="<?=$cliente['id_usuario']?>" class="form-control" disabled/>
				         
				          </div>

			 	</div>
			 			<div class="row">
				          <div class="col-md-4">
				          <label>Nombre Cliente</label>   
				             <input type="text" id="nombre" name="nombre" value="<?=$cliente['cl_nombre']?>" placeholder="Nombre" class="form-control" required/>
				          </div>
				           <div class="col-md-4">
				           <label>Apellidos</label>   
				             <input type="text" id="apellidos" name="apellidos" value="<?=$cliente['cl_apellidos']?>" placeholder="Apellidos" class="form-control" required/>
				          </div>
				      </div>
				     <div class="row">
				           <div class="col-md-4">
				         <label>RFC</label>   
				             <input type="text" id="rfc" name="rfc" placeholder="RFC" value="<?=$cliente['cl_rfc']?>" class="form-control" />
				          </div>
				             <div class="col-md-4">
				         <label>Razon social</label>   
				             <input type="text" id="razon" name="razon" value="<?=$cliente['cl_razons']?>" placeholder="Razon Social" class="form-control" />
				          </div>
				          
				     </div>
				     <div class="row">
				     	 <div class="col-md-4">
				           <label>Direccion</label>    
				             <input type="text" id="direccion" name="direccion" value="<?=$cliente['cl_direccion']?>" placeholder="direccion" class="form-control" />
				          </div>
				           <div class="col-md-4">
				           <label>C.P</label>    
				             <input type="text" id="cp" name="cp" placeholder="Codigo Postal" value="<?=$cliente['cl_cp']?>" class="form-control number" />
				          </div>

				     </div>
				      	<div class="row">
				      		 <div class="col-md-4">
				           <label>Ciudad</label>    
				             <input type="text" id="ciudad" name="ciudad" value="<?=$cliente['cl_ciudad']?>" placeholder="Ciudad / Municipio/Delegacion" class="form-control" />
				          </div>
				  		
				      		 <div class="col-md-4">
				           <label>Estado</label>    
				             <input type="text" id="estado" name="estado" value="<?=$cliente['cl_estado']?>" placeholder="Estado" class="form-control" />
				          </div>
				  		</div>

				      <div class="row">
				      		
				  		</div><div class="row">
				      		 <div class="col-md-4">
				           <label>Telefono</label>    
				             <input type="text" id="telefono" name="telefono" value="<?=$cliente['cl_telefono']?>" placeholder="Telefono" class="form-control" />
				          </div>
				      		 <div class="col-md-4">
				           <label>Celular</label>    
				             <input type="text" id="celular" name="celular" placeholder="Celular" value="<?=$cliente['cl_celular']?>" class="form-control" />
				          </div>
				  		
				  		</div>


				          <div class="row">
				          	
				           <div class="col-md-4">
				          <label>Correo</label>   
				             <input type="email" id="correo" name="correo" placeholder="Correo" value="<?=$cliente['cl_correo']?>" class="form-control" required/>
				          </div>
				          
				      </div>
				       <div class="row">
				       	

   					  		<?php	if(isset($_POST['clave'])){ ?>
					   	<div class="col-md-1">
					    	<label name="Nombre"  class="control-label">Estatus</label>
					 	    <input type="Checkbox"   name="status" id="status" type='text' class="form" value="" <?php echo ($cliente['cl_status']=="1" ? "checked" : "" ) ?>/>					  	
						</div>
				
					<?php } ?>
   					  	
   					  </div>	 

				      <div class="row"><br></div>
				           <div class="row">
				         <div class="panel panel-success col-md-12">
						      <div class="panel-heading">Servicios Contratados por el Usuario</div>
						      <div class="panel-body">
						      	<div class="row">
						      		<p>Favor de Seleccionar al menos un servicio.</p>
						      	</div>
						      	<?= $htmlServicios;  ?>
						           

						      </div>
   						 </div>
   					  </div>
				      <div class="row">
				         <div class="panel panel-success col-md-10">
						      <div class="panel-heading">Datos Para el inicio de Sesion</div>
						      <div class="panel-body">
						      	<div class="row">
						      		<p>Estos datos son muy importantes debido que el cliente podra entrar a la pagina y realizar las cotizaciones para esto se necesita un correo electronico y contraseña</p>
						      	</div>
						           <div class="row">
					    <div class="col-md-4">
				          <label>Nombre Usuario</label>   
				             <input type="text" id="nickname" name="nickname" value="<?=$cliente['UsuNombre']?>" placeholder="Nombre de Usuario" class="form-control" required/>
				          </div>
				          	
				           <div class="col-md-4">
				          <label>Correo</label>   
				             <input type="email" id="mail" name="mail" value="<?=$cliente['UsuMail']?>" placeholder="Correo" class="form-control" required/>
				          </div>
				              <div class="col-md-4">
				          <label>Contraseña</label>   
				             <input type="pass" id="pass" name="pass" value="<?=$cliente['UsuPassword']?>" placeholder="Contraseña" class="form-control" required/>
				          </div>

				      </div>
				       <div class="row">
				      	 <div class="col-md-4">
				          	  <label>Tipo de Usuario</label>
				          	<select id="cboTipo" name="cboTipo" class="form-control" disabled>
							<?= $consultas->generaCombo("cboRol","2",''); ?>	
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
var pagina="clientes";
var status=1;
var consecutivo=false;


     $(function(){

  var Parametros = {   
        "sesion"    : $("#sesion").val(), 
        "modulo"    : $("#modulos").val(),
        "submodulo" : $("#submodulo").val(),
        "modcve"	: $("#modcve").val()
    }; 

           $( "input[name='fechas']" ).datepicker({
    	  
			    	  changeMonth : true,
			    	  changeYear  : true,
			    	  dateFormat  : 'yy-mm-dd',
			    	  yearRange   : "2016:2050"

				});

	
	   
 if($("#clave").val()=="") var accion="NuevoEmpleado";
	else	var accion="ModificaEmpleado";
	    


	    $("#correo").blur(function(){
	    	$("#mail").val($(this).val());

	    });	
	        
	        $("#DatosClientes").validate({

	            submitHandler: function(form) {
	            	//servicios=servicios();
	            	var servicios=Servicios();

	            	 if($("#clave").val()==""){
						    var accion="NuevoCliente";

						  }else{
						     var accion="ModificaCliente";
						      status=($("#status").is(":checked") ? "1" : "0");
						 }


					  campos={
					  		"clave"		 : $("#clave").val(),
					        "nombre"     : $("#nombre").val(),
					        "apellidos"  : $("#apellidos").val(),
					        "rfc"        : $("#rfc").val(),
					        "razon"      : $("#razon").val(),
					        "direccion"  : $("#direccion").val(),
					        "cp"         : $("#cp").val(),
					        "ciudad"     : $("#ciudad").val(),
					        "estado"     : $("#estado").val(),
					        "telefono"   : $("#telefono").val(),
					        "celular"    : $("#celular").val(),
					        
					        "correo"     : $("#correo").val(),
					        "mail"       : $("#mail").val(),
					        "pass"       : $("#pass").val(),
					        "tipo"       : $("#cboTipo").val(),
					        "usuario"    : $("#nickname").val(),
					        "id_usuario" : $("#id_usuario").val(),
					        "servicios"       : servicios,

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

function Servicios(){
  	    var datos=[];
    	var servicios={};

 			$(".ServiciosDiv").each(function(){
    		
    			var checked=$(this).children()[0].childNodes[3].checked;
    			
    			//Los que este checked sacamos las demas informacion de ese renglon
    			if(checked){
    				 servicios={
                    'id_servicio'  : $(this).children()[0].childNodes[3].value,
                    'url'  		   : $(this).children()[2].childNodes[3].value,
                    'Finicio'      : $(this).children()[3].childNodes[3].value,
                    'Ffin'         : $(this).children()[4].childNodes[3].value,
                    'Frenovacion'  : $(this).children()[5].childNodes[3].value
                   
               };
             
               datos.push(servicios);

    			}
    			

  			 });

 			return datos;

}


</script>    
