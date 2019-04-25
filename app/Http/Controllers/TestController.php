<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Http\Requests\Update;
use App\Model\Imgu;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use think\response\Redirect;

class TestController extends Controller
{
    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function login(Request $request)
    {

        return view('login.login');
    }

    /***
     * @param Login $request
     */
    public function logindo(Login $request)
    {

        $user_tel=$request->user_tel;
        $pwd=$request->pwd;
        $new_code=$request->code;
        //$validate=$request->validated();
        $code=session('user_code');
        if($new_code!=$code){
            echo 2;
        }else{
            $user = new User();
            $where=[
                'user_tel'=>$user_tel
            ];
            $resurl=$user->where($where)->first();
            //print_r($resurl);
            if(!empty($resurl)){
                if((decrypt($resurl['user_pwd']))!=$pwd){
                    echo 4;
                }else{
                    session()->put('u_tel',$user_tel);
                    session()->put('u_id',$resurl['user_id']);
                    session()->put('u_name',$resurl['user_name']);
                    session()->save();
                    echo 1;
                }

            }else{
                echo 3;
            }
        }

    }

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function register()
    {

        return view('login.register');
    }

    /***
     * @param Register $request
     */
    public function registerdo(Register $request)
    {
        $user=new User();
        $user_tel=$user->user_tel=$request->user_tel;
        $user_name=$user->user_name=$request->user_name;
        $user_pwd=$user->user_pwd=encrypt($request->pwd);
        $res=$user->save();
        if(!empty($res)){
            echo 1;
            session()->put('u_tel',$user_tel);
            session()->put('u_name',$user_name);
            session()->put('u_id',$res['user_id']);
            session()->save();
        }else{
            echo 2;
        }
    }

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function index(Request $request)
    {
        $imgu=new Imgu();
        $keyword=$request->keyword;
        $where=[
            'is_sel'=>1,
        ];
        $data=$imgu->where($where)->where('img_name','like',"%$keyword%")->paginate(2);
        return view('login.index',['data'=>$data,'keyword'=>$keyword]);
    }

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function del(Request $request)
    {
        $imgu=new Imgu();
        $img_id=$request->img_id;
        //dd($img_id);
        $where=[
            'img_id'=>$img_id
        ];
        $data=[
            'is_sel'=>2
        ];
        $res=$imgu->where($where)->update($data);
        if(!empty($res)){
            echo 1;
        }else{
            echo 2;
        }
    }

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function sel(Request $request)
    {
        $imgu=new Imgu();
        $img_id=$request->img_id;
        $where=[
            'img_id'=>$img_id
        ];
        $data=$imgu->where($where)->first()->toArray();
        //dd($data);
        return view('login.sel',['data'=>$data]);
    }

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function quit()
    {
        session()->put('u_tel',null);
        session()->put('u_id',null);
        session()->put('u_name',null);
        return redirect('login1');
    }

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function update1()
    {

        return view('login.update');
    }

    /***
     * @param Update $request
     */
    public function updatedo(Update $request)
    {
        $user=new User();
        $user_tel=session()->get('u_tel');
        $pwd=$request->pwd;
        $user_pwd=$request->new_pwd;
        $where=[
            'user_tel'=>$user_tel
        ];
        $resurl=$user->where($where)->first();
        //print_r($user_pwd);
        if(!empty($resurl)){
            if(decrypt($resurl['user_pwd'])==$pwd){
                $user_pwd=encrypt($user_pwd);
                $where=[
                    'user_tel'=>$user_tel
                ];
                //dd($user_pwd);
                $data=[
                    'user_pwd'=>$user_pwd
                ];
                //dd($where);
                $res=$user->where($where)->update($data);
                if($res!==false){
                    echo 1;//修改成功
                }else{
                    echo 4;//修改失败
                }
            }else{
                echo 3;//原密码错误
            }
        }else{
            echo 2;//请先登录
        }

    }

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function add()
    {

        return view('login.add');
    }

    /***
     * @param Request $request
     */
    public function adddo(Request $request)
    {
        $imgu = new Imgu();
        $imgu->img_name=$request->img_name;
        $img_img=$imgu->img_img=$request->img_img;
        $img_time=$imgu->img_time=strtotime($request->img_time);
        $imgu->user_id=session('u_id');
        //dd($img_img);
        $res=$imgu->save();
        if(!empty($res)){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function upload(Request $request)
    {
        $img=$request->file('img')->store('public/images/interview');
        $path=substr($img,6);
        //print_r($img_img);die;
        $data = [
            "code"=>0,
            "msg"=>"上传成功",
            "data"=>[
                "src"=>$path
            ]
        ];
        echo json_encode($data);
    }


}
