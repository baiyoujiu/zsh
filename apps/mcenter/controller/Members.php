<?php
/* 用登陆、登出、注册、找回密码-商家运营中心
 * @author Bill
 * @data 21080104
 */
namespace app\mcenter\controller;
use think\Controller;
use think\Validate;

class Members extends Controller{
	/* 登陆
	 * @author Bill
	 * @date 2018/01/09
	 */
	public function __construct()
	{
		parent::__construct();
		$mid = session('mid');
		 if(empty($mid)){
			if (Request()->isAjax()){
				return ['status'=>220,'msg'=>'请先登陆！'];
			}else{
				$this->redirect(url('users/index'));
			}
		}
		$userInfo = array();
		$userInfo = session('userInfo');
		$this->assign('userInfo', $userInfo);

	}


	//用户管理
	public function index(){
		//接收传值
		$hystatus = input('get.hystatus/d');
		$ztstatus = input('get.ztstatus/d');
		$keyid = input('get.keyid','','addslashes,strip_tags');
		$keyid = trim($keyid);
		$keytel = input('get.keytel','','addslashes,strip_tags');
		$keytel = trim($keytel);
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres =[];
		//处理传值，以拉取需要的信息（选择）
		if(!empty($keyid)){
			$wheres['username'] = encryptd($keyid);
			$urlArr['keyid'] = $keyid;
		}
		if(!empty($keytel)){
			$wheres['phone'] = encryptd($keytel);
			$urlArr['keytel'] = $keytel;
		}
		if(!empty($hystatus)){
			$wheres['utype'] = $hystatus;
			$urlArr['hystatus'] = $hystatus;
		}
		if(!empty($ztstatus)){
			$wheres['status'] = ($ztstatus - 1);
			$urlArr['ztstatus'] = $ztstatus;
		}

		$this->assign('keyid',$keyid);
		$this->assign('keytel',$keytel);
		$this->assign('hystatus',$hystatus);
		$this->assign('ztstatus',$ztstatus);


		//页码控制
		$count = db('users')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;

		//拉取需要表单数据

		$lists = db('users')->where($wheres)->order('id  DESC')
				->limit(($page-1)*$pagesize,$pagesize)->select();


		$this->assign('lists',$lists);
		//页码
		$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));


		$hyArr = [1=>'普通买家',2 => '会员买家'];
		$this->assign('hyArr',$hyArr);

		$lyArr = [1=>'手机注册',2 => '微信',3 => '微博',4 =>'qq'];
		$this->assign('lyArr',$lyArr);

		$ztArr = [1=>'无效',2=> '有效'];
		$this->assign('ztArr',$ztArr);

        return view();
    }

	public function ustatus(){

		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
				['objid','require','参数不正确'],
				['status','require','需要已有状态'],
		];


		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}

		$objid = $data['objid'];
		//unset($data['objid']);

		$udata=[];
		$udata['status'] = $data['status'];

		$res = db('users')->where('userid',$objid)->update($udata);
		if($res){
			return ['status'=>200,'msg'=>'成功！'];
		}else{
			return ['status'=>201,'msg'=>'修改不成功！'];
		}
	}

	//登录信息
	public function log(){
		//接收传值
		$keyid = input('get.keyid','','addslashes,strip_tags');
		$keyid = trim($keyid);
		$keytel = input('get.keytel','','addslashes,strip_tags');
		$keytel = trim($keytel);
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres =[];
		//处理传值，以拉取需要的信息（选择）
		if(!empty($keyid)){
			$wheres['username'] = encryptd($keyid);
			$urlArr['keyid'] = $keyid;
		}
		if(!empty($keytel)){
			$wheres['phone'] = encryptd($keytel);
			$urlArr['keytel'] = $keytel;
		}

		$this->assign('keyid',$keyid);
		$this->assign('keytel',$keytel);

		//页码控制
		$count = db('users_loginlog')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;

		//拉取需要表单数据

		$lists = db('users_loginlog')->where($wheres)->order('id  DESC')
				->limit(($page-1)*$pagesize,$pagesize)->select();

		$this->assign('lists',$lists);
		//页码
		$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));

		return view();
	}


	//会员费
	public function recharge(){
		//接收传值
		$keyid = input('get.keyid','','addslashes,strip_tags');
		$keyid = trim($keyid);
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres =[];
		//处理传值，以拉取需要的信息（选择）
		if(!empty($keyid)){
			$wheres['userid'] = $keyid;
			$urlArr['keyid'] = $keyid;
		}
		$this->assign('keyid',$keyid);

        //页码控制
        $count = db('finance_recharge')->where($wheres)->count();
        $maxPage = ceil($count/$pagesize);
        $page = $page>$maxPage?$maxPage:$page;
        $page = $page<1?1:$page;

        //拉取需要表单数据
		$lists = db('finance_recharge')->where($wheres)->order('id  DESC')
				->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);

        //用户名
        $ulists = db('users')->where('status',1)->order('id DESC')->select();
        $ulists = getArrOne($ulists,'username','userid');
        $this->assign('ulists',$ulists);


		//页码
		$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));


		return view();
	}

	//会员地址
	public function address(){
		//接收传值
        $keyid = input('get.keyid','','addslashes,strip_tags');
        $keyid = trim($keyid);
		$keytel = input('get.keytel','','addslashes,strip_tags');
		$keytel = trim($keytel);
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres =[];
        

		//处理传值，以拉取需要的信息（选择）
        if(!empty($keyid)){
        	$uinf = db('users')->where('username',encryptd($keyid))->order('id DESC')->find();
            $wheres['userid'] = $uinf['userid'];
            $urlArr['keyid'] = $keyid;
        }
		if(!empty($keytel)){
			$wheres['phone'] = encryptd($keytel);
			$urlArr['phone'] = $keytel;
		}

		$this->assign('keytel',$keytel);
        $this->assign('keyid',$keyid);

		//页码控制
		$count = db('users_address')->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;

		//数据表

        $lists = db('users_address')->where($wheres)->order('id DESC')
            ->limit(($page-1)*$pagesize,$pagesize)->select();
        $this->assign('lists',$lists);

        unset($wheres['phone']);
        $glists = db('users')->where($wheres)->order('id DESC')->select();
        $this->assign('glists',getArrOne($glists,'username','userid'));


        //所有有效地区
		$arealist = db('system_area')->field('code,area')->where('status',1)->select();
		$arealist = getArrOne($arealist,'area','code');
		$this->assign('arealist',$arealist);

		//驿站地址
		$stagelist = db('system_stage')->field('code,area')->where('status',1)->select();
		$stagelist = getArrOne($stagelist,'area','code');
		$this->assign('stagelist',$stagelist);


		//驿站名称
		$stagealist = db('system_stage')->where('status',1)->select();
		$stagealist = getArrOne($stagealist,'address','code');
		$this->assign('stagealist',$stagealist);




        //页码
        $this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));

		return view();
	}
}