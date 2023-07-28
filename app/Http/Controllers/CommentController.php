<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //createComment
    public function createComment(Request $request){

        // user is clicked sentButton without existing any data
        if(empty($request->comment) && empty($request->image)){
            return back()->with(['commentMessage' => "Please enter a comment or a image!"]);
        }

        // comment data is formatted to array.
        $comment = [
            'user_id'    => Auth::user()->id,
            'post_id'    => $request->post_id,
            'created_at' => Carbon::now()
        ];

        //comment content
        if(!empty($request->comment)){
            $comment['comment'] = $request->comment;
        }

        // comment Image
        if($request->hasFile('image')){

            $this->validationForImage($request);
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $comment['image'] = $fileName;
        }

        $post = Post::where('id',$request->post_id)->first()->increment('comment_count',1);
        Comment::create($comment);

        return back();
    }

    //comment list
    public function commentList($id){

        $post = Post::select('posts.*','users.name as user_name' , 'users.address as user_address','feelings.feeling_category as feeling_category','users.image as user_image','users.gender as user_gender')
        ->leftJoin('users' ,'posts.user_id' ,'users.id')
        ->leftJoin('feelings' ,'posts.feeling_id' ,'feelings.id')
        ->where('posts.id',$id)->first();

        $comments = Comment::select('comments.*','users.name as user_name' , 'users.address as user_address','users.image as user_image','users.gender as user_gender')
        ->leftJoin('users' ,'comments.user_id' ,'users.id')
        ->where('comments.post_id',$id)
        ->get();

        $reaction = Reaction::where('post_id' ,$id)
        ->where('user_id',Auth::user()->id)->first();

        return view('comment.list',compact('post','comments','reaction'));

    }



    //validation for image
    private function validationForImage($request){
        Validator::make($request->all(),[
            'image' => 'mimes:png,jpg,jpeg|file'
        ])->validate();
    }
}
