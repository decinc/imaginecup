<?php
$hostname = "tcp:skugbj1ioa.database.windows.net,1433"; //���� ip
$username = "decinc@skugbj1ioa";  //db���� user
$password = "dbswlstn1!";  //db���� user password
$dbName = "decinc";  //odbc dns��
 sqlsrv_configure('WarningsReturnAsErrors', 0);

$conn = sqlsrv_connect($hostname, array("UID"=>$username, "PWD"=>$password, "Database"=>$dbName, "MultipleActiveResultSets"=>true));

if($conn === false){
    die(print_r(sqlsrv_errors()));
}

//mssql_close($mscon);
?>