<?php
/* 系统设置
 * @author Bill
 * @data 20190731
 */
namespace app\mcenter\controller;
use think\Controller;
use think\Validate;
use think\console\Input;

class System extends Controller{
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
	}

	/* 自提驿站。
	 * @author Bill
	* @date 20190903
	*/
	public function stage(){
		//接收传值
		$ccode = input('get.ccode/d');
		$acode = input('get.acode/d');
		$status = input('get.status/d');
		$keyword = input('get.keyword','','addslashes,strip_tags');
		$keyword = trim($keyword);
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres =[];
		//处理传值，以拉取需要的信息（选择）
		if(!empty($keyword)){
			$wheres['area'] = $keyword;
			$urlArr['keyword'] = $keyword;
		}
		if(!empty($status)){
			$wheres['status'] = $status-1;
			$urlArr['status'] = $status;
		}
		if(!empty($ccode)){
			$wheres['city_code'] = $ccode;
			$urlArr['ccode'] = $ccode;
		}
		if(!empty($acode)){
			$wheres['area_code'] = $acode;
			$urlArr['acode'] = $acode;
		}
		
		$this->assign('acode',$acode);
		$this->assign('ccode',$ccode);
		$this->assign('keyword',$keyword);
		$this->assign('status',$status);
		
		$statusArr = [1=>'无效',2=>'有效'];
		$this->assign('statusArr',$statusArr);

		//页码控制
		$count = db('system_stage')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;

		//拉取需要表单数据
		$lists = db('system_stage')->where($wheres)->order('id DESC')
							->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);
		//页码
		$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));
		
		
		//省市（浙江杭州下的开放区县）
		$wheres = ['p_code'=>330100,'status'=>1];
		$alists = db('system_area')->where($wheres)->order('weight DESC')->select();
		$this->assign('alists',getArrOne($alists,'area','code'));

		return view();
	}
	public function stagesave() {
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
			['area_code','require','请选择驿站所在区域'],
			['area','require|min:2','请输入驿站名称|驿站名称至少2个字符'],
			['address','require|min:2','请输入自提驿站地址'],
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

	public function xitong(){
		$type = input('get.type/d');
		$type = $type ? $type : 6;
		$typearr = [6=>'租借指南',7=>'客服与售后',8=>'注册协议',9=>'租书协义'];

		$info = db('news')->where('type',$type)->find();

		$this->assign('typearr',$typearr);
		$this->assign('info',$info);

		return view();
	}
	public function xitongsave() {

		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$data = request()->post();
		$time = date('Y-m-d H:i:s');
		$tid = $data['type'];
		$data['content']= htmlspecialchars($_POST['editorValue']); //但是不知道为啥只能用$_POST，而不能用$data.
		$data['updatetime'] = $time;
		unset($data['editorValue']);

		//更改数据
		$rs = db('news')->where('type',$tid)->update($data);
		if(!$rs){
			return ['status'=>202,'msg'=>'找不到相关信息'];
		}
		return ['status'=>200,'msg'=>'成功！'];
	}
}
