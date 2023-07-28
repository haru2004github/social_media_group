@extends('layout.master')

@section('title' ,'Feeling Categories')

@section('current_page')
<div class="flex items-center">
    <div class="flex items-center">
        <svg class="w-6 h-6 xl:w-8 xl:h-8 hidden md:block" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="currentColor"><path d="M16 10.5c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5s.448-1.5 1-1.5s1 .672 1 1.5Zm-6 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S8.448 9 9 9s1 .672 1 1.5Z"/><path fill-rule="evenodd" d="M11.943 1.25h.114c2.309 0 4.118 0 5.53.19c1.444.194 2.584.6 3.479 1.494c.895.895 1.3 2.035 1.494 3.48c.19 1.411.19 3.22.19 5.529V15A7.75 7.75 0 0 1 15 22.75h-3.057c-2.309 0-4.118 0-5.53-.19c-1.444-.194-2.584-.6-3.479-1.494c-.895-.895-1.3-2.035-1.494-3.48c-.19-1.411-.19-3.22-.19-5.529v-.114c0-2.309 0-4.118.19-5.53c.194-1.444.6-2.584 1.494-3.479c.895-.895 2.035-1.3 3.48-1.494c1.411-.19 3.22-.19 5.529-.19Zm-5.33 1.676c-1.278.172-2.049.5-2.618 1.069c-.57.57-.897 1.34-1.069 2.619c-.174 1.3-.176 3.008-.176 5.386s.002 4.086.176 5.386c.172 1.279.5 2.05 1.069 2.62c.57.569 1.34.896 2.619 1.068c1.3.174 3.008.176 5.386.176h2.25c.004-1.366.034-2.264.281-3.027a5.75 5.75 0 0 1 .741-1.496A5.755 5.755 0 0 1 12 17.75a5.766 5.766 0 0 1-3.447-1.148a.75.75 0 1 1 .894-1.204c.728.54 1.607.852 2.553.852s1.825-.313 2.553-.852a.75.75 0 0 1 1.183.744a5.749 5.749 0 0 1 2.487-1.61c.763-.248 1.66-.278 3.027-.282V12c0-2.378-.002-4.086-.176-5.386c-.172-1.279-.5-2.05-1.069-2.62c-.57-.569-1.34-.896-2.619-1.068c-1.3-.174-3.008-.176-5.386-.176s-4.086.002-5.386.176Zm14.592 12.825c-1.357.006-1.999.038-2.518.207a4.25 4.25 0 0 0-2.729 2.729c-.169.52-.2 1.161-.207 2.518a6.253 6.253 0 0 0 5.454-5.454Z" clip-rule="evenodd"/></g></svg>

        <span class="ms-1 md:ms-2 mt-1 text-md md:text-xl">Feeling <span class="hidden md:inline">Categries' Lists</span></span>
    </div>
</div>
@endsection

@section('content')
<!-- Content  -->
<article  class="mt-10 md:mt-0 w-full md:w-[70%] md:mx-auto md:px-5 lg:px-0">
    <!-- create category and search section  -->
    <div class="max-w-[1200px] flex items-center justify-between px-3 lg:px-5 md:px-0">
        <div class="">
            <form action="{{ route('feeling#createCategory') }}" method="POST">

                @csrf
                <div  class="flex items-center gap-x-2 2xl:gap-x-4">
                    <input name="category" class="max-w-[120px] md:max-w-[150px] lg:max-w-none border dark:bg-[#27282F] dark:text-slate-300 dark:border-slate-700 focus:outline-none border-blue-300/50 px-3 lg:px-5 py-1 2xl:py-2 text-slate-700 bg-slate-50 shadow-md rounded-lg md:rounded-xl  dark:placeholder:text-slate-100 text-xs md:text-sm lg:text-md" type="text" placeholder="Add Category...">
                    <button class="px-2 lg:px-3 text-sm md:text-md 2xl:text-md p-1 lg:py-1 2xl:py-2 bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 text-white hover:bg-violet-500 duration-300 shadow-lg rounded-lg flex justify-center items-center" >
                        +<span class="hidden lg:inline">Add</span>
                    </button>
                </div>
                @error('category')
                <div class="relative">
                    <small class="absolute top-0 left-0 text-red-500">
                        {{ $message }}
                    </small>
                </div>
                @enderror
            </form>

        </div>
        <form action="{{ route('feeling#listPage') }}" method="get" class="">
            <div class="flex items-center gap-x-2 2xl:gap-x-4">
                <input value="{{ request('key') }}" autocomplete="off" name="key" list='category_list' class="max-w-[120px] md:max-w-[150px] lg:max-w-none border dark:bg-[#27282F] dark:text-slate-300 dark:border-slate-700 focus:outline-none border-blue-300/50 px-3 lg:px-5 py-1 2xl:py-2 text-slate-700 bg-slate-50 shadow-md rounded-lg md:rounded-xl  dark:placeholder:text-slate-100 text-xs md:text-sm lg:text-md" type="search" placeholder="Search...">

                <datalist id="category_list">
                    @foreach ($categories as $category)
                    <option value="{{ $category->feeling_category }}">
                    @endforeach
                </datalist>


                <button type="submit" title="Search" class="bg-blue-400 hover:bg-blue-500 duration-300 text-white w-7 h-7 md:w-8 md:h-8 2xl:w-10 2xl:h-10 flex justify-center items-center rounded-lg md:rounded-xl shadow-md" >
                    <svg class="w-5 h-5 2xl:w-<a 2xl:h-<a" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
                </button>

            </div>
        </form>

    </div>

    @if (request('key'))
    <div class="mt-6 max-w-[1200px] mx-auto px-3 md:px-5 lg:px-0">
        <h1 class="text-slate-700 dark:text-slate-300 text-md 2xl:text-xl">Search : {{ request('key') }}</h1>
    </div>
    @endif

    <!-- Categories Section -->
    <div class="mt-5 max-w-[1200px] dark:bg-[#1E1F23] border-2 border-blue-300/20 dark:border-slate-700  mx-auto overflow-hidden  rounded-2xl shadow-md ">


        <!-- Action Categories section  -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg h-[650px] md:h-[500px] max-h-[700px] 2xl:h-[700px] md:max-h-none overflow-y-scroll">
            @if (count($categories) == null)
                <div class="flex justify-center items-center h-full w-full text-slate-700 dark:text-slate-300 text-3xl">
                    There is no category!
                </div>
            @else
                <table class="w-full text-md text-left text-gray-500 dark:bg-[#1E1F23]">
                    <thead class="text-sm lg:text-md 2xl:text-lg font-medium text-gray-700 uppercase bg-gray-50 dark:bg-slate-900 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 2xl:px-6 2xl:py-4 font-medium">
                                Id
                            </th>
                            <th scope="col" class="px-4 py-3 2xl:px-6 2xl:py-4 font-medium">
                                Feeling Category
                            </th>
                            <th scope="col" class="px-4 py-3 2xl:px-6 2xl:py-4 font-medium">
                                Created _at
                            </th>
                            <th scope="col" class="px-4 py-3 2xl:px-6 2xl:py-4 font-medium">
                                Updated At
                            </th>
                            <th scope="col" class="px-4 py-3 2xl:px-6 2xl:py-4 font-medium">
                                Action
                            </th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($categories as $category )
                        <form action="{{ route('feeling#editCategory',$category->id) }}" method="POST">
                            @csrf
                            <tr class="bg-white border-t border-b dark:bg-[#1E1F23] dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-slate-800 shadow-md ">
                                <td scope="row" class="px-4 py-2 2xl:px-6 2xl:py-4 font-medium text-gray-900 whitespace-nowrap dark:text-slate-200">
                                    {{ $category->id }}
                                </td>
                                <td class="category px-4 py-2 2xl:px-6 2xl:py-4 capitalize">
                                    <span class="categoryName ml-3">
                                        {{ $category->feeling_category }}

                                    </span>
                                    <input required name="category" type="text" class="categoryEdit w-[165px] hidden  rounded-lg shadow-inner border border-slate-300 dark:border-slate-700 dark:bg-slate-900 px-3 py-1 2xl:py-2 focus:outline-none" value="{{ $category->feeling_category }}">
                                    <input  name="id" type="hidden" value="{{ $category->id }}">

                                </td>
                                <td class="px-4 py-2 2xl:px-6 2xl:py-4">
                                    {{ $category->created_at->format('D/F/Y') }}
                                </td>
                                <td class="px-4 py-2 2xl:px-6 2xl:py-4">
                                    {{ $category->updated_at->format('D/F/Y') }}
                                </td>
                                <td class="px-4 py-2 2xl:px-6 2xl:py-4 text-right">
                                    <div class="parentEditBtn flex items-center gap-x-3">
                                        <button type="button"  class="editShowInput text-white bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-8 md:h-8 flex justify-center items-center shadow-md" title="Edit">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6V19ZM19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM4 21q-.425 0-.713-.288T3 20v-2.825q0-.2.075-.388t.225-.337l10.3-10.3l4.25 4.25l-10.3 10.3q-.15.15-.337.225T6.825 21H4ZM14.325 9.675l-.7-.7l1.4 1.4l-.7-.7Z"/></svg>
                                        </button>
                                        <button type="submit"  class="editBtn hidden text-white bg-violet-400 dark:bg-violet-500 dark:hover:bg-violet-600 hover:bg-violet-500 duration-300 rounded-full w-7 h-7 md:w-8 md:h-8  justify-center items-center shadow-md" title="Update">
                                            <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 21c-1.654 0-3-1.346-3-3v-4.764c-1.143 1.024-3.025.979-4.121-.115a3.002 3.002 0 0 1 0-4.242L12 1.758l7.121 7.121a3.002 3.002 0 0 1 0 4.242c-1.094 1.095-2.979 1.14-4.121.115V18c0 1.654-1.346 3-3 3zM11 8.414V18a1.001 1.001 0 0 0 2 0V8.414l3.293 3.293a1.023 1.023 0 0 0 1.414 0a.999.999 0 0 0 0-1.414L12 4.586l-5.707 5.707a.999.999 0 0 0 0 1.414a1.023 1.023 0 0 0 1.414 0L11 8.414z"/></svg>
                                        </button>
                                        <a href="{{ route('feeling#deleteCategory',$category->id) }}" class="deleteBtn text-white bg-red-400 dark:bg-red-500 dark:hover:bg-red-600 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-8 md:h-8 flex justify-center items-center shadow-md" type="button" title="Delete">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>
                                        </a>
                                        <button type="button" class="cancelBtn hidden text-white bg-red-400 dark:bg-red-500 dark:hover:bg-red-600 hover:bg-red-500 duration-300 rounded-full w-7 h-7 md:w-8 md:h-8  justify-center items-center shadow-md" type="button" title="Cancel">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243"/></svg>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</article>


@endsection


@section('script')
<script src="{{ asset('js/feeling_category.js') }}"></script>
@endsection
