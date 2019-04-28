<?php

namespace App\Http\Controllers;

use App\Model\Ticket;
use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    //
    public function qrcode(){
        include public_path()."/phpqrcode.php";
        $userid = md5(time());
        //dd($userid);
        $value = "http://gt.zty77.com/codelogin/".$userid;
        unlink(public_path()."/qrcode.png");
        \QRcode::png($value,'qrcode.png');
        return view('user.wxcode');
    }

    public function getstatus(Request $request)
    {
        $userid = $request->userid;
        $ticket = new Ticket();
        $status = $ticket->where('userid',$userid)->select('status');
        dd($status);
    }


}
