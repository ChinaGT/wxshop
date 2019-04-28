<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



route::any('/',"IndexController@index");

route::group(['middleware'=>'logs','prefix'=>'order'],function(){
    route::any('order',"Order\OrderController@index");


});

route::group(['middleware'=>'logs','prefix'=>'index'],function(){
    route::any('shopcart','IndexController@shopcart');
    route::any('shopcartdo','IndexController@shopcartdo');
    route::any('total','IndexController@total');
    route::any('totaldo','IndexController@totaldo');
    route::any('address','IndexController@address');
    route::any('mywallet','IndexController@mywallet');
    route::any('share','IndexController@share');
    route::any('buyrecord','IndexController@buyrecord');
    route::any('buyrecord','IndexController@buyrecord');


});
route::any('userpage','IndexController@userpage');
route::any('allshops','IndexController@allshops');
route::any('allshopsDo','IndexController@allshopsDo');
route::any('shopcontent/{id}','IndexController@shopcontent');
route::get('alipay','IndexController@alipay');
route::get('alipaydo','IndexController@alipaydo');



route::any('send','User\UserController@send');
route::any('login','User\UserController@login');
route::any('logindo','User\UserController@logindo');
route::any('quit','User\UserController@quit');
route::any('register','User\UserController@register');
route::any('add','User\UserController@add');
route::any('code','User\UserController@code');

route::group(['middleware'=>'login'],function(){
    route::any('index1','TestController@index');
    route::get('update1','TestController@update1');
    route::post('updatedo1','TestController@updatedo');
    route::post('del1','TestController@del');
    route::get('add1','TestController@add');
    route::post('adddo1','TestController@adddo');
    route::post('upload1','TestController@upload');
    route::get('sel1','TestController@sel');
});
route::get('register1','TestController@register');
route::post('registerdo1','TestController@registerdo');
route::get('login1','TestController@login');
route::post('logindo1','TestController@logindo');
route::get('quit1','TestController@quit');



route::any('valid','Test1Controller@valid');

route::get('demo','Demo\DemoController@demo');
route::get('group','Demo\DemoController@group');
route::get('CreatePM','Demo\DemoController@CreatePM');
route::get('sendAll','Demo\DemoController@sendAll');
route::get('groups','Demo\DemoController@groups');
route::any('codes','Demo\DemoController@codes');
route::any('docodes','Demo\DemoController@docodes');
route::get('wxbd','Demo\DemoController@wxbd');
route::post('dowxbd','Demo\DemoController@dowxbd');



route::any('codelogin/{id}','User\UserController@wxcodelogin');
route::any('createcode','QrcodeController@qrcode');

