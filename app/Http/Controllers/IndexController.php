<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Cart;
use App\Model\Goods;
use App\Model\User;
use DemeterChain\C;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Tools\alipay\wappay\service\AlipayTradeService;
use App\Tools\alipay\wappay\buildermodel\AlipayTradeWapPayContentBuilder;

class IndexController extends Controller
{
    //前台首页
    public function index(Request $request)
    {
        $signPackage=$request->signPackage;
        //dd($signPackage);
        $goods=new Goods();
        $user=new User();
        $data=$goods->all();
        $Udata=$user->all();
        //print_r($data);die;
        $category=new Category();
        $where=[
            'pid'=>0
        ];
        $Cdata=$category->where($where)->get();
        return view('index',['data'=>$data,'Cdata'=>$Cdata,'Udata'=>$Udata,'signPackage'=>$signPackage]);

    }

    //商品列表
    public function allshops(Request $request)
    {
        $cate_id=$request->cate_id;
        $cate=new Category();
        $goods=new Goods();
        if(!empty($cate_id)){
            $cate_id=$cate_id;
            $cateInfo=$cate->all();
            //dd($cateInfo);
            $c_id=getSonCateId($cateInfo,$cate_id);
            $data=$goods->whereIn('cate_id',$c_id)->limit(5)->get();
        }else{
            $cate_id=0;
            //dd($cate_id);
            $data=$goods->limit(5)->get();
        }
        //var_dump($cate_id);die;
        $Cdata=$cate->where(['pid'=>0])->get();
        return view('allshops',['data'=>$data,'Cdata'=>$Cdata,'cate_id'=>$cate_id]);

    }

    //点击分类
    public function allshopsDo(Request $request)
    {
        $cate_id=$request->cate_id;
        $type=$request->type;
        //var_dump($type);die;
        //dd($cate_id);
        $goods=new Goods();
        $where=[];
        if($cate_id!==false){
            //dd(1);
            $cate=new Category();
            $cateInfo=$cate->all();
            //dd($cateInfo);
            $cate_id=getSonCateId($cateInfo,$cate_id);

        }
        //dd($type);
        if($type==4){
            //dd(4);
            $data=Goods::whereIn('cate_id',$cate_id)->orderBy('goods_val','desc')->limit(5)->get();
        }else if($type==8){
            //dd(8);
            $data=Goods::whereIn('cate_id',$cate_id)->orderBy('create_time','asc')->limit(5)->get();
        }else if($type==16){
            //dd(16);
            $data=Goods::whereIn('cate_id',$cate_id)->orderBy('self_price','asc')->limit(5)->get();
        }else{
            //dd(2);
            $data=Goods::whereIn('cate_id',$cate_id)->orderBy('goods_id','asc')->limit(5)->get();
        }

        return view('div',['data'=>$data]);

    }

    public function total(Request $request)
    {
        $goods_id=$request->goods_id;
        $goods_id=rtrim($goods_id,',');
        $goods_id=explode(',',$goods_id);
        //dd($goods_id);
       session(['goods_id'=>$goods_id]);
    }
    public function totaldo(Request $request)
    {
        $goods_id=session('goods_id');
        //dd($goods_id);
        $goods=new goods();
        $data=$goods->whereIn('goods_id',$goods_id)->get();
        //print_r($data);die;
        return view('payment',['data'=>$data]);
    }

    public function address(Request $request)
    {

        return view('address');
    }

    public function shopcart(Request $request)
    {
        $cart=new Cart();
        $goods=new Goods();
        $arr=$goods->orderBy('goods_val','asc')->limit(4)->get();
        $user_id=$cart->user_id=session('id');
        //dd($user_id);
        $where=[
            'user_id'=>$user_id,
            'is_sel'=>1
        ];
        $data=$cart
            ->where($where)
            ->join('goods','goods.goods_id','=','cart.goods_id')
            ->get();
        //print_r($data);die;
        return view('shopcart',['data'=>$data,'arr'=>$arr]);

    }

    public function shopcartdo(Request $request)
    {

        $cart=new Cart();
        $goods_id=$cart->goods_id=$request->goods_id;
        $buy_number=$cart->buy_number=$request->buy_number;
        $user_id=$cart->user_id=session('id');
        //dd($buy_number);
        //dd($user_id);
        //dd($goods_id);
        $where=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id,
            'is_sel'=>1
        ];
        $data=$cart->where($where)->first();
        //dd($data['buy_number']);
        //dd($data);

        if(!empty($data)){
            $buy_number=$data['buy_number']+1;
            //dd($buy_number);
            $upd=[
                'buy_number'=>$buy_number
            ];
            $res=$cart->where($where)->update($upd);
        }else{
            $res=$cart->save();
            if($res!==false){
                print_r(1) ;
            }else{
                print_r(2) ;
            }
        }



    }

    public function mywallet()
    {

        return view('mywallet');
    }

    public function alipay()
    {

        $config=config('alipayconfig');
        //dd($config);
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = date('Ymdhis').rand(10000,99999);

        //订单名称，必填  $_POST['WIDsubject']
        $subject = '苹果7 plus';

        //付款金额，必填  $_POST['WIDtotal_amount']
        $total_amount = 4998;

        //商品描述，可空  $_POST['WIDbody']
        $body = '大陆版';

        //超时时间
        $timeout_express="1m";

        $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setTimeExpress($timeout_express);

        $payResponse = new AlipayTradeService($config);
        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        return ;
    }

    public function alipaydo(Request $request)
    {
        //dd($request);
        $goods=new Goods();
        $arr=$goods->orderBy('goods_val','asc')->limit(4)->get();
        return view('paysuccess',['arr'=>$arr]);
    }

    public function share()
    {

        return view('share');
    }

    public function buyrecord()
    {
        $goods=new Goods();
        $arr=$goods->orderBy('goods_val','asc')->limit(4)->get();
        return view('buyrecord',['arr'=>$arr]);
    }

    public function userpage(Request $request)
    {

        $id=session('user_id');
        //dd($id);
        if(!empty($id)){
            $user=new user();
            $data=$user->where(['user_id'=>$id])->get();
            //dd($data);
            return view('userpage',['data'=>$data]);
        }else{
            $data=1;
        }
        return view('userpage',['data'=>$data]);

    }

    public function shopcontent(Request $request,$id)
    {
        $signPackage=$request->signPackage;
        //dd($id);
        //print_r($id);die;
        $goods=new Goods();
        $where=[
            'goods_id'=>$id
        ];
        $data=$goods->where($where)->get();
        //print_r($data);die;
        return view('shopcontent',['data'=>$data,'signPackage'=>$signPackage]);

    }

}
