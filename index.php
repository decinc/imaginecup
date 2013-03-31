<?
require_once "dbconn.php";


$stmt = sqlsrv_query("select * from user");
  if ($stmt === false)
   {
     FatalError("Failed to query test table: ");
   }
while($row = sqlsrv_fetch_array($conn, $stmt)){
 print_r($row);
}
// while($row = mssql_fetch_array($r)){
//	print_r($row);
// }
 echo "hello world!";
function FatalError($errorMsg)
{
    Handle_Errors();
    die($errorMsg."\n");
}
function Handle_Errors()
{
    $errors = sqlsrv_errors(SQLSRV_ERR_ERRORS);
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
         echo $errors[$i]['message']."\n";
      }
    }
}
?>

