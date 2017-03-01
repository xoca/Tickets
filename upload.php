<?php
include_once("includes/consultas.php"); 
$conexion=new Consultas();
$target_path = "imagenes/";  //se haga una carpeta por solicitud


if($_POST["accion"]=="Delete"){
if($_POST['key']!=""){ 
if(unlink($target_path.$_POST['nombre'])){

if($_POST['key']=="") $upFoto="select '1' clave";
$upFoto=" delete from archivos where id='".$_POST['key']."' ";

$query = array( 
		  array("query" => $upFoto),
		array("query" => "select '".$_POST['key']."' clave" )   );
        				 $qry=$conexion->transaction($query);
        				 $result["respuesta"]="OK";


 }else $result["error"]="No se pudo eliminar la imagen".$target_path.$_POST['nombre'];

 }else 
  $result["respuesta"]="OK";      				



}else if($_POST["accion"]=="Upload"){

	if(!file_exists($target_path)) mkdir($target_path, 0777, true);  //si no existe archivo que genere la url
		if($_POST['subaccion']=="Socio"){ //Al Registrar los Socios pueden guardar mas de una foto
			
			$ext=$_FILES["Imagen"]['type'][0];
			$extension=explode("/",$ext);
			$FileName = $_FILES['Imagen']['name'][0];
			$FileTemp = $_FILES['Imagen']['tmp_name'][0];
			

		}/*else{
			$ext=$_FILES["Imagen"]['type'];
			$extension=explode("/",$ext);
			$FileName = $_FILES['Imagen']['name'];
			$FileTemp = $_FILES['Imagen']['tmp_name'];
		
		}*/
	
	
		

		if($FileName != "") {
			
		$FileExtension = strtolower(substr($FileName,strrpos($FileName,'.')+1));
      
			$FileSize = round($_FILES[$file]['size']/1024);

				
				$FileLocation = $target_path.basename($FileName);
				
				if( file_exists( $FileLocation ) ) unlink($target_path.rawurlencode(basename($FileName)));
				
					if(move_uploaded_file($FileTemp,$FileLocation)) { 

						 $query = array( 
					        array("query" => "select @clave:=(select ifnull(max(id),0)+1 from archivos)"),
					         array("query" => "insert into archivos values(@clave,concat('foto','_',@clave,'.".$FileExtension."'),'".$FileExtension."','".$FileName."',0,1)"),
					           array("query" => "select @clave clave" )   );
        				 $qry=$conexion->transaction($query);

        				  if($qry!=""){
        				  	
        				  	$result['nombre']="foto_".$qry[0].".".$FileExtension;	
        				  	rename ($FileLocation,$target_path."//".$result['nombre']);
        				  	$result['OK']="Se ha subido el Archivo Correctamente";	
							
							$result['clave']=$qry[0];
							$result['nombre_original']=$FileName;

							if($_POST['empleado']!=""){
        				  		$query = array( 
					        array("query" => "update empleados set foto='".$qry[0]."' where id_empleado=".$_POST['empleado']." "),
					           array("query" => "select ".$_POST['empleado']." clave" )   );
        				 			$qry=$conexion->transaction($query);
        				  	}else if($_POST['socio']!=""){
        				  		$query = array( 
					        array("query" => "update archivos set id_socio='".$_POST['socio']."' where id=".$qry[0]." "),
					           array("query" => "select '".$_POST['socio']."' clave" )   );
        				 			$qry=$conexion->transaction($query);

        				  	}	

        				  }else{
        				  	$result['error']="Ha Ocurrido un Error al subir el archivo. 1";
        				  }

						
					} 
					else
				   			$result['error']="Ha Ocurrido un Error al subir el archivo. 2";		
		
    }else{ $result['error']="Ha Ocurrido un Error al Subir el archivo. El Archivo Se encuentra vacios"; }


  
}

    echo array_to_json($result);

?>