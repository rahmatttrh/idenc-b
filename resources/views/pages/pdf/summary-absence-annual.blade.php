@extends('layouts.app-doc')
@section('title')
Summary Absence Annual
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
            <h1 class="text-uppercase">PT {{ $unit->name }}</h1>
               <b>Laporan Ringkas Kehadiran/Rekapitulasi</b> <br>
            <span >Periode {{formatDateB($from)}} - {{formatDateB($to)}}</span>
            <div class="border-bottom"></div>

            {{-- <table class="mt-2">
               <tbody>
                  <tr>
                     <td style="width: 100px"></td>
                     <td></td>
                  </tr>
                 
               </tbody>
            </table> --}}
            {{-- <br> --}}
            <table  class="table-sm mt-3 mb-2">
               <tbody>
                  <tr>
                     <th class="text-center">No.</th>
                     <th>Nama</th>
                     <th>NIK</th>
                     <th class="text-center ">T</th>
                     <th class="text-center ">ATL</th>
                     <th class="text-center ">I</th>
                     <th class="text-center ">S</th>
                     <th class="text-center ">A</th>
                     <th class="text-center ">C</th>
                  </tr>


                  @foreach ($employees as $emp)
                         <tr>
                           <td style="width: 25px" class="text-center">{{++$i}}</td>
                           <td>{{$emp->biodata->fullName()}}</td>
                           <td>{{$emp->nik}}</td>
                           <td class="text-center">
                              @if (count($emp->absences->where('type', 2)->whereBetween('date', [$from, $to])) > 0)
                              {{count($emp->absences->where('type', 2)->whereBetween('date', [$from, $to]))}}
                              @else
                              0
                              @endif
                           </td>
                           <td class="text-center">
                              @if (count($emp->absences->where('type', 3)->whereBetween('date', [$from, $to])) > 0)
                              {{count($emp->absences->where('type', 3)->whereBetween('date', [$from, $to]))}}
                              @else
                              0
                              @endif
                           </td>
                           <td class="text-center">
                               @if (count($emp->absences->where('type', 4)->whereBetween('date', [$from, $to])) > 0)
                                 {{count($emp->absences->where('type', 4)->whereBetween('date', [$from, $to]))}}
                                 @else
                                 0
                              @endif
                           </td>
                           <td class="text-center">
                              @if (count($emp->absences->where('type', 7)->whereBetween('date', [$from, $to])) > 0)
                              {{count($emp->absences->where('type', 7)->whereBetween('date', [$from, $to]))}}
                              @else
                              0
                              @endif
                           </td>
                           <td class="text-center">
                              @if (count($emp->absences->where('type', 1)->whereBetween('date', [$from, $to])) > 0)
                              {{count($emp->absences->where('type', 1)->whereBetween('date', [$from, $to]))}}
                              @else
                              0
                              @endif
                           </td>
                           <td class="text-center">
                              @if (count($emp->absences->where('type', 5)->whereBetween('date', [$from, $to])) > 0)
                              {{count($emp->absences->where('type', 5)->whereBetween('date', [$from, $to]))}}
                              @else
                              0
                              @endif
                           </td>
                         </tr>
                     @endforeach


                  <tr>
                     
                     <td class="text-center">
                        
                     </td>

                     <td class="text-center py-2">
                        
                     </td>
                     <td class="text-center">
                       
                     </td>
                     <td class="text-center">
                        
                     </td>
                     <td class="text-center">
                        
                     </td>
                     <td class="text-center">
                        
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         
      </div>
   </div>
</div>
@endsection