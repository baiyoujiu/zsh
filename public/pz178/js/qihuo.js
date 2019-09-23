CFW.qihuo = {
    init: function () {

    },
    /**
   * 计算配资管理费，配资保证金和配资总操盘资金
   */
    getScheme: function (count, plan, stock) {

        var quotaMoney = Number(gzConfig.quotaMoney);

        var mFee = count * 50;
        var riskMoney = plan == 1 ? stock: stock * 2;
        riskMoney = (riskMoney * count).toFixed(0);
        //var totalMoney = plan == 1 ?(stock * 26 * count).toFixed(0):(stock * 27 * count).toFixed(0);
        //var scale = plan == 1 ? 25.3 : 25.4;
        //var warnscale = plan == 1 ? 25.4 : 25.6;
        var totalMoney = plan == 1 ?(stock * (quotaMoney+1) * count).toFixed(0):(stock * (quotaMoney+2) * count).toFixed(0);
        var scale = plan == 1 ? (quotaMoney+0.03) : (quotaMoney+0.03);
        var warnscale = plan == 1 ? (quotaMoney+0.035) :(quotaMoney+0.035);

        var warnLine = (stock * count * parseFloat(warnscale)).toFixed(0);
        var openLine = (stock * count * parseFloat(scale)).toFixed(0);
        return { mfee: mFee, riskmoney: riskMoney, totalmoney: totalMoney, openline: openLine, warningline: warnLine, scale: scale, warnscale: warnscale };
    },
    //保证金追加
    appendRiskBail: function (orderNum, minMoney) {
        var t = this, d = CFW.dialog, s = new Text(), text = new Text();

        s._('<div class="db-con-1">');
        s._('<div class="lui-form-item" style="padding-top:20px;position:relative"><label class="lui-label">追加金额</label><input type="text" id="riskBailMoney" class="lui-input riskmoney-input" style="width:215px"/> <em class="unit">元</em><em class="tip" id="balance">余额加载中</em></div>'); //<em class="tip">最少'+minMoney+'元</em>
        s._('<div class="lui-form-item" style="padding-top:30px; padding-bottom:10px;">');
        d.addButton(s, { id: 'btnCancel', name: '取消追加', css: 'btn btn-s btn-s-orange', click: 'CFW.dialog.close(#di#,0);' });
        d.addButton(s, { id: 'appendRiskBailBtn', name: '确定追加', css: 'mgl-15 btn btn-s', click: 'CFW.dialog.listener(#di#,1);' });
        s._('</div>');
        s._('</div>');

        d.open(s.ts(), {
            topic: '追加保证金', width: 550, listener: function (nt) {
                if (nt == 0) return;
                var moneyStr = $.trim($.v("riskBailMoney"));
                if (moneyStr == '') {
                    CFW.dialog.alert("请填写追加金额", 1, { listener: function () { $("#riskBailMoney").focus(); } });
                    return;
                }
                if (!/^\d{1,}$/.test(moneyStr)) {
                    CFW.dialog.alert("追加金额填写错误，金额必须是整数", 1, { listener: function () { $("#riskBailMoney").focus(); } });
                    return;
                }
                var money = parseInt(moneyStr, 10);
                if (money < minMoney) {
                    CFW.dialog.alert("追加的保证金金额不能小于" + minMoney + "元", 1, { listener: function () { $("#riskBailMoney").focus(); } });
                    return;
                }
                CFW.form.disableBtn("appendRiskBailBtn");
                CFW.ajax("/my/addqihuoriskmoney", { id: orderNum, money: money }, function (data) {
                    CFW.form.enableBtn("appendRiskBailBtn");
                    if (data.IsSuccess) {
                        d.close();
                        CFW.dialog.alert(data.Message, 4, { listener: function () { window.location.reload(); } });
                    } else if (CFW.code.balanceInsufficient == data.code) {
                        CFW.pay.showCharge(loadBalance, $.noop, { shortage: data.responseObj, direct: false });
                    } else {
                        CFW.dialog.alert(data.Message, 1);
                    }
                });

                function loadBalance(balance) {
                    $("#balance").html("余额" + balance + "元");
                }
            }
        });
        CFW.user.loadBalance(function (ast) { $("#balance").html("余额" + ast.balance + "元") });
    }

}

$(function () {
    CFW.init();
   	
	$("#show_gz").click(function() {
		$(".guize_bg").show();
		$(".guize_div").show()
	});
	$(".guize_div_bg a.close,.close a").click(function() {
		$(".guize_bg").hide();
		$(".guize_div").hide();
	});

    $(".open_border a.close,.open_border ul li a.no").click(function () {
        $(".back_bg").hide();
        $(".open_div").hide();
        $(".peizi_btn .now").val("马上申请");
        $(".peizi_btn .now").css("background-color", "#ff5256");
        $(".process_box li").removeClass("active");
        $(".process_box li.p1").addClass("active");
    });
    var $liCur = $(".left_nav li.active"),
        curP = $liCur.position().top,
        curH = $liCur.outerHeight(true),
        $slider = $(".nav_line"),
        $targetEle = $(".left_nav li a"),
        $navBox = $(".left_nav");
    $slider.animate({
        "top": curP,
        "height": curH
    });
    $targetEle.hover(function () {
        var $parent = $(this).parent(),
            height = $parent.outerHeight(true),
            posL = $parent.position().top;
        $slider.stop(true, true).animate({
            "top": posL,
            "height": height
        }, "fast");
    });
    $navBox.mouseleave(function (cur, hid) {
        cur = curP;
        hid = curH;
        $slider.stop(true, true).animate({
            "top": cur,
            "height": hid
        }, "fast");
    });

    $(".nav_tab li a").hover(function () {
        $(".nav_tab li a").removeClass("active");
        $(this).addClass("active");
        $(".list_tab").hide().eq($(".nav_tab li a").index(this)).show();
    });

    $(".down_tab li a").click(function () {
        $(".down_tab li a").removeClass("active");
        $(this).addClass("active");
        $(".download_sw").hide().eq($(".down_tab li a").index(this)).show();
    });
    $("#qihuoNum li a").click(function () {
        $(".qihuo_num li a.active").removeClass("active");
        $(this).addClass("active");
        $("#Count").val($(this).attr('num'));
        showqh();
    });
    $("#qihuoPlan li a").click(function () {
        $("#qihuoPlan li a.active").removeClass("active");
        $(this).addClass("active");
        $("#Plan").val($(this).attr('num'));
        showqh();
    });

    $("i.float-tips").poshytip({
        className: "tip-yellowsimple",
        //content: "为避免风险，暂停该杠杆，择期开放，请您谅解",
        alignTo: 'target',
        alignX: 'center',
        offsetY: 10
    });

    $("#showContract").click(showContract);
    //支付
    $("#goPay").click(goPay);

    showqh();
    $(".showNumb").each(function () {
        var numb = $(this).attr("num");//获取滚动金额
        var bb = $(this).offset().top;
        var wh = $(window).height();
        if ($(window).scrollTop() + wh > bb) {
            if ($(this).attr("id") != "show") {
                $(this).attr("id", "show");
                if (numb >= 1) {
                    numberShow(this, 0, numb);
                } else {
                    numberShow(this, 0, numb, 2, 3);
                }
            }
        }
    });

    //显示操盘达人
    //showDaRenList(8, $("#__darenList"));
    //显示配资动态
   //showPeiziActive(renderNew8);
});
function showqh() {
    var count = $("#Count").val();
    var plan = $("#Plan").val();
    var stock = $("#Stock").val();
    var scheme = CFW.qihuo.getScheme(count, plan, stock);
    var pmoney = scheme.totalmoney - scheme.riskmoney;
    var plan1 = (stock * count).toFixed(0);
    var plan2 = (stock * 2 * count).toFixed(0);
    $("#num1").html(plan1);
    $("#num2").html(plan2);

    $("#warningLineNum").html('<strong>' + scheme.warningline + '元</strong>（预警线=投顾资金*1.035）');
    $("#openLineNum").html('<strong >' + scheme.openline + '元</strong>（平仓线=投顾资金*1.03）');
    $("#ben_jin").html(scheme.riskmoney+'元');
    $("#total_pay").html(scheme.riskmoney);
    $("#totalMoney").html(scheme.totalmoney);
    $("#showQh").html(scheme.totalmoney);
    $(".Totalbj1").html(scheme.riskmoney);
    $(".bj1").html(scheme.riskmoney);

    //总操盘资金
    $("#total_money_tips").html('总操盘资金：' + (scheme.totalmoney) + '元 = ' + (scheme.riskmoney) + '元（本金）+' + pmoney + '元（投顾资金）').hide();
    numberShow("showQh", 0, scheme.totalmoney, 0, 0.5);
    Window.t = setTimeout(function () {
        $("#total_money_tips").show();
    }, 500);
}
function numberShow(id, sta, end, decimal, tim) {
    var options = {
        useEasing: true,
        useGrouping: true,
        separator: ',',
        decimal: '.'
    };
    var show = new CountUp(id, sta, end, decimal, tim, options);
    show.start();
}


function showContract() {
    window.open('/contract/goldStockContract.html', '金股指合作操盘协议', 'height=800,width=1000,top=0,left=200,toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no');
}

function closePayPanel() {
    $(".back_bg").hide();
    $(".open_div").hide();
    $(".peizi_btn .now").val("马上申请");
    $(".peizi_btn .now").css("background-color", "#ff5256");
    $(".process_box li").removeClass("active");
    $(".process_box li.p1").addClass("active");
}

function loginSuccess() {
    $("input[name=login]").val("1");

    CFW.user.loadBalance(function (account) {
        $("input[name=account]").val(account.balance);
    });
}

function refreshBalance() {
    CFW.user.loadBalance(function (account) {
        $("input[name=account]").val(account.balance);
    });
    goPay();
}

function submitPayOrder() {
    var gold_stock_num = $("#Count").val();
    var gold_stock_type = $("#Plan").val();
	var gold_stock_start_type = $('input[name=StartDayType]:checked').val();
	
    var stock = $("#Stock").val();
	var scheme = CFW.qihuo.getScheme(gold_stock_num, gold_stock_type, stock);
    var pmoney = scheme.totalmoney - scheme.riskmoney;

    var inputMoney = scheme.riskmoney;
    var paypass = $("#paypass").val();
    
    CFW.form.enableBtn("pay_prepay");
    $.ajax({
        url: '/api/goldstocksave',
        data: { gold_stock_num: gold_stock_num, gold_stock_type: gold_stock_type, gold_stock_start_type: gold_stock_start_type,
		 gold_stock_principal: inputMoney, gold_stock_peizi: pmoney, gold_stock_real_fuck: scheme.totalmoney, gold_stock_early:scheme.warningline, 
		 gold_stock_unwind:scheme.openline,paypass:paypass},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data.status == 200) {
                window.location = '/pzu/jgz.html';
            } else {
                CFW.dialog.alert(data.msg, 1);
                CFW.form.enableBtn("pay_prepay");
            }
        }
    });
}



function goPay() {
    /*if ($("input[name=login]").val() == "0") {
        CFW.user.checkAndShowLogin(loginSuccess);
        return;
    }*/

    if (!$(".peizi_btn").find("input[type=checkbox]")[0].checked) {
        CFW.dialog.alert("请先阅读并同意《金股指合作操盘协议》", 1);
        return false;
    }

    var paypass = $("#ypaypass").val();
    if(!paypass){
        CFW.dialog.alert("支付密码不能为空！", 1);
        return false;
    }

    var count = $("#Count").val();
    var plan = $("#Plan").val();
    var stock = $("#Stock").val();
    var scheme = CFW.qihuo.getScheme(count, plan, stock);
    var pmoney = scheme.totalmoney - scheme.riskmoney;

    var inputMoney = scheme.riskmoney;  
    var totalPay = scheme.riskmoney;
    var balance = parseFloat($("input[name=account]").val()).toFixed(2);
    var gap = (totalPay - balance).toFixed(0);
    var payHtml = '<ul class="main_con">\
                            <li class="total_money">总计<span>' + totalPay.replace(".00", "") + '</span>元</li><input type="hidden" id="paypass" value='+ paypass +'>';
    if (gap <= 0) {
        payHtml += '<li>您的账户余额<span>' + balance + '</span>元</li>\
                            <li><a href="javascript:" class="no" onclick="closePayPanel()">返回修改</a><input onclick="submitPayOrder()" class="yes btn-s-red" type="button" value="立即支付" id="pay_prepay"></li>\
                        </ul>';
    } else {
        payHtml += '<li>您的账户余额只剩<span>' + balance + '</span>元，本次支付还差<span>' + gap + '</span>元</li>\
                            <li><a href="javascript:" class="no" onclick="closePayPanel()">返回修改</a><a href="javascript:CFW.pay.showCharge(function(balance){refreshBalance();CFW.user.loadPageHeader();},$.noop,{shortage:' + (gap) + ', direct:true});" onclick="" class="yes">去充值</a></li>\
                        </ul>';
    }

    var payPanel = '<div class="open_border"> \
                        <h1>「金股指」支付投资本金</h1>\
                        <div class="main_con">\
                            <dl>\
                                <dt><span class="title">投资本金</span><span class="red">' + inputMoney + '</span>元</dt>\
                                <dd>申请'+count+'手配资金额' + pmoney + '元</dd>\
                            </dl>\
                           <dl>\
                                <dt><span class="title">交易费</span><span>400元/单边</span></dt>\
                                <dd>在交易软件中买入卖出一手股指期货时各收取400元</dd>\
                            </dl>\
                            <dl>\
                                <dt><span class="title">账户管理费</span><span>免费</span></dt>\
                            </dl>\
                            <dl>\
                                <dt><span class="title">使用期限</span><span>1-30个交易日</span></dt>\
                                <dd>默认自动延期，不能持仓过夜</dd>\
                            </dl>\
                        </div>' + payHtml + '<a href="javascript:" class="close" onclick="closePayPanel()">X</a></div>';

    $("#payBoxWrap").empty().html(payPanel);

    $(".back_bg").show();
    $(".open_div").show();
    $(this).val("支付中");
    $(this).css("background-color", "#aeaeae");
    $(".process_box li").removeClass("active");
    $(".process_box li.p2").addClass("active");

}

function showDaRenList(count, wrap) {
    $.ajax({
        url: '/qihuo/getqihuodaren',
        data: { count: count },
        dataType: 'json',
        type: 'post',
        success: function (r) {
            if (r) {
                var itemHtml = '<tr>\
                         <td><i class="{0}">{1}</i>{2}</td>\
                         <td>{3}</td>\
                         <td>{4}</td>\
                         <td><span>{5}</span></td>\
                         <td><span>{6}</span></td>\
                         </tr>';
                var items = [];
                for (var i = 0; i < r.length; i++) {
                    var d = r[i];
                    var winMoney = (d.FinishMoney - d.Money - d.RiskMoney).toFixed(0);
                    var strWinMoney = winMoney > 10000 ? (winMoney / 10000).toFixed(2) + "万" : winMoney + "";
                    var getMoney = d.Money > 10000 ? (d.Money / 10000).toFixed(2) + "万" : d.Money + "";
                    var riskMoney = d.RiskMoney > 10000 ? (d.RiskMoney / 10000).toFixed(2) + "万" : d.RiskMoney + "";
                    var winRate = ((d.FinishMoney - d.Money - d.RiskMoney) * 100 / (d.RiskMoney)).toFixed(2) + "%";
                    var cls = 't' + (i + 1);
                    var item = itemHtml.replace('{0}', cls).replace('{1}', i + 1).replace('{2}', d.UserName.substring(0, 2) + '***').replace('{3}', getMoney).replace('{4}', riskMoney).replace('{5}', winRate).replace('{6}', strWinMoney);
                    items.push(item);
                }
                $(wrap).empty().append(items.join(''));
            }
        }
    });
}


function showPeiziActive(callback) {
    CFW.ajax("/qihuo/GetQihuoOrderNew?count=80", {}, function (data) {
        if (data.isSuccess) {
            if (callback) callback.call(this, data.responseObj);
        } else {
            CFW.dialog.alert(data.message, 3);
        }
    });
}
function renderNew8(data) {
    function getRow(d) {
        if (!d) {
            return "";
        }
        var li = new Text();
        var winMoney = (d.FinishMoney - d.Money - d.RiskMoney).toFixed(0);
        var getMoney = d.get_money > 10000 ? (d.get_money / 10000).toFixed(2) + "万" : d.get_money + "";
        var riskMoney = d.risk_money > 10000 ? (d.risk_money / 10000).toFixed(2) + "万" : d.risk_money + "";
        var time = d.str_create_time;
        li._("<tr>");
        li._("<td>" + d.user_name.substring(0, 2) + '***' + " </td>");
        li._("<td><span>" + getMoney + "</span></td>");
        li._("<td><span>" + riskMoney + "</span></td>");
        li._("<td>" + time + "</td>");
        li._("</tr>");
        return li.toString();
    }
    if (data.length == 0) {
        $("#qihuo_dynamic_investinfo table.cnt").html("<tr><td colspan=\"5\" style=\"text-align: center;\">数据加载中...</td></tr>");
        return;
    }
    for (var i = 0; i < data.length; i++) {
        $("#qihuo_dynamic_investinfo table.cnt").append(getRow(data[i]));
    }

    $("#qihuo_dynamic_investinfo table.cnt").slideUP();
}