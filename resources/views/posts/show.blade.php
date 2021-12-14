<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Help {{  $post->user->name }} with the  {{  $post->language->name }} translation for the content below:
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if( $post->img_url != null)
                    <div class="flex flex-wrap pb-6">
                        <!-- <img src="https://picsum.photos/2000" class=" rounded-xl" alt="{{ $post->img_alt_text }}"/> -->
                        <img src="{{ $post->img_url }}" class=" rounded-xl max-w-full h-auto " alt="{{ $post->img_alt_text }}"/>
                    </div>
                    @endif
                    {{$post->content }}
                    <!-- <div class="p-4 bg-white border-b border-gray-200">
                        Post details go here:
                    </div> -->
                    <span class="ml-3 rounded-2xl bg-gray-100 px-3 py-0.5">
                        <span class="text-sm text-gray-500"> 
                            asked on {{ $post->created_at }}
                        </span>
                    </span>
                    @if($post->is_edited==1)
                        <span class="ml-3 rounded-2xl bg-gray-100 px-3 py-0.5">
                            <span class="text-sm text-gray-500"> 
                                updated on {{ $post->updated_at }}
                            </span>
                        </span>
                    @endif
                    <span class="ml-3 rounded-2xl bg-gray-100 px-3 py-0.5">
                        <span class="text-sm text-gray-500"> 
                            {{ $post->language_id }} unique post views to date.
                        </span>
                    </span>
                    @can('posts_edit', $post)
                    <a href=" {{ route( 'posts.edit', [ 'post' => $post ] ) }} ">
                    <span class="ml-3 rounded-2xl bg-blue-50 px-3 py-0.5">
                        <span class="text-sm text-blue-500"> 
                                Edit
                            </span>
                        </span>
                    </a>
                    @endcan
                </div>

                <!-- Comments section-->

                <div id="comments" class="p-6 bg-white border-b border-gray-200">
                    <ul><li v-for="comment in comments">@{{ comment['content'] }} by @{{ comment['user_id'] }} </li></ul>
                    <label for="content" class="text-gray-600 font-light">Leave a translation</label>
                    <input v-model="newComment" name="content" value="{{ old('content') }}" type='text' placeholder="don't be shy..." class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" />
                    <button v-on:click="createComment" class="bg-blue-600 text-gray-200 rounded-xl hover:bg-blue-500 focus:outline-none px-4 py-2 ">Send translation!</button>
                    <a href=" {{ route( 'posts.index' ) }} " type="button" class="border border-gray-400 text-gray-600 hover:bg-gray-600 hover:text-gray-100 rounded-xl px-4 py-2 ml-3">Maybe next time...</a>
                </div>
                <script>
                    var app = new Vue({
                        el: "#comments",
                        data: {
                            comments: [],
                            newComment: '',
                        },
                        mounted(){
                            axios.get("{{ route( 'api.comments.index' , [ 'post' => $post ] ) }}")
                                        .then(response=>{
                                            this.comments = response.data;
                                        })
                                        .catch(response=>{
                                            console.log(response);
                                        })
                                },
                        methods:{
                            createComment:function(){
                                axios.post("{{ route( 'api.comments.store' , [ 'post' => $post ] ) }}",
                                        {
                                            content:this.newComment
                                        })
                                        .then(response=>{                                            
                                            this.comments.push(response.data);
                                            this.newComment='';
                                        })
                                        .catch(response=>{
                                            console.log(response);
                                        })
                                }
                            }
                        });
                </script>

                <!-- Leave a Comment-->

                <!-- <div class="p-6 bg-white border-b border-gray-200">
                <form action=" {{ route( 'comments.store', [ 'post' => $post ] ) }}" method="post" enctype="multipart/form-data">
                       @csrf -->
                       <!-- class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none    focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" -->
                        <!-- <input type="submit" value="Send to the community!">
                        <a href=" {{ route( 'posts.index' ) }} ">Maybe next time...</a> --> 
                        <!-- <label for="content" class="text-gray-600 font-light">Leave a translation</label>
                        <input name="content" value="{{ old('content') }}" type='text' placeholder="don't be shy..." class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" />
                        <input class="bg-blue-600 text-gray-200 rounded-xl hover:bg-blue-500 focus:outline-none px-4 py-2 "  type="submit" value="Send translation!"/>
                        <a href=" {{ route( 'posts.index' ) }} " type="button" class="border border-gray-400 text-gray-600 hover:bg-gray-600 hover:text-gray-100 rounded-xl px-4 py-2 ml-3">Maybe next time...</a>
                   </form>
                </div> -->
            </div>
        </div>
    </div>
</x-app-layout>