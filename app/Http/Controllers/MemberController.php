<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\SavePost;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //memberListPage
    public function memberListPage(){
        $members = User::when(request('key'), function ($query) { // if user find member's name or address
                        $query->orWhere('name', 'like', '%' . request('key') . '%')
                            ->orWhere('address', 'like', '%' . request('key') . '%');
                    })
                    ->where('role' ,'member')->orderBy('id','desc')->get();
        return view('member.list',compact('members'));
    }

    //delete account
    public function deleteAccount($id){

        // Account delete
        User::where('id',$id)->delete();

        // all of data related this user

        // delete posts related this user
        Post::where('user_id',$id)->delete();

        //delete save posts related this user
        SavePost::where('post_owner_id',$id)->delete();

        return back();
    }

    //profile page
    public function accountProfilePage($id){
        $member = User::where('id',$id)->first();
        return view('member.profile',compact('member'));
    }

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
