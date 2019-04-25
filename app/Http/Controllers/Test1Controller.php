<?php

namespace App\Http\Controllers;


use App\Model\Goods;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Check;
use App\Model\Material;

class Test1Controller extends Controller
{
    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function valid(Request $request)
    {
        $this->responseMsg();
//        $echostr = $_GET['echostr'];
//        if(!empty($echostr)){
//            if($this->checkSignature()){
//                echo $echostr;exit;
//            }
//        }else{
//        }

        //echo $echostr;exit;

    }

    private function checkSignature()
    {
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];

        $token = env("WEIXINTOKEN");

        //将三个参数写入数组
        $arr = array($token,$timestamp,$nonce);
        //字典排序
        sort($arr,SORT_STRING);
        //拼接参数
        $str = implode($arr);
        //sha1 加密
        $sign = sha1($str);
        if($sign == $signature){
            return true;
        }else{
            return false;
        }

    }


    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = file_get_contents("php://input");
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keywords = $postObj->Content;
        $type = $postObj->MsgType;
        $time = time();
        $msgType = "text";
        //extract post data
        $content = [];
        if($type=='text'){
            $filename = public_path().'/record/'.date("Ymd").'.php';
            $content[]=[
                'openid'=>$fromUsername,
                'content'=>$keywords,
                'time'=>$time,
            ];
            $str = json_encode($content,JSON_UNESCAPED_UNICODE);
            //chmod($filename,0777);
            file_put_contents($filename,$str,FILE_APPEND);
            //dd($content);
        }else if($type=='image'){
            $picurl = $postObj->PicUrl;
            $img = file_get_contents($picurl);
            $path = public_path()."/uploads/".date("Ymd").".jpg";
            $res = file_put_contents($path,$img);

        }

        if (!empty($postStr)){
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
            //是否为事件
            if($postObj->MsgType == 'event'){
                //事件类型
                if($postObj->Event == 'subscribe'){
                    $user = new User();
                    $data=$user->where('openid',$fromUsername)->first();
                    if(!empty($data)){
                        $access = Check::GetAccessToken();
                        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access&openid=$fromUsername&lang=zh_CN";
                        $data=file_get_contents($url);
                        $nickname=json_decode($data,true)['nickname'];
                        $contentStr="$nickname"."欢迎您回来";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$contentStr);
                        echo $resultStr;
                    }else{
                        $contentStr="尊敬的用户您好,感谢您的使用,首次关注需要您绑定本网站的账户,以便为您提供服务,".'<a href="http://gt.zty77.com/wxbd">点击绑定</a>';
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$contentStr);
                        echo $resultStr;
                    }

                }else if($postObj->Event == 'CLICK'){
                    $goods = new Goods();
                    $arr = $goods->limit(5)->get()->toArray();
                    $item="<item>
                          <Title><![CDATA[%s]]></Title>
                          <Description><![CDATA[%s]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                        </item>";
                                $itm="";
                                foreach($arr as $k=>$v){
                                    $itm.=sprintf($item,$v['goods_name'], $v['self_price'],"http://gt.zty77.com/images/yiwancheng.png" ,"http://gt.zty77.com/shopcontent/".$v['goods_id']);
                                }
                                $textTpl = "<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime><![CDATA[%s]]></CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>5</ArticleCount>
                          <Articles>
                            $itm
                          </Articles>
                        </xml>";
                    $msgType = "news";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);
                    echo $resultStr;
                    exit;
                }
            }
            //天气关键字
            if(!empty($keywords))
            {
                $contentStr=Check::getGoods($keywords);
                if(!empty($contentStr)){
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$contentStr);
                    echo $resultStr;
                }else if(strstr($keywords, "天气") )//包含天气关键字
                {
                    $city=Check::getCityName($keywords);
                    $contentStr=Check::getCityWether($city);
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$contentStr);
                    echo $resultStr;
                    exit;
                }else if(strstr($keywords, "订单") )//包含天气关键字
                {
                    $orderName=Check::getOrderName($keywords);
                    $contentStr=Check::getOrderWether($orderName);
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$contentStr);
                    echo $resultStr;
                    exit;
                }else if($keywords=='图片'){
                    $material = new Material();
                    $data = $material->where(['id'=>7])->first();
                    $MediaId=$data['m_id'];
                    //$MediaId="lVcnJP-d_zEa-5uXezi3-LIQ7lQ1aH43UsSEjKqPTWGHGlvjX79pNpmi9GfT6ROj";
                    $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                          </Image>
                        </xml>";
                    $msgType = "image";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $MediaId);
                    echo $resultStr;
                    exit;
                }else if($keywords=='图文'){
                    //$MediaId="lVcnJP-d_zEa-5uXezi3-LIQ7lQ1aH43UsSEjKqPTWGHGlvjX79pNpmi9GfT6ROj";
                    $material = new Material();
                    $data = $material->where(['id'=>4])->first();
                    $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>%s</ArticleCount>
                          <Articles>
                            <item>
                              <Title><![CDATA[%s]]></Title>
                              <Description><![CDATA[%s]]></Description>
                              <PicUrl><![CDATA[%s]]></PicUrl>
                              <Url><![CDATA[%s]]></Url>
                            </item>
                          </Articles>
                        </xml>";
                    $msgType = "news";
                    $title=$data['m_title'];
                    $m_desc=$data['m_desc'];
                    $m_purl=url($data['m_upl']);
                    $m_url=$data['m_url'];
                    $ac='1';
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType , $ac, $title , $m_desc ,$m_purl ,$m_url);
                    echo $resultStr;
                    exit;
                }else if($keywords=='最新商品'){
                    $Goods = new Goods();
                    $data = $Goods->orderBy('create_time','desc')->first()->toArray();
                    $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>%s</ArticleCount>
                          <Articles>
                            <item>
                              <Title><![CDATA[%s]]></Title>
                              <Description><![CDATA[%s]]></Description>
                              <PicUrl><![CDATA[%s]]></PicUrl>
                              <Url><![CDATA[%s]]></Url>
                            </item>
                          </Articles>
                        </xml>";
                    $msgType = "news";
                    $title=$data['goods_name'];
                    $m_desc=$data['goods_desc'];
                    $m_purl=url($data['goods_img']);
                    $m_url="http://gt.zty77.com/shopcontent/".$data['goods_id'];
                    $ac='1';
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType , $ac, $title , $m_desc ,$m_purl ,$m_url);
                    echo $resultStr;
                    exit;
                }else{
                    //调用图灵机器人
                    $data = [
                        'perception'=>[
                            'inputText'=>[
                                'text'=>$keywords
                            ]
                        ],
                        'userInfo'=>[
                            'apiKey'=>'2409823fdd8041bb95e10eba58fd9504',
                            'userId'=>'admin123456'
                        ]
                    ];

                    $post_data = json_encode($data);
                    $tuling_url = "http://openapi.tuling123.com/openapi/api/v2";

                    $res = Check::HttpPost($tuling_url,$post_data);
                    $msg = json_decode($res,true)['results'][0]['values']['text'];

                    $contentStr = $msg;
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }

            }


        }else {
            echo "";
            exit;
        }
    }


    public function token()
    {
        $token=Check::GetAccessToken();
        print_r($token);

    }

    public function aaa()
    {


    }





}
