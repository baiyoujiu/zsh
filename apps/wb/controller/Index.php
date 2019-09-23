<?php
/* 网编后台
 * @author Bill
 * @data 21090218
 */
namespace app\wb\controller;
use think\Controller;

class Index extends Controller{
	public function __construct() {
		parent::__construct();
		$userInfo = session('userInfo');
		if(!empty($userInfo)){
			$this->assign('userInfo',$userInfo);
		}
		//网站SEO标题
		//$this->assign('webSet',get_webset());
	}
	/************************ 调试用 ***************************/
	public function a(){
		
	}
	/************************ 调试用 ***************************/
	
	/* 首页
	 * @author Bill
	 * @data 21090218
	 */
	public function index(){
		$this->redirect(url('login/index'));
    }
    //上传处理
    public function upload(){
    	$imagesRoot = 'images';
    	// 获取表单上传文件 例如上传了001.jpg
    	$file = request()->file('userfile');
    	// 移动到框架应用根目录/public/uploads/ 目录下
    	if($file){
    		//$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
    		$info = $file->move(ROOT_PATH . 'public' . DS .$imagesRoot);
    		if($info){
    			// 成功上传后 获取上传信息
    			/* // 输出 jpg
    			 echo $info->getExtension();
    			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
    			echo $info->getSaveName();
    			// 输出 42a79759f284b767dfcb2a0197904287.jpg
    			echo $info->getFilename(); */
    			 
    			//{"flag":"SUCCESS","source":"/image/15161682383818665428.jpg","path":"/image/15161682383818665428.jpg","type":"jpg"}
    			 
    			//水印处理  及图片压缩处理
    			$image = \think\Image::open('./'.$imagesRoot.'/'.$info->getSaveName());
    			// 返回图片的宽度
    			$width = $image->width();
    			// 返回图片的高度
    			$height = $image->height();
    			 
    			if($width>500 || $height>750){
    				$image->thumb(750,500,\think\Image::THUMB_SCALING)->save('./'.$imagesRoot.'/'.$info->getSaveName());
    			}
    			echo  json_encode(array('status'=>200,'msg'=>'上传成功！'
    					,'flag'=>'SUCCESS','source'=>'/'.$imagesRoot.'/'.$info->getSaveName()
    					,'path'=>'/'.$imagesRoot.'/'.$info->getSaveName(),'type'=>$info->getExtension()
    			));
    			exit;
    		}else{
    			// 上传失败获取错误信息
    			//echo $file->getError();
    			 
    			return ['status'=>201,'msg'=>'上传失败！'
    					,'flag'=>'FALSE','info'=>$file->getError()];
    		}
    	}
    	echo 888;
    }

}