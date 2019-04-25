<?php

namespace App\Http\Controllers\Demo;

use App\Model\Orders;
use App\Model\User;
use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Check;
use Illuminate\Support\Facades\Redis;




class DemoController extends Controller
{
    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function demo(Request $request)
    {
        $token=Redis::get('token');
        if(!empty($token)){
            return unserialize($token);
        }else{
            $token=Check::CreateAccessToken();
            Redis::set('token',serialize($token));
            $token=Redis::get('token');
            return unserialize($token);
        }
    }


    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function group(Request $request)
    {
        $token = Check::GetAccessToken();
        //dd($token);
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$token";
        $openId=Check::getOpenIdList();
        //print_r($openId);
        $postdata = [
            'msgtype'=>'text',
            'text'=>[
                'content'=>'这是一个脚本测试'.date("Y-m-d H:i:s",time())
            ],
            'touser'=>$openId
        ];
        $postdata = json_encode($postdata,JSON_UNESCAPED_UNICODE);
        $re = Check::HttpPost($url,$postdata);
        print_r($re);
    }


    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function CreatePM(Request $request)
    {
//        $re=floor((0.1+0.7)*10);
//        var_dump($re);
        $token = Check::GetAccessToken();
        //dd($token);
        $url="https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=$token";
        $postdata = '{
    "button": [
        {
            "type": "click", 
            "name": "女装", 
            "key": "V1001_TODAY_MUSIC"
        }, 
        {
            "name": "菜单", 
            "sub_button": [
                {
                    "type": "view", 
                    "name": "搜索", 
                    "url": "http://www.soso.com/"
                }, 
                {
                    "type": "miniprogram", 
                    "name": "wxa", 
                    "url": "http://mp.weixin.qq.com", 
                    "appid": "wx286b93c14bbf93aa", 
                    "pagepath": "pages/lunar/index"
                }, 
                {
                    "type": "click", 
                    "name": "赞一下我们", 
                    "key": "V1001_GOOD"
                }
            ]
        }
    ], 
    "matchrule": {
        "sex": "2", 
    }
}';

        $re = Check::HttpPost($url,$postdata);
        print_r($re);
    }


    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function sendAll(Request $request)
    {
        $token = Check::GetAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$token";
        $openId=Check::getOpenIdList();
        //dd($openId);


        $postdata = [
            'openid_list'=>$openId,
            'tagid'=>100
        ];
        $postdata = json_encode($postdata,JSON_UNESCAPED_UNICODE);
        //print_r($postdata);die;
        $re = Check::HttpPost($url,$postdata);
        print_r($re);
    }

    public function groups()
    {
        $token = Check::GetAccessToken();
        dd($token);
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$token";
        $postdata='{
           "filter":{
              "is_to_all":false,
              "tag_id":100
           },
           "text":{
              "content":"hello"
           },
            "msgtype":"text"
        }';
        $re = Check::HttpPost($url,$postdata);
        print_r($re);
    }


    public function orderAll()
    {

    }


    public function codes()
    {
        $res=urlEncode('http://gt.zty77.com/docodes');
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx8ede1d5693643f15&redirect_uri=$res&response_type=code&scope=snsapi_userinfo&state=admin123#wechat_redirect";
        print_r($url);
    }

    public function docodes(Request $request)
    {
        $code=$request->code;
        //dd($code);
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx8ede1d5693643f15&secret=26de03defde52b2ec23658a130090fe7&code=$code&grant_type=authorization_code";
        $res=file_get_contents($url);
        //dd($res);
        $access_token=json_decode($res,true);
        //dd($access_token);
        $access_token=$access_token['access_token'];
        $openid=json_decode($res,true)['openid'];

        $infourl="https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
        $re = file_get_contents($infourl);
        $openid = json_decode($re,true)['openid'];

        $user = new User();
        $data=[
            'openid'=>$openid
        ];
        $where=[
            'user_tel'=>session('tel')
        ];
        $res=$user->where($where)->insert($data);
        if($res!==false){
            die('授权成功');
        }else{
            die('授权失败');
        }

    }

    public function wxbd()
    {
        $user_id=session('user_id');
        //dd($user_id);
        if(!empty($user_id)){
            return view('demo.wxbd');
        }else{
            return redirect('login');
        }

    }

    public function dowxbd(Request $request)
    {

        $mobile=$request->mobile;
        $code=$request->code;
        $mobile2=session('mobile');
        $code2=session('mobilecode');
        if($mobile!=$mobile2){
            return 2;
        }else{
            if($code!=$code2){
                return 3;
            }else{
                session('tel',$mobile2);
                return 1;
            }
        }

    }

}
