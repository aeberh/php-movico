<?php
require_once("path.php");
session_start();

require_once("lib/error/runtime-errors.php");

set_exception_handler("handleException");
set_error_handler("handleError", E_ALL);

$dic = Dictionary::create("nl", "4x4");

$grid = new BoggleGrid(String::fromPrimitives(array(
	"N", "E", "A", "E", 
	"A", "L", "R", "F", 
	"N", "F", "S", "U", 
	"K", "K", "U", "R"
)));

$start = time();
$words = $dic->getPossibleWords($grid);
$duration = time()-$start;

?>
<ul>
	<?php
	foreach($words as $word) {
		?><li><?php echo $word?></li><?php
	}
	?>
</ul>
<p>Finished in <?php echo $duration?> seconds for all words in dictionary.</p>