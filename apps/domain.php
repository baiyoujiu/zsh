<?php
/* +----------------------------------------------------------------------
 * | 域名配置
 * +----------------------------------------------------------------------
 * | date 2019
 * +----------------------------------------------------------------------
 * | Author: Bill <zhlsh45@126.com>
 * +----------------------------------------------------------------------
 */

/*$inf = db('building_pic')
				->where('id',2)
				->find();*/


return [
	//泛域名部署
	'__domain__'=>[
		'www.jsg.cc'      => 'mall',//商城前台
		'www.jsg.co'      => 'mcenter',//商城后台
		'www.wb.cc'      => 'wb',//网编后台
	]

];