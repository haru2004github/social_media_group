<?php

namespace App\Http\Controllers;

use App\Models\SavePost;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\View;
use App\Models\Comment;
use App\Models\Feeling;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    //create post
    public function createPost(Request $request){

        // have description but not have title and description
        if (empty($request->title) && empty($request->image) && !empty($request->description)) {

            return back()->with(['titleMessage' =>'Write a title']);
        }

        // have description but not have title and description
        if (!empty($request->title) && empty($request->image) && empty($request->description)) {
            return back()->with(['descriptionMessage' =>'Write a description!']);
        }

        // have image but not have title and description
        if (empty($request->title) && !empty($request->image) && empty($request->description)) {
            return back()->with(['imageMessage' =>'Write a description!']);
        }

        // have image and and title but does not have description
        if (!empty($request->title) && !empty($request->image) && empty($request->description)) {
            return back()->with(['descriptionMessage' =>'Write a description!']);
        }

        // have image and and description but does not have title
        if (empty($request->title) && !empty($request->image) && !empty($request->description)) {
            return back()->with(['titleMessage' =>'Write a title!']);
        }

        //have all of title,description and photo
        if (!empty($request->description) && !empty($request->image && !empty($request->title))) {

            //validation
            $this->validationForPost($request);
            $this->validationForImage($request);

            // post data is formatted to array
            $post = [
                'user_id'     =>  Auth::user()->id,
                'description' =>  $request->description,
                'title'       =>  $request->title,
                'created_at'  =>  Carbon::now()

            ];

            //set the name of user selected image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            //store this image to storage folder
            $request->file('image')->storeAs('public', $fileName);
            $post['image'] = $fileName;

            if(!empty($request->feeling_id)){
                $post['feeling_id'] = $request->feeling_id;
            }

             // If this account user is admin, all of posts are approved automatically
            //If this account user is member ,all of posts are needed to proved from admin
            if(Auth::user()->role == 'admin'){
                $post['post_approve'] = 'approved';
                $post['status']       = 'seen';

            }

            // Create a post to database
            Post::create($post);
            return back()->with(['createSuccess' => 'Post Created Successfully!']);

        }

        // for title and description
        if (!empty($request->description) && empty($request->image)) {

            $this->validationForPost($request);

            // get user data to format array
            $post = [
                'user_id' =>Auth::user()->id,
                'title' => $request->title,
                'created_at' => Carbon::now()
            ];

            if(!empty($request->description)){
                $post['description'] = $request->description;
            }

            if(!empty($request->feeling_id)){
                $post['feeling_id'] = $request->feeling_id;
            }

             // If this account user is admin, all of posts are approved automatically
            //If this account user is member ,all of posts are needed to proved from admin
            if(Auth::user()->role == 'admin'){
                $post['post_approve'] = 'approved';
                $post['status'] = 'seen';

            }

            Post::create($post);
            return back()->with(['createSuccess' => 'Post Created Successfully!']);

        }

        // for only image
        if (empty($request->description) && !empty($request->image)) {

            $this->validationForImage($request);

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $post = [
                'user_id' =>Auth::user()->id,
                'image' => $fileName,
                'created_at' => Carbon::now()
            ];


            if(!empty($request->feeling_id)){
                $post['feeling_id'] = $request->feeling_id;
            }

             // If this account user is admin, all of posts are approved automatically
            //If this account user is member ,all of posts are needed to proved from admin
            if(Auth::user()->role == 'admin'){
                $post['post_approve'] = 'approved';
                $post['status'] = 'seen';

            }

            Post::create($post);
            return back()->with(['createSuccess' => 'Post Created Successfully!']);

        }

    }

    //post detail page
    public function postDetail($id){

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

        //validate save or not this post
        $existingSavePost = SavePost::where('user_id',Auth::user()->id)->where('post_id',$id)->first();

        if($existingSavePost){
            $status = true;
        }else{
            $status = false;
        }

        $reactors = Reaction::select('reactions.*','users.name as user_name','users.id as user_id')
        ->where('users.id','<>',Auth::user()->id)
        ->latest()
        ->leftJoin('users','reactions.user_id','users.id')
        ->orderBy('reactions.created_at','desc')
        ->get()
        ->groupBy('post_id');

        $reactions = Reaction::get();

        return view('post.deail',compact('post','comments','reaction','status','reactors','reactions'));
    }

    //post delete
    public function deletePost($id){
        if(Post::where('id',$id)->first()->image !== null){
            $dbImage = Post::where('id',$id)->first()->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
        }
        Post::where('id',$id)->delete();
        Reaction::where('post_id',$id)->delete();
        Comment::where('post_id',$id)->delete();
        View::where('post_id',$id)->delete();
        return redirect()->route('home');
    }


    //edit post page
    public function editPostPage($id,Request $request){
        $post = Post::where('id',$id)->first();

        // format data to array
        $owner = [
            'userName'    => $request->userName,
            'userGender'  => $request->userGender,
            'userAddress' => $request->userAddress,
            'userImage'   => $request->userImage,
        ];


        $feelings = Feeling::get();
        return view('home.editPost',compact('post','owner','feelings'));
    }

    //update post
    public function updatePost(Request $request,$id){

        // have description but not have title and description
        if (empty($request->title) && empty($request->image) && !empty($request->description)) {
            return back()->with(['titleMessage' =>'Write a title']);
        }

        // have description but not have title and description
        if (!empty($request->title) && empty($request->image) && empty($request->description)) {
            return back()->with(['descriptionMessage' =>'Write a description!']);
        }

        // have image but not have title and description
        if (empty($request->title) && !empty($request->image) && empty($request->description)) {
            return back()->with(['imageMessage' =>'Write a description!']);
        }

        // have image and and title but does not have description
        if (!empty($request->title) && !empty($request->image) && empty($request->description)) {
            return back()->with(['descriptionMessage' =>'Write a description!']);
        }

        // have image and and description but does not have title
        if (empty($request->title) && !empty($request->image) && !empty($request->description)) {
            return back()->with(['titleMessage' =>'Write a title!']);
        }

        //doesn't have all of title,description and photo
        if (empty($request->title) && empty($request->image) && empty($request->description)) {
            return back()->with(['allMessage' =>'Write a title and description or  select a photo!']);
        }

        //have all of title,description and photo
        if (!empty($request->title) && !empty($request->title) && !empty($request->image)) {

            //validation
            $this->validationForPost($request);
            $this->validationForImage($request);

            $post = [
                'description' => $request->description,
                'title' => $request->title,
            ];

            $dbImage = Post::where('id',$id)->first()->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }


            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $post['image'] = $fileName;

            if(!empty($request->description)){
                $post['description'] = $request->description;
            }

            if(!empty($request->feeling_id)){
                $post['feeling_id'] = $request->feeling_id;
            }

            Post::where('id',$id)->update($post);
            return redirect()->route('home')->with(['updateSuccess' => 'Post Updated Successfully!']);

        }

        // for title and description
        if (!empty($request->title) && !empty($request->description) && empty($request->image)) {

            $this->validationForPost($request);

            $post = [
                'title' => $request->title,
            ];


            if(!empty($request->description)){
                $post['description'] = $request->description;
            }

            if(!empty($request->feeling_id)){
                $post['feeling_id'] = $request->feeling_id;
            }


            Post::where('id',$id)->update($post);

            return redirect()->route('home')->with(['createSuccess' => 'Post Created Successfully!']);

        }


        // for only image
        if (!empty($request->title) && empty($request->description) && !empty($request->image)) {

            $this->validationForImage($request);

            $dbImage = Post::where('id',$id)->first()->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $post = [
                'image' => $fileName,
            ];


            if(!empty($request->feeling_id)){
                $post['feeling_id'] = $request->feeling_id;
            }

            Post::where('id',$id)->update($post);


            return redirect()->route('home')->with(['createSuccess' => 'Post Created Successfully!']);

        }

    }


    //post view count
    public function postViewCount(Request $request){

        $view = View::where('user_id' ,Auth::user()->id)
        ->where('post_id',$request->postId)
        ->first();

        if (!$view) {
            View::create([
                'user_id' => Auth::user()->id,
                'post_id' => $request->postId,
            ]);
            Post::where('id',$request->postId)->first()->increment('view_count',1);
            $response = [
                'status'  => true,
            ];
            return response()->json($response , 200);
        }
    }


    //validator for image
    private function validationForImage($request){
        Validator::make($request->all(),[
            'image' => 'mimes:png,jpg,jpeg|file'
        ])->validate();
    }

    //validation for description
    private function validationForPost($request){
        Validator::make($request->all(),[
            'title'       => 'min:3',
            'description' => 'min:10'

        ])->validate();
    }





}
