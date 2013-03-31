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
         echo "Col1: ".$row[0]."\n";
         echo "Col2: ".$row[1]."\n";
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

