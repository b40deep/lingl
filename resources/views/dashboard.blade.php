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

        <div id="alerts" class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a v-on:click="getAlerts('{{auth()->user()->id}}')" href="#alerts"> 
                    <div class="p-6 bg-white border-b border-gray-200">
                        Show translations for your requests:
                    </div>
                </a>
                <ul v-for="alert in alerts">
                    <li :key="alert['id']">
                        <a v-on:click="goToPost(alert['post_id'])" href="#alerts">
                            <div class="p-2 px-10 bg-white border-b border-gray-200">
                                @{{ alert['content'] }} on your post about <span id="user"> @{{ alert['user_id'] }}... </span>
                            </div>
                        </a>
                    </li>
                </ul>
<!-- 
                <a href="{{ route( 'posts.create' ) }}"> 
                    <div class="p-2 px-10 bg-white border-b border-gray-200">
                        So-and-so has helped you translate your request
                    </div>
                </a>
                <a href="{{ route( 'posts.create' ) }}"> 
                    <div class="p-2 px-10 bg-white border-b border-gray-200">
                        So-and-so has helped you translate your request
                    </div>
                </a> -->
            </div>
            

                        
                                </div>
                            </div>
                        </x-app-layout>

            <script>
                    var app = new Vue({
                        el: "#alerts",
                        data: {
                            alerts: [],
                        },
                        mounted(){
                            // this.getAlerts()
                                },
                        methods:{
                            getAlerts:function (user) {
                                axios.post("{{ route( 'api.alerts.index' ) }}",{
                                                user_id:user
                                            })
                                            .then(response=>{
                                                obj = JSON.parse('[{"user_id":"lingl", "post_id":"#", "content":"Sorry, no translations yet..."}]');
                                                this.alerts = response.data[0]===undefined ? obj : response.data ;
                                                // alert('x'+response.data[0]+'x');
                                                // alert('x'+this.alerts+'x'+obj+'x');
                                            })
                                            .catch(response=>{
                                                console.log(response);
                                            })    

                                        // alert('get Alerts '+ user);
                                },
                            editAlert:function(alertx){
                                        // alert('edit Alert'+ editable);
                                },
                            deleteAlert:function(alertx){
                                        // alert('delete comment'+ commentx);
                                        axios.post("{{ route( 'api.alerts.index' ) }}",
                                        {
                                            content:alertx
                                        })
                                        .then(response=>{                                            
                                            // console.log(response.data);
                                            // console.log(response);
                                            response ? this.getAlerts() : null;
                                        })
                                        .catch(response=>{
                                            console.log(response);
                                        })
                                },
                            goToPost:function(linkx){
                                        // alert('link Alert'+ linkx);
                                        window.location.href = "posts/"+linkx;
                                },
                            }
                        });
                </script>