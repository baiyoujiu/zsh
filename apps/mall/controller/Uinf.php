<?php
/* 用户中心
 * @author Bill
 * @data 21090218
 */
namespace app\mall\controller;
use think\Controller;

class Uinf extends Controller{
	public function __construct() {
		//if(isMobile()){
			config('template.view_path','../template/mallm/');
		//}
		if(!isMobile()){
			$this->redirect('https://'.request()->host().'/');
		}
		parent::__construct();
		$userid = session('userid');
		if(empty($userid)){
			$this->redirect(url('login/index'));
		}
		$userinfo = session('userinfo');
		$this->assign('userinfo',$userinfo);
		
		//网站SEO标题
		$keywords = '儿童绘本出租平台,童书租赁平台,租书网站,租书app';
		$description = '租书会，纸质图书出租服务平台。普及中外经典好文化，出租实物童书：经典儿童绘本、校荐1-9年级课外阅读图书、中外经典图书。';
		$webseo = ['title'=>'用户中心-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
	}
	
	/* 校服用户中心
	 * @author Bill
	* @data 21090801
	*/
	public function indexy(){
		//最新的用户信息
		$userid = session('userid');
		$userinfo = db('users_xf')->where('userid',$userid)->find();
	
		$this->assign('userinfo',$userinfo);
		
		//查询班级情况
  		$wheres = ['grade'=>$userinfo['grade'],'class'=>$userinfo['class']];
		$clists = db('users_xf')->where($wheres)->order('id DESC')->select();
		$this->assign('clists',$clists);
		
		return view();
	}
	
	
	/* 我的
	 * @author Bill
	* @data 21090622
	*/
	public function index(){
		//最新的用户信息
		$userid = session('userid');
		$userinfo = db('users')->where('userid',$userid)->find();
		$userfinfo = db('finance')->where('userid',$userid)->find();
		$userinfo['balance'] = $userfinfo['balance'];
		
		$this->assign('userinfo',$userinfo);
		
		//查询用户订单
		$lists = db('order')->where('userid',$userid)->order('id DESC')->select();
		$this->assign('olists',$lists);
		
		//未来待还图书
		$wheres = ['userid'=>$userid,'rent'=>1];
		$glists = db('order_goods')->where($wheres)->order('rentend ASC')->select();
		$this->assign('glists',$glists);
		//print_r($glists);
		
		//优惠劵
		$couponwheres = ['userid'=>$userid,'status'=>1];
		$couponinf = db('coupon_record')->field('id,amount,endtime')->where($couponwheres)->order('endtime asc,amount desc')->find();
		$this->assign('couponinf',$couponinf);
		return view();
	}
	
	
	
	/* 设置
	 * @author Bill
	* @data 21090622
	*/
	public function uset(){
		return view();
	}
	/* 加入会员
	 * @author Bill
	* @data 21090724
	*/
	public function tovip(){
		return view();
	}
	
	
	/* 我的订单
	 * @author Bill
	* @data 21090622
	*/
	public function order(){
		$userid = session('userid');
		
		//订单
		$lists = db('order')->where('userid',$userid)->order('id DESC')->select();
		$this->assign('lists',$lists);
		
		//print_r($lists);
		
		//状态:状态:1-下单，待确认|2-卖家已确认|3-配货完成|4-已发贷，待收货|5-买家确认收货|6-系统收货|8-卖家取消订单|9-系统关闭未付款订单|10-买家取消未付款订单
		$statusArr = [1=>'待发货',2=>'待发货',3=>'待发货',4=>'待收货',5=>'已收货',6=>'已收货',8=>'已关闭',9=>'已关闭',10=>'已关闭'];
		$this->assign('statusArr',$statusArr);
		return view();
	}
	
	/* 订单详情
	 * @author Bill
	* @data 21090622
	*/
	public function orderinf(){
		$orderno = input('get.no');
		if(!$orderno){
			$this->redirect(url('uinf/order'));
		}
		$userid = session('userid');
		$wheres = ['userid'=>$userid,'order_no'=>$orderno];
		$info = db('order')->where($wheres)->find();
		if(empty($info)){
			$this->redirect(url('uinf/order'));
		}
		$this->assign('info',$info);
		
		//所有有效地区
		$arealist = db('system_area')->field('code,area')->where('status',1)->select();
		$arealist = getArrOne($arealist,'area','code');
		$this->assign('arealist',$arealist);
		
		//所有租借驿站
		$stagelists = db('system_stage')->where('status',1)->select();
		$stagels = [];
		foreach ($stagelists as $v){
			$stagels[$v['code']] = $v;
		}
		$this->assign('stagels',$stagels);
		
		$statusArr = [1=>'待发货',2=>'待发货',3=>'待发货',4=>'待收货',5=>'已收货',6=>'已收货',8=>'已关闭',9=>'已关闭',10=>'已关闭'];
		$this->assign('statusArr',$statusArr);
		
		$statusinfArr = [1=>'发贷处理中',2=>'发贷处理中',3=>'发贷处理中',4=>'等待确认收货',5=>'订单已完成',6=>'订单已完成',8=>'卖家取消订单',9=>'订单超时未支付',10=>'买家取消订单'];
		$this->assign('statusinfArr',$statusinfArr);
	
		return view();
	}
	/* 订单拼购详情
	 * @author Bill
	* @data 21090622
	*/
	public function orderpinf(){
		$userid = session('userid');
		
		$listchot = db('good')->where('status',2)->order('weight DESC')->limit(10)->select();
		$this->assign('listchot',$listchot);
	
		return view();
	}
	/* 租借台
	 * @author Bill
	* @data 21090929
	*/
	public function rental(){
		$userid = session('userid');
		$wheres = ['userid'=>$userid,'rent'=>1];
		$lists = db('order_goods')->where($wheres)->order('order_no DESC,id ASC')->select();
		$this->assign('lists',$lists);
		
		//状态:0-待还|1-待验入库|2-异常|5-已还
		$statusArr = ['待还','待验入库','异常',8=>'已还'];
		$this->assign('statusArr',$statusArr);
		
		$statusStr = ['应还','还书','还书',8=>'入库'];
		$this->assign('statusStr',$statusStr);
		return view();
	}
	
	
	
	/* 用户账单---------无用20190724
	 * @author Bill
	* @data 21090723
	*/
	public function ubill(){
		return view();
	}
	
	/* 我的收货地址
	 * @author Bill
	* @data 21090622
	*/
	public function address(){
		$userid = session('userid');
		//地址列表
		$lists = db('users_address')->where('userid',$userid)->order('id DESC')->select();
		$this->assign('lists',$lists);
		
		//所有租借驿站
		$stagelists = db('system_stage')->where('status',1)->select();
		$stagels = [];
		foreach ($stagelists as $v){
			$stagels[$v['code']] = $v;
		}
		$this->assign('stagels',$stagels);
		
		//所有有效地区
		$arealist = db('system_area')->field('code,area')->where('status',1)->select();
		$arealist = getArrOne($arealist,'area','code');
		$this->assign('arealist',$arealist);
		
		//省市（浙江杭州下的开放区县）
		$wheres = ['p_code'=>330100,'status'=>1];
		$alists = db('system_area')->where($wheres)->order('weight DESC')->select();
		$this->assign('alists',$alists);
		return view();
	}
	
	/* 优惠劵---------无用20190724
	 * @author Bill
	* @data 21090622
	*/
	public function coupon(){
		$userid = session('userid');
		$wheres = ['userid'=>$userid];
		$lists = db('coupon_record')->where($wheres)->order('status asc')->select();
		$this->assign('lists',$lists);
		return view();
	}
	
	/* 收藏
	 * @author Bill
	* @data 21090622
	*/
	public function collect(){
		$userid = session('userid');
		$wheres = ['collect.type'=>0,'collect.userid'=>$userid];
		$lists = db('users_collect')->alias('collect')->join('js_good good','collect.gno = good.gno')
					->where($wheres)->order('collect.id desc')->select();
		$this->assign('lists',$lists);
		return view();
	}
	
	/* 邀请有奖
	 * @author Bill
	* @data 21091005
	*/
	public function invite(){
		if(isWeixin()){
			// 微信分享
			import('Jssdk', EXTEND_PATH);
			$jssdk = new \JSSDK(config('configset.WXAPPID'), config('configset.WXAppSecret'));
			$wxsignPackage = $jssdk->GetSignPackage();
			$this->assign('wxsignPackage',$wxsignPackage);
		}
	
		//网站SEO标题   "勤阅读，读好书，读经典"
		$keywords = '儿童绘本出租平台,童书租赁平台,租书网站,租书app';
		$description = '租书会vip月卡，领取后可免费租5本图书30天';;
		$webseo = ['title'=>'送你租书会vip月卡，免费租5本图书30天','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
		return view();
	}
	
	
	
	
	
	
	
	
	
	
	
	
    
    
}