<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    //react list page
    public function viewListPage($id){
        $viewers =  View::select('views.*','users.name as user_name','users.address as user_address','users.gender as user_gender','users.image as user_image','users.role as user_role','users.id as user_id')
        ->leftJoin('users','views.user_id','users.id')
        ->where('post_id',$id)
        ->get();

        return view('viewer.list',compact('viewers'));

    }
}
