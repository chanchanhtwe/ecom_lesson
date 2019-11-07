<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function getOrder(Request $request){
        $myDate=$request['filter_by_date'];
        $myMonth=$request['filter_by_month'];

        if($myDate){
            $today=date("Y-m-d",strtotime($myDate));
        }elseif($myMonth){
            $today=$request['filter_by_month'];
        }
        else{
            $today=date("Y-m-d");
        }

        $orders=Order::where('created_at',"LIKE","%$today%")
            ->OrderBy('id','desc')->get();
        return view('post.orders')->with(['orders'=>$orders]);
    }

    public function getOrderFinish($id){
        $order=Order::whereId($id)->firstOrFail();
        $order->status=1;
        $order->save();
        return redirect()->back();
    }
}
