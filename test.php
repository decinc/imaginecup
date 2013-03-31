<?php

   $serverName = "tcp:ProvideServerName.skugbj1ioa.database.windows.net,1433";
   $userName = 'decinc@skugbj1ioa';
   $userPassword = 'dbswlstn1!';
   $dbName = "decinc";
   $table = "tablePHP";



   $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true);

   sqlsrv_configure('WarningsReturnAsErrors', 0);
   $conn = sqlsrv_connect( $serverName, $connectionInfo);
   if($conn === false)
   {
     FatalError("Failed to connect...");
   }

   CreateTable($conn, $table, "Col1 int primary key, Col2 varchar(20)");

    
   $tsql = "INSERT INTO [$table] (Col1, Col2) VALUES (1, 'string1'), (2, 'string2')";
   $stmt = sqlsrv_query($conn, $tsql);
   if ($stmt === false)
   {
     FatalError("Failed to insert data into test table: ".$tsql);
   }
   sqlsrv_free_stmt($stmt);

   $tsql = "SELECT Col1, Col2 FROM [$table]";
   $stmt = sqlsrv_query($conn, $tsql);
   if ($stmt === false)
   {
     FatalError("Failed to query test table: ".$tsql);
   }
   else
   {
      while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC))
      {
         echo "Col1: ".$row[0]."\n";
         echo "Col2: ".$row[1]."\n";
      }
                                
      sqlsrv_free_stmt($stmt);
   }

   sqlsrv_close($conn);


function CreateTable($conn, $tableName, $dataType)
{
   $sql = "CREATE TABLE [$tableName] ($dataType)";
   DropTable($conn,$tableName);
   $stmt = sqlsrv_query($conn, $sql);
   if ($stmt === false)
   {
      FatalError("Failed to create test table: ".$sql);
   }
   sqlsrv_free_stmt($stmt);
}


function DropTable($conn, $tableName)
{
    $stmt = sqlsrv_query($conn, "DROP TABLE [$tableName]");
    if ($stmt === false)
    {
    }
    else
    {
      sqlsrv_free_stmt($stmt);
    }
}

function FatalError($errorMsg)
{
    Handle_Errors();
    die($errorMsg."\n");
}


function Handle_Errors()
{
    $errors = sqlsrv_errors(SQLSRV_ERR_ERRORS);
    $count = count($errors);
    if($count == 0)
    {
       $errors = sqlsrv_errors(SQLSRV_ERR_ALL);
       $count = count($errors);
    }
    if($count > 0)
    {
      for($i = 0; $i < $count; $i++)
      {
         echo $errors[$i]['message']."\n";
      }
    }
}

?>