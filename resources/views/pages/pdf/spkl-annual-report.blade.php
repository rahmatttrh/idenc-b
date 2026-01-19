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
   <div class="container-xl">
      <div class="card card-lg">
         {{-- <div class="card-footer d-print-none">
            <small>*Disarankan merubah layout ke mode <b>landscape</b> setelah klik tombol 'Print' untuk hasil yang lebih baik.</small>
         </div> --}}
         <div class="card-body px-2 py-1">
              
            <h1 class="text-uppercase">PT {{$unit->name}}</h1>
            <b>Summary Jumlah  {{ $typeName }} per Tahun</b>  <br>
            <span class="">Tahun {{$year}}</span>
            <div class="border-bottom"></div>


           
            
            <table class="table-sm mt-3">
               <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>JAN</th>
                        <th>FEB</th>
                        <th>MAR</th>
                        <th>APR</th>
                        <th>MEI</th>
                        <th>JUN</th>
                        <th>JUL</th>
                        <th>AUG</th>
                        <th>SEP</th>
                        <th>OCT</th>
                        <th>NOV</th>
                        <th>DEC</th>
                    </tr>
               </thead>
               <tbody>
                @foreach ($employees as $emp)
                    <tr>
                        <td>{{$emp->biodata->fullName()}}</td>
                        <td>{{$emp->nik}}</td>
                        <td>{{$emp->getSpklMonthly(1,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(2,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(3,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(4,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(5,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(6,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(7,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(8,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(9,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(10,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(11,$year, $type)}}</td>
                        <td>{{$emp->getSpklMonthly(12,$year, $type)}}</td>
                    </tr>
                @endforeach
               </tbody>
            </table>
         </div>
         
      </div>
   </div>
</div>
@endsection