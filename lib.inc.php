<?php
/**********************************************************************/
/* Project Name.: XBMC-SPE							*/
/* GIT .........: https://github.com/TheDogg/XBMC-SPE			*/
/* File Name....: lib.inc.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 22/03/2012 11:21:04 AM					*/
/**********************************************************************/

/** Establishing the DB Connection **/
function dbconnect(){
	global $dbhost, $dbuser, $dbpass, $con, $dbname;
	$con = mysql_connect($dbhost, $dbuser, $dbpass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
}

function choosedb($dbname){
	/** Selecting the good DB **/
	mysql_select_db($dbname) or die(mysql_error());
}

function dbclose(){
	global $conn;
	mysql_close($conn);
}

function parsexml($xmlfile){
	global $i, $playlisttype, $playlistname, $playlistmatch, $rulefield, $ruleoperator, $rulevalue,  $playlistlimit, $orderdirection, $ordervalue;
	// Load supplied XML file
	$xml = simplexml_load_file($xmlfile);
	// Store the smart playlist type in a variable ($playlisttype)
	$playlistattribute = $xml->attributes();
	$playlisttype = $playlistattribute["type"];
	// Set $i counter to Zero
	$i = 0;
	foreach($xml->children() as $child){
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
}
?>