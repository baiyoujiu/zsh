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
		$keywords = $description = '租书会，中小学必读经典图书租借平台。读好书，租经典，养成勤阅读的好习惯。';
		$webseo = ['title'=>$info['name'].'-租书会,读好书 租经典','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
		return view();
	}
}