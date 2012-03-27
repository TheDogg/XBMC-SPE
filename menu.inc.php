<?php
/**********************************************************************/
/* Project Name.: XBMC-SPE							*/
/* GIT .........: https://github.com/TheDogg/XBMC-SPE			*/
/* File Name....: menu.inc.php						*/
/* Author.......: Sebastien Gascon						*/
/* Author Email.: sebastien.gascon@gmail.com				*/
/* Created On...: 27/03/2012 12:25:50 AM					*/
/**********************************************************************/

echo "<a href=\"index.php?playlist=movies.xml\">movies</a> - ";
echo "<a href=\"index.php?playlist=tvshows.xml\">tvshows</a> - ";
echo "<a href=\"index.php?playlist=episodes.xml\">episodes</a> - ";
echo "<br />";
echo "<br />";
if (empty($_GET[itemid])){
	exit;
}

?>