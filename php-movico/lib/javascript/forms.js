function toggleBooleanValue(elementId) {
	var elem = document.getElementById(elementId);
	elem.value = (elem.value == '1') ? '0' : '1';
}

$(function() {
	checkRedirect();
	startupActions();
});

function startupActions() {
	autoFocus();
	setupTimers();
	setupPagination();
}

// Automatic redirect by hash
function checkRedirect() {
	var hash = window.location.hash;
	if(hash == "#" || hash == "") {
		return;
	}
	//submit the redirect form
	$("#RedirectForm").attr("action", "#");
	$("#RedirectForm input").val(hash.slice(1));
	$("#RedirectForm").submit();
}

// Countdown timer
function setupTimers() {
	$(".movico-timer").each(function() {
		$(this).children("button").hide();
		var millis = $(this).children("input").val()-$("body").attr("id");
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

// AJAX
function registerForms(ajaxTimeout) {
	$("form").submit(function() {
		if($(this).attr("enctype") == "multipart/form-data") {
			return true;
		}
		
		var timerStart = new Date().getTime();

		$("button").attr("disabled", "disabled");
		$("input").attr("readonly", "readonly");
		
		showLoading("active");
		
		$.ajax({
			url: "index.php?jquery=1",
			data: $(this).serialize(),
			type: "POST",
			dataType: "json",
			timeout: ajaxTimeout,
			success: function(data) {
				$("body").html(data.body);
				registerForms(ajaxTimeout);
				showLoading("idle");
				var timerDuration = new Date().getTime() - timerStart;
				$("body").attr("id", timerDuration);
				startupActions();
			},
			error: function(request, errorType, errorThrown) {
				$("button").removeAttr("disabled");
				$("input").removeAttr("readonly");
				if(errorType == "timeout") {
					showLoading("caution");
				} else {
					alert(errorThrown);
					showLoading("disconnected");
				}
			}
		});
		return false;
	});
}
function showLoading(status) {
	$("img.AjaxLoading").attr("src", "lib/component/img/connect_"+status+".gif");
}