<?php
/**********************************************************************/
/* Project Name.: XBMC-SPE							*/
/* GIT .........: https://github.com/TheDogg/XBMC-SPE			*/
/* File Name....: index.php							*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 21/03/2012 11:39:54 AM					*/
/**********************************************************************/


$xml = simplexml_load_file("test.xml");

// Store the smart playlist type in a variable ($playlisttype)
$playlistattribute = $xml->attributes();
$playlisttype = $playlistattribute["type"];

// Set $i counter to Zero
$i = 0;
foreach($xml->children() as $child)
  {
  	// Store the Smart Playlist Name in a variable ($playlistname)
  	if ($child->getName() == 'name'){
  		$playlistname = $child;
  	}
  	// Store the Smart Playlist Matching in a variable ($playlistmatch)
  	if ($child->getName() == 'match'){
  		$playlistmatch = $child;
  	}
  	// Store the Rules Attributes and Values in an array, fields($rulefield), operators ($ruleoperator), values ($rulevalue)
  	if ($child->getName() == 'rule'){
  		$ruleattribute = $child->attributes();
  		$rulefield[] = $ruleattribute["field"];
  		$ruleoperator[] = $ruleattribute["operator"];
  		$rulevalue[] = $child;
  		// Increase $i counter by One
  		$i++;
  	}
  	// Store the Smart Playlist Limit in a variable ($playlistlimit)
  	if ($child->getName() == 'limit'){
  		$playlistlimit = $child;
  	}
  	// Store the Order Attribute and Value, direction($orderdirection), value ($ordervalue)
  	if ($child->getName() == 'order'){
  		$orderattribute = $child->attributes();
  		$orderdirection = $orderattribute["direction"];
  		$ordervalue = $child;
  	}
}
echo "Playlist Type: " . $playlisttype. "<br />";
echo "Playlist Name: " . $playlistname. "<br />";
echo "Playlist Match: " . $playlistmatch. "<br />";
for ($j = 0; $j < $i; $j++){
	echo "Rule " .$j." field: " . $rulefield[$j]. "<br />";
	echo "Rule " .$j." operator: " . $ruleoperator[$j]. "<br />";
	echo "Rule " .$j." value: " . $rulevalue[$j]. "<br />";
}
echo "Playlist Limit: " . $playlistlimit. "<br />";
echo "Playlist Order Direction: " . $orderdirection. "<br />";
echo "Playlist Order Value: " . $ordervalue. "<br />";
?>