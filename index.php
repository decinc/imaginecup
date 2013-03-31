<?
require_once "dbconn.php";


$stmt = sqlsrv_query("select * from user");

while($row = sqlsrv_fetch_array($stmt)){
 print_r($row);
}
// while($row = mssql_fetch_array($r)){
//	print_r($row);
// }
 echo "hello world!";

?>