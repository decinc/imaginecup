<?
$hostname = "skugbj1ioa.database.windows.net"; //서버 ip
$username = "decinc";  //db접근 user
$password = "dbswlstn1!";  //db접근 user password
$dbName = "decinc";  //odbc dns명
 
$mscon=MSSQL_CONNECT($hostname,$username,$password) or DIE("DATABASE FAILED TO RESPOND."); 
mssql_select_db($dbName,$mscon) or DIE("Table unavailable"); 


//mssql_close($mscon);
?>