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
		  print_r($row);
         //echo "Col1: ".$row[0]."\n";

      }
                                
      sqlsrv_free_stmt($stmt);
   }

   sqlsrv_close($conn);

 echo "hello world!";
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
<head>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="navbar">
  <div class="navbar-inner" style="-webkit-border-radius: 0; -moz-border-radius: 0; border-radius: 0;">
    <div class="container">
      <!-- ... and so on ... -->