<?php

namespace App\Model;

class Check
{
    /***
     * @content 封装一个post请求
     */
    public static function HttpPost($url,$post_data)
    {
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式回复而不是直接输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
        $data = curl_exec($curl);
        //关闭url请求
        curl_close($curl);
        //先是获得的数据
        return $data;

    }

    /***
     *
     * @param $city
     * @return string 调用接口获取城市天气信息
     */
    public static function getCityWether($city)
    {
        $url="http://api.map.baidu.com/telematics/v2/weather?location=$city&ak=1a3cde429f38434f1811a75e1a90310c";
        $apistr=file_get_contents($url);
        $apiobj=simplexml_load_string($apistr);
        if(empty($apiobj['results']=='')){
            $contentStr = '暂未有该城市天气';
        }else{
            $placeobj=$apiobj->currentCity;//读取城市
            $todayobj=$apiobj->results->result[0]->date;//读取星期
            $weatherobj=$apiobj->results->result[0]->weather;//读取天气
            $windobj=$apiobj->results->result[0]->wind;//读取风力
            $temobj=$apiobj->results->result[0]->temperature;//读取温度
            $contentStr = "{$placeobj}\n{$todayobj}\n天气{$weatherobj}，\n风力{$windobj}，\n温度{$temobj}";
        }


        return $contentStr;
    }

    /***
     * 获取关键字天气前的城市名
     * @param $keywords
     * @return mixed|string
     */
    public static function getCityName($keywords)
    {
        $city = str_replace ("天气", '', $keywords );
        $city=trim($city);
        return $city;
    }

    /***
     * 从微信获取token
     * @return mixed
     */
    public static function CreateAccessToken()
    {
        $appid = env('WXAPPID');
        $appsecret = env("WXAPPSECRET");
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $res =  file_get_contents($url);
        $token = json_decode($res,true)['access_token'];

        return $token;

    }

    /***
     * 获取文件中的token
     * @return mixed
     */
    public static function GetAccessToken()
    {
        /***
         * 读取文件 看看有没有 有的话读取  没有的话生成
         * 看看token是否过期 没有获取  有的话 生成
         */
        $path = public_path()."/wx";
        $filename = $path."/token.txt";
        $str = file_get_contents($filename);
        if(!empty($str)){
            $now = time();
            $data = json_decode($str,true);
            if($now>$data['expire']){
                $token = self::CreateAccessToken();
                $expire = time()+7100;
                $arr = ['token'=>$token,"expire"=>$expire];
                $str = json_encode($arr);
                file_put_contents($filename,$str);
            }else{
                $token = $data['token'];
            }
        }else{
            $token = self::CreateAccessToken();
            $expire = time()+7100;
            $arr =['token'=>$token,'expire'=>$expire];
            $str = json_encode($arr);
            file_put_contents($filename,$str);
        }


            return $token;
    }

    //获取文件类型
    public static function getType($data)
    {
        $data=explode('/',$data);
        $type=$data[0];
        return $type;
    }


    public static function getGoods($keyword)
    {
        $goods=new Goods();
        $data=$goods->where('goods_name',$keyword)->first();
        $goods_id=$data['goods_id'];
        if(!empty($goods_id)){
            $url="http://gt.zty77.com/shopcontent/$goods_id";
            return $url;
        }else{
            return null;
        }

    }

    public static function getOpenIdList()
    {
        $token=self::GetAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token";
        $re = file_get_contents($url);
        $re = json_decode($re,true)['data']['openid'];
        return $re;
    }


    public static function getOrderName($keywords)
    {
        $order = substr($keywords,6);
        return $order;
    }


    /***
     *
     * @param $city
     * @return string
     */
    public static function getOrderWether($order)
    {
        $data=Orders::where('ordernum',$order)->first()->toArray();
        $goods_name=$data['goodsname'];
        $goodsprice=$data['goodsprice'];
        $res = $goods_name.','.$goodsprice;
        return $res;
    }




}
