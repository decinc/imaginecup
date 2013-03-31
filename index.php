<?
require_once "dbconn.php";

$tsql = "SELECT * FROM [user]";
$stmt = sqlsrv_query($conn, $tsql);
   if ($stmt === false)
   {
     FatalError("Failed to query test table: ".$tsql);
   }
   else
   {
      while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC))
      {
		  print_r($row);
         //echo "Col1: ".$row[0]."\n";

      }
                                
      sqlsrv_free_stmt($stmt);
   }

   sqlsrv_close($conn);

 echo "hello world!";
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
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/less.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap-1.0.0.min.css">

</head>

<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#">Project Name</a>
      <div class="nav-collapse">
        <ul class="nav">
          <li class="active"><a href="#"><i class="icon-home icon-white"></i> Home</a></li>
          <li><a href="#">Link</a></li>
          <li><a href="#">Link</a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right" action="">
          <input type="text" class="search-query span2" placeholder="Search">
        </form>
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->


<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li class="divider"></li>
    <li class="nav-header">Nav header</li>
    <li><a href="#">Separated link</a></li>
    <li><a href="#">One more separated link</a></li>
  </ul>
</li>

<ul class="nav pull-right">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utility <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="#">Item 1</a></li>
      <li><a href="#">Item 2</a></li>
      <li><a href="#">Item 3</a></li>
    </ul>
  </li>
</ul>
</body>

</html>