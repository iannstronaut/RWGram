@extends('dashboard.template')

@section('content')

@push('css')
<style>
    input:focus{
      outline:none !important;
      outline-width: 0 !important;
      box-shadow: none !important;
      -moz-box-shadow: none!important;
      -webkit-box-shadow: none!important;
    }


  </style>
@endpush


@if(isset($report))


<div class="flex w-full justify-start bg-white py-3 px-3 items-center flex-wrap gap-3 sm:justify-around rounded-xl">

    <div class="flex ">
      <div class="py-3 pl-3 ">

        <h1 class="text-md  text-neutral-06">Laporan Menunggu</h1>
        <h1 class=" text-2xl font-regular text-black"> <i class="text-xs fa-solid fa-circle text-yellow-300"></i> {{isset($report['menunggu']) ? $report['menunggu']: '0'}}</h1>
      </div>
    </div>

    <div class=" flex ">
      <div class="py-3 pl-3 ">
        <h1 class="text-md  text-neutral-06">Laporan Selesai</h1>
        <h1 class=" text-2xl font-regular text-black"><i class="text-xs fa-solid fa-circle text-green-400"></i> {{isset($report['selesai']) ? $report['selesai']:'0'}}</h1>
      </div>
    </div>

    <div class=" flex ">
      <div class="py-3 pl-3 ">
        <h1 class="text-md  text-neutral-06">Laporan Diproses</h1>
        <h1 class=" text-2xl font-regular text-black"><i class="text-xs fa-solid fa-circle text-blue-600"></i> {{isset($report['proses'])? $report['proses']:'0'}}</h1>
      </div>
    </div>
    <div class=" flex ">
        <div class="py-3 pl-3 ">
          <h1 class="text-md  text-neutral-06">Laporan Ditolak</h1>
          <h1 class=" text-2xl font-regular text-black"><i class="text-xs fa-solid fa-circle text-red-600"></i>  {{isset($report['ditolak'])? $report['ditolak']:'0'}}</h1>
        </div>
      </div>

  </div>

@endif

<div class="text-sm px-5 overflow-x-auto py-5 font-medium text-center rounded-xl w-full bg-white  text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">

    <div class="flex flex-wrap gap-3 w-full justify-between items-center">
        <div class="filter flex space-x-2">
            <div x-cloak x-data="{open:false}" class="relative " >
                <button @click="open= !open" class=" px-3 hover:bg-blue-main hover:border-blue-main hover:text-white items-center py-2 w-fit  md:min-w-fit md:w-full h-full  border border-gray-300 rounded-full" ><div class="flex min-w-fit md:min-w-[120px] justify-around items-center"><i class=" fa-solid fa-sliders"></i> <p class="hidden md:block" id="sort">-semua-</p> <i class="hidden md:block fa fa-chevron-down"></i></div></button>
                <div class="absolute  mt-1  left-1/2 -translate-x-1/2 p-0 z-50 bg-white drop-shadow-card w-full rounded-lg" x-show="open" @click.outside="open=false" >
                   <ul>
                    <li><button  @click="open= !open" class="hover:bg-blue-main px-5 py-2 w-full sort" data="Selesai"  >Selesai</button></li>
                    <li><button  @click="open= !open" class="hover:bg-blue-main px-5 py-2 w-full sort " data="Ditolak"  >Ditolak</button></li>
                    <li><button  @click="open= !open" class="hover:bg-blue-main px-5 py-2 w-full sort"  data="Menunggu" >Menunggu</button></li>
                    <li><button  @click="open= !open" class="hover:bg-blue-main px-5 py-2 w-full sort"  data="Proses" >Proses</button></li>

                   </ul>
                </div>
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input name="search"  id="search" value="{{ request('search') }}" class="pl-8 block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari pengaduan" required />
            </div>
        </div>
    </div>

<div class=" mt-5 overflow-x-auto shadow-md sm:rounded-lg ">
        <table id='umkm' class="w-full text-sm text-left rtl:text-right  text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-neutral-03 dark:bg-gray-700 dark:text-gray-400">
                <tr class="">
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Pengaju
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6  tpy-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Aksi
                    </th>
                </tr>
            </thead>
            <tbody id="body">

                    @foreach ($data as $umkm)
                        <tr
                            class="bg-white font-medium border-b text-neutral-10 dark:bg-gray-800 dark:border-gray-700 hover:bg-neutral-02 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 whitespace-nowrap dark:text-white">
                                {{ $loop->index + 1 }}
                            </th>

                            <td class="px-6 py-4">
                                {{ $umkm->penduduk->nama_penduduk }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $umkm->tanggal_laporan }}
                            </td>
                            <td class="px-6 py-4  "
                                style="  white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    max-width: 150px; ">

                        {{$umkm->deskripsi_laporan}}
                    </td>
              
                    <td class="px-6 py-4">
                        <div x-cloak x-data="{ open: false }" class="">
                            @php($class = array('menunggu'=>'bg-[#FBF4CF]  w-[150px]  text-[#E9C90E] border border-yellow-100 px-3 py-2 rounded-full font-bold hover:border hover:border-yellow-400',
                                                 'selesai'=>'bg-green-100 text-green-400 w-[150px]  border border-green-100 px-3 py-2 rounded-full font-bold hover:border hover:border-green-400',
                                                 'proses'=>'bg-blue-100 text-blue-main  w-[150px] border border-blue-100 px-3 py-2 rounded-full font-bold hover:border hover:border-blue-400',
                                                 'ditolak'=>'bg-red-100 text-red-400 w-[150px]  border border-red-100 px-3 py-2 rounded-full font-bold hover:border hover:border-red-400'))
                            <button  {{$umkm->status_laporan == 'selesai' ? 'disabled':''}} {{$umkm->status_laporan == 'ditolak' ? 'disabled':''}} @click="open = ! open" class="{{$class[$umkm->status_laporan]}}" >{{$umkm->status_laporan}} <i class="fa-solid fa-chevron-down"></i></button>
                          
                            <div x-show="open" @click.outside="open = false" class="flex flex-col items-center gap-3 mt-1 py-2 w-[200px] inset-0 drop-shadow-card rounded-xl bg-white" \>
                                               
               
                               
                                <button  onclick="showModal({{$umkm->laporan_id}})" class=" bg-green-100 text-green-400 w-[150px]  border border-green-100 px-3 py-2 rounded-full font-bold hover:border hover:border-green-400" >Selesai</button>
                                    
                      <form class="{{$umkm->status_laporan == 'proses' ? 'hidden': ''}}" action="{{url('konfirmasi/pengaduan/'.$umkm->laporan_id)}}" method="POST">
                        @csrf
                        @method('PUT')
                             
                            <input type="hidden" name="status_laporan" value="proses">
                        <button type="submit"  class=" bg-blue-100 text-blue-main  w-[150px] border border-blue-100 px-3 py-2 rounded-full font-bold hover:border hover:border-blue-400" >Proses</button>
                      </form>
                                    
                                <button  onclick="showModal({{$umkm->laporan_id}},'Ditolak')" class=" bg-red-100 text-red-400 w-[150px]  border border-red-100 px-3 py-2 rounded-full font-bold hover:border hover:border-red-400" >Ditolak</button>
                               
                            </div>
                        </div>



                    <td class="px-6 py-4 flex ">
                        <div x-cloak x-data="{ open: false }">
                            <button @click="open = true"  class="hover:border-none  before:absolute text-blue-main bg-dodger-blue-50 hover:bg-dodger-blue-100  px-8 py-2 text-base font-medium rounded-full  " type="button">
                                Detail
                              </button>

                              <!-- Main modal -->
                              <div  x-show="open"   tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden fixed  z-40 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                <div  class="absolute w-[920px] h-[80vh] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2  p-4  z-50 ">
                                      <!-- Modal content -->
                                      <div @click.outside="open = false" class="relative bg-white w-full  rounded-lg shadow dark:bg-gray-700">
                                          <!-- Modal header -->
                                          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Detail
                                              </h3>
                                              <button type="button" @click="open = false" class="absolute -top-5 -right-4 bg-blue-main   text-white border-2 border-white hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " >
                                                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                  </svg>
                                                  <span class="sr-only">Close modal</span>
                                              </button>
                                          </div>
                                          <!-- Modal body -->
                                          <form class="p-4 md:p-5">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pengaduan</label>
                                                    <input readonly type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" value="{{$umkm->tanggal_laporan}}" required="">
                                                </div>
                                                <div class="col-span-2">
                                                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                                                  <input readonly type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" value="{{$umkm->penduduk->NIK}}" required="">
                                              </div>
                                              <div class="col-span-2">
                                                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Anda</label>
                                                  <input readonly type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" value="{{$umkm->penduduk->nama_penduduk}}" required="">
                                              </div>
                                              <div class="col-span-2">
                                                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Laporan</label>
                                                  <textarea readonly id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Write product description here">{{$umkm->deskripsi_laporan}}</textarea>
                                              </div>
                                              <div class="col-span-2">
                                                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                                                  <img src="{{$umkm->foto_laporan}}" alt="Foto Bukti">
                                              </div>


                                            </div>

                                        </form>
                                      </div>
                                  </div>
                                  <div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40"></div>
                              </div>
                        </div>



                        <div x-data= "{open:false}">

                            <button @click="open=true" type="submit" class="hover:border-none  hover:bg-dodger-blue-100  px-8 py-2 text-base font-medium rounded-full  "><svg   xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path  stroke="#EE0B0B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 5.98c-3.33-.33-6.68-.5-10.02-.5-1.98 0-3.96.1-5.94.3L3 5.98m5.5-1.01.22-1.31C8.88 2.71 9 2 10.69 2h2.62c1.69 0 1.82.75 1.97 1.67l.22 1.3m3.35 4.17-.65 10.07C18.09 20.78 18 22 15.21 22H8.79C6 22 5.91 20.78 5.8 19.21L5.15 9.14m5.18 7.36h3.33m-4.16-4h5"/>
                              </svg>
                            </button>
                            <div x-show="open"  class="overflow-y-auto overflow-x-hidden fixed  z-40 justify-center items-center w-full inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div @click.outside="open = false" class="absolute text-center w-full max-w-[500px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-2xl  p-4 bg-white z-50">
                                    <h1 class="text-xl mb-5">Apakah anda yakin ingin menghapus pengaduan ini ?</h1>
                                   <div class="flex w-full space-x-7 justify-center">
                                    <button @click="open= false" class="text-blue-main border-2 border-dodger-blue-800  hover:bg-dodger-blue-800  hover:text-white  px-5 py-2 text-base font-medium rounded-full">Batal</button>
                                    <form action="{{url('/delete/laporan/'.$umkm->laporan_id)}}" onsubmit="return alert('are You sure ?')" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-neutral-01 bg-blue-main hover:bg-dodger-blue-800   px-5 py-2 text-base font-medium rounded-full">Konfirmasi</button>
                                    </form>
                    
                                   </div>
        
                                </div>
                                <div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40"></div> 
                            </div>
        
                        </div>
                    </td>
                    <td>
                        {{-- modal --}}
                        <div id="modal-{{$umkm->laporan_id}}"  class="hidden modal transition duration-150 ease-in-out overflow-y-auto overflow-x-hidden fixed  z-40 justify-center items-center w-full inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div  class="absolute text-center w-full max-w-[500px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-2xl  px-4 py-6 bg-white z-50">
                                <h1 class="text-lg mb-5 text-black">Apakah Anda ingin mengkonfirmasi pengaduan ini ?</h1>
                            <div class="flex w-full space-x-7 justify-center">
                                
                                            <button onclick="closeModal({{$umkm->laporan_id}})" x-bind='SomeButton' class="text-blue-main border-2 border-dodger-blue-800  hover:bg-dodger-blue-800  hover:text-white  px-5 py-2 text-base font-medium rounded-full" type="button">
                                            Kembali
                                            </button>

                                            <form action="{{url('konfirmasi/pengaduan/'.$umkm->laporan_id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status_laporan" value="selesai">

                                <button class="text-neutral-01 bg-blue-main hover:bg-dodger-blue-800   px-5 py-2 text-base font-medium rounded-full">Konfirmasi</button>
                                            </form>

                            </div>

                            </div>
                            <div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40"></div> 
                        </div>
                        <div id="modal-ditolak-{{$umkm->laporan_id}}"  class="modal hidden overflow-y-auto overflow-x-hidden fixed  z-40  justify-center items-center w-full inset-0 h-[calc(100%-1rem)] max-h-full">

                            <div   class="absolute text-left w-full max-w-[500px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-2xl  px-4 py-6 bg-white z-50">
                             <h1 class="text-black text-xl mb-3">Pesan</h1>
                             <form action="{{url('/konfirmasi/pengaduan/ '.$umkm->laporan_id)}}" method="POST">
                                 @csrf
                                 @method('PUT')
                                 <input type="hidden" name="status_laporan" value="ditolak">

                                 <div class="col-span-2">
                               
                                     <textarea required  id="description" rows="4" name="pesan" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Tulis Pesan Disini ..."></textarea>           
                                 </div>
                                <div class="flex w-full justify-center space-x-5">
                                 <button onclick="closeModal('ditolak-'+{{$umkm->laporan_id}})" type="button" class="text-blue-main border-2 border-dodger-blue-800  hover:bg-dodger-blue-800  hover:text-white mt-3 px-5 py-2 text-base font-medium rounded-full" >
                                     Batal
                                   </button>
                                 <button type="submit" class="text-neutral-01 bg-blue-main hover:bg-dodger-blue-800  mt-3 px-5 py-2 text-base font-medium rounded-full">Konfirmasi</button>
                                </div>
                             </form>
                            </div>
                            <div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40"></div> 
                         </div>
                     </div>
                    </td>
                </tr>
                    @endforeach



            </tbody>
        </table>

    </div>

    <nav aria-label="page navigation example" class="page mt-5 text-right">
        <ul class="inline-flex -space-x-px text-sm">
            <li>
                <button {{ $data->previousPageUrl() ? '' : 'disabled' }}
                    onclick="page(event,'{{ $data->previousPageUrl() }}')"
                    class="pagination disabled:bg-neutral-04  flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><i
                        class="fa-solid fa-chevron-left"></i></button>
            </li>
            <li>
                <a href="#"
                    class=" flex items-center justify-center px-3 h-8 bg-blue-main leading-tight  text-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $data->currentPage() }}</a>
            </li>

            <li>
                <button {{ $data->nextPageUrl() ? '' : 'disabled' }} onclick="page(event,'{{ $data->nextPageUrl() }}')"
                    class="pagination disabled:bg-neutral-04  flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><i
                        class="fa-solid fa-chevron-right"></i></button>
            </li>
        </ul>
    </nav>
    </div>
    </div>


    </div>
@endsection

@push('js')
    <script>
        const showModal=(id,status = 'diterima')=>{
           if(status === 'diterima'){
            let modal =document.getElementById('modal-'+id)
            modal.classList.remove('hidden');
           }else{
            let modal =document.getElementById('modal-ditolak-'+id)
            modal.classList.remove('hidden');
           }
        }



        function page(event,link) {

               event.preventDefault()
               $.ajax({
                               url: link,
                               beforeSend: function() {
                     $("#loading-image").show();
                  },
                  success:function(data){
                   const parser = new DOMParser();
                               const doc = parser.parseFromString(data, 'text/html');
                               const table = doc.getElementById('umkm');
                               const page =doc.querySelector('.page');
                                  $('#umkm').html(table);
                                  $('.page').html(page);
                               $("#loading-image").hide();
                  }

                           })
              }


        const openModal = (id) => {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }


const closeModal = (id) => {
   document.querySelector('#modal-'+id).classList.add('hidden');
}




        document.addEventListener('alpine:init', () => {
            Alpine.bind('SomeButton', () => ({
                type: 'button',

                '@click'() {
                    this.open = false

                },

                ':disabled'() {
                    return this.shouldDisable
                },
            }))
        })

        $(document).ready(function() {


                $('#search').change(function () {
                    let data = ($(this).val())
                    if(data == null || data == ""){
                        data='kosong';
                    }
                    $.ajax({
                        url: "{{url('search/pengaduan')}}"+'/'+data,
                        type: "GET",
                        beforeSend: function() {
              $("#loading-image").show();
           },
           error:function(response){
            $("#loading-image").hide();
            $('#umkm').html("<p class='text-black text-center text-xl'>Data Tidak Ditemukan </p>");
           }


                    }).done(function (data) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const table = doc.getElementById('umkm');
                            $('#umkm').html(table);
                            $("#loading-image").hide();
                    })

                })


                $('.sort').click(function (index) {

                    $.ajax({
                        url: "{{url('dashboard/pengaduan')}}"+'/'+index.currentTarget.getAttribute('data'),
                        method:"GET",
                        beforeSend: function() {
              $("#loading-image").show();
           },
                        success: function (data) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const table = doc.getElementById('umkm');
                        const page =doc.querySelector('.page');
                        $('#umkm').html(table);
                        $('.page').html(page);
                        $("#sort").html(index.currentTarget.getAttribute('data'));
                        $("#loading-image").hide();
                    }

                })
            })

        })
    </script>
@endpush