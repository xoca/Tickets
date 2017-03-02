<?
include_once("../libs/consultas.php");
$sesion = $_POST['sesion'];
$modulo = $_POST['modulo'];
$accion = $_POST['accion'];
$submodulo = $_POST['submodulo'];
$modcve = $_POST['modcve'];
$consultas = new Consultas();
//Si no esta activo lo manda al Login.
$Activo = $consultas->verificaSesion($sesion);

?>

<div class="row">
           
               <div class="col-sm-3">
                <strong>Nombre Usuario</strong>
                   <input type="text"class="form-control" placeholder="Nombre" name="nombre" id="nombre">
                </div>
                
                <div class="col-md-4">
                  <br/>
                 <button id="buscar" onclick="buscar();" class="btn btn-gris">Buscar</button>
                </div>
                    
</div>

<div class="row"><br></div>

<div class="panel panel-default">

<div class="panel-heading">
Accesos a Usuarios</div>
<div class="panel-body" id="panelEmpleados">
<table class="table table-striped table-hover" id="gridUsuarios">
    <thead>
    <tr>
     <th>Clave</th>
     <th>Usuario</th>
     <th>E-Mail</th>
     <th>Tipo</th>
     <th>Estatus</th>
      </tr>
</thead>

      <tbody id="bodyGrid">
      </tbody>
</table>

</div>

<!--- SE VA PINTAR EL PAGINADOR  -->
<div class="panel-footer" id="paginador">
</div>
</div>         

<form id="frmModulos" name="frmModulos" action="Inicio.php" method="POST">
			<input type="hidden" name="sesion" id="sesion" value="<?= $sesion;?>">
			<input type="hidden" name="modulos" id="modulos" value="<?= $modulo;?>">
      <input type="hidden" name="accion" id="accion" value="<?= $accion;?>">
      <input type="hidden" name="submodulo" id="submodulo" value="<?= $submodulo;?>">
      <input type="hidden" name="modcve" id="modcve" value="<?= $modcve;?>">
      <input type="hidden" name="paginared" id="paginared" value="ModAcceso">
</form>


<script type="text/javascript">
var parametros={
        "nombre" : $("#nombre").val(),
        "convenio"  : "-1"
    };



$(document).ready(function(){
   
        CargarFiltro(1,"LUsuarios",parametros);

      });



   function buscar(){

    var parametros={
        "nombre" : $("#nombre").val(),
        "convenio"  : "-1"
    };
        CargarFiltro(1,"LUsuarios",parametros);

   }

</script>  

