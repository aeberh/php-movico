function toggleBooleanValue(elementId) {
	var elem = document.getElementById(elementId);
	elem.value = (elem.value == '1') ? '0' : '1';
}

function startupActions(ctx, ajax) {
	if(ajax) {
		pushState();
	}
	autoFocus();
	setSelectedLink(ctx);
	initDates();
	setupPagination();
	initMaps();
	setupTransferListBox();
	initHtmlAreas();
}

function initHtmlAreas() {
	$(".inputRichText").each(function() {
		var id = "#"+$(this).attr("id");
		var toolbar = $(this).attr("toolbar");
		var lang = $(this).attr("lang");
		var height = $(this).attr("height");
		var width = $(this).attr("width");
		var opts = {
			lang: lang,
			height: height,
			width: width,
			toolbar: toolbar
		}
		$(id).elrte(opts);
	});
}

function beforeSubmit() {
	$(".inputRichText").elrte("updateSource");
}

function setPageMetaInfo() {
	document.title = $("#MovicoPageTitle").text();
	$("meta[name=\"description\"]").attr("content", $("#MovicoPageDescription").text());
}

// Initialize TransferListBox component
function setupTransferListBox() {
	$(".MovicoTransferListBox").each(function() {
		var div1 = $(this).children().first();
		var leftListbox = div1.children().first();
		var div2 = div1.next();
		var buttonLL = div2.children().first();
		var buttonL = buttonLL.next();
		var buttonR = buttonL.next();
		var buttonRR = buttonR.next();
		var div3 = div2.next();
		var rightListbox = div3.children().first();
		var realListbox = rightListbox.next();
		buttonRR.click(function() {
			return doTransfer(leftListbox, rightListbox, true);
		});
		buttonR.click(function() {
			return doTransfer(leftListbox, rightListbox, false);
		});
		buttonL.click(function() {
			return doTransfer(rightListbox, leftListbox, false);
		});
		buttonLL.click(function() {
			return doTransfer(rightListbox, leftListbox, true);
		});
		function doTransfer(from, to, all) {
			var optionSelector = all ? "option" : "option:selected";
			var selectedItems = from.children(optionSelector).toArray();
			to.append(selectedItems);
			realListbox.children("option").remove();
			realListbox.append(rightListbox.children("option").clone()).children("option").attr("selected", "selected");
			selectedItems.remove;
			return false;
		}
	});
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
	//if(!(typeof window.history.pushState === 'undefined')) {
		var url = getCurrentView();
		window.history.pushState(url, "", url);
	//}
}

function setOnPopState(ajaxTimeout, ctx) {
	//if(!(typeof window.onpopstate === 'undefined')) {
		window.onpopstate = function(event) {
			doAjaxRequest(event.state, "", "GET", ajaxTimeout, ctx, false);
		}
	//}
}

function getCurrentView() {
	return $("#MovicoView").text();
}

// Autofocus
function autoFocus() {
	$("input[autofocus]").focus();
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
			showLoading("active", ctx);
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
	beforeSubmit();
	doAjaxRequest(ctx+"/index.php", formEl.serialize(), "POST", ajaxTimeout, ctx, true);
}
function doAjaxGetRequest(linkEl, ajaxTimeout, ctx) {
	doAjaxRequest(linkEl.attr("href"), "", "GET", ajaxTimeout, ctx, true);
}
function doAjaxRequest(url, data, type, ajaxTimeout, ctx, mustPushState) {
	showLoading("active", ctx);
	$("button").attr("disabled", "disabled");
	$("input").attr("readonly", "readonly");
	$.ajax({
		url: url+"?ajax=1",
		data: data,
		type: type,
		dataType: "json",
		timeout: ajaxTimeout,
		success: function(data) {
			$("body").html(data.body);
			registerForms(ajaxTimeout, ctx);
			startupActions(ctx, mustPushState);
			setPageMetaInfo();
			setOnPopState(ajaxTimeout, ctx);
			showLoading("idle", ctx);
		},
		error: function(request, errorType, errorThrown) {
			$("button").removeAttr("disabled");
			$("input").removeAttr("readonly");
			if(errorType == "timeout") {
				showLoading("caution", ctx);
			} else {
				showLoading("disconnected", ctx);
				$("body").html(request.responseText);
				setOnPopState(ajaxTimeout, ctx);
			}
		}
	});
}
function showLoading(status, ctx) {
	$("img.AjaxLoading").attr("status", status).attr("src", ctx+"/lib/component/ajax/img/connect_"+status+".gif");
}