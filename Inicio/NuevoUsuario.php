<?php include_once("../libs/stylos.php"); ?>
<?HTMLHeader("::Sistema de Ticket::");?>
<link href="../boostrap/css/signin.css" rel="stylesheet">
<div class="container">
      <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="login-form-link">Iniciar Sesion</a>
              </div>
             <!-- <div class="col-xs-6">
                <a href="#" id="register-form-link">Registrarse</a>
              </div>-->
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="login-form"  action="index.php" method="post" role="form" style="display: block;">
                
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Correo Electronico" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>

                   <span class="label label-danger" id='msj'></span>
				   <hr></hr>             
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="#" tabindex="5" class="forgot-password">¿Olvidaste Contraseña?</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
               <!-- 
                <form id="register-form" action="/inicio/nuevo" method="post" role="form" style="display: none;">
                  <div class="form-group">
                    <input type="text" name="nombre" id="nombre" tabindex="1" class="form-control" placeholder="Nombre" value="">
                  </div>
                   <div class="form-group">
                    <input type="text" name="apellidos" id="apellidos" tabindex="1" class="form-control" placeholder="Apellidos" value="">
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo Electronico" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                
                  <div class="form-group">
                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrar">
                      </div>
                    </div>
                  </div>
                </form> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<form id="frmSesion" name="frmSesion" action="Inicio.php" method="POST">
			<input type="hidden" name="sesion" id="sesion" value="">
			<input type="hidden" name="Usuario" id="Usuario" value="">
			<input type="hidden" name="correo" id="correo" value="">
		</form>
<?footer();?>



  <?php
	 include_once("../libs/consultas.php");
	if ( isset($_POST["username"]) && isset($_POST["password"]) ) 
	{

		$user = $_POST["username"];
		$pwd = $_POST["password"];
		
		$db = new Consultas();	
		

		$user_id = $db->verificaUsuario(Array($user, $pwd) );

		if ( $user_id>0 )
		{
			$fecha = date("Y-m-d H:i:s");
			$hora = date("H:i");
			if ( !session_id() ){
				session_start();
				$nsesion = session_id();
		 $query = array ( array("query" => "delete from sesion where UsuCve ='".$user_id[0]."';"),
         array("query" => "insert into sesion values('".$nsesion."', ".$user_id[0].", '".$fecha."', '".$hora."');"),
     		 );

     		 $qry=$db->transaction($query);	
     		
     		 if(!$qry){
     		 	echo '<span class="label label-danger">Ha Ocurrido un Error</span>';
     		 }

		//	$db->creaSesion(Array($user_id, $nsesion, $fecha, $hora) );

			?>
				<script language="javascript">							
					document.frmSesion.sesion.value = "<?print $nsesion;?>";
					document.frmSesion.Usuario.value = "<?print $user_id[1];?>";
          document.frmSesion.correo.value = "<?print $user;?>";
					document.frmSesion.submit();
				</script>
			<?	
			}				
		}
		else{
			?>
				<script language="javascript">
				$("#msj").html("Datos Incorrectos,Favor de Verificar");
				$("#msj").show();
				</script>				
			<?
		}
	}
?>