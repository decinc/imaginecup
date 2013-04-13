<?
@session_start();
$is_login = false;
if($_SESSION['id'])
	$is_login = true;
?>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" charset='utf-8'>
		<link href="http://static.scripting.com/github/bootstrap2/css/bootstrap.css" rel="stylesheet">
		<script src="http://static.scripting.com/github/bootstrap2/js/jquery.js"></script>
		<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-transition.js"></script>
		<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-modal.js"></script>

<title>Donee Admin</title>
<style>
			.divDemoBody  {
				width: 60%;
				margin-left: auto;
				margin-right: auto;
				margin-top: 100px;
				}
			.divDemoBody p {
				font-size: 18px;
				line-height: 140%;
				padding-top: 12px;
				}
			.divDialogElements input {
				font-size: 18px;
				padding: 3px; 
				height: 32px; 
				width: 500px; 
				}
			.divButton {
				padding-top: 12px;
				}
</style>

<script>
<?
if(!$is_login){
?>
var loginid = <?=$_SESSION['id']?>
var loginname = <?=$_SESSION['loginid']?>

<?}?>
			$(document).ready(function() {
				$('#windowTitleDialog').bind('show', function () {
//					document.getElementById ("xlId").value = 'ID';
//					document.getElementById ("xlPw").value;
					
					});


				init();

				});
			function closeDialog () {
				$('#windowTitleDialog').modal('hide'); 
				};
			function okClicked () {

				//ajax

				$.post('login.php',{id:document.getElementById ("xlId").value, pw : document.getElementById ("xlPw").value},function(dat){
					if(dat == "SUCCESS"){
						closeDialog();
						load_treelist();
					}else{
						alert('login fail');
					}
				});
				};
function init(){
<?
if(!$is_login){
?>
		$('#windowTitleDialog').modal('show'); 
<?}else{?>
//로그인시
	load_treelist();


<?}?>
}
function load_treelist(){
	$.get('treelist.php',function(dat){
		$('#content').html(dat);
	});	
}

</script>




</script>
</head>



<body>

			<div id="windowTitleDialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
				<div class="modal-header">
					<a href="#" class="close" data-dismiss="modal">&times;</a>
					<h3>Login</h3>
					</div>
				<div class="modal-body">
					<div class="divDialogElements">
						<input class="xlarge" id="xlId" name="xlId" type="text" placeholder="ID"/>
						<input type="password" id="xlPw" name="xlPw" class="input-small" placeholder="Password">
						</div>
					</div>
				<div class="modal-footer">
					<a href="#" class="btn" onclick="closeDialog ();">Cancel</a>
					<a href="#" class="btn btn-primary" onclick="okClicked ();">Login</a>
					</div>
				</div>
			<div id='content'>



			</div>
			</div>


</body>
</html>