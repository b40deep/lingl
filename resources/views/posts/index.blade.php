<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fellow learners that need some help') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach($posts as $post)
                            <div class="flex items-center justify-between my-6">
                                <div class="w-16">
                                <img class="w-12 h-12 rounded-full" src="{{ $post->user->images->first()->image_url }}">
                                </div>
                                <div class="flex-1 pl-2">
                                    <div class="text-gray-700 font-semibold">
                                    <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->content }}</a>
                                    </div>
                                    <!-- <div class="text-gray-600 font-thin">
                                    Web House
                                    </div> -->
                                </div>
                                <span class="ml-3 rounded-2xl bg-gray-100 px-3 py-0.5">
                                    <span class="text-sm text-gray-500">from {{ $post->user->name }} </span>
                                </span>
                                <!-- <div class="text-gray-400">from {{ $post->user->name }} </div> -->
                            </div>
                            <hr class="boder-b-0 my-4"/>

                        @endforeach
                    </ul>
                </div>
                
                <div class="p-6 bg-white border-b border-gray-200">
                {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>