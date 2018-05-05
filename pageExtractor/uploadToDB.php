<?php 
	header('Content-Type: text/html; charset=utf-8');
	$count = 10000;
	//item arrays create
	$itemName = array();
	$itemID = array();
	$statTrack = array();
	$exterior = array();
	$imageURL = array();
	$itemType = array();
	$itemGrade = array();
	
	//grab name, itemID, exterior, statTrack
	$handle = fopen("itemNameList.txt", "r");
	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
		$count = $count +1;
		$line = str_replace("â", "&#9733", $line);
		$line = str_replace("â¢", "&trade;", $line);
		//add name to array
		array_push($itemName, $line);
		array_push($itemID, $count);
		
		//check if the item is stat track and mark accordingly
		if(strstr($line, 'StatTrak')) {
			array_push($statTrack, 1);
		}
		else {
			array_push($statTrack, 0);
		}

		//check item exterior 
		
		if(strstr($line, 'Battle-Scarred')) {
			array_push($exterior, "Battle-Scarred");
		}
		elseif(strstr($line, 'Factory New')) {
			array_push($exterior, "Factory New");
		}
		elseif(strstr($line, 'Field-Tested')) {
			array_push($exterior, "Field-Tested");
		}

		elseif(strstr($line, 'Minimal Wear')) {
			array_push($exterior, "Minimal Wear");
		}
		elseif(strstr($line, 'Well-Worn')) {
			array_push($exterior, "Well Worn");
		}
		
		else {
			array_push($exterior, "N/A");
		}
		
	    }

	    fclose($handle);
	} else {
	    // error opening the file.
	} 
	
	$handle = fopen("itemImageList.txt", "r");
	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
		//add name to array
		array_push($imageURL, $line);

	    }

	    fclose($handle);
	} else {
	    // error opening the file.
	} 
	$handle = fopen("itemGradeList.txt", "r");
	if ($handle) {
	while (($line = fgets($handle)) !== false) {
		
		//check weapon type and add that weapon type to array
		if(strstr($line, "Rifle")) {
			if(strstr($line, "Sniper Rifle")) {
				array_push($itemType, "Sniper Rifle");
			}
			else {
				array_push($itemType, "Rifle");
			}
		}
		
		elseif(strstr($line, "Pistol")) {
			array_push($itemType, "Pistol");
		}
		elseif(strstr($line, "SMG")) {
			array_push($itemType, "SMG");
		}
		elseif(strstr($line, "Shotgun")) {
			array_push($itemType, "Shotgun");
		}
		elseif(strstr($line, "Sniper Rifle")) {
			array_push($itemType, "Sniper Rifle");
		}
		elseif(strstr($line, "Machinegun")) {
			array_push($itemType, "Machinegun");
		}
		elseif(strstr($line, "Knife")) {
			array_push($itemType, "Knife");
		}
		elseif(strstr($line, "Container")) {
			array_push($itemType, "Container");
		}
		elseif(strstr($line, "Sticker")) {
			array_push($itemType, "Sticker");
		}
		elseif(strstr($line, "Key")) {
			array_push($itemType, "Key");
		}
		elseif(strstr($line, "Music Kit")) {
			array_push($itemType, "Music Kit");
		}
		elseif(strstr($line, "Pass")) {
			array_push($itemType, "Pass");
		}
		elseif(strstr($line, "Gift")) {
			array_push($itemType, "Gift");
		}
		elseif(strstr($line, "Tag")) {
			array_push($itemType, "Tag");
		}
		else {
			array_push($itemType, "N/A");
		}
		
		//find item grade and mark in array
		if(strstr($line, "Consumer")) {
			array_push($itemGrade, "Consumer");
		}
		elseif(strstr($line, "Mil-Spec")) {
			array_push($itemGrade, "Mil-Spec");
		}
		elseif(strstr($line, "Industrial")) {
			array_push($itemGrade, "Industrial");
		}
		elseif(strstr($line, "Restricted")) {
			array_push($itemGrade, "Restricted");
		}
		elseif(strstr($line, "Classified")) {
			array_push($itemGrade, "Classified");
		}
		elseif(strstr($line, "Covert")) {
			array_push($itemGrade, "Covert");
		}
		elseif(strstr($line, "Base")) {
			array_push($itemGrade, "Base");
		}
		elseif(strstr($line, "High")) {
			array_push($itemGrade, "High");
		}
		elseif(strstr($line, "Remarkable")) {
			array_push($itemGrade, "Covert");
		}
		elseif(strstr($line, "Contraband")) {
			array_push($itemGrade, "Covert");
		}
		elseif(strstr($line, "Exotic")) {
			array_push($itemGrade, "Exotic");
		}
		else {
			array_push($itemGrade, "N/A");
		}
	
	}
			
	fclose($handle);
	} else {
	    // error opening the file.
	} 
	
	for($i=0; $i<count($itemName); $i++) {
		echo $itemID[$i] . " " .  $itemName[$i] . " StatTrack:" .  $statTrack[$i] . 
		" Exterior:" . $exterior[$i] . " Item Type:". $itemType[$i] . " Item Grade:" . $itemGrade[$i] ." <br>Image Url:" . $imageURL[$i];
		echo "<br>";
	}

	

?>
