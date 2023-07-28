<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    //list page
    public function listPage(){

        $notifications = Post::select('posts.*','users.name as user_name','users.image as user_image','users.gender as user_gender','users.id as user_id','users.address as user_address','feelings.feeling_category as feeling_category',)
        ->leftJoin('users','posts.user_id','users.id')
        ->leftJoin('feelings' ,'posts.feeling_id' ,'feelings.id')
        ->where('post_approve','not_approved')
        ->orderBy('id','desc')
        ->get();

        Post::whereStatus('unseen')->update([
            'status' => 'seen'
        ]);
        return view('notification.post_list', compact('notifications'));
    }

    //changePostApprove
    public function changePostApprove(Request $request){

        //If admin is change to post approved ,this post can be seen
        if($request->postApprove == 'approved'){
            Post::where('id' ,$request->postId)->update([
                'post_approve' => $request->postApprove,
                'created_at' => Carbon::now()
            ]);
        }

        //If admin is change to reject,this post is deleted in the database
        if($request->postApprove == 'reject'){
            Post::where('id' ,$request->postId)->delete();
        }

        return redirect()->route('notification#listPage
        ');
    }

    //post detail
    public function postDetail(Request $request,$id){

        // get post from database
        $post = Post::where('id',$id)->first();

        //post data is formatted to array
        $owner = [
            'userName' => $request->userName,
            'userAddress' => $request->userAddress,
            'userImage' => $request->userImage,
            'userGender' => $request->userGender,
            'feelingCategory' => $request->feelingCategory,
            'activityCategory' => $request->activityCategory,
        ];
        return view('notification.post_detail' , compact('post','owner'));
    }
}
