<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Group;
use App\Models\Comment;
use App\Models\Feeling;
use App\Models\Activity;
use App\Models\Reaction;
use App\Models\SavePost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //login page
    public function loginPage(){
        return view('account-auth.login');
    }

    //register page
    public function registerPage(){
        return view('account-auth.register');
    }

    //home page
    public function homePage(){
        // home page is the collection of all of data for show and the beginning of the project

        $group = Group::all();

        $members = User::where('role','member')->take(5)->get();

        $feelings = Feeling::get();

        $posts = Post::select('posts.*' , 'users.name as user_name' , 'users.address as user_address' , 'feelings.feeling_category as feeling_category' , 'users.image as user_image' , 'users.gender as user_gender')
        ->leftJoin('users' , 'posts.user_id' , 'users.id')
        ->leftJoin('feelings' , 'posts.feeling_id' , 'feelings.id')
        ->where('post_approve' , 'approved')
        ->orderBy('created_at' , 'desc')
        ->get();

        $comments = Comment::select('comments.*','users.name as user_name' , 'users.address as user_address','users.image as user_image','users.gender as user_gender')
        ->latest()
        ->leftJoin('users','comments.user_id','users.id')
        ->get()
        ->groupBy('post_id');

        $reactors = Reaction::select('reactions.*','users.name as user_name','users.id as user_id')
        ->where('users.id','<>',Auth::user()->id)
        ->latest()
        ->leftJoin('users','reactions.user_id','users.id')
        ->orderBy('reactions.created_at','desc')
        ->get()
        ->groupBy('post_id');

        // dd($reactors->toArray());

        $savePosts = SavePost::where('user_id' ,Auth::user()->id)
        ->get();

        $reactions = Reaction::get();

        return view('home.index',compact('group','members','feelings','posts','reactions','comments','reactors'));
    }

    //account profile
    public function profilePage(){
        return view('account.profile');
    }

    //changeGroupCoverPhoto  //Only admin can do
    public function changeCoverPhoto(Request $request,$id){

        $data = User::where('id',$id)->first();
        $data = $this->getUserDataForImage($data);


        //validation for cover image
        $this->validationForCoverImage($request);

        // For Image
            //get old image name form database
            $dbImage = User::where('id',$id)->first()->cover_image;

            // find image and delete where image name form storage folder is equal to the image name form database
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            // define a new image name
            $fileName = uniqid() . $request->file('cover_image')->getClientOriginalName();

            // store image data to the storage folder
            $request->file('cover_image')->storeAs('public', $fileName);
            // update a new image to database
            $data['cover_image'] = $fileName;

            //upload cover photo
            User::where('id',$id)->update($data);

            return back();


    }

    //deleteCoverPhoto
    public function deleteCoverPhoto($id){

        //data of user where user_id is equal to id of user from database
        $data = User::where('id',$id)->first();

        // Delete old cover image from storage folder
        Storage::delete('public/'.$data->cover_image);


        $data = [
            'name'         => $data->name,
            'phone'        => $data->phone,
            'address'      =>  $data->address,
            'email'        => $data->email,
            'gender'       => $data->gender,
            'job'          => $data->job,
            'description'  => $data->description,
            'image'        => $data->image,
            'updated_at'   => Carbon::now(),

        ];

        //give null value cause of deleting cover photo
        $data['cover_image'] = null;

        //update user data
        User::where('id',$id)->update($data);

        return back()->with(['message' => 'Delete Success!']);
    }

    //change profile Image
    public function changeProfileImage(Request $request,$id){
        // get user's data from database
        $data = User::where('id',$id)->first();
        // User data is formatted to array
        $data = $this->getUserDataForImage($data);


        //validation for cover image
        $this->validationForProfileImage($request);

        // For Image
            //old image name | delete
            $dbImage = User::where('id',$id)->first()->image;

            // delete photo whether the cover image is already existed
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            //set cover image name from user's selected image and update the image name to the database
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;

            //upload Profile Image
            User::where('id',$id)->update($data);

            return back();


    }

    //deleteProfileImage
    public function deleteProfileImage($id){

        //get data form database
        $data = User::where('id',$id)->first();

        // delete image form the storage folder
        Storage::delete('public/'.$data->image);

        // get all of data except profile image data cause of deleting this image
        $data = [
            'name'         => $data->name,
            'phone'        => $data->phone,
            'address'      =>  $data->address,
            'email'        => $data->email,
            'gender'       => $data->gender,
            'job'          => $data->job,
            'description'  => $data->description,
            'cover_image'  => $data->cover_image,
            'updated_at'   => Carbon::now(),

        ];
        // so, we need to remove image name form database
        $data['image'] = null;

        // finally we update our profile data
        User::where('id',$id)->update($data);

        return back()->with(['message' => 'Delete Success!']);
    }

    //update account
    public function updateAccount($id,Request $request){
        // get data from user and format to array
        $data = $this->getUserData($request);

        //validate user's data
        $this->ValidationCheckUserData($request);

        //update user's data to the database
        User::where('id' ,$id)->update($data);
        return back();
    }


    //passwordPage
    public function passwordPage(){

        // direct to the password change page so we can change new password
        return view('account.password');
    }

    //passwordChange
    public function passwordChange(Request $request){

        // Check validation for password
        $this->validationForPassword($request);

        // if we want to change password
        // first, we get the old password from database

        $dbPassword = User::where('id',Auth::user()->id)->first()->password;

        // and we hash a new password and update this new hash value of new password to database
        if(Hash::check($request->oldPassword,$dbPassword)){

            // update new password for user account
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return back();
        }else{
            return back()->with(['Not Match' => 'The Old Password is not match.Try Again!']);
        }
    }


    //////////////////////////// Private function  ////////////////////////////

      // get user Image
      private function getUserDataForImage ($data){
        return [
            'name'         => $data->name,
            'phone'        => $data->phone,
            'address'      =>  $data->address,
            'email'        => $data->email,
            'gender'       => $data->gender,
            'job'          => $data->job,
            'description'  => $data->description,
            'image'        => $data->image,
            'cover_image'  => $data->cover_image,
            'updated_at'   => Carbon::now(),

        ];
    }

     // get user Data
     private function getUserData($request){
        return [
            'name'         => $request->name,
            'phone'        => $request->phone,
            'address'      =>  $request->address,
            'email'        => $request->email,
            'gender'       => $request->gender,
            'job'          => $request->job,
            'description'  => $request->description,
            'updated_at'   => Carbon::now(),

        ];
    }

    //ValidationCheckUserData
    private function ValidationCheckUserData($request){
        Validator::make($request->all(),[
            'name'  => 'required',
            'phone'  => 'required',
            'address'  => 'required',
            'email'  => 'required',
            'gender'  => 'required',
            'job'  => 'required',
        ])->validate();
    }

    //validation for password
    private function validationForPassword($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:8|max:15',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|min:8|max:15|same:newPassword',
        ])->validate();
    }

    //Validation for cover image
    private function validationForCoverImage($request){
        Validator::make($request->all(),[
            'cover_image' => 'required|mimes:png,jpg,jpeg|file'
        ])->validate();
    }

    //validation for profile image
    private function validationForProfileImage($request){
        Validator::make($request->all(),[
            'image' => 'required|mimes:png,jpg,jpeg|file'
        ])->validate();
    }

}
