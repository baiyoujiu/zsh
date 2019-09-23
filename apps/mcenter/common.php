<?php
//模块函数文件
/* <input type="hidden" id="curPage" name="curPage" value="1">
 <ul id="pagination-digg" class="pager pagination pull-right">
<li><a>第1/143页</a></li>
<li><a href="javascript:;" class="pageOperate"><i class="iconfont icon-back"></i></a></li>
<li><a href="javascript:;">1</a></li>
<li class="active"><a class="currentPage" href="javascript:topage(2)">2</a></li>
<li><a class="currentPage" href="javascript:topage(3)">3</a></li>
<li><a class="currentPage showDot" href="javascript:void(0)">...</a></li>
<li><a class="currentPage" href="javascript:topage('143')">143</a></li>
<li><a class="currentPage pageOperate" href="javascript:topage('2')"><i class="iconfont icon-pageright"></i></a></li>
<li><a>共1421条</a></li>
<li><span class="pageOperate">跳转至：<input class="" id="good_page_nb" value="1" type="text">页</span></li>
<li><a class="goods_go" href="javascript:jumppages();">跳转</a></li>
</ul> */
/* 获取官网楼盘标签
 * @param $count int 总条数
* @param $parameter array 参数
* @param $nowPage int 当前页码
* @param $pagesize int 每页条数
* return array 二维
*/
function get_page_str($count,$parameter,$nowPage,$pagesize=10){
	$totalPage = ceil($count/$pagesize);

	$url = '/'.request()->controller().'/'.request()->action().'.html';
	$parameter = empty($parameter)?array(1=>1):$parameter;
	$url .= '?'.http_build_query($parameter);

	$pageStr = '<ul id="pagination-digg" class="pager pagination pull-right">
                  <li><a>第'.$nowPage.'/'.$totalPage.'页</a></li>';
	if($totalPage>1){
		$pageStr .= $nowPage>1?'<li><a href="'.$url.'&page='.($nowPage-1).'" class="pageOperate"><i class="iconfont icon-back"></i></a></li>
				<li><a href="'.$url.'&page=1">1</a></li>':'';

		$pageStr .= $nowPage>4?'<li><a class="currentPage showDot" href="javascript:void(0)">...</a></li>':'';
		$pageStr .= $nowPage>3?'<li><a href="'.$url.'&page='.($nowPage-2).'">'.($nowPage-2).'</a></li>':'';
		$pageStr .= $nowPage>2?'<li><a href="'.$url.'&page='.($nowPage-1).'">'.($nowPage-1).'</a></li>':'';
		$pageStr .='<li class="active"><a class="currentPage" href="'.$url.'&page='.$nowPage.'">'.$nowPage.'</a></li>';
		$pageStr .= (($totalPage-$nowPage)>1)?'<li><a href="'.$url.'&page='.($nowPage+1).'">'.($nowPage+1).'</a></li>':'';
		$pageStr .= (($totalPage-$nowPage)>2)?'<li><a href="'.$url.'&page='.($nowPage+2).'">'.($nowPage+2).'</a></li>':'';
		$pageStr .= ($totalPage-$nowPage)>3?'<li><a class="currentPage showDot" href="javascript:void(0)">...</a></li>':'';

		$pageStr .= ($totalPage!=$nowPage)?'<li><a href="'.$url.'&page='.$totalPage.'">'.$totalPage.'</a></li>
				<li><a class="currentPage pageOperate" href="'.$url.'&page='.($nowPage+1).'"><i class="iconfont icon-pageright"></i></a></li>':'';
	}
	$pageStr .= '<li><a>共'.$count.'条</a></li></ul>';

	return $pageStr;
}

/* <div class="Pagination">
<a href="javascript:void(0);" class="disabled"><span>&lt;</span></a>
<a href="javascript:void(0);" class="currentpage">1</a>
<a href="javascript:void(0);" class="currentpage">2</a>
<span class="slh">...</span>
<a href="javascript:void(0);" class="currentpage">5</a>
<a href="javascript:void(0);" class="currentpage">6</a>
<a href="javascript:void(0);" class="currentpage">7</a>
<span class="currentpage">8</span>
<a href="javascript:void(0);" class="currentpage">9</a>
<a href="javascript:void(0);" class="currentpage">10</a>
<span class="slh">...</span>
<a href="javascript:void(0);" class="currentpage">121</a>
<a href="javascript:void(0);" class="currentpage">122</a>
<a href="javascript:void(0);" class="disabled"><span>&gt;</span></a>
</div>
 */
/* 获取官网楼盘标签
 * @param $count int 总条数
 * @param $urlStr str URL路由
* @param $parameter array get参数
* @param $nowPage int 当前页码
* @param $pagesize int 每页条数
* return array 二维
*/
function get_web_page($count,$urlStr,$parameter,$nowPage,$pagesize=10){
	$totalPage = ceil($count/$pagesize);

	$url = $urlStr;
	$parameter = empty($parameter)?array(1=>1):$parameter;
	$url .= '?'.http_build_query($parameter);

	$pageStr = '<div class="Pagination">';
	if($totalPage>1){
		$pageStr .= $nowPage>1?'<a href="'.$url.'&page='.($nowPage-1).'" class="disabled"><span>&lt;</span></a>
				<a href="'.$url.'&page=1" class="currentpage">1</a>':'';

		$pageStr .= $nowPage>4?'<span class="slh">...</span>':'';
		$pageStr .= $nowPage>3?'<a href="'.$url.'&page='.($nowPage-2).'" class="currentpage">'.($nowPage-2).'</a>':'';
		$pageStr .= $nowPage>2?'<a href="'.$url.'&page='.($nowPage-1).'" class="currentpage">'.($nowPage-1).'</a>':'';
		$pageStr .='<span class="currentpage">'.$nowPage.'</span>';
		$pageStr .= (($totalPage-$nowPage)>1)?'<a href="'.$url.'&page='.($nowPage+1).'" class="currentpage">'.($nowPage+1).'</a>':'';
		$pageStr .= (($totalPage-$nowPage)>2)?'<a href="'.$url.'&page='.($nowPage+2).'" class="currentpage">'.($nowPage+2).'</a>':'';
		$pageStr .= ($totalPage-$nowPage)>3?'<span class="slh">...</span>':'';

		$pageStr .= ($totalPage!=$nowPage)?'<a href="'.$url.'&page='.$totalPage.'" class="currentpage">'.$totalPage.'</a>
				<a href="'.$url.'&page='.($nowPage+1).'"class="disabled"><span>&gt;</span></a>':'';
	}
	$pageStr .= '</div>';

	return $pageStr;
}
/*****************************  房产  ********************/
/*  获取楼盘的信息
 * @param $wheres array 查询条件
 * @param $fieldStr str 查询字段字符串
* return array(); 
*/
function getBuildInf($wheres,$fieldStr='name'){
	return db('build')->field($fieldStr)->where($wheres)->find();
}


/*****************************  行业网站 ********************/
/*  获取官网导航
 * @param $web_no int 官网编号
 * return array();
 */
function get_web_nav($web_no){
	if(empty($web_no)){
		return array();
	}
	$fieldStr = 'id,pid,icon,title,url';
	$navList = db('system_web_nav')->field($fieldStr)->where('web_no',$web_no)->where('status',1)->order('weight DESC,id ASC')->select();
	
	$webNoArr = array();
	foreach($navList as $k => $v){
		if($v['pid']<1){
			$webNoArr[$k]=$v['id'];
		}
	}
	foreach($navList as $k => $v){
		if($v['pid']>0){
			$tmp_key = array_search($v['pid'],$webNoArr);
			unset($v['id']);
			unset($v['pid']);
			$navList[$tmp_key]['child'][] = $v;
			unset($navList[$k]);
		}
		unset($navList[$k]['id']);
		unset($navList[$k]['pid']);
	}
	return $navList;
}
?>