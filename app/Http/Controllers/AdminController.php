<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //direct login page

    public function loginPage(){
        return view('login');
    }

    public function registerPage(){
        return view('register');
    }

// direct dashboard
public function dashboard(){

    if(Auth::user()->role =='admin'){
        return redirect()->route('category#list');
    }
    else{
        return redirect()->route('user#home');
    }
}

// change password page
// when u click this link you gonna reach this directionary admin/password/change

    public function changePasswordPage(){
        return view('admin.account.changePassword');
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
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
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

// //////////////////////////////////////////////////

    // Details admin  Page
    public function details(){
        return view('admin.account.details');
    }

    // Edit the details page (admin)
    public function edit(){
        return view('admin.account.edit');
    }


    // Update(admin profile's data)
    public function update($id,Request $req)
    {
        // dd($id,$req->toArray());
        // validation method call here
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
        return redirect()->route('admin#details')->with(['updateSuccess'=>"Profile Change Successfully"]);
    }

     // update admin's data
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
    // admin'data validation method

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

    // ////////////////////////////////
    // admin list
    public function list(){
        $admin= User::when(request('key'),function($query){
                $query  ->orWhere('name','like','%'.request('key').'%')
                        ->orWhere('email','like','%'.request('key').'%')
                        ->orWhere('gender','like',request('key'))
                        ->orWhere('phone','like','%'.request('key').'%')
                        ->orWhere('address','like','%'.request('key').'%');
        })
                    ->where('role','admin')->paginate(3);
                    $admin->appends(request()->all());
        // dd($admins->toArray());
        return view('admin.account.list',compact('admin'));
    }

    // Admin list delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>"Admin Account Delete Successfully"]);
    }
    // show change role
    public function changeRole($id){
        $account= User::where('id',$id)->first();
        // dd($account->toArray());
        return view('admin.account.changeRole',compact('account'));
    }

    // change role with ajax
    public function ajaxChangeRole(Request $req){

      User::where('id',$req->userId)->update([
        'role'=>$req->changeRole,
       ]);

    }


    // update the ROle
    public function change($id,Request $req){
         $data=$this->requestUserData($req);
         User::where('id',$id)->update($data);
         return redirect()->route('admin#list')->with(['roleChange'=>"Role Change Successfully!!!"]);
    }

    // change role function
    private function requestUserData($req){
        return[
            'role'=>$req->role
        ];
    }

    // show contact list to the admin dashboard
    public function contactList(){
        $contact= Contact::get();
        return view('admin.contact.contactList',compact('contact'));
    }
    // contact Details
    public function contactDetails($id){
        $detail= Contact::where('id',$id)->get();
        return view('admin.contact.contactDetail',compact('detail'));
    }

}
