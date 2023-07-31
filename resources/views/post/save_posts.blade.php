@extends('layout.master')

@section('title' ,'Saved Posts')

@section('current_page')
<div class="flex items-center">
    <svg class="w-8 h-8 2xl:w-11 2xl:h-11 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256"><path fill="currentColor" d="M184 34H72a14 14 0 0 0-14 14v176a6 6 0 0 0 9.18 5.09l60.81-38l60.83 38A6 6 0 0 0 198 224V48a14 14 0 0 0-14-14ZM72 46h112a2 2 0 0 1 2 2v117.18l-54.83-34.27a6 6 0 0 0-6.36 0L70 165.17V48a2 2 0 0 1 2-2Zm59.17 132.91a6 6 0 0 0-6.36 0L70 213.17v-33.84l58-36.25l58 36.25v33.84Z"/></svg>
    <span class="ms-2 mt-1 text-md md:text-xl">Saved Posts</span>
</div>
@endsection


@section('content')
<!-- Content  -->
<article  class="w-full md:w-[70%] md:mx-auto mt-10 md:mt-0 md:px-5 lg:px-0">

     <!-- grid and row btns and search bar  -->
     <div class="max-w-[900px] md:mx-auto md:flex justify-between gap-x-2 px-3 md:px-0">
        <form action="{{ route('save_post#listPage') }}" method="get" class="flex items-center gap-x-2">
            <input autocomplete="off" name="key" value="{{ request('key') }}" class="border dark:bg-[#27282F] dark:text-slate-300 dark:border-slate-700 focus:outline-none border-blue-300/50 px-3 lg:px-5 py-2 md:py-1 2xl:py-2 text-slate-700 bg-slate-50 shadow-md rounded-lg md:rounded-xl  dark:placeholder:text-slate-100 text-xs md:text-sm lg:text-md" type="search" placeholder="Search Posts...">
            <button type="submit" title="Search" class="bg-blue-400 hover:bg-blue-500 duration-300 text-white w-8 h-8 2xl:w-10 2xl:h-10 flex justify-center items-center rounded-lg md:rounded-xl shadow-md" >
                <svg class="w-5 h-5 2xl:w-<a 2xl:h-<a" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
            </button>
        </form>
        @if (request('key'))
        <div class="px-3 md:px-0 mt-3 md:mt-0 max-w-[900px] mx-auto">
            <h1 class="text-slate-700 dark:text-slate-300 text-lg 2xl:text-xl">Search : {{ request('key') }}</h1>
        </div>
        @endif
    </div>



    <!-- save post Section -->
    <div class="mt-5 lg:mt-10 max-w-[900px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden  rounded-2xl shadow-lg ">

        <!-- post list -->
        <div id="rowDisplay" class="bg-[#f6f8fc] dark:bg-[#1E1F23] h-[650px] lg::h-[500px] max-h-[700px] 2xl:h-[700px] md:max-h-none  overflow-y-scroll p-2 md:p-3  2xl:p-10 flex flex-col gap-y-3 md:gap-y-5">

            @if (count($posts) == 0 )
            <div class="flex justify-center items-center h-full text-red-500 text-lg lg:text-2xl ">
                There is no saved posts yet!
            </div>
            @else
            @foreach ($posts as $post)
                <div class="shadow-md dark:shadow-slate-900 p-2 md:p-3 2xl:p-5 border border-blue-300/50 dark:border-slate-700 rounded-xl justify-between flex items-center">
                    <div class="flex gap-x-3 md:gap-x-2 items-center">
                        <div class="">
                            <a href="{{ route('post#detail',$post->post_id) }}" class="w-[100px] h-[100px] md:w-[150px] md:h-[150px] 2xl:w-[200px] 2xl:h-[200px] inline-block cursor-pointer overflow-hidden rounded-lg shadow-xl">
                                @if($post->post_image != null)
                                <img loading="lazy" class="w-full h-full object-cover object-center" src="{{ asset('storage/'.$post->post_image) }}" alt="">
                                @else
                                @if ($post->post_owner_image != null)
                                <img loading="lazy" class="w-full h-full object-cover object-center" src="{{ asset('storage/'.$post->post_owner_image) }}" alt="">
                                @else
                                    @if ($post->post_owner_gender == 'male')
                                    <img loading="lazy" class="w-full h-full object-cover object-center" src="{{ asset('img/noUserBoy.jpg') }}" alt="">
                                    @else
                                    <img loading="lazy" class="w-full h-full object-cover object-center" src="{{ asset('img/nouser(girl).jpg') }}" alt="">
                                    @endif
                                @endif

                                @endif
                            </a>
                        </div>
                        <div class="lg:ml-10">
                            <h1 class="text-slate-700 ml-1 dark:text-slate-200 text-md md:text-lg 2xl:text-2xl font-semibold">
                                {{ $post->post_title }}
                            </h1>
                            <div class="mt-3 2xl:mt-5 text-slate-500 dark:text-slate-400 text-xs ml-1 md:text-sm flex items-center gap-x-1 ">
                                <a href="{{ route('member#accountProfilePage',$post->post_owner_id) }}" class="w-8  h-8 rounded-full overflow-hidden">
                                    @if ($post->post_owner_image != null)
                                    <img loading="lazy" src="{{ asset('storage/'.$post->post_owner_image) }}" alt="">
                                    @else
                                        @if ($post->user_gender == 'male')
                                        <img loading="lazy" src="{{ asset('img/noUserBoy.jpg') }}" alt="">
                                        @else
                                        <img loading="lazy" src="{{ asset('img/nouser(girl).jpg') }}" alt="">
                                        @endif
                                    @endif
                                </a>
                                <h3>
                                    Save from <a href="{{ route('member#accountProfilePage',$post->user_id) }}" class="text-xs md:text-sm text-slate-600 dark:text-slate-300">{{ $post->post_owner_name }}'s post</a>
                                </h3>
                            </div>

                            <form action="{{ route('savePost#remove') }}"  method="get" class="flex items-center gap-x-8 mt-3 2xl:mt-5">
                                <input name="postId" type="hidden" value="{{ $post->post_id }}">
                                <input name="postOwnerId" type="hidden" value="{{ $post->post_owner_id }}">


                                <div class="flex items-center gap-x-2">
                                    <button  title="Unsaved Post" type="submit" class=" text-white bg-red-400 hover:bg-red-500 duration-300 rounded-full md:rounded-lg text-sm w-7 h-7 md:w-auto md:h-auto flex justify-center items-center  2xl:text-md md:px-2 md:py-1 2xl:px-4 2xl:py-2 shadow-md gap-x-1">
                                        <svg class="w-4 h-4 md:w-5 md:h-5"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"><path stroke-linejoin="round" d="M8.657 3H16a2 2 0 0 1 2 2v7.343M6 6v15l6-3l6 3v-3"/><path d="m4 4l16 16"/></g></svg>
                                        <span class="hidden md:inline">Unsave</span>
                                    </button>
                                    @if (Auth::user()->id != $post->post_owner_id)
                                    <a title="Chat with {{ $post->post_owner_name }}"  href="{{ route('chat#messagePage',$post->post_owner_id) }}"  class="text-white bg-violet-400 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-8 md:h-8 2xl:w-9 2xl:h-9 flex justify-center items-center shadow-md">
                                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.2L4 17.2V4h16v12m-3-5h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2"/></svg>
                                    </a>
                                    @endif

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
            @endif


        </div>
        <!--  -->
        </div>



    </div>

</article>

@endsection


@section('script')
<script src="{{ asset('js/save_posts.js') }}"></script>

@endsection
