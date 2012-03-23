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
// Set variables database queries based on playlist type (<smartplaylist type=>)
if ($playlisttype == 'music'){
	choosedb($dbnamemusic);
	
	$maintableyear = "";
}
if ($playlisttype == 'movies'){
	choosedb($dbnamevideo);
	$maintable = "movie";
	$maintablename = "c00";
	$maintableyear = "c07";
	$genrelinktable = "genrelinkmovie";
	$genreitemid = "idMovie";
	$querytable3 = "movie";
}
if ($playlisttype == 'tvshows'){
	choosedb($dbnamevideo);
	$maintable = "tvshow";
	$maintablename = "c00";
	$maintableyear = "";
	$genrelinktable = "genrelinktvshow";
	$genreitemid = "idShow";
	// Set joins for tvshow specific
	$join = "join tvshowlinkepisode as TLE on MT.".$genreitemid." = TLE.".$genreitemid."
	join episode as E on TLE.idepisode = E.idepisode";
}
if ($playlisttype == 'episodes'){
	choosedb($dbnamevideo);
	$maintable = "episode";
	$maintablename = "c00";
	$maintableyear = "";
	$querytable2 = "movie";
	$querytable3 = "movie";
}
 if ($playlisttype == 'musicvideos'){
	choosedb($dbnamevideo);
}

// Set rule attributes
for ($j = 0; $j < $i; $j++){
	// Set $queryoperatorandvalue
		// Case contains
		if ($ruleoperator[$j] == 'contains'){
			$queryoperatorandvalue = "like '%".$rulevalue[$j]."%'";
		}
		// Case doesnotcontains
		if ($ruleoperator[$j] == 'doesnotcontain'){
			$queryoperatorandvalue = "not like '%".$rulevalue[$j]."%'";
		}
		// Case is
		if ($ruleoperator[$j] == 'is'){
			$queryoperatorandvalue = "= '".$rulevalue[$j]."'";
		}
		// Case isnot
		if ($ruleoperator[$j] == 'isnot'){
			$queryoperatorandvalue = "!= '".$rulevalue[$j]."'";
		}
		// Case startswith
		if ($ruleoperator[$j] == 'startswith'){
			$queryoperatorandvalue = "like '".$rulevalue[$j]."%'";
		}
		// Case endswith
		if ($ruleoperator[$j] == 'endswith'){
			$queryoperatorandvalue = "like '%".$rulevalue[$j]."'";
		}
		// Case lessthan
		if ($ruleoperator[$j] == 'lessthan'){
			$queryoperatorandvalue = "< '".$rulevalue[$j]."'";
		}
		// Case greaterthan
		if ($ruleoperator[$j] == 'greaterthan'){
			$queryoperatorandvalue = "> '".$rulevalue[$j]."'";
		}
		// Case after
		// Case before
		// Case inthelast
		// Case notinthelast
	
	// Set $queryorderdir
		// Case ascending
		if ($orderdirection == "ascending"){
			$queryorderdir = "ASC";
		}
		// Case descending
		if ($orderdirection == "descending"){
			$queryorderdir = "DESC";
		}
	// Set $queryorder
		// Case random
		if ($ordervalue == "random"){
			$queryorder = "ORDER BY RAND()".$queryorderdir."";
		}
		// Case year
		// Case genre
		// Case time
		// Case filename
		// Case path
		// Case playcount
		// Case lastplayed
		// Case inprogress
		// Case rating
		// Case plot
		// Case plotoutline
		// Case mpaarating
		// Case status
		// Case votes
		// Case director
		// Case actor
		// Case studio
		// Case numepisodes
		// Case numwatched
		// Case writers
		// Case airdate
		// Case episode
		// Case season
		// Case tvshow
		// Case episodetitle
		// Case videoresolution
		// Case audiochannels
		// Case videocodec
		// Case audiocodec
		// Case audiolanguage
		// Case subtitlelanguage
		// Case videoaspect
		// Case playlist
	// Set $querylimit
	$querylimit = "LIMIT ".$playlistlimit."";
		
	// Set SQL query
		// Case year
		if ($rulefield[$j] == 'year'){
			$sqlquery = "SELECT ".$maintablename." FROM ".$maintable." WHERE ".$maintableyear." ".$queryoperatorandvalue."";
		}
		// Case genre
		if ($rulefield[$j] == 'genre'){
			$sqlquery = "SELECT ".$maintablename." from genre as G
					join ".$genrelinktable." as GLT on G.idgenre = GLT.idgenre
					join ".$maintable." as MT on GLT.".$genreitemid."= MT.".$genreitemid."
					".$join."
					WHERE strGenre ".$queryoperatorandvalue." ".$queryorder." ".$querylimit."";
		}
		// Case time
		// Case filename
		// Case path
		// Case playcount
		// Case lastplayed
		// Case inprogress
		// Case rating
		// Case plot
		// Case plotoutline
		// Case mpaarating
		// Case status
		// Case votes
		// Case director
		// Case actor
		// Case studio
		// Case numepisodes
		// Case numwatched
		// Case writers
		// Case airdate
		// Case episode
		// Case season
		// Case tvshow
		// Case episodetitle
		// Case videoresolution
		// Case audiochannels
		// Case videocodec
		// Case audiocodec
		// Case audiolanguage
		// Case subtitlelanguage
		// Case videoaspect
		// Case playlist
}

// Debug
echo $sqlquery;
echo "<br />";
// END Debug

$result = mysql_query($sqlquery);

while($row = mysql_fetch_array($result)){
	echo $row['c00'];
	echo "<br />";
}
?>