<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\user\AjaxController;

class AjaxController extends Controller
{
    //pizzaList
    public function pizzaList(Request $req){
        // logger($req->status);

        if($req->status == 'desc'){
              $data=Product::orderBy('created_at','desc')
                        ->get();
        }else {
              $data=Product::orderBy('created_at','asc')
                        ->get();
        }

        return response()->json($data, 200);
    }
    // -----------------------------------------
    // return pizza list (addtoCart)
    public function addToCart(Request $req){
        // logger($req->all());
        $data=$this->getOrderData($req);
        // logger($data);
        Cart::create($data);
        $msg  =[
            'status'=>'success',
            'message'=>'Add To Cart Complete'
        ];
        return response()->json($msg, 200 );

    }


    private function getOrderdata($req){
        return[
            'user_id'=>$req->userId,
            'product_id'=>$req->pizzaId,
            'qty'=>$req->count,
            'created_at'=>Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
    }
    // ------------------------------------------
    // for order
        public function order(Request $req){
            // logger($req->all());
            $total=0;
            foreach($req->all() as $item){
                // This  create method will create and use this property $data to retrieve the data also.
                $data= OrderList::create(
                    [
                // first user_id is the column name(order_lists table)
                // later user_id is the data from the client(from cart.blade.php)
                        'user_id'=>$item['user_id'],
                        'product_id'=>$item['product_id'],
                        'qty'=>$item['qty'],
                        'total'=>$item['total'],
                        'order_code'=>$item['order_code'],
                    ]);
                    $total += $data->total;
                    // logger($data->order_code);

            }
            // logger($total);
            Cart::where('user_id',Auth::user()->id)->delete();
        //  logger($total+2000);
            Order::create([
                'user_id'=>Auth::user()->id,
                'order_code'=> $data->order_code,
                'total_price'=>$total +2000,
            ]);

            return response()->json([
                'status'=>'true',
                'message'=>'order complete!!'
            ],200);

        }
// ---------------------------------------------------

            // clearcart for database
            public function clearCart(Request $req){
                Cart::where('user_id',Auth::user()->id)->delete();
            }

            // remove the data from the database when click remove icon
            public function clearCurrentProduct(Request $req){
                Cart::where('user_id',Auth::user()->id)
                        ->where('product_id',$req->productId)
                        ->where('id',$req->orderId)
                        ->delete();
            }

            // for viewCount (ajax)

            public function increaseViewCount(Request $req){
               $pizza= Product::where('id',$req->productId)->first();
            //    dd($pizza->toArray());
               $viewCount=
                [
                'view_count'=> $pizza->view_count+1,
                ];
                Product::where('id',$req->productId)->update($viewCount);
            }

}
