<?php
/* 订单页面
 * @author Bill
 * @data 21090218
 */
namespace app\mall\controller;
use think\Controller;
use think\Validate;

class Order extends Controller{
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
	/* 加入购物车
	 * @author Bill
	* @data 21090622
	*/
	public function addcart(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$userid = session('userid');
		if(empty($userid)){
			return ['status'=>221,'msg'=>'请先登陆！'];
		}
		//gno:gno,num:num,spec0:spec0,specv1:specv1
		$rule = [
		['gno','require|integer|length:9','请选择商品|商品编号不正确|商品编号不正确'],
		['num','require|integer|egt:1','请选择商品|商品数量不正确|商品数量不正确'],
		['spec0','require|integer','请选择商品规格|商品规格不正确'],
		['spec1','integer','商品规格不正确']
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$gno = $data['gno'];
		$wheres = ['gno'=>$gno];
		$ginf = db('good')->where($wheres)->find();
		if(empty($ginf)){
			return ['status'=>202,'msg'=>'商品不存在'];
		}
		$gpicar = json_decode(base64_decode($ginf['pic']),true); 
		
		//商品规格价格
		$spec0 = $data['spec0'];
		$spec1 = $data['spec1'];
		$skey = ($spec1 != '')?$spec0.'|'.$spec1:$spec0;
		$wheres = ['gno'=>$gno,'key'=>$skey,'num'=>['gt',0]];
		$gspinf = db('good_spec_price')->where($wheres)->find();
		
		if(empty($ginf)){
			return ['status'=>202,'msg'=>'商品已下架'];
		}
		
		//用户购物车
		$ocart = db('order_cart')->where('userid',$userid)->find();
		$cartArr = !empty($ocart)?json_decode(base64_decode($ocart['info']),true):[];
		
		//新添商品有无在购物车
		if(!empty($cartArr) && in_array($gno.$skey, $cartArr['cgnokey'])){
			$cartArr[$gno.$skey]['num'] += $data['num'];
		}else{
			//商品规格值名称
			$keyv = getspesv($gno,$ginf['cid'],[$spec0,$spec1]);
			
			//只图书类可能存在租阅
			$rent = ($ginf['cid']==1)?($skey<3?1:0):0;
			
			$cartArr[$gno.$skey] = ['gno'=>$gno,'name'=>$ginf['name'],'cid'=>$ginf['cid'],'pic'=>$gpicar[0],'key'=>$skey,'keyv'=>$keyv
									,'mprice'=>$gspinf['market_price'],'price'=>$gspinf['price'],'sku'=>$gspinf['sku']
									,'rent'=>$rent,'num'=>$data['num']];
			$cartArr['cgnokey'][] = $gno.$skey;
		}
		
		$cdata = ['update_time'=>date('Y-m-d H:i:s'),'info'=>base64_encode(json_encode($cartArr))];
		if(empty($ocart)){
			$cdata['userid'] = $userid;
			db('order_cart')->insert($cdata);
		}else{
			db('order_cart')->where('userid',$userid)->update($cdata);
		}
		return ['status'=>200,'msg'=>'成功'];	
	}
	
	
	/* 购物车
	 * @author Bill
	* @data 21090622
	*/
	public function cart(){
		$userid = session('userid');
		if(empty($userid)){
			$this->redirect(url('login/index'));
		}
		
		$ocart = db('order_cart')->where('userid',$userid)->find();
		$cartlist = !empty($ocart)?json_decode(base64_decode($ocart['info']),true):[];
		if(!empty($cartlist)){
			//注销无用Key
			unset($cartlist['cgnokey']);
		}
		$this->assign('cartlist',$cartlist);
		
		//购物车无商品时的摧荐
		$listchot = db('good')->where('status',2)->order('weight DESC')->limit(6)->select();
    	$this->assign('listchot',$listchot);
		
		
		//网站SEO标题
		$keywords = $description = '租书会，中小学必读经典书目租借平台。读好书，租经典，养成勤阅读的好习惯。';
		$webseo = ['title'=>'购物车-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
		return view();
	}
	
	
	/* 修改购物车  数量加减
	 * @author Bill
	* @data 21090622
	*/
	public function editcart(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$userid = session('userid');
		if(empty($userid)){
			return ['status'=>221,'msg'=>'请先登陆！'];
		}
		//gno:gno,num:num,spec0:spec0,specv1:specv1
		
		$rule = [
		['t','require|in:1,2','非法操作|非法操作'],
		['k','require','请选择商品'],];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
	
		$k = $data['k'];
		//操作1加;2减
		$t = $data['t'];
		
		
		$ocart = db('order_cart')->where('userid',$userid)->find();
		$cartlist = !empty($ocart)?json_decode(base64_decode($ocart['info']),true):[];
		$cartlist[$k]['num'] = $t ==1?$cartlist[$k]['num']+1:$cartlist[$k]['num']-1;
		
		$cdata = ['update_time'=>date('Y-m-d H:i:s'),'info'=>base64_encode(json_encode($cartlist))];
		db('order_cart')->where('userid',$userid)->update($cdata);

		return ['status'=>200,'msg'=>'成功'];
	}
	
	
	/* 删除购物车商品
	 * @author Bill
	* @data 21090622
	*/
	public function cartdel(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$userid = session('userid');
		if(empty($userid)){
			return ['status'=>221,'msg'=>'请先登陆！'];
		}
		$rule = [
		['gkey','require|array','至少要删除1种商品|至少要删除1种商品']
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		if(empty($data)){
			return ['status'=>202,'msg'=>'至少要删除1种商品'];
		}
		$keydel = $data['gkey'];
		
		$ocart = db('order_cart')->where('userid',$userid)->find();
		$ogood = !empty($ocart)?json_decode(base64_decode($ocart['info']),true):[];
		
		$cgnokey = $ogood['cgnokey'];
		$cgnokeyf = array_flip($cgnokey);
		foreach ($ogood as $k=>$v){
			if(in_array($k, $keydel)){
				unset($ogood[$k]);
				unset($cgnokeyf[$k]);
			}
		}
		$ogood['cgnokey']= array_flip($cgnokeyf);
			
		$cdata = ['update_time'=>date('Y-m-d H:i:s'),'info'=>base64_encode(json_encode($ogood))];
		db('order_cart')->where('userid',$userid)->update($cdata);
		
		return ['status'=>200,'msg'=>'成功'];
	}
	
	
	
	/* 快速购买
	 * @author Bill
	* @data 21090622
	*/
	public function qbuy(){
	
		
		return view();
	}

	
	/* 商品单页拼购，立刻购买
	 * 生成立刻结算 session
	 * @author Bill
	* @data 21090627
	*/
	public function buynow(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$userid = session('userid');
		if(empty($userid)){
			return ['status'=>221,'msg'=>'请先登陆！'];
		}
		//gno:gno,num:num,spec0:spec0,specv1:specv1
		$rule = [
		['gno','require|integer|length:9','请选择商品|商品编号不正确|商品编号不正确'],
		['num','require|integer|egt:1','请选择商品|商品数量不正确|商品数量不正确'],
		['spec0','require|integer','请选择商品规格|商品规格不正确'],
		['spec1','integer','商品规格不正确']
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$gno = $data['gno'];
		$wheres = ['gno'=>$gno];
		$ginf = db('good')->where($wheres)->find();
		if(empty($ginf)){
			return ['status'=>202,'msg'=>'商品不存在'];
		}
		$gpicar = json_decode(base64_decode($ginf['pic']),true); 
		
		//商品规格价格
		$spec0 = $data['spec0'];
		$spec1 = $data['spec1'];
		$skey = ($spec1 != '')?$spec0.'|'.$spec1:$spec0;
		$wheres = ['gno'=>$gno,'key'=>$skey,'num'=>['gt',0]];
		$gspinf = db('good_spec_price')->where($wheres)->find();
		
		if(empty($ginf)){
			return ['status'=>202,'msg'=>'商品已下架'];
		}
		
		//拼购页面，是单独购，还是拼购，1-拼购，0-单独购
		$pingou = $data['pingou'];
		
		/* 数据整理
		 */
		//商品规格值名称
		$keyv = getspesv($gno,$ginf['cid'],[$spec0,$spec1]);
		//只图书类可能存在租阅
		$rent = ($ginf['cid']==1)?($skey<3?1:0):0;
		$pingo = $ginf['group'];
			
		$unowbuy = ['gno'=>$gno,'name'=>$ginf['name'],'cid'=>$ginf['cid'],'pic'=>$gpicar[0],'key'=>$skey,'keyv'=>$keyv
		,'mprice'=>$gspinf['market_price'],'price'=>($pingou?$gspinf['gprice']:$gspinf['price']),'sku'=>$gspinf['sku']
		,'pingo'=>$pingo,'rent'=>$rent,'num'=>$data['num']];
		
		//如有租阅图书，检查会员等级及已租阅图书本数 ,查询用户的的最新信息
		if($rent){
			//在租图书
			$rentbooknum = $data['num'];
			$userinfo = db('users')->where('userid',$userid)->find();
			
			if($userinfo['utype']==2){
			//if($userinfo['utype']<2){
				//return ['status'=>230,'msg'=>'租阅图书，请先支付图书押金'];
			//}else{
				$userfinfo = db('finance')->where('userid',$userid)->find();
				//图书押金小于300元的限本
				if($userfinfo['balance']<3000){
					if($rentbooknum > 5){
						return ['status'=>206,'msg'=>'押金最多租图书 5 套,当前租 '.$rentbooknum.' 套'];
					}
					//查询在租图书
					$ogwheres = ['userid'=>$userid,'rentend'=>['<',date('Y-m-d H:i:s')]];
					$ogoodinf = db('order_goods')->where($ogwheres)->sum('num');
					if(($ogoodinf['num'] +$rentbooknum) > 5){
						return ['status'=>206,'msg'=>'押金最多租 5 套,在租 '.$ogoodinf['num'].' 套,当前租 '.$rentbooknum.'套'];
					}
				}
			}
		}
		
		//生成要结算商品
		session('unowbuy',$unowbuy);
		return ['status'=>200,'msg'=>'成功'];
	}
	
	
	/* 购物车去结算
	 * @author Bill
	* @data 21090627
	*/
	public function gobuy(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$userid = session('userid');
		if(empty($userid)){
			return ['status'=>221,'msg'=>'请先登陆！'];
		}
		$rule = [
		['gkey','require|array','至少要选购1种商品|至少要选购1种商品']
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		if(empty($data)){
			return ['status'=>202,'msg'=>'至少要选购1种商品'];
		}
		
		//检查有无租阅图书
		$rentbook = $rentbooknum = 0;
		$ocart = db('order_cart')->where('userid',$userid)->find();
		$cartlist = !empty($ocart)?json_decode(base64_decode($ocart['info']),true):[];
		unset($cartlist['cgnokey']);
		
		//购物车选购的商品
		foreach ($cartlist as $k=>$v){
			if(in_array($k, $data['gkey']) && $v['rent'] == 1){
				$rentbook = 1;
				$rentbooknum += $v['num'];
			}
		}
		
		//如有租阅图书，检查会员等级及已租阅图书本数 ,查询用户的的最新信息
		if($rentbook){
			$userinfo = db('users')->where('userid',$userid)->find();
			if($userinfo['utype']==2){
			//if($userinfo['utype']<2){
				//return ['status'=>230,'msg'=>'租阅图书，请先支付图书押金'];
			//}else{
				$userfinfo = db('finance')->where('userid',$userid)->find();
				//图书押金小于300元的限本
				if($userfinfo['balance']<3000){
					if($rentbooknum > 6){
						return ['status'=>206,'msg'=>'押金最多租图书 5 套,当前租 '.$rentbooknum.' 套'];
					}
					//查询在租图书
					$ogwheres = ['userid'=>$userid,'rentend'=>['<',date('Y-m-d H:i:s')]];
					$ogoodinf = db('order_goods')->where($ogwheres)->sum('num');
					if(($ogoodinf['num'] +$rentbooknum) > 5){
						return ['status'=>206,'msg'=>'押金最多租 5 套,在租 '.$ogoodinf['num'].' 套,当前租 '.$rentbooknum.'套'];
					}
				}
			}
		}
		
		session('utobuy',$data['gkey']);
		return ['status'=>200,'msg'=>'成功'];
	}
	
	/* 订单结算页面
	 * @author Bill
	* @data 21090622
	*/
	public function index(){
		$userid = session('userid');
		if(empty($userid)){
			return ['status'=>221,'msg'=>'请先登陆！'];
		}
		//来源购物车
		$cart = input('get.cart/d');
		
		$userinfo = db('users')->where('userid',$userid)->find();
		$this->assign('userinfo',$userinfo);
		//if($userinfo['utype']==2){
		
		//结算商品
		$goodslist = [];
		
		$good_amount = 0;
		
		//订单商品全为图书租借时，才可使用优惠劵。
		$onlyrent = 1;
		
		//包含服装，1是，0否，含服装时运费，驿站5元，非驿站5元。
		$havefz = 0;
		
		//购物车
		if($cart){
			$ocart = db('order_cart')->where('userid',$userid)->find();
			$cartlist = !empty($ocart)?json_decode(base64_decode($ocart['info']),true):[];
			unset($cartlist['cgnokey']);
				
			//购物车选购的商品
			$utobuy = session('utobuy');
			foreach ($cartlist as $k=>$v){
				if(in_array($k, $utobuy)){
					
					if($v['rent']<1){
						$onlyrent = 0;
					}
					
					//包含服装
					if($v['cid']==3){
						$havefz = 1;
					}
					
					//图书租借，免押金，需多加3倍租金
					$v['price'] = ($userinfo['utype']<2 && $v['rent'] == 1)?$v['price']*4:$v['price'];
					
					$goodslist[] = $v;
						
					$good_amount += $v['price']*$v['num'];
				}
			}
		//拼购、立刻购买
		}else{
			$unowbuy = session('unowbuy');
			
			if($unowbuy['rent']<1){
				$onlyrent = 0;
			}
			
			//包含服装
			if($unowbuy['cid']==3){
				$havefz = 1;
			}
			
			//图书租借，免押金，需多加3倍租金
			$unowbuy['price'] = ($userinfo['utype']<2 && $unowbuy['rent'] == 1)?$unowbuy['price']*4:$unowbuy['price'];
			
			$goodslist[] = $unowbuy;
			$good_amount = $unowbuy['price'] * $unowbuy['num'];
		}
		$this->assign('goodslist',$goodslist);
		
		$this->assign('amount',$good_amount);
		
		$this->assign('cart',$cart);
		
		//非租借驿站，低于最小购买金额加邮费 5元
		$conf_minamount = get_config(1002);
		$freight = ($good_amount < $conf_minamount)?500:0;
		
		//非租借驿站，含服装时，强制运费等于5元。
		if($havefz){
			$freight = 500;
		}
		$this->assign('freight',$freight);
		
		//租借驿站，商品总金额低于5元时，加运费补足5元
		$freightsc = $good_amount<500?500-$good_amount:0;
		
		//租借驿站，含服装时，强制运费等于5元。
		if($havefz){
			$freightsc = 500;
		}
		$this->assign('freightsc',$freightsc);
		
		$this->assign('havefz',$havefz);
		
		//地址列表
		$wheread = ['userid'=>$userid];
		//拼购租书时，只能选学校地址
		if($unowbuy && $unowbuy['pingo'] && $unowbuy['rent']){
			$wheread['school'] = 1;
		}
		$lists = db('users_address')->where($wheread)->order('flg DESC')->select();
		//默认收货地址
		$haveflg = 0;
		foreach($lists as $v){
			if($v['flg']){
				$haveflg = 1;
			}
		}
		if(!empty($lists) && $haveflg<1){
			$lists[0]['flg'] = 1;
		}
		$this->assign('lists',$lists);
		
		//所有有效地区
		$arealist = db('system_area')->field('code,area')->where('status',1)->select();
		$arealist = getArrOne($arealist,'area','code');
		$this->assign('arealist',$arealist);
		
		//省市（浙江杭州下的开放区县）
		$wheres = ['p_code'=>330100,'status'=>1];
		$alists = db('system_area')->where($wheres)->order('weight DESC')->select();
		$this->assign('alists',$alists);
		
		//所有租借驿站
		$stagelists = db('system_stage')->where('status',1)->select();
		$stagels = [];
		foreach ($stagelists as $v){
			$stagels[$v['code']] = $v;
		}
		$this->assign('stagels',$stagels);
		
		//订单商品全为图书租借时，才可使用优惠劵。
		if($onlyrent){
			$couponwheres = ['userid'=>$userid,'status'=>1];
			$couponinf = db('coupon_record')->field('id,amount')->where($couponwheres)->order('amount desc')->find();
			$this->assign('couponinf',$couponinf);
		}
		
		//网站SEO标题
		$keywords = $description = '租书会，中小学必读经典书目租借平台。读好书，租经典，养成勤阅读的好习惯。';
		$webseo = ['title'=>'订单结算-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
		return view();
	}
	
	
	/* 订单结算操作
	 * @author Bill
	* @data 21090622
	*/
	public function tobuy(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$userid = session('userid');
		if(empty($userid)){
			return ['status'=>221,'msg'=>'请先登陆！'];
		}
		$rule = [
		['orderano','require|number','请选择收货地址|收货地址编号格式不正确'],
		['couponid','number','请选择收货地址|收货地址编号格式不正确'],
		['remark','chsDash','订单备注格式不正确！']//汉字、字母、数字和下划线_及破折号-
		];
			
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		$cart = $data['cart'];
		
		//用户信息
		$userinfo = db('users')->where('userid',$userid)->find();
		
		//优惠抵扣
		$couponid = $data['couponid'];
		
		//订单备注
		$remark = $data['remark'];
		
		//收货地址
		$adrfields = 'recname,province,city,area,street,address,phone,school';
		$whereadr = ['ano'=>$data['orderano'],'userid'=>$userid];
		$adrinf = db('users_address')->field($adrfields)->where($whereadr)->find();
		if(empty($adrinf)){
			return ['status'=>202,'msg'=>'收货地址不存在'];
		}
		
		//拼购、立刻购买
		$unowbuy = session('unowbuy');
		if($unowbuy && $unowbuy['pingo'] && $unowbuy['rent']){
			if(!$adrinf['school']){
				return ['status'=>202,'msg'=>'拼租图书时，只能选自提配送点'];
			}
		}
		
		
		//订单商品全为图书租借时，才可使用优惠劵。
		$onlyrent = 1;
		
		//包含服装，1是，0否，含服装时运费，驿站3元，非驿站5元。
		$havefz = 0;
		
		/* 数据整理*/
		$nowtimes = date('Y-m-d H:i:s');
		$order_no = getSerialNumber(15);
		$data = ['order_no'=>$order_no,'userid'=>$userid,'order_time'=>$nowtimes,'update_time'=>$nowtimes];
		
		//商品数据
		$order_good = [];
		$good_amount = $goodnum = $freight = $amount = 0;
		
		//购物车选购的商品
		if($cart){
			$data['group'] = 0;
			
			//购物车选购的商品
			$utobuy = session('utobuy');
			//-------------
			$ocart = db('order_cart')->where('userid',$userid)->find();
			$ogood = json_decode(base64_decode($ocart['info']),true);
			//----------
			foreach ($ogood as $k=>$v){
				if(in_array($k, $utobuy)){
					if($v['rent']<1){
						$onlyrent = 0;
					}
					
					//包含服装
					if($v['cid']==3){
						$havefz = 1;
					}
					
					//图书租借，免押金，需多加3倍租金
					$v['price'] = ($userinfo['utype']<2 && $v['rent'] == 1)?$v['price']*4:$v['price'];
					
					$order_good[] = $v;
						
					$goodnum += $v['num'];
					$good_amount += $v['price']*$v['num'];
				}
			}
				
			//非配送点，低于最小购买金额加邮费 5元
			$conf_minamount = get_config(1002);
			$freight = (!$adrinf['school'] && $good_amount < $conf_minamount)?500:0;
		//拼购、立刻购买
		}else{
			//拼购、立刻购买
			//$unowbuy = session('unowbuy');
			
			if($unowbuy['rent']<1){
				$onlyrent = 0;
			}
			
			//包含服装
			if($unowbuy['cid']==3){
				$havefz = 1;
			}
			
			//图书租借，免押金，需多加3倍租金
			$unowbuy['price'] = ($userinfo['utype']<2 && $unowbuy['rent'] == 1)?$unowbuy['price']*4:$unowbuy['price'];
			
			$order_good[] = $unowbuy;
			$goodnum = $unowbuy['num'];
			$good_amount = $unowbuy['price'] * $unowbuy['num'];
			$freight = 0;
			
			$data['group'] = 1;
		}
		//含校服时，统一配送到学校。
		if($havefz && empty($remark)){
			return ['status'=>204,'msg'=>'校服，请备注学生姓名及班级'];
		}
		
		//含服装时，租借驿站，强制运费等于5元;非租借驿站，强制运费等于5元。
		if($havefz){
			$freight = $adrinf['school']?500:500;
		}
		
		$amount = $good_amount + $freight;
		
		//优惠抵扣  订单商品全为图书租借时，才可使用优惠劵。
		if($couponid && $onlyrent){
			$couponwheres = ['userid'=>$userid,'id'=>$couponid,'status'=>1];
			$couponinf = db('coupon_record')->field('id,amount')->where($couponwheres)->find();

			//优惠抵扣,优惠失效，无折扣下单。
			if($couponinf){
				$data['couponid'] = $couponid;
				$data['camount'] = $couponinf['amount'];
				
				$amount = $amount - $data['camount'];
			}
		}
		
		//订单商品base64()
		$data['order_good'] = base64_encode(json_encode($order_good));
		$data['goodnum'] = $goodnum;
		//订单商品总金额：单位分
		$data['good_amount'] = $good_amount;
		//运费金额：单位分
		$data['freight'] = $freight;
		//应付金额(商运优)：单位分
		$data['amount'] = $amount;
		
		if($amount<=0){
			$data['amount'] = $amount = 0;
			$data['pay_amount'] = 0;
			$data['status'] = 1;
			$data['pay_status'] = 2;
			$data['pay_time'] = $nowtimes;
		}
		
		$data['remark'] = $remark;
		$data['address'] = base64_encode(json_encode($adrinf));
		$data['address_city'] = $adrinf['city'];
		$data['address_inf'] = $adrinf['school']==1?$adrinf['address']:0;
		
		//订单商品
		$ogdata = [];
		$ogddata = ['userid'=>$userid,'order_no'=>$order_no,'addtime'=>$nowtimes];
		foreach ($order_good as $v){
			$ogdata[] = array_merge($ogddata,$v);
		}
		
		// 启动事务
		db()->startTrans();
		try{
			//订单保存
			$rs = db('order')->insert($data);
			if(!$rs){
				throw new \Exception("订单保存失败");
			}
			//订单商品保存
			$rs = db('order_goods')->insertAll($ogdata);
			if(!$rs){
				throw new \Exception("订单商品保存失败");
			}
			//更新优惠劵状态
			if($couponinf){
				$data = ['status'=>2];
				$rs = db('coupon_record')->where($couponwheres)->update($data);
				if(!$rs){
					throw new \Exception("优惠劵状态更新失败");
				}
			}
			// 提交事务
			db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
		
		//非立刻购买时，更新购物车数据
		if($unowbuy){
			session('unowbuy',null);
		}else{
			session('utobuy',null);
			$cgnokey = $ogood['cgnokey'];
			$cgnokeyf = array_flip($cgnokey);
			foreach ($ogood as $k=>$v){
				if(in_array($k, $utobuy)){
					unset($ogood[$k]);
					unset($cgnokeyf[$k]);
				}
			}
			$ogood['cgnokey'] = array_flip($cgnokeyf);
			
			$cdata = ['update_time'=>date('Y-m-d H:i:s'),'info'=>base64_encode(json_encode($ogood))];
			db('order_cart')->where('userid',$userid)->update($cdata);
		}
		
		return ['status'=>200,'msg'=>'成功','no'=>$order_no,'amount'=>$amount];
	}
	
    
    
}