 <?php 
function HTMLHeader($title)
{
    echo '<meta charset="utf-8">';
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';

   // <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    echo '<meta name="description" content="Sistema de Tickets">';
    echo '<meta name="author" content="">';
    echo '<link rel="icon" href="favicon.ico">';
    echo "<title>".$title."</title>";//<link href="../boostrap/css/bootstrap.min.css" rel="stylesheet">
    // <!-- Bootstrap core CSS -->
    echo '<link href="../boostrap/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">';

  //  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 // echo '<link href="../boostrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">';

   // <!-- Custom styles for this template -->
    echo '<link href="../boostrap/css/offcanvas.css" rel="stylesheet">
          <link href="../input/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
          <link rel="stylesheet" href="../boostrap/css/jquery-ui.css">';

    // <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    //<!--[if lt IE 9]><script src="../../boostrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
   echo  '<script src="../libs/jquery/jquery-1.9.1.min.js"></script>';
 
   echo  '<script src="../boostrap/js/bootstrap.min.js"></script>';
   echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>';
  
    //<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   ///<script src="../boostrap/js/bootstrap.min.js"></script>
   //echo '<script src="../boostrap/js/ie10-viewport-bug-workaround.js"></script>';
   echo '<script src="../boostrap/css/offcanvas.js"></script>';


  //  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    //<!--[if lt IE 9]>
  //  echo '<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
   // echo  '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
   // echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>';
   
   echo '<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';
   echo '<script src="../libs/js/jquery.validate.js"></script>';
  
   echo '<script src="../input/js/fileinput.js" type="text/javascript"></script>
        <script src="../input/js/fileinput.min.js" type="text/javascript"></script>
        <script src="../input/js/locales/es.js" type="text/javascript"></script>
        ';
   echo '<script src="../input/themes/fa/theme.js"></script>' ;    

   // <![endif]-->
 echo '</head>';

}


function footer(){
    echo '<hr>
     <footer class="container-fluid">
        <p>&copy; 2016 sistemas.</p>
      </footer>';

}


function HTMLOGIN($title)
{
    echo '<meta charset="utf-8">';
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';

   // <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    echo '<meta name="description" content="Sistema de Tickets">';
    echo '<meta name="author" content="">';
    echo '<link rel="icon" href="favicon.ico">';
    echo "<title>".$title."</title>";//<link href="../boostrap/css/bootstrap.min.css" rel="stylesheet">
    // <!-- Bootstrap core CSS -->
    echo '<link href="boostrap/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">';
 
    echo '<link rel="stylesheet" href="boostrap/css/jquery-ui.css">
        <link href="boostrap/css/offcanvas.css" rel="stylesheet">';

    echo  '<script src="libs/jquery/jquery-1.9.1.min.js"></script>';
 
    echo  '<script src="boostrap/js/bootstrap.min.js"></script>';
    echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>';
  
      
    echo '<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';
   
   

   // <![endif]-->
   echo '</head>';

}


?>