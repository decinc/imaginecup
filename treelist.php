<?php
@session_start();

require_once "dbconn.php";
?>
<meta charset='utf-8'/>
<ul class="nav nav-list">


<?

$id = $_SESSION['id'];
$tsql = "SELECT tr.* FROM [admin_tree] adt inner join [tree] tr on tr.ID = adt.donateeId where adt.adminId = $id";

$stmt = sqlsrv_query($conn, $tsql);

   if ($stmt === false)
   {
     FatalError("Failed to query test table: ".$tsql);

   }
   else
   {
      while($row = sqlsrv_fetch_array($stmt))
	  {
			//print_r($row);
			echo "<li><a href='#' onclick='select_treemenu($row[ID])'>".$row[name]."</a></li>";
	  }
                                
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
	//print_r($errors);
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

</ul>
