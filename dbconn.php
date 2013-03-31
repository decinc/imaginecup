<?php
$hostname = "tcp:skugbj1ioa.database.windows.net"; //서버 ip
$username = "decinc@skugbj1ioa";  //db접근 user
$password = "dbswlstn1!";  //db접근 user password
$dbName = "decinc";  //odbc dns명
 
$conn = sqlsrv_connect($hostname, array("UID"=>$username, "PWD"=>$password, "Database"=>$dbName));

if($conn === false){
    die(print_r(sqlsrv_errors()));
}

//mssql_close($mscon);
?>