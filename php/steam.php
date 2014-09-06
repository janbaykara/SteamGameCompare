<?
$steam_key = "2392AB299602516D6A8038EB5657670B";

// Take POST data
$users[][name] = htmlspecialchars(addslashes(strip_tags($_GET['u1'])));
$users[][name] = htmlspecialchars(addslashes(strip_tags($_GET['u2'])));

// Parse through user XML ( http://steamcommunity.com/id/maskedturk/?xml=1 )
$i = 0;
while ($i <= ( count($users) -1 )) {
	//Get owned games
	if(preg_match("/^[0-9]{17}$/",$users[$i][name])) {
		$users[$i][user_url] = "http://steamcommunity.com/profiles/".$users[$i][name];
	} else {
		$users[$i][user_url] = "http://steamcommunity.com/id/".$users[$i][name];
	}
	$gameXMLData = simplexml_load_file($users[$i][user_url]."/games?xml=1");
	
	foreach($gameXMLData->games->game as $game) {
		$storedGame = str_replace(array("<![CDATA[","]]>"),"",$game->name);
		$storedGame .= "######";
		$storedGame .= (string) $game->appID;
		
		$users[$i][gameXMLData][] = $storedGame;
	}
	$i++;
}

$users[2]['gameXMLData'] = array_intersect($users[0][gameXMLData], $users[1][gameXMLData]);

//header('Content-Type: application/json');

echo json_encode($users);
?>