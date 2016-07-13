<?php 
include_once("../libs/consultas.php"); 
$bd = new Consultas();
$sesion       = $_POST["sesion"];
$clave      = $_POST["clave"];
$accion     = $_POST["accion"];
$modulo     = $_POST["modulo"];  
$submodulo  = $_POST["submodulo"];
$Usucve    = $_POST["usucve"];


 
  if( $accion == "Modifica".$modulo ){
        $query = array ( array("query" => "select @clave:=".$clave),
         array("query" => "update usuarios  set UsuNombre='".$_POST["nombre"]."',
                            UsuApellidos='".$_POST["apellidos"]."', 
                            UsuMail='".$_POST["email"]."', 
                            UsuPassword='".$_POST["password"]."',
                            UsuActivo='".$_POST["activo"]."' where UsuCve=@clave"),
         );
         $qry=$bd->transaction($query); 
        
         if($qry=="1"){
          $result['respuesta']="OK";
         }else{
          $result['mensaje']=$qry;
         }
      echo array_to_json($result);
  }

  if( $accion == "NuevoUsuarios" ){
        $query = array ( array("query" => "select @clave:=(select ifnull(max(Usucve),0)+1 from usuarios)"),
         array("query" => "insert into usuarios values(@clave,'".$_POST["nombre"]."','".$_POST["apellidos"]."', '".$_POST["email"]."', '".$_POST["password"]."','".$_POST["tipoUsuario"]."',1)"),
         /*Aqui van los modulos de ticket para crear y listar*/
          array("query" => "insert into seguridad values(@clave,1,0,null)"),
           array("query" => "insert into seguridad values(@clave,1,1, null)"),
           array("query" => "insert into seguridad values(@clave,1,4, null)"),
           /*bitacora*/
            array("query" => "insert into bitacora values(@clave,".$Usucve.",now(), '".$accion."',@clave,'".$_POST['modulo']."')"),
         );
         $qry=$bd->transaction($query); 
        
         if($qry=="1"){
          $result['respuesta']="OK";
         }else{
          $result['mensaje']=$qry;
         }
      echo array_to_json($result);
  }


    if( $accion == "Eliminar" ){
        $query = array ( array("query" => "select @clave:=".$clave),
         array("query" => "delete from usuarios where UsuCve=@clave"),
         array("query" => "delete from seguridad where UsuCve=@clave"),
         );
         $qry=$bd->transaction($query); 
        
         if($qry=="1"){
          $result['respuesta']="OK";
         }else{
          $result['mensaje']=$qry;
         }
      echo array_to_json($result);
  }


?>