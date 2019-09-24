<?php
/* 商品分类及分类规格属性管理
 * @author Bill
 * @data 20190731
 */
namespace app\mcenter\controller;
use think\Controller;
use think\Validate;

class Orders extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$mid = session('mid');
		if(empty($mid)){
			if (Request()->isAjax()){
				return ['status'=>220,'msg'=>'请先登陆！'];
			}else{
				$this->redirect(url('members/index'));
			}
		}
		$userInfo = array();
		$userInfo = session('userInfo');
		$this->assign('userInfo', $userInfo);

		$statusArr = array('1'=>'待付款','2'=>'待确认','3'=>'已确认','4'=>'已发货待收','6'=>'买家确认收货','7'=>'系统收货','9'=>'卖家取消订单','10'=>'系统关闭未付款订单');
		$this->assign('statusArr',$statusArr);
		$sstatusArr = array('1'=>'待确认','2'=>'已确认','3'=>'已发货待收','5'=>'买家确认收货','6'=>'系统收货','8'=>'卖家取消订单','9'=>'系统关闭未付款订单');
		$this->assign('sstatusArr',$sstatusArr);

		$paytypeArr = array('1'=>'余额支付','2'=>'支付宝','3'=>'微信');
		$this->assign('paytypeArr',$paytypeArr);
	}



	/* 分类管理
	 * @author Bill
	* @date 20190731
	*/
	public function index()
	{
		$status = input('get.status/d');
		$keyword = input('get.keyword','','addslashes,strip_tags');
		$keyword = trim($keyword);
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres = [];
		//处理传值，以拉取需要的信息（选择）
		if (!empty($keyword)) {
			$wheres['order_no'] = ['like',"%$keyword%"];
			$urlArr['keyword'] = $keyword;
		}
		if (!empty($status)) {
			$wheres['pay_status'] = ($status == 1)?'1':'2';
			$wheres['status'] = 1;
		}
		if ($wheres['pay_status'] == 2) {
			$wheres['pay_status'] =($status == 10)?'1':'2';
			$wheres['status'] = $status-1;
			$urlArr['status'] = $status;
		}
		$this->assign('keyword', $keyword);
		$this->assign('status', $status);
		//页码控制
		$count = db('order')->where($wheres)->count();
		$maxPage = ceil($count / $pagesize);
		$page = $page > $maxPage ? $maxPage : $page;
		$page = $page < 1 ? 1 : $page;

		//拉取需要表单数据
		$lists = db('order')->where($wheres)->order('id DESC')
				->limit(($page - 1) * $pagesize, $pagesize)->select();
		foreach ($lists as $k => $v) {
			$wheres = [];
			$wheres['order_no'] = $v['order_no'];
			$glists = db('order_goods')->where($wheres)->order('addtime DESC')->select();
			$buynum = 0;
			foreach ($glists as $k1 => $v1) {
				$buynum += $v1['num'];
			}
			$lists[$k]['glists'] = $glists;

		}

		$this->assign('lists', $lists);
		//页码
		$this->assign('pageStr', get_page_str($count, $urlArr, $page, $pagesize));

		//驿站地址
		$stagelist = db('system_stage')->field('code,area')->where('status',1)->select();
		$stagelist = getArrOne($stagelist,'area','code');
		$this->assign('stagelist',$stagelist);

		//用户名对应
		$user = db('users')->where('status',1)->select();
		$user = getArrOne($user,'username','userid');
		$this->assign('user',$user);
		return view();
	}
	public function upstatus(){
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
		['objid','require','参数不正确'],
		['status','require|in:2,3,6,8,9','状态不正确|状态不正确'],
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}

		
		//1-下单，待确认|2-卖家确认|3-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单
		//更改后的状态是 2896

		$order_no = $data['objid'];
		$status = $data['status'];
		
		//数据组装
		$nowtimes = date('Y-m-d H:i:s');
		$udata=['status'=>$status,'update_time'=>$nowtimes];
		$wheres = ['order_no'=>$order_no];
		
		switch ($status) {
			case 9://系统关闭未付款订单
			case 2://卖家确认
			case 8://卖家取消订单
				$wheres['status'] = 1;
				break;
			case 6:
				$wheres['status'] = 3;
				$udata['received_time'] = $nowtimes;
				break;
			default:
			break;
		}
		$res = db('order')->where($wheres)->update($udata);
		if($res){
			return ['status'=>200,'msg'=>'成功！'];
		}else{
			return ['status'=>201,'msg'=>'不成功！'];
		}
	}

	public function inf()
	{
		//获取路由参数
		$newsNo = request()->route('id');
		if (empty($newsNo)) {
			$this->redirect(url('orders/index'));
		}
		$info = db('order')->where('id=' . $newsNo)->find();
		$inum = [$info['order_no']=>$info['goodnum']];
		$info['address'] = json_decode(base64_decode($info['address']),true);
		if (empty($info)) {
			$this->redirect(url('orders/index'));
		}
		$this->assign('info', $info);
		$this->assign('inum', $inum);

		$wheres = [];
		$wheres['order_no'] = $info['order_no'];
		$glist = db('order_goods')->where($wheres)->order('addtime DESC')->select();
		$this->assign('glist', $glist);


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
		return view();
	}

	public function hnavsave()
	{
		if (!Request()->isAjax()) {
			return ['status' => 220, 'msg' => '非法请求！'];
		}
		$rule = [
				['objId', 'require', '参数不正确'],
				['status','require|in:1,2,3','状态不正确|状态不正确'],
		];

		$data = request()->post();
		$validate = new Validate($rule);
		$result = $validate->check($data);
		if (!$result) {
			return ['status' => 201, 'msg' => $validate->getError()];
		}
		$objId = $data['objId'];
		$time = date('Y-m-d H:i:s');
		$data['update_time'] = $time;
		$data['send_time'] = $time;
		switch ($data['status']) {
			case 1://系统关闭未付款订单
				$data['status'] =2;
				break;
			case 2://卖家确认
				$data['status'] =3;
				break;
			case 3://卖家取消订单
				$data['status'] =6;
				break;
		}
		unset($data['objId']);
		unset($data['i']);
		db('order')->where('order_no',$objId)->update($data);
		return ['status' => 200, 'msg' => '成功'];
	}

	public function address(){
		$userid = session('recname');
		//地址列表
		$lists = db('users_address')->where('userid',$userid)->order('id DESC')->select();
		$this->assign('lists',$lists);

		//所有有效地区


		//省市（浙江杭州下的开放区县）
		$wheres = ['p_code'=>330100,'status'=>1];
		$alists = db('system_area')->where($wheres)->order('weight DESC')->select();
		$this->assign('alists',$alists);
		return view();
	}

	//购物车
	public function cart()
	{
		$key = input('get.key','','addslashes,strip_tags');

		$key = trim($key);
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres = [];
		//处理传值，以拉取需要的信息（选择）
		if (!empty($key)) {
			$wheres['order_no'] = ['like',"%$key%"];
			$urlArr['keyword'] = $key;
		}
		$this->assign('key', $key);



		//页码控制
		$count = db('order_cart')->where($wheres)->count();
		$maxPage = ceil($count / $pagesize);
		$page = $page > $maxPage ? $maxPage : $page;
		$page = $page < 1 ? 1 : $page;

		//拉取需要表单数据
		$lists = db('order_cart')->where('info','<>','eyJjZ25va2V5IjpbXX0=')->order('update_time DESC')
		->limit(($page - 1) * $pagesize, $pagesize)->select();
		foreach($lists as $k=>$v){
			$lists[$k]['info'] = json_decode(base64_decode($lists[$k]['info']),true);
		}

		$this->assign('lists', $lists);


		//页码
		$this->assign('pageStr', get_page_str($count, $urlArr, $page, $pagesize));


		//驿站地址
		$stagelist = db('system_stage')->field('code,area')->where('status',1)->select();
		$stagelist = getArrOne($stagelist,'area','code');
		$this->assign('stagelist',$stagelist);

		//用户名
		$ulists = db('users')->where('status',1)->order('id DESC')->select();
		$ulists = getArrOne($ulists,'username','userid');
		$this->assign('ulists',$ulists);

		return view();
	}

}

