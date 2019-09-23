/**
 * shared js, for jubaopen,peizi,qihuo,caopanshou etc.
 //*/
CFW.shared = {
	selectedgrade: ".choose li a.active strong",
	inputMoney: "#principal",
	showContract: function(a, d) {
		var b = (window.screen.width - 1E3) / 2,
			c = (window.screen.height - 800) / 2 - 10;
		0 > b && (b = 0);
		0 > c && (c = 0);
		window.open(a, d, "height=800,width=1000,top=" + c + ",left=" + b + ",toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no")
	},
	showPrePayBox: function(a) {
		$(".back_bg").show();
		$(".open_div").show();
		a || (a = $("#goPay"));
		$(a).val("支付中");
		$(".process_box li").removeClass("active");
		$(".process_box li.p2").addClass("active")
	},
	getIntPrincipal: function(a) {
		a = this.getPrincipal(a);
		return /^\d+$/.test($.trim(a)) ? parseInt(a, 10) : 0
	},
	getIntGrade: function(a) {
		a = $(a).html();
		return /^\d+$/.test(a) ? parseInt(a, 10) : 0
	},
	getPrincipal: function(a) {
		return $.trim($(a).val()).replace(/\,/g, "")
	}
};
$(function() {
	if (0 < $(".left_nav").length) {
		var a = $(".left_nav li.active"),
			d = a.position().top,
			b = a.outerHeight(!0),
			c = $(".nav_line"),
			a = $(".left_nav li a"),
			e = $(".left_nav");
		c.animate({
			top: d,
			height: b
		});
		a.hover(function() {
			var a = $(this).parent(),
				b = a.outerHeight(!0),
				a = a.position().top;
			c.stop(!0, !0).animate({
				top: a,
				height: b
			}, "fast")
		});
		e.mouseleave(function(a, f) {
			a = d;
			f = b;
			c.stop(!0, !0).animate({
				top: a,
				height: f
			}, "fast")
		})
	}
	$(".nav_tab li a").hover(function() {
		$(".nav_tab a").removeClass("active");
		$(this).addClass("active");
		$(".list_tab").hide().eq($(".nav_tab a").index(this)).show()
	});
	$(".down_tab li a").hover(function() {
		$(".down_tab li a").removeClass("active");
		$(this).addClass("active");
		$(".download_sw").hide().eq($(".down_tab li a").index(this)).show()
	});
	setJubaopenCount();
	reRenderOrderInfo();
	$(".input_money input[type='text']").on("input keyup", function() {
		reRenderOrderInfo()
	});
	$(".choose li a").click(function() {
		$(this).parent().hasClass("no") || $(this).hasClass("active") || ($(this).parent().siblings().children("a").removeClass("active"), $(this).addClass("active"), "undefined" !== typeof doGradeClick ? doGradeClick(this) : CFW.dialog.alert("未配置相关事件", 1))
	});
	$(".peizi_btn .now").click(function() {
		"0" == $("input[name=login]").val() ? window.location.href='/login/index.html' : prePayCheck()
	});
	$(".open_border a.close,.open_border ul li a.no").click(function() {
		closePayPanel()
	});
	$(".showNumb").each(function() {
		var a = $(this).html(),
			b = $(this).offset().top,
			c = $(window).height();
		$(window).scrollTop() + c > b && "show" != $(this).attr("id") && ($(this).attr("id", "show"), 1 < a ? numberShow(this, 0, a) : numberShow(this, 0, a, 2, 3))
	});
	$("i.float-tips").poshytip({
		className: "tip-yellowsimple",
		alignTo: "target",
		alignX: "center",
		offsetY: 10
	});
	$(window).scroll(function() {
		CFW.countutil.showMemberDyn()
	});
	$("#showSecurityPromise").click(function() {
		CFW.shared.showContract("/static/peizi-securitypromise.html?v=1.1", "风险提示书")
	})
});

function closePayPanel() {
	$(".back_bg").hide();
	$(".open_div").hide();
	$(".peizi_btn .now").val("马上申请");
	$(".process_box li").removeClass("active");
	$(".process_box li.p1").addClass("active")
}
function reRenderOrderInfo() {
	"undefined" !== typeof CFW.jbp && "undefined" !== typeof CFW.jbp.calcJubaopenBill ? CFW.jbp.calcJubaopenBill($(CFW.shared.selectedgrade), CFW.shared.getIntPrincipal(CFW.shared.inputMoney)) : "undefined" !== typeof CFW.peizi && "undefined" !== typeof CFW.peizi.calcPeiziBill ? CFW.peizi.calcPeiziBill() : "undefined" !== typeof CFW.caopan && "undefined" !== typeof CFW.caopan.calcCaopanBill && CFW.caopan.calcCaopanBill()
}
function loginSuccess() {
	$("input[name=login]").val("1");
	"undefined" !== typeof CFW.jbp && CFW.jbp.showBalanceTip && CFW.jbp.showBalanceTip();
	"undefined" !== typeof CFW.user && CFW.user.loadPageHeader && (CFW.user.loadPageHeader(), CFW.user.loadBalance(function(a) {
		$("input[name=account]").val(a.balance)
	}))
}
function setJubaopenCount() {
	CFW.countutil.setCountNum("RegUserCount", 0);
	CFW.countutil.setCountNum("TotalMoney", 0);
	CFW.countutil.showMemberDyn()
}
function numberShow(a, d, b, c, e) {
	(new CountUp(a, d, b, c, e, {
		useEasing: !0,
		useGrouping: !0,
		separator: ",",
		decimal: "."
	})).start()
};