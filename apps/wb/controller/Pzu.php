<?php
/* 网编用户中心
 * @author Bill
 * @data 21080726
 */
namespace app\wb\controller;
use think\Controller;
use think\Validate;

class Pzu extends Controller{
	public function __construct() {
		parent::__construct();
		$userInfo = session('userInfo');
		if(empty($userInfo)){
			if (Request()->isAjax()){
				return ['status'=>220,'msg'=>'请先登陆！'];
			}else{
				$this->redirect(url('login/index'));
			}
		}
		$this->assign('userInfo',$userInfo);
		
		//超管userid
		$this->assign('supertube',getSuperTube());
	}
	
	public function inf(){
		$userid = session('userid');
		//用户信息
		$wheres = ['userid'=>$userid];
		$info = db('users')->where($wheres)->find();
		
		$info['phone'] = decryptd($info['phone']);
		$this->assign('info',$info);
		
		//用户扩展信息表
		$uinfo = db('users_info')->where($wheres)->find();
		$uinfo['identity'] = $uinfo['identity']?decryptd($uinfo['identity']):'';
		$this->assign('uinfo',$uinfo);
		
		//写手、网编扩展信息
		$tablemore = ($info['utype'] == 1)?'users_xsinf':'users_wbinf';
		$infomore = db($tablemore)->where($wheres)->find();
		$this->assign('infomore',$infomore);
		
		//财务信息
		$finfo = db('finance')->where($wheres)->find();
		$this->assign('finfo',$finfo);
		
		//卡数
		$wheres = ['userid'=>$userid,'status'=>1];
		$cardNum = db('users_card')->where($wheres)->count();
		$this->assign('cardNum',$cardNum);
		return view();
	}
	public function restpic(){
		$imagesRoot = 'images';
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('userfile');
		// 移动到框架应用根目录/public/uploads/ 目录下
		if($file){
			//$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			$info = $file->validate(['ext'=>'jpg,png','type'=>'image/jpeg,image/png'])->move(ROOT_PATH . 'public' . DS .$imagesRoot);
			if($info){
				// 成功上传后 获取上传信息
				/* // 输出 jpg
				 echo $info->getExtension();
				// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
				echo $info->getSaveName();
				// 输出 42a79759f284b767dfcb2a0197904287.jpg
				echo $info->getFilename(); */
				 
				//{"flag":"SUCCESS","source":"/image/15161682383818665428.jpg","path":"/image/15161682383818665428.jpg","type":"jpg"}
				 
				//水印处理  及图片压缩处理
				$image = \think\Image::open('./'.$imagesRoot.'/'.$info->getSaveName());
				// 返回图片的宽度
				$width = $image->width();
				// 返回图片的高度
				$height = $image->height();
				 
				if($width>100 || $height>100){
					$image->thumb(900,600,\think\Image::THUMB_SCALING)->save('./'.$imagesRoot.'/'.$info->getSaveName());
				}
				
				
				//用户UID
				$userid = session('userid');
				$formSet = array();
				$formSet['uicon'] = 'http://'.request()->host().'/'.$imagesRoot.'/'.$info->getSaveName();
				db('users')->where('userid',$userid)->update($formSet);
				
				exit('<script type="text/javascript">parent.CFW.dialog.alert("重置头像成功！", 4, { listener: function () { parent.location.href="'.url('pzu/inf').'"; } });</script>');
				
			}else{
				// 上传失败获取错误信息
				//echo $file->getError();
				exit('<script type="text/javascript">parent.CFW.dialog.alert("'.$file->getError().'", 0, null);</script>');
			}
		}
		
		return view();
	}
	
	/*修改账户信息成功*/
	public function saveucpl(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
		['user_name','require|length:2,20|chsDash','请输入用户名|用户名由2-20个字母/数字/汉字组成|用户名仅支持汉字、字母、数字及-_']
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$userid = session('userid');
		$userName = $data['user_name'];
		//检查用户名
		$userInfo = db('users')->where('username',$userName)->where('userid','<>',$userid)->find();
		if($userInfo){
			return ['status'=>202,'msg'=>'该用户名已存在'];
		}
		
		$dataset = [];
		$dataset['username'] = $data['user_name'];
		$dataset['qq'] = $data['user_qq'];
		$dataset['wx'] = $data['user_weixin'];
		
		$wheres = ['userid'=>$userid];
		$rs = db('users')->where($wheres)->update($dataset);
		
		//session 信息修改
		$userInfo = db('users')->where($wheres)->find();
		session('username',$userInfo['username']);
		session('userInfo',$userInfo);
		
		
		$datainf = [];
		if($userInfo['utype'] == 1){
			if($data['weeknum']<1){
				return ['status'=>207,'msg'=>'周交稿数需大于1'];
			}
			$datainf['weeknum'] = $data['weeknum'];
			$datainf['free'] = $data['free'];
			$datainf['content'] = $data['content'];
			db('users_xsinf')->where($wheres)->update($datainf);
		}else{
			$datainf['linkman'] = $data['linkman'];
			$datainf['linkphone'] = $data['linkphone'];
			$datainf['weeknum'] = $data['weeknum'];
			$datainf['content'] = $data['content'];
			db('users_wbinf')->where($wheres)->update($datainf);
		}
		return ['status'=>200,'msg'=>'账户信息设置成功！'];
	}
	
	/*认证 20190307-无用（认证上传图片）*/
	public function cert(){
		$userid = session('userid');
		//用户信息
		$wheres = ['userid'=>$userid];
		$info = db('users')->where($wheres)->find();
		$info['card_number'] = $info['card_number']?decrypt_pz($info['card_number']):'';
		$this->assign('info',$info);
		return view();
	}
	//认证保存
	public function certsave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
		['real_name','require|length:2,20|chsAlphaNum','请输入真实姓名|真实姓名不正确|真实姓名不正确'],
		['identity','require|length:15,18|number','请输入身份证号|身份证号不正确|身份证号不正确']
		];
		
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$data['identity'] = encryptd($data['identity']);
		$data['cert_time'] = date('Y-m-d H:i:s');
		
		$userid = session('userid');
		//用户信息
		$wheres = ['userid'=>$userid];
		$rs = db('users_info')->where($wheres)->update($data);
		
		return ['status'=>200,'msg'=>'认证信息保存成功！'];
	}
	
	/*修改手机*/
	//发送修改手机验证码
	public function sendcode(){
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$mobileStr = input('post.mobile/s');
		$type = input('post.type/s');
		
		if($type == 'original' || $type == 'restpay'){
			$userInfo = session('userInfo');
			$mobileStr = $userInfo['phone'];
		}else{
			
			if(empty($mobileStr)){
				return ['status'=>201,'msg'=>'请输入正确的手机号'];
			}
			if(!preg_match("/^1[3|4|5|6|7|8|9][0-9]\d{8}$/",$mobileStr)){
				return ['status'=>202,'msg'=>'手机号格式有误!'];
			}
			$wheres = ['phone'=>encryptd($mobileStr)];
			$userInfo = db('users')->where($wheres)->find();
			if($userInfo){
				return ['status'=>202,'msg'=>'该手机号已经被绑定!'];
			}
		}
		
		$randNum = rand(100000,999999);
		session($type.'Code',$randNum);
		
		
		$msg = $randNum.' ,这是您的验证码，请在5分钟内按页面提示提交验证码，如非本人操作请忽略。';
		$res = sendSms($mobileStr,$msg);
		if($res){
			return ['status'=>200,'msg'=>'验证码发送成功'.$randNum];
		}else{
			return ['status'=>200,'msg'=>'验证码发送失败，请稍后重新发送！'];
		}
	}
	//验证修改手机验证码
	public function checkCode(){
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$phoneCode = input('post.code/d');
		if(empty($phoneCode)){
			return ['status'=>201,'msg'=>'请输入您手机收到的验证码'];
		}
		$randNum = session('originalCode');
		if($phoneCode != $randNum){
			return ['status'=>203,'msg'=>'手机验证码不正确'];
		}
		return ['status'=>200,'msg'=>'成功'];
	}
	//保存修改手机
	public function savePhone(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$phoneCode = input('post.code/d');
		$newMobile = input('post.newMobile','','addslashes,strip_tags');
		if(empty($phoneCode)){
			return ['status'=>201,'msg'=>'请输入您手机收到的验证码'];
		}
		$randNum = session('newMobileCode');
		if($phoneCode != $randNum){
			return ['status'=>203,'msg'=>'手机验证码不正确'];
		}
		if(!preg_match("/^1[3|4|5|6|7|8|9][0-9]\d{8}$/",$newMobile)){
			return ['status'=>203,'msg'=>'手机号格式有误'];
		}
		
		$wheres = ['phone'=>encryptd($newMobile)];
		$userInfo = db('users')->where($wheres)->find();
		if($userInfo){
			return ['status'=>202,'msg'=>'该手机号已经被绑定!'];
		}
	
		$data = array();
		$data['phone'] = encryptd($newMobile);
		$userid = session('userid');
		$rs = db('users')->where('userid',$userid)->update($data);
		if($rs){
			return ['status'=>200,'msg'=>'修改成功'];
		}else{
			return ['status'=>230,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	
	/*重置登陆密码*/
	public function savelogpass(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
		['orgpass','require|length:6,20','请输入原密码|原密码不正确'],
		['newpass','require|length:6,20|alphaDash','请输入密码|密码由6-20字符组成|密码支持字母、数字及“-”、“_”组合'],
		['renewpass','require|confirm:newpass','请输入确认密码|确人密码和密码不一致']
		];
		
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$newpass = $data['newpass'];
		//用户
		$userid = session('userid');
		$userInfo = db('users')->where('userid',$userid)->find();
		if(md5(md5($data['orgpass']).decryptd($userInfo['random'])) != $userInfo['userpass']){
			return ['status'=>204,'msg'=>'原密码不正确！'];
		}
		
		//改密码
		$data = array();
		$random = create_salt(6);
		$data['random'] = encryptd($random);
		$data['userpass'] = md5(md5($newpass).$random);
		$rs = db('users')->where('userid',$userid)->update($data);
		
		if($rs){
			return ['status'=>200,'msg'=>'修改登陆密码成功'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	
	/*设置支付密码*/
	public function spaypass(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
		['newpass','require|length:8,20|alphaDash','请输入密码|密码由8-20字符组成|密码支持字母、数字及“-”、“_”组合'],
		['renewpass','require|confirm:newpass','请输入确认密码|确人密码和密码不一致']
		];
	
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$newpass = $data['newpass'];
	
		//用户
		$userid = session('userid');
		$userInfo = db('finance')->where('userid',$userid)->find();
	
		//密码
		$data = array();
		$random = create_salt(6);
		$data['random'] = encryptd($random);
		$data['paypass'] = md5(md5($newpass).$random);
		$rs = db('finance')->where('userid',$userid)->update($data);
	
		if($rs){
			return ['status'=>200,'msg'=>'设置支付密码成功'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	/*修改支付密码*/
	public function upaypass(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
		['orgpass','require|length:8,20','请输入原密码|原密码不正确'],
		['newpass','require|length:8,20|alphaDash','请输入密码|密码由8-20字符组成|密码支持字母、数字及“-”、“_”组合'],
		['renewpass','require|confirm:newpass','请输入确认密码|确人密码和密码不一致']
		];
	
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$newpass = $data['newpass'];
	
		//用户
		$userid = session('userid');
		$userInfo = db('finance')->where('userid',$userid)->find();
		if(md5(md5($data['orgpass']).decryptd($userInfo['random'])) != $userInfo['paypass']){
			return ['status'=>204,'msg'=>'原密码不正确！'];
		}
	
		//改密码
		$data = array();
		$random = create_salt(6);
		$data['random'] = encryptd($random);
		$data['paypass'] = md5(md5($newpass).$random);
		$rs = db('finance')->where('userid',$userid)->update($data);
		if($rs){
			return ['status'=>200,'msg'=>'修改支付密码成功！'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	/*重置支付密码*/
	public function rpaypass(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		
		$restpayCode = session('restpayCode');
		$rule = [
		['forGetVCode','require|eq:'.$restpayCode,'请输入验证码|验证码不正确'],
		['newpass','require|length:8,20|alphaDash','请输入密码|密码由8-20字符组成|密码支持字母、数字及“-”、“_”组合'],
		['renewpass','require|confirm:newpass','请输入确认密码|确人密码和密码不一致']
		];
	
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$newpass = $data['newpass'];
	
		//用户
		$userid = session('userid');
	
		//改密码
		$data = array();
		$random = create_salt(6);
		$data['random'] = encrypt_pz($random);
		$data['paypass'] = md5(md5($newpass).$random);
		$rs = db('finance')->where('userid',$userid)->update($data);
		if($rs){
			return ['status'=>200,'msg'=>'重置支付密码成功！'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	
	
	public function account(){
		$rule = [
		['keywords','alphaNum','字母和数字'],
		['typeKey','number','数字']
		];
		
		$data = request()->get();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			$keywords = $typeKey ='';
		}
		$page = input('get.pn/d');
		
		$keywords = $data['keywords'];
		$typeKey = $data['typeKey'];
		
		//只能查一年的
		$mytime= date("Y-m-d H:i:s", strtotime("-1 year"));
		$yxtime = date("Y-m-d H:i:s", strtotime("+1 months", strtotime($mytime)));
		$timess = strtotime($yxtime);
		
		$userid = session('userid');
		$wheres = ['userid'=>$userid,'addtime'=>['>=',$timess]];
		
		$this->assign('keywords',$keywords);
		$this->assign('typeKey',$typeKey);
		
		$urlStr = url('pzu/account');;
		$urlArr  = array();
		if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['business_no'] = ['like','%'.$keywords.'%'];
		}
		if(!empty($typeKey)){
			$urlArr['typeKey'] = $typeKey;
			$wheres['type'] = $typeKey-1;
		}
		
		$pagesize = 20;
		 
		$count = db('finance_monitor')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
		
		$lists = db('finance_monitor')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));



		
		//交易类型     0-充值|1-提现|11-稿费|12-打赏等
		$typeArr = getMonitorType();
		$this->assign('typeArr',$typeArr);
		
		//账户信息
		$wheres = ['userid'=>$userid];
		$finfo = db('finance')->where($wheres)->find();
		$this->assign('finfo',$finfo);
		return view();
	}
	
	/*****************************充值*****************************/
	public function recharge(){
		$userid = session('userid');
		$wheres = ['userid'=>$userid];
		$finfo = db('finance')->where($wheres)->find();
		$this->assign('finfo',$finfo);
		
		//卡包列表
		$wheres['pay_way'] = ['<>',"WECHAT"];
		$cardlists = db('users_card')->where($wheres)->order('is_def DESC')->select();
		$this->assign('cardlists',$cardlists);
		
		return view();
	}
	public function rechargelog(){
		$page = input('get.pn/d');
	
		$userid = session('userid');
		$wheres = ['userid'=>$userid];
	
		$urlStr = url('pzu/rechargelog');;
		$urlArr  = array();
	
		$pagesize = 10;
	
		$count = db('finance_recharge')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('finance_recharge')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageHtml',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		//1-待审|2-充值成功|3-充值失败
		$financeStatusArr = array('1'=>'处理中' ,'2'=>'充值成功' ,'3'=>'充值失败');
		$this->assign('financeStatusArr',$financeStatusArr);
		return view();
	}
	public function rechargeSave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		
		$data = request()->post();
		$rule = [['pay_way','require|alpha','请选择充值方式|充值方式不存在'],
			['amount','require|integer','请输入充值金额|充值金额必须为整数']
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$pay_way = $data['pay_way'];
		$userInfo = session('userInfo');
		$wheres = ['pay_way'=>$pay_way,'userid'=>$userInfo['userid'],'status'=>1];
		$info = db('users_card')->where($wheres)->find();
		if(empty($info)){
			return ['status'=>203,'msg'=>'充值方式不存在'];
		}
		
		$recharge_note = array();
		if($pay_way == 'ALIPAY'){
			$recharge_note['alipayAccount'] = $info['account'];
		}else{
			$recharge_note['realName'] = $info['realname'];
			$recharge_note['cardNum'] = $info['bk_card'];
			$recharge_note['bankName'] = $info['bk_name'];
			$recharge_note['bankFullName'] = $info['bk_fullname'];
			
			$pay_type = 'BANK';
		}
		
		//转化单位为分
		$recharge_amount = $data['amount'] * 100;
		
		$data = array();
		$recharge_no = getSerialNumber(1);
		$data['userid'] = $userInfo['userid'];
		$data['recharge_no'] = $recharge_no;
		$data['pay_way'] = $pay_way;
		$data['amount'] = $recharge_amount;
		$data['recharge_note'] = base64_encode(json_encode($recharge_note));
		$data['addtime'] = date('Y-m-d H:i:s');
		
		$rs = db('finance_recharge')->insert($data);
		
		//发短信通知给管理员
		$msg = '网编充值，请注意查收';
		$rs = sendSms('15336538031',$msg);
		
		/* 
		$webset = get_webset();
		$systemNewsTel = (strlen($webset['phone'])!=11)?15336538031:$webset['phone'];
		//$msgInfo = '用户于'.date('m月d日 H时i分',$now_times).'申请提现:'.$amount.'元，编号：'.$withdraw_no;
		$mobileStr = empty($systemNewsTel)?'13071876109,15336538031':'13071876109,'.$systemNewsTel;
		
		//充值模板//用户于{1}充值：{2}元，编号：{3}
		$templId = 199339;
		//sendQMsg($mobileStr,$templId,[date('m月d日 H时i分',time()),$recharge_amount,$recharge_no],$webset['sign']); */
		if($rs){
			return ['status'=>200,'msg'=>'充值记录保存成功，请尽快完成线下转账！'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}

	/*****************************卡包*****************************/
	public function card(){
		$userid = session('userid');
		//用户扩展信息表
		$wheres = ['userid'=>$userid];
		$uinfo = db('users_info')->where($wheres)->find();
		$this->assign('uinfo',$uinfo);
		
		$wheres = ['userid'=>$userid,'status'=>1];
		$lists = db('users_card')->where($wheres)->order('id DESC')->select();
		$this->assign('lists',$lists);
		
		$cardlist = [0,'BOC.png','ABC.png','CMB.png','ICBC.png','PSBC.png'
				,'COMM.png','CIB.png','CCB.png','GDB.png','SPDB.png'
				,'CITIC.png','CEB.png','CMBC.png','SPABANK.png','SHBANK.png'
				,'BJBANK.png','NBBANK.png','HZCB.png'];
		
		$this->assign('cardlist',$cardlist);
		return view();
	}
	
	public function cardsave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
	
		$data = request()->post();
		$pay_type = $data['pay_type'];
		
		if($pay_type == 'ALIPAY'){
			$rule = [
			['zfb_account','require|min:5|length:6,30','请输入支付宝账号|支付宝账号不正确|支付宝账号不正确']
			];
		}else if($pay_type == 'WECHAT'){
			$rule = [
			['wx_account','require|length:11,11|number','请输入微信手机号|微信手机号不正确|微信手机号只能是数字']
			];
		}else{
			$bkArr = array('1'=>'BOC','2'=>'ABC','3'=>'CMB','4'=>'ICBC','5'=>'PSBC','6'=>'COMM',
					'7'=>'CIB','8'=>'CCB','9'=>'GDB','10'=>'SPDB','11'=>'CITIC','12'=>'CEB','13'=>'CMBC',
					'14'=>'SPABANK','15'=>'SHBANK','16'=>'BJBANK','17'=>'NBBANK','18'=>'HZCB');
			$pay_type = $bkArr[$pay_type];
			if(empty($pay_type)){
				return ['status'=>202,'msg'=>'请选择收款银行！'];
			}
			
			$rule = [
			['bk_fullname','require|min:2|chsAlphaNum','请输入开户行名称|开户行名称不正确|只能是汉字、字母和数字'],
			['bk_card','require|min:2|number','请输入正确的卡号|卡号不正确|卡号只能是数字']
			];
		}
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$userInfo = session('userInfo');
		$wheres = ['userid'=>$userInfo['userid'],'status'=>1,'pay_way'=>$pay_type];
		$info = db('users_card')->where($wheres)->find();
		if($info){
			return ['status'=>203,'msg'=>'该卡账号已存在'];
		}
		
		//用户扩展信息表
		$wheres = ['userid'=>$userInfo['userid']];
		$uinfo = db('users_info')->where($wheres)->find();
		
		//数据组装
		$nowTimes = date('Y-m-d H:i:s');
		$card = array();
		$card['userid'] = $userInfo['userid'];
		$card['status'] = 1;
		$card['addtime'] = $nowTimes;
		$card['updatetime'] = $nowTimes;
		$card['pay_way'] = $pay_type;
		$card['real_name'] = $uinfo['real_name'];
		
		//支付宝
		if($pay_type == 'ALIPAY'){
			$card['account'] = addslashes(strip_tags($data['zfb_account']));
			//微信
		}elseif($pay_type == 'WECHAT'){
			$card['account'] = $data['wx_account'];
		}else{
			$bknameArr = array('BOC'=>'中国银行','ABC'=>'中国农业银行','CMB'=>'招商银行','ICBC'=>'中国工商银行','PSBC'=>'中国邮政储蓄银行','COMM'=>'交通银行',
					'CIB'=>'兴业银行','CCB'=>'中国建设银行','GDB'=>'广发银行','SPDB'=>'浦发银行','CITIC'=>'中信银行','CEB'=>'中国光大银行','CMBC'=>'中国民生银行',
					'SPABANK'=>'平安银行','SHBANK'=>'上海银行','BJBANK'=>'北京银行','NBBANK'=>'宁波银行','HZCB'=>'杭州银行');
			$card['bk_card'] = $data['bk_card'];
			$card['bk_name'] = $bknameArr[$pay_type];
			$card['bk_fullname'] = $data['bk_fullname'];
		}
		
		$rs = db('users_card')->insert($card);
		if($rs){
			return ['status'=>200,'msg'=>'保存成功！'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	//卡包解绑
	public function cardjc(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$objid = input('post.objid/d');
		//是否删除
		$del = input('post.del/d');
		
		$userInfo = session('userInfo');
		
		if($del){
			$wheres = ['userid'=>$userInfo['userid']];
			$num = db('users_card')->where($wheres)->count();
			if($num==1){
				return ['status'=>204,'msg'=>'至少要保留一个卡'];
			}
			$wheres = ['id'=>$objid,'userid'=>$userInfo['userid']];
			$rs = db('users_card')->where($wheres)->delete();
		}else{
			$wheres = ['userid'=>$userInfo['userid']];
			$rs = db('users_card')->where($wheres)->update(['is_def'=>0]);
			
			$wheres = ['id'=>$objid,'userid'=>$userInfo['userid']];
			$rs = db('users_card')->where($wheres)->update(['is_def'=>1]);
		}
		if($rs){
			return ['status'=>200,'msg'=>'解除成功！'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	
	/*****************************提现*****************************/
	public function withdraw(){
		$userid = session('userid');
		$wheres = ['userid'=>$userid];
		$finfo = db('finance')->where($wheres)->find();
		$this->assign('finfo',$finfo);
		
		//卡包列表
		$cardlists = db('users_card')->where($wheres)->order('is_def DESC')->select();
		$this->assign('cardlists',$cardlists);
		return view();
	}
	
	public function withdrawlog(){
		$page = input('get.pn/d');
		$userid = session('userid');
	
		//提现历史
		$urlStr = url('pzu/withdrawlog');;
		$urlArr  = array();
		$wheres = ['userid'=>$userid];
	
		$pagesize = 12;
	
		$count = db('finance_withdraw')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('finance_withdraw')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageHtml',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		//1-待审|2-提现成功|5-提现失败|6-取消提现
		$financeStatusArr = array('1'=>'处理中' ,'2'=>'成功' ,'5'=>'失败','6'=>'取消提现' );
		$this->assign('financeStatusArr',$financeStatusArr);
		return view();
	}
	
	//取消
	public function withdrawcancel() {
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		
		$data = request()->post();
		$rule = [['objno','require|alphaNum','参数错误！|参数错误！']];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$objno = $data['objno'];
		$userInfo = session('userInfo');
		$wheres = ['withdraw_no'=>$objno,'userid'=>$userInfo['userid'],'status'=>'1'];
		$info = db('finance_withdraw')->where($wheres)->find();
		if(empty($info)){
			return ['status'=>203,'msg'=>'提现交易不存在'];
		}
	
		//数据组装
		$now_times = date('Y-m-d H:i:s');
		$amount = $info['amount'];
	
		//交易明细
		$monitor = array();
		$serial_number = getSerialNumber(0);
		$monitor['userid'] = $userInfo['userid'];
		$monitor['serial_number'] = $serial_number;
		$monitor['business_no'] = $objno;
		$monitor['type'] = '1';
		$monitor['inout'] = '1';//1-收入|2-支出
		$monitor['amount'] = $amount;
		$monitor['remark'] = '取消提现';
		$monitor['addtime'] = $now_times;
		
		//取消改状态
		$data = array();
		$data['status'] = '6';
		
		db()->startTrans();
		try{
			$finfo = db('finance')->where('userid',$userInfo['userid'])->find();
				
			//业务更新
			$rs = db('finance_withdraw')->where($wheres)->update($data);
			if(!$rs){
				throw new \Exception("业务更新失败！");
			}
				
			//用户账户交易明细
			$monitor['amount_before'] = $finfo['balance'];
			$monitor['amount_after'] = $finfo['balance'] + $amount;
			//交易明细添加
			$rs = db('finance_monitor')->insert($monitor);
			if(!$rs){
				throw new \Exception("交易明细添加失败");
			}
				
			//账户金额更新
			$updata = ['balance'=>$monitor['amount_after']];
			$rs = db('finance')->where('userid',$userInfo['userid'])->update($updata);
			if(!$rs){
				throw new \Exception("账户金额更新失败");
			}
			
			// 提交事务
			db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
		
		exit(json_encode(array('status'=>200,'msg'=>'取消提现成功')));
	}
	
	//提现
	public function withdrawsave() {
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		
		$data = request()->post();
		$rule = [['pay_way','require','请选择提现卡'],
			['amount','require|integer','请输入提现金额|提现金额必须为整数'],
			['paypass','require|min:6','请输入支付密码|支付密码不正确']
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$pay_way = $data['pay_way'];
		$userInfo = session('userInfo');
		$wheres = ['pay_way'=>$pay_way,'userid'=>$userInfo['userid'],'status'=>1];
		$info = db('users_card')->where($wheres)->find();
		if(empty($info)){
			return ['status'=>203,'msg'=>'提现方式不存在'];
		}
		
		//支付密码
		$finfo = db('finance')->where('userid',$userInfo['userid'])->find();
		if(empty($finfo['paypass'])){
			return ['status'=>204,'msg'=>'请先设置支付密码！'];
		}
		if(md5(md5($data['paypass']).decryptd($finfo['random'])) != $finfo['paypass']){
			return ['status'=>203,'msg'=>'支付密码不正确！'];
		}
		
		$amount = $data['amount'] * 100;
		if($amount<100){
			return ['status'=>203,'msg'=>'最小的提现金额是1元！'];
		}
		$now_times = date('Y-m-d H:i:s');
		
		$withdrawNote = array();
		if($pay_way == 'ALIPAY'){
			$withdrawNote['alipayAccount'] = $info['account'];
			$withdrawNote['alipayRealName'] = $info['realname'];
		}elseif($pay_way == 'WECHAT'){
			$withdrawNote['wxAccount'] = $info['account'];
			$withdrawNote['wxRealName'] =  $info['realname'];
		}else{
			$withdrawNote['realName'] = $info['realname'];
			$withdrawNote['cardNum'] = $info['bk_card'];
			$withdrawNote['bankName'] = $info['bk_name'];
			$withdrawNote['bankFullName'] = $info['bk_fullname'];
		}

		$data = array();
		$withdraw_no = getSerialNumber(2);
		$data['userid'] = $userInfo['userid'];
		$data['withdraw_no'] = $withdraw_no;
		$data['pay_way'] = $pay_way;
		$data['amount'] = $amount;
		$data['withdraw_note'] = base64_encode(json_encode($withdrawNote));
		$data['addtime'] = $now_times;

		//交易明细
		$monitor = array();
		$serial_number = getSerialNumber(0);
		$monitor['userid'] = $userInfo['userid'];
		$monitor['serial_number'] = $serial_number;
		$monitor['business_no'] = $withdraw_no;
		$monitor['type'] = '1';
		$monitor['inout'] = '2';//1-收入|2-支出
		$monitor['amount'] = $amount;
		$monitor['remark'] = '提现';
		$monitor['addtime'] = $now_times;
		
		// 启动事务
		db()->startTrans();
		try{
			$finfo = db('finance')->where('userid',$userInfo['userid'])->find();
			if($amount > $finfo['balance']){
				throw new \Exception('最大提现金额是￥'.number_format($finfo['balance']/100).'元');
			}
			
			//业务添加
			$rs = db('finance_withdraw')->insert($data);
			if(!$rs){
				throw new \Exception("业务添加失败！");
			}
			
			//用户账户交易明细
			$monitor['amount_before'] = $finfo['balance'];
			$monitor['amount_after'] = $finfo['balance'] - $amount;
			//交易明细添加
			$rs = db('finance_monitor')->insert($monitor);
			if(!$rs){
				throw new \Exception("交易明细添加失败");
			}
			
			//账户金额更新
			$updata = ['balance'=>($finfo['balance'] - $amount)];
			$rs = db('finance')->where('userid',$userInfo['userid'])->update($updata);
			if(!$rs){
				throw new \Exception("账户金额更新失败");
			}
			
			// 提交事务
			db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
		
		//$msg = '网编提现，请及时处理';
		//$rs = sendSms('15336538031',$msg);
		/* //发短信通知给管理员
		$webset = get_webset();
		$systemNewsTel = $webset['phone'];
		//$msgInfo = '用户于'.date('m月d日 H时i分',$now_times).'申请提现:'.$amount.'元，编号：'.$withdraw_no;
		$mobileStr = empty($systemNewsTel)?'13071876109,15336538031':'13071876109,'.$systemNewsTel;
		
		//提现模板
		$templId = 199082;
		sendQMsg($mobileStr,$templId,[date('m月d日 H时i分',$now_times),$amount,$withdraw_no],$webset['sign']); */
		return ['status'=>200,'msg'=>'提现申请成功'];
	}
	/**********************经典语录*********************/
	public function wbclassic(){
		$data = request()->get();
		$rule = [['keywords','chsDash','1'],//汉字、字母、数字、下划线_及破折号-
		['pn','integer','3']//整数
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			//return ['status'=>201,'msg'=>$validate->getError()];
			$rmsg = $validate->getError();
			if($rmsg == 1){
				$data['keywords'] = '';
			}else{
				$data['pn'] = '';
			}
		}
		
		$keywords = $data['keywords'];
		$page = $data['pn'];
		
		//网编
		$userid = session('userid');
		$wheres = ['userid'=>$userid];
		$this->assign('keywords',$keywords);
		$this->assign('pn',$page);
			
		$urlStr = url('pzu/wbclassic');;
		$urlArr  = array();
		if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['classicno'] = $keywords;
		}
			
		$pagesize = 18;
		
		$count = db('users_wbclassic')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('users_wbclassic')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		
		return view();
	}
	//语录保存
	public function wbclassicsave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
	
		$rule = [
		['content','require|min:2','请输入经典语录内容|经典语录内容不正确']
		];
	
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		//数据整理
		$nowtimes = date('Y-m-d H:i:s');
		$userinfo = session('userInfo');
	
		
		$data['content'] = trim($data['content']);
			
		$objNo = $data['objNo'];	
		unset($data['objNo']);
		
		if(is_numeric($objNo)){
			$wheres = ['classicno'=>$objNo,'userid'=>$userinfo['userid']];
			$rs = db('users_wbclassic')->where($wheres)->update($data);
			//系统文章
		}else{
			//写手发布稿子
			$data['classicno'] = getSerialNumber(16);
			$data['userid'] = $userinfo['userid'];
			$data['updatetime'] = $nowtimes;
			$rs = db('users_wbclassic')->insert($data);
		}
		if($rs){
			return ['status'=>200,'msg'=>'保存成功！'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	
	//网编稿件要求 和 语录
	public function wbinf(){
		$data = request()->get();
		$rule = [['userid','alphaNum','1'],//字母、数字
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			$this->redirect(url('pzu/ygorder'));
		}
	
		$userid = $data['userid'];
		$wheres = ['userid'=>$userid];
		$wbinf = db('users_wbinf')->where($wheres)->find();
		if(empty($wbinf)){
			$this->redirect(url('pzu/ygorder'));
		}
		$this->assign('info',$wbinf);
		
		//网编语录
		$lists = db('users_wbclassic')->where($wheres)->order('id DESC')->limit(30)->select();
		$this->assign('lists',$lists);
		
		return view();
	}
	
	
	/**********************稿件管理*********************/
	public function news(){
		$data = request()->get();
		$rule = [['keywords','chsDash','1'],//汉字、字母、数字、下划线_及破折号-
		['suserid','alphaNum','2'],//字母、数字
		['pn','integer','3']//整数
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			//return ['status'=>201,'msg'=>$validate->getError()];
			$rmsg = $validate->getError();
			if($rmsg == 1){
				$data['keywords'] = '';
			}else if($rmsg == 2){
				$data['suserid'] = '';
			}else{
				$data['pn'] = '';
			}
		}
		
		$keywords = $data['keywords'];
		$suserid = $data['suserid'];
		$page = $data['pn'];
		
		$wheres = [];
		
		$userinfo = session('userInfo');
		if($userinfo['utype'] == 1){ //写手
			$wheres['author'] = $userinfo['userid'];
		}else{//网编
			$wheres['userid'] = $userinfo['userid'];
		}
		$orderlist = db('yg_order')->where($wheres)->order('endtime ASC')->select();
		$this->assign('orderlist',$orderlist);
		
		//约稿方、写手用户昵称
		$useridarr = ($userinfo['utype'] == 1)?getArrOne($orderlist,'nickname','userid'):getArrOne($orderlist,'anickname','author');
		$this->assign('useridarr',$useridarr);
		
		$this->assign('keywords',$keywords);
		$this->assign('suserid',$suserid);
		$this->assign('pn',$page);
			
		$urlStr = url('pzu/news');;
		$urlArr  = array();
		if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['news_no|title'] = ['like','%'.$keywords.'%'];
		}
		if(!empty($suserid)){
			if($userinfo['utype'] == 1){ //写手
				$wheres['userid'] = $suserid;
			}else{//网编
				$wheres['author'] = $suserid;
			}
		}
			
		$pagesize = 18;
	
		$count = db('yg_draft')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('yg_draft')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();

		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		
		//状态
		$this->assign('statusArr',getDraftStatus());	
		return view();
	}
	
	public function newsedit(){
		$objNo = input('get.objNo/s');
		if(!is_numeric($objNo)){
			$objNo = '';
		}
		$this->assign('objNo',$objNo);
		
		$userinfo = session('userInfo');
		//非超管理员
		if($userinfo['userid'] != getSuperTube()){
			if($userinfo['utype'] == 1){ //写手
				$wheres['author'] = $userinfo['userid'];
			}else{//网编
				$wheres['userid'] = $userinfo['userid'];
			}
		}
		$orderlist = db('yg_order')->where($wheres)->order('endtime ASC')->select();
		$this->assign('orderlist',$orderlist);
		
		//约稿方、写手用户昵称
		$useridarr = ($userinfo['utype'] == 1)?getArrOne($orderlist,'nickname','userid'):getArrOne($orderlist,'anickname','author');
		$this->assign('useridarr',$useridarr);
	
		if($objNo){
			$wheres['news_no'] = $objNo;
			$info = db('yg_draft')->where($wheres)->find();
			$this->assign('info',$info);
		}
		return view();
	}
	//写手发编稿子保存
	public function newssave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		
		$rule = [
			['title','require|min:2','请输入资讯标题|资讯标题不正确'],
			['pic','require','请上传封面图片'],
			['userid','require|alphaNum','请选择约稿方|约稿方不正确'],
			['summary','require|min:2','请输入资讯摘要|资讯摘要不正确'],
			['editorValue','require','请输入文章内容']
			];
		
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		//数据整理
		$nowtimes = date('Y-m-d H:i:s');
		$userinfo = session('userInfo');
		
		$data['title'] = trim($data['title']);
		$data['summary'] = trim($data['summary']);
		$data['updatetime'] = $nowtimes;
		$data['content'] = htmlspecialchars($_POST['editorValue']);
		 
		$objNo = $data['objNo'];
		 
		unset($data['objNo']);
		unset($data['editorValue']);
		 
		$data['pic'] = (stripos($data['pic'],request()->host()))?$data['pic']:'http://'.request()->host().$data['pic'];
		
		if(is_numeric($objNo)){
			$wheres = ['news_no'=>$objNo,'status'=>0];
			$wheres['author'] = $userinfo['userid'];
			$rs = db('yg_draft')->where($wheres)->update($data);
			//系统文章
		}else{
			//写手发布稿子
			$data['news_no'] = getSerialNumber(11);
			$data['author'] = $userinfo['userid'];
			$data['addtime'] = $nowtimes;
			
			
			// 启动事务
			db()->startTrans();
			try{
				$rs = db('yg_draft')->insert($data);
				if(!$rs){
					throw new \Exception("文章添加失败");
				}
				
				//更新写手累计交稿数量
				$rs = db('users_xsinf')->where('userid',$userinfo['userid'])->setInc('totalwritten',1);
				if(!$rs){
					throw new \Exception("交稿数更新失败");
				}
				
				//更新网编累计收稿数量
				$rs = db('users_wbinf')->where('userid',$data['userid'])->setInc('totalwritten',1);
				if(!$rs){
					throw new \Exception("网编收稿数量更新失败");
				}
				
				//查询进行中的订单信息
				$orderwhere = ['status'=>6,'author'=>$userinfo['userid'],'userid'=>$data['userid']];
				$ors = db('yg_order')->where($orderwhere)->order('endtime ASC')->find();
				if(empty($ors)){
					throw new \Exception("约稿订单不存在");
				}
				//更新订单交稿数
				$rs = db('yg_order')->where('order_no',$ors['order_no'])->setInc('headnum',1);
				if(!$rs){
					throw new \Exception("订单交稿数更新失败");
				}
				
				// 提交事务
				db()->commit();
			} catch (\Exception $e) {
				// 回滚事务
				db()->rollback();;
				return ['status'=>206,'msg'=>$e->getMessage()];
			}
			
		}
		
		if($rs){
			return ['status'=>200,'msg'=>'保存成功！'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	//审稿
	public function newsaudit(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		//number
		$rule = [['objNo','require|alphaNum','审稿对象不存在|审稿对象不存在'],['upstatus','require|integer','请审稿|审稿状态不正确']];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		//数据整理
		$nowtimes = date('Y-m-d H:i:s');
		$userinfo = session('userInfo');
			
		$objNo = $data['objNo'];
		
		unset($data['objNo']);
	
		$wheres = ['news_no'=>$objNo,'userid'=>$userinfo['userid'],'status'=>0];	
		//8-退稿;1-收稿：平价收稿；2-优:加2元收稿；3-赞：加5元收稿;4-赏：加5、10等元收稿。
		$updata = ['updatetime'=>date('Y-m-d H:i:s')];
		$upstatus = $data['upstatus'];
		switch ($upstatus) {
			case 8: //退稿
				$updata['status'] = 8;
				$updata['feedback'] = $data['feedback']?$data['feedback']:'退稿！';
				$rs = db('yg_draft')->where($wheres)->update($updata);
				break;
			case 1://收稿
				$updata['status'] = 1;
				$updata['feedback'] = $data['feedback']?$data['feedback']:'稿子写的不错！';
				$updata['amount'] = 0;
				break;
			case 2:
				$updata['status'] = 1;
				$updata['upstatus'] = $upstatus;
				$updata['amount'] = 200;
				$updata['feedback'] = $data['feedback']?$data['feedback']:'稿子写的很不错！';
				break;
			case 3:
				$updata['status'] = 1;
				$updata['upstatus'] = $upstatus;
				$updata['amount'] = 500;
				$updata['feedback'] = $data['feedback']?$data['feedback']:'稿子写的很不错，为你点赞！';
				break;
			case 4:
				$updata['status'] = 1;
				$updata['upstatus'] = $upstatus;
				$updata['amount'] = 1000;
				$updata['feedback'] = $data['feedback']?$data['feedback']:'稿子写的很不错，很赞！';
				break;
			default: //收稿
				$updata['status'] = 1;
				$updata['feedback'] = $data['feedback']?$data['feedback']:'稿子写的不错！';
				$updata['amount'] = 0;
				break;
		}
		/*收稿，平台付钱给写手，同时如点赞加钱
		 * 费用与平台平分,各50%;
		*/
		if($updata['status'] == 1){
			//查询稿件信息
			$info = db('yg_draft')->where($wheres)->find();
			if(empty($info)){
				return ['status'=>206,'msg'=>'稿件不存在或已审'];
			}
			
			//查询写手应付稿费
			$xsinfo = db('users_xsinf')->where('userid',$info['author'])->find();
			$gaofee = $xsinfo['gaofee'];
			//交易明细
			$gaomonitor = array();
			$serial_number = getSerialNumber(0);
			$gaomonitor['userid'] = $info['author'];
			$gaomonitor['serial_number'] = $serial_number;
			$gaomonitor['business_no'] = $objNo;
			$gaomonitor['type'] = '11';
			$gaomonitor['inout'] = '1';//1-收入|2-支出
			$gaomonitor['amount'] = $gaofee;
			$gaomonitor['remark'] = '编号：'.$objNo.' 的文章稿费';
			$gaomonitor['addtime'] = $nowtimes;
							
			//打赏金额
			$amount = $updata['amount'];
			if($amount>0){
			//交易明细
			$monitor = array();
				$serial_number = getSerialNumber(0);
				$monitor['userid'] = $userinfo['userid'];
				$monitor['serial_number'] = $serial_number;
				$monitor['business_no'] = $objNo;
				$monitor['type'] = '12';
				$monitor['inout'] = '2';//1-收入|2-支出
				$monitor['amount'] = $amount;
				$monitor['remark'] = '编号：'.$objNo.' 的文章打赏';
				$monitor['addtime'] = $nowtimes;
			}
			
			// 启动事务
			db()->startTrans();
			try{
				//更新稿件状态
				$rs = db('yg_draft')->where($wheres)->update($updata);
				if(!$rs){
					throw new \Exception("稿件状态更新失败");
				}
	
				//查询写手信息
				$xinf = db('users_xsinf')->where('userid',$info['author'])->find();
				$upsdata = ['towritten'=>$xinf['towritten']-1,'haswritten'=>$xinf['haswritten']+1];
				//更新写手交稿数量
				$rs = db('users_xsinf')->where('userid',$info['author'])->update($upsdata);
				if(!$rs){
					throw new \Exception("写手交稿数更新失败");
				}
	
				//查询网编信息
				$winf = db('users_wbinf')->where('userid',$userinfo['userid'])->find();
				$upsdata = ['wantwritten'=>$winf['wantwritten']-1,'haswritten'=>$winf['haswritten']+1];
				//更新网编收稿数量
				$rs = db('users_wbinf')->where('userid',$userinfo['userid'])->update($upsdata);
				if(!$rs){
					throw new \Exception("网编收稿数量更新失败");
				}
				
				/*查询并更新订单信息*/
				$orderwhere = ['status'=>6,'author'=>$info['author'],'userid'=>$userinfo['userid']];
				$ors = db('yg_order')->where($orderwhere)->order('endtime ASC')->find();
				if(empty($ors)){
					throw new \Exception("约稿订单不存在");
				}
				//更新订单交稿数,如过稿等于订单约稿数，则订单结束
				$oupdata = ['passnum'=>$ors['passnum']+1];
				if($ors['num'] == ($ors['passnum']+1)){
					$oupdata['status'] = 9;
					$oupdata['finishtime'] = $nowtimes;
				}
				$rs = db('yg_order')->where('order_no',$ors['order_no'])->update($oupdata);
				if(!$rs){
					throw new \Exception("订单交稿数更新失败");
				}
	
				/*写手加稿费*/
				$xfinfo = db('finance')->where('userid',$info['author'])->find();
	
				//系统账户明细
				$gaomonitor['amount_before'] = $xfinfo['balance'];
				$xsma = $gaomonitor['amount_after'] = $xfinfo['balance'] + $gaofee;
				//交易明细添加
				$rs = db('finance_monitor')->insert($gaomonitor);
				if(!$rs){
					throw new \Exception("系统账户交易明细添加失败");
				}
	
				//查询系统账户
				$sinfo = db('finance')->where('userid','zls2019')->find();
	
				//系统账户明细
				$gaomonitor['userid'] = 'zls2019';
				$gaomonitor['amount'] = $gaofee;
				$gaomonitor['inout'] = '2';
				$gaomonitor['amount_before'] = $sinfo['balance'];
				$syma = $gaomonitor['amount_after'] = $sinfo['balance'] - $gaofee;
				//交易明细添加
				$rs = db('finance_monitor')->insert($gaomonitor);
				if(!$rs){
					throw new \Exception("系统账户交易明细添加失败");
				}
	
				if($amount>0){
					/*网编扣钱*/
					$finfo = db('finance')->where('userid',$userinfo['userid'])->find();
						
					//用户账户交易明细
					$monitor['amount_before'] = $finfo['balance'];
					$monitor['amount_after'] = $finfo['balance'] - $amount;
					//交易明细添加
					$rs = db('finance_monitor')->insert($monitor);
					if(!$rs){
						throw new \Exception("交易明细添加失败");
					}

					//账户金额更新
					$updata = ['balance'=>$monitor['amount_after']];
					$rs = db('finance')->where('userid',$userinfo['userid'])->update($updata);
					if(!$rs){
						throw new \Exception("账户金额更新失败");
					}
	
	
					/*写手加赏金*/
					$xamount = ceil($amount / 2);
	
					//系统账户明细
					$monitor['userid'] = $info['author'];
					$monitor['amount'] = $xamount;
					$monitor['inout'] = '1';
					$monitor['amount_before'] = $xsma;
					$monitor['amount_after'] = $xsma + $xamount;
					//交易明细添加
					$rs = db('finance_monitor')->insert($monitor);
					if(!$rs){
						throw new \Exception("系统账户交易明细添加失败");
					}
						
					//重置，便于写手保存
					$xsma = $monitor['amount_after'];
						
					/*系统加赏金*/
					$amount = $amount - $xamount;
					//系统账户明细
					$monitor['userid'] = 'zls2019';
					$monitor['amount'] = $amount;
					$monitor['inout'] = '1';
					$monitor['amount_before'] = $syma;
					$monitor['amount_after'] = $syma + $amount;
					//交易明细添加
					$rs = db('finance_monitor')->insert($monitor);
					if(!$rs){
						throw new \Exception("系统账户交易明细添加失败");
					}
	
					//重置，便于系统保存
					$syma = $monitor['amount_after'];
				}
	
				//写手账户金额更新
				$upsdata = ['balance'=>$xsma];
				$rs = db('finance')->where('userid',$info['author'])->update($upsdata);
				if(!$rs){
					throw new \Exception("系统账户金额更新失败");
				}
	
				//系统账户金额更新
				$upsdata = ['balance'=>$syma];
				$rs = db('finance')->where('userid','zls2019')->update($upsdata);
				if(!$rs){
					throw new \Exception("系统账户金额更新失败");
				}
				// 提交事务
				db()->commit();
			} catch (\Exception $e) {
				// 回滚事务
				db()->rollback();;
				return ['status'=>206,'msg'=>$e->getMessage()];
			}
		}
		
		if($rs){
			return ['status'=>200,'msg'=>'保存成功！'];
		}else{
			return ['status'=>209,'msg'=>'系统繁忙，请稍后重试！'];
		}
	}
	
	/*****************************约稿订单*****************************/
	public function ygorder(){
		$data = request()->get();
		$rule = [['keywords','chsDash','1'],//汉字、字母、数字、下划线_及破折号-
		['suserid','alphaNum','2'],//字母、数字
		['pn','integer','3']//整数
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			//return ['status'=>201,'msg'=>$validate->getError()];
			$rmsg = $validate->getError();
			if($rmsg == 1){
				$data['keywords'] = '';
			}else if($rmsg == 2){
				$data['suserid'] = '';
			}else{
				$data['pn'] = '';
			}
		}
		
		$keywords = $data['keywords'];
		$suserid = $data['suserid'];
		$page = $data['pn'];
		
		$wheres = [];
		
		$userinfo = session('userInfo');
		if($userinfo['utype'] == 1){ //写手
			$wheres['author'] = $userinfo['userid'];
		}else{//网编
			$wheres['userid'] = $userinfo['userid'];
		}
		
		$orderlist = db('yg_order')->where($wheres)->order('endtime ASC')->select();
		$this->assign('orderlist',$orderlist);
		
		//约稿方、写手用户昵称
		$useridarr = ($userinfo['utype'] == 1)?getArrOne($orderlist,'nickname','userid'):getArrOne($orderlist,'anickname','author');
		$this->assign('useridarr',$useridarr);
		
		$this->assign('keywords',$keywords);
		$this->assign('suserid',$suserid);
		$this->assign('pn',$page);
			
		$urlStr = url('pzu/ygorder');;
		$urlArr  = array();
		if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['order_no'] = $keywords;
		}
		if(!empty($suserid)){
			
			if($userinfo['utype'] == 1){ //写手
				$wheres['userid'] = $suserid;
			}else{//网编
				$wheres['author'] = $suserid;
			}
		}
			
		$pagesize = 18;
		
		$count = db('yg_order')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('yg_order')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		
		//状态6-进行中|9-结束
		$statusArr = [6=>'进行中',9=>'结束'];
		$this->assign('statusArr',$statusArr);
		
		return view();
	}
	
	//网编约稿
	public function toyg(){
		//网编
		$userid = session('userid');
		//网编扩展信息
		$wheres = ['userid'=>$userid];
		$infomore = db('users_wbinf')->where($wheres)->find();
		$this->assign('infomore',$infomore);
		
		//财务信息
		$finfo = db('finance')->where($wheres)->find();
		$this->assign('finfo',$finfo);
		
		
		$data = request()->get();
		$rule = [['keywords','chsDash','1'],//汉字、字母、数字、下划线_及破折号-
		['pn','integer','3']//整数
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			//return ['status'=>201,'msg'=>$validate->getError()];
			$rmsg = $validate->getError();
			if($rmsg == 1){
				$data['keywords'] = '';
			}else{
				$data['pn'] = '';
			}
		}
	
		$keywords = $data['keywords'];
		$page = $data['pn'];
		
		//空闲的写手
		$wheres = ['free'=>1];
		$this->assign('keywords',$keywords);
		$this->assign('pn',$page);
			
		$urlStr = url('pzu/toyg');;
		$urlArr  = array();
		if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['nickname'] = ['like','%'.$keywords.'%'];
		}
			
		$pagesize = 18;
		
		$count = db('users_xsinf')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('users_xsinf')->where($wheres)->order('updatetime DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
	
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		
		return view();
	}
	
	//约稿保存
	public function ygsave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		
		$rule = [
			['author','require|alphaNum','请选择作家|作家不存在'],
			['num','require|integer|egt:10','请输入约稿篇数|约稿篇数必需为整数|约稿篇数须大于10'],
			['paypass','require','请输入支付密码']
			];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$num = $data['num'];
		$author = $data['author'];
		$paypass = $data['paypass'];
		
		$userinfo = session('userInfo');
		
		//支付密码
		$finfo = db('finance')->where('userid',$userinfo['userid'])->find();
		if(empty($finfo['paypass'])){
			return ['status'=>204,'msg'=>'请先设置支付密码！'];
		}
		if(md5(md5($paypass).decryptd($finfo['random'])) != $finfo['paypass']){
			return ['status'=>203,'msg'=>'支付密码不正确！'];
		}
		
		//写手信息
		$authorinf = db('users_xsinf')->where('userid',$author)->find();
		
		//数据整理
		$nowtimes = date('Y-m-d H:i:s');
		
		$weeknum = ceil($num * 1.5 / $authorinf['weeknum']);
		$order_no = getSerialNumber(15);
		$amount = $num * $authorinf['prices'];
		
		$odata = [];
		$odata['order_no'] = $order_no;
		$odata['userid'] = $userinfo['userid'];
		$odata['nickname'] = $userinfo['nickname'];
		$odata['author'] = $author;
		$odata['anickname'] = $authorinf['nickname'];
		$odata['prices'] = $authorinf['prices'];
		
		$odata['num'] = $num;
		$odata['amount'] = $amount;
		$odata['starttime'] = $nowtimes;
		$odata['endtime'] = date('Y-m-d H:i:s',strtotime("+$weeknum week"));
		
		$odata['status'] = 6;//订单状态：6-进行中|9-结束
		$odata['pay_status'] = 2;//订单状态：1-未支付|2-已支付
		$odata['paytime'] = $nowtimes;
		$odata['addtime'] = $nowtimes;
		$odata['updatetime'] = $nowtimes;
		
		//交易明细
		$monitor = array();
		$serial_number = getSerialNumber(0);
		$monitor['userid'] = $userinfo['userid'];
		$monitor['serial_number'] = $serial_number;
		$monitor['business_no'] = $order_no;
		$monitor['type'] = '15';
		$monitor['inout'] = '2';//1-收入|2-支出
		$monitor['amount'] = $amount;
		$monitor['remark'] = '约稿订单：'.$order_no;
		$monitor['addtime'] = $nowtimes;
		
		// 启动事务
		db()->startTrans();
		try{
			
			/*扣钱*/
			$finfo = db('finance')->where('userid',$userinfo['userid'])->find();
			if($amount > $finfo['balance']){
				throw new \Exception("账户余额不足");
			}
			
			//约稿订单添加
			$rs = db('yg_order')->insert($odata);
			if(!$rs){
				throw new \Exception("交易明细添加失败");
			}
			
			//增加待收稿数
			$rs = db('users_wbinf')->where('userid',$userinfo['userid'])->setInc('wantwritten',$num);
			if(!$rs){
				throw new \Exception("待收稿数更新失败");
			}
			//增加待交稿数
			$rs = db('users_xsinf')->where('userid',$author)->setInc('towritten',$num);
			if(!$rs){
				throw new \Exception("待交稿数更新失败");
			}
			
			
			//用户账户交易明细
			$monitor['amount_before'] = $finfo['balance'];
			$monitor['amount_after'] = $finfo['balance'] - $amount;
			//交易明细添加
			$rs = db('finance_monitor')->insert($monitor);
			if(!$rs){
				throw new \Exception("交易明细添加失败");
			}
			//账户金额更新
			$updata = ['balance'=>$monitor['amount_after']];
			$rs = db('finance')->where('userid',$userinfo['userid'])->update($updata);
			if(!$rs){
				throw new \Exception("账户金额更新失败");
			}
		
			/*系统加钱*/
			//查询系统账户
			$sinfo = db('finance')->where('userid','zls2019')->find();
				
			//系统账户明细
			$monitor['userid'] = 'zls2019';
			$monitor['amount'] = $amount;
			$monitor['inout'] = '1';
			$monitor['amount_before'] = $sinfo['balance'];
			$monitor['amount_after'] = $sinfo['balance'] + $amount;
			//交易明细添加
			$rs = db('finance_monitor')->insert($monitor);
			if(!$rs){
				throw new \Exception("系统账户交易明细添加失败");
			}
		
			//账户金额更新
			$upsdata = ['balance'=>$monitor['amount_after']];
			$rs = db('finance')->where('userid','zls2019')->update($upsdata);
			if(!$rs){
				throw new \Exception("系统账户金额更新失败");
			}
			// 提交事务
			db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
		
		/*约稿订单短信*/
		$authoruinf = db('users')->where('userid',$author)->find();
		$mobile = decryptd($authoruinf['phone']);
		$msg = '您有新的约稿订单，订单编号：'.$order_no.'。请及时到平台处理！';
		$rs = sendSms($mobile,$msg);
		return ['status'=>200,'msg'=>'约稿成功'];
	}
	
	
	/*****************************用户管理*****************************/
	public function users(){
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			$this->redirect(url('pzu/inf'));
		}
		
		$keywords = input('get.keywords','','addslashes,strip_tags');
		$page = input('get.pn/d');
		
		$this->assign('keywords',$keywords);
		
		//约稿方、写手用户昵称
		//网编用户列表
		$wblist = db('users_wbinf')->select();
		$wbidarr = getArrOne($wblist,'nickname','userid');
		$wbidarr['zls2019'] = '系统';
		//写手用户列表
		$xslist = db('users_xsinf')->select();
		$xsidarr = getArrOne($xslist,'nickname','userid');
		//用户
		$useridarr = array_merge($wbidarr,$xsidarr);
		$this->assign('useridarr',$useridarr);
		
		$wheres = [];
		$urlStr = url('pzu/users');;
		$urlArr  = array();
		if(in_array($keywords,$useridarr)){
			$suserid = array_search($keywords,$useridarr);
			$wheres['userid'] = $suserid;
		}else if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['username|phone'] = ['like','%'.$keywords.'%'];
		}
	
		$pagesize = 20;
			
		$count = db('users')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
	
		$lists = db('users')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
	
		//组装用户账户余额
		$useridArr = getArrOne($lists,'userid');
		$wheres = ['userid'=>['in',$useridArr]];
		$flists = db('finance')->where($wheres)->select();
		$flists = getArrOne($flists,'balance','userid');
		$this->assign('flists',$flists);
	
		return view();
	}
	public function userinf(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			return ['status'=>221,'msg'=>'非法请求！'];
		}
		
		$data = request()->post();
		$rule = [['userid','require|alphaNum','参数错误！|参数错误！'],['type','require|integer','参数错误！|参数错误！']];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$userid = $data['userid'];
		$utype = $data['type'];
		$tablenames = $utype==1?'users_xsinf':'users_wbinf';
		$inf = db($tablenames)->where('userid',$userid)->find();
		return ['status'=>200,'msg'=>$inf];
	}
	public function usersave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			return ['status'=>221,'msg'=>'非法请求！'];
		}
	
		$data = request()->post();
		$rule = [['userid','require|alphaNum','参数错误！|参数错误！'],['utype','require|integer','参数错误！|参数错误！']];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$userid = $data['userid'];
		$utype = $data['utype'];
		unset($data['utype']);
		
		//写手
		if($utype==1){
			$tablenames = 'users_xsinf';
		}else{
			$tablenames = 'users_wbinf';
			unset($data['gaofee']);
			unset($data['prices']);
		}
		
		$tablenames = $utype==1?'users_xsinf':'users_wbinf';
		$inf = db($tablenames)->where('userid',$userid)->update($data);
		return ['status'=>200,'msg'=>'成功'];
	}
	/**************************认证管理*****************************/
	public function mcert(){
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			$this->redirect(url('pzu/inf'));
		}
	
		$page = input('get.pn/d');
	
		//提现历史
		$urlStr = url('pzu/mcert');;
		$urlArr  = array();
	
		$pagesize = 12;
		$wheres = [];
		$count = db('users_info')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('users_info')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageHtml',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		//0-待认证|:1-已认证|3-认证未通过
		$statusArr = array('0'=>'待审核' ,'1'=>'已认证' ,'3'=>'未通过' );
		$this->assign('statusArr',$statusArr);
		return view();
	}
	public function mcertsave() {
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			return ['status'=>221,'msg'=>'非法请求！'];
		}
	
		$data = request()->post();
		$rule = [['objid','require|alphaNum','参数错误！|参数错误！']];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$objid = $data['objid'];
		$status = $data['status'];
		if(!in_array($status,[1,3])){
			return ['status'=>202,'msg'=>'审核状态不正确！'];
		}
	
	
		//数据组装
		$now_times = date('Y-m-d H:i:s');
	
		//提现失败改状态
		$updata = array();
		$updata['status'] = $status;
		$updata['updatetime'] = $now_times;
		$rs = db('users_info')->where('id',$objid)->update($updata);
		if($rs){
			return ['status'=>200,'msg'=>'业务更新成功'];
		}else{
			return ['status'=>209,'msg'=>'业务更新失败'];
		}
	}
	/*****************************登陆明细*****************************/
	public function login(){
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			$this->redirect(url('pzu/inf'));
		}
		
		$keywords = input('get.keywords','','addslashes,strip_tags');
		$page = input('get.pn/d');
	
		$this->assign('keywords',$keywords);
	
		$urlStr = url('pzu/login');;
		$urlArr  = array();
		if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['username|phone'] = ['like','%'.$keywords.'%'];
		}
	
		$pagesize = 10;
			
		$count = db('users_loginlog')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
	
		$lists = db('users_loginlog')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
	
		return view();
	}
	//管理员收支明细
	public function maccount(){
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			$this->redirect(url('pzu/inf'));
		}
		
		$rule = [
		['keywords','alphaNum','字母和数字'],
		['typeKey','number','数字']
		];
	
		$data = request()->get();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			$keywords = $typeKey ='';
		}
		$page = input('get.pn/d');
	
		$keywords = trim($data['keywords']);
		$typeKey = $data['typeKey'];
		
		$this->assign('keywords',$keywords);
		$this->assign('typeKey',$typeKey);
		
		//网编用户列表
		$wblist = db('users_wbinf')->select();
		$wbidarr = getArrOne($wblist,'nickname','userid');
		$wbidarr['zls2019'] = '系统';
		//写手用户列表
		$xslist = db('users_xsinf')->select();
		$xsidarr = getArrOne($xslist,'nickname','userid');
		//用户
		$useridarr = array_merge($wbidarr,$xsidarr);
		$this->assign('useridarr',$useridarr);
		
		$urlStr = url('pzu/maccount');;
		$urlArr  = array();
		$wheres = [];
		if(in_array($keywords,$useridarr)){
			$suserid = array_search($keywords,$useridarr);
			$wheres['userid'] = $suserid;
		}else if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['business_no'] = ['like','%'.$keywords.'%'];
		}
		if(!empty($typeKey)){
			$urlArr['typeKey'] = $typeKey;
			$wheres['type'] = $typeKey-1;
		}
	
		$pagesize = 20;
			
		$count = db('finance_monitor')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
	
		$lists = db('finance_monitor')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
	
		//交易类型     0-充值|1-提现|11-稿费|12-打赏等
		$typeArr = getMonitorType();
		$this->assign('typeArr',$typeArr);
		
		return view();
	}
	/**************************充值管理*****************************/
	public function mrecharge(){
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			$this->redirect(url('pzu/inf'));
		}
		
		$page = input('get.pn/d');
	
		$urlStr = url('pzu/rechargelog');
		$urlArr  = array();
	
		$pagesize = 10;
		$wheres = [];
		$count = db('finance_recharge')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('finance_recharge')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageHtml',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		//1-待审|2-充值成功|3-充值失败
		$financeStatusArr = array('1'=>'处理中' ,'2'=>'充值成功' ,'3'=>'充值失败');
		$this->assign('financeStatusArr',$financeStatusArr);
		return view();
	}
	//充值审核
	public function mchargesave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			return ['status'=>221,'msg'=>'非法请求！'];
		}
		
		$objno = input('post.objno/s');
		$status = input('post.status/d');
		if(!in_array($status,array(2,3))){
			return ['status'=>202,'msg'=>'充值状态不正确！'];
		}
		
		$wheres = ['recharge_no'=>$objno,'status'=>1];
		$info = db('finance_recharge')->where($wheres)->find();
		if(empty($info)){
			return ['status'=>203,'msg'=>'充值业务不存在！'];
		}
		
		//数据整理
		$amount = $info['amount'];
		$now_times = date('Y-m-d H:i:s');
		$back_receipt = $status==2?'充值成功':'未收到款项';
		
		$updata = array();
		$updata['status'] = $status;
		$updata['audit_time'] = $now_times;
		$updata['back_receipt'] = $back_receipt;
		$updata['muserid'] = session('userid');
		
		if($status==3){
			$rs = db('finance_recharge')->where($wheres)->update($updata);
		}else{
			
			//交易明细
			$monitor = array();
			$serial_number = getSerialNumber(0);
			$monitor['userid'] = $info['userid'];
			$monitor['serial_number'] = $serial_number;
			$monitor['business_no'] = $info['recharge_no'];
			$monitor['type'] = '0';
			$monitor['inout'] = '1';//1-收入|2-支出
			$monitor['amount'] = $amount;
			$monitor['remark'] = '充值';
			$monitor['addtime'] = $now_times;
			
			// 启动事务
			db()->startTrans();
			try{
				//更新业务
				$rs = db('finance_recharge')->where($wheres)->update($updata);
				if(!$rs){
					throw new \Exception("业务更新失败！");
				}
				//加金额
				$finfo = db('finance')->where('userid',$info['userid'])->find();
				
				//用户账户交易明细
				$monitor['amount_before'] = $finfo['balance'];
				$monitor['amount_after'] = $finfo['balance'] + $amount;
				//交易明细添加
				$rs = db('finance_monitor')->insert($monitor);
				if(!$rs){
					throw new \Exception("交易明细添加失败");
				}
					
				//账户金额更新
				$updata = ['balance'=>$monitor['amount_after']];
				$rs = db('finance')->where('userid',$info['userid'])->update($updata);
				if(!$rs){
					throw new \Exception("账户金额更新失败");
				}
				
				// 提交事务
				db()->commit();
			} catch (\Exception $e) {
				// 回滚事务
				db()->rollback();;
				return ['status'=>206,'msg'=>$e->getMessage()];
			}
		
		}
		
		if($rs){
			return ['status'=>200,'msg'=>'业务更新成功'];
		}else{
			return ['status'=>209,'msg'=>'业务更新失败'];
		}
		
	}
	
	/**************************提现管理*****************************/
	public function mwithdraw(){
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			$this->redirect(url('pzu/inf'));
		}
		
		$page = input('get.pn/d');
	
		//提现历史
		$urlStr = url('pzu/mwithdraw');;
		$urlArr  = array();
	
		$pagesize = 12;
		$wheres = [];
		$count = db('finance_withdraw')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('finance_withdraw')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		$this->assign('pageHtml',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
		//1-待审|2-提现成功|5-提现失败|6-取消提现
		$financeStatusArr = array('1'=>'处理中' ,'2'=>'成功' ,'5'=>'失败','6'=>'取消提现' );
		$this->assign('financeStatusArr',$financeStatusArr);
		return view();
	}
	public function mwithdrawsave() {
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			return ['status'=>221,'msg'=>'非法请求！'];
		}
	
		$data = request()->post();
		$rule = [['objno','require|alphaNum','参数错误！|参数错误！']];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$objno = $data['objno'];
		$status = $data['status'];
		if(!in_array($status,[2,5])){
			return ['status'=>202,'msg'=>'充值状态不正确！'];
		}
	
		$wheres = ['withdraw_no'=>$objno,'status'=>'1'];
		$info = db('finance_withdraw')->where($wheres)->find();
		if(empty($info)){
			return ['status'=>203,'msg'=>'提现交易不存在'];
		}
	
		//数据组装
		$now_times = date('Y-m-d H:i:s');
		$back_receipt = ($status == 2)?'提现成功':'提现失败';
	
		//提现失败改状态
		$updata = array();
		$updata['status'] = $status;
		$updata['audit_time'] = $now_times;
		$updata['back_receipt'] = $back_receipt;
		$updata['muserid'] = session('userid');
		
		
		if($status == 2){//提现成功
			$rs = db('finance_withdraw')->where($wheres)->update($updata);
		}else{//提现失败
			$amount = $info['amount'];
			
			//交易明细
			$monitor = array();
			$serial_number = getSerialNumber(0);
			$monitor['userid'] = $info['userid'];
			$monitor['serial_number'] = $serial_number;
			$monitor['business_no'] = $objno;
			$monitor['type'] = '1';
			$monitor['inout'] = '1';//1-收入|2-支出
			$monitor['amount'] = $amount;
			$monitor['remark'] = '提现失败';
			$monitor['addtime'] = $now_times;
			
			db()->startTrans();
			try{
				//业务更新
				$rs = db('finance_withdraw')->where($wheres)->update($updata);
				if(!$rs){
					throw new \Exception("业务更新失败！");
				}
				
				$finfo = db('finance')->where('userid',$info['userid'])->find();
		
				//用户账户交易明细
				$monitor['amount_before'] = $finfo['balance'];
				$monitor['amount_after'] = $finfo['balance'] + $amount;
				//交易明细添加
				$rs = db('finance_monitor')->insert($monitor);
				if(!$rs){
					throw new \Exception("交易明细添加失败");
				}
		
				//账户金额更新
				$updata = ['balance'=>$monitor['amount_after']];
				$rs = db('finance')->where('userid',$info['userid'])->update($updata);
				if(!$rs){
					throw new \Exception("账户金额更新失败");
				}
		
				// 提交事务
				db()->commit();
			} catch (\Exception $e) {
				// 回滚事务
				db()->rollback();;
				return ['status'=>206,'msg'=>$e->getMessage()];
			}
		}
		
		if($rs){
			return ['status'=>200,'msg'=>'业务更新成功'];
		}else{
			return ['status'=>209,'msg'=>'业务更新失败'];
		}
	}
	/*****************************管理员约稿订单*****************************/
	public function mygorder(){
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			$this->redirect(url('pzu/inf'));
		}
		
		$data = request()->get();
		$rule = [['keywords','chsDash','1'],//汉字、字母、数字、下划线_及破折号-
		['suserid','alphaNum','2'],//字母、数字
		['pn','integer','3']//整数
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			//return ['status'=>201,'msg'=>$validate->getError()];
			$rmsg = $validate->getError();
			if($rmsg == 1){
				$data['keywords'] = '';
			}else if($rmsg == 2){
				$data['suserid'] = '';
			}else{
				$data['pn'] = '';
			}
		}
	
		$keywords = $data['keywords'];
		$suserid = $data['suserid'];
		$page = $data['pn'];
	
		$wheres = [];
	
		$orderlist = db('yg_order')->where($wheres)->order('endtime ASC')->select();
		$this->assign('orderlist',$orderlist);
	
		//写手用户昵称
		$useridarr = getArrOne($orderlist,'anickname','author');
		$this->assign('useridarr',$useridarr);
		
		//约稿方昵称
		$yuseridarr = getArrOne($orderlist,'nickname','userid');
		$this->assign('yuseridarr',$yuseridarr);
	
		$this->assign('keywords',$keywords);
		$this->assign('suserid',$suserid);
		$this->assign('pn',$page);
			
		$urlStr = url('pzu/mygorder');;
		$urlArr  = array();
		if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['order_no'] = $keywords;
		}
		if(!empty($suserid)){
			$wheres['author'] = $suserid;
		}
			
		$pagesize = 18;
	
		$count = db('yg_order')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('yg_order')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
	
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
	
		//状态6-进行中|9-结束
		$statusArr = [6=>'进行中',9=>'结束'];
		$this->assign('statusArr',$statusArr);
	
		return view();
	}
	/**********************管理员稿件管理*********************/
	public function mnews(){
		$supertube = getSuperTube();
		if(session('userid') != $supertube){
			$this->redirect(url('pzu/inf'));
		}
		
		$data = request()->get();
		$rule = [['keywords','chsDash','1'],//汉字、字母、数字、下划线_及破折号-
		['pn','integer','3']//整数
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			//return ['status'=>201,'msg'=>$validate->getError()];
			$rmsg = $validate->getError();
			if($rmsg == 1){
				$data['keywords'] = '';
			}else{
				$data['pn'] = '';
			}
		}
	
		$keywords = $data['keywords'];
		$page = $data['pn'];
		$this->assign('keywords',$keywords);
		$this->assign('pn',$page);
		
		//约稿方、写手用户昵称
		//网编用户列表
		$wblist = db('users_wbinf')->select();
		$wbidarr = getArrOne($wblist,'nickname','userid');
		$wbidarr['zls2019'] = '系统';
		//写手用户列表
		$xslist = db('users_xsinf')->select();
		$xsidarr = getArrOne($xslist,'nickname','userid');
		//用户
		$useridarr = array_merge($wbidarr,$xsidarr);
		$this->assign('useridarr',$useridarr);
	
		//查询组装
		$wheres = [];
		$urlStr = url('pzu/mnews');;
		$urlArr  = array();
		if(in_array($keywords,$useridarr)){
			$suserid = array_search($keywords,$useridarr);
			$wheres['author|userid'] = $suserid;
		}else if(!empty($keywords)){
			$urlArr['keywords'] = $keywords;
			$wheres['news_no|title'] = ['like','%'.$keywords.'%'];
		}
		
			
		$pagesize = 18;
	
		$count = db('yg_draft')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('yg_draft')->where($wheres)->order('id DESC')->limit(($page-1)*$pagesize,$pagesize)->select();
	
		$this->assign('lists',$lists);
		$this->assign('pageStr',get_pzpage($count,$urlStr,$urlArr,$page,$pagesize));
	
		//状态
		$this->assign('statusArr',getDraftStatus());
		return view();
	}
}