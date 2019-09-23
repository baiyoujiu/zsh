<?php
/* 商品管理
 * @author Bill
 * @data 20190716
 */
namespace app\mcenter\controller;
use think\Controller;
use think\Validate;
use think\console\Input;

class Good extends Controller{
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
		
		$groupArr = [0=>'普通',1=>'拼购'];
		$this->assign('groupArr',$groupArr);
	}
	/* 商品列表
	 * @author Bill
	 * @date 20190716
	 */
	public function index(){
		$cid = input('get.cid/d');
		$status = input('get.status/d');
		$keyword = input('get.keyword','','addslashes,strip_tags');
		$keyword = trim($keyword);
		$page = input('get.page/d');
		$pagesize = 10;
		$urlArr = array();
			
		$wheres = [];
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

		$statusArr = [1=>'下架',2=>'上架'];
		$this->assign('statusArr',$statusArr);

		$count = db('good')->where($wheres)->count();
		$maxPage = ceil($count/$pagesize);
		$page = $page>$maxPage?$maxPage:$page;
		$page = $page<1?1:$page;
			
		$lists = db('good')->where($wheres)->order('id DESC')
							->limit(($page-1)*$pagesize,$pagesize)->select();



		$this->assign('lists',$lists);
		$this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));
		
		
		$wheres = ['level'=>1,'status'=>2];
		$catlists = db('good_category')->where($wheres)->order('weight DESC')->select();
		
		$this->assign('catlists',getArrOne($catlists,'name','id'));

		return view();
    }
    
    public function gpass(){
    	if (!Request()->isAjax()){
    		return ['status'=>220,'msg'=>'非法请求！'];
    	}
    	$objId = input('post.id/d');
    	if($objId<0){
    		return ['status'=>201,'msg'=>'请选择操作对象！'];
    	}
    	$data['manage_style'] = 1;
    	db('ds_good')->where('id',$objId)->update($data);
    	return ['status'=>200,'msg'=>'成功'];
    }
    
    
    /* 商品编辑
     * @author Bill
    * @date 21080105
    */
    public function edit(){
    	$gno = Input('get.objNo/d');
    	if($gno){
	    	$info = db('good')->where(['gno'=>$gno])->find();
	    	$this->assign('info',$info);
	    	
	    	//商品分类属性值
	    	$gattr = db('good_attr')->where(['gno'=>$gno])->select();
	    	$gattriid = getArrOne($gattr,'attriid');
	    	$this->assign('gattriid',$gattriid);
	    	
	    	//分类属性
	    	$wheres = ['cid'=>$info['cid'],'status'=>2];
	    	$attrlist = db('good_cat_attr')->where($wheres)->order('weight desc')->select();
	    	
	    	foreach($attrlist as $key=>$val){
	    		//分类属性值
	    		$wheres = ['cid'=>$info['cid'],'status'=>2,'attrid'=>$val['id']];
	    		$attrlist[$key]['attritems'] = db('good_cat_attr_item')->where($wheres)->order('weight desc')->select();
	    	}
	    	$this->assign('attrlist',$attrlist);
    	}
    	$wheres = ['level'=>1,'status'=>2];
    	$catlists = db('good_category')->where($wheres)->order('weight DESC')->select();
    	$this->assign('catlists',$catlists);
    	return view();
    }
    
    /* 分类下属性
     */
    public function catattr(){
    	 
    	$rule = [
    	['cid','require|number','请选择商品分类|商品分类不正确']
    	];
    	$data = request()->post();
    	$validate = new Validate($rule);
    	$result   = $validate->check($data);
    	if(!$result){
    		return ['status'=>201,'msg'=>$validate->getError()];
    	}
    	//分类属性
    	$wheres = ['cid'=>$data['cid'],'status'=>2];
    	$attrlist = db('good_cat_attr')->where($wheres)->order('weight desc')->select();
    	//print_r($attrlist);
    	 
    	$html = '';
    	foreach($attrlist as $key=>$val){
    
    		$html .= '<div class="form-group">
                      <label for="bankcard" class="col-sm-2 control-label"><b class="clr-attention">*</b>'.$val['name'].'：</label>
                                        <div class="col-sm-8">';
    		//分类属性值
    		$wheres = ['cid'=>$data['cid'],'status'=>2,'attrid'=>$val['id']];
    		$atrils = db('good_cat_attr_item')->where($wheres)->order('weight desc')->select();
    		//print_r($atrils);
    		foreach ($atrils as $v){
    			$html .= '<input name="attr'.$key.'[]" type="checkbox" value="'.$v['id'].'" />'.$v['name'].'　';
    		}
    
    		$html .= '</div></div>';
    	}
    	
    	return ['status'=>200,'msg'=>'成功','html'=>$html];
    	 
    }
    
    //上传处理
    public function upload(){
    	$imagesRoot = 'images';
    	// 获取表单上传文件 例如上传了001.jpg
    	$file = request()->file('userfile');
    	// 移动到框架应用根目录/public/uploads/ 目录下
    	if($file){
    		//$info = $file->validate(['ext'=>'jpg,jpeg,png','type'=>'image/jpeg,image/png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
    		$info = $file->validate(['ext'=>'jpg,jpeg,png','type'=>'image/jpeg,image/png'])->move(ROOT_PATH . 'public' . DS .$imagesRoot);
    		if($info){
    			// 成功上传后 获取上传信息
    			/* // 输出 jpg
    			 echo $info->getExtension();
    			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
    			echo $info->getSaveName();
    			// 输出 42a79759f284b767dfcb2a0197904287.jpg
    			echo $info->getFilename(); */
    
    			//{"flag":"SUCCESS","source":"/image/15161682383818665428.jpg","path":"/image/15161682383818665428.jpg","type":"jpg"}
    			
    			//'path'=>'http://'.request()->host().'/'.$imagesRoot.'/'.$info->getSaveName()
    
    			echo  json_encode(array('status'=>200,'msg'=>'上传成功！'
    					,'flag'=>'SUCCESS','source'=>'http://img.zushuhui.com/'.$imagesRoot.'/'.$info->getSaveName()
    					,'path'=>'http://'.request()->host().'/'.$imagesRoot.'/'.$info->getSaveName(),'type'=>$info->getExtension()
    			));
    			exit;
    		}else{
    			// 上传失败获取错误信息
    			//echo $file->getError();
    
    			return ['status'=>201,'msg'=>'上传失败！'
    					,'flag'=>'FALSE','info'=>'上传失败！'];
    		}
    	}
    }

	public function picorder(){
		//$albumpic = input('post.goodImgs','','strip_tags');
		//生成图片顺序session
		//session('picorder',$albumpic);
		return ['status'=>200,'msg'=>'成功！'];
	}

    public function save() {
    	
    	//限定需AJAX请求
    	if (!Request()->isAjax()){
    		return ['status'=>220,'msg'=>'非法请求！'];
    	}
    	$rule = [
		['name','require|min:2','请输入商品名称|商品名称至少2个字符'],
		['recommend','require','请输入摧荐理由'],
		['cid','require','请选择商品分类'],
		['attr0','require|array','请选择商品属性'],
		//['goodImgs','require|array','请上传商品图片|请上传商品图片'],
		['group','require','请选择销售模式'],
		['status','require','请选择商品状态']
		];
    	
    	
    	/* `gno` int(11) NOT NULL COMMENT '商品编号',
    	`name` varchar(128) NOT NULL COMMENT '商品名称',
    	`recommend` varchar(64) NOT NULL COMMENT '摧荐理由',
    	`group` tinyint(4) NOT NULL DEFAULT '0' COMMENT '模式：0-普通|1-拼购',
    	`cid` int(11) NOT NULL DEFAULT '0' COMMENT '一级分类',
    	`pic` text COMMENT '图片，多张base64_encode(json_encode(array))第一个是主图',
    	`market_price` int(11) NOT NULL COMMENT '在售最高市场价（单位：分）',
    	`sales_price` int(11) NOT NULL COMMENT '在售最低销售价（单位：分）',
    	`weight` int(10) NOT NULL DEFAULT '0' COMMENT '权重,大的居前',
    	`status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1-下架|2-上架', */
    	
		$data = request()->post();
		$validate = new Validate($rule);
		$result   = $validate->check($data);

		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		 
		$gno = $data['objNo'];
		unset($data['objNo']);
		$time = date('Y-m-d H:i:s');
		$data['updatetime'] = $time;

		$data['pic'] = base64_encode(json_encode($data['goodImgs']));
		unset($data['goodImgs']);
		
		$wheres = ['cid'=>$data['cid'],'status'=>2];
		$attrlist = db('good_cat_attr')->where($wheres)->order('weight desc')->select();

		db()->startTrans();
		try{
			//属性值
			$gattr = [];
			if($gno){
				//删除原有属性值
				db('good_attr')->where(['gno'=>$gno])->delete();
				
				//添加属性值
				foreach ($attrlist as $key=>$val){
					foreach($data['attr'.$key] as $v){
						$gattr[] = ['gno'=>$gno,'cid'=>$data['cid'],'attrid'=>$val['id'],'attriid'=>intval($v),'updatetime'=>$time];
					}
					unset($data['attr'.$key]);
				}
				$rs = db('good_attr')->insertAll($gattr);
				if(!$rs){
					throw new \Exception("商品属性添加失败");
				}
				
				db('good')->where('gno',$gno)->update($data);
			}else{
				$data['gno'] = $gno = getSerialNumber(100);
				$data['addtime'] = $time;
				
				//添加属性值
				foreach ($attrlist as $key=>$val){
					foreach($data['attr'.$key] as $v){
						$gattr[] = ['gno'=>$gno,'cid'=>$data['cid'],'attrid'=>$val['id'],'attriid'=>intval($v),'updatetime'=>$time];
					}
					unset($data['attr'.$key]);
				}
				$rs = db('good_attr')->insertAll($gattr);
				if(!$rs){
					throw new \Exception("商品属性添加失败");
				}
				
				db('good')->insert($data);
			}
			// 提交事务
			db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
		
    	return ['status'=>200,'msg'=>'成功！','gno'=>$gno];
    }

    /* 商品规格编辑
     * @author Bill
    * @date 21080105
    */
    public function edit2(){
    	$gno = Input('get.objNo/d');
    	if(empty($gno)){
    		$this->redirect(url('good/index'));
    	}
    	$info = db('good')->where(['gno'=>$gno])->find();
    	if(empty($info)){
    		$this->redirect(url('good/index'));
    	}
    	
    	$iinfo = db('good_inf')->where(['gno'=>$gno])->find();
    	//商品介绍
    	$info['desc'] = $iinfo['desc'];
    	$this->assign('info',$info);
    
    	//分类下的规格
    	$wheres = ['status'=>2,'cid'=>$info['cid']];
    	$cslist = db('good_cat_spec')->field('id,name')->where($wheres)->order('weight desc')->select();
    	$this->assign('cslist',$cslist);
    
    	//分类下的规格值
    	$csilist = [];
    	foreach($cslist as $val){
    		$wheres = ['gno'=>$info['gno'],'cid'=>$info['cid'],'specid'=>$val['id']];
    		$csiinfo = db('good_cat_spec_item')->where($wheres)->find();
    		$csilist[$val['id']] = json_decode(base64_decode($csiinfo['item']),true);
    	}
    	$this->assign('csilist',$csilist);
    	//print_r($csilist);
    
    	//分类下的规格价格
    	$gsplist = db('good_spec_price')->where('gno='.$info['gno'])->select();
    	$this->assign('gsplist',$gsplist);
    
    	return view();
    }



	public function savep() {
		 
		//限定需AJAX请求
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$data = request()->post();
		$rule = [
		['gno','require|number','参数不正确|参数不正确'],
		['gcsiv0','require|array','请输入规格值|规格值不正确'],
		['key','require|array','规格键不正确|规格键不正确'],
		['key_name','require|array','规格值不正确|规格值不正确'],
		['market_price','require|array','请输入规格值对应的市价|规格值对应的市价不正确'],
		['price','require|array','请输入规格值对应的售价|规格值对应的售价不正确'],
		['gprice','array','规格值对应的拼团价不正确'],
		['num','require|array','请输入规格值对应的库存|规格值对应的库存不正确']
		];
		$validate = new Validate($rule);
		$result   = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}
		
		//商品编号
		$gno = $data['gno'];
		$info = db('good')->where('gno='.$gno)->find();
		if(empty($info)){
			return ['status'=>201,'msg'=>'商品不存在！'];
		}
		
		
		$time = date('Y-m-d H:i:s');
		$data['updatetime'] = $time;
		
		//分类下的规格
		$wheres = ['status'=>2,'cid'=>$info['cid']];
		$cslist = db('good_cat_spec')->field('id,name')->where($wheres)->order('weight desc')->select();
		//$gpacnum = count($cslist)
		
		
		//return ['status'=>207,'msg'=>'成功！'];
		// 启动事务
		db()->startTrans();
		try{
			//删除原有规格值
			db('good_cat_spec_item')->where(['gno'=>$gno])->delete();
			
			//添加规格值
			foreach ($cslist as $key=>$val){
				$gcsiv0 = [];
				foreach($data['gcsiv'.$key] as $v){
					if(!empty($v)){
						$gcsiv0[] = ['name'=>$v];
					}
				}
				$ogcsi = ['gno'=>$gno,'cid'=>$info['cid'],'specid'=>$val['id'],'item'=>base64_encode(json_encode($gcsiv0)),'updatetime'=>$time];
				$rs = db('good_cat_spec_item')->insert($ogcsi);
				if(!$rs){
					throw new \Exception("商品规格添加失败");
				}
			}
			//删除原有规格价格
			db('good_spec_price')->where(['gno'=>$gno])->delete();
			//添加规格价格
			$key = $data['key'];
			$key_name = $data['key_name'];
			$price = $data['price'];
			$gprice = $data['gprice'];
			$market_price = $data['market_price'];
			$num = $data['num'];
			$sku = $data['sku'];
			$gsp = [];
			foreach($key as $k=>$v){
				$ogprice = ($info['group'])?intval($gprice[$k])*100:0;
				//if(!empty($price[$k]) && !empty($market_price[$k]) && !empty($num[$k])){
					$gsp[] = ['gno'=>$gno,'key'=>$key[$k],'key_name'=>$key_name[$k],'price'=>$price[$k]*100,'gprice'=>$ogprice
					,'market_price'=>$market_price[$k]*100,'num'=>intval($num[$k]),'sku'=>$sku[$k],'updatetime'=>$time];
				//}
			}
			$rs = db('good_spec_price')->insertAll($gsp);
			if(!$rs){
				throw new \Exception("商品规格价格添加失败");
			}
			
			$maxprice = max($market_price)*100;
			$minprice = min($price)*100;
			$gdata = ['market_price'=>$maxprice,'sales_price'=>$minprice,'updatetime'=>$time];
			
			//编辑商品
			$rs = db('good')->where('gno',$gno)->update($gdata);
			if(!$rs){
				throw new \Exception("商品介绍更新失败");
			}
			
			$gidata = ['desc'=>htmlspecialchars($_POST['editorValue']),'updatetime'=>$time];
			$inf = db('good_inf')->where('gno',$gno)->find();
			if($inf){
				$rs = db('good_inf')->where('gno',$gno)->update($gidata);
			}else{
				$gidata['gno'] = $gno;
				$gidata['addtime'] = $time;
				$rs = db('good_inf')->insert($gidata);
			}
			if(!$rs){
				throw new \Exception("商品介绍更新失败");
			}
			
			// 提交事务
			db()->commit();
		} catch (\Exception $e) {
			// 回滚事务
			db()->rollback();;
			return ['status'=>206,'msg'=>$e->getMessage()];
		}
		return ['status'=>200,'msg'=>'成功！'];
	}


	public function wsave(){
		if (!Request()->isAjax()){
			return ['status'=>220,'msg'=>'非法请求！'];
		}
		$rule = [
				['weight','number','权重应该是数字'],
		];
		$data = request()->post();
		$validate = new Validate($rule);
		$result = $validate->check($data);
		if(!$result){
			return ['status'=>201,'msg'=>$validate->getError()];
		}

		$objNo =  $data['gno'];
		unset($data['i']);
		if($objNo) {
			db('good')->where('gno',$objNo)->update($data);
		}
		return ['status'=>200,'msg'=>'成功！'];
	}
}