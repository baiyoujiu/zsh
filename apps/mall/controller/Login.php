<?php
/* 登陆
 * @author Bill623
 */
namespace app\mall\controller;
use think\Controller;
use think\Validate;

class Login extends Controller{
	public function __construct() {
		//if(isMobile()){
			config('template.view_path','../template/mallm/');
		//}
		if(!isMobile()){
			$this->redirect('https://'.request()->host().'/');
		}
		parent::__construct();
		$userinfo = session('userinfo');
		if(!empty($userinfo)){
			$this->assign('userinfo',$userinfo);
		}
	}

	/* 登陆
	 * @author Bill
	* @data 21090622
	*/
	public function index(){
		$userid = session('userid');
		if(!empty($userid)){
			$this->redirect('https://'.request()->host().'/');
		}
		$returnUrl = $_SERVER['HTTP_REFERER'];
		
		//网站SEO标题
		$keywords = $description = '租书会，中小学必读经典书目租借平台。读好书，租经典，养成勤阅读的好习惯。';
		$webseo = ['title'=>'登陆-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
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
		['username','require|length:2,15|chsDash|token:__hash__','请输入用户名/手机号|用户名/手机号格式不正确|用户名/手机号格式不正确|页面过期！请刷新重试'],
		//['password','require|min:5','请输入密码|密码格式不正确']
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$userName = $data['username'];
		$password = !empty($data['password'])?$data['password']:$data['password0'];
		
		if(empty($password)){
			return ['status'=>201,'msg'=>'请输入密码'];
		}
		
		//$wheres = ['username|phone'=>$userName,'source'=>request()->host(),'status'=>1];
		//$userinfo = db('users')->where($wheres)->find();
		$userinfo = db('users')->where("(username=:name or phone=:name2)")
		->bind(['name'=>encryptd($userName),'name2'=>encryptd($userName)])->find();
		if($userinfo){
			if(empty($userinfo['status'])){
				exit(json_encode(array('status'=>206,'msg'=>'账号被封，请联系管理员')));
			}
			$random = decryptd($userinfo['random']);
			if(md5(md5($password).$random) == $userinfo['userpass']){
				//				$userinfo['userid'] = 'f70b5b309bc35b7431a38f3be98ab1ed';
				//登入设置
				$this->loginSet($userinfo);
		
				exit(json_encode(array('status'=>200,'msg'=>'成功')));
			}else{
				exit(json_encode(array('status'=>204,'msg'=>'密码不正确')));
			}
		
		}else{
			exit(json_encode(array('status'=>203,'msg'=>'用户名/手机号不存在')));
		}
	}
	//登入设置
	public function loginSet($userinfo){
		$nowtimes = date('Y-m-d H:i:s');
		// 登入日志分析
		$loginDatas = array();
		$loginDatas['uid'] = $userinfo['id'];
		$loginDatas['web'] = request()->host();
		$loginDatas['userid'] = $userinfo['userid'];
		$loginDatas['username'] = $userinfo['username'];
		$loginDatas['phone'] = $userinfo['phone'];
		$loginDatas['login_client'] = 'WEB';
		$loginDatas['save_time'] = $nowtimes;
		db('users_loginlog')->insert($loginDatas);
	
		//注销隐私数据
		unset($userinfo['password']);
		unset($userinfo['random']);
	
		$userinfo['username'] = decryptd($userinfo['username']);
		$userinfo['phone'] = decryptd($userinfo['phone']);
		
		//cookie浏览记录加数据库
		$ucollect = cookie('ucollect');
		if(!empty($ucollect)){
			$collectdata = [];
			$userid = $userinfo['userid'];
			foreach ($ucollect as $v){
				$wheres = ['type'=>1,'userid'=>$userid,'gno'=>$v];
				db('users_collect')->where($wheres)->delete();
				//添加
				$collectdata[] = ['userid'=>$userid,'type'=>1,'gno'=>$v,'addtime'=>$nowtimes];
			}
			db('users_collect')->insertAll($collectdata);
			
			cookie('ucollect',null);
		}
			
		//生成SRSSION
		session('userid',$userinfo['userid']);
		session('username',$userinfo['username']);
		session('userinfo',$userinfo);
	}
	//登出
	public function logout(){
		// 清空当前的session
		session(null);
		//删除自动登陆cookie值
		//cookie('thdUser',null);
		$this->redirect(url('login/index'));
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
		
		$wheres = ['phone'=>encryptd($mobile)];
		$userInfo = db('users')->where($wheres)->find();
		if($userInfo){
			return ['status'=>202,'msg'=>'该手机号已注册'];
		}
	
		$mobileRegCode = rand(100000,999999);
		session('mobileRegCode',$mobileRegCode);
		
		$msg = '验证码：'.$mobileRegCode.' 需要您进行身份校验，完成注册，5分钟内有效。';
		$rs = sendSms($mobile,$msg);
		
		
		if($rs){
			return ['status'=>200,'msg'=>'手机验证码发送成功'];
		}else{
			return ['status'=>209,'msg'=>'手机验证码发送失败，请稍后重试！'];
		}
	
		/* //验证码：197053-登陆|197297-注册
		$templId = 197297;
		//验证码登陆
		if($type){
			$domain = request()->host();
			$urlArr = explode('.', $domain);
			$urlcount = count($urlArr);
			$domain = 'www.'.$urlArr[$urlcount-2].'.'.$urlArr[$urlcount-1];
			$wheres = ['phone'=>encrypt_phone($mobile),'source'=>$domain];
			$userInfo = db('users')->where($wheres)->find();
			if(empty($userInfo)){
				return ['status'=>202,'msg'=>'该手机号未注册'];
			}
			session('mobileLogCode',$mobileRegCode);
			//验证码登陆
			$templId = 197053;
			//注册
		}else{
			session('mobileRegCode',$mobileRegCode);
		}
	
		//网站代理的设置
		$webset = get_webset();
		//return ['status'=>200,'msg'=>'手机验证码发送成功'.$mobileRegCode];
		$rs = sendQMsg($mobile,$templId,[$mobileRegCode],$webset['sign']);
		if($rs){
			return ['status'=>200,'msg'=>'手机验证码发送成功'];
		}else{
			return ['status'=>209,'msg'=>'手机验证码发送失败，请稍后重试！'];
		} */
	}
	
	
	/* 注册
	 * @author Bill
	* @data 21090622
	*/
	public function reg(){
		$userid = session('userid');
		if(!empty($userid)){
			$this->redirect('https://'.request()->host().'/');
		}
	
		$returnUrl = $_SERVER['HTTP_REFERER'];
		$this->assign('returnUrl',$returnUrl);
		
		//网站SEO标题
		$keywords = $description = '租书会，中小学必读经典书目租借平台。读好书，租经典，养成勤阅读的好习惯。';
		$webseo = ['title'=>'注册-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
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
		session('mobileRegCode',null);
	
		$rule = [
		//['phone','require|length:11,11|token:__hash__','请输入手机号|手机号格式不正确|页面过期！请刷新重试'],
		['phone','require|length:11,11|token:__hash__','请输入手机号|手机号格式不正确|页面过期！请刷新重试'],
		['vcode','require|eq:'.$mobileRegCode,'请输入验证码|验证码不正确'],
		['password','length:6,20|alphaDash','密码由6-20字符组成|用户名支持字母、数字及“-”、“_”组合'],
		['confirmpass','confirm:password','确认密码和密码不一致'],
		//['gclass','require','请选择班级'],
		//['students','require|length:2,20|chsAlphaNum','请输入学生姓名|学生姓名长度6-20字组成|学生姓名支持汉字、字母和数字'],
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		$phone = $data['phone'];
		if(!preg_match("/^1[3|4|5|6|7|8|9][0-9]\d{8}$/",$phone)){
			return ['status'=>203,'msg'=>'手机号格式有误'];
		}
		
		//检查手机
		$userinfo = db('users')->where('phone',$phone)->find();
		if($userinfo){
			return ['status'=>202,'msg'=>'该手机的用户已存在'];
		}
		$password = $data['password'];
		if(is_numeric($password)){
			return ['status'=>204,'msg'=>'密码不能是纯数字'];
		}
	
		/*注册需要三个表
		 * js_users
		 * js_users_info？？？
		* js_finance
		*/
		$nowtimes = date('Y-m-d H:i:s');
		$data = array();
		$data['username'] = encryptd($phone);
		$data['phone'] = encryptd($phone);
			
		$random = create_salt(6);
		$data['random'] = encryptd($random);
		$data['userpass'] = md5(md5($password).$random);
		$data['userid'] = md5($phone.$random);
		
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
			// 提交事务
			db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
	
		//session
		$wheres = ['phone'=>$data['phone']];
		$userinfo = db('users')->where($wheres)->find();
		$this->loginSet($userinfo);
		return ['status'=>200,'msg'=>'注册成功',url=>url('index/index')];
	}
	
	/************************************** 校服注册，暂无用
	 * @author Bill
	* @data 21090622
	*/
	public function reg2(){
		$userid = session('userid');
		if(!empty($userid)){
			$this->redirect(url('uinf/indexy'));
		}
	
		//网站SEO标题
		return view();
	}
	
	public function reg2save(){
		$userid = session('userid');
		if(!empty($userid)){
			//return ['status'=>221,'msg'=>'您已登陆'];
		}
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		//$mobileRegCode = session('mobileRegCode');
	
		$rule = [
		//['phone','require|length:11,11|token:__hash__','请输入手机号|手机号格式不正确|页面过期！请刷新重试'],
		['phone','require|length:11,11','请输入手机号|手机号格式不正确'],
		['students','require','请输入学生姓名'],
		['gclass','require','请选择所在班级'],
		['height','require','请输入身高厘米数'],
		['weight','require','请输入体重斤数'],
		];
		
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		$phone = $data['phone'];
		if(!preg_match("/^1[3|4|5|6|7|8|9][0-9]\d{8}$/",$phone)){
			return ['status'=>203,'msg'=>'手机号格式有误'];
		}
	
		//检查手机
		$userinfo = db('users')->where('phone',$phone)->find();
		if($userinfo){
			return ['status'=>202,'msg'=>'该手机的用户已存在'];
		}
		
		$gclass = $data['gclass'];
		$gcarr = explode(' ', $gclass);
		$grade = isset($gcarr['0'])?intval($gcarr['0']):0;
		$class = isset($gcarr['1'])?intval($gcarr['1']):0;
		if(empty($class)){
			return ['status'=>204,'msg'=>'请选择班级'];
		}
		unset($data['__hash__']);
		unset($data['gclass']);
		
		/*注册需要三个表
		 * js_users
		* js_users_info？？？
		* js_finance
		*/
		$nowtimes = date('Y-m-d H:i:s');
		
		$data['username'] = $phone;
		$data['phone'] = encryptd($phone);

		$password = 123456;
		$random = create_salt(6);
		$data['random'] = encryptd($random);
		$data['userpass'] = md5(md5($password).$random);
		$data['userid'] = md5($phone.$random);
		
		$data['grade'] = $grade;
		$data['class'] = $class;
		
		$data['addtime'] = $nowtimes;
		
		//print_r($data);
		$rs = db('users_xf')->insert($data);
		if(!$rs){
			return ['status'=>202,'msg'=>'登记失败，请稍后重试'];
		}
		
	
		//session
		$wheres = ['phone'=>$data['phone']];
		$userinfo = db('users_xf')->where($wheres)->find();
		$this->loginSet($userinfo);
		return ['status'=>200,'msg'=>'登记成功',url=>url('uinf/indexy')];
	}
	
	public function login2(){
		$userid = session('userid');
		if(!empty($userid)){
			return ['status'=>221,'msg'=>'您已登陆'];
		}
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
		['phone','require|length:2,15|chsDash','请输入用户名/手机号|用户名/手机号格式不正确|用户名/手机号格式不正确'],
		['password','require|min:5','请输入密码|密码格式不正确']
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$phone = $data['phone'];
		$password = $data['password'];
	
		//$wheres = ['username|phone'=>$userName,'source'=>request()->host(),'status'=>1];
		//$userinfo = db('users')->where($wheres)->find();
		$userinfo = db('users_xf')->where("(username=:name or phone=:name2)")
		->bind(['name'=>$phone,'name2'=>encryptd($phone)])->find();
		if($userinfo){
			if(empty($userinfo['status'])){
				exit(json_encode(array('status'=>206,'msg'=>'账号被封，请联系管理员')));
			}
			$random = decryptd($userinfo['random']);
			if(md5(md5($password).$random) == $userinfo['userpass']){
				//				$userinfo['userid'] = 'f70b5b309bc35b7431a38f3be98ab1ed';
				//登入设置
				$this->loginSet($userinfo);
	
				exit(json_encode(array('status'=>200,'msg'=>'成功',url=>url('uinf/indexy'))));
			}else{
				exit(json_encode(array('status'=>204,'msg'=>'密码不正确')));
			}
	
		}else{
			exit(json_encode(array('status'=>203,'msg'=>'用户名/手机号不存在')));
		}
	}
	
    
}