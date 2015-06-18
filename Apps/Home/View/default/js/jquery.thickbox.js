/* dialog */
$(document).ready(TB_launch);
function TB_launch() {
	$(".thickbox").click(function () {
		var sender = $(this);
		var t = sender.attr("title");
		var d = sender.attr("dialog");
		TB_show(t, d);
		sender.blur();
		return false;
	});
}

function TB_show(caption, url) {
	try {
		$("body").append("<div id='TB_overlay'></div><div id='TB_window' style='z-index:9999; top:100px;'></div>");
		$("#TB_overlay").css("opacity", "0.6");
		$("#TB_overlay").css("filter", "alpha(opacity=60)");
		$("#TB_overlay").css("-moz-opacity", "0.6");
		$(window).resize(TB_position);
		$("#TB_overlay").show();
		var urlString = /.jpg|.jpeg|.png|.gif|.html|.htm|.aspx|.dom/g;
		var urlType = url.match(urlString);

		var queryString = url.replace(/^[^\?]+\??/, '');
		var params = parseQuery(queryString);
		TB_WIDTH = 400; TB_HEIGHT = 300;
		if (queryString.indexOf('width') > -1)
			TB_WIDTH = (params['width'] * 1) + 30;
		if (queryString.indexOf('height') > -1)
			TB_HEIGHT = (params['height'] * 1) + 40;
		ajaxContentW = TB_WIDTH - 30;
		ajaxContentH = TB_HEIGHT - 45;
		$("#TB_window").append("<div id='TB_closeAjaxWindow'><span style='float:left'>&nbsp; " + caption + "</span><a href='#' id='TB_closeWindowButton'>关闭</a></div><div id='TB_ajaxContent' style='width:" + ajaxContentW + "px;'></div>");
		$("#TB_closeWindowButton").click(TB_remove);

		if (urlType == '.htm' || urlType == '.html' || urlType == '.aspx') {
			$("#TB_ajaxContent").load(url, function () {
				TB_position();
				$("#TB_load").remove();
				$("#TB_window").slideDown("normal");
			});
		}
		else if (urlType == '.jpg' || urlType == '.gif') {
			$("#TB_ajaxContent").append("<img src='" + url + "'>");
			TB_position();
			$("#TB_load").remove();
			$("#TB_window").slideDown("normal");
		}
		else if (urlType == '.dom') {
			url = url.substring(0, url.indexOf('.dom'));
			$('#' + url).show();
			$("#TB_ajaxContent").append($('#' + url));
			TB_position();
			$("#TB_load").remove();
			$("#TB_window").slideDown("normal");
		}
		else {
			$("#TB_ajaxContent").append($('#' + url));
			TB_position();
			$("#TB_load").remove();
			$("#TB_window").slideDown("normal");
		}

	} catch (e) {
		alert(e);
	}

    var s_top = document.body.scrollTop || document.documentElement.scrollTop
    $("#TB_window").css({ "top": s_top + 50 })

}
function TB_remove() {
	$("#TB_window").fadeOut("fast", function () {
		var ch = $("#TB_ajaxContent").children().eq(0);
		if (ch.attr("remove") == 'false') {
			ch.hide();
			ch.appendTo($("body"));
		}
		$('#TB_window,#TB_overlay,#TB_load').remove();
	});
	return false;
}
function TB_position() {
	var de = document.documentElement;
	var w = self.innerWidth || (de && de.clientWidth) || document.body.clientWidth;
	var h = self.innerHeight || (de && de.clientHeight) || document.body.clientHeight;
	var isIE6 = navigator.appVersion.indexOf("MSIE 6") > -1;
	if (window.innerHeight && window.scrollMaxY) {
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight) { // all but Explorer Mac
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		yScroll = document.body.offsetHeight;
    }
    var th = isIE6 ? ((h - TB_HEIGHT) / 2) + de.scrollTop : ((h - TB_HEIGHT) / 2);
	$("#TB_window").css({ width: TB_WIDTH + "px",/* height: TB_HEIGHT + "px",*/
	    left: ((w - TB_WIDTH) / 2) + "px", top: th + "px"
    });
	$("#TB_overlay").css("height", yScroll + "px");
}
function parseQuery(query) {
	var Params = new Object();
	if (!query) return Params;
	var Pairs = query.split(/[;&]/);
	for (var i = 0; i < Pairs.length; i++) {
		var KeyVal = Pairs[i].split('=');
		if (!KeyVal || KeyVal.length != 2) continue;
		var key = unescape(KeyVal[0]);
		var val = unescape(KeyVal[1]);
		val = val.replace(/\+/g, ' ');
		Params[key] = val;
	}
	return Params;
}

function showAlert(caption, content, icon, event) {
	if (event == "") event = null;
	var div = $("<div id='divDialogBox'><p class='box_message'>" + content + "</p><p class='box_button'><input type='button' value='确定' id='box_btnok' /></p></div>");
	div.find("#box_btnok").unbind("click");
	div.find("#box_btnok").click(function () {
		TB_remove();
		if (event)
			setTimeout(event, 200);
	});
	$("body").append(div);
	TB_show(caption, "divDialogBox.dom?width=400;");

	if (!icon || icon == "") icon = "alert";
	var bgcolor, frcolor, bgimage;
	if (icon == "alert") { bgcolor = "#FFEDAB"; frcolor = "#78580F"; bgimage = "/image/box_alert.gif"; }
	else if (icon == "error") { bgcolor = "#FFB3B3"; frcolor = "#C01303"; bgimage = "/image/box_error.gif"; }
	else if (icon == "correct") { bgcolor = "#DDEEBA"; frcolor = "#517337"; bgimage = "/image/box_correct.gif"; }
	else if (icon == "info") { bgcolor = "#B5E2F7"; frcolor = "#004484"; bgimage = "/image/box_info.gif"; }
	$("#TB_ajaxContent").css("background-color", bgcolor);
	$("#divDialogBox .box_message").css("color", frcolor);
	$("#divDialogBox .box_message").css("background-image", "url('" + bgimage + "')");
}
function showConfirm(caption, content, event) {
	if (event == "") event = null;
	var div = $("<div id='divDialogBox'><p class='box_message'>" + content + "</p><p class='box_button'><input type='button' value='确定' id='box_btnok' /> <input type='button' value='取消' onclick='TB_remove()'></p></div>");
	div.find("#box_btnok").unbind("click");
	div.find("#box_btnok").click(function () {
		TB_remove();
		if (event)
			setTimeout(event, 200);
	});
	$("body").append(div);
	TB_show(caption, "divDialogBox.dom?width=400;");

	var bgcolor, frcolor, bgimage;
	bgcolor = "#FFFFFF"; frcolor = "#333333"; bgimage = "/image/box_confirm.gif";
	$("#TB_ajaxContent").css("background-color", bgcolor);
	$("#divDialogBox .box_message").css("color", frcolor);
	$("#divDialogBox .box_message").css("background-image", "url('" + bgimage + "')");
}