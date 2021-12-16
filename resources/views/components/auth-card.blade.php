<div class="bg-gray-100 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 " style="background-image:url('https://picsum.photos/id/1010/1922/1058.jpg') ">
    <div  class=" bg-white px-14 py-3 rounded">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
