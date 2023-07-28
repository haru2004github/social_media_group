<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\View;
use App\Models\Comment;
use App\Models\Reaction;
use App\Models\SavePost;
use App\Models\Group_chat;
use App\Models\Direct_chat;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //adminListPage
    public function adminListPage(){

        // Get data where role is admin

        $admins = User::when(request('key'), function ($query) { //if user find admin with name or address
                    $query->orWhere('name', 'like', '%' . request('key') . '%')
                        ->orWhere('address', 'like', '%' . request('key') . '%');
                })
                ->whereRole('admin')->orderBy('id','desc')->get();


        return view('admin.list',compact('admins'));
    }

    //admin account delete
    public function deleteAccount($id){

        // delete account
        User::where('id',$id)->delete();

        // all of data related this user

        // delete posts related this user
        Post::where('user_id',$id)->delete();
        Reaction::where('user_id',$id)->delete();
        View::where('user_id',$id)->delete();
        Comment::where('user_id',$id)->delete();
        Group_chat::where('user_id',$id)->delete();
        Direct_chat::where('user_id',$id)->delete();


        //delete save posts related this user
        SavePost::where('post_owner_id',$id)->delete();
        return back();
    }


    //role change
     //role change
     public function roleChange(Request $request){

        // change role member to admin
        User::whereId($request->userId)->update([
            'role' =>$request->roleChange
        ]);
        $response = [
            'status'  => 'success',
        ];
        return response()->json($response , 200);
    }
}
