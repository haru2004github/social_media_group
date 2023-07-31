@extends('layout.master')

@section('title' ,'Post Detail')

@section('current_page')
<div class="flex items-center">
    <svg class="w-8 h-8 2xl:w-11 2xl:h-11 hidden md:block"  xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M3.5 4A1.5 1.5 0 0 0 2 5.5v2A1.5 1.5 0 0 0 3.5 9h2A1.5 1.5 0 0 0 7 7.5v-2A1.5 1.5 0 0 0 5.5 4h-2ZM3 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2ZM9.5 5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1h-8Zm0 2a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Zm-6 4A1.5 1.5 0 0 0 2 12.5v2A1.5 1.5 0 0 0 3.5 16h2A1.5 1.5 0 0 0 7 14.5v-2A1.5 1.5 0 0 0 5.5 11h-2ZM3 12.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2Zm6.5-.5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1h-8Zm0 2a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Z"/></svg>
    <span class="ms-2 mt-1 text-md md:text-xl">Post Detail</span>
</div>
@endsection
@section('content')
<!-- Content  -->
<article  class="md:px-5 lg:px-0 w-full md:w-[70%] md:mx-auto mt-8 md:mt-0">

    <!-- post detail Section -->
    <div class=" max-w-[800px] mx-auto overflow-y-scroll rounded-2xl">
        <div class=" h-[550px] md:h-[500px] max-h-[700px] md:max-h-none 2xl:h-[750px] ">
            <div class="p-3 pb-5 md:p-5 md:pb-8 w-full dark:border-slate-700 bg-[#f6f8fc] dark:bg-slate-900 2xl:px-8  rounded-lg md:rounded-2xl  border border-slate-300">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-2 2xl:gap-x-5 2xl:mt-5">
                        <a  href="{{ route('account#profilePage') }}" class="w-9 lg:w-12 2xl:w-16 h-9 lg:h-12 2xl:h-16 overflow-hidden rounded-full shadow-xl">
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
                        <div class="">
                            <div class="flex items-center gap-x-1">

                                <a href="{{ route('member#accountProfilePage',$post->user_id) }}" class="text-slate-700 font-semibold dark:text-slate-200 text-sm md:text-md lg:text-lg">
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
                            <h2 class="text-xs md:text-sm lg:text-md dark:text-slate-400">
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
                <div class="text-slate-500 dark:text-slate-300 text-md md:text-lg lg:text-xl 2xl:mt-5 mt-3 flex justify-between items-center @if ($post->image == null) pb-5 @endif">
                    <p>
                        {{ $post->title }}
                    </p>
                </div>
                @endif

                @if ($post->description)
                <div class="text-slate-400 dark:text-slate-400 text-sm lg:text-md mt-2 md:mt-3 flex justify-between items-center @if ($post->image == null) pb-5 @endif">
                    <p>
                        {{ $post->description }}
                    </p>
                </div>
                @endif
                @if ($post->image !== null)
                <div class="2xl:mt-8 mt-5 overflow-hidden rounded-xl shadow-lg">
                    <img loading="lazy" class="w-full" src="{{ asset('storage/'.$post->image) }}" alt="">
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
