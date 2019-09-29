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

		$statusArr = array('1'=>'待付款','2'=>'待确认','3'=>'已确认','4'=>'配货待发','5'=>'已发待收','6'=>'买家确认收货','7'=>'系统收货','9'=>'卖家取消订单','10'=>'系统关闭未付款订单');
		$this->assign('statusArr',$statusArr);
		//1-下单，待确认|2-卖家确认|3-配货完成|4-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单
		$sstatusArr = array('1'=>'待确认','2'=>'已确认','3'=>'配货待发','4'=>'已发货待收','5'=>'买家确认收货','6'=>'系统收货','8'=>'卖家取消订单','9'=>'系统关闭未付款订单');
		$this->assign('sstatusArr',$sstatusArr);

		$paytypeArr = array('1'=>'余额支付','2'=>'支付宝','3'=>'微信');
		$this->assign('paytypeArr',$paytypeArr);
	}
	
	/* 分类管理
	 * @author Bill
	* @date 20190731
	*/
	public function index(){
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
		['status','require|in:2,6,8,9','状态不正确|状态不正确'],
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}

		
		//1-下单，待确认|2-卖家确认|3-配货完成|4-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单
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
				$udata['received_type'] = 1;
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

	public function inf(){
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
	
	//发货
	public function tosend(){
		if (!Request()->isAjax()) {
			return ['status' => 220, 'msg' => '非法请求！'];
		}
		$rule = [
				['objid', 'require|number', '参数不正确'],
				['wuliu', 'require', '请输入物流信息']
		];

		$data = request()->post();
		$validate = new Validate($rule);
		$result = $validate->check($data);
		if (!$result) {
			return ['status' => 201, 'msg' => $validate->getError()];
		}
		
		$order_no = $data['objid'];
		$wheres = ['order_no'=>$order_no,'status'=>2];
		$info = db('order')->where($wheres)->find();
		if(empty($info)){
			return ['status' => 205, 'msg' => '业务不存在'];
		}
		
		//1-下单，待确认|2-卖家确认|3-配货完成|4-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单
		$nowtimes = date('Y-m-d H:i:s');
		$udata=['status'=>3,'wuliu'=>$data['wuliu'],'send_time'=>$nowtimes,'update_time'=>$nowtimes];
		
		//租借商品的 租借时间更新
		$glists = db('order_goods')->where('order_no',$order_no)->select();
		
		/*发货时，更新订单状态。
		 * 如是租借商品（rent = 1 ），同时更新租借商品的租借时间，rentstart，rentend
		 * 0-30|1-45|2-75
		 */
		// 启动事务
		db()->startTrans();
		try{
			//发货保存
			$rs = db('order')->where($wheres)->update($udata);
			if(!$rs){
				throw new \Exception("订单保存失败");
			}
			
			foreach($glists as $v){
				$nowday = date('Y-m-d');
				if($v['rent'] == 1){
					
					$rentstart = date("Y-m-d H:i:s",strtotime("+2days",strtotime($nowday)));
					//0-30|1-45|2-75
					switch ($v['key']) {
						case 2:
							$rentend = date("Y-m-d H:i:s",strtotime("+77days",strtotime($nowday)));
							break;
						case 1:
							$rentend = date("Y-m-d H:i:s",strtotime("+47days",strtotime($nowday)));
							break;
						default:
							$rentend = date("Y-m-d H:i:s",strtotime("+32days",strtotime($nowday)));;
							break;
					}
					$ugdata = ['rentstart'=>$rentstart,'rentend'=>$rentend,'updatetime'=>$nowtimes];
					
					$rs = db('order_goods')->where('id',$v['id'])->update($ugdata);
					if(!$rs){
						throw new \Exception("订单保存失败");
					}
				}
				
			}
			
		// 提交事务
		db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
		
		return ['status' => 200, 'msg' => '成功'];
	}

	//待还
	public function daihuan(){
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
		$this->assign('keyword', $keyword);
		$count = db('order_goods')->where($wheres)->count();
		$maxPage = ceil($count / $pagesize);
		$page = $page > $maxPage ? $maxPage : $page;
		$page = $page < 1 ? 1 : $page;

		//拉取需要表单数据
		$lists = db('order_goods')->where($wheres)->order('id DESC')
				->limit(($page - 1) * $pagesize, $pagesize)->select();
		$this->assign('lists',$lists);

		$statusArr=['0'=>'待还','1'=>'待验入库','2'=>'异常','8'=>'已还'];
		$this->assign('statusArr',$statusArr);

		//页码
		$this->assign('pageStr', get_page_str($count, $urlArr, $page, $pagesize));
		return view();
	}

	//还书状态改变
	public function updaihuan(){
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
				['objId','require','参数不正确'],
				['status','require','状态不正确'],
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}

		$time = date('Y-m-d H:i:s');
		if($data['status']=='8'){
			$data['backtime'] = $time;
		}
		$gno = $data['objId'];
		unset($data['objId']);
		unset($data['i']);

		$res = db('order_goods')->where('gno',$gno)->update($data);
		if($res){
			return ['status'=>200,'msg'=>'成功！'];
		}else{
			return ['status'=>201,'msg'=>'不成功！'];
		}
	}


	//检货
	public function check(){
		return view();
	}

	//检货实现
	public function checktwo(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
				['tmh','require','参数不正确'],
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}

		$gno = $data['tmh'];
		$info = db('order')->where('order_no',$gno)->find();
		$glists= json_decode(base64_decode($info['order_good']),true);
		$html = '';
		foreach ($glists as $k=> $v){
			$html .= '<table>
							<thead>
							<tr>
							<th>商品</th>
							<th>价格</th>
							<th>数量</th>
							</tr>
							</thead>
					<tbody class="food_list_lists">
                      <tr>
                          <td class="rent" >'.$v['name'].'</td>
                          <td class="rent" >'.$v['price'].'</td>
                          <td class="rent" >'.$v['num'].'</td>
                      </tr>
                  	</tbody>
                  	</table>
';
		}
		return ['status'=>200,'msg'=>'成功','html'=>$html];
	}

	//购物车
	public function cart(){
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

		//用户名
		$ulists = db('users')->where('status',1)->order('id DESC')->select();
		$ulists = getArrOne($ulists,'username','userid');
		$this->assign('ulists',$ulists);

		return view();
	}
	
	/*配送单打印
	 * 只能打 已确认的订单
	 */
	public function peihuo(){
		//待配货订单
		$wheres = ['status'=>2,'pay_status'=>2];
		$lists = db('order')->where($wheres)->order('id DESC')->select();
		$this->assign('lists',$lists);
		
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

}

