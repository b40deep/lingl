<x-guest-layout>
    <x-slot name="title">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'lingl' }}
        </h2>
    </x-slot>
<body>
    <div class="  bg-red-100 h-screen">
                <div class="w-full h-full bg-gray-100 " style="background-image:url('https://picsum.photos/id/1010/1922/1058.jpg') ">
                    <div class="flex items-end w-full h-full" style="background-color:rgba(0,0,0,0.6)">
                        <div class="px-40 py-40">
                            <div class="mb-2 ">
                                <div class="font-semibold leading-tight text-7xl text-gray-100 hover:text-gray-100">
                                    welcome to <span  class="text-green-400"> lingl</span>
                                </div>
                            </div>
                            <div class='flex text-gray-200 text-md '>
                                <div class="pr-3">get help with a language you're learning and help those learning one you know </div> 
                            </div>
                            <div class="py-5  ">
            
                                @if (Route::has('login'))
                                <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> -->
                                @auth
                                    <!-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> -->
                                    <a href=" {{ route( 'posts.index' ) }} " type="button" class="border border-green-400 text-green-600 hover:bg-green-600 hover:text-green-100 rounded-xl px-4 py-2 mr-3 bg-green-50">Let's view the posts</a>
                                    <a href=" {{ route( 'posts.create' ) }} " type="button" class="border border-green-400 text-green-600 hover:bg-green-600 hover:text-green-100 rounded-xl px-4 py-2 mr-3 bg-green-50">I need help translating</a>
                                    <a href=" {{ url( '/dashboard' ) }} " type="button" class="border border-blue-400 text-blue-600 hover:bg-blue-600 hover:text-blue-100 rounded-xl px-4 py-2 mr-3 bg-blue-100">Take me home</a>
            
                                @else
                                    <!-- <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a> -->
                                    <a href=" {{ route( 'login' ) }} " type="button" class="border border-green-400 text-green-600 hover:bg-green-600 hover:text-green-100 rounded-xl px-4 py-2 mr-3 w-2/5 text-center text-xl bg-green-50">Let's get inside!</a>
            
                                    @if (Route::has('register'))
                                        <!-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a> -->
                                        <a href=" {{ route( 'register' ) }} " type="button" class="border border-blue-400 text-blue-600 hover:bg-blue-600 hover:text-blue-100 rounded-xl px-4 py-2 mr-3 w-2/5 text-center text-xl bg-blue-100">Sign me up!</a>
            
                                    @endif
                                @endauth
                                <!-- </div> -->
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>   
                <!-- <div class="p-6 bg-white border-b border-gray-200">
                    welcome to lingl
                    <ul>
                            <li >
                                
                                <span class=" rounded-2xl bg-gray-100 px-3 py-0.2">
                                    <span class="text-sm text-gray-500"> and it's free! </span>
                                </span>
                            </li>
                            <li >
                                a place to give help with a language you know
                                <span class=" rounded-2xl bg-gray-100 px-3 py-0.2">
                                    <span class="text-sm text-gray-500"> and it makes a difference! </span>
                                </span>
                            </li>
                    </ul>
                </div> -->

                <!--                 
                <div class="p-6 bg-white border-b border-gray-200">
               post link
                </div> -->
            

    </div>
</body>
</x-guest-layout>