<?php
/* +----------------------------------------------------------------------
 * | 路由配置
 * +----------------------------------------------------------------------
 * | date 2019
 * | id :只能接数字|key :只能接数字、-|name:接字符串
 * +----------------------------------------------------------------------
 * | Author: Bill <zhlsh45@126.com>
 * +----------------------------------------------------------------------
 */

return [

    //设置全局变量规则，全部路由有效：
    '__pattern__' => [
        'nk' => '(\w|-)+',
        'id'   =>  '\d+',  
        'key' => '(\d|-|_)+',
    ],
   /*  '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ], */
    //'my'        =>  'index/index/aa', // 静态地址路由
    /* '/' => 'index', // 首页访问路由
    'my'        =>  'index/index/aa', // 静态地址路由
    'blog/:id'  =>  'Blog/read', // 静态地址和动态地址结合
    'new/:year/:month/:day'=>'News/read', // 静态地址和动态地址结合
    ':user/:blog_id'=>'Blog/read',// 全动态地址 */
    
    
    //后台路由规则
    //'路由规则2'=>['路由地址和参数','匹配参数（数组）','变量规则（数组）']
    
    //商品
    'list/:key'        =>  ['goods/index'],
    'goods/:id'        =>  ['goods/inf'],
    'cart/index'        =>  ['order/cart'],
    'newsinf/:id'        =>  ['news/inf'],
	'books/:id'        =>  ['news/books'],
    'ztinf/:id'        =>  ['zt/inf'],
    

    //系统
    //'webedit/:id'        =>  ['system/webedit', ['id' => '\d+']],
    //'flashedit/:id'        =>  ['flash/edit', ['id' => '\d+']],
    //'servicesedit/:id'        =>  ['system/servicesedit',  ['id' => '\d+']],

	
];