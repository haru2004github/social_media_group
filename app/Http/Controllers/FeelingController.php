<?php

namespace App\Http\Controllers;

use App\Models\Feeling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeelingController extends Controller
{
    //listPage
    public function listPage(){

        $categories = Feeling::when(request('key'), function ($query) {
            $query->where('feeling_category', 'like', '%' . request('key') . '%');
        })
        ->orderBy('id','desc')->get();

        return view('feeling_category.list',compact('categories'));
    }

    //create category
    public function createCategory (Request $request){
        $this->categoryValidationCheck($request);

        $category = [
            'feeling_category' => $request->category
        ];

        Feeling::create($category);
        return back()->with(['createSuccess' => 'Category Created Successfully!']);
    }

    //delete category
    public function deleteCategory($id){
        // delete target category
        Feeling::where('id' ,$id)->delete();
        return back();
    }

    //edit category
    public function editCategory(Request $request,$id){
        $this->categoryValidationCheck($request);
        $category = [
            'feeling_category' => $request->category
        ];

        Feeling::where('id',$id)->update($category);

        return back()->with(["Updated Successfully!"]);
    }



    // category Validation Check
    private function categoryValidationCheck($request){
        Validator::make($request->all(), [
            'category' => "required|min:3|unique:feelings,feeling_category,".$request->id
        ])->validate();
    }
}
