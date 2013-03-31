<?
include "dbconn.php";



 $r = mssql_query("select * from user");

 while($row = mssql_fetch_array($r)){
	print_r($row);
 }
 echo "hello world!";

?>