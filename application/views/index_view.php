<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Datatables CRUD with Code Igniter, Bootstrap, jQuery</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
      <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
       <link rel="stylesheet" type="text/css" href="assets/css/dataTables.tableTools.css">
		<style>
		body { font-size: 140%; }
    div.DTTT { margin-bottom: 0.5em; float: right; }
    div.dataTables_wrapper { clear: both; }
		</style>
  </head>
  <body>
  <div class="container">
    <h1><a href="<?=base_url()?>">Datatables CRUD with Code Igniter, Bootstrap, jQuery</a></h1>
    
      <?=$main_content?>
    </div>  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="assets/js/dataTables.tableTools.js"></script> 
    <script src="assets/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>
     <script type="text/javascript" language="javascript" >
	
	$(document).ready(function(){
      <?=$add_js?>
   });
			
		</script>
  </body>
</html>