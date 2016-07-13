 <?php 
function HTMLHeader($title)
{
    echo '<meta charset="utf-8">';
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
   // <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    echo '<meta name="description" content="">';
    echo '<meta name="author" content="">';
    echo '<link rel="icon" href="favicon.ico">';
    echo "<title>".$title."</title>";
    // <!-- Bootstrap core CSS -->
    echo '<link href="../boostrap/css/bootstrap.min.css" rel="stylesheet">';

  //  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  echo '<link href="../boostrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">';

   // <!-- Custom styles for this template -->
    echo '<link href="../boostrap/css/offcanvas.css" rel="stylesheet">
          <link href="../input/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">';

    // <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    //<!--[if lt IE 9]><script src="../../boostrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
   echo  '<script src="../boostrap/js/ie-emulation-modes-warning.js"></script>'.
    '<script src="../libs/jquery/jquery-1.9.1.min.js"></script>';
 
   echo  '<script src="../boostrap/js/bootstrap.min.js"></script>';
    //<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   echo '<script src="../boostrap/js/ie10-viewport-bug-workaround.js"></script>';
   echo '<script src="../boostrap/css/offcanvas.js"></script>';


  //  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    //<!--[if lt IE 9]>
    echo '<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
    echo  '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
    echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>';
  
   echo '<script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';
  
   echo '<script src="../input/js/fileinput.js" type="text/javascript"></script>
        <script src="../input/js/fileinput.min.js" type="text/javascript"></script>
        <script src="../input/js/locales/es.js" type="text/javascript"></script>
        ';
   echo '<script src="../input/themes/fa/theme.js"></script>
        <script src="../input/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
        <script src="../input/js/plugins/sortable.min.js" type="text/javascript"></script>
        <script src="../input/js/plugins/purify.min.js" type="text/javascript"></script>' ;    

   // <![endif]-->
 echo '</head>';

}


function footer(){
    echo '<hr>
     <footer class="container-fluid">
        <p>&copy; 2016 sistemas.</p>
      </footer>';

}


?>