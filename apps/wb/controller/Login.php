<?php
/* 登陆认证找回密码
 * @author Bill
 * @data 21080906
 */
namespace app\wb\controller;
use think\Controller;
use think\Validate;

class Login extends Controller{
	public function __construct() {
		parent::__construct();
	}
	
	public function index(){
		$userid = session('userid');
		if(!empty($userid)){
			$this->redirect(url('pzu/inf'));
		}
		$returnUrl = $_SERVER['HTTP_REFERER'];
		$this->assign('returnUrl',$returnUrl);
		
		return view();
	}
	public function login(){
		$userid = session('userid');
		if(!empty($userid)){
			return ['status'=>221,'msg'=>'您已登陆'];
		}
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
		['username','require|length:2,20|chsDash|token:__hash__','请输入用户名/手机号|用户名/手机号格式不正确|用户名/手机号格式不正确|页面过期！请刷新重试'],
		['password','require|min:5','请输入密码|密码格式不正确']
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$userName = $data['username'];
		$password = $data['password'];
		
		$userInfo = db('users')->where("(username=:name or phone=:name2)")
					->bind(['name'=>$userName,'name2'=>encryptd($userName)])->find();
		if($userInfo){
			if(empty($userInfo['status'])){
				exit(json_encode(array('status'=>206,'msg'=>'账号被封，请联系管理员')));
			}
			$random = decryptd($userInfo['random']);
			if(md5(md5($password).$random) == $userInfo['userpass']){
				//登入设置
				$this->loginSet($userInfo);
	
				exit(json_encode(array('status'=>200,'msg'=>'成功')));
			}else{
				exit(json_encode(array('status'=>204,'msg'=>'密码不正确')));
			}
	
		}else{
			exit(json_encode(array('status'=>203,'msg'=>'用户名/手机号不存在')));
		}
	}
	//登入设置
	public function loginSet($userInfo){
		// 登入日志分析
		$loginDatas = array();
		$loginDatas['uid'] = $userInfo['id'];
		$loginDatas['web'] = request()->host();
		$loginDatas['userid'] = $userInfo['userid'];
		$loginDatas['username'] = $userInfo['username'];
		$loginDatas['phone'] = decryptd($userInfo['phone']);
		$loginDatas['login_client'] = 'WEB';
		$loginDatas['save_time'] = date('Y-m-d H:i:s');
		db('users_loginlog')->insert($loginDatas);
		
		//注销隐私数据
		unset($userInfo['password']);
		unset($userInfo['random']);
		
		$userInfo['phone'] = decryptd($userInfo['phone']);
		
		
		//用户扩展表
		$tablemore = ($userInfo['utype']==1)?'users_xsinf':'users_wbinf';
		$infmore = db($tablemore)->where('userid',$userInfo['userid'])->find();
		$userInfo = array_merge($userInfo,$infmore);
			
		//生成SRSSION
		session('userid',$userInfo['userid']);
		session('username',$userInfo['username']);
		session('userInfo',$userInfo);
	}
	//登出
	public function logout(){
		// 清空当前的session
    	session(null);
    	//删除自动登陆cookie值
    	//cookie('thdUser',null);
    	$this->redirect(url('login/index'));
	}
	public function reg(){
		$userid = session('userid');
		if(!empty($userid)){
			$this->redirect(url('pzu/inf'));
		}
		$returnUrl = $_SERVER['HTTP_REFERER'];
		$this->assign('returnUrl',$returnUrl);
		
		return view();
	}
	public function regsave(){
		$userid = session('userid');
		if(!empty($userid)){
			return ['status'=>221,'msg'=>'您已登陆'];
		}
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$mobileRegCode = session('mobileRegCode');
	
		$rule = [
		['utype','require|in:1,2','请选择用户类型|用户类型不存在'],
		['phone','require|length:11,11','请输入手机|手机格式不正确'],
		['password','length:6,20|alphaDash','密码由6-20字符组成|用户名支持字母、数字及“-”、“_”组合'],
		['confirmpass','confirm:password','确认密码和密码不一致']
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		$phone = $data['phone'];
		$utype = $data['utype'];
	
		if(!preg_match("/^1[3|4|5|6|7|8|9][0-9]\d{8}$/",$phone)){
			return ['status'=>203,'msg'=>'手机号格式有误'];
		}
	
		//检查手机
		$userInfo = db('users')->where('phone',$phone)->find();
		if($userInfo){
			return ['status'=>202,'msg'=>'该手机的用户已存在'];
		}
		$password = $data['password'];
		if(is_numeric($password)){
			return ['status'=>204,'msg'=>'密码不能是纯数字'];
		}
		
		/*注册需要三个表
		 * js_users
		 * js_finance
		 * 
		 * js_users_wbinf（网编扩展信息表）
		 * js_users_xsinf（作家扩展信息表）
		 * 
		 */
	
		
		$nowtimes = date('Y-m-d H:i:s');
		$data = array();
		$data['username'] = $phone;
		$data['phone'] = encryptd($phone);
			
		$random = create_salt(6);
		$data['random'] = encryptd($random);
		$data['userpass'] = md5(md5($password).$random);
		$data['userid'] = md5($phone.$random);
			
		$data['utype'] = $utype;//会员类型：1-作家|2-网编
		$data['addtime'] = $nowtimes;
		$data['source'] = request()->host();
		
		//财务表
		$fdata['userid'] = $data['userid'];
		
		// 启动事务
		db()->startTrans();
		try{
			//添加
			$rs = db('users')->insert($data);
			if(!$rs){
				throw new \Exception("用户注册失败！");
			}
			
			//财务表
			$rs = db('finance')->insert($fdata);
			if(!$rs){
				throw new \Exception("财务表添加失败");
			}
			
			$fdata['updatetime'] = $nowtimes;
			//扩展表
			$rs = db('users_info')->insert($fdata);
			if(!$rs){
				throw new \Exception("扩展表添加失败");
			}
			
			//扩展表
			$rs = ($data['utype']==1)?db('users_xsinf')->insert($fdata):db('users_wbinf')->insert($fdata);
			if(!$rs){
				throw new \Exception("扩展表添加失败");
			}
			// 提交事务
			db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
		
		//session
		$wheres = ['phone'=>$data['phone']];
		$userInfo = db('users')->where($wheres)->find();
		$this->loginSet($userInfo);
		return ['status'=>200,'msg'=>'注册成功',url=>url('pzu/inf')];
	}
	
	//发送验证码:验证码登陆，注册
	public function verification(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
	
		$rule = [
		['mobile','require','请输入手机号码']
		];
	
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		$mobile = $data['mobile'];
		if(!preg_match("/^1[3|4|5|6|7|8|9][0-9]\d{8}$/",$mobile)){
			return ['status'=>202,'msg'=>'手机号格式有误'];
		}
		$type = input('post.type/d');
	
		$mobileRegCode = rand(100000,999999);
		session('mobileRegCode',$mobileRegCode);
		//注册验证码
		$msg = $mobileRegCode.' ,这是您的注册验证码，请在5分钟内按页面提示提交验证码，如非本人操作请忽略。';
		$rs = sendSms($mobile,$msg);
		if($rs){
			return ['status'=>200,'msg'=>'手机验证码发送成功'];
		}else{
			return ['status'=>209,'msg'=>'手机验证码发送失败，请稍后重试！'];
		}
	}
	
	public function getpass(){
		$userid = session('userid');
		if(!empty($userid)){
			$this->redirect(url('pzu/inf'));
		}
		return view();
	}
	//发送重置密码短信验证码
	public function recode(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
	
		$rule = [
		['mobile','require|length:2,20|chsDash','请输入用户名/手机号|用户名/手机号格式不正确|用户名/手机号格式不正确']
		];
	
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		$mobile = $data['mobile'];
	
		//查询手机
		//$wheres = ['phone|username'=>$mobile,'source'=>request()->host()];
		//$userInfo = db('users')->where($wheres)->find();
		$userInfo = db('users')->where("(username=:name or phone=:name2)")
		->bind(['id'=>[1,\PDO::PARAM_INT],'name'=>$mobile,'name2'=>encryptd($mobile)])
		->find();
	
		if(!$userInfo){
			return ['status'=>202,'msg'=>'该用户名/手机号未注册'];
		}
	
		$mobileStr = $userInfo['phone'];
	
		$mobileRegCode = rand(100000,999999);
		session('mobileResetCode',$mobileRegCode);
	
		$msg = '验证码：'.$mobileRegCode.' ,5分钟内有效期，请及时处理';
		$rs = sendSms($mobile,$msg);
		if($rs){
			return ['status'=>200,'msg'=>'手机验证码发送成功'];
		}else{
			return ['status'=>209,'msg'=>'手机验证码发送失败，请稍后重试！'];
		}
	}
	/*密码重置处理*/
	public function doreset(){
		$mid = session('mid');
		if(!empty($mid)){
			$this->redirect(url('index/index'));
		}
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$mobileResetCode = session('mobileResetCode');
		$rule = [
		['phone','require|length:2,20|chsDash','请输入用户名/手机号|用户名/手机号格式不正确|用户名/手机号格式不正确'],
		['code','require|eq:'.$mobileResetCode,'请输入手机验证码|手机验证码不正确'],
		['password','require|length:6,20|alphaDash','请输入密码|密码由6-20字符组成|密码支持字母、数字及“-”、“_”组合'],
		['repwd','require|confirm:password','请输入确认密码|确人密码和密码不一致']
		];
	
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$phone = $data['phone'];
		//查询手机
		//$wheres = ['phone|username'=>$phone,'source'=>request()->host()];
		//$userInfo = db('users')->where($wheres)->find();
	
		$userInfo = db('users')->where("status=:id and source = :source and (username=:name or phone=:name2)")
		->bind(['id'=>[1,\PDO::PARAM_INT],'source'=>request()->host(),'name'=>$phone,'name2'=>encrypt_phone($phone)])
		->find();
	
		if(empty($userInfo)){
			return ['status'=>203,'msg'=>'用户不存在'];
		}
		$password = $data['password'];
		if(is_numeric($password)){
			return ['status'=>204,'msg'=>'密码不能是纯数字'];
		}
	
		//数据组装
		$time = date('Y-m-d H:i:s');
		//密码随机种子
		$random = create_salt(6);
		$password = md5(md5($password).$random);
			
		//随机种子可解密，加密。
		$random = encrypt_pz($random);
			
		$data = array();
		$data['userpass'] = $password;
		$data['random'] = $random;
		$rs = db('users')->where('id',$userInfo['id'])->update($data);
		return ['status'=>200,'msg'=>'重置登陆密码成功',url=>url('login/index')];
	}
	
	
}