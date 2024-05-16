@extends('dashboard.template')

@section('content')



<div class="text-sm px-5 overflow-x-auto py-5 font-medium text-center rounded-xl w-full bg-white  text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul x-data="{active: 'umkm'}" class="flex overflow-x-auto -mb-px">
            <li class="me-2">
                <button   @click="active = 'umkm'"  :class="active=='umkm' ?'tab text-blue-main border-b-2 border-blue-main  inline-block p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':'tab inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"   data="umkm" >UMKM</button>
            </li>
            <li class="me-2">
                <button @click="active = 'nikah'"  data="nikah"  :class="active=='nikah' ?'tab text-blue-main border-b-2 border-blue-main  inline-block p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':'tab inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"  data="umkm" aria-current="page">Status Nikah</button>
            </li>
            <li class="me-2">
                <button @click="active = 'tinggal'"  data="tinggal" :class="active=='tinggal' ?'tab text-blue-main border-b-2 border-blue-main  inline-block p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':'tab inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"  data="umkm">Status Tempat Tinggal</button>
            </l px-3i>
            <li class="me-2">
                <button @click="active = 'meninggal'"  data="meninggal"  :class="active=='meninggal' ?'tab text-blue-main border-b-2 border-blue-main  inline-block p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':'tab inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"  data="umkm">Status Meninggal</button>
            </li>
           

        </ul>

    <div class="flex w-full justify-between items-center">
        <h2>2 permohonan</h2>
        <div class="filter flex space-x-2">
               
            <div x-data="{open:false}" class="relative " >
                <button @click="open= !open" class="flex px-3 items-center space-x-5 py-2 border-2 border-neutral-400 rounded-full" ><i class="fa-solid fa-sliders"></i> <p>-semua-</p> <i class="fa fa-chevron-down"></i></button>
                <div class="absolute mt-1  left-1/2 -translate-x-1/2 p-0 z-30 bg-white drop-shadow-card w-full" x-show="open" @click.outside="open=false" >
                   <ul>
                    <li><button class="hover:bg-blue-main px-5 py-2 w-full sort" data="diterima"  >selesai</button></li>
                    <li><button class="hover:bg-blue-main px-5 py-2 w-full sort " data="ditolak"  >ditolak</button></li>
                    <li><button class="hover:bg-blue-main px-5 py-2 w-full sort"  data="menunggu" >menunggu</button></li>
                    
                   </ul>
                </div>
            </div>
          
            <div class="border-2 bg-neutral-04 rounded-full px-3">
                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text" id="search" data='umkm' class="border-none bg-transparent" placeholder="cari apapun">  
            </div>
        </div>
    </div>        
    <div id="loading-image" class="fixed top-1/2 left-1/2 flex justify-center items-center -translate-x-1/2 -translate-y-1/2 z-40 w-screen h-screen bg-white opacity-70" style="display: none;" ><div class="  loader " ></div></div>
<div  class="relative  mt-5 overflow-x-auto shadow-md sm:rounded-lg ">
    <table id="umkm" class="w-full text-sm text-left rtl:text-right  text-gray-500 dark:text-gray-400">
   
    </table>
    </div>
    <div class="page"></div>
</div>

    </div>
    
  
 
@endsection

@push('js')
    <script>
        // let button = document.querySelectorAll('.tab');
        // console.log(button)

    


            $(document).ready(function(){
                
                $.ajax({
                        url: "http://127.0.0.1:8000/data/umkm",
                        beforeSend: function() {
              $("#loading-image").show();
           },
                        
                    }).done(function (data) {
                    
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');    
                        const table = doc.getElementById('umkm');
                        const page =doc.querySelector('.Page');
                        console.log(doc);
                           $('#umkm').html(table);
                           $('.page').html(page);
                        $("#loading-image").hide();
                        
                    })
                 
                    
                $('.tab').click(function(index){
                    
                    $.ajax({
                        url: "http://127.0.0.1:8000/data/"+index.currentTarget.getAttribute('data'),
                        beforeSend: function() {
              $("#loading-image").show();
           },
                        
                    }).done(function (data) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');    
                        const table = doc.getElementById('umkm');
                        const page =doc.querySelector('.page');
                           $('#umkm').html(table);
                           $('.page').html(page);
                        $("#loading-image").hide();
                       
                    })
                    
                    
                })

                $('#search').keyup(function () {
                    let data = ($(this).val())
                    if(data == null || data == ""){
                        data='kosong';
                    }
                    console.log(data);
                    
                  
                    $.ajax({
                        url: "http://127.0.0.1:8000/search/"+document.querySelector('#search').getAttribute('data')+'/'+data,
                        async:true,
                        
                    }).done(function (data) {    
                        $('#umkm').html(data)   
                    })

                })

                $('.sort').click(function (index) {
                   
                    $.ajax({
                        url: "http://127.0.0.1:8000/dashboard/pengajuan/"+index.currentTarget.getAttribute('data'),
                        method:"GET",
                        success: function (data) {
                            
                            $('#umkm').html(data);
                        }
                        
                    })
                })

               
               
                
            })

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
    </script>
@endpush