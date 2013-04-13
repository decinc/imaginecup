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

<?if($is_login){?>

<script>

var id = <?=$_SESSION['id']?>;
var loginname = '<?=$_SESSION["loginid"]?>';
var tree;
var wall;
var islogin = true;
</script>
<?}else{?>
<script>
var id = 0;
var loginname = '';
var tree;
var wall;
var islogin = false;
</script>



<?}?>
<script>
var current_position = 0;
var max_position = 1;
var view_table;
view_table[0] = show_profilediv;
view_table[1] = show_walldiv;

</script>

		<script>	
			$(document).ready(function() {
				$('#windowTitleDialog').bind('show', function () {

					});


				init();

				});
			function closeDialog () {
				$('#windowTitleDialog').modal('hide'); 
				};
			function okClicked () {

				//ajax

				$.post('login.php',{id:document.getElementById ("xlId").value, pw : document.getElementById ("xlPw").value},function(data){
					if(data != "FAIL"){
						closeDialog();
						var d = JSON.parse(data);
						id = d.ID;
						loginname = d.loginid;
						islogin = true;
						load_treelist();
					}else{
						alert('login fail');
					}
				});
				};
function init(){
		
		$('#content > *').hide();
		if(!islogin)
		{
			$('#windowTitleDialog').modal('show'); 
		}else{
//로그인시
			load_treelist();
		}

}
function swap_showlist(int direction){
	current_position = direction;
	if(current_position < 0)
		current_position = max_position;

	view_table[current_position]();
}
function load_treelist(){
	$.get('treelist.php',function(dat){
		
		$('#leftmenu').html(dat);
	});	
}
function show_walldiv(){
		$('#walldiv').show();
		$('#profilediv').hide();
	$.get('walllist.php?id=' + treeIndex,function(data){
		wall = JSON.parse(data);
		$('#content-center-text').html('Wall' + tree.name);
		$('#walldiv').html("");
		$('#walldiv').append("<textarea></textarea>");
		for(i = 0; i < wall.length; i++){
			var str = "";
			str += "<div id = 'wall_text' class = 'wall_text'>";
			if(wall[i].type == 0)//letter
				str += wall[i].Content;
			else
				str += "<img src='" + wall[i].Content + "'/>";
			str += "</div>";
			$('#walldiv').append(str);
		}
	});	
}
function show_profilediv(){
		$('#walldiv').hide();
		$('#profilediv').show();
	$.get('treemenu.php?id=' + treeIndex,function(data){
		tree = JSON.parse(data);
		$('#content-center-text').html('Profile');
		$('#imgdiv').html("<img src='" + tree.ImageUrl + "'/>");

		$('#profile-description').html(tree.description);
	});
		
}

function select_treemenu(treeIndex){
		$('#content > *').show();

		show_profilediv();
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
			<div id='background' style='border:1'>
			<div id='leftmenu' style='display:inline-block'>



			</div>
			<div id = 'content'>
				<div id = 'content-left-arrow' style='display:inline' onclick='swap_showlist(-1)'>◀</div>
				<div id = 'content-center-text' style='display:inline'></div>
				<div id = 'content-right-arrow' style='display:inline' onclick='swap_showlist(1)'>▶</div>
				

				<div id = 'walldiv'>
					
				</div>
				<div id = 'profilediv'>
					<div id = 'imgdiv'>
					
					</div>
					<div id = 'profile-description'>

					</div>
				</div>
			</div>
			</div>
		</div>


</body>
</html>