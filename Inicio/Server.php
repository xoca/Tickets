<?php 
include_once("../libs/consultas.php"); 
include ('pagination.php');
$bd = new Consultas();
$sesion       = $_POST["sesion"];
$clave        = $_POST["clave"];
$claveModulo  = $_POST["clavemodulo"];
$accion       = $_POST["accion"];
$modulo       = $_POST["modulo"];  
$submodulo    = $_POST["submodulo"];
$Usucve       = $_POST["usucve"];


 
  if( $accion == "menu_horizontales" ){
    $html='<div class="list-group">';
    $menu=$bd->menu_horizontal(array($sesion,$claveModulo));
     while ($row = mysql_fetch_array($menu, MYSQL_BOTH)) {
        if($row['modsub']==0) $modulo=$row['moddesc'];
        if($row['modsub']!=0) $html.='<a href="#" class="list-group-item" id="'.$modulo.$row["modsub"].'" url="'.$row['modurl'].'" modulo="'.$modulo.'"  onclick="modulos(this)">'.$row['moddesc'].'</a>';       
      }

     $html.='</div>';
      $result["menu"] = $html;
      
  }

  if( $accion == "cerrar" ){
      $login=$bd->cerrarSesion($sesion);
      $result['resul']=$login;
      
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
       
  
    }


    if( $accion == "CambiarRol" ){
      $cadenaTbl = "";
    $clave = $clave == "" ? "0" : $clave;
    $res = $bd->DatosM("CargaRoles",$clave);
    $letras = array("N", "M", "E", "C", "R"); 
            
    $cadenaTbl .= "<thead class='thead-inverse'> <tr><td class='EncGrid' align='center'>MODULO</td><td class='EncGrid' align='center'>SUBMODULO</td>";
    $cadenaTbl .= "<td class='EncGrid' align='center'>ACCESO</td></thead>";
    
      
    $i=0;
    while($row = mysql_fetch_array($res[1])){
      $className = "CeldaGrid".($i++)%2;
      $cadenaTbl .= "<tr>";
      if( $row["ModSub"] == 0 ){
        $cadenaTbl .= "<td class=".$className." align='center'>".$row["ModNombre"]."</td>";
        for($j=0; $j<2; $j++)
          $cadenaTbl .= "<td class=".$className." align='center'></td>";
      }     
      else
      {
        $cadenaTbl .= "<td class=".$className."></td><td class=".$className." align='center'>".$row['SubNombre']."</td>";
        for ( $j=0; $j<1; $j++){
          $checked = substr_count($row["SegAccion"],$letras[$j]) > 0 ? "checked" : ""; 
          $cadenaTbl .= "<td class=".$className." align='center'><input type='checkbox' class='Ctext' name='".$row["ModCve"]."|".$row["ModSub"]."' id='".$letras[$j]."' ".$checked."></td>";
        }
      }
      $cadenaTbl .= "</tr>";
    }   
 

      $result['tabla']=$cadenaTbl;

         
   }


       if( $accion == "Eliminar" ){
       $tablas=count($_POST['tablas']);
        $query =  array("query" => "select @clave:=".$clave),
        if($permisos>0){
             for($i=0; $i<$tablas; $i++){
                $qrytabla=array("query"=>"delete from ".$tablas['tablas'][$i]." where id=@clave");
                array_push($query,$qrytabla);

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

         }

       
   }



 echo  array_to_json($result);

?>