<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct orderlist
    public function orderList(){
        $order= Order::select('orders.*','users.name as user_name')
            ->leftJoin('users','users.id','orders.user_id')
            ->orderBy('created_at','desc')
            ->get();
        // dd($order->toArray());
        return view('admin.order.list',compact('order'));
    }
    // drop-down list search
    public function changeStatus(Request $req){
      $order= Order::select('orders.*','users.name as user_name')
            ->leftJoin('users','users.id','orders.user_id')
            ->orderBy('created_at','desc');

        if($req->orderStatus == null){
            $order= $order->get();
        }
        else{
            $order = $order->where('orders.status',$req->orderStatus)->get();
        }
        // dd($order->toArray());
           return view('admin.order.list',compact('order'));
    }

    // status change
    public function ajaxChangeStatus(Request $req){
        // logger($req->all());
        Order::where('id',$req->orderId)->update([
            'status'=>$req->status
        ]);
        $order= Order::select('orders.*','users.name as user_name')
            ->leftJoin('users','users.id','orders.user_id')
            ->orderBy('created_at','desc')
            ->get();

        return response()->json($order,200);
    }

    // if click ordercode to show data
    public function listInfo($ordercode){
        $price= Order::where('order_code',$ordercode)->first();

        $orderList=OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
                         ->leftjoin('users','users.id','order_lists.user_id')
                         ->leftjoin('products','products.id','order_lists.product_id')

                        ->where('order_code',$ordercode)->get();
        // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList','price'));
    }

}
