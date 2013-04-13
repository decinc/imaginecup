<?php
@session_start();

require_once "dbconn.php";


$content = $_POST['content'];
$type = $_POST['type'];
$id = $_POST['id'];
$iType = 0;

if($type == "image")
  $iType = 1;
else if($type == "text")
  $iType = 0;

$tsql = "INSERT INTO [wall](Content,donateeID, type, currentTime) values('$content',$id,$iType, getDate())";

$stmt = sqlsrv_query($conn, $tsql);

   if ($stmt === false)
   {
     FatalError("Failed to query test table: ".$tsql);

   }
   else
   {                                
      sqlsrv_free_stmt($stmt);
   }

   sqlsrv_close($conn);

function FatalError($errorMsg)
{
    Handle_Errors();
    die($errorMsg."\n");
}
function Handle_Errors()
{
    $errors = sqlsrv_errors(SQLSRV_ERR_ERRORS);
	print_r($errors);
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
         print_r($errors[$i]);
      }
    }
}


?>

