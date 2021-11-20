<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('You can edit your post here') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($errors->any())
            <div class="max-w-7xl mx-auto pb-5 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach ($errors->all() as $error)
                    <div class="bg-red-200 relative text-red-500 py-3 px-3 rounded-lg">
                        {{ $error }}
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if (session('message'))
            <div class="max-w-7xl mx-auto pb-5 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-green-200 relative text-green-500 py-3 px-3 rounded-lg">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <form action=" {{ route( 'posts.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                       @method('PUT')
                       @csrf
                       <!-- class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none    focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" -->
                        <!-- <input type="submit" value="Send to the community!">
                        <a href=" {{ route( 'posts.index' ) }} ">Maybe next time...</a> --> 
                        
                        <label for="content" class="text-gray-600 font-light">What do you need some help translating?</label>
                        <textarea name="content" value="" type='textarea' class="w-full h-auto mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500">{{ $post->content == null ? old('content') : $post->content }}</textarea>
                        <label for="img" class="text-gray-600 font-light">Upload a different image for context?</label>
                        <input type="file" name="image" id="img" class="text-gray-600 font-light"><br/>
                        <input class="bg-blue-600 text-gray-200 rounded-xl hover:bg-blue-500 focus:outline-none px-4 py-2 mt-6"  type="submit" value="Update it!"/>
                        <a href=" {{ route( 'posts.index' ) }} " type="button" class="border border-gray-400 text-gray-600 hover:bg-gray-600 hover:text-gray-100 rounded-xl px-4 py-2 ml-3">Leave it unedited</a>
                    </form>
                    <form action=" {{ route( 'posts.destroy', ['id' => $post->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input class="bg-white border border-red-400 text-red-600 hover:bg-red-500 hover:text-gray-100 rounded-xl focus:outline-none px-4 py-2 mt-6"  type="submit" value="Take it down"/>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>