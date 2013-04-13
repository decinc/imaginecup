<?
require_once "dbconn.php";

$tsql = "SELECT * FROM [user]";
$stmt = sqlsrv_query($conn, $tsql);
   if ($stmt === false)
   {
     FatalError("Failed to query test table: ".$tsql);
   }
   else
   {
      while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC))
      {
		 // print_r($row);
         //echo "Col1: ".$row[0]."\n";

      }
                                
      sqlsrv_free_stmt($stmt);
   }

   sqlsrv_close($conn);

function FatalError($errorMsg)
{
    Handle_Errors();
    die($errorMsg."\n");
}
function Handle_Errors()
{
    $errors = sqlsrv_errors(SQLSRV_ERR_ERRORS);
	print_r($errors);
    $count = count($errors);
    if($count == 0)
    {
       $errors = sqlsrv_errors(SQLSRV_ERR_ALL);
       $count = count($errors);
    }
    if($count > 0)
    {
      for($i = 0; $i < $count; $i++)
      {
         print_r($errors[$i]);
      }
    }
}
?>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://static.scripting.com/github/bootstrap2/css/bootstrap.css" rel="stylesheet">
		<script src="http://static.scripting.com/github/bootstrap2/js/jquery.js"></script>
		<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-transition.js"></script>
		<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-modal.js"></script>

<title>Donee Admin</title>
<style>
			.divDemoBody  {
				width: 60%;
				margin-left: auto;
				margin-right: auto;
				margin-top: 100px;
				}
			.divDemoBody p {
				font-size: 18px;
				line-height: 140%;
				padding-top: 12px;
				}
			.divDialogElements input {
				font-size: 18px;
				padding: 3px; 
				height: 32px; 
				width: 500px; 
				}
			.divButton {
				padding-top: 12px;
				}
</style>
<script>
			$(document).ready(function() {
				$('#windowTitleDialog').bind('show', function () {
					//document.getElementById ("xlInput").value = document.title;
					
					});
				init();
				});
			function closeDialog () {
				$('#windowTitleDialog').modal('hide'); 
				};
			function okClicked () {
				document.title = document.getElementById ("xlInput").value;
				closeDialog ();
				};
function init(){
		$('#windowTitleDialog').modal('show'); 
		alert('asdfsd');
}


</script>




</script>
</head>


<div id='content'>



</div>
<body>

			<div id="windowTitleDialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
				<div class="modal-header">
					<a href="#" class="close" data-dismiss="modal">&times;</a>
					<h3>Login</h3>
					</div>
				<div class="modal-body">
					<div class="divDialogElements">
						<input class="xlarge" id="xlInput" name="xlInput" type="text" />
						</div>
					</div>
				<div class="modal-footer">
					<a href="#" class="btn" onclick="closeDialog ();">Cancel</a>
					<a href="#" class="btn btn-primary" onclick="okClicked ();">OK</a>
					</div>
				</div>
			<div class="divButtons">
				<a data-toggle="modal" href="#windowTitleDialog" class="btn btn-primary btn-large">Set Window Title</a>
				</div>
			</div>


</body>
</html>