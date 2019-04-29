<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\Register;
use App\Http\Controllers\Controller;
use App\Model\Ticket;
use App\Model\User;
use App\Tools\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        //

        return view('register');


    }

    //点击发送验证码
    public function send(Request $request)
    {
        $mobile=$request->mobile;
        //var_dump($mobile);die;
        $this->sendMobile($mobile);

    }

    /*
     * @content 发送手机验证码
     * @params  $mobile  要发送的手机号
     *
     * */
    private function sendMobile($mobile)
    {
        //dd($mobile);
        $host = env("MOBILE_HOST");
        $path = env("MOBILE_PATH");
        $method = "POST";
        $appcode = env("MOBILE_APPCODE");
        $headers = array();
        $code = $this->createcode(4);
        session(['mobilecode'=>'0588','mobile'=>$mobile],3*60);
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$mobile;
        $bodys = "";
        $url = $host . $path . "?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);

    }


    public function createcode($len)
    {
        $code='';
        for ($i=1;$i<=$len;$i++){
            $code.=mt_rand(0,9);
        }
        return $code;
    }

    /**
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {

        //print_r(1);die;
        $code=session('mobilecode');
        $mobile=session('mobile');
        $user = new User();
        $tel=$user_tel=$user->user_tel=$request->user_tel;
        $pwd=$user->user_pwd=encrypt($request->user_pwd);
        $newcode=$user->user_code=$request->code;
        //print_r($tel);
        //print_r($pwd);
        //print_r($newcode);die;
        if($mobile!=$tel){
            echo 0;exit;
        }else{
            if($newcode==$code){
                $res=$user->save();
                if(!empty($res)){
                    $id=$user->user_id;
                    $request->session()->put('user_id',$id);
                    $request->session()->put('user_name',$user_tel);
                    session()->save();
                    echo 1;
                }else{
                    echo 2;
                }
            }else{
                echo 3;
            }
        }




    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function User()
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        return view('login');


    }

    public function code()
    {
        $code=new Captcha();
        $user_code=$code->getCode();
        session()->put('user_code',$user_code);
        return $code->doimg();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logindo(Request $request)
    {
        //dd(aaa);
        $user_code=session('user_code');
        $user = new User();
        $user_name=$request->user_name;
        $user_pwdn=$request->user_pwd;
        $u_code=$request->code;
        //dd($user_pwdn);
        if($user_code==$u_code){
            $where=[
                'user_tel'=>$user_name
            ];
            $arr=$user->where($where)->first();
            //dd($arr);
            //$id=$arr['user_id'];
            //dd($id);
            if(!empty($arr)){
                $id=$arr['user_id'];
                $user_pwd=decrypt($arr['user_pwd']);
                //print_r($user_pwd);die;
                if($user_pwdn==$user_pwd){
                    //dd($id);
                    $request->session()->put('user_id',$id);
                    $request->session()->put('user_name',$user_name);
                    session()->save();
                    print_r(3) ;
                }else{
                    print_r(2) ;
                }
            }else{
                echo 4;
            }
        }else{
            print_r(1) ;
        }


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upd(Request $request)
    {
        return view('user\upd');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upddo(Request $request)
    {
        $user_id=session('id');
        $user_pwd=$request->user_pwd;
        $user_pwd=encrypt($user_pwd);
        //print_r($user_pwd);die;
        $user = new User();
        $where=[
            'user_id'=>$user_id
        ];
        $data=[
            'user_pwd'=>$user_pwd
        ];
        $res=$user::where($where)->update($data);
        //print_r($user_pwd);die;
        if(!empty($res)){
            return redirect('book\show');
        }else{
            return redirect('user\upd');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quit(Request $request)
    {
        $request->session()->put('user_id',null);
        return redirect('login');
    }


    public function wxlogin(Request $request)
    {
        $code = $request->code;
        $userid = $request->state;
        $appid = env('WXAPPID');
        $appscript = env('WXAPPSECRET');
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appscript&code=$code&grant_type=authorization_code";
        $json_token = file_get_contents($token_url);
        $token = json_decode($json_token,true)['access_token'];
        $openid = json_decode($json_token,true)['openid'];
        $user_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid&lang=zh_CN";
        $info = json_decode(file_get_contents($user_url),true);
        $data =[
            'userid'=>$userid,
            'openid'=>$info['openid'],
            'status'=>2
        ];
        $ticket = new Ticket();
        $res = $ticket->insert($ticket);
        return view('user.wxlogin',['user_info'=>$info]);

    }
    

    public function wxcodelogin($id){
        $appid = env('WXAPPID');
        $redirect_uri = urlencode("http://gt.zty77.com/wxlogin");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=SCOPE&state=$id#wechat_redirect";
        return redirect($url);
        //dd($url);
    }

}
