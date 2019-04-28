<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    //
    public function qrcode(){
        include public_path()."/phpqrcode.php";
        $userid = md5(time());
        //dd($userid);
        $value = "http://gt.zty77.com/codelogin/".$userid;
        \QRcode::png($value,'qrcode.png');
        return view('user.wxcode');
    }


}
