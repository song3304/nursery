<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//$router->pattern('id', '[0-9]+'); //所有id都是数字
$router->any('wechat/feedback/{aid}/{oid?}', 'WechatController@feedback');
$router->addAnyActionRoutes([
	'wechat',
]);

$router->any('pay/notifyAlipay/{oid}', 'PayController@notifyAlipay');
$router->any('pay/notifyWeixin/{oid}', 'PayController@notifyWeixin');

$router->group(['namespace' => 'Admin','prefix' => 'admin', 'middleware' => ['auth', 'role:administrator']], function($router) {
    
	$router->addAdminRoutes([
		'member' => 'MemberController',
	    'user_address'=>'UserAddressController',
	    'banner' => 'BannerController',
	    'company_info' => 'CompanyInfoController',
	    'company_cms' => 'CompanyCmsController',
	    'article' => 'ArticleController',
	    'notice' => 'NoticeController',
	    'question' => 'QuestionController',
	    'order' => 'OrderController',
	    'statistics' => 'StatisticsController',
	]);
	$router->get('banner/toggle/{id}','BannerController@toggle');
	$router->get('question/reply/{id}','QuestionController@reply');
	$router->get('question/show/{id}','QuestionController@show');
	
	$router->any('order/{id}/cancel','OrderController@cancel');
	$router->any('order/{id}/recharge','OrderController@recharge');
	//admin目录下的其它路由需放置在本条前
	$router->addUndefinedRoutes();
});

//根目录的其它路由需放置在本条前
$router->addUndefinedRoutes();

