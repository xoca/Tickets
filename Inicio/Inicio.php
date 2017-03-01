<?php 
include_once("../libs/stylos.php"); 
include_once("../libs/consultas.php");
include_once("../libs/menu.php");
$sesion = $_POST['sesion'];
$usuario = $_POST['Usuario'];
$correo = $_POST['correo'];
$usucve = $_POST['Usucve'];

$objDB = new Consultas();
//Si no esta activo lo manda al Login.
$Activo = $objDB->verificaSesion($sesion);

?>
<?php  HTMLHeader("::Sistema de Ticket::"); ?>
 <script type="text/javascript" src="../libs/inicio.js"></script>

  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
        
          <a class="navbar-brand" href="#">LOGO</a>
        </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $usuario;?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a  id='Perfil' url='Perfil.php' submodulo='ModificaUsuarios' modulo='Usuarios' clave='<?= $usucve?>' onclick='modulos(this);'>Editar Perfil</a></li>
             <li role="separator" class="divider"></li>
              <li><a  id='cerrar'>Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <!-- Cargar Menus de Arriba -->       
             <?php echo menu_($sesion); ?>
       </ul>
   </div><!-- /.nav-collapse -->
     
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">
        <!--/menu-->
         <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="menu_horizontal">
         </div>
        <!--/termina el menu-->

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">button</button>
          </p>
          <div class="panel panel-default">
            <div class="panel-body" id='modulo'>

         <div class="alert alert-success" role="alert"> Bienvenido <?= $usuario; ?> </div>
        </div>
          </div>

         
      
        </div>


      </div><!--/row-->


    </div><!--/.container-->

     <?footer();?>
    <form id="frmInicio" name="frmInicio" action="Inicio.php" method="POST">
      <input type="hidden" name="sesion" id="sesion" value="<? print $sesion;?>">
      <input type="hidden" name="Usuario" id="Usuario" value="<? print $usuario ?>">
      <input type="hidden" name="correo" id="correo" value="<? print $correo ?>">
      <input type="hidden" name="Usucve" id="Usucve" value="<? print $usucve ?>">
      <input type="hidden" name="Usucve" id="Usucve" value="<? print $usucve ?>">
    </form>


  </body>
</html>

