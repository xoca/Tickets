<?
include_once("../libs/consultas.php");
$sesion = $_POST['sesion'];
$modulo = $_POST['modulo'];
$accion = $_POST['accion'];
$submodulo = $_POST['submodulo'];
$consultas = new Consultas();
//Si no esta activo lo manda al Login.
$Activo = $consultas->verificaSesion($sesion);
print_r($_GET);

?>

<div class="row">
           
               <div class="col-sm-3">
                <strong>Nombre</strong>
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
Listado de Ticket Abiertos</div>
<div class="panel-body" id="panelTicket">
<table class="table table-striped table-hover" id="gridticket">
    <thead>
    <tr>
     <th>Folio</th>
     <th>Fecha</th>
     <th>Nombre</th>
     <th>Departamento</th>
     <th>Servicio</th>
     <th>Correo</th>
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
			<input type="hidden" name="sesion" id="sesion" value="<? print $sesion;?>">
			<input type="hidden" name="modulos" id="modulos" value="<? print $modulo;?>">
      <input type="hidden" name="accion" id="accion" value="<? print $accion;?>">
      <input type="hidden" name="submodulo" id="submodulo" value="<? print $submodulo;?>">
      <input type="hidden" name="Usucve" id="Usucve" value="<? print $usucve;?>">
</form>


<script type="text/javascript">
var parametros={
        "nombre" : $("#nombre").val(),
        "convenio"  : "-1"
    };



$(document).ready(function(){
   
        CargarFiltro(1,"ListadoTicket",parametros);

      });



   function buscar(){

    var parametros={
        "nombre" : $("#nombre").val(),
        "convenio"  : "-1"
    };
        CargarFiltro(1,"ListadoTicket",parametros);

   }

</script>  