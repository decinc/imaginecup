<?
@session_start();
$is_login = false;
if($_SESSION['id'])
	$is_login = true;

?>
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" charset='utf-8'>
		<link href="http://static.scripting.com/github/bootstrap2/css/bootstrap.css" rel="stylesheet">
		<script src="http://static.scripting.com/github/bootstrap2/js/jquery.js"></script>
		<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-transition.js"></script>
		<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-modal.js"></script>

<title>Donee Admin</title>
<style>
			#profilediv{
				  padding: 8.5px;
  margin: 0 0 9px;
  font-size: 12.025px;
  line-height: 18px;
  background-color: #f5f5f5;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
			}
			.block-class{
				  padding: 8.5px;
  margin: 0 0 9px;
  font-size: 12.025px;
  line-height: 18px;
  background-color: #f5f5f5;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;

			}
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
			.imgdiv{
				width:220px;
				margin:50px;
			}
			.imgdiv img{
				width:200px;
				height:200px;
				border:10px solid #aaa;
				border-bottom:45px solid #aaa;
				-webkit-box-shadow:3px 3px 3px #666;
				-moz-box-shadow: 3px 3px 3px #666;
				box-shadow: 3px 3px 3px #666;
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
function show_walldiv(){
		$('#walldiv').html("");
		
		$('#walldiv').show();
		$('#profilediv').hide();
	$.get('walllist.php?id=' + current_treeIndex,function(data){
		wall = JSON.parse(data);
		$('#content-center-text').html(tree.name + "'s wall");
		$('#walldiv').append("<pre><div id = 'wall_Text'><textarea id='wall_content' rows='3'></textarea><p class='text-right'><button class = 'btn btn-primary' onclick='post_wall(\"image\")'>Image</button><button class = 'btn btn-primary' onclick='post_wall(\"text\")'>Text</button></p></div></pre>");
		for(i = 0; i < wall.length; i++){
			var str = "";
			str += "<pre><blockquote>";
			if(wall[i].type == 0)//letter
				str += wall[i].Content;
			else
				str += "<img src='" + wall[i].Content + "' width='150px' height='150px' class='img-polaroid'/>";
			str += "<small>" + wall[i].currentTime.date + "</small>";
			str += "</blockquote></pre>";
			$('#walldiv').append(str);
		}
	});	
}
function post_wall(strtype){
	var iType = 0;
	if(strtype == 'image'){
		iType = 1;
	}else{
		iType = 0;
	}

	var strcontent = $('#wall_content').val();
	$.post('wallpost.php',{type:strtype,content:strcontent,id:current_treeIndex},function(data){
		show_walldiv();
	
	});
	

}
function show_profilediv(){
	$('#imgdiv').html("");
	$('#profile-description').html("");
		$('#walldiv').hide();
		$('#profilediv').show();
	$.get('treemenu.php?id=' + current_treeIndex,function(data){
		tree = JSON.parse(data);
		$('#content-center-text').html('Profile');
		$('#imgdiv').html("<img src='" + tree.ImageUrl + "' class='img-polaroid'/>");
		
		$('#profile-description').html("<pre>" + tree.description + "</pre>");
	});
		
}
var view_table = new Array();
view_table[0] = show_profilediv;
view_table[1] = show_walldiv;
var current_treeIndex;
function swap_showlist(direction){
	current_position += direction;
	if(current_position < 0)
		current_position = max_position;
	if(current_position > max_position)
		current_position = 0;
	console.log(current_position);
	view_table[current_position]();
}
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

function load_treelist(){
	$.get('treelist.php',function(dat){
		$('#leftmenu').html(dat);
	});	
}


function select_treemenu(treeIndex){
		$('#content > *').show();
		current_position = 0;
		current_treeIndex = treeIndex;
		$('li').removeClass();
		$('#tree_' + treeIndex).addClass('active');
		show_profilediv();
}
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
	</div><!--windowTitleDialog-->

	<div id='background' style="width:700px;margin:auto;padding:auto;">
	
		<div id='topmenu' style="block;margin-top:0px;">
		<pre>
			Create QRCode | Signin | write | add | edit
		</pre>
		</div>
		<div id='bottommenu' class = 'block-class'>
			<div id='leftmenu' style="display:inline-block;margin-right:30px;vertical-align: top;margin-top:17px;">



			</div>
			<div id = 'content' style="display:inline-block">


			<div id = 'content-left-arrow' style='display:inline' onclick='swap_showlist(-1)'>◀</div>
			<div id = 'content-center-text' style='display:inline'></div>
			<div id = 'content-right-arrow' style='display:inline' onclick='swap_showlist(1)'>▶</div>
		

			<div id = 'walldiv'></div>
			<div id = 'profilediv'>
				<div id = 'imgdiv' class='imgdiv'></div>
			
				<div id = 'profile-description' style='width:500px;'><textarea></textarea></div>

			</div><!--profilediv-->

		</div><!--bottommenu-->
	</div><!--background-->
<div>
</body>
</html>