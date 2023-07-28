<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //search page
    public function searchPage(){
        $users = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
            ->orWhere('address', 'like', '%' . request('key') . '%');
        })
        ->where('id','<>',Auth::user()->id)
        ->orderBy('id','desc')
        ->get();

        return view('home.search',compact('users'));
    }
}
