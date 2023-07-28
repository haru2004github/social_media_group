<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeelingController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\SavePostController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\DirectChatController;
use App\Http\Controllers\NotificationController;


Route::middleware([AdminAuthMiddleware::class])->group(function () {
    Route::redirect('/','loginPage');
    Route::get('loginPage' , [AuthController::class ,"loginPage"])->name('auth#loginPage');
    Route::get('registerPage' , [AuthController::class ,"registerPage"])->name('auth#registerPage');
});



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'
])->group(function () {


    // home page
    Route::get('home' ,[AuthController::class , 'homePage'])->name('home');


    //Search user and admin page
    Route::prefix('search')->group(function(){
        //search page
        Route::get('listPage' ,[SearchController::class, 'searchPage'])->name('search#listPage');
    });

    //account

    Route::prefix('account/')->group(function(){
        Route::get('profile' ,[AuthController::class , 'profilePage'])->name('account#profilePage');

        //cover photo
        Route::post('cover_photo/{id}',[AuthController::class , 'changeCoverPhoto'])->name('account#changeCoverPhoto');
        Route::get('cover_photo/delete/{id}',[AuthController::class , 'deleteCoverPhoto'])->name('account#deleteCoverPhoto');

        //profile image
        Route::post('profile_image/{id}' ,[AuthController::class , 'changeProfileImage'])->name('account#changeProfileImage');
        Route::get('cover_image/delete/{id}' ,[AuthController::class , 'deleteProfileImage'])->name('account#deleteProfileImage');

        //update account detail
        Route::post('update/{id}' ,[AuthController::class , 'updateAccount'])->name('account#update');

        //password page
        Route::get('password',[AuthController::class ,'passwordPage'])->name('account#passwordPage');

        //password change page
        Route::post('password/change' ,[AuthController::class ,'passwordChange'])->name('account#passwordChange');


    });

    //admin
    Route::prefix('admin')->group(function(){
        //admin list page
        Route::get('listPage',[AdminController::class , 'adminListPage'])->name('admin#listPage');

        //delete account
        Route::get('account/delete/{id}' ,[AdminController::class,'deleteAccount'])->name('admin#deleteAccount')->middleware([AdminAuthMiddleware::class]);

        //change role to member
        Route::get('roleChange' ,[AdminController::class ,'roleChange'])->name('admin#roleChange')->middleware([AdminAuthMiddleware::class]);
    });

    // member
    Route::prefix('member')->group(function (){

        //list
        Route::get('list',[MemberController::class ,'memberListPage'])->name('member#listPage');

        //account
        Route::get('account/profile/{id}', [MemberController::class , 'accountProfilePage'])->name('member#accountProfilePage');

        //delete account
        Route::get('account/delete/{id}',[MemberController::class ,'deleteAccount'])->name('member#deleteAccount')->middleware([AdminAuthMiddleware::class]);

        //change role to admin
        Route::get('roleChange' ,[MemberController::class ,'roleChange'])->name('member#roleChange')->middleware([AdminAuthMiddleware::class]);

    });

    //group chat
    Route::prefix('group_chat')->group(function (){
        //group chat page
        Route::get('page' ,[GroupChatController::class ,'groupChatPage'])->name('group_chat#page');
        //send message or image
        Route::post('send' , [GroupChatController::class ,'sendMessage'])->name('group_chat#sendMessage');

        //delete all message
        Route::get('delete/all' ,[GroupChatController::class , 'deleteAllMessage'])->name('group_chat#deleteAllMessage')->middleware([AdminAuthMiddleware::class]);

        //delete my message
        Route::get('delete/message/{id}' ,[GroupChatController::class , 'deleteMyMessage'])->name('group_chat#deleteMyMessage');

        //edit my message
        Route::post('edit/message/{id}' , [GroupChatController::class ,'editMyMessage'])->name('group_chat#editMyMessage');

        //delete my image
        Route::get('delete/image/{id}' ,[GroupChatController::class ,'deleteMyImage'])->name('group_chat#deleteMyImage');

        //edit my image
        Route::post('edit/image/{id}' ,[GroupChatController::class ,'editMyImage'])->name('group_chat#editMyImage');

        //edit both message and image
        Route::get('delete/messageAndImage/{id}' , [GroupChatController::class ,'deleteBothMessageAndImage'])->name('group_chat#deleteBothMessageAndImage');

        //edit both message and image
        Route::post('edit/bothMessageAndImage/{id}' , [GroupChatController::class ,'editBothMessageAndImage'])->name('group_chat#editBothMessageAndImage');

    });

    //post
    Route::prefix('post')->group(function(){
        //create post
        Route::post('create' ,[PostController::class , 'createPost'])->name('post#create');

        //post detail page
        Route::get('detail/{id}',[PostController::class , 'postDetail'])->name('post#detail');

        //delete post
        Route::get('delete/{id}',[PostController::class , 'deletePost'])->name('post#delete')->middleware([AdminAuthMiddleware::class]);

        // edit post
         Route::get('edit/{id}',[PostController::class , 'editPostPage'])->name('post#editPage');

        //update post
        Route::post('update/{id}',[PostController::class,'updatePost'])->name('post#update');

        //post view count
        Route::get('viewCount',[PostController::class , 'postViewCount'])->name('post#viewCount');
    });

    //comment
    Route::prefix('comment')->group(function(){
        //create comment
        Route::post('create',[CommentController::class ,'createComment'])->name('comment#create');

        // Comment list Page
        Route::get('list/{id}',[CommentController::class,'commentList'])->name('comment#list');
    });

    //reaction
    Route::prefix('reaction')->group(function(){
        //create reaction
        Route::get('create',[ReactionController::class, 'createReaction'])->name('reaction#create');

        //cancel reaction
        Route::get('cancel',[ReactionController::class, 'cancelReaction'])->name('reaction#cancel');

        //reactor list
        Route::get('listPage/{id}',[ReactionController::class ,'reactorListPage'])->name('reaction#listPage');

    });

    //direct chat
    Route::prefix('chat')->group(function(){
        //direct chat page
        Route::get('messagePage/{id}',[DirectChatController::class , 'chatPage'])->name('chat#messagePage');

         //send message or image
         Route::post('sendMessage' , [DirectChatController::class ,'sendMessage'])->name('chat#sendMessage');

         //delete my message
         Route::get('delete/message/{id}' ,[DirectChatController::class , 'deleteMyMessage'])->name('chat#deleteMyMessage');

         //edit my message
         Route::post('edit/message/{id}' , [DirectChatController::class ,'editMyMessage'])->name('chat#editMyMessage');

         //delete my image
         Route::get('delete/image/{id}' ,[DirectChatController::class ,'deleteMyImage'])->name('chat#deleteMyImage');

         //edit my image
         Route::post('edit/image/{id}' ,[DirectChatController::class ,'editMyImage'])->name('chat#editMyImage');

         //edit both message and image
         Route::get('delete/messageAndImage/{id}' , [DirectChatController::class ,'deleteBothMessageAndImage'])->name('chat#deleteBothMessageAndImage');

         //edit both message and image
         Route::post('edit/bothMessageAndImage/{id}' , [DirectChatController::class ,'editBothMessageAndImage'])->name('chat#editBothMessageAndImage');


    });

    //save post
    Route::prefix('save_post')->group(function (){

        //save post list
        Route::get('list',[SavePostController::class ,'listPage'])->name('save_post#listPage');

        //create save post
        Route::get('add' ,[SavePostController::class ,'addSavePost'])->name('savePost#create');

        //remove save post
        Route::get('remove' ,[SavePostController::class ,'removeSavePost'])->name('savePost#remove');


    });

    //view
    Route::prefix('view')->group(function(){
        //list
        Route::get('listPage/{id}',[ViewController::class ,'viewListPage'])->name('view#listPage');

    });

    Route::middleware([AdminAuthMiddleware::class])->group(function () {

        //group
        Route::prefix('group')->group(function(){
            // create group name and cover photo
            Route::post('create',[GroupController::class , 'createGroup'])->name('group#create');
            //update group
            Route::post('update/{id}',[GroupController::class , 'updateGroup'])->name('group#update');

        });

        //notification
        Route::prefix('notification')->group(function(){
            // post list
            Route::get('list',[NotificationController::class, 'listPage'])->name('notification#listPage');

            //changePost Approve
            Route::get('change/post_approve' ,[NotificationController::class , 'changePostApprove'])->name('notification#changePostApprove');

            //post detail
            Route::get('post/detail/{id}' ,[NotificationController::class , 'postDetail'])->name('notification#postDetail');
        });

        //feeling
        Route::prefix('feeling')->group(function(){
            //category list
            Route::get('list' ,[FeelingController::class ,'listPage'])->name('feeling#listPage');

            //create category
            Route::post('create' ,[FeelingController::class ,'createCategory'])->name('feeling#createCategory');

            //delete category
            Route::get('delete/category/{id}' ,[FeelingController::class , 'deleteCategory'])->name('feeling#deleteCategory');


            //edit category
            Route::post('edit/category/{id}' , [FeelingController::class ,'editCategory'])->name('feeling#editCategory');
        });
    });


});
