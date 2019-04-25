<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Check;
use Storage;
use CURLFile;
use App\Model\Material;



class WechatController extends Controller
{

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function uplindex(Request $request)
    {
        
        return view('wechat.index');
    }

    
    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function upload(Request $request)
    {
        $mate=new Material();
        $data=$mate->orderBy('id','desc')->first();
        $type=$data['m_type'];
        //dd($type);
        return view('wechat.upload',['type'=>$type]);
    }

    public function uploaddo(Request $request)
    {
        //接收文件
        $file1=$request->m_upl;
        $file2=$request->upl;
        if(!empty($file1)){
            $file=$file1;
        }else if(!empty($file2)){
            $file=$file2;
        }else{
            $file=null;
        }
        $material=new Material();
        if(!empty($file)){
            //获取文件类型
            $data=$file->getClientMimeType();
            //获取文件后缀名
            $ext = $file->getClientOriginalExtension();
            //dd($ext);
            //获取临时文件位置
            $path = $file->getRealPath();
            //dd($path);
            $newfileanme = date("Ymd").'/'.mt_rand(1111,9999).".".$ext;
            //上传
            $res = Storage::disk('uploads')->put($newfileanme,file_get_contents($path));
            //dd($res);
            if($res){
                $token=Check::GetAccessToken();
                //dd($token);
                $type=Check::getType($data);
                if($type=='audio'){
                    $type='voice';
                }
                //dd($type);
                $imgpath = public_path().'/uploads/'.$newfileanme;
                $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$token&type=$type";
                $data = ['media'=>new CURLFile(realpath($imgpath))];
                //dd($data);
                $arr=Check::HttpPost($url,$data);
                $arr=json_decode($arr,true);
                //dd($arr);
                $material->m_title=$request->input('m_title',null);
                $material->m_desc=$request->input('m_desc',null);
                $material->m_url=$request->input('m_url',null);
                $material->m_upl='uploads/'.$newfileanme;
                $material->m_type=$type;
                //dd($type);
                $material->m_id=$arr['media_id'];
                $material->m_url=$arr['url'];

                $re=$material->save();
                if($re){
                    die('添加成功');
                }else{
                    die('添加失败');
                }
            }else{
                die('失败');
            }
        }else{
            $material->m_title=$request->text;
            $material->m_type='text';
            $re=$material->save();
            if($re){
                die('添加成功');
            }else{
                die('添加失败');
            }
        }


    }


    public function aaa()
    {

    }


   






}
