<?php 
include_once("../libs/consultas.php"); 
$bd = new Consultas();
$sesion     = $_POST["sesion"];
$clave      = $_POST["clave"];
$accion     = $_POST["accion"];
$modulo     = $_POST["modulo"];  
$submodulo  = $_POST["submodulo"];
$Usucve     = $_POST["usucve"];



  if( $accion == "NuevoEmpleado" ){
        $query = array (
            array("query" => "select @usuario:=(select ifnull(max(UsuCve),0)+1 clave from usuarios)"),  
            array("query" => "insert into usuarios values (@usuario,'".$_POST["usuario"]."','".$_POST["mail"]."','".$_POST["pass"]."',1,".$_POST['tipo'].")"),  
      
            array("query" => "select @empleado:=(select ifnull(max(emp_id),0)+1 clave from empleados)"),     
            array("query" => "insert into empleados values (@empleado,@usuario,'".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["direccion"]."','".$_POST["cp"]."','".$_POST["ciudad"]."','".$_POST["estado"]."','".$_POST["correo"]."','".$_POST["area"]."','".$_POST["puesto"]."','".$_POST["telefono"]."','".$_POST["celular"]."',1)")
           );
         
  }

  if($accion == "ModificaEmpleado"){

      $query = array ( 
            array("query" => "select @clave:=".$_POST["clave"]." "),
            array("query" => "update empleados set emp_nombre='".$_POST["nombre"]."',emp_apellidos='".$_POST["apellidos"]."',emp_domicilio='".$_POST["direccion"]."',emp_cp='".$_POST["cp"]."',emp_ciudad='".$_POST["ciudad"]."',emp_estado='".$_POST["estado"]."',telefono='".$_POST["telefono"]."',celular='".$_POST["celular"]."',emp_correo='".$_POST["correo"]."',emp_status='".$_POST["status"]."',id_area=".$_POST['area'].",id_puesto=".$_POST['puesto']." where emp_id='".$_POST["clave"]."' "),  
            array("query" => "update usuarios set UsuNombre='".$_POST["usuario"]."',UsuMail='".$_POST["correo"]."',UsuPassword='".$_POST["pass"]."',UsuTipo=".$_POST['tipo'].",UsuActivo='".$_POST["status"]."' where UsuCve=".$_POST['id_usuario']." ")
         );

  }


    if( $accion == "Eliminar" ){
        $query = array ( array("query" => "select @clave:=".$clave),
         array("query" => "delete from usuarios where UsuCve=@clave"),
         array("query" => "delete from seguridad where UsuCve=@clave"),
         array("query" => "delete from empleados where emp_id=@clave")
         );
       
   }


  if($accion=="NuevoCliente"){

    $servicios=count($_POST['servicios']);

     $query = array( 
      /*Registramos su Usuario para accesar al sistemas */
      array("query" => "select @usuario:=(select ifnull(max(UsuCve),0)+1 clave from usuarios)"),  
      array("query" => "insert into usuarios values (@usuario,'".$_POST["usuario"]."','".$_POST["mail"]."','".$_POST["pass"]."',1,2)"),  
      
      array("query" => "select @Cliente:=(select ifnull(max(cl_id),0)+1 clave from clientes)"),     
      array("query" => "insert into clientes values (@Cliente,'".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["razon"]."','".$_POST["rfc"]."','".$_POST["direccion"]."','".$_POST["cp"]."','".$_POST["ciudad"]."','".$_POST["estado"]."','".$_POST["telefono"]."','".$_POST["celular"]."','".$_POST["correo"]."',@usuario,1)"),
      array("query" => "delete from servicios_det where   ser_cliente=@Cliente")

         );
  
      /*Registramos sus Servicios registrados */ 
       if($servicios>0){
   for($i=0; $i<$servicios; $i++){
       $renovacion=($_POST["servicios"][$i]['Frenovacion']=="" ? "null" : "'".$_POST["servicios"][$i]['Frenovacion']."'" );
      
      $qryClave=array("query"=>"select @claveServicio:=(select ifnull(max(sercve),0)+1 clave from servicios_det )");
      $qryServicios=array("query"=>"insert into servicios_det values (@claveServicio,'".$_POST['servicios'][$i]['id_servicio']."',@Cliente,'".$_POST['servicios'][$i]['url']."','".$_POST['servicios'][$i]['Finicio']."','".$_POST['servicios'][$i]['Ffin']."',".$renovacion.")");
      array_push($query,$qryClave,$qryServicios);

    }

   }


}

if($accion=="NuevoServicios"){


    $query = array ( 
      array("query" => "select @clave:=(select ifnull(max(id),0)+1 from servicios)"),
      array("query" => "insert into servicios values (@clave,'".$_POST['nombre']."',1)")
     );
 
        

}


    if($accion == "ModificaServicios"){

      $query = array ( 
            array("query" => "select @clave:=".$_POST["clave"]." "),
            array("query" => "update servicios set cat_nombre='".$_POST["nombre"]."',cat_status='".$_POST["status"]."' where id='".$_POST["clave"]."' ")
         );
        



  }



  if( $accion=="NuevoDepartamento" ){
   
    $query=array(
      array("query"=> "select @clave:=(select ifnull(max(AreaCve),0)+1 from area )"),
      array("query"=> "insert into area values (@clave,'".$_POST['nombre']."','".$_POST['correo']."',1)")
      );


  }

    if( $accion=="ModificaDepartamento" ){
   
        $query = array ( 
                array("query" => "select @clave:=".$_POST["clave"]." "),
                array("query" => "update area set AreaDesc='".$_POST["nombre"]."',Areacorreo='".$_POST['correo']."',AreaEstatus='".$_POST["status"]."' where AreaCve='".$_POST["clave"]."' ")
               
             );


    }


        if( $accion=="NuevoRol" ){
         $permisos=count($_POST['permisos']);

            $query = array ( 
                    array("query" => "select @clave := ifnull(max(RolCve),0) + 1 from roles "),  
                    array("query" => "insert into roles values (@clave,'".$_POST["nombre"]."', 1)"),
                    array("query" => "delete from rolesdet  where RolCve=@clave")
                   
                 );

      /*Registramos Los modulos seleccionados */ 
             if($permisos>0){
             for($i=0; $i<$permisos; $i++){
                $qryPermiso=array("query"=>"insert into rolesdet values (@clave,".$_POST['permisos'][$i]['modulo'].",".$_POST['permisos'][$i]['submodulo'].",'".$_POST['permisos'][$i]['permiso']."')");
                array_push($query,$qryPermiso);

              }

         }

    }


        if( $accion=="ModificaRol" ){
           $permisos=count($_POST['permisos']);

            $query = array ( 
                    array("query" => "select @clave:=".$_POST["clave"]." "),
                    array("query" => "delete from rolesdet  where RolCve=".$_POST["clave"]." "),
                    array("query" => "update roles set RolDesc='".$_POST['nombre']."',RolActivo=".$_POST['status']." where RolCve=".$_POST['clave']." "),
                    );

      /*Registramos Los modulos seleccionados */ 
             if($permisos>0){
             for($i=0; $i<$permisos; $i++){
                $qryPermiso=array("query"=>"insert into rolesdet values (@clave,".$_POST['permisos'][$i]['modulo'].",".$_POST['permisos'][$i]['submodulo'].",'".$_POST['permisos'][$i]['permiso']."')");
                array_push($query,$qryPermiso);

              }
          }




    }

 
          $bitacora=array("query" => "insert into bitacora (UsuCve,BitFecha,Accion,AccionClave,Tablaaccion) values(".$Usucve.",now(), '".$accion."',@clave,'".$_POST['modulo']."')");
          $ultimo=array("query" => "select @clave clave");
          array_push($query,$bitacora,$ultimo);  

   $qry=$bd->transaccion($query); 
         if($bd->errorQry!=""){
            $result['respuesta']="NOK";
            $result['error']=$bd->errorQry;
            $result['mensaje']="Ha Ocurrido un Error al intentar guardar los datos.";

         }else{
            $result['respuesta']="OK";
            $result['error']=$bd->errorQry;
            $result['clave']=$qry['clave']."/".$qry[0];

         }

echo array_to_json($result);


?>


