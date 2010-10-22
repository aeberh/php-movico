<html>
	<head>
		<title>
			<?php echo get_class($e)?>
		</title>
		<style type="text/css">
			#errors {
				border: 1px solid red;
				background: #FFD9D9;
				padding: 15px;
				font: 12px Tahoma;	
				color: gray;			
			}
			
			#message {
				color: red;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div id="errors">
			<span id="message"><u><?=get_class($e)?></u>: <?=$e->getMessage()?>!</span>
			<?=printTrace($e)?>
		</div>
	</body>
</html>
<?php
function printTrace($exception) {
	$trace = $exception->getTrace();
	$result = "<ol>";
	foreach($trace as $step) {
		$result.="<li>".printStep($step)."</li>";
	}
	return $result."</ol>";
}

function printStep($step) {
	$result = "<b>".$step["function"]."</b>(".createParameterList($step["args"]).")</b> in ";
	if(empty($step["file"])) {
		return $result."<b>".$step["class"]."</b>.";
	} else {
		return $result."<b>".stripPathAndExtension($step["file"])."</b> on line <b>".$step["line"]."</b>.";
	}
}

function createParameterList($argList) {
	$args = array();
	foreach($argList as $arg) {
		$el = $arg;
		if(is_object($arg)) {
			$el = "&lt;".get_class($arg)."&gt;";
		}
		if(is_array($arg)) {
			if(empty($arg)) {
				$type = "";
			} else {
				$firstEl = current($arg);
				$type = gettype($firstEl);
				if("object" == $type) {
					$type = get_class($firstEl);
				}
			}
			$el = $type."[]";
		}
		$args[] = $el;
	}
	return implode(", ", $args);
}

function stripExtension($fileName) {
	return substr($fileName, 0, strrpos($fileName, "."));
}

function stripPathAndExtension($fileName) {
	return stripExtension(substr($fileName, strrpos($fileName, "/")+1));
}
?>