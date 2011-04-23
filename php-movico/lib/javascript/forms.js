function toggleBooleanValue(elementId) {
	var elem = document.getElementById(elementId);
	elem.value = (elem.value == '1') ? '0' : '1';
}

autoFocus();
function autoFocus() {
	$(".autofocus").focus();
}