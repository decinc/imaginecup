<?php
$hostname = "skugbj1ioa.database.windows.net"; //���� ip
$username = "decinc";  //db���� user
$password = "dbswlstn1!";  //db���� user password
$dbName = "decinc";  //odbc dns��
 
$mscon=mssql_connect($hostname,$username,$password) or DIE("DATABASE FAILED TO RESPOND."); 


mssql_select_db($dbName,$mscon) or DIE("Table unavailable"); 
echo mssql_get_last_message();

$q = mssql_query("select * from [dbo].[user]");
echo mssql_get_last_message();

echo $q;
while($res = mssql_fetch_array($q)){
	echo "loop";
	print_r($res);

}


//mssql_close($mscon);
?>