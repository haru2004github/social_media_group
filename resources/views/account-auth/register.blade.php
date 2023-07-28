@extends('account-auth.layout.master')

@section("title" , "Register")

@section('content')
<section class="max-w-6xl h-screen w-full lg:w-auto lg:h-auto flex justify-center items-center border border-blue-500/20 rounded-2xl shadow-lg overflow-hidden p-3 md:p-5 lg:p-10">

    {{-- register section  --}}
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="text-center">
            <h1 class="text-blue-500 text-2xl md:text-3xl font-bold">Get Started</h1>
            <h3 class="text-sm md:text-md text-slate-600 mt-1 md:mt-3">
                Create your account now!
            </h3>
        </div>
        <article class="grid grid-cols-2 lg:min-w-[650px] mt-5 md:mt-10 gap-x-4 lg:gap-x-10">
            <div class="">
                <div class="">
                    <label class="text-sm md:text-md text-slate-600" for="name">Name</label><br>
                    <input name="name" id="name" class="w-full focus:outline-none text-slate-700 rounded-lg border border-slate-300 shadow-lg px-2 py-1 text-sm lg:text-md lg:px-5 lg:py-2" type="text" value="{{ old('name') }}" placeholder="Enter Your Name...">
                    @error('name')
                    <div class="relative">
                        <small class="absolute botoom-0 left-0 text-red-500 text-xs md:text-sm ml-1">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror

                </div>
                <div class="mt-6 md:mt-8">
                    <label class="text-sm md:text-md text-slate-600" for="address">Address</label><br>
                    <input name="address" id="address" class="w-full focus:outline-none text-slate-700 rounded-lg border border-slate-300 shadow-lg px-2 py-1 text-sm lg:text-md lg:px-5 lg:py-2" type="text" value="{{ old('address') }}" placeholder="Enter Your Address">
                    @error('address')
                    <div class="relative">
                        <small class="absolute botoom-0 left-0 text-red-500 text-xs md:text-sm ml-1">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror
                </div>
                <div class="mt-6 md:mt-8">
                    <label class="text-sm md:text-md text-slate-600" for="job">Job</label><br>
                    <input name="job" id="job" class="w-full focus:outline-none text-slate-700 rounded-lg border border-slate-300 shadow-lg px-2 py-1 text-sm lg:text-md lg:px-5 lg:py-2" type="text" value="{{ old('job') }}" placeholder="Enter Your Job..">
                    @error('job')
                    <div class="relative">
                        <small class="absolute botoom-0 left-0 text-red-500 text-xs md:text-sm ml-1">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="">
                <div class="">
                    <label class="text-sm md:text-md text-slate-600" for="email">Email</label><br>
                    <input name="email" id="email" class="w-full focus:outline-none text-slate-700 rounded-lg border border-slate-300 shadow-lg px-2 py-1 text-sm lg:text-md lg:px-5 lg:py-2" type="email" value="{{ old('email') }}" placeholder="Enter Your Email...">
                    @error('email')
                    <div class="relative">
                        <small class="absolute botoom-0 left-0 text-red-500 text-xs md:text-sm ml-1">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror

                </div>
                <div class="mt-6 md:mt-8">
                    <label class="text-sm md:text-md text-slate-600" for="phone">Phone</label><br>
                    <input name="phone" id="phone" class="w-full focus:outline-none text-slate-700 rounded-lg border border-slate-300 shadow-lg px-2 py-1 text-sm lg:text-md lg:px-5 lg:py-2" type="number" value="{{ old('phone') }}" placeholder="Enter Your Phone Start with 09...">
                    @error('phone')
                    <div class="relative">
                        <small class="absolute botoom-0 left-0 text-red-500 text-xs md:text-sm ml-1">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror
                </div>
                <div class="mt-6 md:mt-8">
                    <label class="text-sm md:text-md text-slate-600" for="gender">Gender</label><br>
                    <select class="w-full focus:outline-none text-slate-700 rounded-lg border border-slate-300 shadow-lg px-2 py-1 text-sm lg:text-md lg:px-5 lg:py-2" value="{{ old('gender') }}" name="gender" id="gender">
                        <option value="">Choose Your Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender')
                    <div class="relative">
                        <small class="absolute botoom-0 left-0 text-red-500 text-xs md:text-sm ml-1">
                            {{ $message }}
                        </small>
                    </div>
                    @enderror
                </div>
            </div>
        </article>
        <article class="mt-6 md:mt-8">
            <div class="mt-6 md:mt-8">
                <label class="text-sm md:text-md text-slate-600" for="password">Password</label><br>
                <div class="flex items-center gap-x-2">
                    <input name="password" id="password" class="w-full focus:outline-none text-slate-700 rounded-lg border border-slate-300 shadow-lg px-2 py-1 text-sm lg:text-md lg:px-5 lg:py-2" type="password" placeholder="Enter Password">
                    <button id="showPasswordBtn" type="button" onclick="showPass('password','showPasswordBtn')" for="passwordShow" class="cursor-pointer w-8 h-8 md:w-10 md:h-10 flex justify-center items-center shadow-md rounded-lg bg-blue-400 hover:bg-blue-500 duration-300 text-white">
                        <svg class="w-5 h-5 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962Z"/><circle cx="12" cy="12" r="3"/></g></svg>
                    </button>

                </div>
                @error('password')
                <div class="relative">
                    <small class="absolute botoom-0 left-0 text-red-500 text-xs md:text-sm ml-1">
                        {{ $message }}
                    </small>
                </div>
                @enderror
            </div>
            <div class="mt-6 md:mt-8">
                <label class="text-sm md:text-md text-slate-600" for="confirmPassword">Confirm Password</label><br>
                <div class="flex items-center gap-x-2">
                    <input name="password_confirmation" id="confirmPassword" class="w-full focus:outline-none text-slate-700 rounded-lg border border-slate-300 shadow-lg px-2 py-1 text-sm lg:text-md lg:px-5 lg:py-2" type="password" placeholder="Enter Confirm Password">
                    <button id="showConfirmBtn" type="button" onclick="showPass('confirmPassword','showConfirmBtn')" for="passwordShow" class="cursor-pointer w-8 h-8 md:w-10 md:h-10 flex justify-center items-center shadow-md rounded-lg bg-blue-400 hover:bg-blue-500 duration-300 text-white">
                        <svg class="w-5 h-5 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962Z"/><circle cx="12" cy="12" r="3"/></g></svg>
                    </button>
                </div>
                @error('password')
                <div class="relative">
                    <small class="absolute botoom-0 left-0 text-red-500 text-xs md:text-sm ml-1">
                        {{ $message }}
                    </small>
                </div>
                @enderror
            </div>
            <div class="mt-6 md:mt-10">
                <button class="w-full text-sm md:text-md text-white bg-blue-400 rounded-lg shadow-xl py-2 md:py-3">
                    Sign Up
                </button>
                <h1 class="text-center text-xs md:text-sm mt-6 md:mt-8">
                    Have an account?
                    <a class="text-blue-500" href="{{ route('auth#loginPage') }}">
                        Sign in
                    </a>
                </h1>
            </div>

        </article>
    </form>

</section>
@endsection

@section('script')
<script src="{{ asset('js/auth.js') }}"></script>

@endsection
