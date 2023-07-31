@extends('layout.master')

@if ($member->role == 'admin')
@section('title' ,"Admin's Profile")
@else
@section('title' ,"Member's Profile")
@endif

@section('current_page')
<div class="flex items-center">
    <svg class="w-8 h-8 2xl:w-11 2xl:h-11 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9h-1.5ZM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75v-1.5ZM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9h1.5ZM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25v1.5ZM5.166 17.856l-.719-.214l-.117.392l.267.31l.569-.488Zm13.668 0l.57.489l.266-.31l-.117-.393l-.719.214ZM9 15.75h6v-1.5H9v1.5Zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75v-1.5Zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75v-1.5Zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25v1.5Zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405l-1.138-.977Z"/></g></svg>
    <span class="ms-2 mt-1 text-md md:text-xl">
        @if ($member->role == 'admin')
        <span class="hidden md:inline">Admin's </span>Profile
        @else
        <span class="hidden md:inline">Member's</span> Profile
        @endif
    </span>
</div>
@endsection

@section('content')
<!-- Content  -->
<article  class="mt-10 md:mt-0 content md:w-[70%] md:mx-auto md:h-[80vh] md:overflow-y-scroll px-3 md:px-5 lg:px-0">

    <!-- Profile Sectoion -->
    <div class="w-full md:max-w-[800px] border border-slate-300 dark:bg-[#1E1F23] dark:border-slate-700  mx-auto overflow-hidden flex flex-col-reverse rounded-2xl shadow-lg pb-5 2xl:pb-10 2xl:mb-20">
        <div class="">
            <div class="flex justify-center gap-x-5 2xl:gap-x-10">
                {{-- phone contact  --}}
                <a href="tel:{{ $member->phone }}" class="mt-5 w-10 h-10 md:w-12 2xl:w-16 md:h-12 2xl:h-16 rounded-full shadow-md shadow-green-800 bg-green-500/90 hover:bg-green-500 duration-300 flex justify-center items-center text-white">
                    <svg class=" w-7 2xl:w-10  h-7 2xl:h-10" xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256"><path fill="currentColor" d="M220.78 162.13L173.56 141a12 12 0 0 0-11.38 1a3.37 3.37 0 0 0-.38.28L137 163.42a3.93 3.93 0 0 1-3.7.21c-16.24-7.84-33.05-24.52-40.89-40.57a3.9 3.9 0 0 1 .18-3.69l21.2-25.21c.1-.12.19-.25.28-.38a12 12 0 0 0 1-11.36L93.9 35.28a12 12 0 0 0-12.48-7.19A52.25 52.25 0 0 0 36 80c0 77.2 62.8 140 140 140a52.25 52.25 0 0 0 51.91-45.42a12 12 0 0 0-7.13-12.45Zm-.78 11.45A44.23 44.23 0 0 1 176 212c-72.78 0-132-59.22-132-132a44.23 44.23 0 0 1 38.42-44a3.87 3.87 0 0 1 .48 0a4 4 0 0 1 3.67 2.49l21.11 47.14a4 4 0 0 1-.23 3.6l-21.19 25.2c-.1.13-.2.25-.29.39a12 12 0 0 0-.78 11.75c8.69 17.79 26.61 35.58 44.6 44.27a12 12 0 0 0 11.79-.87l.37-.28l24.83-21.12a3.93 3.93 0 0 1 3.57-.27l47.21 21.16a4 4 0 0 1 2.44 4.12Z"/></svg>
                </a>
                <div class="-mt-36 z-10 flex justify-center items-end relative">
                    <div class="w-[100px] h-[100px] md:w-[150px] md:h-[150px] 2xl:w-[240px]  2xl:h-[240px] shadow-lg rounded-full overflow-hidden dark:border-slate-700 border-4 md:border-8 border-[#fafafa]">
                        @if($member->image == null)

                        @if($member->gender == 'male')
                        <img loading="lazy" class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                        @else
                        <img loading="lazy" class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                        @endif
                        @else
                        <img loading="lazy" class="w-full" src="{{ asset('storage/'.$member->image) }}">
                        @endif
                    </div>

                    <div class="absolute bottom-3 right-0 2xl:bottom-5 2xl:right-5">
                        <button onclick="toggleDisplayForProFile()" class="w-8 h-8 md:w-12 md:h-12 flex justify-center items-center rounded-full shadow-md bg-blue-400 hover:bg-blue-500 text-white duration-300">
                            <svg class="w-5 h-5 md:w-auto md:h-auto" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 36 36"><path fill="currentColor" d="M32 4H4a2 2 0 0 0-2 2v24a2 2 0 0 0 2 2h28a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2ZM4 30V6h28v24Z" class="clr-i-outline clr-i-outline-path-1"/><path fill="currentColor" d="M8.92 14a3 3 0 1 0-3-3a3 3 0 0 0 3 3Zm0-4.6A1.6 1.6 0 1 1 7.33 11a1.6 1.6 0 0 1 1.59-1.59Z" class="clr-i-outline clr-i-outline-path-2"/><path fill="currentColor" d="m22.78 15.37l-5.4 5.4l-4-4a1 1 0 0 0-1.41 0L5.92 22.9v2.83l6.79-6.79L16 22.18l-3.75 3.75H15l8.45-8.45L30 24v-2.82l-5.81-5.81a1 1 0 0 0-1.41 0Z" class="clr-i-outline clr-i-outline-path-3"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                        </button>
                    </div>
                </div>

                {{-- //mail to  --}}
                <a href="mailto:{{ $member->email }}" class="mt-5 w-10 h-10 md:w-12 2xl:w-16 md:-12 2xl:h-16 rounded-full shadow-md shadow-violet-800 bg-violet-500 hover:bg-violet-600 duration-300 flex justify-center items-center text-slate-100">
                    <svg class=" w-7 2xl:w-10  h-7 2xl:h-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M19.435 4.065H4.565a2.5 2.5 0 0 0-2.5 2.5v10.87a2.5 2.5 0 0 0 2.5 2.5h14.87a2.5 2.5 0 0 0 2.5-2.5V6.565a2.5 2.5 0 0 0-2.5-2.5Zm-14.87 1h14.87a1.489 1.489 0 0 1 1.49 1.39c-2.47 1.32-4.95 2.63-7.43 3.95a6.172 6.172 0 0 1-1.06.53a2.083 2.083 0 0 1-1.67-.39c-1.42-.75-2.84-1.51-4.25-2.26c-1.14-.6-2.3-1.21-3.44-1.82a1.491 1.491 0 0 1 1.49-1.4Zm16.37 12.37a1.5 1.5 0 0 1-1.5 1.5H4.565a1.5 1.5 0 0 1-1.5-1.5V7.6c2.36 1.24 4.71 2.5 7.07 3.75a5.622 5.622 0 0 0 1.35.6a2.872 2.872 0 0 0 2-.41c1.45-.76 2.89-1.53 4.34-2.29c1.04-.56 2.07-1.1 3.11-1.65Z"/></svg>
                </a>
            </div>

            <div class="text-center mt-8">
                <h1 class="text-md lg:text-2xl text-slate-600 dark:text-slate-300 font-bold flex justify-center items-center">
                    <span>
                        {{ $member->name }}
                    </span>
                    <span class="text-slate-600 dark:text-slate-400 font-[500] text-sm flex items-center">
                        <span class="text-lg">&lt;</span>{{ $member->job }}<span class="text-lg">&gt;</span>
                    </span>
                </h1>

                <h3 class="flex items-center gap-x-1 justify-center">
                    <svg class="text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5" fill="currentColor"/></svg>
                    <span class="dark:text-slate-300 text-sm md:text-md">
                        {{ $member->address }}
                    </span>
                </h3>

            </div>
            <div class="p-5 lg:p-10">
                <h3 class="text-lg md:text-xl text-slate-700 dark:text-slate-300 ml-1 ">Description</h3>
                <p class="mt-3 text-slate-700 dark:bg-[#1E1F23] dark:text-slate-400 text-md md:text-lg bg-[#f2f2f2] shadow-md border border-blue-500/50 rounded-2xl p-3 lg:p-5">
                    @if ($member->description == null)
                    There is no description!
                    @else
                    {{ $member->description }}
                    @endif
                </p>
                <div class="mt-8 md:mt-10 p-3 lg:p-10 grid md:grid-cols-2 items-center md:text-md text-sm shadow-md border border-blue-500/50 rounded-2xl ">
                    <div class="">
                        <!-- Email  -->
                        <div class="flex items-center gap-x-3">
                            <svg class="w-7 h-7 md:w-8 md:h-8 text-violet-500 " xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M19.435 4.065H4.565a2.5 2.5 0 0 0-2.5 2.5v10.87a2.5 2.5 0 0 0 2.5 2.5h14.87a2.5 2.5 0 0 0 2.5-2.5V6.565a2.5 2.5 0 0 0-2.5-2.5Zm-14.87 1h14.87a1.489 1.489 0 0 1 1.49 1.39c-2.47 1.32-4.95 2.63-7.43 3.95a6.172 6.172 0 0 1-1.06.53a2.083 2.083 0 0 1-1.67-.39c-1.42-.75-2.84-1.51-4.25-2.26c-1.14-.6-2.3-1.21-3.44-1.82a1.491 1.491 0 0 1 1.49-1.4Zm16.37 12.37a1.5 1.5 0 0 1-1.5 1.5H4.565a1.5 1.5 0 0 1-1.5-1.5V7.6c2.36 1.24 4.71 2.5 7.07 3.75a5.622 5.622 0 0 0 1.35.6a2.872 2.872 0 0 0 2-.41c1.45-.76 2.89-1.53 4.34-2.29c1.04-.56 2.07-1.1 3.11-1.65Z"/></svg>
                            <p class="text-slate-800 dark:text-slate-300 ">
                                {{ $member->email }}
                            </p>
                        </div>


                        <!-- Phone  -->
                        <div class="flex items-center gap-x-3 mt-2">
                            <svg class="w-8 h-8 text-green-500 " xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256"><path fill="currentColor" d="M220.78 162.13L173.56 141a12 12 0 0 0-11.38 1a3.37 3.37 0 0 0-.38.28L137 163.42a3.93 3.93 0 0 1-3.7.21c-16.24-7.84-33.05-24.52-40.89-40.57a3.9 3.9 0 0 1 .18-3.69l21.2-25.21c.1-.12.19-.25.28-.38a12 12 0 0 0 1-11.36L93.9 35.28a12 12 0 0 0-12.48-7.19A52.25 52.25 0 0 0 36 80c0 77.2 62.8 140 140 140a52.25 52.25 0 0 0 51.91-45.42a12 12 0 0 0-7.13-12.45Zm-.78 11.45A44.23 44.23 0 0 1 176 212c-72.78 0-132-59.22-132-132a44.23 44.23 0 0 1 38.42-44a3.87 3.87 0 0 1 .48 0a4 4 0 0 1 3.67 2.49l21.11 47.14a4 4 0 0 1-.23 3.6l-21.19 25.2c-.1.13-.2.25-.29.39a12 12 0 0 0-.78 11.75c8.69 17.79 26.61 35.58 44.6 44.27a12 12 0 0 0 11.79-.87l.37-.28l24.83-21.12a3.93 3.93 0 0 1 3.57-.27l47.21 21.16a4 4 0 0 1 2.44 4.12Z"/></svg>
                            <p class="text-slate-800 dark:text-slate-300 ">
                                {{ $member->phone }}
                            </p>
                        </div>
                    </div>

                    <div class="">
                        <!-- Gender  -->
                        <div class="flex items-center gap-x-2">
                            @if ($member->gender == 'male')
                            <svg class="text-blue-500 w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="m12.189 7l.002-2l7 .007l-.008 7l-2-.002l.004-3.588l-3.044 3.044a5.002 5.002 0 0 1-7.679 6.336a5 5 0 0 1 6.25-7.736l3.058-3.057L12.189 7Zm-4.31 5.14a3 3 0 1 1 4.242 4.244A3 3 0 0 1 7.88 12.14Z" clip-rule="evenodd"/></svg>
                            <p class="text-slate-800 dark:text-slate-300 capitalize">
                            @else
                            <svg class="text-red-500 w-8 h-8 " xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M17 19.93a8 8 0 1 0-2 0V22h-5v2h5v4h2v-4h5v-2h-5ZM10 12a6 6 0 1 1 6 6a6.007 6.007 0 0 1-6-6Z"/></svg>
                            @endif
                            <p class="text-slate-800 dark:text-slate-300 capitalize ml-0">

                                {{ $member->gender }}
                            </p>
                        </div>


                        <!-- Role  -->
                        <div class="flex items-center gap-x-3 mt-2">
                            <svg class="text-slate-800 dark:text-slate-300 w-8 h-6 " xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M28.07 21L22 15l6.07-6l1.43 1.41L24.86 15l4.64 4.59L28.07 21zM22 30h-2v-5a5 5 0 0 0-5-5H9a5 5 0 0 0-5 5v5H2v-5a7 7 0 0 1 7-7h6a7 7 0 0 1 7 7zM12 4a5 5 0 1 1-5 5a5 5 0 0 1 5-5m0-2a7 7 0 1 0 7 7a7 7 0 0 0-7-7z"/></svg>
                            <p class="text-slate-800 dark:text-slate-300 capitalize">
                                {{ $member->role }}
                            </p>
                        </div>
                    </div>

                </div>


            </div>

        </div>

        <div class="overflow-hidden min-h-[150px]  2xl:h-[400px] 2xl:min-h-[300px] 2xl:max-h-[400px] object-center max-h-[250px] dark:bg-slate-800 bg-slate-100 relative shadow-sm">
            @if ($member->cover_image !== null)
            <img loading="lazy" class="object-center object-cover h-full w-full brightness-80 z-0" src="{{ asset('storage/'.$member->cover_image) }}" alt="">
            @else
            <img loading="lazy" class="object-center object-cover h-full w-full brightness-80 z-0" src="https://i.pinimg.com/564x/4e/48/63/4e4863b199e1d6f13cc1f07671db78d7.jpg" alt="">
            @endif
        </div>


    </div>

</article>
@endsection


@section('script')
<script>
       //for preview image
       function previewFile(previewImage,fileName) {
      let preview = document.getElementById(previewImage);
      let file = document.getElementById(fileName).files[0];
      const reader = new FileReader();

      reader.addEventListener(
        "load",
        () => {
          // convert image file to base64 string
          preview.src = reader.result;
        },
        false
      );

      if (file) {
        reader.readAsDataURL(file);
      }
    }
</script>

@endsection
