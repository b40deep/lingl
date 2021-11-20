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
                            <li class="p-6 bg-white border-b border-gray-200">{{ $post->p_content }}
                                <span class="ml-3 rounded-2xl bg-gray-100 p-1"><span class="text-sm text-gray-500"> from {{ $post->user->name }}</span></span>
                            </li>
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