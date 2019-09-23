<?php
/* 商品分类及分类规格属性管理
 * @author Bill
 * @data 20190731
 */
namespace app\mcenter\controller;
use think\Controller;
use think\Validate;
use think\console\Input;

class Area extends Controller{
	public function __construct() {
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
		$this->assign('userInfo',$userInfo);

	}

	/* 分类管理
	 * @author Bill
	* @date 20190731
	*/
	public function area(){
		//接收传值
		$acode = input('get.acode/d');
		$address = input('get.address','','addslashes,strip_tags');
		$address = trim($address);
		$status = input('get.status/d');
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres =[];
		//处理传值，以拉取需要的信息（选择）
		if(!empty($area)){
			$wheres['area'] = $area;
			$urlArr['area'] = $area;
		}
		if(!empty($status)){
			$wheres['status'] = $status-1;
			$urlArr['status'] = $status-1;
		}
		if(!empty($address)){
			$wheres['address'] = ['like',"%$address%"];
			$urlArr['address'] = ['like',"%$address%"];
		}
		if(!empty($acode)){
			$wheres['area_code'] = $acode;
			$urlArr['acode'] = $acode;
		}
		$this->assign('status',$status);
		$this->assign('address',$address);
		$this->assign('acode',$acode);


		//页码控制
		$count = db('system_stage')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;

		//拉取需要表单数据
		$lists = db('system_stage')->where($wheres)->order('weight DESC')
		->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);

		//页码
		$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));

		$statusArr = [1=>'有效',0 => '无效'];
		$this->assign('statusArr',$statusArr);

        //省市（浙江杭州下的开放区县）
        $wheres = ['p_code'=>330100,'status'=>1];
        $alists = db('system_area')->where($wheres)->order('weight DESC')->select();
        $this->assign('alists',getArrOne($alists,'area','code'));

		return view();
	}
	public function areasave() {
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
			['area_code','require','请输入所在区域'],//完整的话很多都要进行检索。。。回头试试看
			['area','require','请输入驿站名称'],
			['address','require','请输入驿站地址'],
            ['longitude','require','请选择经纬度'],
            ['latitude','require','请选择经纬度'],
		];

		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$objno = $data['objno'];
		unset($data['objno']);//为什么要销毁啊。。。

		if($objno){
			db('system_stage')->where('code',$objno)->update($data);
		}else{
			$data['city_code'] = 330100;
			$data['updatetime'] = date('Y-m-d H:i:s');
			db('system_stage')->insert($data);
		}
		return ['status'=>200,'msg'=>'成功！'];
	}

}
