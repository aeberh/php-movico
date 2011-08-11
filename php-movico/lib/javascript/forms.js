function toggleBooleanValue(elementId) {
	var elem = document.getElementById(elementId);
	elem.value = (elem.value == '1') ? '0' : '1';
}

function startupActions(ajaxTime) {
	autoFocus();
	setupTimers(ajaxTime);
	setupPagination();
	setSelectedLink();
	initDates();
	initMaps();
}

// Initialize Date components
function initDates() {
	$("input[name^=_type][value=Date]").each(function() {
		var valueEl = $(this).prev();
		var dayEl = $(this).next("select");
		var monthEl = dayEl.next("select");
		var yearEl = monthEl.next("select");
		var hourEl = yearEl.next("select");
		var minEl = hourEl.next("select");
		updateVal();
		var updateValFunc = function() {
			updateVal();
		}
		dayEl.change(updateValFunc);
		monthEl.change(updateValFunc);
		yearEl.change(updateValFunc);
		hourEl.change(updateValFunc);
		minEl.change(updateValFunc);
		function updateVal() {
			valueEl.val(dayEl.val()+"-"+monthEl.val()+"-"+yearEl.val()+" "+getVal(hourEl)+":"+getVal(minEl));
		}
		function getVal(el) {
			return typeof(el.val()) === "undefined" ? "0" : el.val();
		}
	});
}

// Initialize Google Maps
function initMaps() {
	$(".googleMap").each(function() {
		var map = null;
		var directions = null;
		var geocoder = null;
		
		var address = $(this).attr("address");
		var zoomLevel = parseInt($(this).attr("zoom"));
		
		if (GBrowserIsCompatible()) {
			map = new GMap2(document.getElementById($(this).attr("id")));
			geocoder = new GClientGeocoder();
			geocoder.getLatLng(
				address,
				function(point) {
					if (!point) {
						alert("Address " + address + " not found");
					} else {
						map.addControl(new GLargeMapControl3D());
						map.setCenter(point, zoomLevel);
						var marker = new GMarker(point);
						map.addOverlay(marker);
						//marker.openInfoWindowHtml(address);
					}
				}
			);
		}
	});
}

// Automatic redirect by hash
function checkRedirect(ajaxTimeout) {
	/*
	var hash = window.location.hash;
	if(hash == "#" || hash == "") {
		return;
	}
	//submit the redirect form
	$("#RedirectForm").attr("action", "#");
	$("#RedirectForm input").val(hash.slice(1));
	doAjaxRequest($("#RedirectForm"), ajaxTimeout, true);
	*/
}
function fixUrl() {
	var url = $("body").attr("view");
	window.history.pushState("whatever", "Title", url);
}

// Countdown timer
function setupTimers(ajaxTime) {
	$(".movico-timer").each(function() {
		$(this).children("button").hide();
		var millis = $(this).children("input").val()-ajaxTime;
		tick($(this), millis);
	});
}

function tick(timerObj, curTime) {
	curTime -= 100;
	if(curTime<0) {
		curTime = 0;
	}
	var timeDisplay = timerObj.children("span");
	timeDisplay.text(millisToStrTime(curTime));
	timerObj.children("input").val(curTime);
	if(curTime == 0) {
		timerObj.children("button").click();
	} else {
		setTimeout(function() {tick(timerObj, curTime);}, 100);
	}
}

function millisToStrTime(millis) {
	if(millis == 0) {
		return "";
	}
	var min = Math.floor(millis/1000/60);
	var sec = Math.floor(millis/1000 - 60*min)+1;
	if(sec == 60) {
		min++;
		sec = 0;
	}
	sec = sec<10 ? "0"+sec : sec;
	min = min<10 ? "0"+min : min;
	return min+":"+sec;
}

// Autofocus
function autoFocus() {
	$("input.autofocus").focus();
}

// Pagination
function setupPagination() {
	$(".dataTablePagination").each(function() {
		var dataTableDiv = $(this).parent();
		var dataTableDivId = dataTableDiv.attr("id");
		$("#"+dataTableDivId+" .page").hide();
		$("#"+dataTableDivId+" .p1").show();
		$(this).children(".prev").hide();
		var nbPages = parseInt($(this).attr("nbPages"));
		var currentPage = 1;
		if(nbPages == 1) {
			$(this).children(".next").hide();
		}
		$(this).children("a").click(function() {
			var currentPage = parseInt($(this).parent().attr("currentPage"));
			var newPage = currentPage;
			if($(this).hasClass("prev")) {
				newPage = currentPage-1;
			} else if($(this).hasClass("next")) {
				newPage = currentPage+1;
			} else {
				newPage = parseInt($(this).text());
			}
			var prev = $(this).parent().children(".prev")
			$(this).parent().children(".prev").show();
			$("#"+dataTableDivId+" tr.page").hide();
			$("#"+dataTableDivId+" tr.p"+newPage).show();
			$("#"+dataTableDivId+" .prev").show();
			$("#"+dataTableDivId+" .next").show();
			if(newPage == 1) {
				$("#"+dataTableDivId+" .prev").hide();
			} else if(newPage == nbPages) {
				$("#"+dataTableDivId+" .next").hide();
			}
			$(this).parent(".dataTablePagination").attr("currentPage", newPage);
			return false;
		});
	});
}

function unloadHtmlAreas() {
	for(var inst in CKEDITOR.instances) {
		CKEDITOR.remove(CKEDITOR.instances[inst]);
	}
}

function updateHtmlAreas() {
	for(var inst in CKEDITOR.instances) {
		CKEDITOR.instances[inst].updateElement();
	}
}

// Selected link add "selected" class
function setSelectedLink() {
	var hash = window.location.hash;
	if(hash == "#" || hash == "") {
		return;
	}
	$("a[href='"+hash+"']").addClass("selected");
}

// AJAX
function registerForms(ajaxTimeout) {
	$("form").submit(function() {
		var isUpload = $(this).attr("enctype") == "multipart/form-data";
		if(isUpload) {
			return true;
		}
		doAjaxRequest($(this), ajaxTimeout, false);
		return false;
	});
}
function doAjaxRequest(formObj, ajaxTimeout, redirect) {
	showLoading("active");
	var timerStart = new Date().getTime();
	$("button").attr("disabled", "disabled");
	$("input").attr("readonly", "readonly");
	
	updateHtmlAreas();
	$.ajax({
		url: "index.php?jquery=1",
		data: formObj.serialize(),
		type: "POST",
		dataType: "json",
		timeout: ajaxTimeout,
		success: function(data) {
			unloadHtmlAreas();
			$("body").html(data.body);
			if(!redirect) {
				registerForms(ajaxTimeout);
			}
			showLoading("idle");
			var timerDuration = new Date().getTime() - timerStart;
			startupActions(timerDuration);
		},
		error: function(request, errorType, errorThrown) {
			$("button").removeAttr("disabled");
			$("input").removeAttr("readonly");
			if(errorType == "timeout") {
				showLoading("caution");
			} else {
				alert(errorType+": "+errorThrown);
				showLoading("disconnected");
			}
		}
	});
}
function showLoading(status) {
	$("img.AjaxLoading").attr("status", status).attr("src", "lib/component/ajax/img/connect_"+status+".gif");
}