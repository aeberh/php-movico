<?php
$matches = file("export.txt", FILE_IGNORE_NEW_LINES);

importJevota();
importClubs($matches);
importTeams($matches);
importMatches($matches);

function importJevota() {
	echo "TRUNCATE `PingpongClub`;
TRUNCATE `PingpongGame`;
TRUNCATE `PingpongPlayer`;
TRUNCATE `PingpongTeam`;
	";
	echo "INSERT INTO `PingpongClub` VALUES('1', '031', 'Lanaken', 'T.T.C. Jevota', '', 'Biesweg 16', '3620 Gellik', '0', '089/71.45.35');<br/>";
}

function importMatches($matches) {
	echo "<br/>";
	foreach($matches as $match) {
		list($rec, $date, $time, $home, $out) = explode(",", $match);
		$homeParts = explode(" ", $home);
		$homeNo = $homeParts[0];
		$homeTeamNo = $homeParts[count($homeParts)-1];
		
		$outParts = explode(" ", $out);
		$outNo = $outParts[0];
		$outTeamNo = $outParts[count($outParts)-1];
		
		if($homeNo == "Vrij" || $outNo == "Vrij") {
			continue;
		}
		$homeNo = ($homeNo == "Lanaken") ? "031" : substr($homeNo, 2);
		$outNo = ($outNo == "Lanaken") ? "031" : substr($outNo, 2);
		list($dd, $mm, $yy) = explode("-", $date);
		list($hh, $nn) = explode(":", $time);
		$sqlDate = "20$yy-$mm-$dd $hh:$nn:00";
		$r = $rec == "R" ? "1" : "0";
		echo "INSERT INTO PingpongGame (`date`, `homeTeamId`, `outTeamId`, `homeTeamPts`, `outTeamPts`) VALUES ('$sqlDate', ".
			"(SELECT t.teamId FROM PingpongTeam t, PingpongClub c WHERE t.clubId=c.clubId AND c.`number`='$homeNo' AND t.`teamNo`='$homeTeamNo' AND t.recreation='$r' LIMIT 1), ".
			"(SELECT t.teamId FROM PingpongTeam t, PingpongClub c WHERE t.clubId=c.clubId AND c.`number`='$outNo' AND t.`teamNo`='$outTeamNo' AND t.recreation='$r' LIMIT 1), ".
			"0, 0);<br/>";
	}
}

function importClubs($matches) {
	echo "<br/>";
	foreach($matches as $matchStr) {
		list($rec, $date, $time, $home, $out) = explode(",", $matchStr);
		list($homeNo, $homeName, $nil) = explode(" ", $home, 3);
		list($outNo, $outName, $nil) = explode(" ", $out, 3);
		$teams[$homeNo] = $homeName;
		$teams[$outNo] = $outName;
	}
	foreach($teams as $no=>$name) {
		if($no != "Lanaken" && $no != "Vrij") {
			$n = substr($no, 2);
			echo "INSERT INTO PingpongClub (number, shortName, name) VALUES ('$n', '$name', '$name');<br/>";
		}
	}
}

function importTeams($matches) {
	echo "<br/>";
	foreach($matches as $matchStr) {
		list($rec, $date, $time, $home, $out) = explode(",", $matchStr);
		
		$homeParts = explode(" ", $home);
		$homeNo = $homeParts[0];
		$homeTeamNo = $homeParts[count($homeParts)-1];
		
		$outParts = explode(" ", $out);
		$outNo = $outParts[0];
		$outTeamNo = $outParts[count($outParts)-1];
		
		$recteams[$rec][$homeNo][$homeTeamNo] = $homeTeamNo;
		$recteams[$rec][$outNo][$outTeamNo] = $outTeamNo;
	}
	
	foreach($recteams as $rec=>$teams) {
		foreach($teams as $no=>$teamNos) {
			if($no == "Vrij") {
				continue;
			}
			foreach($teamNos as $teamNo) {
				$n = $no == "Lanaken" ? "031" : substr($no, 2);
				$r = $rec == "R" ? "1" : "0";
				echo "INSERT INTO PingpongTeam (clubId, teamNo, recreation) VALUES ((SELECT clubId from PingpongClub where number='$n' LIMIT 1), '$teamNo', '$r');<br/>";
			}
		}
	}
}
?>
<pre>
<?php 
print_r($teams);
?>
</pre>