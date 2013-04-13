<?php
@session_start();

require_once "dbconn.php";


$id = $_GET['id'];
$tsql = "SELECT * FROM [tree] where ID = $id";

$stmt = sqlsrv_query($conn, $tsql);

   if ($stmt === false)
   {
     FatalError("Failed to query test table: ".$tsql);

   }
   else
   {
      if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
	  {
			echo json_encode($row);
			return;
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

