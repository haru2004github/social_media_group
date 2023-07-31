<!DOCTYPE html>
<html id="html" class="scroll-smooth dark" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600;700&display=swap" rel="stylesheet">
       {{-- Tailwindcss Cdn link  --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- dark mode  --}}
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <title>@yield('title')</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
        .one.active{
            transform-origin: left!important;
            transform: rotate(40deg)!important;
            margin-left: 5px;
        }
        .two.active{
            transform: translateX(-30px)!important;
            opacity: 0!important;
        }
        .three.active{
            transform-origin: left!important;
            transform: rotate(-40deg) !important;
            margin-left: 5px;
        }
        ::-webkit-scrollbar{
            width: 0;
        }
    </style>

</head>
<body class="bg-[#fafafa] dark:bg-[#17181c] ">
    <section id="home" class="flex max-w-[1920px] mx-auto">

        <aside id="aside" class="fixed md:absolute z-30 top-0  lg:static duration-500 lg:left-0 -left-full bg-[#f6f8fc] dark:bg-[#1E1F23] w-[55%] md:w-[35%] lg:w-[25%] h-screen overflow-hidden max-w-[300px] shadow-md lg:ml-0">
            <section class="xl:px-8 px-3 lg:px-6 relative ">

                <!-- logo  -->
                <article class="text-2xl lg:text-3xl 2xl:text-4xl text-blue-500 font-semibold lg:font-bold mt-20 md:mt-14 lg:mt-9 text-center">
                    <a class="unsetScrollTo" href="{{ route('home') }}">
                        @if (count($group) == 0)
                        Group Name
                        @else
                        {{ $group[0]->name }}
                        @endif
                    </a>
                </article>
                <!--  -->

                {{-- Nav Link  --}}
                <article class="mt-6 lg:mt-10 2xl:mt-16 lg:max-h-[540px] lg:overflow-y-scroll 2xl:max-h-auto 2xl:overflow-y-visible px-1 text-md">
                    <!-- Home  -->
                    <a href="{{ route('home') }}" class="unsetScrollTo dark:bg-[#27282f] dark:hover:bg-slate-700 dark:border-slate-700 dark:hover:border-blue-500 dark:text-slate-300 hover:bg-slate-100 hover:text-blue-500 duration-300 w-full mt-5 2xl:mt-8 border border-slate-300 rounded-2xl text-slate-700 shadow-md px-3 py-1 md:py-2 2xl:px-5 2xl:py-3 flex items-center ">
                        <svg class="ml-3 w-6 h-6 xl:w-8 xl:h-8" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="m16 8.41l-4.5-4.5L4.41 11H6v8h3v-6h5v6h3v-8h1.59L17 9.41V6h-1v2.41M2 12l9.5-9.5L15 6V5h3v4l3 3h-3v8h-5v-6h-3v6H5v-8H2Z"/></svg>
                        <h1 class="xl:text-lg md:text-md text-sm ms-2 2xl:ms-4 ml-3">Home</h1>
                    </a>


                    <!-- Notification  -->
                    @if (Auth::user()->role == 'admin')
                    <a href="{{ route('notification#listPage') }}" class="unsetScrollTo dark:bg-[#27282f] dark:hover:bg-slate-700  dark:border-slate-700 dark:hover:border-blue-500 dark:text-slate-300 hover:bg-slate-100 hover:text-blue-500 duration-300 w-full mt-5 2xl:mt-8 border border-slate-300 rounded-2xl text-slate-700 shadow-md px-3 py-1 md:py-2 2xl:px-5 2xl:py-3 flex items-center relative">
                        <svg class="ms-3 w-6 h-6 xl:w-8 xl:h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6.429 2.413a.75.75 0 0 0-1.13-.986l-1.292 1.48a4.75 4.75 0 0 0-1.17 3.024L2.78 8.65a.75.75 0 1 0 1.5.031l.056-2.718a3.25 3.25 0 0 1 .801-2.069l1.292-1.48Z"/><path fill="currentColor" fill-rule="evenodd" d="M6.237 7.7a4.214 4.214 0 0 1 4.206-3.95H11V3a1 1 0 1 1 2 0v.75h.557a4.214 4.214 0 0 1 4.206 3.95l.221 3.534a7.376 7.376 0 0 0 1.308 3.754a1.617 1.617 0 0 1-1.135 2.529l-3.407.408V19a2.75 2.75 0 1 1-5.5 0v-1.075l-3.407-.409a1.617 1.617 0 0 1-1.135-2.528a7.377 7.377 0 0 0 1.308-3.754l.221-3.533Zm4.206-2.45a2.714 2.714 0 0 0-2.709 2.544l-.22 3.534a8.877 8.877 0 0 1-1.574 4.516a.117.117 0 0 0 .082.183l3.737.449c1.489.178 2.993.178 4.482 0l3.737-.449a.117.117 0 0 0 .082-.183a8.876 8.876 0 0 1-1.573-4.516l-.221-3.534a2.714 2.714 0 0 0-2.709-2.544h-3.114Zm1.557 15c-.69 0-1.25-.56-1.25-1.25v-.75h2.5V19c0 .69-.56 1.25-1.25 1.25Z" clip-rule="evenodd"/><path fill="currentColor" d="M17.643 1.355a.75.75 0 0 0-.072 1.058l1.292 1.48a3.25 3.25 0 0 1 .8 2.07l.057 2.717a.75.75 0 0 0 1.5-.031l-.057-2.718a4.75 4.75 0 0 0-1.17-3.024l-1.292-1.48a.75.75 0 0 0-1.058-.072Z"/></svg>
                        <h1 class="xl:text-lg md:text-md text-sm ms-2 2xl:ms-4 ml-3">Notification</h1>
                        <div class="absolute -top-1 -right-1 bg-blue-500 text-white w-5 h-5 flex justify-center items-center rounded-full text-xs">
                            {{ count($notifications) }}
                        </div>
                    </a>
                    @endif


                     <!-- Admins  -->
                     <a href="{{ route('admin#listPage') }}" class="unsetScrollTo dark:bg-[#27282f] dark:hover:bg-slate-700  dark:border-slate-700 dark:hover:border-blue-500 dark:text-slate-300 hover:bg-slate-100 hover:text-blue-500 duration-300 w-full mt-5 2xl:mt-8 border border-slate-300 rounded-2xl text-slate-700 shadow-md px-3 py-1 md:py-2 2xl:px-5 2xl:py-3 flex items-center ">
                        <svg class="ms-3 w-6 h-6 xl:w-8 xl:h-8"  xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M16 5a2 2 0 1 0 0 4a2 2 0 0 0 0-4Zm-4 2a4 4 0 1 1 8 0a4 4 0 0 1-8 0Zm13.5-1a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3ZM22 7.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0Zm-17 0a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0ZM6.5 4a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7Zm2.151 20.505A3 3 0 0 1 4 22v-6.5a.5.5 0 0 1 .5-.5h4.031a3.981 3.981 0 0 1 .846-2H4.5A2.5 2.5 0 0 0 2 15.5V22a5 5 0 0 0 7.327 4.427a7.446 7.446 0 0 1-.676-1.922Zm14.022 1.922A5 5 0 0 0 30 22v-6.5a2.5 2.5 0 0 0-2.5-2.5h-4.877a3.99 3.99 0 0 1 .846 2H27.5a.5.5 0 0 1 .5.5V22a3 3 0 0 1-4.651 2.505a7.447 7.447 0 0 1-.676 1.922ZM12.5 13a2.5 2.5 0 0 0-2.5 2.5V23a6 6 0 0 0 12 0v-7.5a2.5 2.5 0 0 0-2.5-2.5h-7Zm-.5 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5V23a4 4 0 0 1-8 0v-7.5Z"/></svg>
                        <h1 class="xl:text-lg md:text-md text-sm ms-2 2xl:ms-4 ml-3">Admins</h1>
                    </a>

                    <!-- Members  -->
                    <a href="{{ route('member#listPage') }}" class="unsetScrollTo dark:bg-[#27282f] dark:hover:bg-slate-700  dark:border-slate-700 dark:hover:border-blue-500 dark:text-slate-300 hover:bg-slate-100 hover:text-blue-500 duration-300 w-full mt-5 2xl:mt-8 border border-slate-300 rounded-2xl text-slate-700 shadow-md px-3 py-1 md:py-2 2xl:px-5 2xl:py-3 flex items-center ">
                        <svg class="ms-3 w-6 h-6 xl:w-8 xl:h-8"  xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M16 5a2 2 0 1 0 0 4a2 2 0 0 0 0-4Zm-4 2a4 4 0 1 1 8 0a4 4 0 0 1-8 0Zm13.5-1a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3ZM22 7.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0Zm-17 0a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0ZM6.5 4a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7Zm2.151 20.505A3 3 0 0 1 4 22v-6.5a.5.5 0 0 1 .5-.5h4.031a3.981 3.981 0 0 1 .846-2H4.5A2.5 2.5 0 0 0 2 15.5V22a5 5 0 0 0 7.327 4.427a7.446 7.446 0 0 1-.676-1.922Zm14.022 1.922A5 5 0 0 0 30 22v-6.5a2.5 2.5 0 0 0-2.5-2.5h-4.877a3.99 3.99 0 0 1 .846 2H27.5a.5.5 0 0 1 .5.5V22a3 3 0 0 1-4.651 2.505a7.447 7.447 0 0 1-.676 1.922ZM12.5 13a2.5 2.5 0 0 0-2.5 2.5V23a6 6 0 0 0 12 0v-7.5a2.5 2.5 0 0 0-2.5-2.5h-7Zm-.5 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5V23a4 4 0 0 1-8 0v-7.5Z"/></svg>
                        <h1 class="xl:text-lg md:text-md text-sm ms-2 2xl:ms-4 ml-3">Members</h1>
                    </a>

                    @if (Auth::user()->role == 'admin')
                    <!-- Feeling Category  -->
                    <a href="{{ route('feeling#listPage') }}" class="unsetScrollTo dark:bg-[#27282f] dark:hover:bg-slate-700  dark:border-slate-700 dark:hover:border-blue-500 dark:text-slate-300 hover:bg-slate-100 hover:text-blue-500 duration-300 w-full mt-5 2xl:mt-8 border border-slate-300 rounded-2xl text-slate-700 shadow-md px-3 py-1 md:py-2 2xl:px-5 2xl:py-3 flex items-center ">
                        <svg class="ml-3 w-6 h-6 xl:w-8 xl:h-8" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="currentColor"><path d="M16 10.5c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5s.448-1.5 1-1.5s1 .672 1 1.5Zm-6 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S8.448 9 9 9s1 .672 1 1.5Z"/><path fill-rule="evenodd" d="M11.943 1.25h.114c2.309 0 4.118 0 5.53.19c1.444.194 2.584.6 3.479 1.494c.895.895 1.3 2.035 1.494 3.48c.19 1.411.19 3.22.19 5.529V15A7.75 7.75 0 0 1 15 22.75h-3.057c-2.309 0-4.118 0-5.53-.19c-1.444-.194-2.584-.6-3.479-1.494c-.895-.895-1.3-2.035-1.494-3.48c-.19-1.411-.19-3.22-.19-5.529v-.114c0-2.309 0-4.118.19-5.53c.194-1.444.6-2.584 1.494-3.479c.895-.895 2.035-1.3 3.48-1.494c1.411-.19 3.22-.19 5.529-.19Zm-5.33 1.676c-1.278.172-2.049.5-2.618 1.069c-.57.57-.897 1.34-1.069 2.619c-.174 1.3-.176 3.008-.176 5.386s.002 4.086.176 5.386c.172 1.279.5 2.05 1.069 2.62c.57.569 1.34.896 2.619 1.068c1.3.174 3.008.176 5.386.176h2.25c.004-1.366.034-2.264.281-3.027a5.75 5.75 0 0 1 .741-1.496A5.755 5.755 0 0 1 12 17.75a5.766 5.766 0 0 1-3.447-1.148a.75.75 0 1 1 .894-1.204c.728.54 1.607.852 2.553.852s1.825-.313 2.553-.852a.75.75 0 0 1 1.183.744a5.749 5.749 0 0 1 2.487-1.61c.763-.248 1.66-.278 3.027-.282V12c0-2.378-.002-4.086-.176-5.386c-.172-1.279-.5-2.05-1.069-2.62c-.57-.569-1.34-.896-2.619-1.068c-1.3-.174-3.008-.176-5.386-.176s-4.086.002-5.386.176Zm14.592 12.825c-1.357.006-1.999.038-2.518.207a4.25 4.25 0 0 0-2.729 2.729c-.169.52-.2 1.161-.207 2.518a6.253 6.253 0 0 0 5.454-5.454Z" clip-rule="evenodd"/></g></svg>
                        <h1 class="xl:text-lg md:text-md text-sm ms-2 2xl:ms-4 ml-3">Feeling</h1>
                    </a>
                    @endif

                    <!-- Group Chat  -->
                    <a href="{{ route('group_chat#page') }}" class="unsetScrollTo dark:bg-[#27282f] dark:hover:bg-slate-700  dark:border-slate-700 dark:hover:border-blue-500 dark:text-slate-300 hover:bg-slate-100 hover:text-blue-500 duration-300 mt-5 2xl:mt-8 w-full border border-slate-300 rounded-2xl text-slate-700 shadow-md px-3 py-1 md:py-2 2xl:px-5 2xl:py-3 flex items-center  2xl:gap-x-4 gap-x-2 ">
                        <div class="2xl:w-12 w-7 md:w-9 2xl:h-12 h-7 md:h-9 overflow-hidden rounded-full shadow-md ms-2 2xl:ms-0">
                            @if($groupPhoto->image == null)
                            <img loading="lazy" class="object-center object-cover h-full w-full brightness-80 z-0" src="{{ asset('img/default-group-photo.jpg') }}" alt="">

                            @else
                            <img loading="lazy" class="h-full object-center object-cover" src="{{ asset('storage/'.$groupPhoto->image) }}">
                            @endif
                        </div>
                        <h1 class="xl:text-lg md:text-md text-sm ">Group Chat</h1>
                    </a>

                    {{-- Save Posts  --}}

                    <a href="{{ route('save_post#listPage') }}" class="unsetScrollTo dark:bg-[#27282f] dark:hover:bg-slate-700  dark:border-slate-700 dark:hover:border-blue-500 dark:text-slate-300 hover:bg-slate-100 hover:text-blue-500 duration-300 w-full mt-5 2xl:mt-8 border border-slate-300 rounded-2xl text-slate-700 shadow-md px-3 py-1 md:py-2 2xl:px-5 2xl:py-3 flex items-center">
                        <svg  class="ml-3 w-6 h-6 xl:w-8 xl:h-8" xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256"><path fill="currentColor" d="M184 34H72a14 14 0 0 0-14 14v176a6 6 0 0 0 9.18 5.09l60.81-38l60.83 38A6 6 0 0 0 198 224V48a14 14 0 0 0-14-14ZM72 46h112a2 2 0 0 1 2 2v117.18l-54.83-34.27a6 6 0 0 0-6.36 0L70 165.17V48a2 2 0 0 1 2-2Zm59.17 132.91a6 6 0 0 0-6.36 0L70 213.17v-33.84l58-36.25l58 36.25v33.84Z"/></svg>
                        <h1 class="xl:text-lg md:text-md text-sm ms-2 2xl:ms-4 ml-3">Saved</h1>
                    </a>

                </article>

            </section>
        </aside>

        <main class="w-full">
            <div class="relative left-0 top-0 w-full">
                <header class=" fixed top-0 left-0 w-full md:static md:border z-30 border-l-slate-200 dark:border-slate-700 md:py-3 2xl:py-5 px-3 pl-0 md:px-5 2xl:px-8 shadow-md bg-[#f6f8fc] dark:bg-[#1E1F23] flex justify-between items-center">
                    <!-- left nav  -->
                    <div class="text-slate-700 dark:text-slate-300 xl:text-2xl text-lg md:text-xl md:font-semibold flex items-center md:gap-x-5">
                        <button id="navIcon" class="lg:hidden scale-[0.5] md:scale-[0.6] duration-500 w-16 h-16 flex justify-center items-center dark:md:shadow-dark-extra md:shadow-extra rounded-full cursor-pointer z-50 bg-blue-400 text-white md:bg-light shadow-md ml-0">
                            <div class="scale-75 md:scale-90 relative w-8 h-6  flex items-center ">
                                <div class="absolute w-8 h-1 duration-500 top-0 bg-white rounded-full one"></div>
                                <div class="absolute w-8 h-1 duration-500 bg-white rounded-full two"></div>
                                <div class="absolute w-8 h-1 duration-500 bottom-0 bg-white rounded-full three"></div>
                            </div>
                        </button>
                        @yield('current_page')


                    </div>
                    <!--  -->
                    <!-- right nav  -->
                    <div class="pointerStatus text-slate-700 dark:text-slate-300 flex items-center xl:gap-x-6 md:gap-x-2">
                        {{-- //search --}}
                        <a href="{{ route('search#listPage') }}" class="md:hidden">
                            <svg class="scale-75 md:sclae-[100] w-9 h-9 " xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
                        </a>
                        <!-- dark mode btn  -->
                        <button title="Change to dark mode." onclick="toggleTheme()" id="darkBtn"  class="pointerStatus cursor-pointer">
                            <svg class="scale-[0.7] md:sclae-100 w-8 h-8 xl:w-9 xl:h-9" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 256 256"><path fill="currentColor" d="M116 32V16a12 12 0 0 1 24 0v16a12 12 0 0 1-24 0Zm80 96a68 68 0 1 1-68-68a68.07 68.07 0 0 1 68 68Zm-24 0a44 44 0 1 0-44 44a44.05 44.05 0 0 0 44-44ZM51.51 68.49a12 12 0 1 0 17-17l-12-12a12 12 0 0 0-17 17Zm0 119l-12 12a12 12 0 0 0 17 17l12-12a12 12 0 1 0-17-17ZM196 72a12 12 0 0 0 8.49-3.51l12-12a12 12 0 0 0-17-17l-12 12A12 12 0 0 0 196 72Zm8.49 115.51a12 12 0 0 0-17 17l12 12a12 12 0 0 0 17-17ZM44 128a12 12 0 0 0-12-12H16a12 12 0 0 0 0 24h16a12 12 0 0 0 12-12Zm84 84a12 12 0 0 0-12 12v16a12 12 0 0 0 24 0v-16a12 12 0 0 0-12-12Zm112-96h-16a12 12 0 0 0 0 24h16a12 12 0 0 0 0-24Z"/></svg>
                        </button>
                        <!-- message icon  -->
                        <div class="pointerStatus cursor-pointer messageModal"  onclick="show('messageModal')" title="Chat">
                            <svg class="scale-75 md:sclae-[100] w-8 h-8 xl:w-10 xl:h-10" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.2L4 17.2V4h16v12m-3-5h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2"/></svg>

                        </div>
                       <div class="pointerStatus flex items-center gap-x-3 ml-2 md:ml-0">
                        <h1 class="hidden md:block">
                            {{ Auth::user()->name }}
                        </h1>
                        <div onclick="show('accountModal')" class="w-9 lg:w-12 2xl:w-16 h-9 lg:h-12 2xl:h-16 overflow-hidden cursor-pointer rounded-full shadow-md">
                            @if(Auth::user()->image == null)

                            @if(Auth::user()->gender == 'male')
                            <img loading="lazy" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                            @else
                            <img loading="lazy" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                            @endif
                            @else
                            <img loading="lazy" src="{{ asset('storage/'.Auth::user()->image) }}" alt="User Profile">
                            @endif
                        </div>
                       </div>

                    </div>
                    <!--  -->
                </header>

                {{-- chat people  --}}
                <div id="messageModal" class="z-[1000] fixed top-16 left-0 md:static md:top-auto md:left-auto w-full opacity-0 pointer-events-none duration-500 dark:brightness-90">
                    <div class="md:absolute w-full lg:w-auto md:max-w-[300px] 2xl:max-w-none lg:right-48 z-10 flex justify-end bg-slate-50 dark:bg-gray-800 text-white rounded-xl p-4 pb-0 shadow-md">
                        <div class="w-full">
                            <div class="flex justify-between items-center ">
                                <span class="text-slate-900 dark:text-slate-200 font-semibold text-lg lg:text-2xl ">
                                    Chats
                                </span>
                                <button onclick="show('messageModal')" class="text-white bg-red-500 hover:bg-red-600 duration-200 rounded-full w-7 h-7 lg:w-8  lg:h-8 flex justify-center items-center shadow-md">
                                    <svg class="w-5 h-5 lg:w-6 lg:h-6"  xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="currentColor" d="M5.72 5.72a.75.75 0 0 1 1.06 0L12 10.94l5.22-5.22a.749.749 0 0 1 1.275.326a.749.749 0 0 1-.215.734L13.06 12l5.22 5.22a.749.749 0 0 1-.326 1.275a.749.749 0 0 1-.734-.215L12 13.06l-5.22 5.22a.751.751 0 0 1-1.042-.018a.751.751 0 0 1-.018-1.042L10.94 12L5.72 6.78a.75.75 0 0 1 0-1.06Z"/></svg>
                                </button>
                            </div>

                            {{-- search users  --}}
                            @if (count($users) > 1)
                            <a href="{{ route('search#listPage') }}"  class="mt-5 md:mt-10 flex items-center gap-x-2 border-b-2 border-slate-300 pb-3 dark:border-slate-700">
                                <input autocomplete="off" name="key" value="{{ request('key') }}" list="member_lists" class="w-full xl:max-w-[250px] 2xl:max-w-none border dark:bg-[#27282F] dark:text-slate-300 dark:border-slate-700 focus:outline-none border-blue-300/50 px-3 py-1 md:px-5 md:py-2 text-slate-700 bg-slate-50 shadow-md rounded-xl  dark:placeholder:text-slate-100 text-sm md:text-md" type="search" placeholder="Search...">

                               <div class="">
                                <button type="button" title="Search" class="bg-blue-400 hover:bg-blue-500 duration-300 text-white w-7 h-7 md:w-9 md:h-9 flex justify-center items-center rounded-lg md:rounded-xl shadow-md" >
                                    <svg class="w-5 h-5 lg:w-6 lg:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
                                </button>
                               </div>
                            </a>

                            @endif

                            <div class=" max-h-[500px]  overflow-y-scroll">
                                @if (count($users) == 1)
                                <div class="py-14 flex justify-center items-center text-xl text-red-500">
                                    There is no user yet!
                                </div>
                                @else
                                @foreach ($users as $user)
                                    @if (Auth::user()->id != $user->id)
                                    <a href="{{ route('chat#messagePage',$user->id) }}" class="flex items-center gap-x-3 xl:gap-x-5 rounded-md duration-200  dark:hover:bg-gray-900 p-3 min-w-[350px]" title="Click to chat with {{ $user->name }}">
                                        <div class="lg:w-14 lg:h-14 w-10 h-10 overflow-hidden rounded-full shadow-md">
                                            @if($user->image == null)
                                            @if($user->gender == 'male')
                                            <img loading="lazy" class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">
                                            @else
                                            <img loading="lazy" class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                            @endif
                                            @else
                                            <img loading="lazy" class="w-full" src="{{ asset('storage/'.$user->image) }}">
                                            @endif
                                        </div>
                                        <div class="">
                                            <h2 class="block text-slate-800 font-semibold dark:text-slate-200 xl:text-md">
                                                {{ $user->name }}
                                            </h2>
                                            <h3 class="block xl:text-md text-sm text-slate-800 dark:text-slate-400">
                                                {{ $user->address }}
                                            </h3>
                                        </div>
                                    </a>
                                    @endif
                                @endforeach
                                @endif

                            </div>
                            <div class="flex justify-center items-center py-2 border-t-2 border-slate-300 dark:border-slate-700">
                                <svg class="text-slate-800 dark:text-slate-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3 9a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 9Zm0 6.75a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- account modal  -->
                <div id="accountModal" class="z-[1000] fixed top-16 left-0 md:static md:top-auto md:left-auto w-full opacity-0  pointer-events-none duration-500 dark:brightness-90">
                    <div class="hidden md:block w-10 h-10 absolute z-50 right-8 md:right-12 rotate-45 bg-blue-400 "></div>
                    <div class="absolute right-0 md:right-8 z-50 flex justify-end bg-blue-400 text-white rounded-xl overflow-hidden ">
                        <div class="shadow-md py-3 ">
                            <a href="{{ route('account#profilePage') }}" class="unsetScrollTo flex items-center gap-x-2 xl:text-xl text-md md:text-lg px-5 md:px-6 lg:px-10 py-2 hover:bg-blue-500 duration-300" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9h-1.5ZM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75v-1.5ZM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9h1.5ZM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25v1.5ZM5.166 17.856l-.719-.214l-.117.392l.267.31l.569-.488Zm13.668 0l.57.489l.266-.31l-.117-.393l-.719.214ZM9 15.75h6v-1.5H9v1.5Zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75v-1.5Zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75v-1.5Zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25v1.5Zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405l-1.138-.977Z"/></g></svg>
                                <span>
                                    Profile
                                </span>
                            </a>
                            <a href="{{ route('account#passwordPage') }}" class="unsetScrollTo flex items-center gap-x-2 xl:text-xl text-md md:text-lg px-5 md:px-6 lg:px-10 py-2 hover:bg-blue-500 duration-300" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.413-.588T4 20V10q0-.825.588-1.413T6 8h1V6q0-2.075 1.463-3.538T12 1q2.075 0 3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.588 1.413T18 22H6Zm0-2h12V10H6v10Zm6-3q.825 0 1.413-.588T14 15q0-.825-.588-1.413T12 13q-.825 0-1.413.588T10 15q0 .825.588 1.413T12 17ZM9 8h6V6q0-1.25-.875-2.125T12 3q-1.25 0-2.125.875T9 6v2ZM6 20V10v10Z"/></svg>
                                <span>
                                    Password
                                </span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full unsetScrollTo flex items-center gap-x-2 xl:text-xl text-md md:text-lg px-5 md:px-6 lg:px-10 py-2 hover:bg-blue-500 duration-300" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M10 8V6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2v-2"/><path d="M15 12H3l3-3m0 6l-3-3"/></g></svg>
                                    <span>
                                        Logout
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>

            <section id="content" class="pointerStatus pointer-events-auto flex justify-between xl:mt-10 2xl:mt-8 mt-10">
                @yield('content')
                <!-- Noti Alert  -->
                <article class="pointerStatus w-[30%] lg:w-[22%] max-w-[350px] lg:pr-5 mr-5 2xl:mr-10 hidden md:block ">
                    <!-- Admin  -->
                    <div class="pointerStatus bg-[#f6f8fc] dark:bg-[#1E1F23] border border-slate-300 dark:border-slate-700 rounded-2xl shadow-md lg:p-5 p-3 px-4 2xl:p-8">
                        <h1 class="text-slate-800 dark:text-slate-200 text-md 2xl:text-xl font-medium">
                            Admin
                        </h1>
                        @foreach ($admins as $admin)
                        <div class="flex items-center gap-x-3 xl:gap-x-5 mt-3">
                            <div class="">
                                @if ($admin->id == Auth::user()->id)
                                <a href="{{ route('account#profilePage',Auth::user()->idgit ) }}" class="flex justify-center items-center w-9 lg:w-10 2xl:w-16 h-9 lg:h-10 2xl:h-16 overflow-hidden rounded-full shadow-md">
                                @else
                                <a href="{{ route('member#accountProfilePage',$admin->id) }}" class="flex justify-center items-center w-9 lg:w-10 2xl:w-16 h-9 lg:h-10 2xl:h-16 overflow-hidden rounded-full shadow-md">
                                @endif
                                    @if($admin->image == null)

                                    @if($admin->gender == 'male')
                                    <img loading="lazy" class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                    @else
                                    <img loading="lazy" class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                    @endif
                                    @else
                                    <img loading="lazy" class="w-full" src="{{ asset('storage/'.$admin->image) }}">
                                    @endif
                                </a>
                            </div>
                            <div class="">
                                <a href="{{ route('member#accountProfilePage',$admin->id) }}" class="block text-slate-800 font-medium  2xl:font-semibold dark:text-slate-200 text-md 2xl:text-lg">
                                    {{ $admin->name }}
                                </a>
                                <a href="{{ route('member#accountProfilePage',$admin->id) }}" class="block 2xl:text-md text-sm dark:text-slate-400">
                                    {{ $admin->address }}
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- New Members  -->
                    <div class="pointerStatus bg-[#f6f8fc] dark:bg-[#1E1F23] border border-slate-300 dark:border-slate-700 rounded-2xl shadow-md lg:p-5 p-3 px-4 2xl:p-8 mt-8">
                        <h1 class="text-slate-800 dark:text-slate-200 text-md 2xl:text-xl font-medium">
                            @if (count($members) == 0)
                            There is no member yet!
                            @else
                            New Members
                            @endif
                        </h1>

                        @foreach ($members as $member)
                        <div class="flex items-center gap-x-3 2xl:gap-x-5 mt-4 2xl:mt-6">
                            <div class="">
                                <a href="{{ route('member#accountProfilePage',$member->id) }}" class="flex justify-center items-center w-9 lg:w-10 2xl:w-16 h-9 lg:h-10 2xl:h-16 overflow-hidden rounded-full shadow-md">
                                    @if($member->image == null)

                                    @if($member->gender == 'male')
                                    <img loading="lazy" class="w-full" src="{{ asset('img/noUserBoy.jpg') }}" alt="No Uer Profile">

                                    @else
                                    <img loading="lazy" class="w-full" src="{{ asset('img/nouser(girl).jpg') }}" alt="No User Profile">

                                    @endif
                                    @else
                                    <img loading="lazy" class="w-full" src="{{ asset('storage/'.$member->image) }}">
                                    @endif
                                </a>
                            </div>
                            <div class="">
                                <a href="{{ route('member#accountProfilePage',$member->id) }}" class="block text-slate-800 font-medium  xl:font-semibold dark:text-slate-200 text-md 2xl:text-lg">
                                    {{ $member->name }}
                                </a>
                                <a href="{{ route('member#accountProfilePage',$member->id) }}" class="block 2xl:text-md text-sm dark:text-slate-400">
                                    {{ $member->address }}
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--  -->
                </article>
            </section>
        </main>
    </section>

</body>
{{-- jquery cdn link  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/master.js') }}"></script>
<script src="{{ asset('js/darkMode.js') }}"></script>
@yield('script')
</html>
