@extends('layout.master')

@section('title' ,'Home')

@section('current_page')
<div class="flex items-center gap-x-14">
    <div class="flex items-center ">
        <svg class="hidden lg:inline-block w-8 h-8 2xl:w-11 2xl:h-11" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="m16 8.41l-4.5-4.5L4.41 11H6v8h3v-6h5v6h3v-8h1.59L17 9.41V6h-1v2.41M2 12l9.5-9.5L15 6V5h3v4l3 3h-3v8h-5v-6h-3v6H5v-8H2Z"/></svg>
        <span class="ms-1 mt-1 text-md md:text-xl ">Home</span>
    </div>
    <a href="{{ route('search#listPage') }}" class="2xl:flex gap-x-3 items-center w-full hidden ">
        <input list="user_lists" class=" 2xl:w-[800px] text-slate-700 dark:bg-[#27282F] focus:outline-none px-3 py-1 md:px-6 md:py-2 text-sm md:text-md rounded-full shadow-lg border border-slate-300 dark:border-slate-700 dark:text-slate-400"  type="search">
        <span class="px-4 py-2 bg-blue-400 text-white hover:bg-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 duration-300 shadow-lg rounded-lg flex justify-center items-center text-sm" >
            Search
        </span>
    </a>
</div>

@endsection

@section('content')
<!-- Content  -->
<article class="px-3 xl:px-5 w-full md:w-[65%] lg:w-[70%] mx-auto md:h-[86vh] xl:h-[84vh] md:overflow-y-scroll">
    <!-- Group Section  -->
    <div class=" lg:max-w-[720px] 2xl:max-w-[1200px] mx-auto">
        <div class="mt-8 md:mt-0 overflow-hidden shadow-lg border rounded-lg  md:rounded-2xl lg:h-[500px] min-h-[200px] h-[200px] max-h-[300px] md:min-h-[300px] md:max-h-[300px] md:h-[300px] lg:min-h-[450px] lg:max-h-[500px] object-cover bg-slate-200 z-0">
            @if (count($group) == 0)
            <img class="object-center object-cover h-full w-full brightness-80 z-0" src="https://img.freepik.com/free-vector/people-communicating-via-social-media_74855-5551.jpg?w=1380&t=st=1689353990~exp=1689354590~hmac=edcfe3de67fffd107397e7c08477edffbdd6fc2658e5dc9b3e4e4c16a993d07b" alt="">
            @else
                @if ($group[0]->image == null)
                <img class="object-center object-cover h-full w-full brightness-80 z-0" src="https://img.freepik.com/free-vector/people-communicating-via-social-media_74855-5551.jpg?w=1380&t=st=1689353990~exp=1689354590~hmac=edcfe3de67fffd107397e7c08477edffbdd6fc2658e5dc9b3e4e4c16a993d07b" alt="">
                @else
                <img class="object-center object-cover h-full w-full brightness-80 z-0" src="{{ asset('storage/'.$group[0]->image) }}" alt="">
                @endif
            @endif
        </div>
    </div>

    <div class="mt-8 max-w-[1200px] mx-auto 2xl:px-40 px-5">
        <div class="flex justify-between items-center">
            <h1 class="text-xl md:text-2xl 2xl:text-3xl text-slate-600 dark:text-slate-200">
                @if (count($group) == 0)
                Group Name
                @else
                {{ $group[0]->name }}
                @endif
            </h1>
            @if (Auth::user()->role == 'admin')
            <button type="button" onclick="toggleDisplayForEdit()" class="unsetScrollTo bottom-3 md:bottom-10 right-3 md:right-10 bg-blue-400 hover:bg-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 px-3 md:px-5 py-1 text-slate-100  font-medium text-lg rounded-xl flex items-center duration-300">
                <svg class="mr-2 w-5 h-5 lg:w-7 lg:h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 22q-.825 0-1.413-.588T3 20V6q0-.825.588-1.413T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v6h-2v-2H5v10h7v2H5Zm17.125-5L20 14.875l.725-.725q.275-.275.7-.275t.7.275l.725.725q.275.275.275.7t-.275.7l-.725.725ZM14 23v-2.125l5.3-5.3l2.125 2.125l-5.3 5.3H14ZM5 8h14V6H5v2Zm0 0V6v2Z"/></svg>
                <span class="mt-1 text-sm md:text-lg">
                    @if (count($group) == 0)
                    Create
                    @else
                    Edit
                    @endif
                </span>
            </button>
            @endif
        </div>
        <div class="flex items-center mt-5">

            @foreach ($members as $member)

            <div class=" w-9 h-9  overflow-hidden rounded-full shadow-lg">
                 <a href="{{ route('member#accountProfilePage',$member->id) }}" class="lg:w-14 lg:h-14 w-9 h-9 overflow-hidden rounded-full shadow-xl">
                    @if($member->image == null)

                    @if($member->gender == 'male')
                    <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                    @else
                    <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                    @endif
                    @else
                    <img class="w-full" src="{{ asset('storage/'.$member->image) }}">
                    @endif
                </a>
            </div>
            @endforeach

        </div>
    </div>
    <!--  -->


    <!-- Post Section  -->
    <div class="container mt-12 lg:mt-20 max-w-[1200px] mx-auto 2xl:px-40 lg:px-5">
         <!-- create post section  -->
        <div class="shadow-lg rounded-lg md:rounded-2xl p-5 2xl:p-5 2xl:px-10 border border-slate-300 dark:border-slate-700 overflow-hidden bg-[#f6f6f6] dark:bg-[#1E1F23]">
            <div class="flex items-center gap-x-2 md:gap-x-5">
                <div class="">
                    <a href="{{ route('account#profilePage',Auth::user()->id) }}" class=" inline-block lg:w-14 lg:h-14 w-9 h-9 overflow-hidden rounded-full shadow-lg">
                        @if(Auth::user()->image == null)

                        @if(Auth::user()->gender == 'male')
                        <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                        @else
                        <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                        @endif
                        @else
                        <img class="w-full" src="{{ asset('storage/'.Auth::user()->image) }}">
                        @endif
                    </a>
                </div>
                <div class="w-full">
                    <input  onclick="toggleDisplayForPost()" class="focus:outline-none dark:text-slate-300 dark:bg-[#27282F] dark:border-0 border border-slate-300 rounded-full px-3 py-1 lg:px-5 lg:p-2 w-full bg-slate-50 text-sm md:text-md" type="text" placeholder="What's on your mind...">
                </div>
            </div>


            <div  class=" flex justify-between items-center text-slate-600 dark:text-slate-300 mt-1 md:mt-3">
                <button onclick="toggleDisplayForPost()">
                    <label for="file" class="cursor-pointer">
                        <svg class="w-7 h-7 ml-1 lg:ml-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                    </label>
                </button>
                <button  onclick="toggleDisplayForPost()" class="px-5 py-1 text-sm md:text-md dark:text-slate-300 rounded-xl shadow-lg border-2 border-slate-300 dark:border-slate-700">
                    Post
                </button>
            </div>
        </div>

        @if (count($posts) == null)
        <div class="py-20 flex justify-center items-center text-2xl text-red-500">
            There is no post yet!
        </div>

        @else
        <!-- post list section  -->
        @foreach ($posts as $post)
        <div id="post{{ $post->id }}" class="parentNode p-4 md:p-5 dark:bg-[#1E1F23] dark:border-slate-700 2xl:px-8  shadow-lg rounded-lg md:rounded-2xl mt-10 border border-slate-300">
            <input type="hidden" value="{{ $post->id }}" class="postId">
            <div class=" flex justify-between items-center">
                <div class="flex items-center gap-x-3 2xl:gap-x-5 2xl:mt-5">
                    <a  @if ($post->user_id == Auth::user()->id)
                        href="{{ route('account#profilePage',Auth::user()->id) }}"
                      @else
                        href="{{ route('member#accountProfilePage',$post->user_id) }}"
                      @endif class="lg:w-14 lg:h-14 w-9 h-9 overflow-hidden rounded-full shadow-xl">
                        @if($post->user_image == null)
                            @if($post->user_gender == 'male')
                                <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">
                            @else
                                <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">
                            @endif
                        @else
                            <img class="w-full" src="{{ asset('storage/'.$post->user_image) }}">
                        @endif
                    </a>
                    <div class="">
                        <div class="flex items-center gap-x-1">
                            <a @if ($post->user_id == Auth::user()->id)
                                href="{{ route('account#profilePage',Auth::user()->id) }}"
                              @else
                                href="{{ route('member#accountProfilePage',$post->user_id) }}"
                              @endif
                                class="text-slate-700 font-semibold dark:text-slate-200 text-sm md:text-lg">
                                {{ $post->user_name }}
                            </a>
                            @if ($post->feeling_category !== null)

                            @if ($post->user_id == Auth::user()->id)
                                <a href="{{ route('account#profilePage',Auth::user()->id) }}" class="dark:text-slate-400 text-slate-600 text-sm md:text-lg">
                            @else
                                <a href="{{ route('member#accountProfilePage',$post->user_id) }}" class="dark:text-slate-400 text-slate-600 text-sm  md:text-lg">
                            @endif
                                is feeling <span class="small">{{ $post->feeling_category }}</span>
                            </a>
                            @endif
                        </div>
                        <h2 class="text-sm dark:text-slate-400">
                            {{ $post->created_at->format('F d \a\t h:i A') }}
                        </h2>
                    </div>
                </div>

                <div class=" flex items-center gap-x-1 md:gap-x-2 relative z-0">

                    <button class="showOption z-0">
                        <svg class="text-slate-700 dark:text-slate-300 w-5 md:w-8 h-5 md:h-8" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M9 15.25a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0Zm0-5a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0Zm0-5a1.249 1.249 0 1 1 2.5 0a1.25 1.25 0 1 1-2.5 0Z"/></svg>
                    </button>

                    <div class="postOption duration-300 opacity-0 pointer-events-none absolute -z-40 top-[-50px]  left-[-90px] md:-bottom-2 rounded-lg md:-left-[150px] shadow-md border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 flex justify-between items-center gap-x-2 p-2">

                        @if (Auth::user()->id == $post->user_id)
                        <form action="{{ route('post#editPage',$post->id) }}" title="Edit Post" class="editPostBtn w-8 h-8 lg:w-10 lg:h-10 flex justify-center items-center rounded-full bg-violet-500 hover:bg-violet-600 duration-300 text-white">
                            <input type="hidden" name="userGender" value="{{ $post->user_gender }}">
                            <input type="hidden" name="userAddress" value="{{ $post->user_address }}">
                            <input type="hidden" name="userName" value="{{ $post->user_name }}">
                            <input type="hidden" name="userImage" value="{{ $post->user_image }}">
                            <button title="Edit Post..." type="submit">
                                <svg class="scale-95 lg:scale-100"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" fill-opacity=".15" d="M761.1 288.3L687.8 215L325.1 577.6l-15.6 89l88.9-15.7z"/><path fill="currentColor" d="M880 836H144c-17.7 0-32 14.3-32 32v36c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-36c0-17.7-14.3-32-32-32zm-622.3-84c2 0 4-.2 6-.5L431.9 722c2-.4 3.9-1.3 5.3-2.8l423.9-423.9a9.96 9.96 0 0 0 0-14.1L694.9 114.9c-1.9-1.9-4.4-2.9-7.1-2.9s-5.2 1-7.1 2.9L256.8 538.8c-1.5 1.5-2.4 3.3-2.8 5.3l-29.5 168.2a33.5 33.5 0 0 0 9.4 29.8c6.6 6.4 14.9 9.9 23.8 9.9zm67.4-174.4L687.8 215l73.3 73.3l-362.7 362.6l-88.9 15.7l15.6-89z"/></svg>
                            </button>
                        </form>
                        @endif

                        <button type="button" @if (in_array(Auth::user()->id,explode(',',$post->saver_id))) title="Saved Post..." @else title="Save Post..." @endif  class="savePostBtn w-8 h-8 lg:w-10 lg:h-10 flex justify-center items-center rounded-full  @if (in_array(Auth::user()->id,explode(',',$post->saver_id))) bg-blue-600 @else bg-blue-500 hover:bg-blue-600 duration-300 @endif  text-white cursor-pointer"  @if (in_array(Auth::user()->id,explode(',',$post->saver_id))) disabled @endif>
                            <input id="postId" type="hidden" value="{{ $post->id }}">
                            <input id="postOwnerId" type="hidden" value="{{ $post->user_id }}">
                            <input type="hidden" name="userImage" value="{{ $post->user_image }}">

                            @if (in_array(Auth::user()->id,explode(',',$post->saver_id)))
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" d="M14.8 9c.1-.3.2-.6.2-1c0-2.2-1.8-4-4-4c-1.5 0-2.9.9-3.5 2.2c-.3-.1-.7-.2-1-.2C5.1 6 4 7.1 4 8.5c0 .2 0 .4.1.5c-1.8.3-3.1 1.7-3.1 3.5C1 14.4 2.6 16 4.5 16h10c1.9 0 3.5-1.6 3.5-3.5c0-1.8-1.4-3.3-3.2-3.5zm-6.3 5.9l-3.2-3.2l1.4-1.4l1.8 1.8l3.8-3.8l1.4 1.4l-5.2 5.2z"/></svg>
                            @else
                                <svg class="scale-95 lg:scale-100" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16"><path fill="currentColor" d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/></svg>
                            @endif

                        </button>


                        @if (Auth::user()->role == "admin")
                        <a title="Delete Post..." href="{{ route('post#delete',$post->id) }}" class="deletePostBtn w-8 h-8 lg:w-10 lg:h-10 flex justify-center items-center rounded-full bg-red-500 hover:bgred-600 duration-300 text-white">
                            <svg class="scale-95 lg:scale-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10 2.25a.75.75 0 0 0-.75.75v.75H5a.75.75 0 0 0 0 1.5h14a.75.75 0 0 0 0-1.5h-4.25V3a.75.75 0 0 0-.75-.75h-4Zm0 8.4a.75.75 0 0 1 .75.75v7a.75.75 0 0 1-1.5 0v-7a.75.75 0 0 1 .75-.75Zm4.75.75a.75.75 0 0 0-1.5 0v7a.75.75 0 0 0 1.5 0v-7Z"/><path fill="currentColor" fill-rule="evenodd" d="M5.991 7.917a.75.75 0 0 1 .746-.667h10.526a.75.75 0 0 1 .746.667l.2 1.802c.363 3.265.363 6.56 0 9.826l-.02.177a2.853 2.853 0 0 1-2.44 2.51a27.04 27.04 0 0 1-7.498 0a2.853 2.853 0 0 1-2.44-2.51l-.02-.177a44.489 44.489 0 0 1 0-9.826l.2-1.802Zm1.417.833l-.126 1.134a42.99 42.99 0 0 0 0 9.495l.02.177a1.353 1.353 0 0 0 1.157 1.191c2.35.329 4.733.329 7.082 0a1.353 1.353 0 0 0 1.157-1.19l.02-.178c.35-3.155.35-6.34 0-9.495l-.126-1.134H7.408Z" clip-rule="evenodd"/></svg>
                        </a>
                        @else
                            @if ($post->user_id == Auth::user()->id)
                                <a title="Delete Post..." href="{{ route('post#delete',$post->id) }}" class="deletePostBtn w-8 h-8 lg:w-10 lg:h-10 flex justify-center items-center rounded-full bg-red-500 hover:bgred-600 duration-300 text-white">
                                    <svg class="scale-95 lg:scale-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10 2.25a.75.75 0 0 0-.75.75v.75H5a.75.75 0 0 0 0 1.5h14a.75.75 0 0 0 0-1.5h-4.25V3a.75.75 0 0 0-.75-.75h-4Zm0 8.4a.75.75 0 0 1 .75.75v7a.75.75 0 0 1-1.5 0v-7a.75.75 0 0 1 .75-.75Zm4.75.75a.75.75 0 0 0-1.5 0v7a.75.75 0 0 0 1.5 0v-7Z"/><path fill="currentColor" fill-rule="evenodd" d="M5.991 7.917a.75.75 0 0 1 .746-.667h10.526a.75.75 0 0 1 .746.667l.2 1.802c.363 3.265.363 6.56 0 9.826l-.02.177a2.853 2.853 0 0 1-2.44 2.51a27.04 27.04 0 0 1-7.498 0a2.853 2.853 0 0 1-2.44-2.51l-.02-.177a44.489 44.489 0 0 1 0-9.826l.2-1.802Zm1.417.833l-.126 1.134a42.99 42.99 0 0 0 0 9.495l.02.177a1.353 1.353 0 0 0 1.157 1.191c2.35.329 4.733.329 7.082 0a1.353 1.353 0 0 0 1.157-1.19l.02-.178c.35-3.155.35-6.34 0-9.495l-.126-1.134H7.408Z" clip-rule="evenodd"/></svg>
                                </a>
                                @endif
                        @endif
                    </div>

                </div>
            </div>
            @if ($post->title)
            <div class="text-slate-500 dark:text-slate-300 text-lg md:text-xl 2xl:mt-5 mt-3 flex justify-between items-center ">
                <p>
                    {{ $post->title }}
                </p>
            </div>
            @endif
            <a  href="{{ route('post#detail',$post->id) }}" class="addViewerBtn text-slate-400 text-md md:text-lg hover:text-blue-500 duration-300 cursor-pointer">
                See more...
            </a>
            @if ($post->image !== null)
            <div class=" 2xl:mt-8 mt-3 md:mt-5 rounded-xl shadow-lg max-h-[500px] overflow-hidden">
                <img id="postImage" class="postImage image cursor-pointer object-center object-cover h-full w-full" src="{{ asset('storage/'.$post->image) }}" alt="">
            </div>
            @endif
            <!-- like and comment button  -->
            <div class="parentForReaction  grid grid-cols-3 items-center mt-2">
                <div class="reactBtn relative h-full w-full">

                    {{-- //user id post id  --}}
                    <input id="postId" type="hidden" value="{{ $post->id }}">
                    <input id="userId" type="hidden" value="{{ Auth::user()->id }}">

                    <div  class="reactSelectionBox absolute w-[120%] opacity-0 pointer-events-none duration-500 top-[-40px] left-8 md:top-[-60px] md:left-12 bg-slate-50 shadow-md border dark:bg-slate-800 px-4 py-1 md:px-5 md:py-2 rounded-2xl flex items-center gap-x-1 md:gap-x-3 justify-center">

                        <div class="">
                            <div title="Like" id="like" class=" react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/like.png') }}" alt="">
                            </div>
                        </div>

                        <div class="">
                            <div title="Love" id="love" class=" react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/love.png') }}" alt="">
                            </div>
                        </div>
                        <div class="">
                            <div title="Think" id="think" class=" react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/think.png') }}" alt="">
                            </div>
                        </div>
                        <div class="">
                            <div title="Sad" id="sad" class=" react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/sad.png') }}" alt="">
                            </div>
                       </div>
                        <div class="">
                            <div title="Angry" id="angry" class=" react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/angry.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    {{-- like --}}


                    @if (in_array(Auth::user()->id,explode(',',$post->reactor_id)))
                    <button  class="reacted h-full w-full hover:bg-[#f2f2f2] dark:hover:bg-slate-800  duration-300 flex items-center justify-center gap-x-1 md:gap-x-2 py-2 md:py-3 border-2 border-slate-300 dark:border-slate-700 border-l-0 @if ($post->image !== null)border-t-0 @endif dark:text-slate-300 ">


                        {{-- like reaction for post --}}
                        @foreach ($reactions as $reaction)
                            @if ($post->id == $reaction->post_id && $reaction->user_id == Auth::user()->id)
                                @switch($reaction->reaction_type)
                                    @case('like')
                                        <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                            <img class="w-full" src="{{ asset('img/like.png') }}" alt="">
                                        </div>
                                        <span class="text-sm 2xl:text-lg hidden md:inline">
                                            Liked
                                        </span>
                                        @break

                                    @case('love')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/love.png') }}" alt="">
                                    </div>
                                    <span class="text-sm 2xl:text-lg hidden md:inline">
                                        Love
                                    </span>
                                    @break

                                    @case('think')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/think.png') }}" alt="">
                                    </div>
                                    <span class="text-sm 2xl:text-lg hidden md:inline">
                                        Think
                                    </span>
                                    @break

                                    @case('sad')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/sad.png') }}" alt="">
                                    </div>
                                    <span class="text-sm 2xl:text-lg hidden md:inline">
                                        Sad
                                    </span>
                                    @break

                                    @case('angry')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/angry.png') }}" alt="">
                                    </div>
                                    <span class="text-sm 2xl:text-lg hidden md:inline">
                                        Angry
                                    </span>
                                    @break

                                    @default

                                @endswitch
                            @endif
                        @endforeach

                        <div class="bg-blue-500 text-white 2xl:px-5 px-2 md:px-3 py-1 text-xs md:text-sm shadow-lg rounded-lg md:rounded-xl">
                              {{ $post->reaction_count }}
                        </div>
                    </button>

                    @else
                    <button id="like" class="react h-full w-full hover:bg-[#f2f2f2] dark:hover:bg-slate-800  duration-300 flex items-center justify-center gap-x-1 md:gap-x-2 py-2 md:py-3 border-2 border-slate-300 dark:border-slate-700 border-l-0 @if ($post->image !== null)border-t-0 @endif dark:text-slate-300 ">
                        <svg class="w-5 h-5 lg:w-8 lg:h-8" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M1.36 9.495v7.157h3.03l.153.018c2.813.656 4.677 1.129 5.606 1.422c1.234.389 1.694.484 2.531.54c.626.043 1.337-.198 1.661-.528c.179-.182.313-.556.366-1.136a.681.681 0 0 1 .406-.563c.249-.108.456-.284.629-.54c.16-.234.264-.67.283-1.301a.682.682 0 0 1 .339-.57c.582-.337.87-.717.93-1.163c.066-.493-.094-1.048-.513-1.68a.683.683 0 0 1 .176-.936c.401-.282.621-.674.676-1.23c.088-.886-.477-1.541-1.756-1.672a9.42 9.42 0 0 0-3.394.283a.68.68 0 0 1-.786-.95c.5-1.058.778-1.931.843-2.607c.085-.897-.122-1.547-.606-2.083c-.367-.406-.954-.638-1.174-.59c-.29.062-.479.23-.725.818c-.145.348-.215.644-.335 1.335c-.115.656-.178.952-.309 1.34c-.395 1.176-1.364 2.395-2.665 3.236a11.877 11.877 0 0 1-2.937 1.37a.676.676 0 0 1-.2.03H1.36Zm-.042 8.52c-.323.009-.613-.063-.856-.233c-.31-.217-.456-.559-.459-.953l.003-7.323c-.034-.39.081-.748.353-1.014c.255-.25.588-.368.94-.36h2.185A10.505 10.505 0 0 0 5.99 6.95c1.048-.678 1.82-1.65 2.115-2.526c.101-.302.155-.552.257-1.14c.138-.789.224-1.156.422-1.628c.41-.982.948-1.462 1.69-1.623c.73-.158 1.793.263 2.465 1.007c.745.824 1.074 1.855.952 3.129c-.052.548-.204 1.161-.454 1.844a10.509 10.509 0 0 1 2.578-.056c2.007.205 3.134 1.512 2.97 3.164c-.072.712-.33 1.317-.769 1.792c.369.711.516 1.414.424 2.1c-.106.79-.546 1.448-1.278 1.959c-.057.693-.216 1.246-.498 1.66a2.87 2.87 0 0 1-.851.834c-.108.684-.335 1.219-.706 1.595c-.615.626-1.714.999-2.718.931c-.953-.064-1.517-.18-2.847-.6c-.877-.277-2.693-.737-5.43-1.377H1.317Zm1.701-8.831a.68.68 0 0 1 .68-.682a.68.68 0 0 1 .678.682v7.678a.68.68 0 0 1-.679.681a.68.68 0 0 1-.679-.681V9.184Z"/></svg>
                        <span class="text-sm 2xl:text-lg hidden md:inline">
                            Like
                        </span>
                        <div class="bg-blue-500 text-white 2xl:px-5 px-3 py-0 text-sm shadow-lg rounded-xl">
                            {{ $post->reaction_count }}
                        </div>
                    </button>
                    @endif


                </div>

                <a href="{{ route('post#detail',$post->id) }}" class="setScrollTo hover:bg-[#f2f2f2] dark:hover:bg-slate-800 duration-300 flex items-center justify-center gap-x-1 md:gap-x-2 py-2 md:py-3 border-2 border-slate-300 dark:border-slate-700 border-l-0  @if ($post->image !== null)border-t-0 @endif dark:text-slate-300">
                    <svg class="w-5 h-5 md:w-8 md:h-8 text-slate-700 dark:text-slate-300 md:hidden lg:block"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.2L4 17.2V4h16v12m-3-5h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2"/></svg>
                    <span class="text-sm 2xl:text-lg hidden md:inline">
                        Comments
                    </span>
                    <div class="bg-blue-500 text-white 2xl:px-5 px-2 md:px-3 py-1 text-xs md:text-sm shadow-lg rounded-lg md:rounded-xl">
                        {{ $post->comment_count }}
                    </div>
                </a>

                <a href="{{ route('view#listPage',$post->id) }}" class="setScrollTo hover:bg-[#f2f2f2] dark:hover:bg-slate-800  duration-300 flex items-center justify-center gap-x-1 md:gap-x-2 py-2 md:py-3 border-2 border-slate-300 dark:border-slate-700 border-l-0 border-r-0  @if ($post->image !== null)border-t-0 @endif dark:text-slate-300">
                    <svg class="w-5 h-5 md:w-8 md:h-8 text-slate-700 dark:text-slate-300 md:hidden lg:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5z"/></svg>
                    <span class="text-sm 2xl:text-lg hidden md:inline">
                        View
                    </span>
                    <div class="bg-blue-500 text-white 2xl:px-5 px-2 md:px-3 py-1 text-xs md:text-sm shadow-lg rounded-lg md:rounded-xl">
                        {{ $post->view_count }}
                    </div>
                </a>
            </div>

            @if ($post->reaction_count != 0)
            <a href="{{ route('reaction#listPage',$post->id) }}" class="setScrollTo hover:underline duration-150 text-xs md:text-md xl:text-lg text-slate-700 dark:text-slate-200 py-3 inline-flex gap-x-2 items-center">
                @if(in_array(Auth::user()->id,explode(',',$post->reactor_id)))
                    @foreach ($reactions as $reaction)
                        @if ($post->id == $reaction->post_id && $reaction->user_id == Auth::user()->id)
                            @switch($reaction->reaction_type)
                                @case('like')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/like.png') }}" alt="">
                                    </div>
                                @break

                                @case('love')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/love.png') }}" alt="">
                                    </div>
                                @break

                                @case('think')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/think.png') }}" alt="">
                                    </div>
                                @break

                                @case('sad')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/sad.png') }}" alt="">
                                    </div>
                                @break

                                @case('angry')
                                    <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                        <img class="w-full" src="{{ asset('img/angry.png') }}" alt="">
                                    </div>
                                @break

                                @default

                            @endswitch
                        @endif
                    @endforeach
                    You
                @endif

                @foreach ($reactors as $reactor)
                    @if ($post->id == $reactor[0]->post_id)
                        @if(in_array(Auth::user()->id,explode(',',$post->reactor_id)))
                        ,
                        @else
                            @foreach ($reactions as $reaction)
                                @if ($reactor[0]->user_id == $reaction->user_id && $reaction->post_id == $post->id)
                                    @switch($reaction->reaction_type)
                                        @case('like')
                                            <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                                <img class="w-full" src="{{ asset('img/like.png') }}" alt="">
                                            </div>
                                        @break

                                        @case('love')
                                            <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                                <img class="w-full" src="{{ asset('img/love.png') }}" alt="">
                                            </div>
                                        @break

                                        @case('think')
                                            <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                                <img class="w-full" src="{{ asset('img/think.png') }}" alt="">
                                            </div>
                                        @break

                                        @case('sad')
                                            <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                                <img class="w-full" src="{{ asset('img/sad.png') }}" alt="">
                                            </div>
                                        @break

                                        @case('angry')
                                            <div class=" w-5 h-5 lg:w-8 lg:h-8 rounded-full overflow-hidden">
                                                <img class="w-full" src="{{ asset('img/angry.png') }}" alt="">
                                            </div>
                                        @break

                                        @default

                                    @endswitch
                                @endif
                            @endforeach
                        @endif
                        {{ $reactor[0]->user_name }}
                    @endif
                @endforeach

                @if(in_array(Auth::user()->id,explode(',',$post->reactor_id)))
                    @if ($post->reaction_count > 2)
                        and others
                    @endif
                @else
                    @if ($post->reaction_count > 1)
                        and others
                    @endif
                @endif
            </a>
            @endif

            @if ($post->comment_count != 0)
            <!-- comment list section  -->
            <div class="mt-6 md:mt-10 hidden md:block">
                <h1 class="text-slate-600 dark:text-slate-300 text-lg md:text-xl">
                    Last Comment
                </h1>

                @foreach ($comments as $comment)
                    @if ($post->id == $comment[0]->post_id)
                    <div class=" mt-5 w-full">
                        <div class="shadow-md rounded-2xl p-3 md:p-5 border border-slate-300 dark:border-slate-700 text-slate-600">
                            <a @if (Auth::user()->id == $comment[0]->user_id)
                                href="{{ route('account#profilePage',Auth::user()->id) }}"
                            @else
                                href="{{ route('member#accountProfilePage',$comment[0]->user_id) }}"
                            @endif class="flex items-center gap-x-3">
                                <div class="w-10 md:w-12 h-10 md:h-12 overflow-hidden rounded-full shadow-md">
                                    @if($comment[0]->user_image == null)

                                    @if($comment[0]->user_gender == 'male')
                                    <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                    @else
                                    <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                    @endif
                                    @else
                                    <img class="w-full" src="{{ asset('storage/'.$comment[0]->user_image) }}">
                                    @endif
                                </div>
                                <div class="">
                                    <h1 class="text-slate-800 font-semibold dark:text-slate-200 text-sm md:text-md 2xl:text-lg">
                                        {{ $comment[0]->user_name }}
                                    </h1>
                                    <h2 class="2xl:text-md text-sm dark:text-slate-400">
                                        {{ $comment[0]->user_address }}
                                    </h2>
                                </div>
                            </a>
                            <div class="">
                                @if ($comment[0]->comment)
                                <p class="mt-3 dark:text-slate-500 shadow-lg rounded-2xl p-3 py-2 w-auto inline-block bg-[#fafafa] dark:bg-[#17181c] border border-slate-300 dark:border-slate-700">
                                    {{ $comment[0]->comment }}
                                </p>
                                @endif
                                @if ($comment[0]->image)
                                <div class="mt-3 overflow-hidden rounded-lg max-w-[250px]">
                                    <img id="image" class="image" src="{{ asset('storage/'.$comment[0]->image) }}" alt="">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach

            </div>
            @endif
            <div class=" border-2 border-slate-300 dark:border-slate-700 my-2 md:my-5"></div>

            <!-- Write Comment Section  -->
            <form action="{{ route('comment#create') }}" method="Post" class="flex items-center gap-x-3" enctype="multipart/form-data">
                @csrf
                <a href="{{ route('account#profilePage',Auth::user()->id) }}" class="">
                    <div class="w-9 md:w-12 h-9 md:h-12 overflow-hidden rounded-full shadow-xl">
                        @if(Auth::user()->image == null)

                        @if(Auth::user()->gender == 'male')
                        <img src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                        @else
                        <img src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                        @endif
                        @else
                        <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="User Profile">
                        @endif
                    </div>
                </a>
                <div class="w-full">
                    <input name="comment" class="comment focus:outline-none dark:text-slate-300 border border-slate-300 dark:bg-[#27282F] dark:border-slate-700 rounded-full px-3 md:px-5 p-1 md:py-2 w-full bg-slate-50 shadow-md text-sm" placeholder="Write a comment!">

                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                </div>
                <div class="flex items-center gap-x-2">
                    <a href="{{ route('post#detail',$post->id) }}" class="w-8 md:w-11 h-8 md:h-11 flex justify-center items-center rounded-full border border-slate-300 dark:border-slate-700 text-slate-500 shadow-md hover:bg-slate-100 dark:hover:bg-slate-900 duration-300">
                        <label for="fileForComment" class="cursor-pointer">
                            <svg class="w-4 md:w-7 h-4 md:h-7 " xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                        </label>

                    </a>
                    <button class="setScrollTo w-8 md:w-11 h-8 md:h-11 flex justify-center items-center rounded-full border border-slate-300 dark:border-slate-700 text-slate-500 shadow-md hover:bg-slate-100 dark:hover:bg-slate-900 duration-300" disabled>
                        <svg class="w-4 md:w-7 h-4 md:h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2.01 21L23 12L2.01 3L2 10l15 2l-15 2z"/></svg>
                    </button>
                </div>
            </form>
            <!-- Preview image modal  -->
            <div class="mt-2 md:mt-3 lg:mt-5">
                <div class="overflow-hidden w-[120px] rounded-xl shadow-lg">
                    <img class="w-full" id="previewCommentImage" src="" alt="">
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</article>

{{-- layer  --}}
<article id="layerOne" class="bg-white/10 backdrop-blur-lg fixed top-0 left-0 w-full h-screen z-50 opacity-0 pointer-events-none duration-500">
</article>

{{-- layer two--}}
<article id="layerTwo" class="bg-white/10 backdrop-blur-lg fixed top-0 left-0 w-full h-screen z-50 opacity-0 pointer-events-none duration-500">
</article>

{{-- layer three --}}
<article id="layerThree" class="bg-white/10 backdrop-blur-lg fixed top-0 left-0 w-full h-screen z-50 opacity-0 pointer-events-none duration-500">
</article>

{{-- fullImage  --}}
<article class="modalImageContainer fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] p-3 2xl:p-8  dark:bg-slate-800 bg-slate-100 z-50 rounded-2xl shadow-xl border border-blue-300/50 opacity-0 pointer-events-none duration-500 overflow-hidden">
    <div class="flex justify-end">
        <div class="flex items-center gap-x-2">
            <a href=""class="savePhotoBtn w-7 h-7 2xl:w-10 2xl:h-10 bg-green-400 hover:bg-green-500 duration-300  shadow-lg flex justify-center items-center rounded-full text-white" title="Save Photo" download >
                <svg class="w-5 h-5 2xl:w-7 2xl:h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11l-5 5Zm-8 4v-5h2v3h12v-3h2v5H4Z"/></svg>
            </a>
            <button type="button" onclick="closeFullImage()" class="w-7 h-7 2xl:w-10 2xl:h-10 bg-red-400 hover:bg-red-500 duration-300  shadow-lg flex justify-center items-center rounded-full text-white" title="Close">
                <svg class="w-5 h-5 2xl:w-7 2xl:h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5.72 5.72a.75.75 0 0 1 1.06 0L12 10.94l5.22-5.22a.749.749 0 0 1 1.275.326a.749.749 0 0 1-.215.734L13.06 12l5.22 5.22a.749.749 0 0 1-.326 1.275a.749.749 0 0 1-.734-.215L12 13.06l-5.22 5.22a.751.751 0 0 1-1.042-.018a.751.751 0 0 1-.018-1.042L10.94 12L5.72 6.78a.75.75 0 0 1 0-1.06Z"/></svg>
            </button>
        </div>
    </div>
    <div class="rounded-lg overflow-hidden mt-3 2xl:mt-5 2xl:h-[600px] w-auto">
        <img class="fullImage h-full" src="" alt="">
    </div>
</article>


{{-- edit group detail modal  --}}
<article id="groupModal" class="fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] w-[380px] p-10  dark:bg-slate-800 bg-slate-50 z-50 rounded-2xl shadow-xl border border-blue-300/50 opacity-0 pointer-events-none duration-500">
        @if (count($group) == 0)
        <form action="{{ route('group#create') }}" method="Post" enctype="multipart/form-data">
        @else
        <form action="{{ route('group#update',$group[0]->id) }}" method="POST" enctype="multipart/form-data">

        @endif

        @csrf
        <div class="">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl text-blue-500">Group Detail</h1>
                <button type="button" title="Close Modal..." onclick="toggleDisplayForEdit()" class="w-8 h-8 bg-red-400 hover:bg-red-500 duration-300  shadow-lg flex justify-center items-center rounded-full text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5.72 5.72a.75.75 0 0 1 1.06 0L12 10.94l5.22-5.22a.749.749 0 0 1 1.275.326a.749.749 0 0 1-.215.734L13.06 12l5.22 5.22a.749.749 0 0 1-.326 1.275a.749.749 0 0 1-.734-.215L12 13.06l-5.22 5.22a.751.751 0 0 1-1.042-.018a.751.751 0 0 1-.018-1.042L10.94 12L5.72 6.78a.75.75 0 0 1 0-1.06Z"/></svg>
                </button>
            </div>
            <div class="rounded-xl flex justify-center shadow-md overflow-hidden mt-3">
                @if (count($group) == 0)
                <img id="previewImageForGroup" class="object-center object-cover h-full w-full brightness-80 z-0" src="https://img.freepik.com/free-vector/people-communicating-via-social-media_74855-5551.jpg?w=1380&t=st=1689353990~exp=1689354590~hmac=edcfe3de67fffd107397e7c08477edffbdd6fc2658e5dc9b3e4e4c16a993d07b" alt="">
                @else
                    @if ($group[0]->image == null)
                    <img id="previewImageForGroup" class="object-center object-cover h-full w-full brightness-80 z-0" src="https://img.freepik.com/free-vector/people-communicating-via-social-media_74855-5551.jpg?w=1380&t=st=1689353990~exp=1689354590~hmac=edcfe3de67fffd107397e7c08477edffbdd6fc2658e5dc9b3e4e4c16a993d07b" alt="">

                    @else
                    <img id="previewImageForGroup" class="object-center object-cover h-full w-full brightness-80 z-0" src="{{ asset('storage/'.$group[0]->image) }}" alt="">
                    @endif
                @endif

            </div>
            <div class="flex gap-x-3 items-end ">

                <div class="mt-8 w-full">
                    <label class="text-slate-600 dark:text-slate-300" for="name">Group Name</label><br>
                    @if (count($group) == 0)
                    <input required name="name" id="name" class="w-full focus:outline-none text-slate-700 rounded-xl border border-slate-300 shadow-lg px-3 py-2 bg-slate-50 text-md dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300" type="text" value="{{ old('name') }}" placeholder="Enter Group Name...">
                    @else
                    <input required name="name" id="name" class="w-full focus:outline-none text-slate-700 rounded-xl border border-slate-300 shadow-lg px-3 py-2 bg-slate-50 text-md dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300" type="text" value="{{ old('name',$group[0]->name) }}" placeholder="Enter Group Name...">
                    @endif

                    @error('name')
                    <div class="relative">
                        <small class="absolute botoom-0 left-0 text-red-500 text-sm ml-1">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror
                </div>

                <button type="button">
                    <label for="fileForGroup" class="w-10 h-10 cursor-pointer shadow-md rounded-lg hover:bg-blue-500 duration-300 bg-blue-400 text-white flex justify-center items-center">
                        <svg class="" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                    </label>

                    @if (count($group)  == 0)
                    <input onchange="previewFile('previewImageForGroup','fileForGroup')" id="fileForGroup" type="file" class="hidden" name="image" accept="image/*">
                    @else
                    <input onchange="previewFile('previewImageForGroup','fileForGroup')" id="fileForGroup" type="file" value="{{ $group[0]->image }}" class="hidden" name="image" accept="image/*">

                    @endif
                </button>
            </div>
            <div class="mt-8">
                <button type="submit" class="bg-blue-400 hover:bg-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 duration-300 py-2 w-full flex justify-center text-white rounded-lg shadow-lg gap-x-1 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5v2H5v14h14v-5h2z"/><path fill="currentColor" d="M21 7h-4V3h-2v4h-4v2h4v4h2V9h4z"/></svg>
                    @if (count($group) == 0)
                    Create
                    @else
                    Update
                    @endif
                </button>
            </div>
        </div>

        @error('image')
        <div class="relative mt-2">
            <small class="absolute botoom-0 left-0 text-red-500 text-sm ml-1">
                {{ $message }}
            </small>
        </div>
        @enderror
    </form>
</article>


{{-- post modal  --}}
<article id="postModal" class="fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] w-[380px] md:w-[700px] p-5 md:p-10  dark:bg-slate-800 bg-slate-50 z-50 rounded-2xl shadow-xl border border-blue-300/50 opacity-0 pointer-events-none duration-500">
    <form action="{{ route('post#create')}}" method="Post" enctype="multipart/form-data">
        @csrf
        <article class="flex justify-between items-center">
            <h1 class="text-blue-500 text-2xl">Create Post</h1>
            <button type="button" onclick="toggleDisplayForPost()" class="w-8 h-8 bg-red-400 hover:bg-red-500 duration-300  shadow-lg flex justify-center items-center rounded-full text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5.72 5.72a.75.75 0 0 1 1.06 0L12 10.94l5.22-5.22a.749.749 0 0 1 1.275.326a.749.749 0 0 1-.215.734L13.06 12l5.22 5.22a.749.749 0 0 1-.326 1.275a.749.749 0 0 1-.734-.215L12 13.06l-5.22 5.22a.751.751 0 0 1-1.042-.018a.751.751 0 0 1-.018-1.042L10.94 12L5.72 6.78a.75.75 0 0 1 0-1.06Z"/></svg>
            </button>
        </article>

        <article class=" md:min-w-[600px] gap-x-10 mt-5 md:mt-0">
            <div class="flex justify-between items-center">
                <div class="flex gap-x-1">
                    <div class="flex items-center gap-x-3 2xl:gap-x-5 mt-3">
                        <a href="" class="lg:w-14 lg:h-14 w-9 h-9 overflow-hidden rounded-full shadow-xl">
                            @if(Auth::user()->image == null)

                            @if(Auth::user()->gender == 'male')
                            <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                            @else
                            <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                            @endif
                            @else
                            <img class="w-full" src="{{ asset('storage/'.Auth::user()->image) }}">
                            @endif
                        </a>

                        <div class="">
                            <div class="flex items-center gap-x-1">
                                <a href="{{ route('member#accountProfilePage',Auth::user()->id) }}" class="block text-slate-800 font-semibold dark:text-slate-200 2xl:text-lg">
                                    {{ Auth::user()->name }}
                                </a>
                            </div>
                            <a href="{{ route('member#accountProfilePage',Auth::user()->id) }}" class="block 2xl:text-md text-sm dark:text-slate-400">
                                {{ Auth::user()->address }}
                            </a>
                        </div>
                    </div>
                </div>

                <select name="feeling_id" class="capitalize px-2 md:px-4 py-1 md:py-2 bg-blue-500 text-white shadow-lg rounded-lg focus:outline-none text-sm md:text-md">
                    <option value="">
                        <span class="hidden md:inline">Feeling</span>
                    </option>
                    @foreach ($feelings as $feeling)
                    <option class="capitalize" value="{{ $feeling->id }}">{{$feeling->feeling_category }}</option>
                    @endforeach
                </select>

            </div>
        </article>
        <article>
            <div class="mt-8">

                @if (session('allMessage'))
                    <div class="my-2">
                        <small class=" text-red-500 text-sm ml-1">
                            {{ session('allMessage') }}
                        </small>
                    </div>
                @endif

                <label for="title" class="text-slate-700 dark:text-slate-300 text-md ml-2">Post Title</label><br>
                <input name="title"class="postInput w-full mb-4 focus:outline-none bg-transparent text-slate-700 rounded-xl border shadow-sm px-3 py-2 text-md border-slate-300 dark:border-slate-500 dark:text-slate-300" type="text" placeholder="Enter your title..." value="{{ old('title') }}">
                @if (session('titleMessage'))
                <div class="relative">
                    <small class="absolute -bottom-4 left-0 text-red-500 text-sm ml-1">
                        {{ session('titleMessage') }}
                    </small>
                </div>
                @endif
                @error('title')
                <div class="relative mt-1">
                    <small class="absolute bottom-0 left-0 text-red-500 text-sm ml-1">
                        {{ $message }}
                    </small>
                </div>
                @enderror

                <label for="description" class="text-slate-700   dark:text-slate-300 text-md ml-2">Post Description</label><br>
                <textarea class="postInput w-full focus:outline-none bg-transparent text-slate-700 rounded-xl border shadow-sm px-3 py-2 text-md border-slate-300 dark:border-slate-500 dark:text-slate-300" name="description" id="description" cols="30" rows="2" placeholder="Enter your description...">{{ old('description') }}</textarea>
                @if (session('descriptionMessage'))
                <div class="relative">
                    <small class="absolute -bottom-4 left-0 text-red-500 text-sm ml-1">
                        {{ session('descriptionMessage') }}
                    </small>
                </div>
                @endif
                @error('description')
                <div class="relative">
                    <small class="absolute -bottom-4 left-0 text-red-500 text-sm ml-1">
                        {{ $message }}
                    </small>
                </div>
                @enderror

                <div class="rounded-xl flex justify-center shadow-lg overflow-hidden mt-3 ">
                    <img class="max-w-[300px]" id="previewImageForPost" src="" alt="">
                </div>
            </div>
            <div class=" mt-3 md:mt-5 flex justify-between items-center">
                <button type="button">
                    <label for="fileForPost" class="w-10 md:w-12 h-10 md:h-12 cursor-pointer shadow-md rounded-lg hover:bg-violet-600 duration-300 bg-violet-500 text-white flex justify-center items-center">
                        <svg class="w-6 md:w-8 h-6 md:h-8" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                    </label>
                    @if (session('imageMessage'))
                    <div class="relative">
                        <small class="absolute -bottom-4 left-0 text-red-500 text-sm ml-1">
                            {{ session('imageMessage') }}
                        </small>
                    </div>
                    @endif


                    <input onchange="previewFile('previewImageForPost','fileForPost')" id="fileForPost" type="file"  class="postInput hidden" name="image" accept="image/*"  value="{{ old('title') }}">


                </button>

                <button class="postBtn px-5 text-white bg-blue-500 hover:bg-blue-600 duration-300 rounded-lg md:rounded-xl shadow-xl py-1 md:py-2 flex md:gap-x-1 items-center text-center justify-center text-sm md:text-lg" disabled>
                    <svg class="hidden md:block w-6 h-6 md:w-8 md:h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15 20H9v-8H4.16L12 4.16L19.84 12H15v8Z"/></svg>
                    Post
                </button>
            </div>

            @error('image')
                <div class="relative">
                    <small class="absolute top-0 bottom-0 text-red-500 text-sm ml-1">
                        {{ $message }}
                    </small>
                </div>
            @enderror

        </article>
    </form>
</article>



@endsection


@section('script')
<script>

    // auto scroll
    window.onload = function() {
        let scrollToPost  = localStorage.getItem('scrollTo')
        let el = document.getElementById(scrollToPost);
        el.scrollIntoView(true);
    }

    //for preview image
    function previewFile(previewImage,fileName) {
      let preview = document.getElementById(previewImage);
      let file = document.getElementById(fileName).files[0];
      const reader = new FileReader();

      reader.addEventListener(
        "load",
        () => {
          // convert image file to base64 string
          preview.src = reader.result;
        },
        false
      );

      if (file) {
        reader.readAsDataURL(file);
      }
    }
//

</script>
<script src="{{ asset('js/home.js') }}"></script>
@endsection
