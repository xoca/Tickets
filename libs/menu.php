<?php 
include_once("../libs/consultas.php");


function menu_($sesion){
$db = new Consultas();
	$menu = $db->menu($sesion);
  $first = 0;
  $html='';
  $modulo="";
   while ($row = mysql_fetch_array($menu, MYSQL_BOTH)) {
        if(  $row["modsub"] == 0 ){
        if($first!=0)  $html.="</ul></li>";
          $html.=  '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$row["moddesc"].'</a>
          <ul class="dropdown-menu">';
          $modulo=$row["moddesc"];
        }

        else{
         $html.= '<li><a href="#" id="'.$modulo.'-'.$row["modsub"].'" modcve="'.$row["modcve"].'" modulo="'.$modulo.'" accion="'.$row['modurl'].'" onclick="menu_Horizontales(this);">'.$row["moddesc"].'</a></li>';
        }  

        $first++;                   
    }
     return $html;
}


  ?>
