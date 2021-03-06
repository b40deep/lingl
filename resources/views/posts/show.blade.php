

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Help {{  $post->user->name }} with the  {{  $post->language->name }} translation for the content below:
            <!-- {{$commenter = 'undefined'}} -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if( $post->images->first() != null)
                    <div class="flex flex-wrap pb-6">
                        <!-- <img src="https://picsum.photos/2000" class=" rounded-xl" alt="{{ $post->img_alt_text }}"/> -->
                        <img src="{{ $post->images->first()->image_url }}" class=" rounded-xl max-w-full h-auto " alt="{{ $post->img_alt_text }}"/>
                    </div>
                    @endif
                     <div class="text-lg">
                        {{$post->content }}
                    </div> 
                    <div class="flex justify-end text-sm">
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
                                {{ $post->views->unique('user_id')->count() }} unique post views to date, {{ $post->views->count() }} in total.
                            </span>
                        </span>
                        @foreach($post->tags->unique() as $tag)
                        <span class="ml-3 rounded-2xl bg-gray-100 px-3 py-0.5">
                            <span class="text-sm text-gray-500"> 
                            {{ $tag->name }}
                            </span>
                        </span>
                        @endforeach
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
                </div>

                <!-- Comments section-->

                <div id="comments" class="p-6 px-8 bg-white border-b border-gray-200">
                    <div class="text-xl font-bold w-full">Translations from the community:</div>
                    <hr class="boder-b-0 my-4"/>                    
                    <ul v-for="comment in comments">
                        <li :key="comment['id']">@{{ comment['content'] }} 
                    <div class="flex justify-end  text-sm">
                        <span class="ml-3 rounded-2xl bg-gray-50 px-3 py-0.5">
                            <span id="user" class="text-sm text-gray-500"> 
                                by @{{ comment['user_id'] }} 
                            </span>
                        </span>
                        <span v-if="hasAccess(comment['user_id'],'{{auth()->user()->name}}')">
                            <a v-on:click="editComment(comment['content'], comment['id'])" href="#comments">
                                <span class="ml-3 rounded-2xl bg-red-50 px-3 py-0.5">
                                    <span class="text-sm text-red-500"> 
                                        Edit
                                    </span>
                                </span>
                            </a>
                            <a v-on:click="deleteComment(comment['id'])" href="#comments">
                                <span class="ml-3 rounded-2xl bg-red-50 px-3 py-0.5">
                                    <span class="text-sm text-red-500"> 
                                        Delete
                                    </span>
                                </span>
                            </a>
                        </span>
                    </div>
                        </li>
                        <hr class="boder-b-0 my-4"/>                    
                    </ul> 

                    


                    <label for="content" class="text-gray-600 font-light">Leave a translation</label>
                    <input v-model="newComment" name="content" value="{{ old('content') }}" type='text' placeholder="don't be shy..." class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" />
                    <button v-on:click="createComment('{{auth()->user()->id}}')" class="bg-blue-600 text-gray-200 rounded-xl hover:bg-blue-500 focus:outline-none px-4 py-2 ">Send translation!</button>
                    <a href=" {{ route( 'posts.index' ) }} " type="button" class="border border-gray-400 text-gray-600 hover:bg-gray-600 hover:text-gray-100 rounded-xl px-4 py-2 ml-3">Maybe next time...</a>
                </div>
                <script>
                    var app = new Vue({
                        el: "#comments",
                        data: {
                            comments: [],
                            newComment: '',
                            edited:'',
                        },
                        mounted(){
                            this.getComments()
                                },
                        methods:{
                            getComments:function () {
                                axios.get("{{ route( 'api.comments.index' , [ 'post' => $post] ) }}")
                                            .then(response=>{
                                                this.comments = response.data;
                                                this.edited='';
                                            })
                                            .catch(response=>{
                                                console.log(response);
                                                alert("please refresh and try again");
                                            })    
                                },
                            createComment:function(uid){
                                axios.post("{{ route( 'api.comments.store' , [ 'post' => $post ] ) }}",
                                        {
                                            content:this.newComment,
                                            user:uid,
                                            edited:this.edited
                                        })
                                        .then(response=>{                                            
                                            // this.comments.push(response.data);
                                            this.getComments()
                                            this.newComment='';
                                            this.edited='';
                                        })
                                        .catch(response=>{
                                            console.log(response);
                                            alert("please check your input or refresh and try again");
                                        })
                                },
                            editComment:function(editable,cid){
                                        // alert('edit comment'+ editable);
                                        this.newComment=editable;
                                        this.edited=cid;
                                },
                            deleteComment:function(commentx){
                                        // alert('delete comment'+ commentx);
                                        axios.post("{{ route( 'api.comments.del' ) }}",
                                        {
                                            content:commentx
                                        })
                                        .then(response=>{                                            
                                            // console.log(response.data);
                                            // console.log(response);
                                            response ? this.getComments() : null;
                                            this.edited='';
                                        })
                                        .catch(response=>{
                                            console.log(response);
                                            alert("this didn't work out. please refresh and try again");
                                        })
                                },
                            hasAccess: function (a,b) {
                            // return 'Basic User';
                            return a === b || b === "Super User";
                            // return true;
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