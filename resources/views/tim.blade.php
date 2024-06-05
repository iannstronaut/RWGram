@extends('layouts.template')

@section('content')
    <header class="bg-white flex justify-center pb-4">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center items-center group">
                <a href="{{ route('/') }}"
                    class="text-blue-main hover:text-blue-main mr-2 group-hover:text-dodger-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 5l-7 7 7 7" />
                    </svg>
                </a>
                <a href="{{ route('/') }}">
                    <span
                        class="text-blue-main text-base font-medium hover:text-dodger-blue-800 group-hover:text-dodger-blue-800">Beranda</span>
                </a>
            </div>
            <h1 class="pt-6 text-3xl font-extrabold text-neutral-10">Tim Pengembang</h1>
        </div>
    </header>

    <div class="grid grid-cols-12 justify-center gap-y-8 px-4 pb-12">
        <div class="flex flex-col col-span-12 lg:col-span-4 items-center max-w-xl mx-auto card py-8 px-12 mb-12 gap-8" style="box-shadow: 0 -2px 6px rgba(91, 76, 76, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
            <div class="text-neutral-10 text-xl font-bold">
                Analyst
            </div>
            <div class="">
                <img src="https://res.cloudinary.com/dtzlizlrs/image/upload/v1716897949/e7dulpy8h3y86sspr8o5.jpg" alt="foto" class="rounded-full object-cover w-[200px] h-[200px] ">
            </div>
            <div class="text-neutral-10 text-base font-medium">
                Muhammad Ridlo Febrio
            </div>

        </div>

        <div class="flex flex-col col-span-12 lg:col-span-4 items-center max-w-xl mx-auto card py-8 px-12 mb-12 gap-8" style="box-shadow: 0 -2px 6px rgba(91, 76, 76, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
            <div class="text-neutral-10 text-xl font-bold">
                UI/UX Designer
            </div>
            <div class="">
                <img src="https://res.cloudinary.com/dtzlizlrs/image/upload/v1716897949/e7dulpy8h3y86sspr8o5.jpg" alt="foto" class="rounded-full object-cover w-[200px] h-[200px]">
            </div>
            <div class="text-neutral-10 text-base font-medium">
                Denny Malik Ibrahim
            </div>

        </div>

        <div class="flex flex-col col-span-12 lg:col-span-4 items-center max-w-xl mx-auto card py-8 px-12 mb-12 gap-8" style="box-shadow: 0 -2px 6px rgba(91, 76, 76, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
            <div class="text-neutral-10 text-xl font-bold">
                Programmer
            </div>
            <div class="">
                <img src="https://res.cloudinary.com/dtzlizlrs/image/upload/v1716897949/e7dulpy8h3y86sspr8o5.jpg" alt="foto" class="rounded-full object-cover w-[200px] h-[200px] ">
            </div>
            <div class="text-neutral-10 text-base font-medium">
                Krisna Andika Wijaya
            </div>

        </div>

        <div class="flex flex-col col-span-12 lg:col-start-3 lg:col-span-4 items-center max-w-xl mx-auto card py-8 px-12 mb-12 gap-8" style="box-shadow: 0 -2px 6px rgba(91, 76, 76, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
            <div class="text-neutral-10 text-xl font-bold">
                Programmer
            </div>
            <div class="">
                <img src="https://res.cloudinary.com/dtzlizlrs/image/upload/v1716897949/e7dulpy8h3y86sspr8o5.jpg" alt="foto" class="rounded-full object-cover w-[200px] h-[200px] ">
            </div>
            <div class="text-neutral-10 text-base font-medium">
                Raffy Jamil Octavialdy
            </div>

        </div>

        <div class="flex flex-col col-span-12 lg:col-span-4 items-center max-w-xl mx-auto card py-8 px-12 mb-12 gap-8" style="box-shadow: 0 -2px 6px rgba(91, 76, 76, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
            <div class="text-neutral-10 text-xl font-bold">
                Tester
            </div>
            <div class="">
                <img src="https://res.cloudinary.com/dtzlizlrs/image/upload/v1716897949/e7dulpy8h3y86sspr8o5.jpg" alt="foto" class="rounded-full object-cover w-[200px] h-[200px] ">
            </div>
            <div class="text-neutral-10 text-base font-medium">
                Albyan Agung Safiqri
            </div>

        </div>

    </div>

    <div class="bg-white mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto card p-8 mb-12"
        style="box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <img src="{{asset('images/WhatsApp 이미지 2024-06-05, 09.07.22_63add9cf.jpg')}}"
                class="rounded-lg object-cover h-[520px] w-full" />
        </div>
    </div>

@endsection
