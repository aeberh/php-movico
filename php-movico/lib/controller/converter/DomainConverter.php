<?php
interface DomainConverter {
	
	function fromViewtoDom($strValue);
	
	function fromDomtoView($objValue);
	
}
?>