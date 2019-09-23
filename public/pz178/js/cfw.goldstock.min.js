
CFW.peizi = {
    init: function () {
        CFW.peizi.SetAgentFee(1);
    },
    //设置代理商管理费
    SetAgentFee: function (flag) {
        if ($("#AgentInfo").length == 0)
            return;
        var info = $("#AgentInfo").val().split(',');
        if (info[0] == '1') {
            var fee = info[1];
            var msg = info[2];
            var rate = parseFloat($("#hdRate").val());
            if (fee != '' || msg != '') {
                if (fee != '') {
                    if (flag == 1) {
                        $.ajax({
                            type: "Post",
                            url: "/peizi/getjszcommodityfee",
                            data: { code: '股指按月配资', rate: rate, pt: info[3] },
                            async: false,
                            success: function (data) {
                                $("#hdFee").val(data)
                            }
                        });
                    }
                    else {
                        $("#hdFee").val(fee);
                    }
                }
                else {
                    $("#monthFeeTips").html(msg);
                }
            }
        }
    },
    /**
    * 计算配资月利率以及预警平仓线
    * baseNum 倍数
    */
    getScheme: function (money, cycle, baseNum, principal) {
        var items = [];

        items[1] = [[195]];
        items[2] = [[195]];
		var interest = items[1][0][0];

        var orginterest = interest;

        return { interest: interest, orginterest: orginterest, openLine: money - Math.round(principal * schemeConfig.openingLineRate), warningLine: money - Math.round(principal * schemeConfig.warningLineRate) };
    },
    /**
    * 检测方案发起的参数是否合法
    * 
    */
    initiateCheck: function (config) {
        if ($.isPlainObject(config)) {
            //grade
            if ($.trim(config.grade) == '') {
                CFW.dialog.alert("请选择操盘手数", 1);
                return false;
            } else if (!CFW.valid.isInt(config.grade, true)) {
                CFW.dialog.alert("操盘手数必须是整数", 1);
                return false;
            }
            var grade = parseInt(config.grade, 10);
            if (grade < schemeConfig.minLever || grade > schemeConfig.maxLever) {
                CFW.dialog.alert("操盘手数必须在" + schemeConfig.minLever + "-" + schemeConfig.maxLever + "倍", 1);
                return false;
            }

            //cycle
            if ($.trim(config.cycle) == '') {
                CFW.dialog.alert("请选择借款期限", 1);
                return false;
            } else if (!CFW.valid.isInt(config.cycle, true)) {
                CFW.dialog.alert("借款期限必须是整数", 1);
                return false;
            }
            var cycle = parseInt(config.cycle, 10);
            if (cycle < 1 || cycle > schemeConfig.maxCycle) {
                CFW.dialog.alert("借款期限必须在1-" + schemeConfig.maxCycle + "个月", 1);
                return false;
            }

            if (config.intention) {
                if (!$.isInt(config.intention) || config.intention < 0) {
                    CFW.dialog.alert("意向金必须是非负整数", 1);
                    return false;
                }
                var intention = Math.round(riskBail * schemeConfig.intentionPercent / 100);

                if (intention < schemeConfig.minIntention) {
                    intention = schemeConfig.minIntention;
                } else if (intention > schemeConfig.maxIntention) {
                    intention = schemeConfig.maxIntention;
                }
                if (Math.abs(config.intention - intention) >= 0.01) {
                    CFW.dialog.alert("意向金必须为" + intention + "元", 1);
                    return false;
                }
            }
            if (!config.agree) {
                CFW.dialog.alert("请先阅读并同意签署《借款协议》", 1, { listener: function () { $("input[name='agree']").focus(); } });
                return false;
            }
            return true;
        }
        CFW.dialog.alert("数据对象错误", 3);
        return false;
    },

    calcPeiziBill: function () {
        clearTimeout(window.t);
        //var inputMoney = CFW.shared.getIntPrincipal(".input_money input[type='text']");
		var inputMoney = schemeConfig.principal;
		var quotaMoney = schemeConfig.quotaMoney;
        var current = $(CFW.shared.selectedgrade).html();
		inputMoney = inputMoney * current;
        var pmoney = parseFloat(quotaMoney * current);
        var zmoney = pmoney + parseFloat(inputMoney);

        //平仓线，警戒线，月利率
        var cycle = 1;
        var scheme = CFW.peizi.getScheme(zmoney, cycle, current, inputMoney);
        var interest = parseFloat(scheme.interest / 100).toFixed(2);
        var orginterest = parseFloat(scheme.orginterest / 100).toFixed(2);
        $("#warningLineNum").html(scheme.warningLine + "元");
        $("#openLineNum").html(scheme.openLine + "元");
        
		var needPay = (interest / 100 * pmoney).toFixed(0);
		$("#monthFeeTips").html('<strong>' + interest + '%</strong>每月<span class="red">' + pmoney + ' x ' + interest + '% = ' + needPay + '元</span>');

		//1 ,2 杠杆的月利率
		$("#num1").html(inputMoney * 8);
		var item = CFW.peizi.getScheme(parseFloat(inputMoney * 8) + inputMoney, cycle, 8, inputMoney);
		$("#yxi1").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");
		$("#num2").html(inputMoney * 9);
		var item = CFW.peizi.getScheme(parseFloat(inputMoney * 9) + inputMoney, cycle, 9, inputMoney);
		$("#yxi2").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");
        $("#num3").html(inputMoney * 10);
        var item = CFW.peizi.getScheme(parseFloat(inputMoney * 10) + inputMoney, cycle, 10, inputMoney);
        $("#yxi3").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");

        var item = CFW.peizi.getScheme(parseFloat(inputMoney * 11) + inputMoney, cycle, 11, inputMoney);
        $("#yxi4").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");

        var item = CFW.peizi.getScheme(parseFloat(inputMoney * 12) + inputMoney, cycle, 12, inputMoney);
        $("#yxi5").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");

        var item = CFW.peizi.getScheme(parseFloat(inputMoney * 13) + inputMoney, cycle, 13, inputMoney);
        $("#yxi6").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");

        //$("#num7").html(inputMoney * 14);
        var item = CFW.peizi.getScheme(parseFloat(inputMoney * 14) + inputMoney, cycle, 14, inputMoney);
        $("#yxi7").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");

        var item = CFW.peizi.getScheme(parseFloat(inputMoney * 15) + inputMoney, cycle, 15, inputMoney);
        $("#yxi8").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");

        var item = CFW.peizi.getScheme(parseFloat(inputMoney * 16) + inputMoney, cycle, 16, inputMoney);
        $("#yxi9").html("月利率 " + parseFloat(item.interest / 100).toFixed(2) + "%");


        //总操盘资金
        //$("#total_money_tips").html('总操盘资金：' + (zmoney / 10000).toFixed(2).replace(".00", "") + ' 万=' + (inputMoney / 10000).toFixed(2).replace(".00", "") + '万（本金）+' + parseFloat(pmoney / 10000).toFixed(2).replace(".00", "") + '万（获得资金）').hide();
        $("#total_money_tips").html('=' + (inputMoney / 10000).toFixed(2).replace(".00", "") + '万（本金）+' + parseFloat(pmoney / 10000).toFixed(2).replace(".00", "") + '万（获得资金）').hide();
        $("#pay_money_tips").html('为' + (inputMoney).toFixed(2).replace(".00", "") + '元（本金）+' + parseFloat((pmoney *1.95)/ 100).toFixed(2).replace(".00", "") + '元（利息）'+'=' +(inputMoney+((pmoney *1.95)/ 100))+ '元').hide();
        $("#showNumb").html(((inputMoney)+parseFloat(pmoney)).toFixed(2).replace(".00", ""));
        var margin = (inputMoney);
        var quotaMoney = parseFloat(pmoney);
        var margin_zs = schemeConfig.principal;
        var quotaMoney_zs = schemeConfig.quotaMoney;
        $('#ben_jin').html(margin+'元');
        $('#margin_zs').val(margin_zs);
        $('#quotaMoney_zs').val(quotaMoney_zs);
        var type = $(".choose li a.active strong").html();
        $('#total_pay').html((margin+quotaMoney*0.0195));

        numberShow("showNumb", 0, zmoney, 0, 0.5);
        window.t = setTimeout(function () {
            $("#total_money_tips").show();
            $("#pay_money_tips").show();
        }, 500);

        //持仓限制
        if (zmoney >= 200000) {
            $("#tip_a").hide();
            $("#tip_b").show();
        } else {
            $("#tip_a").show();
            $("#tip_b").hide();
        }
    }
}

function showDaRenList(count, wrap) {
    //$.ajax({
    //    url: '/goldstock/getRankLists.html',
    //    data: { count: count },
    //    dataType: 'json',
    //    type: 'post',
    //    success: function (r) {
    //        if (r) {
    //            if (r.length == 0) {
    //                $(wrap).find("td").html("暂无记录");
    //                return;
    //            }
    //            var itemHtml = '<tr>\
    //                     <td><i class="{0}">{1}</i>{2}</td>\
    //                     <td>{3}</td>\
    //                     <td>{4}</td>\
    //                     <td><span>{5}</span></td>\
    //                     <td><span>{6}</span></td>\
    //                     </tr>';
    //            var items = [];
    //            for (var i = 0; i < r.length; i++) {
    //                var d = r[i];
    //                var winMoney = (d.amount_last - d.margin - d.peizhi).toFixed(0);
    //                var strWinMoney = winMoney > 10000 ? (winMoney / 10000).toFixed(2) + "万" : winMoney + "";
    //                var getMoney = d.tamount > 10000 ? (d.tamount / 10000).toFixed(2) + "万" : d.tamount + "";;
    //                var riskMoney = d.margin > 10000 ? (d.margin / 10000).toFixed(2) + "万" : d.margin + "";
    //                var winRate = (d.percent * 100).toFixed(2) + "%";
    //                var cls = 't' + (i + 1);
    //                var item = itemHtml.replace('{0}', cls).replace('{1}', i + 1).replace('{2}', d.username.substring(0, 2) + '***').replace('{3}', getMoney).replace('{4}', riskMoney).replace('{5}', winRate).replace('{6}', strWinMoney);
    //                items.push(item);
    //            }
    //            $(wrap).empty().append(items.join(''));
    //        }
    //    }
    //});
}

//操盘动态
function showPeiziActive(callback) {
    //CFW.ajax("/goldstock/getNewLists.html", {}, function (data) {
		//data = $.parseJSON(data);
    //    if (data.status==200) {
    //        if (callback) callback.call(this, data.msg);
    //    } else {
    //        CFW.dialog.alert(data.msg, 3);
    //    }
    //});
}
function renderNew8(data) {
    function getRow(d) {
        if (!d) {
            return "";
        }
        var li = new Text();
        var getMoney = d.peizhi > 10000 ? (d.peizhi / 10000).toFixed(2) + "万" : d.peizhi + "";
        var riskMoney = d.margin > 10000 ? (d.margin / 10000).toFixed(2) + "万" : d.margin + "";
        var time = d.addtime;
        li._("<tr>");
        li._("<td>" + d.username.substring(0, 2) + '***' + " </td>");
        li._("<td><span>" + getMoney + "</span></td>");
        li._("<td><span>" + riskMoney + "</span></td>");
        li._("<td>" + time + "</td>");
        li._("</tr>");
        return li.toString();
    }
    if (data.length == 0) {
        //$("#peizi_dynamic_investinfo table.cnt").html("<tr><td colspan=\"5\" style=\"text-align: center;\">暂无记录</td></tr>");
        //return;
    }
    for (var i = 0; i < data.length; i++) {
        $("#peizi_dynamic_investinfo table.cnt").append(getRow(data[i]));
    }

    $("#peizi_dynamic_investinfo table.cnt").slideUP();
}

$(function () {

    //显示操盘达人
    showDaRenList(8, $("#__darenList"));
    //显示配资动态
    showPeiziActive(renderNew8);
    CFW.peizi.init();
    CFW.peizi.calcPeiziBill();
    $("#showContract").click(function () { CFW.shared.showContract('/static/stock-peizicontract.htm?v=1.2', '借款协议') });

    //绑定金额滚动事件
    $(".input_money input[type='text']").keypress(function (e) {
        var k = e.keyCode || e.which;
        if (k >= 48 && k <= 57 || k == 8) {
            return true;
        }
        return false;
    }).keyup(function () {
        var money = CFW.shared.getIntPrincipal(this);
        if (money > schemeConfig.maxMoney) {
            $(this).val($.formatMoney(schemeConfig.maxMoney));
        } else if (money > 0) {
            $(this).val($.formatMoney(money));
        }
        CFW.peizi.calcPeiziBill();
    });
    $(".input_money input").blur(function () {
        var thisMoney = CFW.shared.getIntPrincipal(this);
        if (thisMoney == "") {
            //alert("金额不能为空");
            CFW.dialog.alert("金额不能为空", 1);
            $(this).val(schemeConfig.minMoney);
        } else if (thisMoney < schemeConfig.minMoney) {
            $(this).val($.formatMoney(schemeConfig.minMoney));
        } else if (thisMoney > schemeConfig.maxMoney) {
            $(this).val($.formatMoney(schemeConfig.maxMoney));
        } else if (thisMoney % 1000 != 0) {
            $(this).val($.formatMoney(parseInt(thisMoney / 1000) * 1000));
        }
        CFW.peizi.calcPeiziBill();
    });
});

//选择杠杆
function doGradeClick(source) {
    CFW.peizi.calcPeiziBill();
}

function refreshBalance() {
    CFW.user.loadBalance(function (account) {
        $("input[name=account]").val(account.balance);
    });
    prePayCheck();
}

function submitPayOrder() {
    //var riskMoney = CFW.shared.getIntPrincipal($(".input_money input[type='text']"));
	var margin = schemeConfig.principal;
	var quotaMoney = schemeConfig.quotaMoney;
    var type = $(".choose li a.active strong").html();
    var cycle = $("#useMonth").val();
    var paypass = $("#paypass").val();
    var startDayType = $('input[name=StartDayType]:checked').val();
    CFW.form.disableBtn("pay_prepay");
    $.ajax({
        url: '/api/saveQuota.html',
        data: {margin:margin,quotaMoney:quotaMoney,type: type, monthNum: cycle, StartDayType: startDayType,paypass:paypass },
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data.status == 200) {
                window.location ="/pzu/gzyb.html";
            }else if(data.msg == 223){   
				CFW.dialog.alert('账户余额不足！现在去充值 >> ', 4,{listener:function(){window.location.href="/pzu/recharge.html";}});
		    } else {
                CFW.dialog.alert(data.msg, 1);
                CFW.form.enableBtn("pay_prepay");
            }
        }
    });
}

function prePayCheck() {
    if (!$(".peizi_btn").find("input[type=checkbox]")[0].checked) {
        CFW.dialog.alert("请先阅读并同意《借款协议》", 1);
        return false;
    }

    var paypass = $("#ypaypass").val();
    if(!paypass){
        CFW.dialog.alert("支付密码不能为空！", 1);
        return false;
    }

	var inputMoney = schemeConfig.principal;
	var quotaMoney = schemeConfig.quotaMoney;
	
    var current = $(".choose li a.active strong").html();
	inputMoney = inputMoney * current;
    var pmoney = parseFloat(quotaMoney * current);
    var cycle = $("#useMonth").val();
    var scheme = CFW.peizi.getScheme(pmoney, cycle, current, inputMoney);
    var interest = parseFloat(scheme.interest / 100).toFixed(2);

    var totalPay = (parseFloat(inputMoney) + parseFloat(interest / 100 * pmoney)).toFixed(2);
    var balance = parseFloat($("input[name=account]").val()).toFixed(2);
    var gap = totalPay - balance;
    var payHtml = '<ul>\
                            <li class="total_money">总计<span>' + totalPay.replace(".00", "") + '</span>元</li><input type="hidden" id="paypass" value='+ paypass +'>';
    if (gap <= 0) {
        payHtml += '<li>您的账户余额<span>' + balance + '</span>元</li>\
                            <li><a href="javascript:" class="no" onclick="closePayPanel()">返回修改</a><input onclick="submitPayOrder()" class="yes btn-s-red" type="button" value="立即支付" id="pay_prepay"></li>\
                        </ul>';
    } else {
        payHtml += '<li>您的账户余额只剩<span>' + balance + '</span>元，本次支付还差<span>' + gap.toFixed(2) + '</span>元</li>\
                            <li><a href="javascript:" class="no" onclick="closePayPanel()">返回修改</a><a href="javascript:CFW.pay.showCharge(function(balance){refreshBalance();CFW.user.loadPageHeader();},$.noop,{shortage:' + (gap) + ', direct:true});" onclick="" class="yes">去充值</a></li>\
                        </ul>';
    }

    var payPanel = '<div class="open_border"> \
                        <h1>「期货按月配资」支付投资本金</h1>\
                        <div class="main_con">\
                            <dl>\
                                <dt><span class="title">投资本金</span><span class="red">' + inputMoney + '</span>元</dt>\
                                <dd>申请操盘金额' + parseFloat(pmoney / 10000).toFixed(2).replace(".00", "") + '万元</dd>\
                            </dl>\
                            <dl>\
                                <dt><span class="title">月利率</span><span>' + interest + '%</span></dt>\
                                <dd>首月 ' + pmoney + ' x ' + interest + '% = ' + (interest / 100 * pmoney).toFixed(0) + ' 利息先付后用</dd>\
                            </dl>\
                            <dl>\
                                <dt><span class="title">首月利息</span><span class="red">' + (interest / 100 * pmoney).toFixed(0) + '</span>元</dt>\
                            </dl>\
                        </div>' + payHtml + '<a href="javascript:" class="close" onclick="closePayPanel()">X</a></div>';

    $("#payBoxWrap").empty().html(payPanel);
    CFW.shared.showPrePayBox();
    return true;
}
