<?php
include_once("../libs/consultas.php");
$conexion=new Consultas();
$target_path = "../imagenes/tickets/";  //se haga una carpeta por solicitud
 

if($_POST["accion"]=="Delete"){
if($_POST['key']!=""){ 
if(unlink($target_path.$_POST['nombre'])){

if($_POST['key']=="") $upFoto="select '1' clave";
$upFoto=" delete from archivos where id='".$_POST['key']."' ";

$query = array( 
		  array("query" => $upFoto),
		array("query" => "select '".$_POST['key']."' clave" )   );
        				 $qry=$conexion->transaccion($query);
        				 $result["respuesta"]="OK";


 }else $result["error"]="No se pudo eliminar la imagen".$target_path.$_POST['nombre'];

 }else 
  $result["respuesta"]="OK";      				



}else if($_POST["accion"]=="Upload"){

	if(!file_exists($target_path)) mkdir($target_path, 0777, true);  //si no existe archivo que 			
			$ext=$_FILES["Imagen"]['type'][0];
			$extension=explode("/",$ext);
			$FileName = $_FILES['Imagen']['name'][0];
			$FileTemp = $_FILES['Imagen']['tmp_name'][0];
			
	
		

		if($FileName != "") {
			
		$FileExtension = strtolower(substr($FileName,strrpos($FileName,'.')+1));
      
			$FileSize = round($_FILES[$file]['size']/1024);

				
				$FileLocation = $target_path.basename($FileName);
				
	if( file_exists( $FileLocation ) ) unlink($target_path.rawurlencode(basename($FileName)));
				
		if(move_uploaded_file($FileTemp,$FileLocation)){ 
				
 		$query = array(array("query" => "select @clave:=(select ifnull(max(id),0)+1 from archivos)"),
				array("query" => "insert into archivos values(@clave,concat('foto_',@clave,'.".$FileExtension."'),'".$FileExtension."','".$FileName."',0)"),
			    array("query" => "select @clave clave" )   );
 		
        		$qry=$conexion->transaccion($query); 
        		
        		  if($conexion->errorQry==""){
							$result['nombre']="foto_".$qry[0].".".$FileExtension;	
							$result['clave']=$qry[0];
							$result['nombre_original']=$FileName;
							rename ($FileLocation,$target_path."//".$result['nombre']);
        				  	$result['OK']="Se ha subido el Archivo Correctamente";	
				}else
				$result['error']="Ha Ocurrido un Error al subir el archivo. 2".$conexion->errorQry;
						
						
	}else  $result['error']="Ha Ocurrido un Error al subir el archivo. 2";		
		
 }else  $result['error']="Ha Ocurrido un Error al Subir el archivo. El Archivo Se encuentra vacios"; 

    


  
}

    echo array_to_json($result);

?>