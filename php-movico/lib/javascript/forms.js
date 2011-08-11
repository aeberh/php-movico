function toggleBooleanValue(elementId) {
	var elem = document.getElementById(elementId);
	elem.value = (elem.value == '1') ? '0' : '1';
}

function startupActions(ctx, mustPushState) {
	if(mustPushState) {
		pushState();
	}
	autoFocus();
	setSelectedLink(ctx);
	initDates();
	setupPagination();
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

function pushState() {
	var url = getCurrentView();
	window.history.pushState(url, "", url);
}

function setOnPopState(ajaxTimeout, ctx) {
	window.onpopstate = function(event) {
		doAjaxRequest(event.state, "", "GET", ajaxTimeout, ctx, false);
	}	
}

function getCurrentView() {
	return $("#MovicoView").text();
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
function setSelectedLink(ctx) {
	var currentView = getCurrentView();
	$("a[selectedPrefix]").each(function() {
		var prefix = ctx+"/"+$(this).attr("selectedPrefix");
		if(prefix != "" && currentView.indexOf(prefix) == 0) {
			$(this).addClass("selected");
		}
	});
}

// AJAX
function registerForms(ajaxTimeout, ctx) {
	$("form").submit(function() {
		var isUpload = $(this).attr("enctype") == "multipart/form-data";
		if(isUpload) {
			return true;
		}
		doAjaxPostRequest($(this), ajaxTimeout, ctx);
		return false;
	});
	$("a.RenderLink").click(function() {
		doAjaxGetRequest($(this), ajaxTimeout, ctx);
		return false;
	})
}
function doAjaxPostRequest(formEl, ajaxTimeout, ctx) {
	doAjaxRequest(ctx+"/index.php", formEl.serialize(), "POST", ajaxTimeout, ctx, true);
}
function doAjaxGetRequest(linkEl, ajaxTimeout, ctx) {
	doAjaxRequest(linkEl.attr("href"), "", "GET", ajaxTimeout, ctx, true);
}
function doAjaxRequest(url, data, type, ajaxTimeout, ctx, mustPushState) {
	showLoading("active", ctx);
	$("button").attr("disabled", "disabled");
	$("input").attr("readonly", "readonly");
	
	updateHtmlAreas();
	$.ajax({
		url: url+"?jquery=1",
		data: data,
		type: type,
		dataType: "json",
		timeout: ajaxTimeout,
		success: function(data) {
			unloadHtmlAreas();
			$("body").html(data.body);
			registerForms(ajaxTimeout, ctx);
			showLoading("idle", ctx);
			startupActions(ctx, mustPushState);
			setOnPopState(ajaxTimeout, ctx);
		},
		error: function(request, errorType, errorThrown) {
			$("button").removeAttr("disabled");
			$("input").removeAttr("readonly");
			if(errorType == "timeout") {
				showLoading("caution", ctx);
			} else {
				alert(errorType+": "+errorThrown);
				showLoading("disconnected", ctx);
			}
		}
	});
}
function showLoading(status, ctx) {
	$("img.AjaxLoading").attr("status", status).attr("src", ctx+"/lib/component/ajax/img/connect_"+status+".gif");
}