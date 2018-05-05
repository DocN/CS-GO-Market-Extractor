<?php
	$seconds = 1000;
	set_time_limit($seconds);
	for($i = 1; $i<4096; $i++) {
		echoURL($i);
	}
	
	function echoURL($pageNumber) {
		$found = false;
		$html = file_get_contents("http://192.168.1.122:888/items/output{$pageNumber}.html");
		//Create a new DOM document
		$dom = new DOMDocument;

		//Parse the HTML. The @ is used to suppress any parsing errors
		//that will be thrown if the $html string isn't valid XHTML.
		@$dom->loadHTML($html);

		//Get all links. You could also use any other tag name here,
		//like 'img' or 'table', to extract other tags.
		$links = $dom->getElementsByTagName('span');
		$images = $dom->getElementsByTagName('img');
		$itemGrades = $dom->getElementsByTagName('div');
		//Iterate over the extracted links and display their URLs
		foreach ($links as $link){		
		    //Extract and show the "href" attribute.
			$className = $link->getAttribute('class');
			if($className == "market_listing_item_name") {
				if($found == false) {
					$found = true;
					$name = $link->nodeValue;
					$file = 'itemNameList.txt';
					$name = $name .PHP_EOL;
					
					file_put_contents($file, $name, FILE_APPEND | LOCK_EX);
					echo $pageNumber . $name;
					echo "<br>";
				}
			}
		}
		foreach ($images as $image) {
			$imageUrl = $image->getAttribute('src');
			if(strpos($imageUrl, '360fx360f') !== FALSE) {
				echo $imageUrl;
				echo "<br>";
				$file = 'itemImageList.txt';
				$imageUrl = $imageUrl .PHP_EOL;
				
				file_put_contents($file, $imageUrl, FILE_APPEND | LOCK_EX);
			}
		}
		
		
		foreach ($itemGrades as $itemGrade) {
			$className = $itemGrade->getAttribute('id');
			if($className == "largeiteminfo_item_type") {
				$finalGrade = $itemGrade->nodeValue;
				echo $finalGrade;
				echo "<br>";
				$file = 'itemGradeList.txt';
				$finalGrade = $finalGrade .PHP_EOL;
				
				file_put_contents($file, $finalGrade, FILE_APPEND | LOCK_EX);
			}
		}
	}
?>