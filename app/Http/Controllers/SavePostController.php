<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SavePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavePostController extends Controller
{

    //save post list page
    public function listPage(){
        $posts = SavePost::select('save_posts.*','users.name as post_owner_name','posts.title as post_title','posts.image as post_image','users.image as post_owner_image','users.gender as post_owner_gender')
        ->leftJoin('users','save_posts.post_owner_id','users.id')
        ->leftJoin('posts','save_posts.post_id','posts.id')
        ->when(request('key'), function ($query) {
            $query->orWhere('posts.title', 'like', '%' . request('key') . '%');

        })
        ->where('save_posts.user_id',Auth::user()->id)->orderBy('save_posts.id','desc')->get();

        return view('post.save_posts',compact('posts'));
    }


    //add save post
    public function addSavePost(Request $request){

        // Validate  this post is saved or not
        $existingSavePost = SavePost::where('user_id',Auth::user()->id)->where('post_id',$request->postId)->first();


        // if this post is not saved
        if(!$existingSavePost){

            $data = [
                'post_owner_id' => $request->postOwnerId,
                'post_id' => $request->postId,
                'user_id' => Auth::user()->id,
            ];

            SavePost::create($data);

            // update saver_ids of post
            $saverId = Post::where('id',$request->postId)->first()->saver_id;
            $saverId = $saverId.','.Auth::user()->id;

            Post::where('id',$request->postId)->update([
                'saver_id' => $saverId
            ]);

            $response = [
                'status' => 'saved'
            ];

        }


        return response()->json($response , 200);

    }

    //remove save post
    public function removeSavePost(Request $request){

        $saverId = Post::where('id',$request->postId)->first()->saver_id;

        // Find this post id in saver ids of post
        $saverId = explode(',', $saverId);   //separate string with ,  to get array

        // search this account user id in reactor ids of post
        $index = array_search(Auth::user()->id, $saverId);
        if ($index !== false) {
            unset($saverId[$index]);  //remove this user id from reactors of post
        }

        // change array to string combine with ","
        $saverId = implode(',',$saverId);

        // update savers ids of post
        Post::where('id',$request->postId)->update([
            'saver_id' => $saverId
        ]);

        // delete saved post
        SavePost::where('user_id' ,Auth::user()->id)
        ->where('post_id' ,$request->postId)
        ->where('post_owner_id',$request->postOwnerId)
        ->delete();

        return back();
    }
}
