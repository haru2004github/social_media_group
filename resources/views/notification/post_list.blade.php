@extends('layout.master')

@section('title' ,'Notification')

@section('current_page')
<div class="flex items-center">
    <div class="flex items-center ">
        <svg class="w-6 h-6 2xl:w-11 2xl:h-11 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M21 6.5c0 1.93-1.57 3.5-3.5 3.5S14 8.43 14 6.5S15.57 3 17.5 3S21 4.57 21 6.5m-2 5.29c-.5.13-1 .21-1.5.21A5.51 5.51 0 0 1 12 6.5c0-1.47.58-2.8 1.5-3.79A1.93 1.93 0 0 0 12 2c-1.1 0-2 .9-2 2v.29C7.03 5.17 5 7.9 5 11v6l-2 2v1h18v-1l-2-2v-5.21M12 23c1.11 0 2-.89 2-2h-4a2 2 0 0 0 2 2Z"/></svg>
        <span class="ms-1 md:ms-2 mt-1 text-md md:text-xl">Notification</span>
    </div>
</div>
@endsection

@section('content')
<!-- Content  -->
<article  class="md:px-5 w-full md:w-[70%] md:mx-auto ">

    <!-- Notification Section -->
    <div class="mt-14 md:mt-0 md:max-w-[800px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden rounded-2xl shadow-md 2xl:mb-20 ">

        <div class="bg-[#f6f8fc] dark:bg-slate-900 h-[700px] md:h-[750px]  overflow-y-scroll p-3 md:p-5 2xl:p-10 flex flex-col gap-y-5">

            @if (count($notifications) == 0)
                <div class="flex justify-center items-center text-red-500 text-2xl h-full">
                    <div class=""></div>
                        <h1 class="text-center">
                            There is no notification yet!
                        </h1>
                    </div>
                </div>
            @else
            @foreach ($notifications as $notification)
            <div class="shadow-md rounded-xl p-3 md:p-5 border border-blue-300/50 justify-between flex gap-x-5 items-center w-full">
                <div class="flex gap-x-3 md:gap-x-5 items-center">
                        <div class="flex items-end">
                            @if (Auth::user()->id == $notification->user_id)
                            <a href="{{ route('account#profilePage',Auth::user()->id) }}" class="w-12 2xl:w-16 cursor-pointer h-12 2xl:h-16 overflow-hidden rounded-full shadow-xl">
                            @else
                            <a href="{{ route('member#accountProfilePage',$notification->user_id) }}" class="w-12 h-12 2xl:w-16 cursor-pointer 2xl:h-16 overflow-hidden rounded-full shadow-xl">

                            @endif
                                @if($notification->user_image == null)

                                @if($notification->user_gender == 'male')
                                <img class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                @else
                                <img class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                @endif
                                @else
                                <img class="w-full" src="{{ asset('storage/'.$notification->user_image) }}">
                                @endif
                            </a>
                            <div class="-ms-5 border-2 border-[#f6f8fc] w-6 h-6 bg-blue-500 text-white flex justify-center items-center rounded-full overflow-hidden shadow-md">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5v2zm0-10h4v6h6v-6h4l-7-7l-7 7z"/></svg>
                            </div>
                        </div>
                        <form action="{{ route('notification#postDetail',$notification->id) }}" method="GET" class="">
                            <input type="hidden" name="userName" value="{{ $notification->user_name }}">
                            <input type="hidden" name="userAddress" value="{{ $notification->user_address }}">
                            <input type="hidden" name="userImage" value="{{ $notification->user_image }}">
                            <input type="hidden" name="userGender" value="{{ $notification->user_gender }}">
                            <input type="hidden" name="feelingCategory" value="{{ $notification->feeling_category }}">
                            <input type="hidden" name="activityCategory" value="{{ $notification->activity_category }}">
                            <button type="submit" class="text-slate-800 dark:text-slate-300">
                                <p class="text-sm md:text-md hover:underline">
                                    {{ $notification->user_name }}
                                     created a new post.
                                </p>
                                <h2 class="text-xs md:text-sm text-left text-slate-700 dark:text-slate-400">
                                    {{ $notification->created_at->format('F d \a\t h:i A') }}
                                </h2>
                            </button>
                        </form>
                    </div>
                    <div class="parentPostApprove hidden md:block">
                        <input class="postId" type="hidden" value="{{ $notification->id }}">
                        <select  class="postApprove bg-blue-400 px-2 md:px-3 cursor-pointer py-1 2xl:py-2 text-sm rounded-xl text-white focus:outline-none shadow-md " id="">
                            <option @if ($notification->post_approve == 'not_approved')  selected @endif value="not_approved">Not Approved</option>
                            <option @if ($notification->post_approve == 'approved')  selected @endif value="approved">Approved</option>
                            <option @if ($notification->post_approve == 'reject')  selected @endif value="reject">Reject</option>
                        </select>
                    </div>
                </div>

            @endforeach
            @endif
        </div>

    </div>

</article>


@endsection


@section('script')
<script src="{{ asset('js/notification.js') }}"></script>
@endsection
