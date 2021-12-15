<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Speak to a man in his language, and you speak to his heart.') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route( 'posts.index' ) }}">
                    <div class="p-6 bg-white border-b border-gray-200">
                        See the lingl posts
                    </div>
                </a>
                <a href="{{ route( 'posts.create' ) }}"> 
                    <div class="p-6 bg-white border-b border-gray-200">
                            Ask for a translation
                    </div>
                </a>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                     Some people have sent you translations:
                </div>
                <a href="{{ route( 'posts.create' ) }}"> 
                    <div class="p-2 px-10 bg-white border-b border-gray-200">
                        So-and-so has helped you translate your request
                    </div>
                </a>
                <a href="{{ route( 'posts.create' ) }}"> 
                    <div class="p-2 px-10 bg-white border-b border-gray-200">
                        So-and-so has helped you translate your request
                    </div>
                </a>
                <a href="{{ route( 'posts.create' ) }}"> 
                    <div class="p-2 px-10 bg-white border-b border-gray-200">
                        So-and-so has helped you translate your request
                    </div>
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>
