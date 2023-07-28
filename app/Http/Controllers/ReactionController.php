<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    //create reaction
    public function createReaction(Request $request){

        // validate this post is reacted or not
        $existingReaction = Reaction::where('user_id' ,$request->userId)
        ->where('post_id',$request->postId)
        ->first();

        //reaction is existing,we need to update our reaction type of this post
        if ($existingReaction) {
            $react =[
                'reaction_type' => $request->reactType,
                'user_id' => $request->userId,
                'post_id' => $request->postId,
            ];
            $existingReaction->update($react);
            $response = [
                'react_type' => $request->reactType,
                'status'     => 'success',
                'scrollTo'   => $request->postId
            ];

            return response()->json($response , 200);
        } else {                         // If this post if not reacted, we need to create a reaction
            $react =[
                'reaction_type' => $request->reactType,
                'user_id'       => $request->userId,
                'post_id'       => $request->postId,
            ];

            Post::where('id',$request->postId)->first()->increment('reaction_count',1);

            Reaction::create($react);

            //reactor id is updated in this post field 
            $reactorId = Post::where('id',$request->postId)->first()->reactor_id;
            $reactorId = $reactorId.','.Auth::user()->id;

            Post::where('id',$request->postId)->update([
                'reactor_id' => $reactorId
            ]);

            $response = [
                'react_type' => $request->reactType,
                'status'     => 'success',
                'scrollTo'   => $request->postId
            ];

            return response()->json($response , 200);
        }


    }

    //cancel reaction
    public function cancelReaction(Request $request){
        Reaction::where('post_id',$request->postId)
        ->where('user_id',$request->userId)->delete();

        Post::where('id',$request->postId)->first()->decrement('reaction_count',1);

        $response = [
            'react_type' => 'like',
            'status'     => 'success',
            'scrollTo'   => $request->postId
        ];

        $reactorId = Post::where('id',$request->postId)->first()->reactor_id;

        // Find this account user id in reactor ids of post
        $reactorId = explode(',', $reactorId);   //separate string with ,  to get array 

        // search this account user id in reactor ids of post 
        $index = array_search(Auth::user()->id, $reactorId);
        if ($index !== false) {
            unset($reactorId[$index]);   //remove this user id from reactors of post
        }

        // change array to string combine with ","
        $reactorId = implode(',',$reactorId);

        // update reactors ids of post 
        Post::where('id',$request->postId)->update([
            'reactor_id' => $reactorId
        ]);

        return response()->json($response , 200);
    }


    //react list page
    public function reactorListPage($id){
        $reactors =  Reaction::select('reactions.*','users.name as user_name','users.address as user_address','users.gender as user_gender','users.image as user_image','users.role as user_role','users.id as user_id')
        ->leftJoin('users','reactions.user_id','users.id')
        ->where('post_id',$id)
        ->get();

        return view('reaction.list',compact('reactors'));

    }
}
