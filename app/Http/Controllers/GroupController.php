<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    //create group
    public function createGroup(Request $request){
        // $this.validationForGroupData($request);

        // validation for group data
        Validator::make($request->all(),[
            'name' => 'required'
        ])->validate();

        $groupData = [
            'name' => $request->name
        ];

        // For Image
        if($request->hasFile('image')){
            
            // set the name of user selected image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            //store this image to the storage folder
            $request->file('image')->storeAs('public', $fileName);
            // add image name to the database
            $groupData['image'] = $fileName;

        }
        Group::create($groupData);
        return back()->with('Created Successfully!');
    }

    //update group
    public function updateGroup(Request $request,$id){
        // validation for group data
        Validator::make($request->all(),[
            'name' => 'required'
        ])->validate();

        $groupData = [
            'name' => $request->name
        ];

        // For Image
        if($request->hasFile('image')){
            //old image name | delete
            $dbImage = Group::where('id',$id)->first()->image;

            //delete old image from the storage folder
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            // set the name of user selected image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            //store this image to the storage folder
            $request->file('image')->storeAs('public', $fileName);
            // add image name to the database
            $groupData['image'] = $fileName;
        }

        // update the data of the databse
        Group::where('id',$id)->update($groupData);

        return back()->with('Created Successfully!');
    }


















}
