<?php
/* 商品分类及分类规格属性管理
 * @author Bill
 * @data 20190731
 */
namespace app\mcenter\controller;
use think\Controller;
use think\Validate;
use think\console\Input;

class Category extends Controller{
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


		$typeArr = db('good_category')->field('id,name')->select();
		$this->assign('typeArr',$typeArr);

		$typerr = db('news')->field('type,content')->select();
		$this->assign('typerr',$typerr);


	}

	/* 分类管理
	 * @author Bill
	* @date 20190731
	*/
	public function index(){
		//接收传值
		$status = input('get.status/d');
		$keyword = input('get.keyword','','addslashes,strip_tags');
		$keyword = trim($keyword);
		$page = input('get.page/d');
		$pagesize = 20;
		$urlArr = array();
		$wheres =[];
		//处理传值，以拉取需要的信息（选择）
		if(!empty($keyword)){
			$wheres['name'] = ['like',"%$keyword%"];
			$urlArr['keyword'] = $keyword;
		}
		if(!empty($status)){
			$wheres['status'] = $status;
			$urlArr['status'] = $status;
		}
		$this->assign('keyword',$keyword);
		$this->assign('status',$status);

		$statusArr = [1=>'未发布',2 => '已发布'];
		$this->assign('statusArr',$statusArr);

		//页码控制
		$count = db('good_category')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;

		//拉取需要表单数据
		$lists = db('good_category')->where($wheres)->order('weight DESC,id DESC')
		->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);

		//页码
		$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));

		return view();
	}
	public function catsave() {
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
			['name','require|min:2','请输入分类名称|名称至少2个字符'],
			['icon','require','请输入图标地址|请输入正确的图标地址'],
			['desc','require|length:0,120','请输入描述(至多120字)'],
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		$addobj = $data['objNo'];
		unset($data['objNo']);//为什么要销毁啊。。。

		if($addobj){
			db('good_category')->where('id',$addobj)->update($data);
		}else{
			db('good_category')->insert($data);
		}
		return ['status'=>200,'msg'=>'成功！'];
	}


	/* 分类规格管理
	 * @author Bill
	* @date 20190731
	*/
	public function spec(){
		//接收传值
		$cid = input('get.cid/d');
		$status = input('get.status/d');
		$keyword = input('get.keyword','','addslashes,strip_tags');
		$keyword = trim($keyword);
		$page = input('get.page/d');
		$pagesize = 10;
		$urlArr = array();
		$wheres=[];

		//处理传值，以拉取需要的信息（选择）
		if(!empty($keyword)){
			$wheres['name'] = ['like',"%$keyword%"];
			$urlArr['keyword'] = $keyword;
		}
		if(!empty($status)){
			$wheres['status'] = $status;
			$urlArr['status'] = $status;
		}
		if(!empty($cid)){
			$wheres['cid'] = $cid;
			$urlArr['cid'] = $cid;
		}

		$this->assign('keyword',$keyword);
		$this->assign('status',$status);
		$this->assign('cid',$cid);

		$statusArr = [1=>'未发布',2 => '已发布'];
		$this->assign('statusArr',$statusArr);

		//页码控制
		$count = db('good_cat_spec')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;

		//拉取需要表单数据
		$lists = db('good_cat_spec')->where($wheres)->order('weight DESC,id DESC')
							->limit(($page-1)*$pagesize,$pagesize)->select();
		$this->assign('lists',$lists);

		//页码
		$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));

		//拉取一级分类数据，分类一维数组
		$wheres = ['level'=>1];
		$catlists = db('good_category')->where($wheres)->order('weight DESC')->select();
		$this->assign('catlists',getArrOne($catlists,'name','id'));


		return view();
    }
    public function specsave() {
        //限定需AJAX请求
        if (!Request()->isAjax()){
            return ['status'=>220,'msg'=>'非法请求！'];
        }
        $rule = [
			['cid','require','请选择分类'],
            ['name','require|min:2','请输入规格|规格名称至少2个字符'],
            ['weight','number|between:0,50','请输入权重|权重最高为50'],
        ];
        $data = request()->post();
        $validate = new Validate($rule);
        $result   = $validate->check($data);
        if(!$result){
            return ['status'=>201,'msg'=>$validate->getError()];
        }

		//
        $objNo = $data['objNo'];
		unset($data['objNo']);//为什么要销毁啊。。。
        $time = date('Y-m-d H:i:s');
        $data['updatetime'] = $time;

		//
        if($objNo) {
			db('good_cat_spec')->where('id',$objNo)->update($data);
		}else{
			db('good_cat_spec')->insert($data);
		}
        return ['status'=>200,'msg'=>'成功！'];
    }


	/* 分类属性管理
	 * @author Bill
	* @date 20190731
	*/
    public function attr(){
		//接收传值
		$status = input('get.status/d');
		$cid = input('get.cid/d');
		$keyword = input('get.keyword', '', 'addslashes,strip_tags');
		$keyword = trim($keyword);
		$page = input('get.page/d');
		$pagesize = 10;
		$wheres=[];
		$urlArr = array();
		//处理传值，以拉取需要的信息（选择）
		if (!empty($keyword)) {
			$wheres['name'] = ['like', "%$keyword%"];
			$urlArr['keyword'] = $keyword;
		}
		if (!empty($status)) {
			$wheres['status'] = $status;
			$urlArr['status'] = $status;
		}
		if(!empty($cid)){
			$wheres['cid'] = $cid;
			$urlArr['cid'] = $cid;
		}

		$this->assign('keyword', $keyword);
		$this->assign('status', $status);
		$this->assign('cid', $cid);

		$statusArr = [1=>'未发布',2 => '已发布'];
		$this->assign('statusArr',$statusArr);

		//页码控制
		$count = db('good_cat_attr')->where($wheres)->count();
		$maxPage = ceil($count / $pagesize);
		$page = $page > $maxPage ? $maxPage : $page;
		$page = $page < 1 ? 1 : $page;

		//拉取需要表单数据
		$lists = db('good_cat_attr')->where($wheres)->order('weight DESC,id DESC')
				->limit(($page - 1) * $pagesize, $pagesize)->select();


		//分页
		$this->assign('pageStr', get_page_str($count, $urlArr, $page, $pagesize));

		//拉取一级分类数据，分类一维数组
		$wheres = ['level'=>1];
		$catlists = db('good_category')->where($wheres)->order('weight DESC')->select();
		$this->assign('catlists',getArrOne($catlists,'name','id'));

		$this->assign('lists', $lists);
		return view();
	}
	public function attrsave() {
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
			['name','require|min:2','请输入规格|属性名称至少2个字符'],
			['weight','number|between:0,50','请输入权重|权重最高为50'],
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}

		$objNo = $data['objNo'];
		unset($data['objNo']);//为什么要销毁啊。。。
		$time = date('Y-m-d H:i:s');
		$data['updatetime'] = $time;

		//
		if($objNo) {
			db('good_cat_attr')->where('id',$objNo)->update($data);
		}else{
			db('good_cat_attr')->insert($data);
		}
		return ['status'=>200,'msg'=>'成功！'];
	}


    /* 分类属性值管理
     * @author Bill
    * @date 20190731
    */
    public function attri(){
		//接收传值
    	$status = input('get.status/d');
    	$attrid = input('get.attrid/d');
    	$keyword = input('get.keyword','','addslashes,strip_tags');
    	$keyword = trim($keyword);
    	$page = input('get.page/d');
    	$pagesize = 10;
		$wheres=[];
    	$urlArr = array();
		//处理传值，以拉取需要的信息（选择）
    	if(!empty($keyword)){
    		$wheres['name'] = ['like',"%$keyword%"];
    		$urlArr['keyword'] = $keyword;
    	}
    	if(!empty($status)){
    		$wheres['status'] = $status;
    		$urlArr['status'] = $status;
    	}
    	if(!empty($attrid)){
    		$wheres['attrid'] = $attrid;
    		$urlArr['attrid'] = $attrid;
    	}
    	$this->assign('keyword',$keyword);
    	$this->assign('status',$status);
    	$this->assign('attrid',$attrid);

		$statusArr = [1=>'未发布',2 => '已发布'];
		$this->assign('statusArr',$statusArr);

		//页码控制
    	$count = db('good_cat_attr_item')->where($wheres)->count();
    	$maxPage = ceil($count/$pagesize);
    	$page = $page>$maxPage?$maxPage:$page;
    	$page = $page<1?1:$page;

		//拉取需要表单数据
    	$lists = db('good_cat_attr_item')->where($wheres)->order('weight DESC,id DESC')
    				->limit(($page-1)*$pagesize,$pagesize)->select();
    	$this->assign('lists',$lists);

		//页码
    	$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));

    	//分类一维数组
    	$catlists = db('good_category')->select();
    	$this->assign('catarr',getArrOne($catlists,'name','id'));

    	//分类属性二维数组
    	$attrlists = db('good_cat_attr')->order('cid asc,weight DESC')->select();
    	$this->assign('attrlists',$attrlists);

    	return view();
    }
    public function attrisave() {
    	//限定需AJAX请求
    	if (!Request()->isAjax()){
    		return ['status'=>220,'msg'=>'非法请求！'];
    	}
    	$rule = [
    	['name','require|min:2','请输入属性值|属性值至少2个字符'],
    	];
    	$data = request()->post();
    	$validate = new Validate($rule);
    	$result   = $validate->check($data);
    	if(!$result){
    		return ['status'=>201,'msg'=>$validate->getError()];
    	}

    	$objNo = $data['objno'];
    	unset($data['objno']);
    	$nowtimes = date('Y-m-d H:i:s');
    	$data['updatetime'] = $nowtimes;

    	if($objNo){
    		unset($data['attrid']);
    		db('good_cat_attr_item')->where('id',$objNo)->update($data);
    	}else{
    		$attrid = $data['attrid'];
    		if(empty($attrid)){
    			return ['status'=>202,'msg'=>'请选择所属分类属性'];
    		}
    		$attrinf = db('good_cat_attr')->where('id='.$attrid)->find();
    		$cid = $attrinf['cid'];

    		//添加时换行算一个
    		$name = $data['name'];
    		$namearr = explode("\r\n", $name);

    		$gcaiarr = [];
    		foreach ($namearr as $v){
    			if($v){
    				$gcaiarr[] = ['attrid'=>$attrid,'cid'=>$cid,'name'=>$v,'weight'=>$data['weight'],'status'=>$data['status'],'updatetime'=>$nowtimes];
    			}
    		}
    		db('good_cat_attr_item')->insertAll($gcaiarr);
    	}
    	return ['status'=>200,'msg'=>'成功！'];
    }


}
