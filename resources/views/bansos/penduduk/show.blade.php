@extends('layouts.template')

@section('content')
    <header class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-left">
            <div class="flex items-center mb-4">
                <a href="{{ route('bansos.penduduk.request') }}" class="text-blue-main hover:text-blue-main mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 5l-7 7 7 7" />
                    </svg>              
                </a>
                <a href="{{ route('bansos.penduduk.request') }}">
                    <span class="text-blue-main text-md hover:text-blue-main">Data Bantuan Sosial</span>
                </a>
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Data Penerimaan Bantuan Sosial</h1>
            <p class="mt-2 text-base leading-6 text-gray-600 max-w-xl">Silakan melihat data bansos Anda, ya!</p>
        </div>                 
    </header>
    <div class="container mx-auto max-w-7xl mt-2 sm:px-6 lg:px-8">
        @if ($bansos->status == 'menerima')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto" role="alert">
                <strong class="font-bold">Selamat!</strong>
                <span class="block sm:inline">Anda berhak untuk menerima bantuan sosial.</span>
            </div>
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto" role="alert">
                <strong class="font-bold">Maaf!</strong>
                <span class="block sm:inline">Anda belum berhak menerima bantuan sosial.</span>
            </div>
        @endif
    </div>    
    <main class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Your content -->        
        <div class="max-w-7xl mx-auto card p-8 mb-12" style="box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Nama Pengaju</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false" style="text-transform: capitalize;">{{ $bansos->nama_pengaju }}</div>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Nomor Kartu Keluarga</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false">{{ $bansos->kartuKeluarga->NKK }}</div>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Total Pendapatan</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false">
                        {{-- Ubah format angka ke format mata uang Rupiah --}}
                        Rp{{ number_format($bansos->total_pendapatan, 0, ',', '.') }}
                    </div>
                </div>
            </div>            
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Jumlah Tanggungan</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false">{{ $bansos->jumlah_tanggungan }}</div>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Jumlah Kendaraan</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false">{{ $bansos->jumlah_kendaraan }}</div>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Jumlah Watt Listrik</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false">{{ $bansos->jumlah_watt }}</div>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Luas Tanah</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false">{{ $bansos->luas_tanah }}</div>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Luas Rumah</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false">{{ $bansos->luas_rumah }}</div>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Tanggal Pengajuan</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false" style="text-transform: capitalize;">
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bansos->tanggal_bansos)->locale('id')->isoFormat('D MMMM YYYY') }}
                    </div>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                <div class="mt-1 mb-4">
                    <div class="block w-full rounded-md border-0 py-1.5 pl-2 pr-3 
                        text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder-gray-400 focus:ring-2 focus:ring-inset 
                        focus:ring-blue-600 sm:text-sm sm:leading-6" contenteditable="false" style="text-transform: capitalize;">{{ $bansos->status }}</div>
                </div>
            </div>  
        </div>
    </main>
@endsection