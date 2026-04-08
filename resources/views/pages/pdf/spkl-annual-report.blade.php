@extends('layouts.app-doc')
@section('title')
Annual SPKL Report
@endsection
@section('content')

<style>
   html {
      -webkit-print-color-adjust: exact;
   }

   table,
   th,
   td {
      
      /* border: 1px solid black;
      border-collapse: collapse; */
   }

   .ttd {
      font-size: 10px;
   }

   table td {
      font-size: 10px;
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 5px;
      padding-right: 5px;
      border: 1px solid rgb(180, 173, 173);
   }

   table th {
      font-size: 10px;
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 5px;
      padding-right: 5px;
      background-color: rgb(200, 200, 202);
      border: 1px solid rgb(180, 173, 173);
   }



   table {
      width: 100%;
      border: 1px solid rgb(180, 173, 173);
   }


   .border-none {
      border: none;
   }

   /* table td {
      font-size: 8px;
   } */
</style>


<div class="page-body">
   {{-- <div class="container-xl"> --}}
      <div class="card card-lg shadow-none border-none">
         {{-- <div class="card-footer d-print-none">
            <small>*Disarankan merubah layout ke mode <b>landscape</b> setelah klik tombol 'Print' untuk hasil yang lebih baik.</small>
         </div> --}}
         <div class="card-body px-2 py-1">
              
            
            <h1 class="text-uppercase">Summary Jumlah  {{ $typeName }} per Tahun</h1>
            <h1 class="text-uppercase">PT {{$unit->name}} @if ($department)
                <b>- {{ $department->name }} </b> 
            @endif
            @if ($location)
                <b>| {{ $location->name }} </b> 
            @endif</h1>
            <span class="text-uppercase"><b>Tahun {{$year}}</b> </span> <br>
            
            <div class="border-bottom"></div>

            <div class="py-2 d-print-none">
               <small class="">#Value yang ditampilkan berdasarkan data SPKL yang telah disetujui pada periode tanggal Cut Off bulan tersebut</small>
            </div>
            


           
            
            <table class="table-sm mt-3 mb-2">
               <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Unit</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Lokasi</th>
                        <th class="text-center">JAN</th>
                        <th class="text-center">FEB</th>
                        <th class="text-center">MAR</th>
                        <th class="text-center">APR</th>
                        <th class="text-center">MEI</th>
                        <th class="text-center">JUN</th>
                        <th class="text-center">JUL</th>
                        <th class="text-center">AUG</th>
                        <th class="text-center">SEP</th>
                        <th class="text-center">OCT</th>
                        <th class="text-center">NOV</th>
                        <th class="text-center">DEC</th>
                    </tr>
               </thead>
               <tbody>
                @foreach ($employees as $emp)
                    <tr>
                        <td style="width: 25px" class="text-center">{{++$i}}</td>
                        
                        <td>{{$emp->nik}}</td>
                        <td>{{$emp->biodata->fullName()}}</td>
                        <td>{{$emp->unit->name}}</td>
                        <td>{{$emp->department->name}}</td>
                        <td>{{$emp->position->name}}</td>
                        <td>{{$emp->location->code}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(1,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(2,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(3,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(4,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(5,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(6,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(7,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(8,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(9,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(10,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(11,$year, $type)}}</td>
                        <td class="text-center">{{$emp->getSpklMonthly(12,$year, $type)}}</td>
                    </tr>
                @endforeach
               </tbody>
            </table>
         </div>
         
      </div>
   {{-- </div> --}}
</div>
@endsection