<?php 
include_once("../libs/consultas.php"); 
include ('pagination.php');
$bd = new Consultas();
$sesion       = $_POST["sesion"];
$clave      = $_POST["clave"];
$claveModulo      = $_POST["clavemodulo"];
$accion     = $_POST["accion"];
$modulo     = $_POST["modulo"];  
$submodulo  = $_POST["submodulo"];
$Usucve    = $_POST["usucve"];


 
  if( $accion == "menu_horizontales" ){
    $html='<div class="list-group">';
    $menu=$bd->menu_horizontal(array($sesion,$claveModulo));
     while ($row = mysql_fetch_array($menu, MYSQL_BOTH)) {
        if($row['modsub']==0) $modulo=$row['moddesc'];
        if($row['modsub']!=0) $html.='<a href="#" class="list-group-item" id="'.$modulo.$row["modsub"].'" url="'.$row['modurl'].'" modulo="'.$modulo.'"  onclick="modulos(this)">'.$row['moddesc'].'</a>';       
      }

     $html.='</div>';
      $result["menu"] = $html;
      echo array_to_json($result);
  }

  if( $accion == "cerrar" ){
      $login=$bd->cerrarSesion($sesion);
      $result['resul']=$login;
      echo  array_to_json($result);
  }





   if( $_POST['accion'] == "Paginador" ){
       $buscar=array("buscar"=>$_POST['parametros']);
        $page = (isset($_REQUEST['NumPagina']) && !empty($_REQUEST['NumPagina']))?$_REQUEST['NumPagina']:1;
        $qryName=$_POST['qry'];
        $per_page = 10; //la cantidad de registros que desea mostrar
        $limite_pag = 4; //brecha entre páginas después de varios adyacentes
        $offset = ($page - 1) * $per_page;

        ///Funcion Paginador en consultas nombredelQry,parametrosdelQry,parametrosAdicionales
        $grid=$bd->Paginador($qryName,array($offset,$per_page,$buscar),array($page,$limite_pag,$per_page,$qryName,$modulo));
        $resultado=explode("::",$grid);
      
     
        $result['paginador']=$resultado[1];
        $result['datos']=$resultado[0];
        //$result['qry']=$resultado[2];
        echo  array_to_json($result);
  
    }





?>