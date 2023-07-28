@extends('layout.master')

@section('title' ,'Member Lists')

@section('current_page')
<div class="flex items-center">
    <svg class="w-8 h-8 2xl:w-11 2xl:h-11 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M402 168c-2.93 40.67-33.1 72-66 72s-63.12-31.32-66-72c-3-42.31 26.37-72 66-72s69 30.46 66 72Z"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M336 304c-65.17 0-127.84 32.37-143.54 95.41c-2.08 8.34 3.15 16.59 11.72 16.59h263.65c8.57 0 13.77-8.25 11.72-16.59C463.85 335.36 401.18 304 336 304Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M200 185.94c-2.34 32.48-26.72 58.06-53 58.06s-50.7-25.57-53-58.06C91.61 152.15 115.34 128 147 128s55.39 24.77 53 57.94Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M206 306c-18.05-8.27-37.93-11.45-59-11.45c-52 0-102.1 25.85-114.65 76.2c-1.65 6.66 2.53 13.25 9.37 13.25H154"/></svg>
    <span class="ms-1 md:ms-2 mt-1 text-md md:text-xl">Members <span class="hidden md:inline">' Lists</span></span>
</div>
@endsection


@section('content')
<!-- Content  -->
<article  class="md:px-5 lg:px-0 w-full md:w-[70%] md:mx-auto mt-10 md:mt-0">
    <!-- grid and row btns and search bar  -->
    <div class="max-w-[900px] md:mx-auto flex justify-between gap-x-2 px-3 md:px-0">
        <form action="{{ route('member#listPage') }}" method="get" class="flex items-center gap-x-2">
            <input autocomplete="off" name="key" value="{{ request('key') }}" list="admin_lists" class="border dark:bg-[#27282F] dark:text-slate-300 dark:border-slate-700 focus:outline-none border-blue-300/50 px-3 lg:px-5 py-2 md:py-1 2xl:py-2 text-slate-700 bg-slate-50 shadow-md rounded-lg md:rounded-xl  dark:placeholder:text-slate-100 text-xs md:text-sm lg:text-md" type="search" placeholder="Search...">
            <datalist id="member_lists" class="w-full">
                @foreach ($members as $member)
                    @if ($member->id != Auth::user()->id)
                        <option value="{{ $member->name }}">
                    @endif
                @endforeach
              </datalist>
              <button type="submit" title="Search" class="bg-blue-400 hover:bg-blue-500 duration-300 text-white w-8 h-8 2xl:w-10 2xl:h-10 flex justify-center items-center rounded-lg md:rounded-xl shadow-md" >
                <svg class="w-5 h-5 2xl:w-<a 2xl:h-<a" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
            </button>
        </form>
        <div class="flex items-center gap-x-2">
            <h1 class="text-slate-600 text-md 2xl:text-lg dark:text-slate-200 hidden md:block">Seen by </h1>
            <button onclick="toggleDisplayStyle()" id="gridDisplayBtn" class="text-white bg-violet-400 duration-300 hover:bg-violet-500 w-8 h-8 2xl:w-10 2xl:h-10 flex justify-center items-center shadow-md rounded-lg" title="Seen by grids..">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21.5 2h-19a.5.5 0 0 0-.5.5v19a.5.5 0 0 0 .5.5h19a.5.5 0 0 0 .5-.5v-19a.5.5 0 0 0-.5-.5zm-13 19H3V3h5.5v18zm6 0h-5V3h5v18zm6.5 0h-5.5V3H21v18z"/></svg>
            </button>
        </div>
    </div>

    @if (request('key'))
    <div class="px-2 md:px-0 mt-5 2xl:mt-10 max-w-[900px] mx-auto">
        <h1 class="text-slate-700 dark:text-slate-300 text-lg 2xl:text-xl">Search : {{ request('key') }}</h1>
    </div>
    @endif

    <!-- Members List Section -->
    <div class="mt-5 2xl:mt-10 max-w-[900px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden  rounded-2xl shadow-md ">

        <!-- user list row style -->
        <div id="rowDisplay" class="bg-[#f6f8fc] dark:bg-[#1E1F23] h-[500px] max-h-[700px] md:max-h-none 2xl:h-[700px] overflow-y-scroll p-2 md:p-3 2xl:p-10 flex flex-col gap-y-3 md:gap-y-5">

            @if (count($members) == 0 )
            <div class="flex justify-center items-center h-full text-red-500 text-lg lg:text-2xl ">
                There is no user yet!
            </div>
            @else
            @foreach ($members as $member)
            <div class="shadow-md dark:shadow-slate-900 px-2 py-1 md:p-3 border border-blue-300/50 dark:border-slate-700 rounded-xl justify-between flex gap-x-3 items-center">
                <div class="flex gap-x-1 md:gap-x-2 items-center">
                    <div class="">
                        <a @if (Auth::user()->id == $member->id)
                            href="{{ route('account#profilePage',$member->id) }}"
                            @else
                                href="{{ route('member#accountProfilePage',$member->id) }}"
                            @endif class="flex justify-center items-center w-9 lg:w-12 2xl:w-16 h-9 lg:h-12 2xl:h-16 cursor-pointer overflow-hidden rounded-full shadow-xl">
                            @if($member->image !== null)
                            <img class="w-full" id="previewImageForProfile" src="{{ asset('storage/'.$member->image) }}" alt="">
                            @else
                                 @if($member->gender == 'male')
                                 <img id="previewImageForProfile" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">
                                 @else
                                 <img  id="previewImageForProfile"src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">
                                 @endif
                            @endif
                        </a>
                    </div>
                    <div class="">
                        <a @if (Auth::user()->id == $member->id)
                            href="{{ route('account#profilePage',$member->id) }}"
                            @else
                                href="{{ route('member#accountProfilePage',$member->id) }}"
                            @endif  class="text-slate-700 ml-1 dark:text-slate-200 text-xs md:text-md 2xl:text-lg">
                            {{ $member->name }}
                        </a>
                        <h2 class="text-slate-500 dark:text-slate-400 text-xs ml-1 md:text-sm flex items-center gap-x-1 ">
                            <svg class="hidden md:inline text-red-400 w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5z"/></svg>
                            {{ $member->address }}
                        </h2>
                    </div>
                </div>
                <div class="parentNode flex items-center gap-x-4 md:gap-x-6">
                    <input id="userId" type="hidden" value="{{ $member->id }}">
                    <div class="flex items-center gap-x-2">

                        @if (Auth::user()->id != $member->id)
                            <a href="{{ route('member#accountProfilePage',$member->id) }}"  class="text-white bg-blue-400 hover:bg-blue-500 duration-300 rounded-full w-7 h-7 md:w-8 2xl:w-9 md:h-8 2xl:h-9 flex justify-center items-center shadow-md" title="Profile">
                                <svg class="w-4 h-4 md:w-5 md:h-5 2xl:w-6 2xl:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path stroke-linejoin="round" d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/><circle cx="12" cy="7" r="3"/></g></svg>
                            </a>
                        @else
                            <a  href="{{ route('member#accountProfilePage',$member->id) }}"  class=" text-white bg-blue-400 hover:bg-blue-500 duration-300 lg:mr-3 text-xs md:text-sm px-2 md:px-3 py-1 rounded-lg flex justify-center items-center shadow-md" title="Profile">
                                View Your Profile
                            </a>
                        @endif


                        {{-- message  --}}
                        @if (Auth::user()->id != $member->id)
                        <a href="{{ route('chat#messagePage',$member->id) }}"   class="text-white bg-violet-400 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-8 2xl:w-9 md:h-8 2xl:h-9 flex justify-center items-center shadow-md" title="Message">
                            <svg class="w-4 h-4 md:w-5 md:h-5 2xl:w-6 2xl:h-6" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.2L4 17.2V4h16v12m-3-5h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2"/></svg>
                        </a>
                        @endif

                        {{-- delete account  --}}
                        @if (Auth::user()->role == 'admin')
                        <a href="{{ route('member#deleteAccount',$member->id) }}"  class="text-white bg-red-400 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-8 2xl:w-9 md:h-8 2xl:h-9 flex justify-center items-center shadow-md" type="button" title="Delete">
                            <svg class="w-4 h-4 md:w-5 md:h-5 2xl:w-6 2xl:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>
                        </a>
                        @endif
                    </div>

                    {{-- Role change member to admin   --}}

                    {{-- Only admin can see  --}}
                    @if (Auth::user()->role == 'admin')
                    <select class="roleChange focus:outline-none focus:bg-blue-500 bg-blue-400 text-white px-2 md:px-3 py-1 rounded-xl shadow-md md:text-sm text-xs" name="" id="">
                        <option value="admin" @if ($member->role == 'admin') selected   @endif >Admin</option>
                        <option value="member" @if ($member->role == 'member') selected   @endif >Member</option>
                    </select>
                    @endif
                </div>
            </div>
            @endforeach
            @endif


        </div>

        <!--  -->

        <!-- user list with grid  -->
        <div id="gridDisplay" class="hidden bg-[#f6f8fc] dark:bg-[#1E1F23] h-[650px] md:h-[500px] max-h-[700px] md:max-h-nonem 2xl:h-[700px] overflow-y-scroll p-2 md:p-3 md:p-5 2xl:p-10">

            @if (count($members) == 0)
                <div class="flex justify-center items-center h-full text-red-500 text-2xl ">
                    There is no user yet!
                </div>
            @else
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 xl:gap-5 2xl:gap-8 w-full">
            <!-- card list  -->
            @foreach ($members as $member)
            <div class="border dark:shadow-slate-900 bg-slate-50 dark:bg-[#1E1F23] dark:border-slate-700 border-blue-300/50 shadow-md rounded-2xl text-center md:pt-5 px-0 p-4 2xl:p-8">
                <div class="flex justify-center">
                    <a @if (Auth::user()->id == $member->id)
                        href="{{ route('account#profilePage',$member->id) }}"
                        @else
                            href="{{ route('member#accountProfilePage',$member->id) }}"
                        @endif class="w-20 md:w-24 2xl:w-32 h-20 md:h-24 2xl:h-32 border-4 border-[#f6f8fc] dark:border-slate-500 cursor-pointer  overflow-hidden rounded-full shadow-md">
                        @if($member->image !== null)
                        <img class="w-full" id="previewImageForProfile" src="{{ asset('storage/'.$member->image) }}" alt="">
                        @else
                             @if($member->gender == 'male')
                             <img id="previewImageForProfile" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">
                             @else
                             <img  id="previewImageForProfile"src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">
                             @endif
                        @endif
                    </a>

                </div>
                <div class="mt-5 parentNode">
                    <input id="userId" type="hidden" value="{{ $member->id }}">
                    <div class="">
                        <a @if (Auth::user()->id == $member->id)
                            href="{{ route('account#profilePage',$member->id) }}"
                            @else
                                href="{{ route('member#accountProfilePage',$member->id) }}"
                            @endif class="text-slate-700 text-md md:text-lg dark:text-slate-200">
                            {{ $member->name }}
                        </a>
                        <h2 class="text-slate-500 dark:text-slate-300 text-xs md:text-sm flex items-center gap-x-1 justify-center text-center">
                            <svg class="text-red-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5z"/></svg>
                            {{ $member->address }}
                        </h2>
                    </div>
                    @if (Auth::user()->role == 'admin')
                    <select class="roleChange mt-3 md:mt-4 focus:outline-none focus:bg-blue-500 bg-blue-400 text-white px-3 py-1 rounded-xl shadow-lg text-xs md:text-sm " >
                        <option value="admin" @if ($member->role == 'admin') selected   @endif >Admin</option>
                        <option value="member" @if ($member->role == 'member') selected   @endif >Member</option>
                    </select>
                    @endif
                    <div class="flex justify-center items-center gap-x-2 md:gap-x-3 mt-3 md:mt-5">
                        {{-- account profile --}}

                        @if (Auth::user()->id == $member->id)
                        <a  href="{{ route('account#profilePage',Auth::user()->id) }}" class="mt-5 text-white bg-blue-400 hover:bg-blue-500 duration-300 text-xs md:text-sm px-3  md:px-5 py-2 rounded-lg flex justify-center items-center shadow-md" title="Profile">
                           View Your Profile
                        </a>
                        @else
                            <a href="{{ route('member#accountProfilePage',$member->id) }}"  class="text-white bg-blue-400 hover:bg-blue-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Profile">
                                <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path stroke-linejoin="round" d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/><circle cx="12" cy="7" r="3"/></g></svg>
                            </a>
                        @endif
                        {{-- message  --}}
                        @if (Auth::user()->id != $member->id)
                        <a  href="{{ route('chat#messagePage',$member->id) }}"  class="text-white bg-violet-400 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Message">
                                <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.2L4 17.2V4h16v12m-3-5h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2"/></svg>
                            </a>
                        @endif

                        {{-- delete account  --}}
                        @if (Auth::user()->role == 'admin')
                        <a  href="{{ route('member#deleteAccount',$member->id) }}" class="text-white bg-red-400 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" type="button" title="Delete">
                            <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
            @endif

        </div>
    </div>

</article>

@endsection


@section('script')
<script src="{{ asset('js/member.js') }}"></script>
<script>


    $(document).ready(function(){

        $('.roleChange').change(function(){

            $parentNode = $(this).parents('.parentNode')
            $userId = $parentNode.find('#userId').val();
            $roleChange = $(this).val()

            $.ajax({
                type  : 'get',
                data  :  {
                    "roleChange" : $roleChange,
                    "userId"    : $userId
                },
                url   : "/member/roleChange",
                dataType : 'json',
                success  : function(response){
                    if(response.status = true){
                        location.reload()
                    }
                }
            })
        })
    })

</script>

@endsection
