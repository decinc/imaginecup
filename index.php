<?
require_once "dbconn.php";


$stmt = sqlsrv_query("select * from user");
  if ($stmt === false)
   {
     FatalError("Failed to query test table: ");
   }
while($row = sqlsrv_fetch_array($stmt)){
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
?>

