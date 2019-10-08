<?php
/* 用登陆、登出、注册、找回密码-商家运营中心
 * @author Bill
 * @data 21080104
 */
namespace app\mcenter\controller;
use think\Controller;
use think\Validate;

class Users extends Controller{
	/* 登陆
	 * @author Bill
	 * @date 2018/01/09
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$mid = session('mid');
		if(!empty($mid)){
			$this->redirect(url('orders/index'));
		}

		$a = 3214;
		$b = 123456;
		//echo encryptd($a);
		//echo '<br>'.md5(md5($b).$a);

        return view();
    }
    public function login(){
		$mid = session('mid');
		//已登陆
		if(!empty($mid)){
			return ['status'=>200,'msg'=>url('good/index')];
		}
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
				['username','require|length:2,20|chsDash','请输入用户名/手机号|用户名/手机号格式不正确|用户名/手机号格式不正确'],
				['password','require|min:5','请输入密码|密码格式不正确']
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$username =  $data['username'];
		$password =  $data['password'];

		$userInfo = db('manages')->where("status=:id and username=:name")
				->bind(['id'=>[1,\PDO::PARAM_INT],'name'=>$username])->find();
		if(empty($userInfo)){
			return ['status'=>210,'msg'=>'用户不存在！'];
		}

		if($userInfo['userpass'] ==  md5(md5($password).decryptd($userInfo['random'])) ){
			//注销无用数据
			unset($userInfo['password']);
			unset($userInfo['random']);

			//session生成
			session('mid',$userInfo['userid']);
			session('userInfo',$userInfo);
			//session('userTemp',$userTemp);
			return ['status'=>200,'msg'=>url('goods/index')];
		}else{
			return ['status'=>210,'msg'=>'密码不正确！'];
		}
	}
    
    /*登出
     * @author Bill
    * @date 2016/12/20
    */
    public function logout(){
    	//限定需AJAX请求
    	if (!Request()->isAjax()){
    		//return ['status'=>220,'msg'=>'非法请求！'];
    	}
    	// 清空当前的session
    	session(null);
    	//删除自动登陆cookie值
    	//cookie('thdUser',null);
    	$this->redirect(url('users/index'));
    	//$this->success('退出成功', 'members/index');
    }
}