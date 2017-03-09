<?php 
include_once("../libs/consultas.php"); 
$bd = new Consultas();
$sesion     = $_POST["sesion"];
$clave      = $_POST["clave"];
$accion     = $_POST["accion"];
$modulo     = $_POST["modulo"];  
$submodulo  = $_POST["submodulo"];
$Usucve     = $_POST["usucve"];

if($accion=="NuevoTicket"){

   $query = array( 
    array("query" => "select @clave:=(select ifnull(max(TicCve),0)+1 from ticket)"),
    array("query" => "insert into ticket values(@clave,'".$_POST['depto']."',now(),".$Usucve.",'".$_POST["nombre"]."','".$_POST["email"]."','".$_POST["asunto"]."','".$_POST["servicio"]."',1)"),        
    array("query" => "select @detalle:=(select ifnull(max(TidcCve),0)+1 from ticketdetalle)"),
    array("query" => "insert into ticketdetalle values(@detalle,@clave,now(),".$Usucve.",'".$_POST["mensaje"]."')")
    
    );
  
   if($_POST['fotos']!=""){
    $fotos=array("query" => "update archivos set id_ticketdetalle=@clave where id in (".$_POST['fotos'].")");
     array_push($query,$fotos);
   }


}


 
      $bitacora=array("query" => "insert into bitacora (UsuCve,BitFecha,Accion,AccionClave,Tablaaccion) values(".$Usucve.",now(), '".$accion."',@clave,'".$_POST['modulo']."')");
      $ultimo=array("query" => "select @clave clave");
      array_push($query,$bitacora,$ultimo);  
       $qry=$bd->transaccion($query); 
    
    if($bd->errorQry!=""){
            $result['respuesta']="NOK";
            $result['mensaje']=$bd->errorQry;
           

    }else{
            $result['respuesta']="OK";
            $result['mensaje']=$bd->errorQry;
            $result['clave']=$qry['clave']."/".$qry[0];


            if($accion=="NuevoTicket"){
          $to=array("soporte@d-i.mx",$_POST["email"],$_POST["correo"]);   
          $para      = $_POST['correo'];
          $titulo    = $_POST["asunto"];
          $mensaje  = '<html><p>Se ha levantado un Nuevo Ticket con el Folio#'.$qry[0].' </p></html>';
          $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
          $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
          $cabeceras .= 'From: soporte@d-i.mx';
  
           foreach ($to as $x) {
              mail($x, $titulo, $mensaje, $headers);
               
              }


            }

    }



echo array_to_json($result);


?>


