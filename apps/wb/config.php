<?php
//子网站运营中心配置文件
return [
	// 视图输出字符串内容替换
	'view_replace_str'       => [
		'__JSPZ__' => '/pz178/js',
		'__CSSPZ__' => '/pz178/css',
		'__IMGPZ__' => '/pz178/img',
		
		//专题
		/* '__JSPZ__' => '/pz178/js',
		'__CSSPZ__' => '/pz178/css',
		'__IMGPZ__' => '/pz178/img', */
	],
	
	//只改了模板路径。
	'template'               => [
		// 模板引擎类型 支持 php think 支持扩展
		'type'         => 'Think',
		// 模板路径
		'view_path'    => '../template/wb/',
		// 模板后缀
		'view_suffix'  => 'php',
		// 模板文件名分隔符
		'view_depr'    => DS,
		// 模板引擎普通标签开始标记
		'tpl_begin'    => '{',
		// 模板引擎普通标签结束标记
		'tpl_end'      => '}',
		// 标签库标签开始标记
		'taglib_begin' => '{',
		// 标签库标签结束标记
		'taglib_end'   => '}',
	],
	
	'http_exception_template'    =>  [
		// 定义404错误的重定向页面地址
		404 =>  APP_PATH.'shop/404.php',
		// 还可以定义其它的HTTP status
		401 =>  APP_PATH.'shop/401.php',
	],
	// +----------------------------------------------------------------------
	// | 会话设置
	// +----------------------------------------------------------------------
	
	'session'                => [
	'id'             => '',
	// SESSION_ID的提交变量,解决flash上传跨域
	'var_session_id' => '',
	// SESSION 前缀
	'prefix'         => 'wb',
	// 驱动方式 支持redis memcache memcached
	'type'           => '',
	// 是否自动开启 SESSION
	'auto_start'     => true,
	],
]
?>