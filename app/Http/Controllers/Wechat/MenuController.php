<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Menu;
use App\Model\Check;
use App\Model\Material;
use think\Cache;


class MenuController extends Controller
{
    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function menuList(Request $request)
    {
        $menu=new Menu();
        $re = '{
    "menu": {
        "button": [
            {
                "type": "click", 
                "name": "今日歌曲", 
                "key": "V1001_TODAY_MUSIC", 
                "sub_button": [ ]
            }, 
            {
                "type": "click", 
                "name": "歌手简介", 
                "key": "V1001_TODAY_SINGER", 
                "sub_button": [ ]
            }, 
            {
                "name": "菜单", 
                "sub_button": [
                    {
                        "type": "view", 
                        "name": "搜索", 
                        "url": "http://www.soso.com/", 
                        "sub_button": [ ]
                    }, 
                    {
                        "type": "view", 
                        "name": "视频", 
                        "url": "http://v.qq.com/", 
                        "sub_button": [ ]
                    }, 
                    {
                        "type": "click", 
                        "name": "赞一下我们", 
                        "key": "V1001_GOOD", 
                        "sub_button": [ ]
                    }
                ]
            }
        ]
    }
}';
        $data=json_decode($re,true)['menu']['button'];
        //print_r($data);die;
        $arr=[];
        $arr1=[];
        foreach ($data as $key=>$val){
            $arr[$key]['pid']=1;
            $arr[$key]['name']=$val['name'];
            $arr[$key]['type']=empty($val['type'])?'':$val['type'];
            $arr[$key]['url']=empty($val['url'])?'':$val['url'];
            $arr[$key]['key']=empty($val['key'])?'':$val['key'];
            if(!empty($val['sub_button'])){
                foreach ($val['sub_button'] as $k=>$v){
                    $arr1[$k]['pid']=$key;
                    $arr1[$k]['name']=$v['name'];
                    $arr1[$k]['type']=empty($v['type'])?'':$v['type'];
                    $arr1[$k]['url']=empty($v['url'])?'':$v['url'];
                    $arr1[$k]['key']=empty($v['key'])?'':$v['key'];
                }
            }
        }
//        print_r($arr);
//        print_r($arr1);die;
        $arr = array_merge($arr,$arr1);
        //print_r($arr);die;
        foreach ($arr as $v){
            //print_r($v);
            //$menu->insert($v);
            return view('wechat.menuList',['arr'=>$v]);
        }


    }


    public function addmenu()
    {
        
    }

}
