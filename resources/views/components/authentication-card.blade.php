<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="flex justify-center">
            <a href="/"><img width="60" src="{{asset('asset/logo/favicon.png')}}"/></a>
            
        </div>
        <div class="flex justify-center">
            <a href="/" class="text-center text-[#198754] text-2xl mb-5 ">Freelance store</a>
        </div>
        {{ $slot }}
    </div>
</div>
