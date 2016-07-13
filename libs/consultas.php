<?php
	date_default_timezone_set('America/Mexico_City'); 
	class Consultas{		
	
	

		var $server = "localhost";
		var $database = "ticket";		
		var $user = "root";
		var $password = "root";
	
	
		var $db;
		
		
		function Consultas()
		{	
			
				$this->db = mysql_connect( $this->server, $this->user, $this->password);		
				$x = mysql_set_charset('utf8', $this->db);
		
			if( !$this->db ){
				echo mysql_error();
				return;
			}
		
			$result = mysql_select_db( $this->database, $this->db );
			if( !$result ){
				echo mysql_error( $this->db );				
				return;
			}
			
					
		}

		function verificaUsuario($parametros)
		{	
			$query = "select UsuCve,concat(UsuNombre,' ',UsuApellidos) Nombre from usuarios U where UsuMail = '".$parametros[0]."' and UsuPassword = '".$parametros[1]."' and UsuActivo = '1'";
			$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
			return $fila = mysql_fetch_row($result);			
		}


		function DatosUsuarios($parametros)
		{	
			$query = "select U.UsuCve,concat(UsuNombre,' ',UsuApellidos) Nombre from usuarios U,sesion s where U.UsuCve=s.UsuCve and s.SesCve ='".$sid."' ";
			$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
			return $fila = mysql_fetch_row($result);			
		}

		function menu($sesion){	
			$query = "select modcve, modsub, moddesc, modurl, modorden from (
			 select A.modcve, A.modsub, A.moddesc, A.modurl,A.modorden
			 from modulos A , seguridad B, sesion C where SesCve='".$sesion."'
			 and B.usucve = C.usucve and B.modcve = A.modcve
			 and B.modsub = A.modsub and A.modurl != ''  and modactivo = '1'
			  ) A
			 group by modcve, modsub, moddesc, modurl order by  modcve, modsub";
			
			$result = mysql_query($query,$this->db) or die('Consulta fallida: ' . mysql_error());
			return $result;

		}

		function creaSesion($parametros){
			$qry  = "delete from sesion where UsuCve = ".$parametros[0].";";
			$qry .= "insert into sesion values('".$parametros[1]."', ".$parametros[0].", '".$parametros[2]."', '".$parametros[3]."');";
			
		}

		function CerrarSesion($sesion){
			$query  = "delete from sesion where SesCve ='".$sesion."';";
			$result=mysql_query($query,$this->db);
			if($result>0){
				return "OK";
			}else
				return "NOK";
		}

		function menu_horizontal($parametros){	
			$query = "  select * from (
			select A.modcve, A.modsub, A.moddesc, A.modurl,A.modorden
			 from modulos A , seguridad B, sesion C where SesCve='".$parametros[0]."'
			 and B.usucve = C.usucve and B.modcve = A.modcve
			 and B.modsub = A.modsub and A.modurl != '' and A.modsub != 0 and modactivo = '1'
             and a.ModCve='".$parametros[1]."'
             union
             select '".$parametros[1]."' modcve,0 modsub,moddesc,modurl,modorden from modulos where modcve='".$parametros[1]."' and modsub=0) as A order by modsub";
            		
			$result = mysql_query($query,$this->db) or die('Consulta fallida: ' . mysql_error());
			return $result;

		}

		function ModificaUsuarios($clave){
			$usuarios=$this->Querys("Usuarios",array($clave));
			$consulta=mysql_query($usuarios,$this->db) or die("Ha ocurrido un error al buscar los datos".mysql_error());
			
			if(mysql_num_rows($consulta)>0){
				return $datos=mysql_fetch_array($consulta);
			}else{
				
				return "Ha Ocurrido un Error con los datos del Usuario";
			}

		}
		

		function verificaSesion($sid)
		{
			$query = "select * from sesion A where SesCve = '".$sid."'";
			$result = mysql_query($query,$this->db) or die('Consulta fallida: ' . mysql_error());
			if ( mysql_num_rows( $result ) > 0 )
			{
				$permisos = mysql_fetch_array( $result);
				return true;
			}
			else{
				echo '<meta http-equiv="refresh" content="2;url=index.php" />';
				echo "<div class='page-header'><h1>Sesion Invalida, Favor de Iniciar Sesion </h1></div>";
				
				exit();
			} 
		}
		
		

	  	
		function generaCombo( $qryName, $selected, $parametros)
		{			
			
			$qry=$this->Querys($qryName,$parametros);
			$consulta=mysql_query($qry,$this->db) or die("Ha ocurrido un error al buscar los datos".mysql_error());
			$cboResultado="";
		if ( mysql_num_rows( $consulta ) > 0 ){
			
				while($row=mysql_fetch_array($consulta)){
					$cboResultado .= "<option ".($selected == $row[0] ? "selected" : "")." value='".$row[0]."'>".$row[1]."</option>";
				}
				return $cboResultado;
			}
				
	
		}

			///Funcion llenara los campos para los listados de la funcion Edita de inicio.js
			function generaGrid($qryName,$parametrosqry,$varqry){			
			
			$qry=$this->Querys($qryName,$parametrosqry);
			//print "-".$qry."-";
			$numrows=0;
			$consulta=mysql_query($qry,$this->db) or die("Ha ocurrido un erro".mysql_error());
			$campos=mysql_num_fields($consulta);
			$count_query   = mysql_query("select count(*) numero FROM usuarios ",$this->db);
			if ($row= mysql_fetch_array($count_query)){$numrows = $row['numero'];}
			$total_pages = ceil($numrows/$varqry[2]);
			$pagin=$this->paginate('',$varqry[0], $total_pages,$varqry[1]);
					
			$grid="<tr>";
			if ( mysql_num_rows( $consulta ) > 0 ){
				while($row=mysql_fetch_array($consulta)){
					for($i=0;$i<$campos;$i++){
					//siempre el primer registro contendra la clave le pondremos la Url de Edicion
						if($i==0){
			$grid.= "<td><a href='#' id='".$row[$i]."' modulo='".$varqry[3]."' accion='Modificar' clave='".$row[$i]."' onclick='Editar(this)' >".$row[$i]."</a></td>";
						}else
						$grid.= "<td>".$row[$i]."</td>";
					}
					$grid.="</tr><tr>";
				}

			}
				$grid.="</tr>";
				//Envio los datos de la tabla y del Paginador
				return $grid."::".$pagin;

				
	
		}

			function begin(){
		      $null = mysql_query("START TRANSACTION", $this->db);
		      return mysql_query("BEGIN", $this->db);
		   }

		   function commit(){
		      return mysql_query("COMMIT", $this->db);
		   }
   
		   function rollback(){
		      return mysql_query("ROLLBACK", $this->db);
		   }

		   function transaction($q_array){
		         $retval = 1;

		      $this->begin();

		         foreach($q_array as $qa){
		           
		            $result = mysql_query($qa['query'], $this->db) or die('Ha ocurrido un error en la consulta'.mysql_error().$qa['query']);
		             if($result==0){
		            	$retval = 0;
		            }
		             
		         }

		      if($retval == 0){
		         $this->rollback();
		         return false;
		      }else{
		         $this->commit();
		         return true;
		      }
		   }


		function Querys($qry,$parametros){
		   	switch($qry){
		   		case "tipoUsuario":
		   		return $qry="select TipoCve clave,TipoDesc descripcion from tipousuario where Tipoestatus=1";
		   		break;

		   		case "ListadoUsuarios":
		   		return $qry="select UsuCve clave,concat(UsuNombre,' ',UsuApellidos) nombre,UsuMail correo from usuarios order by UsuCve LIMIT ".$parametros[0].",".$parametros[1];
		   		break;

		   		case "Usuarios":
		   		return $qry="select * from usuarios where UsuCve=".$parametros[0];
		   		break;

		   		case "Area":
		   		return $qry="select AreaCve,AreaDesc from area where AreaEstatus=1";
		   		break;

		   		case "Prioridad":
		   		return $qry="select PrioCve,PrioDesc from prioridad where PrioEstatus=1";
		   		break;
		   		
		   		}
			
			}



	
function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out = '<ul class="pagination pagination-large">';
	
	// anteriores 

	if($page==1) {
		$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	} else if($page==2) {
		$out.= "<li><span><a href='javascript:void(0);' onclick='CargarFiltro(1)'>$prevlabel</a></span></li>";
	}else {
		$out.= "<li><span><a href='javascript:void(0);' onclick='CargarFiltro(".($page-1).")'>$prevlabel</a></span></li>";

	}
	
	// primero 
	if($page>($adjacents+1)) {
		$out.= "<li><a href='javascript:void(0);' onclick='CargarFiltro(1)'>1</a></li>";
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "<li><a>...</a></li>";
	}

	// cantidad de paginas

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class='active'><a>$i</a></li>";
		}else if($i==1) {
			$out.= "<li><a href='javascript:void(0);' onclick='CargarFiltro(1)'>$i</a></li>";
		}else {
			$out.= "<li><a href='javascript:void(0);' onclick='CargarFiltro(".$i.")'>$i</a></li>";
		}
	}

	// si hay muchos registros

	if($page<($tpages-$adjacents-1)) {
		$out.= "<li><a>...</a></li>";
	}

	// Atras

	if($page<($tpages-$adjacents)) {
		$out.= "<li><a href='javascript:void(0);' onclick='CargarFiltro($tpages)'>$tpages</a></li>";
	}

	// siguiente pagina

	if($page<$tpages) {
		$out.= "<li><span><a href='javascript:void(0);' onclick='CargarFiltro(".($page+1).")'>$nextlabel</a></span></li>";
	}else {
		$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	}
	
	$out.= "</ul>";
	return $out;
}
			
		
	}



 function array_to_json( $array ){

			  if( !is_array( $array ) ){
			    return false;
			  }

			  $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
			  if( $associative ){

			    $construct = array();
			    foreach( $array as $key => $value ){

			      // We first copy each key/value pair into a staging array,
			      // formatting each key and value properly as we go.

			      // Format the key:
			      if( is_numeric($key) ){
			        $key = "key_$key";
			      }
			      $key = "\"".addslashes($key)."\"";

			      // Format the value:
			      if( is_array( $value )){
			        $value = array_to_json( $value );
			      } else if( !is_numeric( $value ) || is_string( $value ) ){
			        $value = "\"".addslashes($value)."\"";
			      }

			      // Add to staging array:
			      $construct[] = "$key:$value";
			    }

			    // Then we collapse the staging array into the JSON form:
			    $result = "{".implode(",",$construct )."}";

			  } else { // If the array is a vector (not associative):

			    $construct = array();
			    foreach( $array as $value ){

			      // Format the value:
			      if( is_array( $value )){
			        $value = array_to_json( $value );
			      } else if( !is_numeric( $value ) || is_string( $value ) ){
			        $value = "\"".addslashes($value)."\"";
			      }

			      // Add to staging array:
			      $construct[] = $value;
			    }

			    // Then we collapse the staging array into the JSON form:
			    $result = "[".implode(",",$construct )."]";
			  }

			  return $result;
}



			

?>
