@extends('layout.master')

@section('title' ,'Viewer Lists')

@section('current_page')
<div class="flex items-center">
    <svg class="w-8 h-8 2xl:w-9 2xl:h-9 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M402 168c-2.93 40.67-33.1 72-66 72s-63.12-31.32-66-72c-3-42.31 26.37-72 66-72s69 30.46 66 72Z"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M336 304c-65.17 0-127.84 32.37-143.54 95.41c-2.08 8.34 3.15 16.59 11.72 16.59h263.65c8.57 0 13.77-8.25 11.72-16.59C463.85 335.36 401.18 304 336 304Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M200 185.94c-2.34 32.48-26.72 58.06-53 58.06s-50.7-25.57-53-58.06C91.61 152.15 115.34 128 147 128s55.39 24.77 53 57.94Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M206 306c-18.05-8.27-37.93-11.45-59-11.45c-52 0-102.1 25.85-114.65 76.2c-1.65 6.66 2.53 13.25 9.37 13.25H154"/></svg>
    <span class="ms-1 md:ms-2 mt-1 text-md md:text-xl">Viewers <span class="hidden md:inline">'Lists</span></span>
</div>
@endsection


@section('content')
<!-- Content  -->
<article  class="w-full md:w-[70%] md:mx-auto mt-10 md:mt-0  px-3 md:px-5 lg:px-0">

    <!-- users List Section -->
    <div class="2xl:mt-10 max-w-[850px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden  rounded-2xl shadow-lg ">


        <!-- user list -->
        <div id="rowDisplay" class="bg-[#f6f8fc] dark:bg-[#1E1F23] h-[700px] md:h-[500px] max-h-[700px] md:max-h-none
        2xl:h-[700px] overflow-y-scroll p-3 md:p-10 flex flex-col gap-y-3 md:gap-y-5">

            @if (count($viewers) == 0 )
            <div class="flex justify-center items-center h-full text-red-500 text-2xl ">
                There is no reacted person yet!
            </div>
            @else
            @foreach ($viewers as $viewer)
                <div class="shadow-lg dark:shadow-slate-900 p-3 border border-blue-300/50 dark:border-slate-700 rounded-xl justify-between flex gap-x-3 items-center">
                    <div class="flex gap-x-1 md:gap-x-2 items-center">
                        <div class="">
                            <div class="md:w-16 w-12 h-12 cursor-pointer md:h-16 overflow-hidden rounded-full shadow-xl">
                                @if($viewer->user_image !== null)
                                <img class="w-full" id="previewImageForProfile" src="{{ asset('storage/'.$viewer->user_image) }}" alt="">
                                @else
                                     @if($viewer->user_gender == 'male')
                                     <img id="previewImageForProfile" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">
                                     @else
                                     <img  id="previewImageForProfile"src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">
                                     @endif
                                @endif
                            </div>
                        </div>
                        <div class="">
                            <h1 class="text-slate-700 ml-1 dark:text-slate-200 text-xs md:text-md">
                                {{ $viewer->user_name }}
                            </h1>
                            <h2 class="text-slate-500 dark:text-slate-400 text-xs ml-1 md:text-sm flex items-center gap-x-1 ">
                                <svg class="hidden md:inline text-red-400 w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5z"/></svg>
                                {{ $viewer->user_address }}
                            </h2>
                        </div>
                    </div>
                    <div class="flex items-center gap-x-4 md:gap-x-6">
                        <div class="flex items-center gap-x-2">
                            @if (Auth::user()->id == $viewer->user_id)
                            <a  href="{{ route('member#accountProfilePage',$viewer->user_id) }}"  class=" text-white bg-blue-400 hover:bg-blue-500 duration-300 text-xs md:text-sm px-2 py-1 md:px-3 md:py-2 rounded-lg flex justify-center items-center shadow-md" title="Profile">
                                View <span class="hidden md:inline">Your</span> Profile
                            </a>
                            @else
                            <a href="{{ route('member#accountProfilePage',$viewer->user_id) }}"  class="text-white bg-blue-400 hover:bg-blue-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Profile">
                                <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2"><path stroke-linejoin="round" d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/><circle cx="12" cy="7" r="3"/></g></svg>
                            </a>
                            @endif

                            @if (Auth::user()->id != $viewer->user_id)
                            <a href="{{ route('chat#messagePage',$viewer->user_id) }}"  class="text-white bg-violet-400 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Message">
                                <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.2L4 17.2V4h16v12m-3-5h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2"/></svg>
                            </a>
                            @endif

                            {{-- User ROle  --}}
                            @if (Auth::user()->id != $viewer->user_id)
                                <div class=" bg-blue-400 text-white px-2 md:px-5 py-2 rounded-xl shadow-lg md:text-sm text-xs">
                                    @if ($viewer->user_role == 'admin')
                                    Admin
                                    @else
                                    Member
                                    @endif
                                </div>
                            @endif

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
<script src="{{ asset('js/user.js') }}"></script>

@endsection
