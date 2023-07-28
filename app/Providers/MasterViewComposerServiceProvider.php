<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Group;
use App\Models\SavePost;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MasterViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout/master', function ($view) {
            $admins = User::where('role','admin')->get();
            $members = User::where('role','member')->take(3)->orderBy('id','desc')->get();
            $groupPhoto = Group::get()->first();
            $group = Group::all();
            $notifications = Post::whereStatus('unseen')->get();
            $save_posts = SavePost::get();
            $allUsers = User::get();


            $view->with([
                'admins' => $admins,
                'members' => $members,
                'groupPhoto' => $groupPhoto,
                'group' => $group,
                'notifications' => $notifications,
                'save_posts' => $save_posts,
                'users' => $allUsers
            ]);
        });
    }
}
