<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Direct_chat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;


class DirectChatController extends Controller
{
    // chat page
    public function chatPage($receiverId){
        // get all of chat messages which is sended form me
        $myChatMessages = Direct_chat::where('sender_id',Auth::user()->id)
        ->where('receiver_id',$receiverId)
        ->get();
        //get all of messages which is sended to me
        $otherChatMessages = Direct_chat::where('sender_id',$receiverId)
        ->where('receiver_id',Auth::user()->id)
        ->get();

        // added above $myChatMessages and $otherChatMessages to $chatMessages and sort by message's id
        $chatMessages = $myChatMessages->concat($otherChatMessages)->sortBy('id');

        //get data of the user that is chat with me
        $chatPerson = User::where('id',$receiverId)
        ->first();

        return view('direct_chat.direct_chat',compact('chatPerson','chatMessages'));


    }

    //send message
    public function sendMessage(Request $request){

         // neither image nor message
        if (empty($request->message) && empty($request->image)) {
            return back()->with(['message' =>'Please write a message or send a photo!']);
        }

        // for both message and photo
        if (!empty($request->message) && !empty($request->image)) {
            // get data of chat message from user who is chat with me
            $message = [
                'message' => $request->message,
                'sender_id' => Auth::user()->id,
                'receiver_id' => $request->receiverId,
                'created_at' => Carbon::now()
            ];

            // named the image that is sended to me
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);

            //add image name to Messages and create message to database
            $message['image'] = $fileName;
            Direct_chat::create($message);
            return back();

        }

        // if chat Person sends only message
        if (!empty($request->message) && empty($request->image)) {

            $message = [
                'message' => $request->message,
                'sender_id' => Auth::user()->id,
                'receiver_id' => $request->receiverId,
                'created_at' => Carbon::now()
            ];

            // create a chat message to the database
            Direct_chat::create($message);
            return back();

        }

        // if chat Person sends only Image
        if (empty($request->message) && !empty($request->image)) {
            // get image name and add image name to database
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);

            //format to array
            $message = [
                'image'       => $fileName,
                'sender_id'   => Auth::user()->id,
                'receiver_id' => $request->receiverId,
                'created_at'  => Carbon::now()
            ];

            //creates a message with image to database
            Direct_chat::create($message);
            return back();
        }
    }

    //delete my message
    public function deleteMyMessage($id){
        // delete a message which the id of selected message is equal to the id of message form chat_database
        Direct_chat::where('id',$id)->delete();
        return back();
    }

    //delete my image
    public function deleteMyImage($id){
        // For Image
        //old image name | delete
        $dbImage = Direct_chat::where('id',$id)->first()->image;

        // delete the image whether chat image is already existed
        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
        }
        // delete a image which the id of selected message is equal to the id of message form chat_database
        Direct_chat::where('id' ,$id)->delete();
        return back();
    }

    //edit my Message
    public function editMyMessage(Request $request,$id){

        // get data of chat which id sended to me
        $message = [
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiverId,
            'message' => $request->message,
            'updated_at' => Carbon::now()

        ];

        // update a message which the id of selected message is equal to the id of message form chat_database
        Direct_chat::where('id',$id)->update($message);
        return back();

    }

    //edit my image
    public function editMyImage(Request $request,$id){
        // Image name form database
        $dbImage = Direct_chat::where('id',$id)->first()->image;


        // delete image from storage folder which is equal to the name of image form above $dbImage
        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
        }

        // get image name from user request and get client client original name and update this name to database.
        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileName);


        // get all of request data to change array
        $image = [
            'sender_id'   => Auth::user()->id,
            'receiver_id' => $request->receiverId,
            'image'       => $fileName,
            'updated_at'  => Carbon::now()
        ];

        // if the id of the selected message is equal to the id of chatMessage from database ,Image is updated.
        Direct_chat::where('id' ,$id)->update($image);
        return back();
    }

    //edit both message and image
    public function editBothMessageAndImage($id,Request $request){

        // message is formatted to array
        $message =[
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiverId,
            'message' => $request->message,
            'updated_at' => Carbon::now()
        ];

         //If user is selected image?
         if($request->hasFile('image')){
            //old image name | delete
            $dbImage = Direct_chat::where('id',$id)->first()->image;

            // first, delete old image from storage folder
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            // define image name and store a new image data to storage and update this image name to database
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $message['image'] = $fileName;
        }

        // update message and image which the id of selected message is equal to the id of message form chat_database
        Direct_chat::where('id' ,$id)->update($message);
        return back();
    }


}
