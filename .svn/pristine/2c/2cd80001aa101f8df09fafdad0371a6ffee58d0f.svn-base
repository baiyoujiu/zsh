$('#provices').on("change", function(e) {
	var code = $.trim($('#provices').val());
	$('#city').html('<option value="">城市</option>');
	$('#area').html('<option value="">区域</option>');
	$('#street').html('<option value="">街道/镇</option>');
	$('#circle').html('<option value="">商圈</option>');
	$('#subway').html('<option value="">地铁线路</option>');
	$('#station').html('<option value="">地铁站点</option>');
	if(code == ""){return false;}
	$.ajax({ 
			type:"POST", 
			async:false, 
			url:"/api/getArea.html",
			dataType: "json",
			data:{code:code,city:1,i:Math.random()},
			success:function(result){
				if(result.status == 200){
					var cityHtml = '<option value="">城市</option>';
					cityHtml += result.html;
					$('#city').html(cityHtml);
					$('#city').click();
				}else{
					art.dialog.alert(result.msg);
				}
			},
			error:function(XMLHttpRequest, textStatus, errorThrown){
				art.dialog.alert('网络异常，请稍后重试！');
			}	
		});
});

$('#city').on("change", function(e) {
	var city = $.trim($('#city option:selected').text());
	var code = $.trim($('#city').val());
	$('#area').html('<option value="">区域</option>');
	$('#street').html('<option value="">街道/镇</option>');
	$('#circle').html('<option value="">商圈</option>');
	$('#subway').html('<option value="">地铁线路</option>');
	$('#station').html('<option value="">地铁站点</option>');
	if(code == ""){return false;}
	$.ajax({ 
			type:"POST", 
			async:false, 
			url:"/api/getCityAS.html",
			dataType: "json",
			data:{code:code,i:Math.random()},
			success:function(result){
				if(result.status == 200){
					var cityHtml = '<option value="">区域</option>';
					cityHtml += result.html;
					$('#area').html(cityHtml);
					
					var cityHtml = '<option value="">地铁线路</option>';
					cityHtml += result.subHtml;
					$('#subway').html(cityHtml);
					$('#station').val('');
					
				}else{
					art.dialog.alert(result.msg);
				}
			},
			error:function(XMLHttpRequest, textStatus, errorThrown){
				art.dialog.alert('网络异常，请稍后重试！');
			}	
		});
});
$('#area').on("change", function(e) {
	var code = $.trim($('#area').val());
	$('#circle').html('<option value="">商圈</option>');
	$('#street').html('<option value="">街道/镇</option>');
	if(code == ""){return false;}
	$.ajax({ 
			type:"POST", 
			async:false, 
			url:"/api/getAreaCircle.html",
			dataType: "json",
			data:{code:code,i:Math.random()},
			success:function(result){
				if(result.status == 200){
					var cityHtml = '<option value="">商圈</option>';
					cityHtml += result.html;
					$('#circle').html(cityHtml);
					
					var cityHtml = '<option value="">街道/镇</option>';
					cityHtml += result.ahtml;
					$('#street').html(cityHtml);
				}else{
					art.dialog.alert(result.msg);
				}
			},
			error:function(XMLHttpRequest, textStatus, errorThrown){
				art.dialog.alert('网络异常，请稍后重试！');
			}	
		});
});

$('#subway').on("change", function(e) {
	var code = $.trim($('#subway').val());
	$('#station').html('<option value="">地铁站点</option>');
	if(code == ""){return false;}
	$.ajax({ 
			type:"POST", 
			async:false, 
			url:"/api/getStation.html",
			dataType: "json",
			data:{code:code,i:Math.random()},
			success:function(result){
				if(result.status == 200){
					var html = '<option value="">地铁站点</option>';
					html += result.html;
					$('#station').html(html);
				}else{
					art.dialog.alert(result.msg);
				}
			},
			error:function(XMLHttpRequest, textStatus, errorThrown){
				art.dialog.alert('网络异常，请稍后重试！');
			}	
		});
});

$(".searchBtn").on("click",".icon-seach,.addBorder,.btnSearch",function(){
	$('form').submit();
});

$(".searchBtn").on("mouseleave",function(){
	$(".btnSearch").removeClass("activeColor");
	$(".icon-seach").removeClass("activeColor");
});
$(".searchBtn").on("mouseenter",function(){
	$(".btnSearch").addClass("activeColor");
	$(".icon-seach").addClass("activeColor");
});