<?php
@session_start();

require_once "dbconn.php";


$id = $_SESSION['id'];
$tsql = "SELECT tr.* FROM [admin_tree] adt inner join [tree] tr on tr.ID = adt.donateeId where adt.adminId = $id";
echo $tsql;

$stmt = sqlsrv_query($conn, $tsql);

   if ($stmt === false)
   {
     FatalError("Failed to query test table: ".$tsql);

	 echo print_r($_SESSION);
   }
   else
   {
      if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC))
	   {
			print_r($_SESSION);
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