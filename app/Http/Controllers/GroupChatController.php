<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Group;
use App\Models\Group_chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupChatController extends Controller
{
    //groupChatPage
    public function groupChatPage(){

        $group = Group::first();

        $groupChats = Group_chat::select('group_chats.*','users.image as user_image','users.name as user_name','users.id as user_id','users.gender as user_gender')
        ->leftJoin('users' , 'users.id' ,'group_chats.user_id' )
        ->get();

        return view('group_chat.group_chat',compact('group','groupChats'));
    }

    //sendMessage
    public function sendMessage(Request $request){

        // neither image nor message
        if (empty($request->message) && empty($request->image)) {
            return back()->with(['message' =>'Please write a message or send a photo!']);
        }

        // for both message and photo
        if (!empty($request->message) && !empty($request->image)) {
            //message data is formatted to array
            $message = [
                'message' => $request->message,
                'user_id' => $request->userId,
                'created_at' => Carbon::now()
            ];

            //set the selected image name
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            // store this image to the storage folder
            $request->file('image')->storeAs('public', $fileName);
            //add the image name to the database
            $message['image'] = $fileName;

            //create a message to the group chat database
            Group_chat::create($message);
            return back();

        }

        // for only message
        if (!empty($request->message) && empty($request->image)) {
            //message is formatted to array
            $message = [
                'message' => $request->message,
                'user_id' => $request->userId,
                'created_at' => Carbon::now()
            ];
            //create a message to the group chat database
            Group_chat::create($message);
            return back();

        }

        // for only image
        if (empty($request->message) && !empty($request->image)) {

                //set the selected image name
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();

                // store this image to the storage folder
                $request->file('image')->storeAs('public', $fileName);

                $message = [
                    'image'      => $fileName,
                    'user_id'    => $request->userId,
                    'created_at' => Carbon::now()
                ];
            Group_chat::create($message);
            return back();

        }
    }

    //delete all message
    public function deleteAllMessage(){
        Group_chat::query()->delete();
        return back()->with(['deleteAllMessage'=>'Delete Messages Successfully!']);
    }

    //delete my message
    public function deleteMyMessage($id){
        Group_chat::where('id',$id)->delete();
        return back();
    }

    //delete my image
    public function deleteMyImage($id){
        // For Image
        //old image name | delete
        $dbImage = Group_chat::where('id',$id)->first()->image;

        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
        }
        Group_chat::where('id' ,$id)->delete();
        return back();
    }

    //editMyMessage
    public function editMyMessage(Request $request,$id){
        $message =[
            'user_id' => $request->user_id,
            'message' => $request->message,
            'updated_at' => Carbon::now()
        ];
        Group_chat::where('id' ,$id)->update($message);
        return back();
    }

    //edit my image
    public function editMyImage(Request $request,$id){
        $dbImage = Group_chat::where('id',$id)->first()->image;

        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
        }

        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileName);


        $image = [
            'user_id' => $request->user_id,
            'image' => $fileName,
            'updated_at' => Carbon::now()
        ];

        Group_chat::where('id' ,$id)->update($image);
        return back();

    }

    //delete both message and image
    public function deleteBothMessageAndImage($id){
        Group_chat::where('id',$id)->delete();

        //old image name | delete
        $dbImage = Group_chat::where('id',$id)->first()->image;

        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
        }
        Group_chat::where('id' ,$id)->delete();
        return back();
    }

    //edit both message and image
    public function editBothMessageAndImage($id,Request $request){
        $message =[
            'user_id' => $request->user_id,
            'message' => $request->message,
            'updated_at' => Carbon::now()
        ];

         //If user is selected image?
         if($request->hasFile('image')){
            //old image name | delete
            $dbImage = Group_chat::where('id',$id)->first()->image;

            // delete image from storage folder
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $message['image'] = $fileName;
        }

        Group_chat::where('id' ,$id)->update($message);
        return back();

    }


}
