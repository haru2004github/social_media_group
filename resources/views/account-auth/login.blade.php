@extends('account-auth.layout.master')

@section('title' ,'Login')

@section('content')
<section class="max-w-6xl h-screen w-full lg:w-auto 2xl:h-auto grid lg:grid-cols-2 items-center border border-blue-500/20 rounded-2xl shadow-xl overflow-hidden">
    <article>
        <div class="flex justify-center items-center">
            <img src="https://i.pinimg.com/564x/2c/bc/69/2cbc69479dbf9b36aaeb67b8820928b9.jpg" alt="">
        </div>
    </article>
    <!-- Login section  -->
    <article class="p-6 2xl:p-12 2xl:pl-10">
        <h1 class="text-blue-500 text-3xl font-bold">Get Started</h1>
        <h3 class="text-slate-600 mt-3">
            Login your account now!
        </h3>
        <form class="mt-5 2xl:mt-10" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mt-5 2xl:mt-8">
                <label class="text-slate-600" for="email">Email</label><br>
                <input name="email" id="email" class="w-full focus:outline-none text-slate-700 rounded-xl border border-slate-300 shadow-lg px-5 py-2" type="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                @error('email')
                <div class="relative">
                    <small class="absolute botoom-0 left-0 text-red-500 text-sm ml-1">
                        {{ $message }}
                    </small>
                </div>
                @enderror
            </div>
            <div class="mt-5 2xl:mt-10">
                <label class="text-slate-600" for="password">Password</label><br>
                <div class="flex items-center gap-x-2">
                    <input name="password" id="password" class="w-full focus:outline-none text-slate-700 rounded-xl border border-slate-300 shadow-lg px-5 py-2" type="password" placeholder="Enter Password">
                    <button id="showBtn" type="button" onclick="showPass('password','showBtn')" for="passwordShow" class="cursor-pointer w-10 h-10 flex justify-center items-center shadow-md rounded-xl bg-blue-400 hover:bg-blue-500 duration-300 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962Z"/><circle cx="12" cy="12" r="3"/></g></svg>
                    </button>

                </div>
                @error('password')
                <div class="relative">
                    <small class="absolute botoom-0 left-0 text-red-500 text-sm ml-1">
                        {{ $message }}
                    </small>
                </div>
                @enderror
            </div>


            <div class="mt-5 md:mt-10">
                <button class="w-full text-white bg-blue-500 hover:bg-blue-600 duration-200 rounded-xl shadow-xl py-3">
                    Sign In
                </button>
                <h1 class="text-center text-sm mt-4">
                    Don't you have any account?
                    <a class="text-blue-500" href="{{ route('auth#registerPage') }}">
                        Sign up
                    </a>
                </h1>
            </div>


        </form>
    </article>
    <!--  -->
</section>


@endsection

@section('script')
<script src="{{asset('js/auth.js')}}"></script>
@endsection
