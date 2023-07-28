@extends('layout.master')

@section('title' ,'Search')

@section('current_page')
<div class="flex items-center gap-x-1 md:gap-x-5">

    <span class="hidden md:inline mt-1 text-md md:text-xl">Search</span>
    <form action="{{ route('search#listPage') }}" method="get" class="hidden lg:flex gap-x-3 items-center w-full md:ml-20">
        <input autocomplete="off" name="key" list="user_lists" class="w-[200px] lg:w-[500px] 2xl:w-[800px] text-slate-700 dark:bg-[#27282F] focus:outline-none px-3 py-1 2xl:px-6 2xl:py-2 text-sm 2xl:text-md rounded-full shadow-lg border border-slate-300 dark:border-slate-700 dark:text-slate-400"  type="search" value="{{ request('key') }}">
        <button type="submit" class="px-3 py-1 2xl:px-4 2xl:py-2 text-sm bg-blue-400 text-white hover:bg-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 duration-300 shadow-lg rounded-lg flex justify-center items-center " >
            Search
        </button>
    </form>
    <datalist id="user_lists">
        @foreach ($users as $user)
            @if ($user->id != Auth::user()->id)
            <option value="{{ $user->name }}">
            @endif
        @endforeach
    </datalist>
</div>
@endsection


@section('content')
<!-- Content  -->
<article  class="w-full md:w-[70%] md:mx-auto md:px-5 lg:px-0">

    <!-- grid and row btns and search bar  -->
    <div class="mt-10 md:mt-0 max-w-[900px] md:mx-auto flex justify-between gap-x-2 px-5 md:px-0">
        <form action="{{ route('admin#listPage') }}" method="get" class="flex items-center gap-x-2">
            <input autocomplete="off" name="key" value="{{ request('key') }}" list="admin_lists" class="border dark:bg-[#27282F] dark:text-slate-300 dark:border-slate-700 focus:outline-none border-blue-300/50 px-3 lg:px-5 py-2 md:py-1 2xl:py-2 text-slate-700 bg-slate-50 shadow-md rounded-lg md:rounded-xl  dark:placeholder:text-slate-100 text-xs md:text-sm lg:text-md" type="search" placeholder="Search...">
            <datalist id="admin_lists" class="w-full">
                @foreach ($users as $user)
                    @if ($user->id != Auth::user()->id)
                        <option value="{{ $user->name }}">
                    @endif
                @endforeach
              </datalist>
            <button type="submit" title="Search" class="bg-blue-400 hover:bg-blue-500 duration-300 text-white w-8 h-8 2xl:w-10 2xl:h-10 flex justify-center items-center rounded-lg md:rounded-xl shadow-md" >
                <svg class="w-5 h-5 2xl:w-<a 2xl:h-<a" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
            </button>
        </form>

    </div>

    @if (request('key'))
    <div class="mt-5 lg:mt-0 max-w-[850px] mx-auto px-5 md:px-0">
        <h1 class="text-slate-700 dark:text-slate-300 text-md lg:text-xl">Search : {{ request('key') }}</h1>
    </div>
    @endif

    <!-- users List Section -->
    <div class="mt-5 2xl:mt-10 max-w-[850px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden  rounded-2xl shadow-lg ">


        <!-- user list -->
        <div id="rowDisplay" class="bg-[#f6f8fc] dark:bg-[#1E1F23] h-[650px] md:h-[500px] max-h-[700px] md:max-h-none
        2xl:h-[700px] overflow-y-scroll p-3 md:p-5 2xl:p-10 flex flex-col gap-y-3 md:gap-y-5">

            @if (count($users) == 0 )
            <div class="flex justify-center items-center h-full text-red-500 text-2xl ">
                There is no user yet!
            </div>
            @else
            @foreach ($users as $user)
                @if ($user->id != Auth::user()->id)
                <div class="shadow-lg dark:shadow-slate-900 p-3 border border-blue-300/50 dark:border-slate-700 rounded-xl justify-between flex gap-x-3 items-center">
                    <div class="flex gap-x-1 md:gap-x-2 items-center">
                        <div class="">
                            <div class="lg:w-14 lg:h-14 w-10 h-10 cursor-pointer overflow-hidden rounded-full shadow-xl">
                                @if($user->image !== null)
                                <img class="w-full" id="previewImageForProfile" src="{{ asset('storage/'.$user->image) }}" alt="">
                                @else
                                     @if($user->gender == 'male')
                                     <img id="previewImageForProfile" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">
                                     @else
                                     <img  id="previewImageForProfile"src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">
                                     @endif
                                @endif
                            </div>
                        </div>
                        <div class="">
                            <h1 class="text-slate-700 ml-1 dark:text-slate-200 text-xs md:text-sm lg:text-md">
                                {{ $user->name }}
                            </h1>
                            <h2 class="text-slate-500 dark:text-slate-400 text-xs ml-1 text-xs lg:text-sm flex items-center gap-x-1 ">
                                <svg class="hidden md:inline text-red-400 w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5z"/></svg>
                                {{ $user->address }}
                            </h2>
                        </div>
                    </div>
                    <div class="flex items-center gap-x-4 md:gap-x-6">
                        <div class="flex items-center gap-x-2">
                            <a href="{{ route('member#accountProfilePage',$user->id) }}"  class="text-white bg-blue-400 hover:bg-blue-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Profile">
                                <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path stroke-linejoin="round" d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/><circle cx="12" cy="7" r="3"/></g></svg>
                            </a>
                            <a href="{{ route('chat#messagePage',$user->id) }}"  class="text-white bg-violet-400 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Message">
                                <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.2L4 17.2V4h16v12m-3-5h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2"/></svg>
                            </a>

                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            @endif


        </div>
        <!--  -->
        </div>



    </div>

</article>

@endsection


@section('script')
<script src="{{ asset('js/user.js') }}"></script>

@endsection
