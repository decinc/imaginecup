<?php
$hostname = "skugbj1ioa.database.windows.net"; //���� ip
$username = "decinc";  //db���� user
$password = "dbswlstn1!";  //db���� user password
$dbName = "decinc";  //odbc dns��
 

 if (!extension_loaded("sqlsrv")) {
  die("sqlsrv extension not loaded");
 }

$mscon=mssql_connect($hostname,$username,$password) or DIE("DATABASE FAILED TO RESPOND."); 


mssql_select_db($dbName,$mscon) or DIE("Table unavailable"); 

$q = mssql_query("select * from user");
echo $q;
while($res = mssql_fetch_array($q)){
	print_r($res);

}


//mssql_close($mscon);
?>