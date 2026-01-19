@extends('layouts.app-doc')
@section('title')
Payslip Report Annual
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
         
         <div class="card-body px-2 py-1">

            <h1 class="text-uppercase">PT {{$unit->name}}</h1>
            <b>Summary <span class="">{{ $title }}</span>   per Tahun</b>  <br>
            <span class="">Tahun {{$year}}</span>
            <div class="border-bottom"></div>

            <table class="table-sm mt-3 mb-2">
               <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama</th>
                        <th>NIK</th>
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
                        <td>{{$emp->biodata->fullName()}}</td>
                        <td>{{$emp->nik}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(1,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(2,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(3,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(4,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(5,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(6,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(7,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(8,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(9,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(10,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(11,$year, $komponen)}}</td>
                        <td class="text-center">{{$emp->getKomponenMonthly(12,$year, $komponen)}}</td>
                    </tr>
                @endforeach
               </tbody>
            </table>
         </div>
         
      </div>
   </div>
</div>
@endsection