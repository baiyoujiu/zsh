<?php
/* 商品分类及分类规格属性管理
 * @author Bill
 * @data 20190731
 */
namespace app\mcenter\controller;
use think\Controller;
use think\Validate;
use think\console\Input;

class zhuanti extends Controller{
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

    /*专题控制*/
    public function zt(){

        $pid = input('get.pid/d');
        $status = input('get.status/d');
        $keyword = input('get.keyword','','addslashes,strip_tags');
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
            $wheres['status'] = $status-1;
            $urlArr['status'] = $status;
        }
        if(!empty($pid)){
            $wheres['pid'] = $pid-1;
            $urlArr['pid'] = $pid;
        }

        $this->assign('keyword',$keyword);
        $this->assign('status',$status);
        $this->assign('pid',$pid);

        $statusArr = [1=>'无效',2 => '已发布'];
        $this->assign('statusArr',$statusArr);


        //页码控制
        $count = db('zt')->where($wheres)->count();
        $maxPage = ceil($count/$pagesize);
        $page = $page>$maxPage?$maxPage:$page;
        $page = $page<1?1:$page;


        //拉取需要表单数据
        $lists = db('zt')->where($wheres)->order('id DESC')
            ->limit(($page-1)*$pagesize,$pagesize)->select();
        $this->assign('lists',$lists);

        //页码
        $this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));


        $blists = db('zt')->where('level',1 )->select();
        $this->assign('blists',getArrOne($blists,'name','id'));

        return view();

    }
    public function ztsave() {
        //限定需AJAX请求
        if (!Request()->isAjax()){
            return ['status'=>220,'msg'=>'非法请求！'];
        }
        $rule = [
            ['pid','number','非法请求'],
            ['name','require','请输入专题名称'],
            ['weight','number','请输入权重'],
            ['icon','require','请输入图标地址'],
            ['desc','require|length:0,120','请输入备注(至多120字)'],
            ['status','require','请选择专题状态'],
        ];

        $data = request()->post();
        $validate = new Validate($rule);
        $result   = $validate->check($data);
        if(!$result){
            return ['status'=>201,'msg'=>$validate->getError()];
        }
        $addobj = $data['objNo'];
        unset($data['objNo']);

        //判定level值
        (!$data['pid'])?$data['level'] = 1:$data['level'] = 2;

        if($addobj){
            db('zt')->where('id',$addobj)->update($data);
        }else{
            db('zt')->insert($data);
        }
        return ['status'=>200,'msg'=>'成功！'];
    }

    /*专题商品表*/
    public function zg(){
        $ztid = input('get.ztid/d');
        $keyword = input('get.keyword','','addslashes,strip_tags');
        $keyword = trim($keyword);
        $page = input('get.page/d');
        $pagesize = 10;
        $urlArr = array();
        $wheres=[];

        if(!empty($keyword)){
            $wheres['gno'] = ['like',"%$keyword%"];
            $urlArr['gno'] = $keyword;
        }
        if(!empty($ztid)){
            $wheres['cid'] = $ztid;
            $urlArr['ztid'] = $ztid;
        }

        $this->assign('keyword',$keyword);
        $this->assign('ztid',$ztid);

        //页码控制
        $count = db('zt_good')->where($wheres)->count();
        $maxPage = ceil($count/$pagesize);
        $page = $page>$maxPage?$maxPage:$page;
        $page = $page<1?1:$page;


        $lists = db('zt_good')->where($wheres)->order('id DESC')
            ->limit(($page-1)*$pagesize,$pagesize)->select();
        $this->assign('lists',$lists);

        //页码
        $this->assign('pageStr',get_page_str($count,$urlArr,$page,$pagesize));

        //专题版块内容
        $alists = db('zt')->where('level',2 )->order('id')->select();
        $this->assign('alists',$alists);

        $blists = db('zt')->select();
        $this->assign('blists',getArrOne($blists,'name','id'));

        return view();
    }

    public function zgsave() {
        //限定需AJAX请求
        if (!Request()->isAjax()){
            return ['status'=>220,'msg'=>'非法请求！'];
        }
        $rule = [
            ['cid','number','请选择商品所属专题版块'],
            ['gno','require','请输入商品编号'],
            ['weight','number','请输入权重'],
        ];
        $data = request()->post();
        $validate = new Validate($rule);
        $result   = $validate->check($data);
        if(!$result){
            return ['status'=>201,'msg'=>$validate->getError()];
        }


        //得到版块对应的专题id
        $info= db('zt')->where('id',$data['cid'] )->find();
        $data['ztid'] =$info['pid'];


        $objNo = $data['objNo'];
        unset($data['objNo']);
        $time = date('Y-m-d H:i:s');
        $data['updatetime'] = $time;


        if($objNo) {
            db('zt_good')->where('id',$objNo)->update($data);
        }else{
            db('zt_good')->insert($data);
        }
        return ['status'=>200,'msg'=>'成功！'];
    }

}
