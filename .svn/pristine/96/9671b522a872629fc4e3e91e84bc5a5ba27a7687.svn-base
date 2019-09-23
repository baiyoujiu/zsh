<?php

function getDraftStatus(){
	
	//'稿子状态：0-待审稿|1-收稿|8-退稿'
	return ['待审','收稿','8'=>'退稿'];
}
//收支明细类型
function getMonitorType(){
	//业务类型:0-充值|1-提现|11-稿费|12-打赏|15-约稿费等
	return ['充值','提现','11'=>'稿费','12'=>'打赏','15'=>'约稿费'];
}

//超管的userid
function getSuperTube(){
	return '6dd2ae9da966a15b8d5213c4a1de463f';
}


/* 腾讯发送手机短信
 * @param $mobileStr str 13312345678,13534567890,
* @param $templId int 短信模板ID，需要在短信应用中申请
* @param $params array()  短信模板所需参数，参数数量一定要和模版匹配
* return boolean
*
* 调用参考：
* $res = SendQMsg('13071876109,18069770282',128350,['888','reewe']);
*/
function sendQMsg($mobileStr = NULL, $templId=128592,$params=[],$sign='PZ178'){//curl
	if(empty($mobileStr) || empty($templId)){
		return false;
	}
	$phoneNumbers = explode(',', $mobileStr);
	//return true;
	if($sign =='影片宝000'){
		$appid = '??';
		$appkey = '？？？';
	//配资178
	}else{
		$appid = '1400138667';
		$appkey = '2c6d859cc9bf97c7ab82b086ea26be1c';
	}

	$random = rand(100000, 999999);
	$curTime = time();
	$url = "https://yun.tim.qq.com/v5/tlssmssvr/sendmultisms2?sdkappid=" . $appid . "&random=" . $random;
	//组装
	$dataObj = new stdClass();
	$dataObj->tel = phoneNumbersToArray(86, $phoneNumbers);
	$dataObj->tpl_id = $templId;
	$dataObj->params = $params;
	//短信签名
	$dataObj->sig = hash("sha256", "appkey=".$appkey."&random=".$random."&time=".$curTime."&mobile=".$mobileStr);
	$dataObj->sign = $sign;
	$dataObj->time = $curTime;
	$dataObj->extend = '';
	$dataObj->ext = '';

	//print_r($dataObj);
	//echo $url; //exit;

	//发送请求
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataObj));
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

	$ret = curl_exec($curl);
	if (false == $ret) {
		// curl_exec failed
		$result = "{ \"result\":" . -2 . ",\"errmsg\":\"" . curl_error($curl) . "\"}";
	} else {
		$rsp = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if (200 != $rsp) {
			$result = "{ \"result\":" . -1 . ",\"errmsg\":\"". $rsp
			. " " . curl_error($curl) ."\"}";
		} else {
			$result = $ret;
		}
	}

	curl_close($curl);

	/* $result
	 * {"result": 0, //错误码，0 表示成功（计费依据），非 0 表示失败
	"errmsg": "OK", //错误消息，result 非 0 时的具体错误信息
	....}
	*/
	//echo $result;
	$rsp = json_decode($result);
	//echo $rsp->result;
	return ($rsp->result <1)? true : false;
}
//发送短信手机号格式转换
function phoneNumbersToArray($nationCode, $phoneNumbers){
	$i = 0;
	$tel = array();
	do {
		$telElement = new stdClass();
		$telElement->nationcode = $nationCode;
		$telElement->mobile = $phoneNumbers[$i];
		array_push($tel, $telElement);
	} while (++$i < count($phoneNumbers));
	return $tel;
}

/* 获取网站设置
 * return array 一维
*/
function get_pzpage($count,$urlStr,$parameter,$nowPage,$pagesize=12){
	$totalPage = ceil($count/$pagesize);
	$parameter = empty($parameter)?array():$parameter;
	$urlend = empty($parameter)?'?1=1':'?'.http_build_query($parameter);
	
	$url = $urlStr.$urlend;

	$pageStr = '<div class="listPage">';
	if($totalPage>1){
		if( $nowPage>1){
			$pageStr .= '<a href="'.$url.'&pn=1" class="prev-page">首页</a>';
			$pageStr .= '<a href="'.$url.'&pn='.($nowPage-1).'" class="prev-page">上一页</a>';
		}
		$pageStr .= ($nowPage-3)>=1?'<a href="'.$url.'&pn='.($nowPage-3).'">'.($nowPage-3).'</a>':'';
		$pageStr .= ($nowPage-2)>=1?'<a href="'.$url.'&pn='.($nowPage-2).'">'.($nowPage-2).'</a>':'';
		$pageStr .= ($nowPage-1)>=1?'<a href="'.$url.'&pn='.($nowPage-1).'">'.($nowPage-1).'</a>':'';
		$pageStr .='<a href="'.$url.'&pn='.$nowPage.'" class="listPageCurrent">'.$nowPage.'</a>';
		$pageStr .= (($totalPage-$nowPage)>=1)?'<a href="'.$url.'&pn='.($nowPage+1).'">'.($nowPage+1).'</a>':'';
		$pageStr .= (($totalPage-$nowPage)>=2)?'<a href="'.$url.'&pn='.($nowPage+2).'">'.($nowPage+2).'</a>':'';
		$pageStr .= ($totalPage-$nowPage)>=3?'<a href="'.$url.'&pn='.($nowPage+3).'">'.($nowPage+3).'</a>':'';
		
		if($totalPage>$nowPage){
			$pageStr .= '<a href="'.$url.'&pn='.($nowPage+1).'" class="next-page">下一页</a>';
			$pageStr .= '<a href="'.$url.'&pn='.$totalPage.'" class="next-page">末页</a>';
		}
	}
	$pageStr .= '</div>';

	return $pageStr;
}
function get_pzpagehtml($count,$urlStr,$parameter,$nowPage,$pagesize=12){
	$totalPage = ceil($count/$pagesize);

	$urlParam = explode('/', $urlStr);
	$urlArr= explode('.', $urlParam[4]);
	$urlArr= explode('-', $urlArr[0]);
	$urlCount = count($urlArr)-1;

	$parameter = empty($parameter)?array():$parameter;
	$urlend = empty($parameter)?'':'?'.http_build_query($parameter);
	
	$pageStr = '<div class="listPage">';
	if($totalPage>1){
		if( $nowPage>1){
			$urlArr[$urlCount] = 1;
			$pageStr .= '<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'" class="prev-page">首页</a>';
			$urlArr[$urlCount] = $nowPage-1;
			$pageStr .= '<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'" class="prev-page">上一页</a>';
		}
		$urlArr[$urlCount] = $nowPage-3;
		$pageStr .= ($nowPage-3)>=1?'<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'">'.($nowPage-3).'</a>':'';
		$urlArr[$urlCount] = $nowPage-2;
		$pageStr .= ($nowPage-2)>=1?'<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'">'.($nowPage-2).'</a>':'';
		$urlArr[$urlCount] = $nowPage-1;
		$pageStr .= ($nowPage-1)>=1?'<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'">'.($nowPage-1).'</a>':'';
		$urlArr[$urlCount] = $nowPage;
		$pageStr .='<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'" class="listPageCurrent">'.$nowPage.'</a>';
		$urlArr[$urlCount] = $nowPage+1;
		$pageStr .= (($totalPage-$nowPage)>=1)?'<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'">'.($nowPage+1).'</a>':'';
		$urlArr[$urlCount] = $nowPage+2;
		$pageStr .= (($totalPage-$nowPage)>=2)?'<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'">'.($nowPage+2).'</a>':'';
		$urlArr[$urlCount] = $nowPage+3;
		$pageStr .= ($totalPage-$nowPage)>=3?'<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'">'.($nowPage+3).'</a>':'';
		if($totalPage>$nowPage){
			$urlArr[$urlCount] = $nowPage+1;
			$pageStr .= '<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'" class="next-page">下一页</a>';
			$urlArr[$urlCount] = $totalPage;
			$pageStr .= '<a href="'.url($urlParam[3].'/'.implode('-', $urlArr)).$urlend.'" class="next-page">末页</a>';
		}
	}
	$pageStr .= '<span class="txt">共'.$totalPage.'页</span></div>';
	return $pageStr;
}


/** 股票信息
 * 请求接口返回内容
 * //@param  string $url [请求的URL地址]
 * @param  array $params [请求的参数] array('参数名'=>'参数值','参数名1'=>'参数值1')
 *
 * 参数说明
 * gid	string	必须 	股票编号，上海股市以sh开头，深圳股市以sz开头如：sh601009（type为0或者1时gid不是必须）
 key	String	必须 	APP Key
 type int	非必须	0代表上证指数，1代表深证指数
 *
 * @param  int $ipost [是否采用POST形式]
 * @return  array();
 */
function getstokinfo($params = array(),$ispost = 0){
	if(empty($params)){
		return false;
	}
	//请求URL
	$url = "http://web.juhe.cn:8080/finance/stock/hs";

	return juhecurl($url,$params,$ispost);
}
/**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  array $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
function juhecurl($url,$params,$ispost=0){
	//返回
	$returnArr = array();

	//APP Key
	$params['key'] = "44abf11b0fd013ac8bc6c0db1e5d4d53";
	//转成URL字符串
	$params = http_build_query($params);

	$httpInfo = array();
	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
	curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
	curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	if( $ispost )
	{
		curl_setopt( $ch , CURLOPT_POST , true );
		curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
		curl_setopt( $ch , CURLOPT_URL , $url );
	}
	else
	{
		if($params){
			curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
		}else{
			curl_setopt( $ch , CURLOPT_URL , $url);
		}
	}
	$response = curl_exec( $ch );
	if ($response === FALSE) {
		//echo "cURL Error: " . curl_error($ch);
		return false;
	}
	$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
	$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
	curl_close( $ch );

	//数据转换
	$returnArr = json_decode($response,true);
	return $returnArr;
}





//资讯类型
function get_news_type(){
	$returnArr = array();
	//0-资讯|1-常见问题|2-平台公告|3-公司简介|4-公司大事件|5-招贤纳士|6-联系我们|7-业务合作|8-服务条款|9-免责声明|10-意见建议|11新手指引|12注册协议|13投顾协议|14-网站地图|15-安全保障|21-公司资质
	$returnArr = [3=>'公司简介',6=>'联系我们',15=>'安全保障',11=>'新手指引',5=>'招贤纳士',12=>'服务协议',13=>'投顾协议',14=>'网站地图',20=>'合作劵商',21=>'公司资质'];
	return $returnArr;
}

?>