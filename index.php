<? 
require_once("php/config.php");

if(isset($_GET['u1'])) { $u1 = $_GET['u1']; } else { $u1 = "MaskedTurk"; }
if(isset($_GET['u2'])) { $u2 = $_GET['u2']; } else { $u2 = "Woldy"; }

?>
<?=SCAFFOLD_HEAD?>
<h1><? echo TTL_HOME; ?></h1>
	<div id="select_users">
		<br><center><small><i>NB: Requires a *PUBLIC* steam community url nickname (e.g. steamcommunity.com/id/MaskedTurk) OR a profile number (e.g. http://steamcommunity.com/profiles/76561198001124335/)</i></small></center>
		<form id="select_users_form" name="select_users_form">
			<div id="select_user_0" style="float: left; width: 50%;">
				<div style="padding: 20px 50px;">
					<h3>Player 1</h3>
					<input type="text" name="u1" id="user_one_input" value="<?=$u1 ?>" />
				</div>
			</div>
			<div id="select_user_1" style="float: left; width: 50%;">
				<div style="padding: 20px 50px;">
					<h3>Player 2</h3>
					<input type="text" name="u2" id="user_two_input" value="<?=$u2 ?>" />
				</div>
			</div>
			<div style="clear: both; width: 100%;"></div>
			<div style="padding: 0px 50px;">
				<center><input type="submit" name="submit" /></center>
			</div>
		</form>
	</div>
	<div id="display_games">
		<input type="text" name="search" id="search_games" placeholder="Search games..." />
		<div id="dp_0" style="float: left; width: 50%;">
			<div style="padding: 20px 50px;"></div>
		</div>
		<div id="dp_1" style="float: left; width: 50%;">
			<div style="padding: 20px 50px;"></div>
		</div>
		<div id="dp_loading"></div>
	</div>
	<script>
	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));
	  }
	}).blur();
	
	function asc_sort(a, b){
		return ($(b).text()) < ($(a).text()) ? 1 : -1;    
	}

	$("#select_users_form").on("submit", function (e) {
		e.preventDefault();
		// Submit requests to php/steam.php
		$.ajax({
			type: "GET",
			url: "php/steam.php",
			data: $("#select_users_form").serialize(),
			beforeSend: function() {
				// Loading icon
				$('#dp_loading').html('<center><img src="http://www.apc.com/tools/ups_selector/resource/images/loading.gif" /></center>');
			},
			success: function(data) {
				var json = $.parseJSON(data);
				var arrayOfJSON = [];
				
				// Per user, list games
				for (i = 0; i < (json.length); ++i) {
					arrayOfJSON[i] = [];
					
					$('#dp_'+i+' > div').html("<h2>"+json[i].name+"'s games</h2>"+"<ul class='game_data_"+i+"'></ul>");
					$.each( json[i].gameXMLData, function(n, game) {
						var thisGame = game.split('######');
						arrayOfJSON[i].push(thisGame);
						
						var thisLI = $('<li>');
						thisLI.html(thisGame[0]);
						thisLI.attr("appid",thisGame[1]);
												
						$('#dp_'+i+' ul').append(thisLI);
					});
				}
				
				// Compare values
				$.each(arrayOfJSON[arrayOfJSON.length-1], function(z, game) {
					// Take the PHP's 'matched games' sub array
					
					// Find matches and add class .same
					$("li[appid='"+game[1]+"']").addClass("same");
					
					// (And then push all the .same LIs per UL to the top, in alphabetical order.
					$('#display_games ul').each(function () {
						$(this).prepend($(this).children("li.same").sort(asc_sort));
					});
				});
				
				$("#display_games li:not(.same)").css("background","");
								
				// Stop loading icon
				$('#dp_loading').html('');		
	
				$(document).ready(function() {
					// Hover mouse functionality 
					$("#display_games li.same").hover(
						function() {
							var li = $(this);
							
							$("li.same").filter(function() { return $(this).attr("appid") === li.attr("appid") }).toggleClass("highlight");
						}, function() { 
							var li = $(this);
							
							$("li.same").filter(function() { return $(this).attr("appid") === li.attr("appid") }).toggleClass("highlight");
						}
					);
	
					// Link functionality
					$("#display_games li").click (function() {
						var gameURL = "http://store.steampowered.com/app/"+$(this).attr("appid")+"/";
						window.open(gameURL);
					});
		
					// Search functionality
					$("#search_games").keyup (function() {
						$("#display_games li:not(:contains('"+$(this).val()+"'))").addClass("hide");
						$("#display_games li:contains('"+$(this).val()+"')").removeClass("hide");
					});
				});
			}
		});
	});
	
	// PHP
	<? if(isset($_GET['u2'])) {?>
		$("#select_users_form").trigger("submit");
	<?}?>
</script>
<?=SCAFFOLD_FOOT?>