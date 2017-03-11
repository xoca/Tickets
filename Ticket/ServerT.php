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
    array("query" => "insert into ticket values(@clave,'".$_POST['depto']."',now(),".$Usucve.",'".$_POST["nombre"]."','".$_POST["emailTicket"]."','".$_POST["asunto"]."','".$_POST["servicio"]."',1)"),        
    array("query" => "select @detalle:=(select ifnull(max(TidcCve),0)+1 from ticketdetalle)"),
    array("query" => "insert into ticketdetalle values(@detalle,@clave,now(),".$Usucve.",'".$_POST["mensaje"]."')")
    
    );
  
   if($_POST['fotos']!=""){
    $fotos=array("query" => "update archivos set id_ticketdetalle=@detalle where id in (".$_POST['fotos'].")");
     array_push($query,$fotos);
   }


}

if($accion=="ModificaTicket"){

      $query = array( 
      array("query" => "select @clave:=".$_POST["clave"]." "),
      array("query" => "update ticket set TicEstatus=".$_POST["status"]." where TicCve=@clave"),
      array("query" => "select @detalle:=(select ifnull(max(TidcCve),0)+1 from ticketdetalle)") 
    );
     if($_POST["mensaje"]!=""){ 
    $detalle=array("query" => "insert into ticketdetalle values(@detalle,@clave,now(),".$Usucve.",'".$_POST["mensaje"]."')");
    array_push($query,$detalle);
  }
   if($_POST['fotos']!=""){
    $fotos=array("query" => "update archivos set id_ticketdetalle=@detalle where id in (".$_POST['fotos'].")");
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

         $to=array($_POST["emailTicket"],$_POST['mailCliente'],$_POST["correoArea"]);  

        if($_POST["mailCliente"]<>$_POST["mailUscve"] && $_POST["tipoUsuario"]=="2") array_push($to,$_POST["mailUscve"]);
        else  if($_POST["correoArea"]<>$_POST["mailUscve"] && $_POST["tipoUsuario"]<>"2") array_push($to,$_POST["mailUscve"]);
        
         $row=$bd->Modificacion("UsuariosAdmins",$clave);
         array_push($to,$row['mail']);
         

            if($accion=="NuevoTicket"){
                $result=CorreoLevantamiento($qry[0],$to);
            }else if($accion=="ModificaTicket"){
                 $result=CorreoActualizar($qry[0],$to);

            }

}

function CorreoLevantamiento($folio,$correos){

          $result['respuesta']="OK";
          $result['correos']="";
       
          $titulo    = $_POST["asunto"];
          $mensaje   = '<html><p>Hola '.$_POST["NameCusto"].'</p><br> <p>Se ha dado de alta un nuevo ticket con número de folio #'.$folio.' con el siguiente mensaje: <br></p>';
          $mensaje  .='<p><br>*****************************************************************************<br>'.$_POST["mensaje"].'<br><br>***************************************************************************** <br></p> </p>';
          $mensaje  .='<p><br>IMPORTANTE: Favor de no responder, este correo es sólo informativo.  Para responder el ticket, dar click en la siguiente liga:<br></p> ';
          $mensaje  .='<p><br>Cordiales Saludos <br></p><p>D-I Desarrollo Informático</p></html>';
         
          $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
          $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
          $cabeceras .= 'From: soporte@d-i.mx';
  
           foreach ($correos as $x) {
            $result['correos'].=$x.",";
               if(!mail($x, $titulo, $mensaje, $cabeceras)) $result['respuesta']="NOK";
               
            }

        $result['mail']=$mensaje;
        return $result;

}


function CorreoActualizar($folio,$correos){
    
          $titulo    = $_POST["asunto"];
          $result['respuesta']="OK";
          $result['correos']="";
          
          $mensaje   = '<html><p>Hola '.$_POST["NameCusto"].'</p><br> <p>Su ticket con número de folio #'.$folio.' ha sido actualizado por '.$_POST['NameUsuario'].' con la siguiente respuesta:<br></p>';
          $mensaje  .='<p><br>*****************************************************************************<br>'.$_POST["mensaje"].'<br><br>***************************************************************************** <br></p> </p>';
          $mensaje  .='<p><br>IMPORTANTE: Favor de no responder, este correo es sólo informativo.  Para responder el ticket, dar click en la siguiente liga:<br></p> ';
          $mensaje  .='<p><br>Cordiales Saludos <br></p><p>D-I Desarrollo Informático</p></html>';
      


          $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
          $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
          $cabeceras .= 'From: soporte@d-i.mx';

           foreach ($correos as $x) {
            $result['correos'].=$x.",";
              if(!mail($x, $titulo, $mensaje, $cabeceras)) $result['respuesta']="NOK";
               
            }

            $result['mail']=$mensaje;
            return $result;

}

echo array_to_json($result);



?>


