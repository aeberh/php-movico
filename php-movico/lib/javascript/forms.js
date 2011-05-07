function toggleBooleanValue(elementId) {
	var elem = document.getElementById(elementId);
	elem.value = (elem.value == '1') ? '0' : '1';
}

$(function() {
	startupActions();
});

function startupActions() {
	autoFocus();
	setupTimers();
	setupPagination();
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
	$(".dataTable tr.page").hide();
	$(".dataTable tr.p1").show();
	$(".dataTablePagination a").click(function() {
		var page = $(this).text();
		$(".dataTable tr.page").hide();
		$(".dataTable tr.p"+page).show();
		return false;
	});
}

// AJAX
function registerForms(ajaxTimeout) {
	$("form").submit(function() {
		var timerStart = new Date().getTime();

		$("button").attr("disabled", "disabled");
		$("input").attr("readonly", "readonly");
		$("img.AjaxLoading").attr("src", "lib/component/img/connect_active.gif");
		
		$.ajax({
			url: "index.php?jquery=1",
			data: $(this).serialize(),
			type: "POST",
			dataType: "json",
			timeout: ajaxTimeout,
			success: function(data) {
				$("body").html(data.body);
				registerForms(ajaxTimeout);
				$("img.AjaxLoading").attr("src", "lib/component/img/connect_idle.gif");
				var timerDuration = new Date().getTime() - timerStart;
				$("body").attr("id", timerDuration);
				startupActions();
			},
			error: function(request, errorType, errorThrown) {
				$("button").removeAttr("disabled");
				$("input").removeAttr("readonly");
				if(errorType == "timeout") {
					$("img.AjaxLoading").attr("src", "lib/component/img/connect_caution.gif");
				} else {
					$("img.AjaxLoading").attr("src", "lib/component/img/connect_disconnected.gif");
				}
			}
		});
		return false;
	});
}