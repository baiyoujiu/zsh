<?php
/* API 接口文件
 * @author Bill
 * @data 21090218
 */
namespace app\mall\controller;
use think\Controller;
use think\Validate;

class Api extends Controller{
	public function __construct() {
		parent::__construct();
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
	}
	
	public function getgoods(){
		/*URL key参数
		 * 域名说明：分类 -排序 - 活动 - 属性1_属性1_属性2_属性3。
		* 多活动'2_8';(活动ID需小于20)  1是拼购
		* 多属性查询 '22_23';(属性值ID均大于20)
		* 关键字搜索 是 ?k=1233
		* 分页是 ?pn=5
		*/
		
		
		
		$pagesize = 12;
		$pages = input('post.pn/d');
		$pages = $pages?$pages:1;
		$keywords = input('post.k','','addslashes,strip_tags');
		
		$minp = input('post.minp/d');
		$maxp = input('post.maxp/d');
		
		
		//接值处理 ？？？？？？？
		$data = request()->post();
		$ukarr = $data['uk'];
		
		
		
		//已选属性值
		$attriid = [0];
		foreach ($ukarr as $k=>$v){
			switch ($k) {
				case 0:
				case 1:
					$ukarr[$k] = intval($v);
					break;
				default:
					$ukarr[$k] = explode('_', $v);
					if($k>2){
						$attriid = array_merge($attriid,$ukarr[$k]);
					}
					break;
			}
		}
		
		//商品分类
		$cid = $ukarr[0];
		//
		if($cid){
			$attrlists = db('good_cat_attr_item')->where('cid',$cid)->select();
			$attrcidarr = getArrOne($attrlists,'attrid','id');
		}
		
		/*筛选结果商品编号集（同属性取并集）
		 */
		$gnocidarr = [];
		
		$attrciddarr = [];
		foreach ($attriid as $v){
			$v = intval($v);
			if($v){
				$attrciddarr[$attrcidarr[$v]] = 1;
				
				$agnolists = db('good_attr')->where('attriid',$v)->select();
				
				//同属性取并集
				$gnocidarr[$attrcidarr[$v]] = $gnocidarr[$attrcidarr[$v]]?array_merge($gnocidarr[$attrcidarr[$v]],getArrOne($agnolists,'gno')):getArrOne($agnolists,'gno');
				
			}
		}
		
		
		//商品查询条件
		$wheres = ['status'=>2];
		
		//活动id
		$actidarr = isset($ukarr[2])?$ukarr[2]:array();
		foreach ($actidarr as $v){
			$v = intval($v);
			//拼购
			if($v == 1){
				$wheres['group'] = 1;
				continue;
			}
			if($v){
				$agnolists = db('good_activity')->where('activityid',$v)->select();
				
				//同属性取并集
				$gnocidarr[0] = $gnocidarr[0]?array_merge($gnocidarr[0],getArrOne($agnolists,'gno')):getArrOne($agnolists,'gno');
			}
		}
		
		$gnoarr = current($gnocidarr);
		//商品编号集 跨属怀取交集
		foreach ($gnocidarr as $v){
			$gnoarr = array_intersect($gnoarr,$v);
		}
		
		
		if($cid){
			$wheres['cid'] = $cid;
		}
		
		//属性有无被选中,或有活动被选中
		if(max($attriid) || max($actidarr)>1){
			$wheres['gno'] = ['in',$gnoarr];
		}
		if($keywords){
			$wheres['name|recommend'] = ['like',"%$keywords%"];
		}
		if($minp){
			$wheres['sales_price'] = ['>=',$minp*100];
		}
		if($maxp){
			$wheres['sales_price'] = ['<=',$maxp*100];
		}
		if($minp && $maxp){
			$wheres['sales_price'] = ['BETWEEN',[$minp*100,$maxp*100]];
		}
		
		
		/* 排序  0-综合|1-低|2-高|8-销量
		 */
		$orderarr = ['weight desc,sales desc','sales_price asc','sales_price desc',8=>'sales desc'];
		$orderby = isset($orderarr[$ukarr[1]])?$orderarr[$ukarr[1]]:$orderarr[0];
		
		//商品列表
		$lists = db('good')->where($wheres)->order($orderby)->limit(($pages-1)*$pagesize,$pagesize)->select();
		//echo db('good')->getLastSql();
		
		$html = '';
		foreach ($lists as $v){
			$picarr = json_decode(base64_decode($v['pic']),true);
			$html .= '<a href="'.url('goods/'.$v['gno']).'"><li class="fl">
						   <img class="sp_img lazy" data-original="'.$picarr[0].'" />
						   <div class="sp_lists_word">
								<h4>'.$v['name'].'</h4><h5>'.$v['recommend'].'</h5>
								<p class="clearfix">
									<span class="fl"><em>￥'.number_format($v['sales_price']/100,2).'</em>/'.$v['units'].'</span>
									<img class="fr buy_btn" src="/mall/img/shop_car1.png"></img>
								</p>
							</div>
						</li></a>';
		}
		return ['status'=>200,'msg'=>'成功','html'=>$html];
	}
	
	
	/* 子地区列表
	 * @author Bill
	* @data 21090219
	*/
	public function getchildarea(){
		$code = input('post.code/d');
		if(empty($code)){
			return ['status'=>221,'msg'=>'非法请求！'];
		}
		//获取子地区列表
		$arealist = get_child_area($code,$field = 'code,area');
		$html = '';
		foreach ($arealist as $v){
			$html .= '<option value="'.$v['code'].'">'.$v['area'].'</option>';
		}
		
		$wheres = ['area_code'=>$code,'status'=>1];
		$arealist = db('system_stage')->field('code,area,address,pic,longitude,latitude')
								->where($wheres)->order('weight desc')->select();
		
		$schtml = '';
		foreach ($arealist as $v){
			$schtml .= '<option value="'.$v['code'].'" inf="'.$v['address'].'" pic="'.$v['pic'].'" longitude="'.$v['longitude'].'" latitude="'.$v['latitude'].'">'.$v['area'].'</option>';
		}
		return ['status'=>200,'msg'=>'成功','html'=>$html,'schtml'=>$schtml];
	}
	/********************************用户收货地址保存 
	 * @author Bill
	 * @data 21090724
	 */
	public function adrsave(){
		$userid = session('userid');
		if(empty($userid)){
			return ['status'=>221,'msg'=>'请先登陆'];
		}
		$rule = [
		['recname','require|chsDash','请输入收贷人|收贷人支持汉字、字母、数字'],
		['phone','require|number|length:11,11','请输入手机号|手机号格式不正确|手机号必须11位'],
		['area','require|number','请选择区/县|区/县格式不正确'],
		['street','require|number','请选择街道/镇|街道/镇格式不正确'],
		['sccode','number','学校地址格式不正确'],
		['address','chsDash','详细地址支持汉字、字母、数字及“-”、“_”']
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
		
		$nowtimes = date('Y-m-d H:i:s'); 
		
		$data['updatetime'] = $nowtimes;
		$data['userid'] = $userid;
		$data['province'] = 330000;
		$data['city'] = 330100;
		$data['school'] = 0;
		if($data['sccode']>1){
			$data['school'] = 1;
			$data['address'] = $data['sccode'];
		}
		unset($data['sccode']);
		$ano = $data['ano'];
		unset($data['ano']);
		
		if($ano>1){
			db('users_address')->where('ano',$ano)->update($data);
		}else{
			$data['ano'] = getSerialNumber(60);
			$data['addtime'] = $nowtimes;
			db('users_address')->insert($data);
			$ano = $data['ano'];
		}
		
		//订单调整收货地址时用
		$addrhtml = '';
		//所有有效地区
		$arealist = db('system_area')->field('code,area')->where('status',1)->select();
		$arealist = getArrOne($arealist,'area','code');
		
		$addrhtml = $arealist[$data['province']].$arealist[$data['city']].$arealist[$data['area']].$arealist[$data['street']].' ';
		$addrhtml .=($data['school']?$arealist[$data['address']]:$data['address']);
		return ['status'=>200,'msg'=>'收货地址保存成功','addrinf'=>$addrhtml,'ano'=>$ano,'school'=>$data['school']];
    }
    public function adred(){
    	$ano = input('post.ano');
    	$userid = session('userid');
    	if(empty($userid)){
    		return ['status'=>221,'msg'=>'请先登陆'];
    	}
    	if(!is_numeric($ano)){
    		return ['status'=>221,'msg'=>'参数错误'];
    	}
    	$wheres = ['ano'=>$ano,'userid'=>$userid];
    	$info = db('users_address')->where($wheres)->find();
    	
    	//区县下的街道
    	$streets = get_child_area($info['area'],$field = 'code,area');
    	$streethtml = '';
    	foreach ($streets as $v){
    		$streethtml .= '<option value="'.$v['code'].'"'.(($info['street']==$v['code'])?' selected="selected"':'').'>'.$v['area'].'</option>';
    	}
    	//区县下的租还驿站
    	$schools = get_child_area($info['street'],$field = 'code,area');
    	
    	$wheres = ['area_code'=>$info['area'],'status'=>1];
    	$stagelist = db('system_stage')->field('code,area,address,pic,longitude,latitude')
    				->where($wheres)->order('weight desc')->select();
    	
    	
    	$stagehtml = '';
    	foreach ($stagelist as $v){
    		$stagehtml .= '<option value="'.$v['code'].'" inf="'.$v['address'].'" pic="'.$v['pic'].'" longitude="'.$v['longitude'].'" latitude="'.$v['latitude'].'" '.(($info['address']==$v['code'])?' selected="selected"':'').'>'.$v['area'].'</option>';
    	}
    	return ['status'=>200,'msg'=>'成功！','sthtml'=>$streethtml,'schtml'=>$stagehtml];
    }
    public function adrdel(){
    	$ano = input('post.ano');
    	$userid = session('userid');
    	if(empty($userid)){
    		return ['status'=>221,'msg'=>'请先登陆'];
    	}
    	if(!is_numeric($ano)){
    		return ['status'=>221,'msg'=>'参数错误'];
    	}
    	$wheres = ['ano'=>$ano,'userid'=>$userid];
    	db('users_address')->where($wheres)->delete();
    	return ['status'=>200,'msg'=>'收货地址删除成功！'];
    }
    public function adrflg(){
    	$ano = input('post.ano');
    	$userid = session('userid');
    	if(empty($userid)){
    		return ['status'=>221,'msg'=>'请先登陆'];
    	}
    	if(!is_numeric($ano)){
    		return ['status'=>221,'msg'=>'参数错误'];
    	}
    	$wheres = ['userid'=>$userid];
    	$data = ['flg'=>0];
    	db('users_address')->where($wheres)->update($data);
    	$wheres['ano'] = $ano;
    	$data = ['flg'=>1];
    	db('users_address')->where($wheres)->update($data);
    	return ['status'=>200,'msg'=>'默认收货地址修改成功！'];
    }
    
    /********************************商品收藏
     * @author Bill
    * @data 21090724
    */
    public function collect(){
    	$gno = input('post.gno/d');
    	$userid = session('userid');
    	if(empty($userid)){
    		return ['status'=>221,'msg'=>'请先登陆'];
    	}
    	if(empty($gno)){
    		return ['status'=>221,'msg'=>'参数错误'];
    	}
    	$wheres = ['type'=>0,'userid'=>$userid,'gno'=>$gno];
    	$inf = db('users_collect')->where($wheres)->find();
    	if($inf){
    		//删除
    		db('users_collect')->where($wheres)->delete();
    	}else{
    		//添加
    		$data = ['userid'=>$userid,'type'=>0,'gno'=>$gno,'addtime'=>date('Y-m-d H:i:s')];
    		db('users_collect')->insert($data);
    	}
    	return ['status'=>200,'msg'=>'成功！'];
    }
    public function collectdel(){
    	$rule = [
    	['gno','require|array','至少要删除1种商品|至少要删除1种商品'],
    	];
    	$data = request()->post();
    	$validate = new Validate($rule);
    	$result   = $validate->check($data);
    	if(!$result){
    		return ['status'=>201,'msg'=>$validate->getError()];
    	}
    	$userid = session('userid');
    	if(empty($userid)){
    		return ['status'=>221,'msg'=>'请先登陆'];
    	}
    	//商品编号
    	$gnoarr = [];
    	foreach ($data['gno'] as $v){
    		$gnoarr[] = intval($v);
    	}
    	$wheres = ['type'=>0,'userid'=>$userid,'gno'=>['in',$gnoarr]];
    	db('users_collect')->where($wheres)->delete();
    	return ['status'=>200,'msg'=>'成功！'];
    }
    public function trackdel(){
    	$rule = [
    	['gno','require|array','至少要删除1种商品|至少要删除1种商品'],
    	];
    	$data = request()->post();
    	$validate = new Validate($rule);
    	$result   = $validate->check($data);
    	if(!$result){
    		return ['status'=>201,'msg'=>$validate->getError()];
    	}
    	$userid = session('userid');
    	if(empty($userid)){
    		return ['status'=>221,'msg'=>'请先登陆'];
    	}
    	//商品编号
    	$gnoarr = [];
    	foreach ($data['gno'] as $v){
    		$gnoarr[] = intval($v);
    	}
    	$wheres = ['type'=>1,'userid'=>$userid,'gno'=>['in',$gnoarr]];
    	db('users_collect')->where($wheres)->delete();
    	return ['status'=>200,'msg'=>'成功！'];
    }
    
    
    /********************************会员充值
     * @author Bill
    * @data 21090725
    */
    public function tovip(){
    	$userid = session('userid');
    	if(empty($userid)){
    		return ['status'=>221,'msg'=>'请先登陆'];
    	}
    	$rule = [
    	['amount','require|number|in:100,300','请选择押金方案|押金方案格式不正确|押金方案不正确'],
    	['agreement','require|number','请先阅读并勾选租书协议|请先阅读并勾选租书协议']
    	];
    	$data = request()->post();
    	$validate = new Validate($rule);
    	$result   = $validate->check($data);
    	if(!$result){
    		return ['status'=>201,'msg'=>$validate->getError()];
    	}
    	//押金金额
    	$amount = $data['amount']*100;
    	//充值编号
    	$recharge_no = getSerialNumber(1);
    	$recharge_no = '8'.date('ymd').substr($recharge_no,-5);
    	$recharge_note = '支付宝在线';
    	$data = ['userid'=>$userid,'recharge_no'=>$recharge_no,'pay_way'=>'ONLINEBF','amount'=>$amount
    				,'recharge_note'=>$recharge_note,'addtime'=>date('Y-m-d H:i:s')];
	    $rs = db('finance_recharge')->insert($data);
	    if($rs){
	    	return ['status'=>200,'msg'=>'成功','no'=>$recharge_no];
	    }else{
	    	return ['status'=>210,'msg'=>'记录保存失败'];
	    }
    }
}