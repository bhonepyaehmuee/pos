<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories= Category::when(request('key'),function($query){
                                 $query->where('name','like','%' .request('key').'%');
                                    })
                                ->orderBy('id','desc')
                                ->paginate(5);
                                // you can write this way instead of writing in UI
                                    // $categories->appends($req->all())
        // dd($categories);
        return view('admin/category/list',compact('categories'));
    }

    //  direct CreatePage
    public function createPage(){
        return view('admin/category/create');
    }

    // create category
    public function create(Request $req){
            // dd($req->all());
            $this->categoryValidationCheck($req);
            $data =$this->requestCategoryData($req);
            Category::create($data);
            return redirect()->route('category#list')->with(['createSuccess'=>'Created Successsfully...']);
    }

    // delete category

    public function delete($id){
       Category::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>'Delete Successfully']);
    }


    // edit page
    public function edit($id){
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update page
    public function update(Request $req)
    {
        // dd($req->all());
        $this->categoryValidationCheck($req);
        $data =$this->requestCategoryData($req);
        Category::where('id',$req->categoryId)->update($data);
        return redirect()->route('category#list');
    }


    // Category validation check
    private function categoryValidationCheck($req){
        Validator::make($req->all(),[
            // validate the function                                    // categoryId is the name of the hidden input box in edit page
            'categoryName'=>'required|min:3|unique:categories,name,'.$req->categoryId,
        ],[
            // validation messsage
            'categoryName.required'=>'You need to fill this field',
        ])->validate();
    }


    // request category data (change to the array type)
    private function requestCategoryData($req){
        return [
            'name'=>$req->categoryName,
        ];
    }
}
