//获取所有选中值
function getAllValues() {
	var itemsName = "checkItem";
	if (arguments.length > 0)
		itemsName = arguments[0];
	var reval = "";
	$("input[name=" + itemsName + "]").each(function () {
		var $item = $(this);
		if ($item.attr("checked")) {
			reval += "," + $item.val();
		}
	});
	if (reval != "")
		reval = reval.substring(1);
	return reval;
}
//删除所有 插件
$.fn.deleteAll = function () {
	var $this = $(this);
	var args = arguments;
	$this.click(function () {
		var itemsName = $this.attr("items");
		if (!itemsName)
			itemsName = "checkItem";
		var vals = getAllValues(itemsName);
		if (vals == "") {
			showAlert("信息", "没有选中任何记录！", "alert");
			return;
		}
		var event, txt = "删除";
		if (args.length > 0)
			event = args[0];
		if (args.length > 1)
			txt = args[1];
		var arr = vals.split(",");
		showConfirm(txt + "确认", "真的要" + txt + "这 " + arr.length + " 条记录吗？", function () {
			if (event) {
				event(vals);
			}
		});
	});
}

$.fn.deleteAll_F = function () {
    var $this = $(this);
    var args = arguments;
    $this.click(function () {
        var itemsName = $this.attr("items");
        if (!itemsName)
            itemsName = "checkItem";
        var vals = getAllValues(itemsName);
        if (vals == "") {
            alert("没有选中任何记录！");
            return;
        }
        var event, txt = "删除";
        if (args.length > 0)
            event = args[0];
        if (args.length > 1)
            txt = args[1];
        var arr = vals.split(",");
        if (confirm("真的要" + txt + "这 " + arr.length + " 条记录吗？")) {
            if (event) {
                event(vals);
            }
        }
//        showConfirm(txt + "确认", "真的要" + txt + "这 " + arr.length + " 条记录吗？", function () {
//            if (event) {
//                event(vals);
//            }
//        });
    });
}

$(function () {
	//全选 class="checkAll" name="checkItem" items="checkItem"
	$(".checkAll").click(function () {
		var $this = $(this);
		var itemsName = $this.attr("items");
		if (!itemsName)
			itemsName = "checkItem";
		$("input[name=" + itemsName + "]").each(function () {
			var $item = $(this);
			if ($this.attr("checked"))
				$item.attr("checked", "checked");
			else
				$item.removeAttr("checked", "checked");
		});
	});

	//鼠标选择移动列表行样式切换
	//    $(".conMain>.linePanel>table>tbody>tr").hover(function () { $(this).addClass("bgcg"); }, function () { $(this).removeClass("bgcg"); });
	//    $(".conMain>.linePanel>.viewList>table>tbody>tr").hover(function () { $(this).addClass("bgcg"); }, function () { $(this).removeClass("bgcg"); });
	//    $(".conMain>.showPanel>.viewList>table>tbody>tr").hover(function () { $(this).addClass("bgcg"); }, function () { $(this).removeClass("bgcg"); });
});

/*邮箱输入提示*/
var MailTips = {
    mailArr: ["163.com",
			"126.com",
			"qq.com",
			"sina.com",
			"vip.sina.com",
			"hotmail.com",
			"gmail.com",
			"sina.cn",
			"suho.com",
			"yahoo.cn",
			"139.com",
			"wo.com.cn",
			"189.cn"],
    liArr: [],
    box: null,
    input: null,
    cssUrl: '../style/mailtops.css',
    kboo: false,
    currentDisplayLiArr: [],
    currentIndex: 0,
    init: function (id) {
        var obj = this.input = document.getElementById(id);
        var that = this;
        if (obj.addEventListener) {
            obj.addEventListener("input", that.changeEvent, false);
        } else if (obj.attachEvent) {
            obj.attachEvent("propertychange", that.changeEvent);
        }
        this.addEvent(obj, "blur", that.focusout);
        //this.addCss();
        this.createContent(obj.parentNode);
        this.box.style.top = obj.offsetTop + obj.offsetHeight + "px";
        this.box.style.left = obj.offsetLeft + "px";
    },
    changeEvent: function () {
        var str = MailTips.input.value;
        MailTips.box.style.display = "block";
        MailTips.kboo = true;
        MailTips.currentDisplayLiArr = [];
        for (var i in MailTips.liArr) {
            var li = MailTips.liArr[i];
            if (str.indexOf("@") == -1) {
                li.style.display = "block";
                li.innerHTML = str + "@" + MailTips.mailArr[i];
            } else {
                li.style.display = li.innerHTML.indexOf(str) != -1 ? "block" : "none";
            }
            if (li.style.display == "block") {
                MailTips.currentDisplayLiArr.push(li);
            }
        }
        MailTips.currentIndex = 0;
    },
    focusout: function () {
        setTimeout(function () {
            MailTips.box.style.display = "none";
            MailTips.kboo = false;
        }, 50)
    },
    createContent: function (target) {
        this.box = document.createElement("div");
        this.box.className = "mailtops_css";
        target.appendChild(this.box);
        var ul = document.createElement("ul");
        this.box.appendChild(ul);
        for (var i = 0; i < this.mailArr.length; i++) {
            var li = this.getLi();
            li.innerHTML = this.mailArr[i];
            this.liArr.push(li);
            ul.appendChild(li);
        }
        this.addKeyBoardEvent();
    },
    addKeyBoardEvent: function () {
        this.addEvent(document, "keydown", function (e) {
            if (MailTips.kboo) {
                var e = e || window.event;
                switch (e.keyCode) {
                    case 40: MailTips.currentIndex++; break;
                    case 38: MailTips.currentIndex--; break;
                    case 13:
                        MailTips.input.value = MailTips.currentDisplayLiArr[MailTips.currentIndex].innerHTML;
                        MailTips.focusout();
                        break
                    default: break;
                }
                MailTips.selectCurrent();
            }
        })
    },
    selectCurrent: function () {
        if (MailTips.currentIndex < 0) MailTips.currentIndex = MailTips.currentDisplayLiArr.length - 1;
        if (MailTips.currentIndex > MailTips.currentDisplayLiArr.length) MailTips.currentIndex = 0;
        for (var i = 0; i < MailTips.currentDisplayLiArr.length; i++) {
            if (MailTips.currentIndex == i) {
                MailTips.currentDisplayLiArr[i].className = "overli";
            } else {
                MailTips.currentDisplayLiArr[i].className = "outli";
            }
        }
    },
    getLi: function () {
        var li = document.createElement("li");
        this.addEvent(li, "mouseover", function () { li.className = "overli"; });
        this.addEvent(li, "mouseout", function () { li.className = "outli"; });
        this.addEvent(li, "click", function () { MailTips.input.value = li.innerHTML; });
        return li;
    },
    addEvent: function (obj, type, fn) {
        if (obj.addEventListener) {
            obj.addEventListener(type, fn, false);
        } else if (obj.attachEvent) {
            obj.attachEvent("on" + type, fn);
        }
    }
    /*,
    addCss: function () {
    var css = document.createElement("link")
    css.type = "text/css";
    css.href = this.cssUrl;
    css.rel = "stylesheet";
    var headElem = document.getElementsByTagName("head")[0];
    headElem.appendChild(css);
    }*/
}


var SwitchTab = function (data) {
    this.init(data);
}
SwitchTab.prototype = {
    space: 0,
    sprite: null,
    ac: '',
    time: 0,
    btnArr: [],
    n: 0,
    lastBtn: null,
    timer: 0,
    ap: false,
    effect: "",
    speed: 0,
    liArr: [],
    init: function (data) {
        this.space = data.space || 0;
        this.time = data.time || 3000;
        this.ac = data.activeClass;
        this.ap = data.autoPlay || false;
        this.effect = data.effect || "left";
        this.speed = data.speed || 300;
        this.sprite = this.getElem(data.imgId);
        this.liArr = this.getElem(data.imgId).getElementsByTagName("li");
        this.btnArr = this.getElem(data.btnId).getElementsByTagName("span");
        var self = this;
        var eType = data.eventType || "mouseover";
        this.onChange = data.onChange || null;
        self.lastBtn = self.btnArr[0];
        for (var i = 0; i < self.btnArr.length; i++) {
            self.btnArr[i].index = i;
            self.btnArr[i]["on" + eType] = function () {
                self.n = this.index;
                self.move();
            }
        }
        $("#" + data.btnId).parent().mouseenter(function () {
            clearInterval(self.timer);
        })
        $("#" + data.btnId).parent().mouseleave(function () {
            self.autoPlay();
        })

        this.autoPlay();
    },
    getElem: function (id) {
        return document.getElementById(id);
    },
    move: function () {
        var self = this;
        var str = self.effect;
        if (str == "opacity") {
            for (var i = 0; i < self.liArr.length; i++) {
                if (i == self.n) {
                    $(self.liArr[i]).stop().animate({ "opacity": 1 }, self.speed);
                } else {
                    $(self.liArr[i]).stop().animate({ "opacity": 0 }, self.speed);
                }
            }
        } else {
            var o = {};
            o[str] = -self.n * self.space;
            $(self.sprite).stop().animate(o, self.speed);
        }

        $(self.lastBtn).removeClass(self.ac);
        $(self.btnArr[self.n]).addClass(self.ac);
        self.lastBtn = self.btnArr[self.n];

        if (this.onChange != null) {
            this.onChange();
        }
        
    },
    autoPlay: function () {
        if (this.ap) {
            var self = this;
            var len = self.btnArr.length;
            self.timer = setInterval(function () {
                self.n++;
                if (self.n > len - 1) self.n = 0;
                self.move();
            }, self.time)
        }
    }

}

var Carousel = function (data) {
    this.init(data);
}
Carousel.prototype = {
    sprite: null, page: 0, space: 0, index: 0, btnPrev: null, btnNext: null,
    init: function (data) {
        this.sprite = this.getElem(data.targetId);
        var liw = this.sprite.getElementsByTagName("li")[0].offsetWidth
        var tw = this.sprite.getElementsByTagName("li").length * liw;
        this.page = Math.ceil(tw / (data.pageNum * liw));
        this.space = liw * data.pageNum;
        this.btnPrev = this.getElem(data.btnPrev);
        this.btnNext = this.getElem(data.btnNext);
        this.mouseEvent();
    },
    mouseEvent: function () {
        var self = this;
        this.btnPrev.onclick = function () {
            self.index--;
            if (self.index < 0) self.index = self.page - 1;
            self.move();
        }
        this.btnNext.onclick = function () {
            self.index++;
            if (self.index > self.page - 1) self.index = 0;
            self.move();
        }
    },
    move: function () {
        var self = this;
        $(self.sprite).stop().animate({ "left": -self.index * self.space }, "100");
    },
    getElem: function (id) {
        return document.getElementById(id);
    }
}


/*倒计时*/
var countDown = function (h, m, s, etime, ntime) {
    var th = document.getElementById(h);
    var tm = document.getElementById(m);
    var ts = document.getElementById(s);

    if (!th) {
        return;
    }
    var ds = etime.toString().replace(/-/g, '/');
    var endtime = new Date(ds); //2012/12/21 23:59:59
    var ds2 = ntime.toString().replace(/-/g, '/');
    var nowtime = new Date(ds2);
    var count = endtime.getTime() - nowtime.getTime();
    var loop = setInterval(function () {
        var count2 = count;
        var hour = Math.floor(count2 / 3600000);
        count2 -= hour * 3600000;
        var fen = Math.floor(count2 / 60000);
        count2 -= fen * 60000;
        var miao = Math.floor(count2 / 1000);

        var s1 = hour < 10 ? "0" + hour : hour;
        var s2 = fen < 10 ? "0" + fen : fen;
        var s3 = miao < 10 ? "0" + miao : miao;

        if (s1 == "00" && s2 == "00" && s3 == "00") {
            window.location = window.location.href;
        }

        th.innerHTML = s1;
        tm.innerHTML = s2;
        ts.innerHTML = s3;

        count -= 1000;

    }, 1000)
}