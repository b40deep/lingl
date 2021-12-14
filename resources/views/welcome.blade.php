<x-guest-layout>
    <x-slot name="title">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'lingl' }}
        </h2>
    </x-slot>
<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    welcome to lingl
                    <ul>
                            <li >
                                a place to get help with a language you're learning
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
                </div>

                <div class="p-6 bg-white border-b border-gray-200">

                    @if (Route::has('login'))
                <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> -->
                    @auth
                        <!-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> -->
                        <a href=" {{ route( 'posts.index' ) }} " type="button" class="border border-green-400 text-green-600 hover:bg-green-600 hover:text-green-100 rounded-xl px-4 py-2 ml-3">Let's view the posts</a>
                        <a href=" {{ route( 'posts.create' ) }} " type="button" class="border border-green-400 text-green-600 hover:bg-green-600 hover:text-green-100 rounded-xl px-4 py-2 ml-3">I need help translating</a>
                        <a href=" {{ url( '/dashboard' ) }} " type="button" class="border border-blue-400 text-blue-600 hover:bg-blue-600 hover:text-blue-100 rounded-xl px-4 py-2 ml-3">Take me home</a>

                    @else
                        <!-- <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a> -->
                        <a href=" {{ route( 'login' ) }} " type="button" class="border border-green-400 text-green-600 hover:bg-green-600 hover:text-green-100 rounded-xl px-4 py-2 ml-3">Let's get inside!</a>

                        @if (Route::has('register'))
                            <!-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a> -->
                            <a href=" {{ route( 'register' ) }} " type="button" class="border border-blue-400 text-blue-600 hover:bg-blue-600 hover:text-blue-100 rounded-xl px-4 py-2 ml-3">Sign me up!</a>

                        @endif
                    @endauth
                <!-- </div> -->
            @endif


                </div>
<!--                 
                <div class="p-6 bg-white border-b border-gray-200">
               post link
                </div> -->
            </div>
        </div>
    </div>
</body>
</x-guest-layout>