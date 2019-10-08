<?php
/* 专题
 * @author Bill
 * @data 21090911
 */
namespace app\mall\controller;
use think\Controller;

class Zt extends Controller{
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
	
	public function inf(){
		$ztid = request()->route('id');
		$info = db('zt')->where("id",$ztid)->where('level',1)->find();
		$this->assign('info',$info);
		if(empty($info)){
			$this->redirect('https://'.request()->host().'/');
		}


		//专题版块
		$lists=db('zt')->where('pid',$ztid)->order('id DESC')->select();
		$this->assign('lists',$lists);


		$cidarr = getArrOne($lists,'id');     //抓取要用的id，只需要一列数据

		$gnolists = db('zt_good')->where('cid',['in',$cidarr])->order('weight DESC')->select();   //in查询
		$gnolist = [];
		foreach($gnolists as $v){
			$gnolist[$v['cid']][] = $v;
		}
		$this->assign('gnolists',$gnolist); //gno二维数组,限定cid[],

		$gnoarr = getArrOne($gnolists,'gno');
		$goodlists = db('good')->where('gno',['in',$gnoarr])->select();

		$goodlist = [];
		foreach($goodlists as $v){
			$goodlist[$v['gno']] = $v;
		}
		$this->assign('goodlist',$goodlist);

		if(isWeixin()){
			// 微信分享
			import('Jssdk', EXTEND_PATH);
			$jssdk = new \JSSDK(config('configset.WXAPPID'), config('configset.WXAppSecret'));
			$wxsignPackage = $jssdk->GetSignPackage();
			$this->assign('wxsignPackage',$wxsignPackage);
		}

		//网站SEO标题   “勤阅读，读好书，读经典”
		$keywords = '儿童绘本出租平台,童书租赁平台,租书网站,租书app';
		$description = '租书会，纸质图书出租服务平台。普及中外经典好文化，出租实物童书：经典儿童绘本、校荐1-9年级课外阅读图书、中外经典图书。';
		$webseo = ['title'=>$info['name'].'-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
		return view();
	}
	
	//邀请送页面
	public function reg(){
		//邀请码
		$i = input('get.i/d');
		$this->assign('i',$i);
		
		//年级下的商品
		$gradegoods = [21=>'一年级推荐必读经典童书',22=>'二年级推荐必读经典童书',23=>'三年级推荐必读经典童书',24=>'四年级推荐必读经典童书',25=>'五年级推荐必读经典童书',26=>'六年级推荐必读经典童书'];
		$gradegood = [];
		foreach ($gradegoods as $k=>$v){
			$gradegood[$k]['name'] = $v;
			$wheres = ['attriid'=>$k];
			$gnolists = db('good_attr')->where($wheres)->select();
			$gnoarr = getArrOne($gnolists,'gno');
				
			$gwheres = ['status'=>2,'gno'=>['in',$gnoarr]];
			$gradegood[$k]['goods'] = db('good')->where($gwheres)->order('weight DESC')->limit(3)->select();
		}
		$this->assign('gradegood',$gradegood);
	
		if(isWeixin()){
			// 微信分享
			import('Jssdk', EXTEND_PATH);
			$jssdk = new \JSSDK(config('configset.WXAPPID'), config('configset.WXAppSecret'));
			$wxsignPackage = $jssdk->GetSignPackage();
			$this->assign('wxsignPackage',$wxsignPackage);
		}
		//网站SEO标题   "勤阅读，读好书，读经典"
		$keywords = $description = '租书会vip月卡，领取后可免费租5本图书30天';
		$webseo = ['title'=>'送你租书会vip月卡，免费租5本图书30天','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
		return view();
	}
}