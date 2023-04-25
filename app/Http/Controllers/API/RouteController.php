<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all the product lists
    public function productList(){
    $products=Product::get();
    $user =User::get();
    $data=[
        'product'=>$products,
        'user'=>$user,
    ];
    return response()->json($data, 200);
    }

    // category list
    public function categoryList(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    // create category
    public function categoryCreate(Request $req){
        $data=[
            'name'=>$req->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
        $response=Category::create($data);
        return response()->json($response, 200);
    }

    // create contact
    public function contactCreate(Request $req){
       $data= $this->getContentData($req);
       Contact::create($data);
       $contact= Contact::orderBy('created_at','desc')->get();
       return response()->json($contact, 200);
    }

    private function getContentData($req){
        return[
            'name'=>$req->name,
            'email'=>$req->email,
            'message'=>$req->description,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }

    // delete category
    public function deleteCategory(Request $req){
        $data= Category::where('id',$req->category_id)->first();

        if(isset($data)){
            Category::where('id',$req->category_id)->delete();
            return response()->json(['status'=>true,'message'=>'succeessfully deleted'], 200);
        }
        return response()->json(['status'=>false,'message'=>'There is no data to delete..'], 200);
    }
    // delete contac with get method
    public function deleteContact($id)
    {
      $data= Contact::where('id',$id)->first();
      if(isset($data)){
        Contact::where('id',$id)->delete();
        return response()->json(['status'=>true,'message'=>'succeessfully contact deleted'], 200);
      }
       return response()->json(['status'=>false,'message'=>'There is no data to delete.. '], 200);
    }

    // detailsCategory
    public function categoryDetails(Request $req){
        $data=Category::where('id',$req->category_id)->first();
        if(!empty($data)){
            return response()->json(['status'=>true,'category_id'=>$data], 200);
        }
        return response()->json(['status'=>false,'message'=>'There is no data to delete.. '], 500);
    }

    // categoty update
    public function categoryUpdate(Request $req){
        $categoryId= $req->category_id;
        $source=Category::where('id',$categoryId)->first();
        if(!empty($source)){
            $data=$this->getCategoryData($req);
            Category::where('id',$categoryId)->update($data);
            $resp=Category::where('id',$categoryId)->first();
            return response()->json(['status'=>true,'updatedCategory'=>$resp,'message'=>'updated successfuly...'], 200);
        }
        return response()->json(['status'=>false,'message'=>'There is categoryid to update.. '], 500);


    }
    private function getCategoryData($req){
        return[
            'name'=>$req->category_name,
            'updated_at'=>Carbon::now(),
        ];
    }
}
