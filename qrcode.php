<?include "BarcodeQR.php"; 

// set BarcodeQR object 
$qr = new BarcodeQR(); 
// create URL QR code 
$qr->text($_GET['txt']);
// display new QR code image 
$qr->draw();

?>