<?php
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);

for($i=2; $i<=49; $i++) {
	if(in_array($i, array(37, 38, 39, 40, 42, 44, 45, 46, 47, 48, 49, 2, 3, 4, 5, 7, 9, 10, 11, 12, 15, 16))) {
		importWeek($i);
	}
}

function importWeek($w) {
	$weekNo = $w<10 ? "0$w" : "$w";
	$page = file_get_contents("http://competitie.vttl.be/index.php?menu=3&type=4&club_id=218&sel_week=$weekNo");
	$pos = 0;
	for($i=0; $i<13; $i++) {
		echoLine($page, $pos);
	}
}

function echoLine($page, &$pos) {
	$recOrNot = getBetweenNextTwo($page, "<td class=\"DBTable_first\">", "</td>", $pos);
	$rec = strpos($recOrNot, "Vrije Tijd") === false ? "NR" : "R";
	$date = getBetweenNextTwo($page, "<td class=DBTable>", "</td>", $pos);
	$time = getBetweenNextTwo($page, "<td class=DBTable>", "</td>", $pos);
	$nil = getBetweenNextTwo($page, "<td class=DBTable>", "</td>", $pos);
	$home = getBetweenNextTwo($page, "<td class=DBTable>", "</td>", $pos);
	$out = getBetweenNextTwo($page, "<td class=DBTable>", "</td>", $pos);	
	echo "$rec,$date,$time,$home,$out<br/>";
}

function test() {
	$input = "adl;kad;lasd <a>blabla</a> asl;dkaskjd <a>testje</a>";
	$pos = 0;
	echo getBetweenNextTwo($input, "<a>", "</a>", $pos);
	echo "<br/>";
	echo getBetweenNextTwo($input, "<a>", "</a>", $pos);
}

function getBetweenNextTwo($page, $start, $end, &$mpos) {
	$startIndex = getEndPos($page, $start, $mpos);
	$result = getStringUntil($page, $startIndex, $end);
	$mpos = getEndPos($page, $result, $startIndex);
	return $result;
}

function getStringUntil($page, $startPos, $untillString) {
	$endPos = strpos($page, $untillString, $startPos);
	return substr($page, $startPos, $endPos-$startPos);
}

function getEndPos($page, $string, $startPos=0) {
	$start = strpos($page, $string, $startPos);
	return $start+strlen($string);
}
?>