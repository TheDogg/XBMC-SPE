<?php
/**********************************************************************/
/* Project Name.: XBMC-SPE							*/
/* GIT .........: https://github.com/TheDogg/XBMC-SPE			*/
/* File Name....: index.php							*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 21/03/2012 11:39:54 AM					*/
/**********************************************************************/
include('config.inc.php');
include('lib.inc.php');

// Call function parsexml() with specified XML file
parsexml("test.xml");

echo "Loaded playlist info:<br />";
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


dbconnect();
if ($playlisttype == 'tvshows'){
	choosedb($dbnamemusic);
}
if ($playlisttype == 'movies' or $playlisttype == 'tvshows' or $playlisttype == 'episodes' or $playlisttype == 'musicvideos'){
	choosedb($dbnamevideo);
}
//$result = mysql_query("SELECT * FROM genre WHERE strGenre like '%Children%'");
//while($row = mysql_fetch_array($result)){
//	echo $row['FirstName'] . " " . $row['LastName'];
//	echo "<br />";
//}
?>