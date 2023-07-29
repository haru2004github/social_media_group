@extends('layout.master')

@section('title' ,'Password')

@section('current_page')
<div class="flex items-center">
    <svg class="w-6 h-6 2xl:w-11 2xl:h-11 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.413-.588T4 20V10q0-.825.588-1.413T6 8h1V6q0-2.075 1.463-3.538T12 1q2.075 0 3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.588 1.413T18 22H6Zm0-2h12V10H6v10Zm6-3q.825 0 1.413-.588T14 15q0-.825-.588-1.413T12 13q-.825 0-1.413.588T10 15q0 .825.588 1.413T12 17ZM9 8h6V6q0-1.25-.875-2.125T12 3q-1.25 0-2.125.875T9 6v2ZM6 20V10v10Z"/></svg>
    <span class="ms-2 mt-1 text-md md:text-xl">Password <span class="hidden md:inline">And Privacy</span></span>
</div>
@endsection

@section('content')
 <!-- Content  -->
 <article  class=" mt-10 md:mt-0 w-full md:w-[70%] md:mx-auto md:h-[84vh] md:overflow-y-scroll ">

    <!-- Group Chat Sectoion -->
    <div class=" max-w-[1200px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden  rounded-2xl shadow-lg md:mb-20 ">
        <!-- Group chat section  -->
        <div class="max-w-6xl grid md:grid-cols-2 items-center border border-blue-300/20 rounded-2xl shadow-lg overflow-hidden">
            <div>
                <div class="flex justify-center items-center p-5 md:p-10 drop-shadow-xl">
                    <img class="w-full" src="{{ asset('img/password.png') }}" alt="">
                </div>
            </div>
            <!-- register section  -->
            <div class="p-3 md:p-12 md:pl-10">
                <h1 class="text-blue-500 text-xl md:text-3xl font-bold">Welcome Back!</h1>
                <h3 class="text-slate-600 mt-3 dark:text-slate-300">
                    Are you sure to change your password!
                </h3>
                <form class="mt-6 md:mt-10" action="{{ route('account#passwordChange') }}" method="POST">
                    @csrf
                    <div class="">
                        <label class="text-slate-600 dark:text-slate-300 text-sm md:text-md" for="oldPassword">Old Password</label><br>

                        <div class="flex items-center gap-x-2">
                            <input name="oldPassword" id="oldPassword" class="w-full text-sm md:text-md dark:bg-[#27282F] dark:border-slate-700 focus:outline-none text-slate-700 rounded-lg md:rounded-xl dark:text-slate-300 border border-slate-300 shadow-md md:shadow-lg px-3 md:px-5 py-1 md:py-2" type="password" placeholder="Enter Your Old Password...">
                            <button id="showOldPassword" type="button" onclick="showPass('oldPassword','showOldPassword')" for="passwordShow" class="cursor-pointer w-10 h-10 flex justify-center items-center shadow-md rounded-xl bg-blue-400 hover:bg-blue-500 duration-300 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962Z"/><circle cx="12" cy="12" r="3"/></g></svg>
                            </button>

                        </div>
                    </div>
                    @error('oldPassword')
                    <div class="relative mt-3 md:mt-5">
                        <small class="absolute bottom-0 left-0 text-red-500">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror
                    <div class="mt-3 md:mt-8">
                        <label class="text-slate-600 dark:text-slate-300 text-sm md:text-md" for="newPassword">New Password</label><br>

                        <div class="flex items-center gap-x-2">
                            <input name="newPassword" id="newPassword" class="w-full text-sm md:text-md dark:bg-[#27282F] dark:border-slate-700 focus:outline-none text-slate-700 rounded-lg md:rounded-xl dark:text-slate-300 border border-slate-300 shadow-md md:shadow-lg px-3 md:px-5 py-1 md:py-2" type="password" placeholder="Enter Your New Password">
                            <button id="showNewPassword" type="button" onclick="showPass('newPassword','showNewPassword')" for="passwordShow" class="cursor-pointer w-10 h-10 flex justify-center items-center shadow-md rounded-xl bg-blue-400 hover:bg-blue-500 duration-300 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962Z"/><circle cx="12" cy="12" r="3"/></g></svg>
                            </button>

                        </div>
                    </div>
                    @error('newPassword')
                    <div class="relative mt-3 md:mt-5">
                        <small class="absolute bottom-0 left-0 text-red-500">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror
                    <div class="mt-3 md:mt-8">
                        <label class="text-slate-600 dark:text-slate-300 text-sm md:text-md" for="confirmPassword">Confirm Password</label><br>

                        <div class="flex items-center gap-x-2">
                            <input name="confirmPassword" id="confirmPassword" class="w-full text-sm md:text-md dark:bg-[#27282F] dark:border-slate-700 focus:outline-none text-slate-700 rounded-lg md:rounded-xl dark:text-slate-300 border border-slate-300 shadow-md md:shadow-lg px-3 md:px-5 py-1 md:py-2" type="password" placeholder="Enter Your Confirm Password">
                            <button id="showConfirmPassword" type="button" onclick="showPass('confirmPassword','showConfirmPassword')" for="passwordShow" class="cursor-pointer w-10 h-10 flex justify-center items-center shadow-md rounded-xl bg-blue-400 hover:bg-blue-500 duration-300 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962Z"/><circle cx="12" cy="12" r="3"/></g></svg>
                            </button>

                        </div>
                    </div>
                    @error('confirmPassword')
                    <div class="relative mt-3 md:mt-5">
                        <small class="absolute bottom-0 left-0 text-red-500">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror
                    <div class="mt-5 md:mt-10">
                        <button class="w-full text-white bg-blue-500 hover:bg-blue-400 duration-300 rounded-lg md:rounded-xl text-sm md:text-md shadow-lg md:shadow-xl py-2 md:py-3">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
            <!--  -->
        </div>

    </div>
</article>
@endsection


@section('script')
<script src="{{ asset('js/auth.js') }}"></script>
@endsection
