@extends('layout.master')

@section('title' ,"Post's Detail")

@section('current_page')
<div class="flex items-center">
    <svg class="w-8 h-8 2xl:w-11 2xl:h-11 hidden md:block"  xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M3.5 4A1.5 1.5 0 0 0 2 5.5v2A1.5 1.5 0 0 0 3.5 9h2A1.5 1.5 0 0 0 7 7.5v-2A1.5 1.5 0 0 0 5.5 4h-2ZM3 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2ZM9.5 5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1h-8Zm0 2a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Zm-6 4A1.5 1.5 0 0 0 2 12.5v2A1.5 1.5 0 0 0 3.5 16h2A1.5 1.5 0 0 0 7 14.5v-2A1.5 1.5 0 0 0 5.5 11h-2ZM3 12.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2Zm6.5-.5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1h-8Zm0 2a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Z"/></svg>
    <span class="ms-2 mt-1 text-md md:text-xl">Post's Detail</span>
</div>
@endsection

@section('content')
<!-- Content  -->
<article  class="mt-10 md:mt-0 w-full md:w-[70%] md:mx-auto md:h-[84vh] md:overflow-y-scroll ">

    <!--Post Detail-->
    <div class=" max-w-[1000px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden  rounded-2xl shadow-lg ">
        <div class="p-4 md:p-5 2xl:px-8 px-6">
            <div class="h-[70vh] md:h-[65vh] overflow-y-scroll ">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-3 2xl:gap-x-5 2xl:mt-5">
                        <a  href="{{ route('account#profilePage') }}" class="lg:w-14 lg:h-14 w-12 h-12 overflow-hidden rounded-full shadow-xl">
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
                            {{--post id  --}}
                            <input id="postId" type="hidden" value="{{ $post->id }}">
                            {{--  --}}
                            <div class="flex items-center gap-x-1">
                                @if ($post->user_id == Auth::user()->id)
                                <a href="{{ route('account#profilePage') }}" class="text-slate-700 font-semibold dark:text-slate-200 text-sm md:text-lg">
                                    @else
                                <a href="{{ route('member#accountProfilePage',$post->user_id) }}" class="text-slate-700 font-semibold dark:text-slate-200 text-sm md:text-lg">

                                @endif
                                    {{ $post->user_name }}
                                </a>
                                @if ($post->feeling_category !== null)

                                @if ($post->user_id == Auth::user()->id)
                                <a href="{{ route('account#profilePage') }}" class="dark:text-slate-400 text-slate-600 text-sm md:text-lg">
                                @else
                                <a href="{{ route('member#accountProfilePage',$post->user_id) }}" class="dark:text-slate-400 text-slate-600 text-sm  md:text-lg">

                                @endif
                                    is feeling {{ $post->feeling_category }}
                                </a>
                                @endif
                            </div>
                            <h2 class="text-sm dark:text-slate-400">
                                {{ $post->user_address }}
                            </h2>
                        </div>
                    </div>

                    <div class="parentNode flex items-center gap-x-1 md:gap-x-2 relative">
                        <button class="showOption">
                            <svg class="text-slate-700 dark:text-slate-300 w-5 md:w-8 h-5 md:h-8" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M9 15.25a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0Zm0-5a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0Zm0-5a1.249 1.249 0 1 1 2.5 0a1.25 1.25 0 1 1-2.5 0Z"/></svg>
                        </button>
                        <div class="postOption duration-300 opacity-0 pointer-events-none absolute top-[-10px] left-[-95px] md:-bottom-2 rounded-lg md:-left-[150px] bg-slate-800 flex justify-between items-center gap-x-2 p-2">
                            @if (Auth::user()->id == $post->user_id)
                            <form action="{{ route('post#editPage',$post->id) }}" title="Edit Post" class="editPostBtn w-8 h-8 md:w-10 md:h-10 flex justify-center items-center rounded-full bg-violet-500 hover:bg-violet-600 duration-300 text-white">
                                <input type="hidden" name="userGender" value="{{ $post->user_gender }}">
                                <input type="hidden" name="userAddress" value="{{ $post->user_address }}">
                                <input type="hidden" name="userName" value="{{ $post->user_name }}">
                                <input type="hidden" name="userImage" value="{{ $post->user_image }}">
                                <button type="submit">
                                    <svg class="w-5 h-5 md:w-8 md:h-8"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" fill-opacity=".15" d="M761.1 288.3L687.8 215L325.1 577.6l-15.6 89l88.9-15.7z"/><path fill="currentColor" d="M880 836H144c-17.7 0-32 14.3-32 32v36c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-36c0-17.7-14.3-32-32-32zm-622.3-84c2 0 4-.2 6-.5L431.9 722c2-.4 3.9-1.3 5.3-2.8l423.9-423.9a9.96 9.96 0 0 0 0-14.1L694.9 114.9c-1.9-1.9-4.4-2.9-7.1-2.9s-5.2 1-7.1 2.9L256.8 538.8c-1.5 1.5-2.4 3.3-2.8 5.3l-29.5 168.2a33.5 33.5 0 0 0 9.4 29.8c6.6 6.4 14.9 9.9 23.8 9.9zm67.4-174.4L687.8 215l73.3 73.3l-362.7 362.6l-88.9 15.7l15.6-89z"/></svg>
                                </button>
                            </form>
                            @endif

                            <div class="savePostBtn w-8 h-8 md:w-10 md:h-10 flex justify-center items-center rounded-full bg-violet-500 hover:bg-violet-600 duration-300 text-white @if ($status) cursor-pointer

                            @endif">
                                <input id="postId" type="hidden" value="{{ $post->id }}">
                                <input id="postOwnerId" type="hidden" value="{{ $post->user_id }}">
                                <input type="hidden" name="userImage" value="{{ $post->user_image }}">
                                <button @if ($status) title="Saved Post..." @else title="Save Post..." @endif type="button" @if ($status)
                                    disabled
                                @endif>
                                    @if ($status)
                                    <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" d="M14.8 9c.1-.3.2-.6.2-1c0-2.2-1.8-4-4-4c-1.5 0-2.9.9-3.5 2.2c-.3-.1-.7-.2-1-.2C5.1 6 4 7.1 4 8.5c0 .2 0 .4.1.5c-1.8.3-3.1 1.7-3.1 3.5C1 14.4 2.6 16 4.5 16h10c1.9 0 3.5-1.6 3.5-3.5c0-1.8-1.4-3.3-3.2-3.5zm-6.3 5.9l-3.2-3.2l1.4-1.4l1.8 1.8l3.8-3.8l1.4 1.4l-5.2 5.2z"/></svg>
                                    @else
                                    <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16"><path fill="currentColor" d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/></svg>
                                    @endif
                                </button>
                            </div>


                            <a href="{{ route('post#delete',$post->id) }}" title="Delete Post" class="deletePostBtn w-8 h-8 md:w-10 md:h-10 flex justify-center items-center rounded-full bg-red-500 hover:bgred-600 duration-300 text-white">
                                <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10 2.25a.75.75 0 0 0-.75.75v.75H5a.75.75 0 0 0 0 1.5h14a.75.75 0 0 0 0-1.5h-4.25V3a.75.75 0 0 0-.75-.75h-4Zm0 8.4a.75.75 0 0 1 .75.75v7a.75.75 0 0 1-1.5 0v-7a.75.75 0 0 1 .75-.75Zm4.75.75a.75.75 0 0 0-1.5 0v7a.75.75 0 0 0 1.5 0v-7Z"/><path fill="currentColor" fill-rule="evenodd" d="M5.991 7.917a.75.75 0 0 1 .746-.667h10.526a.75.75 0 0 1 .746.667l.2 1.802c.363 3.265.363 6.56 0 9.826l-.02.177a2.853 2.853 0 0 1-2.44 2.51a27.04 27.04 0 0 1-7.498 0a2.853 2.853 0 0 1-2.44-2.51l-.02-.177a44.489 44.489 0 0 1 0-9.826l.2-1.802Zm1.417.833l-.126 1.134a42.99 42.99 0 0 0 0 9.495l.02.177a1.353 1.353 0 0 0 1.157 1.191c2.35.329 4.733.329 7.082 0a1.353 1.353 0 0 0 1.157-1.19l.02-.178c.35-3.155.35-6.34 0-9.495l-.126-1.134H7.408Z" clip-rule="evenodd"/></svg>
                            </a>
                        </div>

                    </div>
                </div>
                @if ($post->title)
                <div class="text-slate-500 dark:text-slate-300 text-xl 2xl:mt-5 mt-3 flex justify-between items-center ">
                    <p>
                        {{ $post->title }}
                    </p>
                </div>
                @endif
                @if ($post->description)
                <div class="text-slate-400 text-md mt-2 flex justify-between items-center @if ($post->image == null) pb-5 @endif">
                    <p>
                        {{ $post->description }}
                    </p>
                </div>
                @endif
                @if ($post->image !== null)
                <div class="2xl:mt-8 mt-5 overflow-hidden rounded-xl shadow-lg">
                    <img class="w-full" src="{{ asset('storage/'.$post->image) }}" alt="">
                </div>
                @endif
                <!-- like and comment button  -->
                <div class="grid grid-cols-3 items-center mt-2">
                    <input id="postId" type="hidden" value="{{ $post->id }}">
                    <input id="userId" type="hidden" value="{{ Auth::user()->id }}">

                    <div id="reactBtn" class="relative w-full">
                        <div  class="reactSelectionBox absolute w-[120%] opacity-0 pointer-events-none duration-500 top-[-40px] left-8 md:top-[-60px] md:left-12 bg-slate-50 shadow-md border dark:bg-slate-800 px-4 py-1 md:px-5 md:py-2 rounded-2xl flex items-center gap-x-1 md:gap-x-3 justify-center">

                            <div id="like" class="react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/like.png') }}" alt="">
                            </div>
                            <div id="love" class="react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/love.png') }}" alt="">
                            </div>
                            <div id="think" class="react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/think.png') }}" alt="">
                            </div>
                            <div id="sad" class="react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/sad.png') }}" alt="">
                            </div>
                            <div id="angry" class="react flex justify-center items-center cursor-pointer w-5 h-5 lg:w-10 lg:h-10 hover:scale-[1.2] duration-300 overflow-hidden rounded-full ">
                                <img src="{{ asset('img/angry.png') }}" alt="">
                            </div>
                        </div>


                        {{-- like --}}
                            @if (!$reaction)
                            <button id="like" class="react w-full hover:bg-[#f2f2f2] dark:hover:bg-slate-800  duration-300 flex items-center justify-center gap-x-1 md:gap-x-2 py-2 md:py-3 border-2 border-slate-300 dark:border-slate-700 border-l-0 @if ($post->image !== null)border-t-0 @endif dark:text-slate-300 ">
                                <svg class="w-4 h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M1.36 9.495v7.157h3.03l.153.018c2.813.656 4.677 1.129 5.606 1.422c1.234.389 1.694.484 2.531.54c.626.043 1.337-.198 1.661-.528c.179-.182.313-.556.366-1.136a.681.681 0 0 1 .406-.563c.249-.108.456-.284.629-.54c.16-.234.264-.67.283-1.301a.682.682 0 0 1 .339-.57c.582-.337.87-.717.93-1.163c.066-.493-.094-1.048-.513-1.68a.683.683 0 0 1 .176-.936c.401-.282.621-.674.676-1.23c.088-.886-.477-1.541-1.756-1.672a9.42 9.42 0 0 0-3.394.283a.68.68 0 0 1-.786-.95c.5-1.058.778-1.931.843-2.607c.085-.897-.122-1.547-.606-2.083c-.367-.406-.954-.638-1.174-.59c-.29.062-.479.23-.725.818c-.145.348-.215.644-.335 1.335c-.115.656-.178.952-.309 1.34c-.395 1.176-1.364 2.395-2.665 3.236a11.877 11.877 0 0 1-2.937 1.37a.676.676 0 0 1-.2.03H1.36Zm-.042 8.52c-.323.009-.613-.063-.856-.233c-.31-.217-.456-.559-.459-.953l.003-7.323c-.034-.39.081-.748.353-1.014c.255-.25.588-.368.94-.36h2.185A10.505 10.505 0 0 0 5.99 6.95c1.048-.678 1.82-1.65 2.115-2.526c.101-.302.155-.552.257-1.14c.138-.789.224-1.156.422-1.628c.41-.982.948-1.462 1.69-1.623c.73-.158 1.793.263 2.465 1.007c.745.824 1.074 1.855.952 3.129c-.052.548-.204 1.161-.454 1.844a10.509 10.509 0 0 1 2.578-.056c2.007.205 3.134 1.512 2.97 3.164c-.072.712-.33 1.317-.769 1.792c.369.711.516 1.414.424 2.1c-.106.79-.546 1.448-1.278 1.959c-.057.693-.216 1.246-.498 1.66a2.87 2.87 0 0 1-.851.834c-.108.684-.335 1.219-.706 1.595c-.615.626-1.714.999-2.718.931c-.953-.064-1.517-.18-2.847-.6c-.877-.277-2.693-.737-5.43-1.377H1.317Zm1.701-8.831a.68.68 0 0 1 .68-.682a.68.68 0 0 1 .678.682v7.678a.68.68 0 0 1-.679.681a.68.68 0 0 1-.679-.681V9.184Z"/></svg>
                                <span class="text-sm 2xl:text-lg hidden md:inline">
                                    Like
                                </span>
                                <div class="bg-blue-500 text-white 2xl:px-5 px-2 md:px-3 py-1 text-xs md:text-sm shadow-lg rounded-lg md:rounded-xl">
                                    {{ $post->reaction_count }}
                                </div>
                            </button>
                            @else
                            <button  class="reacted w-full hover:bg-[#f2f2f2] dark:hover:bg-slate-800  duration-300 flex items-center justify-center gap-x-1 md:gap-x-2 py-2 md:py-3 border-2 border-slate-300 dark:border-slate-700 border-l-0 @if ($post->image !== null)border-t-0 @endif dark:text-slate-300 ">

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
                                <div class="bg-blue-500 text-white 2xl:px-5 px-2 md:px-3 py-1 text-xs md:text-sm shadow-lg rounded-lg md:rounded-xl">
                                    {{ $post->reaction_count }}
                                </div>
                            </button>
                            @endif

                    </div>
                    <button class=" hover:bg-[#f2f2f2] dark:hover:bg-slate-800 duration-300 flex items-center justify-center gap-x-1 md:gap-x-2 py-2 md:py-3 border-2 border-slate-300 dark:border-slate-700 border-l-0  @if ($post->image !== null)border-t-0 @endif dark:text-slate-300">
                        <svg class="w-5 h-5 md:w-8 md:h-8"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.2L4 17.2V4h16v12m-3-5h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2"/></svg>
                        <span class="text-sm 2xl:text-lg hidden md:inline">
                            Comments
                        </span>
                        <div class="bg-blue-500 text-white 2xl:px-5 px-2 md:px-3 py-1 text-xs md:text-sm shadow-lg rounded-lg md:rounded-xl">
                            {{ $post->comment_count }}
                        </div>
                    </button>
                    <a href="{{ route('view#listPage',$post->id) }}" class=" hover:bg-[#f2f2f2] dark:hover:bg-slate-800 duration-300 flex items-center justify-center gap-x-1 md:gap-x-2 py-2 md:py-3 border-2 border-slate-300 dark:border-slate-700 border-l-0 border-r-0  @if ($post->image !== null)border-t-0 @endif dark:text-slate-300">
                        <svg class="w-5 h-5 md:w-8 md:h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5z"/></svg>
                        <span class="text-sm 2xl:text-lg hidden md:inline">
                            View
                        </span>
                        <div class="bg-blue-500 text-white 2xl:px-5 px-2 md:px-3 py-1 text-xs md:text-sm shadow-lg rounded-lg md:rounded-xl">
                            {{ $post->view_count }}
                        </div>
                    </a>
                </div>

                @if ($post->reaction_count != 0)
                <a href="{{ route('reaction#listPage',$post->id) }}" class="hover:underline duration-150 text-md text-slate-700 dark:text-slate-200 py-3 inline-flex gap-x-2 items-center">
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


                <!-- comment list section  -->
                <div class="mt-6 md:mt-10">
                    @foreach ($comments as $comment)
                    <div class=" mt-5">
                        <div class=" text-slate-600">
                            <div class="flex items-center gap-x-3">
                                <div class="w-10 md:w-12 h-10 md:h-12 overflow-hidden rounded-full shadow-xl">
                                    @if($comment->user_image == null)

                                    @if($comment->user_gender == 'male')
                                    <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                    @else
                                    <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                    @endif
                                    @else
                                    <img class="w-full" src="{{ asset('storage/'.$comment->user_image) }}">
                                    @endif
                                </div>
                                <div class="">
                                    <h1 class="text-slate-800 font-semibold dark:text-slate-200 text-sm md:text-md 2xl:text-lg">
                                        {{ $comment->user_name }}
                                    </h1>
                                    <h2 class="2xl:text-md text-sm dark:text-slate-400">
                                        {{ $comment->user_address }}
                                    </h2>
                                </div>
                            </div>
                            @if ($comment->comment !== null)
                            <div class="flex justify-start">
                                <p class="mt-3 dark:text-slate-500 shadow-lg rounded-2xl p-3 py-2 bg-[#fafafa] dark:bg-[#17181c] border border-slate-300 dark:border-slate-700">
                                    {{ $comment->comment }}
                                </p>
                            </div>
                            @endif
                            @if ($comment->image !== null)
                            <div class="max-w-[150px] 2xl:max-w-[300px] overflow-hidden rounded-lg shadow-lg mt-5">
                                <img src="{{ asset('storage/'.$comment->image) }}" alt="">
                            </div>
                            @endif
                        </div>
                        <h4 class="text-slate-600 dark:text-slate-400 text-xs ms-2 mt-1">{{ $comment->created_at->format('F d \a\t h:i A') }}</h4>
                    </div>
                    @endforeach


                </div>
            </div>



            <div class=" border-2 border-slate-300 dark:border-slate-700 my-5"></div>
            <!-- Write Comment Section  -->
            <form action="{{ route('comment#create') }}" method="Post" class="flex items-center gap-x-3" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="w-10 md:w-12 h-10 md:h-12 overflow-hidden rounded-full shadow-xl">
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
                </div>
                <div class="w-full">
                    <input name="comment" class="comment focus:outline-none dark:text-slate-300 border border-slate-300 dark:bg-[#27282F] dark:border-slate-700 rounded-full px-3 md:px-5 p-2 w-full bg-slate-50 shadow-lg text-sm md:text-md" type="text" placeholder="Write a comment...">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                </div>
                <div class="flex items-center gap-x-2">
                    <button type="button" class="w-10 md:w-11 h-10 md:h-11 flex justify-center items-center rounded-full border border-slate-300 dark:border-slate-700 text-slate-500 shadow-lg ">
                        <label for="fileForComment" class="cursor-pointer">
                            <svg class="w-6 md:w-7 h-6 md:h-7 " xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                        </label>
                        <input onchange="previewFile('previewCommentImage','fileForComment')"  type="file" class="comment hidden" name="image" id="fileForComment" accept="image/*">
                    </button>
                    <button class="sendBtn w-10 md:w-11 h-10 md:h-11 flex justify-center items-center rounded-full border border-slate-300 dark:border-slate-700 text-slate-500 shadow-lg" disabled>
                        <svg class="w-6 md:w-7 h-6 md:h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2.01 21L23 12L2.01 3L2 10l15 2l-15 2z"/></svg>
                    </button>
                </div>
            </form>
            <!-- Preview image modal  -->
            <div class="mt-5">
                <div class="overflow-hidden w-[120px] rounded-xl shadow-lg">
                    <img class="w-full" id="previewCommentImage" src="" alt="">
                </div>
            </div>
        </div>
    </div>

</article>





@endsection


@section('script')
<script src="{{ asset('js/comment_list.js') }}"></script>
<script src="{{ asset('js/detail.js') }}"></script>

@endsection
