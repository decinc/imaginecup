<?php
$hostname = "tcp:skugbj1ioa.database.windows.net"; //���� ip
$username = "decinc@skugbj1ioa";  //db���� user
$password = "dbswlstn1!";  //db���� user password
$dbName = "decinc";  //odbc dns��
 
$conn = sqlsrv_connect($hostname, array("UID"=>$username, "PWD"=>$password, "Database"=>$dbName));

if($conn === false){
    die(print_r(sqlsrv_errors()));
}

//mssql_close($mscon);
?>