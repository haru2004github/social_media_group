@extends('layout.master')

@section('title' ,'Edit Post')

@section('current_page')
<div class="">
    <div class="flex items-center">
        <span class="ms-2 mt-1 text-md md:text-xl">Edit Post</span>
    </div>
</div>
@endsection

@section('content')
<!-- Content  -->
<article class="mx-0 px-3 md:px-5 w-full lg:w-[70%] lg:mx-auto mt-10 md:mt-0">
    <!-- Post edit Section -->
    <div class=" max-w-[800px] mx-auto overflow-y-scroll rounded-2xl">
        <!-- Group chat section  -->
        <div class=" h-[600px] 2xl:h-[770px] ">
            <form method="POST" action="{{ route('post#update',$post->id) }}" class="p-5 w-full dark:border-slate-700 bg-[#f6f8fc] dark:bg-slate-900 2xl:px-8 md:px-6 shadow-md rounded-lg md:rounded-2xl  border border-slate-300" enctype="multipart/form-data">
                @csrf

                {{-- //post id  --}}
                <input type="hidden" id="postId" value="{{ $post->id }}">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-3 2xl:gap-x-5 2xl:mt-5">
                        <div class="">
                            <a  href="{{ route('account#profilePage') }}" class="flex justify-center items-center w-9 lg:w-12 2xl:w-16 h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full shadow-xl">
                                @if($owner['userImage'] == null)

                                @if($owner['userGender'] == 'male')
                                <img loading="lazy" class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                @else
                                <img loading="lazy" class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                @endif
                                @else
                                <img loading="lazy" class="w-full" src="{{ asset('storage/'.$owner['userImage']) }}">
                                @endif
                            </a>
                        </div>
                        <div class="">
                            <div class="flex items-center gap-x-1">
                                <a href="{{ route('member#accountProfilePage',$post->user_id) }}" class="text-slate-700 font-semibold dark:text-slate-200 text-sm md:text-md 2xl:text-lg">
                                    {{ $owner['userName'] }}
                                </a>
                            </div>
                            <h2 class="text-xs md:text-sm 2xl:text-md dark:text-slate-400">
                                {{ $owner['userAddress'] }}
                            </h2>
                        </div>
                    </div>

                    <div class="flex items-center gap-x-5">
                        <select name="feeling_id" class="capitalize px-2 2xl:px-4 py-1 2xl:py-2 bg-blue-500 text-white shadow-md rounded-lg focus:outline-none text-sm 2xl:text-md">
                            <option value="">Feeling</option>
                            @foreach ($feelings as $feeling)
                            <option @if ($post->feeling_id == $feeling->id )selected @endif  class="capitalize" value="{{ $feeling->id }}">{{ $feeling->feeling_category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if (session('allMessage'))
                    <div class="my-2">
                        <small class=" text-red-500 text-sm ml-1">
                            {{ session('allMessage') }}
                        </small>
                    </div>
                @endif

                @if ($post->title)
                <div class="text-slate-500 mt-5 md:mt-10 dark:text-slate-300 text-xl 2xl:mt-5   @if ($post->image !== null) pb-5 @endif">
                    <label for="title" class="text-slate-700 dark:text-slate-300 text-sm ml-2">Post Title</label><br>
                    <input type="text" class="w-full focus:outline-none bg-transparent text-slate-700 rounded-lg border dark:border-slate-700 shadow-sm px-3 py-1 text-sm 2xl:text-lg dark:text-slate-300" name="title" placeholder="Enter title..." id="title" value="{{ $post->title }}">
                    @if (session('titleMessage'))
                        <div class="relative">
                            <small class="absolute botoom-0 left-0 text-red-500 text-sm ml-1">
                                {{ session('titleMessage') }}
                            </small>
                        </div>
                    @endif
                </div>
                @endif


                @if ($post->description)
                <div class="text-slate-500 mt-3 dark:text-slate-300 text-xl 2xl:mt-5   @if ($post->image !== null) pb-5 @endif">
                    <label for="description" class="text-slate-700 dark:text-slate-300 text-sm ml-2">Post Description</label><br>
                    <textarea class="w-full focus:outline-none bg-transparent text-slate-700 rounded-lg border dark:border-slate-700 shadow-sm px-3 py-1 text-sm 2xl:text-lg dark:text-slate-300" name="description" placeholder="Enter descrition..." id="description" cols="30" rows="3" >{{ $post->description }}</textarea>
                    @if (session('descriptionMessage'))
                        <div class="relative">
                            <small class="absolute botoom-0 left-0 text-red-500 text-sm ml-1">
                                {{ session('descriptionMessage') }}
                            </small>
                        </div>
                    @endif
                </div>
                @endif
                @if ($post->image !== null)
                <div class="mt-5 overflow-hidden rounded-lg flex justify-center items-center">
                    <img loading="lazy" id="previewImage" class="max-w-[350px]" src="{{ asset('storage/'.$post->image) }}" alt="">
                </div>
                @else
                <div class=" mt-5 overflow-hidden rounded-lg flex justify-center items-center">
                    <img loading="lazy" id="previewImage" class="max-w-[350px]" src="" alt="">
                </div>

                @endif

                <div class="flex justify-between items-center ">
                    <button type="button">
                        <label for="file" class="w-8 lg:w-10 2xl:w-12 h-8 lg:h-10 2xl:h-12 cursor-pointer shadow-md rounded-lg hover:bg-violet-600 duration-300 bg-violet-500 text-white flex justify-center items-center">
                            <svg class="w-6 lg:w-8 h-6 lg:h-8" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                        </label>
                        @if (session('imageMessage'))
                        <div class="relative">
                            <small class="absolute botoom-0 left-0 text-red-500 text-sm ml-1">
                                {{ session('imageMessage') }}
                            </small>
                        </div>
                        @endif


                        <input onchange="previewFile()" id="file" type="file"  class="hidden" name="image" accept="image/*">

                    </button>
                    <button type="submit" class="px-3 py-2 md:py-1 lg:py-2 2xl:px-5 text-white 2xl:py-2 text-xs md:text-sm lg:text-md 2xl:text-lg rounded-lg shadow-md bg-blue-500 hover:bg-blue-600 duration-300 text-center">
                        Update
                    </button>
                </div>

            </form>
        </div>

    </div>

</article>
@endsection


@section('script')
<script>

    // Auto scroll to this post when we reached in home page
    $(document).ready(function(){
        localStorage.setItem('scrollTo','post'+$('#postId').val())
    })

        //for preview image
        function previewFile() {
          let preview = document.getElementById('previewImage');
          let file = document.getElementById('file').files[0];
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
@endsection
