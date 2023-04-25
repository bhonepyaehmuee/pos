<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //product list
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')

                    ->when(request('key'),function ($query)
        {

            $query->where('products.name','like','%'.request('key').'%');
        })
            ->leftjoin('categories','products.category_id','categories.id')
            ->orderBy('products.created_at','desc')
            ->paginate(5);
            // dd($pizzas->toArray());
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    // direct pizza create Page
    public function createPage(){
        $categories =Category::select('id','name')->get();

        return view('admin.product.create',compact('categories'));
    }

    // create the data using ur enter
    // create Product
    public function create(Request $req){
    //    dd($req->all());
        $this->productValidationCheck($req,"create");
        $data=$this->requestProductInfo($req);

            $fileName=uniqid().$req->file('pizzaImage')->getClientOriginalName();
            $req->file('pizzaImage')->storeAs('public',$fileName);
            $data['image']=$fileName;

        Product::create($data);
        return redirect()->route('product#list');

    }
    // request product info
     // create and update function call this requestProductInfo function
    private function requestProductInfo($req){
        return[
            'category_id'=>$req->pizzaCategory,
            'name'=>$req->pizzaName,
            'description'=>$req->pizzaDescription,
            'price'=>$req->pizzaPrice,
            'waiting_time'=>$req->pizzaWaitingTime,

        ];
    }

    // product validate function here
    // create and update function call this validationCheck function
    private function productValidationCheck($req,$action){
        $validationRules=[
        'pizzaName'=>'required|min:5|unique:products,name,'.$req->pizzaId,
        'pizzaCategory'=>'required',
        'pizzaDescription'=>'required|min:10',
        'pizzaPrice'=>'required',
        'pizzaWaitingTime'=>'required',
        ];
        // for update using ternary operator
        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:png,jpg,jpeg,webp|file' : "mimes:png,jpg,jpeg,webp|file";

       Validator::make($req->all(),$validationRules)->validate();
    }

    // delete the product list
    public function delete($id){
        // dd($id);
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product delete successfully!!!']);
    }

    // Edit the product list
    public function edit($id){
        $pizza= Product::select('products.*','categories.name as category_name')
        ->leftjoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)
        ->first();
        return view('admin.product.edit',compact('pizza'));
    }
    // show the data to show update
    public function updatePage($id){
        $pizza= Product::where('id',$id)->first();
        $category=Category::get();
        // dd($category->toArray());
        return view('admin.product.update',compact('pizza','category'));
    }
    // update the pizza info data
    public function update(Request $req){
        $this->productValidationCheck($req,"update");
        $data=$this->requestProductInfo($req);
       if($req->hasFile('pizzaImage')){
        $oldImageName= Product::where('id',$req->pizzaId)->first();
        $oldImageName=$oldImageName->image;

        if($oldImageName != null){
            Storage::delete('public/'.$oldImageName);
        }
        $fileName=uniqid().$req->file('pizzaImage')->getClientOriginalName();
        $req->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']=$fileName;
       }
       Product::where('id',$req->pizzaId)->update($data);
    //    return redirect()->route('product#list');
    return back();
    }

}
