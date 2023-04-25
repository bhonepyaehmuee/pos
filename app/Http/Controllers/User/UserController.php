<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //home page
    public function home(){
        $pizza =Product::orderBy('created_at','desc')->get();
        $category= Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history= Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('pizza','category','cart','history'));
    }


    // change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    // change password
    public function changePassword(Request $req){
        $this->passwordValidationCheck($req);
        $currentUserId= Auth::user()->id;
        $user=User::select('password')->where('id',$currentUserId)->first();

        // hash value
        $hashValue=$user->password;
        //oldPassword is the name of the input password box of the old Password

        if(Hash::check($req->oldPassword, $hashValue)){
            $updatePwd=[
                'password'=>hash::make($req->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($updatePwd);
           ;
            return back()->with(['changeSuccess'=>'Password change successfully']);
        }
        return back()->with(['notMatch'=>'The credentials does not match!! ']);

    }

    private function passwordValidationCheck($req){
        Validator::make($req->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword',

        ],[
            // write the custom message

        ])->validate();
    }


    // account change page
    public function accountChangePage(){

        return view('user.profile.account');
    }
    // ////////////////////////////////////////////////////
    // accountChange
    public function accountChange($id,Request $req){
        $this->accountValidationCheck($req);
        $data=$this->getUserData($req);

        // For image
        if($req->hasFile('image')){
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image; //oldimage


            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName=uniqid().$req->file('image')->getClientOriginalName();
               $req->file('image')->storeAs('public/',$fileName);
               $data['image']=$fileName;
        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>"Profile Changes Successfully"]);
    }

     private function getUserData($req){
        return [
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'gender'=>$req->gender,
            'address'=>$req->address,
            'updated_at'=>Carbon::now(),
        ];
    }

   private function accountValidationCheck($req)
    {
        Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'image'=>'mimes:png,jpg,jpeg,webp|file',

        ],[

        ])->validate();
    }
// --------------------------------------------------------

  // to filter tha categories
    public function filter($categoryid){
        $pizza = Product::where('category_id',$categoryid)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history= Order::where('user_id',Auth::user()->id)->get();
        // dd(count($category));
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    // -------------------------------------------

    // Pizza Details
    public function pizzaDetails($pizzaId){
       $details= Product::where('id',$pizzaId)->first();
       $pizzaList= Product::get();
      return view('user.main.details',compact('details','pizzaList'));
    }

    // ----------------------------------------

    // cart list
    public function cartList(){
        $cartList=Cart::select('carts.*','products.image as image','products.name as pizza_name','products.price as pizza_price')
                    ->leftjoin('products','carts.product_id','products.id')
                    ->where('carts.user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());
        // Error why
        // $productimg= Cart::select('products.image as pimg')
        //             ->leftjoin('products','carts.product_id','products.id')
        //             ->where('carts.user_id',Auth::user()->id)
        //             ->get();
        // dd($productimg->toArray());
        $totalPrice=0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;

        }
        // dd($totalPrice);

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    // --------------------------------------------------------------
    // history
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(4);

        return view('user.main.history',compact('order'));
    }

      //direct userlist from the admin dashboard
    public function userList(){
        $users =User::where('role','user')->paginate(2);
        return view('admin.user.list',compact('users'));
    }

    // change role with ajax (user to admin)
    public function ajaxUserChangeRole(Request $req){

      User::where('id',$req->userId)->update([
        'role'=>$req->changeRole,
       ]);

    }

    // contact form
    public function contactUsForm(){
        return view('user.contact.contact');
    }

    public function sendContact(Request $req)
    {
        $this->contactValidation($req);
        $data=$this->requestContactData($req);
        Contact::create($data);
        return redirect()->route('user#home')->with(['sendSuccess'=>'Your message send successfully!!']);
    }

    private function contactValidation($req){
        Validator::make($req->all(),[
            'contactName'=>'required|min:3',
            'contactEmail'=>'required',
            'contactMessage'=>'required|min:5'
        ])->validate();
    }

    private function requestContactData($req){
        return[
            'name'=>$req->contactName,
            'email'=>$req->contactEmail,
            'message'=>$req->contactMessage,
        ];
    }
    // end of contact form of the User Site

    // ---------------------------------------------- The following codes are to control the user info from the admin dashboard
    // user acc delete
    public function UserDelete($id){
     User::where('id',$id)->delete();
        return redirect()->route('admin#userList');
    }

     // user acc edit
    public function UserEditPage($id){
        $useracc =User::where('role','user')->where('id',$id)->get();

        return view('admin.user.edit',compact('useracc'));
    }

    // user acc update
    public function UserUpdate($id,Request $req){

            // dd($req->toArray());
          $this->accountValidationCheck($req);
        $data=$this->getUserData($req);
         // For image
        if($req->hasFile('image')){
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image; //oldimage


            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName=uniqid().$req->file('image')->getClientOriginalName();
               $req->file('image')->storeAs('public/',$fileName);
               $data['image']=$fileName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#userList');
    }


}
