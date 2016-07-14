<?php
include("../libs/consultas.php");
$conexion=new Consultas();
$target_path = "..//../tickets//imagenes//".$_POST['clave']."//";  //se haga una carpeta por solicitud


	if(!file_exists($target_path)) mkdir($target_path);  //si no existe archivo que genere la url
	$file = 'Imagen';
	$FileName = $_FILES[$file]['name'];

		if($FileName != "") {
			
		$extencion = $_FILES[$file]['type'];
		$FileExtension = strtolower(substr($FileName,strrpos($FileName,'.')+1));
      
			$FileSize = round($_FILES[$file]['size']/1024);

				$FileTemp = $_FILES[$file]['tmp_name'];
				$FileLocation = $target_path.basename($FileName);
				
				if( file_exists( $FileLocation ) ) unlink($target_path.rawurlencode(basename($FileName)));
				
					if(move_uploaded_file($FileTemp,$FileLocation)) { 
						$result['OK']="Se ha subido el Archivo Correctamente";	
					} 
					else
				   			$result['error']="Ha Ocurrido un Error al subir el archivo.";		
		
    }else{ $result['error']="Ha Ocurrido un Error al Subir el archivo." }


      echo array_to_json($result);


?>