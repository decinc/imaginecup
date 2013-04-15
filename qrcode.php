<?include "BarcodeQR.php"; 
include "dbconn.php";


$shopid = $_GET['store'];
$keys = $_GET['keys'];
$points = $_GET['point'];
$description = $_GET['description'];


$tsql = "insert into [keytable](keys, store_session, points, regdate, is_used, description) values('$keys',$shopid,$points,getDate(),'N','$description')";

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

// set BarcodeQR object 
$qr = new BarcodeQR(); 
// create URL QR code 
$qr->text($keys);
// display new QR code image 
$qr->draw();

?>