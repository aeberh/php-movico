<?
ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL);

$words = file("bean/games/boggle/data/glossary/en", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
$words = array_unique($words);
sort($words);

$fp = fopen("bean/games/boggle/data/glossary/en_4x4", 'w');
foreach($words as $word) {
	if(strlen($word) < 3 || strlen($word)>16 || !ctype_alpha($word)) {
		continue;
	}
	fwrite($fp, strtoupper($word)."\n");
}
fclose($fp);
?>