<?php
/* 资讯文章
 * @author Bill
 * @data 21090218
 */
namespace app\mall\controller;
use think\Controller;

class News extends Controller{
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
		$keywords = '儿童绘本出租平台,童书租赁平台,租书网站,租书app';
		$description = '租书会，纸质图书出租服务平台。普及中外经典好文化，出租实物童书：经典儿童绘本、校荐1-9年级课外阅读图书、中外经典图书。';
		$webseo = ['title'=>'分类-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
	}
	
	/* 文章
	 * @author Bill
	* @data 21090822
	*/
	public function inf(){
		$objid = request()->route('id');
		
		$wheres = ['type'=>$objid,'status'=>1];
		$info = db('news')->where($wheres)->find();
		$this->assign('info',$info);
		//if($key<30){}
		
		return view('about');
	}
	/* 电子书图片轮播
	 * @author Bill
	 * @data 210900919
	 */
	public function books(){
		$bno = request()->route('id');
		
		$wheres = ['bno'=>$bno,'status'=>1];
		$info = db('ebooks')->where($wheres)->find();
		if(empty($info)){
			$this->redirect('https://'.request()->host().'/');
		}
		
		$this->assign('info',$info);
		
		//网站SEO标题   “勤阅读，读好书，读经典”
		$keywords = '儿童绘本出租平台,童书租赁平台,租书网站,租书app';
		$description = '租书会，纸质图书出租服务平台。普及中外经典好文化，出租实物童书：经典儿童绘本、校荐1-9年级课外阅读图书、中外经典图书。';
		$webseo = ['title'=>$info['book'].'-租书会','keywords'=>$keywords,'description'=>$description];
		$this->assign('webseo',$webseo);
		
		if(isWeixin()){
			// 微信分享
			import('Jssdk', EXTEND_PATH);
			$jssdk = new \JSSDK(config('configset.WXAPPID'), config('configset.WXAppSecret'));
			$wxsignPackage = $jssdk->GetSignPackage();
			$this->assign('wxsignPackage',$wxsignPackage);
		}
		
		return view();
    }
    
}