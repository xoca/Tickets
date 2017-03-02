<?php

class Querys {
	
	


		function Consultas($qry,$parametros){

				switch($qry){
		   		case "tipoUsuario":
		   		return $qry="select TipoCve clave,TipoDesc descripcion from tipousuario where Tipoestatus=1";
		   		break;

		   		case "ListadoEmpleados":
		   		$qry="select emp_id,concat(emp_nombre,' ',emp_apellidos) nombre,pu_descripcion,AreaDesc,if(emp_status=1,'Activo','INACTIVO')  from empleados e
						left join area a on e.id_area=a.AreaCve
						left join puestos p on e.id_puesto=p.pu_id
                        left join usuarios u on e.id_usuario=u.UsuCve where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  concat(emp_nombre,' ',emp_apellidos) like '%".$parametros[2]['buscar']['nombre']."%'"; 
				return  $qry.="order by concat(emp_nombre,' ',emp_apellidos)  limit ".$parametros[0].",".$parametros[1];
		   		
		   		break;

		   		case "ListadoEmpleadosCount":
		   			$qry="select count(*) numero from empleados e left join area a on e.id_area=a.AreaCve
						left join puestos p on e.id_puesto=p.pu_id
                        left join usuarios u on e.id_usuario=u.UsuCve where 1=1";
		   	if($parametros[2]['buscar']['nombre']!="") $qry.= " and  concat(emp_nombre,' ',emp_apellidos) like '%".$parametros[2]['buscar']['nombre']."%'"; 
				return $qry;

		   		break;

		   		case "ListadoClientes":
		   		$qry="select cl_id,concat(cl_nombre,' ',cl_apellidos) nombre,cl_correo,cl_rfc,if(cl_status=1,'ACTIVO','INACTIVO') estatus from clientes where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  concat(cl_nombre,' ',cl_apellidos) like '%".$parametros[2]['buscar']['nombre']."%'"; 
				$qry.="order by concat(cl_nombre,' ',cl_apellidos)  limit ".$parametros[0].",".$parametros[1];
		   		return $qry;

		   		case "ListadoClientesCount":
		   		$qry="select count(*) numero from clientes where 1=1";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  concat(cl_nombre,' ',cl_apellidos) like '%".$parametros[2]['buscar']['nombre']."%'"; 
			
		   		return $qry;

		   		case "Usuarios":
		   		return $qry="select * from usuarios where UsuCve=".$parametros[0];
		   		break;

		   		case "Area":
		   		return $qry="select AreaCve,AreaDesc from area where AreaEstatus=1";
		   		break;

		   		case "cboPuestos":
		   		return $qry="select pu_id,pu_descripcion nombre from puestos where pu_status=1";
		   		break;

		   		case "cboTipoUsuario":
		   		return $qry="select TipoCve,TipoDesc from tipousuario where Tipoestatus=1";
		   		break;


		   		case "DatosEmpleados":
		   		return $qry="select e.*,UsuNombre,UsuMail,UsuTipo,UsuPassword from empleados e
						left join area a on e.id_area=a.AreaCve
						left join puestos p on e.id_puesto=p.pu_id
                        left join usuarios u on e.id_usuario=u.UsuCve
							where emp_id=".$parametros[0];
		   		break;

		   		case "DatosCliente":
		   		return $qry="select c.*,UsuNombre,UsuMail,UsuTipo,UsuPassword from clientes c
						    left join usuarios u on c.id_usuario=u.UsuCve
							where cl_id=".$parametros[0];
		   		break;


		   		case "Servicios":
		   		return $qry=" select *
							from servicios A
							left join servicios_det B on A.id=B.ser_categoria and ser_cliente=".$parametros[0]."
							where cat_status=1 group by id ";
		   		break;

		   		case "ListadoServicios":
		   		$qry=" select id,cat_nombre,if(cat_status=1,'ACTIVO','INACTIVO') from servicios where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  cat_nombre like '%".$parametros[2]['buscar']['nombre']."%'"; 
				$qry.=" order by cat_nombre  limit ".$parametros[0].",".$parametros[1];
		   		return $qry;
		   		break;

		   		case "ListadoServiciosCount":
		   		$qry=" select count(*) numero from servicios where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  cat_nombre like '%".$parametros[2]['buscar']['nombre']."%'"; 
			
		   		return $qry;

		   		break;

		   		case "DatosServicios":
		   		return $qry=" select * from servicios where id=".$parametros[0];
		   		break;

		   		case "ListadoDepartamento":
		   		$qry=" select AreaCve,AreaDesc,Areacorreo,if(AreaEstatus=1,'ACTIVO','INACTIVO') from area where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  AreaDesc like '%".$parametros[2]['buscar']['nombre']."%'"; 
				$qry.=" order by AreaDesc  limit ".$parametros[0].",".$parametros[1];
		   		return $qry;
		   		break;

		   		case "ListadoDepartamentoCount":
		   		$qry=" select count(*) numero from area where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  AreaDesc like '%".$parametros[2]['buscar']['nombre']."%'"; 
				
				return $qry;
		   		break;

		   		case "DatosDepartamento":
		   		return $qry=" select * from area where AreaCve=".$parametros[0];
		   		break;


		   		case "ListadoRoles":
		   		$qry=" select RolCve,RolDesc,if(RolActivo=1,'Activo','INACTIVO') from roles where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  RolDesc like '%".$parametros[2]['buscar']['nombre']."%'"; 
				$qry.=" order by RolDesc  limit ".$parametros[0].",".$parametros[1];
		   	
				return $qry;
				
		   		break;

		   		case "ListadoRolesCount":
		   		$qry=" select count(*) numero from area where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  RolDesc like '%".$parametros[2]['buscar']['nombre']."%'"; 
				return $qry;
				break;


				case "CargaRoles":
				return $qry=" select A.ModCve, A.ModSub, SegAccion,
								(select ModDesc from modulos where ModCve = A.ModCve and ModSub=0) ModNombre,
								(select ModDesc from modulos where ModCve = A.ModCve and A.ModSub = ModSub) SubNombre
								from 
								(select ModCve, ModSub, SegAccion from rolesdet where RolCve=".$parametros[0]."
								union
								select ModCve, ModSub, '' SegAccion from modulos C where not exists
								(select ModCve, ModSub, SegAccion from rolesdet D where RolCve=".$parametros[0]." and 
								C.ModCve = D.ModCve and C.ModSub = D.ModSub)) A order by ModNombre, ModSub, SubNombre ";
				break;

				case "DatosRol":
				return $qry="select * from roles where RolCve=".$parametros[0]." ";
				break;

				case "LUsuarios":
		   		$qry=" select UsuCve,UsuNombre,UsuMail,RolDesc,if(UsuActivo=1,'ACTIVO','INACTIVO') 
					   from usuarios u,roles tu where u.UsuTipo=tu.Rolcve  ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  UsuNombre like '%".$parametros[2]['buscar']['nombre']."%'"; 
				$qry.=" order by UsuNombre  limit ".$parametros[0].",".$parametros[1];
		   	
				return $qry;
				
		   		break;

		   		case "LUsuariosCount":
		   		$qry=" select count(*) numero from usuarios where 1=1 ";
		   		if($parametros[2]['buscar']['nombre']!="") $qry.= " and  UsuNombre  like '%".$parametros[2]['buscar']['nombre']."%'"; 
				return $qry;
				break;

				case "cboRol":
				 return $qry=" select RolCve,RolDesc from roles where RolActivo=1 ";
				break;


				case "CargaAccesos":
				return $qry=" select A.ModCve, A.ModSub, Accion SegAccion,
								(select ModDesc from modulos where ModCve = A.ModCve and ModSub=0) ModNombre,
								(select ModDesc from modulos where ModCve = A.ModCve and A.ModSub = ModSub) SubNombre
								from 
								(select ModCve, ModSub, Accion from seguridad where UsuCve=".$parametros[0]."
								union
								select ModCve, ModSub, '' Accion from modulos C where not exists
								(select ModCve, ModSub, Accion from seguridad D where UsuCve=".$parametros[0]." and 
								C.ModCve = D.ModCve and C.ModSub = D.ModSub)) A order by ModNombre, ModSub, SubNombre ";
				break;




		   		


		   		}








		}

}


?>