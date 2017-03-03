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
		$row=$consultas->Modificacion("DatosRol",$clave);
	} 


	function cargaPermisos($clave,$consultas)
	{
		$cadenaTbl = "";
		$clave = $clave == "" ? "0" : $clave;
		$res = $consultas->DatosM("CargaRoles",$clave);
		$letras = array("N", "M", "E", "C", "R"); 
						
		$cadenaTbl .= "<thead class='thead-inverse'> <tr><td class='EncGrid' align='center'>MODULO</td><td class='EncGrid' align='center'>SUBMODULO</td>";
		$cadenaTbl .= "<td class='EncGrid' align='center'>ACCESO</td></thead>";
		
			
		$i=0;
		while($row = mysql_fetch_array($res[1])){
			$className = "CeldaGrid".($i++)%2;
			$cadenaTbl .= "<tr>";
			if( $row["ModSub"] == 0 ){
				$cadenaTbl .= "<td class=".$className." align='center'>".$row["ModNombre"]."</td>";
				for($j=0; $j<2; $j++)
					$cadenaTbl .= "<td class=".$className." align='center'></td>";
			}			
			else
			{
				$cadenaTbl .= "<td class=".$className."></td><td class=".$className." align='center'>".$row['SubNombre']."</td>";
				for ( $j=0; $j<1; $j++){
					$checked = substr_count($row["SegAccion"],$letras[$j]) > 0 ? "checked" : ""; 
					$cadenaTbl .= "<td class=".$className." align='center'><input type='checkbox' class='Ctext' name='".$row["ModCve"]."|".$row["ModSub"]."' id='".$letras[$j]."' ".$checked."></td>";
				}
			}
			$cadenaTbl .= "</tr>";
		}		
		return $cadenaTbl;
	}

?>

       	<div class="row">
		<div class="col-md-12 text-center">
			<div class="panel panel-success" style="margin-top:30px">
				<div class="panel-heading">Tipos de Usuario</div>

			</div>
		</div>

    </div>
    <div class="row">
   <div class="col-md-4">
            <a id="ModRol"  url="Rol.php" submodulo="<?=$submodulo;?>" modcve="<?=$modcve;?>" modulo="<?=$modulo;?>" onclick="modulos(this);" href="#">Regresar</a>
        </div>
    </div>
    
    
		<div id="NuevoDepartamento" class="row">
			 <div class="col-md-12">
			 <form id="Datos" action="#"  method="post">
			 	<div class="row">
			 		      <div class="col-md-2">
				          <label>clave</label>   
				            	</div> 
				          <div class="col-md-2">
				           <input type="text" id="clave" name="clave" placeholder="ID" value="<?=$row['RolCve']?>" class="form-control" disabled/>
				         
				          </div>

			 	</div>
			 			<div class="row">
				          <div class="col-md-2">
				          <label>Nombre</label>   
				            </div>
				          <div class="col-md-4">
     					<input type="text" id="nombre" name="nombre" value="<?=$row['RolDesc']?>" placeholder="Nombre" class="form-control" required/>
				          </div>
				         
				      </div>
				    
				       <div class="row">
				       		<?php	if(isset($_POST['clave'])){ ?>
					   	<div class="col-md-2">
					    	<label name="Nombre"  class="control-label">Estatus</label>
					 		</div>
							<div class="col-md-1">    <input type="Checkbox"   name="status" id="status" type='text' class="form" value="" <?php echo ($row['RolActivo']=="1" ? "checked" : "" ) ?>/>					  	
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
				      	<div class="col-md-2 col-md-offset-10">
				      		<input type="button" class="btn btn-secondary"  value="+" id="+" title="Todos" language="javascript" onclick="chkPermisos(this);"></input>
					<input type="button" class="btn btn-secondary" value="-" id="-" title="Ninguno" language="javascript" onclick="chkPermisos(this);"></input>
				      	</div>
				      
				      </div>
   					  <div class="row">
   					  	<table id="tblPermisos" name="tblPermisos"  class="table table-striped">
							<?print cargaPermisos($clave,$consultas);?>
						</table>

   					  </div>
 
				      <div class="row">
				      	<br>
					</div>
		     </form>  
		</div>
	</div>

             

<form id="frmModulos" name="frmModulos" action="Inicio.php" method="POST">
	  <input type="hidden" name="sesion" id="sesion" value="<?= $sesion;?>">
	  <input type="hidden" name="modulos" id="modulos" value="<?= $modulo;?>">
      <input type="hidden" name="accion" id="accion" value="<?= $accion;?>">
      <input type="hidden" name="submodulo" id="submodulo" value="<?= $submodulo;?>">
      <input type="hidden" name="modcve" id="modcve" value="<?= $modcve;?>">
</form>



<script type="text/javascript">
var pagina="Rol";  //El nombre de la Pagina del lista cuando guarden a esta redireccionara
var status=1;
  var Parametros = {   
		        "sesion"    : $("#sesion").val(), 
		        "modulo"    : $("#modulos").val(),
		        "submodulo" : $("#submodulo").val(),
		        "modcve"	: $("#modcve").val()
		    }; 

        
     $(function(){

	        $("#Datos").validate({

	            submitHandler: function(form) {
	            			var permisos=generaPermisos();
	            		 if($("#clave").val()==""){
						    var accion="NuevoRol";

						  }else{
						     var accion="ModificaRol";
						      status=($("#status").is(":checked") ? "1" : "0");
						 }


					  campos={
					  		"clave"		 : $("#clave").val(),
					        "nombre"     : $("#nombre").val(),
					        "permisos"	 : permisos,
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


function chkPermisos ( btn )
{
	checked = btn.id == "+";
	checks = document.getElementById("tblPermisos").getElementsByTagName("input");

	for ( i = 0; i < checks.length; i++ )
		checks[i].checked = checked;
}




function generaPermisos()
{
    var datos=[];
    var permisos={};

  cadena = "";
  cadenaAux = "";
  checks = document.getElementById("tblPermisos").getElementsByTagName("input");
modulo="";
  modsub = checks[0].name;
  for ( i = 0; i < checks.length; i++ ){    
    if( modsub != checks[i].name ){

          division=modsub.split("|");
        //Trae algo que guarde los datos     
      if(cadenaAux != ""){
      	 if(division[0]!=modulo){ //Modulo Principal
	      	 	permisos={
	            "modulo":division[0],
	            "submodulo":0,
	            "permiso":""
	          }
	          datos.push(permisos);
          }
          modulo=division[0];
          permisos={
            "modulo":division[0],
            "submodulo":division[1],
            "permiso":cadenaAux
          }
          datos.push(permisos);
      }    
          cadenaAux = ""; 
    }
    if( checks[i].checked ) cadenaAux += checks[i].getAttribute("id");    
    modsub = checks[i].name;        
  }

if(cadenaAux != ""){
	  division=modsub.split("|");
          permisos={
            "modulo":division[0],
            "submodulo":division[1],
            "permiso":cadenaAux
          }
          datos.push(permisos);
      }  

    return datos;

}



 $("#Eliminar").click(function(){
    var tablas=[];
     var tables=["roles","rolesdet"];
    for(i=0;i<2;i++){

     var condiciones={
     	"tabla":tables[i],
     	"condicion": " and RolCve="+$("#clave").val()+" "
     	
     	};
     	tablas.push(condiciones);
    }
      
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
