<?php
$hostname = "skugbj1ioa.database.windows.net"; //���� ip
$username = "decinc@skugbj1ioa";  //db���� user
$password = "dbswlstn1!";  //db���� user password
$dbName = "decinc";  //odbc dns��
 
$mscon=mssql_connect($hostname,$username,$password) or DIE("DATABASE FAILED TO RESPOND."); 


mssql_select_db($dbName,$mscon) or DIE("Table unavailable"); 



//mssql_close($mscon);
?>