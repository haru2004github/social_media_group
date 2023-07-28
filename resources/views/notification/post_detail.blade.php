@extends('layout.master')

@section('title' ,'Post Detail')

@section('current_page')
<div class="flex items-center">
    <svg class="w-8 h-8 2xl:w-11 2xl:h-11 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M21 6.5c0 1.93-1.57 3.5-3.5 3.5S14 8.43 14 6.5S15.57 3 17.5 3S21 4.57 21 6.5m-2 5.29c-.5.13-1 .21-1.5.21A5.51 5.51 0 0 1 12 6.5c0-1.47.58-2.8 1.5-3.79A1.93 1.93 0 0 0 12 2c-1.1 0-2 .9-2 2v.29C7.03 5.17 5 7.9 5 11v6l-2 2v1h18v-1l-2-2v-5.21M12 23c1.11 0 2-.89 2-2h-4a2 2 0 0 0 2 2Z"/></svg>

    <span class="ms-2 mt-1 text-md md:text-xl">Post Detail</span>
</div>
@endsection
@section('content')
<!-- Content  -->
<article  class="md:px-5 lg:px-0 w-full md:w-[70%] md:mx-auto mt-10 md:mt-0">

    <!-- post detail Section -->
    <div class=" max-w-[800px] mx-auto overflow-y-scroll rounded-2xl">

        <div class=" h-[650px] md:h-[500px] max-h-[700px] md:max-h-nonem 2xl:h-[700px] ">
            <div class="p-5 pb-8 w-full dark:border-slate-700 bg-[#f6f8fc] dark:bg-slate-900 2xl:px-8 px-6 shadow-lg rounded-lg md:rounded-2xl  border border-slate-300">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-3 2xl:gap-x-5 2xl:mt-5">
                        <a  href="{{ route('account#profilePage') }}" class="lg:w-14 lg:h-14 w-12 h-12 overflow-hidden rounded-full shadow-xl">
                            @if($owner['userImage'] == null)

                            @if($owner['userGender'] == 'male')
                            <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                            @else
                            <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                            @endif
                            @else
                            <img class="w-full" src="{{ asset('storage/'.$owner['userImage']) }}">
                            @endif
                        </a>
                        <div class="">
                            <div class="flex items-center gap-x-1">

                                <a href="{{ route('member#accountProfilePage',$post->user_id) }}" class="text-slate-700 font-semibold dark:text-slate-200 text-md lg:text-lg">
                                    {{ $owner['userName'] }}
                                </a>
                                @if ($owner['feelingCategory'] !== null)

                                @if ($post->user_id == Auth::user()->id)
                                <a href="{{ route('account#profilePage') }}" class="dark:text-slate-400 text-slate-600 text-sm lg:text-lg">
                                @else
                                <a href="{{ route('member#accountProfilePage',$post->user_id) }}" class="dark:text-slate-400 text-slate-600 text-sm lg:text-lg">
                                @endif
                                    is feeling {{ $owner['feelingCategory'] }}
                                </a>
                                @endif
                            </div>
                            <h2 class="text-sm lg:text-md dark:text-slate-400">
                                {{ $owner['userAddress'] }}
                            </h2>
                        </div>
                    </div>

                    <div class="flex items-center gap-x-2">
                        @if ($owner['activityCategory'] !== null)
                        <div class="px-4 py-2 text-white bg-violet-500 rounded-xl shadwo-lg">
                            {{ $owner['activityCategory'] }}
                        </div>
                        @endif

                        <div class="parentPostApprove">
                            <input class="postId" type="hidden" value="{{ $post->id }}">
                            <select  class="postApprove bg-blue-400 px-2 py-1 md:px-3 cursor-pointer md:py-2 text-xs md:text-sm rounded-xl text-white focus:outline-none shadow-lg" id="">
                                <option @if ($post->post_approve == 'not_approved')  selected @endif value="not_approved">Not Approved</option>
                                <option @if ($post->post_approve == 'approved')  selected @endif value="approved">Approved</option>
                                <option @if ($post->post_approve == 'reject')  selected @endif value="reject">Reject</option>
                            </select>
                        </div>
                    </div>
                </div>

                @if ($post->title)
                <div class="text-slate-500 dark:text-slate-300 text-lg lg:text-xl 2xl:mt-5 mt-3 flex justify-between items-center @if ($post->image == null) pb-5 @endif">
                    <p>
                        {{ $post->title }}
                    </p>
                </div>
                @endif

                @if ($post->description)
                <div class="text-slate-400 dark:text-slate-400 text-sm lg:text-md mt-3 flex justify-between items-center @if ($post->image == null) pb-5 @endif">
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

            </div>
        </div>

    </div>

</article>
@endsection


@section('script')
<script src="{{ asset('js/notification.js') }}"></script>
@endsection
