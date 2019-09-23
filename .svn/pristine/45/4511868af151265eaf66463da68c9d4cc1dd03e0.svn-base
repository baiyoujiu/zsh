<?php
/* 商品分类及列表页
 * @author Bill
 * @data 21090218
 */
namespace app\mall\controller;
use think\Controller;

class Cat extends Controller{
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
		//网站SEO标题
		$keywords = $description = '租书会，中小学必读经典书目租借平台。读好书，租经典，养成勤阅读的好习惯。';
		$webseo = ['title'=>'分类-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
	}
	
	/* 商品所有分类
	 * @author Bill
	* @data 21090219
	*/
	public function index(){
		$listscat = db('good_category')->where("status=2")->order('weight DESC')->select();
		$this->assign('listscat',$listscat);
		
		//查询分类下的商品
		$catgoods = [];
		foreach ($listscat as $k=>$v){
			$catgoods[$k] = db('good')->where("status=2 and cid=".$v['id'])->order('weight DESC')->limit(18)->select();
		}
		$this->assign('catgoods',$catgoods);
		
		$listchot = db('good')->where('status',2)->order('weight DESC')->limit(12)->select();
		$this->assign('listchot',$listchot);
		
		//热搜词
		$hotserchkey = get_config(1003);
		$this->assign('hotserchkey',$hotserchkey);
		
		return view();
	}
	/* 商品分类列表 --无用-----   和 good/index 重得，HTMl 是最新的  
	 * @author Bill
	 * @data 210900808
	 */
	public function lists(){
			
		$lists = db('good')->where('status',2)->order('weight DESC')->limit(10)->select();
		$this->assign('lists',$lists);
		
		return view();
    }
    
}