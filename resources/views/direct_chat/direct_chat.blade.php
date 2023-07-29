@extends('layout.master')

@section('title' ,'Chat')

@section('current_page')
<div class="flex items-center gap-x-5">
    <div class="flex items-center">
        <svg class="w-8 h-8 2xl:w-11 2xl:h-11 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9h-1.5ZM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75v-1.5ZM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9h1.5ZM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25v1.5ZM5.166 17.856l-.719-.214l-.117.392l.267.31l.569-.488Zm13.668 0l.57.489l.266-.31l-.117-.393l-.719.214ZM9 15.75h6v-1.5H9v1.5Zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75v-1.5Zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75v-1.5Zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25v1.5Zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405l-1.138-.977Z"/></g></svg>
        <span class="ms-2 mt-1 text-md md:text-xl">Chat</span>
    </div>
</div>
@endsection
@section('content')
<!-- Content  -->
<article  class="mt-10 md:mt-0 w-full md:w-[70%] md:mx-auto md:h-[84vh] md:overflow-y-scroll md:px-5 lg:px-0">

    <!--Chat Sectoion -->
    <div class=" max-w-[800px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden  rounded-2xl shadow-md 2xl:mb-20 ">

        <!--  chat section  -->
        <div class="bg-[#f6f8fc] dark:bg-slate-900">
            <div class="relative">
                <div class="flex justify-between items-center bg-[#fafafa] dark:bg-[#1E1F23] border-b border-slate-300 dark:border-slate-700 p-3 md:p-5 md:px-10  shadow-lg">
                    <a href="{{ route('member#accountProfilePage',$chatPerson->id) }}" class="flex items-center gap-x-3">
                        <div class="w-9 lg:w-12 2xl:w-16 h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full border-b border-slate-300">
                            @if($chatPerson->image !== null)
                            <img class="w-full" id="previewImageForProfile" src="{{ asset('storage/'.$chatPerson->image) }}" alt="">
                            @else
                                 @if($chatPerson->gender == 'male')
                                 <img class="w-full" id="previewImageForProfile" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">
                                 @else
                                 <img class="w-full"  id="previewImageForProfile"src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">
                                 @endif
                            @endif
                        </div>
                        <span class="text-slate-700 dark:text-slate-200 text-md md:text-lg lg:text-xl">
                            {{ $chatPerson->name }}
                        </span>
                    </a>

                </div>
                <div id="modal" class="flex justify-end absolute z-20 right-0 opacity-0 duration-500 pointer-events-none">
                    <div class="rounded-md overflow-hidden border-slate-300 bg-slate-400 py-3 shadow-lg">
                        <div class="text-white">
                            <button id="createBackBtn" onclick="toggleBackground()" class="w-[200px] px-5 py-2 bg-slate-400 hover:bg-slate-500 duration-300">
                                Create Background
                             </button>
                            @if (Auth::user()->role == 'admin')
                            <a href="" class="block w-[200px] px-5 py-2 bg-slate-400 hover:bg-slate-500 duration-300">
                                Clear All Messages
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div id="chatBackground" class="chat-container p-5 md:px-10 md:py-8 h-[600px] md:h-[500px] 2xl:h-[550px] overflow-y-scroll dark:bg-slate-900">

                @if (count($chatMessages) == 0)
                <div class="flex justify-center items-center h-full text-slate-700 dark:text-slate-200 ">
                    <div class="">
                        <div class="flex justify-center">
                            <div class="w-[100px] lg:w-[400px] h-[100px] md:w-[150px] md:h-[150px] 2xl:w-[200px] 2xl:h-[200px] rounded-full shadow-lg overflow-hidden">
                                @if($chatPerson->image !== null)
                                <img class="w-full" id="previewImageForProfile" src="{{ asset('storage/'.$chatPerson->image) }}" alt="">
                                @else
                                     @if($chatPerson->gender == 'male')
                                     <img class="w-full h-full object-cover object-center" id="previewImageForProfile" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">
                                     @else
                                     <img class="w-full h-full object-cover object-center"  id="previewImageForProfile"src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">
                                     @endif
                                @endif
                            </div>
                        </div>
                        <h1 class="text-slate-700 dark:text-slate-300 text-lg text-center mt-3">
                            {{ $chatPerson->name }}
                        </h1>
                        <h2 class="text-slate-600 dark:text-slate-400 text-md text-center">
                            {{ $chatPerson->address }}
                        </h2>
                        <div class="mt-5 flex justify-center">
                            <a href="{{ route('member#accountProfilePage',$chatPerson->id) }}" class="text-white bg-blue-400 hover:bg-blue-500 duration-300 dark:bg-blue-500 dark:hover:bg-blue-600 px-2 py-1 md:px-4 md:py-2 2xl:px-5 2xl:py-2 rounded-xl shadow-lg">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
                @else
                <div class="chat-messages">

                    @foreach ($chatMessages as $chat)

                    @if (Auth::user()->id == $chat->sender_id)

                    <!-- //for me  -->

                    {{-- for  only message --}}
                    @if ($chat->message !== null && $chat->image == null)
                    <div id="" class="parentMessage flex flex-row-reverse mt-4 md:mt-6">
                        <div class="">
                            <div class="flex justify-center">
                                <a href="{{ route('account#profilePage',Auth::user()->id) }}" class="block w-9 lg:w-12 2xl:w-16 cursor-pointer h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full shadow-md">
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
                        </div>

                        <form class="md:flex items-center " action="{{ route('chat#editMyMessage',$chat->id) }}" method="POST">
                            @csrf
                            <div id="" class="option parentEditBtn opacity-0 pointer-events-none flex items-center gap-x-1 md:mt-10 mr-2">
                                <button type="button"  class="messageShowInput scale-90 text-white bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Edit">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6V19ZM19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM4 21q-.425 0-.713-.288T3 20v-2.825q0-.2.075-.388t.225-.337l10.3-10.3l4.25 4.25l-10.3 10.3q-.15.15-.337.225T6.825 21H4ZM14.325 9.675l-.7-.7l1.4 1.4l-.7-.7Z"/></svg>
                                </button>
                                <button type4="submit"  class="editBtn scale-90 hidden text-white bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9  justify-center items-center shadow-md" title="Update">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 21c-1.654 0-3-1.346-3-3v-4.764c-1.143 1.024-3.025.979-4.121-.115a3.002 3.002 0 0 1 0-4.242L12 1.758l7.121 7.121a3.002 3.002 0 0 1 0 4.242c-1.094 1.095-2.979 1.14-4.121.115V18c0 1.654-1.346 3-3 3zM11 8.414V18a1.001 1.001 0 0 0 2 0V8.414l3.293 3.293a1.023 1.023 0 0 0 1.414 0a.999.999 0 0 0 0-1.414L12 4.586l-5.707 5.707a.999.999 0 0 0 0 1.414a1.023 1.023 0 0 0 1.414 0L11 8.414z"/></svg>
                                </button>
                                <a href="{{ route('chat#deleteMyMessage',$chat->id) }}" class="deleteBtn text-white scale-90 bg-red-400 dark:bg-red-500 dark:hover:bg-red-600 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" type="button" title="Delete">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>
                                </a>
                                <button type="button"class="cancelBtn scale-90 text-white bg-red-400 dark:bg-red-500 dark:hover:bg-red-600 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" type="button" title="Cancel">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243"/></svg>
                                </button>
                            </div>
                            <div id="" class="messageContent">
                                <p class="box-border bg-white dark:bg-slate-800 dark:text-slate-300 dark:border-slate-700 p-3 2xl:p-5 py-1 2xl:py-2 text-slate-700 rounded-3xl rounded-tr-none shadow-md border border-slate-300 mt-2 md:mt-10 mr-2 max-w-[250px] lg:max-w-lg text-sm md:text-md">
                                    <span class="block messageText">
                                        {{ $chat->message }}
                                    </span>
                                    <input required name="message" type="text" class="messageEdit w-[200px] lg:w-[400px] hidden  rounded-lg shadow-inner border border-slate-300 dark:border-slate-700 dark:bg-slate-900 px-3 py-1 focus:outline-none text-sm md:text-md" value="{{ $chat->message }}">
                                    <input  name="receiverId" type="hidden" value="{{ $chat->receiver_id }}">
                                </p>
                                <div class="">
                                    <span class=" dark:text-slate-300 text-slate-700 ml-2 text-xs               ">
                                        {{ $chat->created_at->format('F d \a\t h:i A') }}
                                    </span>
                                </div>
                            </div>
                        </form>


                    </div>
                    @endif

                    {{-- for only image  --}}
                    @if ($chat->image !== null && $chat->message == null)
                    <div id="" class="parentImage flex flex-row-reverse mt-4 md:mt-6 ">
                        <div class="">
                            <a href="{{ route('member#accountProfilePage',Auth::user()->id) }}" class="block w-9 lg:w-12 2xl:w-16 cursor-pointer h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full shadow-md">
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

                        <form action="{{ route('chat#editMyImage',$chat->id) }}" method="POST" class="flex items-center flex-row-reverse" enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <div class="messageImage max-w-[200px] lg:max-w-[250px] 2xl:max-w-[300px] overflow-hidden rounded-xl rounded-tr-none shadow-md t-10 mr-2 mt-10">
                                    <img id="previewEditImage" src="{{ asset('storage/'.$chat->image) }}" alt="">
                                </div>
                                <div class="">
                                    <span class=" dark:text-slate-300 text-slate-700 text-xs               ">
                                        {{ $chat->created_at->format('F d \a\t h:i A') }}
                                    </span>
                                </div>
                            </div>
                            <div id="" class="option parentEditBtn opacity-0 pointer-events-none flex items-center gap-x-1 mt-10 mr-2">
                                <button type="button"  class="showEditImage scale-90 text-white bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Edit">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6V19ZM19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM4 21q-.425 0-.713-.288T3 20v-2.825q0-.2.075-.388t.225-.337l10.3-10.3l4.25 4.25l-10.3 10.3q-.15.15-.337.225T6.825 21H4ZM14.325 9.675l-.7-.7l1.4 1.4l-.7-.7Z"/></svg>
                                </button>

                                {{-- image choose file  --}}
                                <button type="button" class="hidden chooseImageBtn">
                                    <label for="fileForEditImage" class= "w-7 h-7 md:w-9 md:h-9 cursor-pointer shadow-md rounded-lg hover:bg-violet-500 duration-300 bg-violet-400 text-white flex justify-center items-center">
                                        <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                                    </label>
                                    <input onchange="previewFileForEditImage()" type="file" class="hidden" name="image" id="fileForEditImage" accept="image/*">
                                    <input  name="receiverId" type="hidden" value="{{ $chat->receiver_id }}">
                                </button>

                                {{-- upload image btn  --}}
                                <button type="submit"  class="uploadImageBtn scale-90 hidden text-white bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9  justify-center items-center shadow-md" title="Update">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 21c-1.654 0-3-1.346-3-3v-4.764c-1.143 1.024-3.025.979-4.121-.115a3.002 3.002 0 0 1 0-4.242L12 1.758l7.121 7.121a3.002 3.002 0 0 1 0 4.242c-1.094 1.095-2.979 1.14-4.121.115V18c0 1.654-1.346 3-3 3zM11 8.414V18a1.001 1.001 0 0 0 2 0V8.414l3.293 3.293a1.023 1.023 0 0 0 1.414 0a.999.999 0 0 0 0-1.414L12 4.586l-5.707 5.707a.999.999 0 0 0 0 1.414a1.023 1.023 0 0 0 1.414 0L11 8.414z"/></svg>
                                </button>

                                {{-- delte image btn  --}}
                                <a href="{{ route('chat#deleteMyImage',$chat->id) }}" class="deleteBtn text-white scale-90 bg-red-400 dark:bg-red-500 dark:hover:bg-red-600 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" type="button" title="Delete">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>
                                </a>

                                {{-- close option btn  --}}
                                <button type="button" class="cancelBtnForImage scale-90 text-white bg-red-400 dark:bg-red-500 dark:hover:bg-red-600 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" type="button" title="Cancel">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243"/></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    {{-- for both message and image  --}}
                    @if ($chat->image !== null && $chat->message !== null)
                    <div id="" class="parentImageAndMessage flex flex-row-reverse mt-4 md:mt-6">
                        <div class="">
                            <a href="{{ route('member#accountProfilePage',Auth::user()->id) }}"class="block w-9 lg:w-12 2xl:w-16 cursor-pointer h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full shadow-md">
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

                        <form action="{{ route('chat#editBothMessageAndImage',$chat->id) }}" method="POST" enctype="multipart/form-data" class="flex items-center flex-row-reverse">
                            @csrf
                            <div class="">
                                <div class="bothContentAndImageMessage bg-white dark:bg-slate-800 dark:text-slate-300 dark:border-slate-700  text-slate-700 rounded-3xl rounded-tr-none shadow-md border border-slate-300 mt-10 mr-2 max-w-lg overflow-hidden">
                                    <h1 class="text-white bg-blue-500 p-3 text-sm md:text-md md:p-5 md:py-3 max-w-[250px] 2xl:max-w-[300px]">
                                        <span class="block messageText">
                                            {{ $chat->message }}
                                        </span>
                                        <textarea required name="message" type="text" class="messageEdit text-sm md:text-md w-full hidden  rounded-lg shadow-inner border border-slate-30 bg-blue-600 px-3 py-1 focus:outline-none" value="" rows="2">{{ $chat->message }}</textarea>
                                        <input  name="receiverId" type="hidden" value="{{ $chat->receiver_id }}">
                                    </h1>
                                    <div class="">
                                        <div class="max-w-[250px] 2xl:max-w-[300px] overflow-hidden rounded-xl rounded-t-none shadow-md">
                                            <img id="previewEditMessageAndImage" class="w-full" src="{{ asset('storage/'.$chat->image) }}" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <span class=" dark:text-slate-300 text-slate-700 text-xs               ">
                                        {{ $chat->created_at->format('F d \a\t h:i A') }}
                                    </span>
                                </div>
                            </div>
                            <div id="" class="option parentEditBtn opacity-0 pointer-events-none flex items-center gap-x-1 mt-10 mr-2">

                                {{-- Edit image and content btn  --}}
                                <button type="button"  class="showEditImageAndContent scale-90 text-white bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" title="Edit">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6V19ZM19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM4 21q-.425 0-.713-.288T3 20v-2.825q0-.2.075-.388t.225-.337l10.3-10.3l4.25 4.25l-10.3 10.3q-.15.15-.337.225T6.825 21H4ZM14.325 9.675l-.7-.7l1.4 1.4l-.7-.7Z"/></svg>
                                </button>

                                {{-- image choose file  --}}
                                <button type="button" class="hidden chooseImageBtn">
                                    <label for="fileForEditMessageAndImage" class= "w-7 h-7 md:w-9 md:h-9 cursor-pointer shadow-md rounded-lg hover:bg-violet-500 duration-300 bg-violet-400 text-white flex justify-center items-center">
                                        <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                                    </label>
                                    <input onchange="previewFileForEditMessageAndImage()" type="file" class="hidden" name="image" id="fileForEditMessageAndImage" accept="image/*">
                                    <input  name="user_id" type="hidden" value="{{ $chat->user_id }}">
                                </button>

                                {{-- upload image btn  --}}
                                <button type="submit"  class="uploadImageBtn scale-90 hidden text-white bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9  justify-center items-center shadow-md" title="Update">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 21c-1.654 0-3-1.346-3-3v-4.764c-1.143 1.024-3.025.979-4.121-.115a3.002 3.002 0 0 1 0-4.242L12 1.758l7.121 7.121a3.002 3.002 0 0 1 0 4.242c-1.094 1.095-2.979 1.14-4.121.115V18c0 1.654-1.346 3-3 3zM11 8.414V18a1.001 1.001 0 0 0 2 0V8.414l3.293 3.293a1.023 1.023 0 0 0 1.414 0a.999.999 0 0 0 0-1.414L12 4.586l-5.707 5.707a.999.999 0 0 0 0 1.414a1.023 1.023 0 0 0 1.414 0L11 8.414z"/></svg>
                                </button>

                                {{-- delte image btn  --}}
                                <a href="{{ route('chat#deleteMyImage',$chat->id) }}" class="deleteBtn text-white scale-90 bg-red-400 dark:bg-red-500 dark:hover:bg-red-600 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" type="button" title="Delete">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>
                                </a>

                                {{-- close option btn  --}}
                                <button type="button"  class="cancelBtnForBothImageAndContent scale-90 text-white bg-red-400 dark:bg-red-500 dark:hover:bg-red-600 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-9 md:h-9 flex justify-center items-center shadow-md" type="button" title="Cancel">
                                    <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243"/></svg>
                                </button>
                            </div>
                        </form>

                    </div>
                    @endif
                    @else

                    {{-- //for other user  --}}

                    {{-- for only message  --}}
                    @if ($chat->message !== null && $chat->image == null)
                    <div id="" class="flex mt-4 md:mt-6">
                        <div class="">
                            <a href="{{ route('member#accountProfilePage',$chatPerson->id) }}"class="block w-9 lg:w-12 2xl:w-16 cursor-pointer h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full shadow-md">
                                @if($chatPerson->image == null)

                                @if($chatPerson->gender == 'male')
                                <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                @else
                                <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                @endif
                                @else
                                <img class="w-full" src="{{ asset('storage/'.$chatPerson->image) }}">
                                @endif
                            </a>
                        </div>
                        <div class="">
                            <p class=" bg-white dark:bg-slate-800 dark:text-slate-300 dark:border-slate-700 p-3 2xl:p-5 text-slate-700 rounded-3xl rounded-tl-none shadow-md border text-sm md:text-md border-slate-300 mt-4 md:mt-6 2xl:mt-10 ml-2 max-w-lg">
                                {{ $chat->message }}
                            </p>
                            <div class="">
                                <span class=" dark:text-slate-300 text-slate-700 text-xs               ">
                                    {{ $chat->created_at->format('F d \a\t h:i A') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif


                    {{-- for only image  --}}
                    @if ($chat->image !== null && $chat->message == null)
                    <div id="" class=" flex mt-4 md:mt-6  ">

                        <div class="">
                            <a href="{{ route('member#accountProfilePage',$chatPerson->id) }}" class="block w-9 lg:w-12 2xl:w-16 cursor-pointer h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full shadow-md">
                                @if($chatPerson->image == null)

                                @if($chatPerson->gender == 'male')
                                <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                @else
                                <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                @endif
                                @else
                                <img class="w-full" src="{{ asset('storage/'.$chatPerson->image) }}">
                                @endif
                            </a>
                        </div>
                        <div class="">
                            <div class= "max-w-[200px] lg:max-w-[250px] 2xl:max-w-[300px] overflow-hidden rounded-xl shadow-md mt-10">
                                <img src="{{ asset('storage/'.$chat->image) }}" alt="">
                            </div>
                            <div class="">
                                <span class=" dark:text-slate-300 text-slate-700 text-xs               ">
                                    {{ $chat->created_at->format('F d \a\t h:i A') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif


                    {{-- for both image and message  --}}

                    @if ($chat->image !== null && $chat->message !== null)
                    <div id="" class=" flex mt-4 md:mt-6">
                        <div class="">
                            <a href="{{ route('member#accountProfilePage',$chatPerson->id) }}"  class="block w-9 lg:w-12 2xl:w-16 cursor-pointer h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full shadow-md">
                                @if($chatPerson->image == null)

                                @if($chatPerson->gender == 'male')
                                <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                @else
                                <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                @endif
                                @else
                                <img class="w-full" src="{{ asset('storage/'.$chatPerson->image) }}">
                                @endif
                            </a>
                        </div>
                        <div class="">
                            <div class=" bg-white dark:bg-slate-800 dark:text-slate-300 dark:border-slate-700  text-slate-700 rounded-3xl rounded-tl-none shadow-md border border-slate-300 mt-10 mr-2 max-w-lg overflow-hidden">
                                <h1 class="text-white bg-blue-500 text-sm md:text-md p-3 2xl:p-5 py-1 2xl:py-2 max-w-[200px] lg:max-w-[250px] 2xl:max-w-[300px]">
                                    {{ $chat->message }}
                                </h1>
                                <div class="">
                                    <div class="max-w-[200px] lg:max-w-[250px] 2xl:max-w-[300px] overflow-hidden rounded-xl rounded-t-none shadow-md">
                                        <img src="{{ asset('storage/'.$chat->image) }}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <span class=" dark:text-slate-300 text-slate-700 text-xs               ">
                                    {{ $chat->created_at->format('F d \a\t h:i A') }}
                                </span>
                            </div>
                        </div>

                    </div>
                    @endif

                    @endif

                    @endforeach
                </div>
                @endif

            </div>


            <div class="p-3 2xl:p-5 2xl:px-10 shadow-md bg-[#fafafa] dark:bg-[#1E1F23] border-t border-slate-300 dark:border-slate-700">
                {{-- //session --}}
                @if (session('message'))
                <h1 class="text-center text-red-500 ">
                    {{ session('message') }}
                </h1>
                @endif

                <form action="{{ route('chat#sendMessage') }}"  method="POST" class="mt-3 flex items-center gap-x-3" enctype="multipart/form-data">
                    @csrf
                    <div class="w-full">
                        <input name='message' class="chatInput focus:outline-none w-full dark:bg-[#27282F] dark:border-slate-700 dark:text-slate-400 bg-[#f6f8fc] text-slate-700 2xl:text-md text-sm px-3 2xl:px-5 py-2 rounded-2xl shadow-md border border-slate-300 " type="text" placeholder="White a message...">
                        <input name="receiverId" type="hidden" value="{{ $chatPerson->id }}">
                    </div>
                    <div class="flex items-center gap-x-2">
                        <button type="button">
                            <label for="file" class="w-9 2xl:w-10 h-9 2xl:h-10 cursor-pointer shadow-md rounded-lg hover:bg-violet-500 duration-300 bg-violet-400 text-white flex justify-center items-center">
                                <svg class="w-6 h-6 md:w-8 md:h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="16" cy="8" r="2"/><path stroke-linecap="round" d="m2 12.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 18.5"/><path stroke-linecap="round" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2c4.714 0 7.071 0 8.535 1.464c.974.974 1.3 2.343 1.41 4.536"/></g></svg>
                            </label>
                            <input onchange="previewFile()" type="file" class="chatInput hidden" name="image" id="file" accept="image/*">
                        </button>
                        <button class="sendBtn w-9 md:w-10 h-9 md:h-10 bg-blue-400 text-white hover:bg-blue-500 duration-300 flex justify-center items-center rounded-full shadow-md border-slate-300" disabled>
                            <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M2.01 21L23 12L2.01 3L2 10l15 2l-15 2z"/></svg>
                        </button>
                    </div>
                </form>



                <!-- Preview image modal  -->
                <div class="mt-3 2xl:mt-5">
                    <div class="overflow-hidden w-[120px] rounded-xl shadow-md">
                        <img class="w-full" id="previewImage" src="" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>

</article>





@endsection


@section('script')
<script src="{{ asset('js/direct_chat.js') }}"></script>


@endsection
