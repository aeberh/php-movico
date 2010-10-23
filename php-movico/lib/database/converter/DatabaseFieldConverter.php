<?php 
interface DatabaseFieldConverter {
	
	function fromDBtoDOM($dbValue);
	
	function fromDOMtoDB($domValue);
	
}
?>