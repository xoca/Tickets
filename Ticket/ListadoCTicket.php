<?
include_once("../libs/consultas.php");
$sesion = $_POST['sesion'];
$modulo = $_POST['modulo'];
$accion = $_POST['accion'];
$submodulo = $_POST['submodulo'];
$consultas = new Consultas();
//Si no esta activo lo manda al Login.
$Activo = $consultas->verificaSesion($sesion);

?>

<div class="panel panel-default">
<div class="panel-heading">
Listado de Ticket Cerrados</div>
<div class="panel-body" id="panelTicket">
<table class="table table-striped table-hover" id="gridticket">
    <thead>
    <tr>
     <th>Clave</th>
     <th>Nombre</th>
     <th>Correo</th>
      </tr>
</thead>

      <tbody id="bodyGridTicket">
      </tbody>
</table>

</div>

<!--- SE VA PINTAR EL PAGINADOR  -->
<div class="panel-footer" id="paginadorTicket">
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

$(document).ready(function(){
        CargarFiltro(1);
      });

</script>  