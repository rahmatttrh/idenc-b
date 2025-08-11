@extends('layouts.app-doc')
@section('title')
Cuti
@endsection
@section('content')

<style>
   html {
      -webkit-print-color-adjust: exact;
   }

   table,
   th,
   td {
      
      border: 1px solid rgb(143, 139, 139);
      border-collapse: collapse;
   }

   .ttd {
      font-size: 10px;
   }

   table td {
      font-size: 10px;
      padding-top: 3px;
  padding-bottom: 3px;
      padding-left: 5px;
      padding-right: 5px;
   }



   table {
      width: 100%;
   }


   .border-none {
      border: none;
   }
</style>


<div class="page-body">
   <div class="container-xl">
      <div class="card card-lg">
         <div class="card-body">
            <table>
               <tbody>
                  <tr>
                     <td class="text-center" colspan="2" rowspan="2">
                        <img src="{{asset('img/logo/enc1.png')}}" alt="" width="100">
                     </td>
                     <td class="text-center" colspan="4">
                        <h4>FORMULIR</h4>
                     </td>
                     <td class="text-center" colspan="2" rowspan="2">
                        <img src="{{asset('img/logo/ekanuri.png')}}" alt="" width="100"><br>
                        <span>PT Ekanuri</span>
                     </td>
                  </tr>
                  <tr class="text-center">
                     <td colspan="4"><h4>PERMOHONAN SPKL</h4></td>
                  </tr>
                  <tr class="text-center">
                     <td colspan="2">No. Dok : FM.PS.HRD.32</td>
                     <td colspan="4">Rev: 00/22</td>
                     <td colspan="2">Hal : 1 dari 1</td>
                  </tr>
                  

                  <tr>
                     <td colspan="">ID</td>
                     <td colspan="7">{{$empSpkl->code}}</td>
                  </tr>
                  
                  <tr>
                     <td colspan="">Nama</td>
                     <td colspan="7">{{$empSpkl->employee->biodata->fullName()}}</td>
                  </tr>
                  <tr>
                     <td colspan="">NIK</td>
                     <td colspan="7">{{$empSpkl->employee->nik}}</td>
                  </tr>
                  <tr>
                     <td colspan="">Jabatan/Dept</td>
                     <td colspan="7">{{$empSpkl->employee->position->name}}/{{$empSpkl->employee->department->name}}</td>
                  </tr>

                 

                  <tr>
                     <td colspan="">Tanggal</td>
                     <td colspan="7">{{formatDateDayB($empSpkl->date)}}</td>
                  </tr>
                  <tr>
                     <td colspan="">Waktu</td>
                     <td colspan="7">{{$empSpkl->hours_start}}  sd  {{$empSpkl->hours_end}}</td>
                  </tr>
                  <tr>
                     <td colspan="">Lama</td>
                     <td colspan="7">
                        @if ($currentSpkl)
                        {{$currentSpkl->hours}}
                           @else
                           {{$empSpkl->hours}}
                        @endif
                        Jam
                     </td>
                  </tr>
                  <tr>
                     <td colspan="">Pekerjaan</td>
                     <td colspan="7">{{$empSpkl->description}}</td>
                  </tr>
                  <tr>
                     <td colspan="">Lokasi Pekerjaan</td>
                     <td colspan="7">{{$empSpkl->location}}</td>
                  </tr>
                 


                  

                 
                  

                  
               </tbody>
            </table>
            <table>
               <tbody>
                  <tr>
                     <td>Requested by <br> Atasan Langsung</td>
                     <td>Approved by <br>Manager </td>
                     <td>Employee</td>
                  </tr>
                  @if ($empSpkl->status == 201 || $empSpkl->status == 301)
                      @else
                      <tr>
                        <td class="text-center">
                           @if ($empSpkl->status > 1)
                           <span class="text-info">Approved</span>
                           @else
                           
                           @endif
                        </td>
                        <td class="text-center">
                           @if ($empSpkl->status > 2)
                           <span class="text-info">Approved</span>
                           @else
                           
                           @endif
                        </td>
                        <td class="text-center py-3">
                           @if ($empSpkl->status > 0)
                           <span class="text-info">Released</span>
                           @else
                           
                           @endif
                           
                           
                        </td>
                     </tr>
                     <tr>
                        <td class="">
                           @if ($empSpkl->leader_id != null)
                           {{$empSpkl->leader->biodata->fullName()}}
                           @else
                           
                           @endif
                        </td>
                        <td>
                           @if ($empSpkl->status > 2)
                           {{$empSpkl->manager->biodata->fullName()}}
                           @else
                           
                           @endif
                        </td>
                        <td>{{$empSpkl->employee->biodata->fullName()}}</td>
                     </tr>
                     <tr>
                        <td>
                           @if ($empSpkl->approve_leader_date)
                               {{formatDateTime($empSpkl->approve_leader_date)}}
                           @endif
                           {{-- {{$empSpkl->approve_leader_date ?? ''}} --}}
                        </td>
                        <td>
                           @if ($empSpkl->approve_manager_date)
                               {{formatDateTime($empSpkl->approve_manager_date)}}
                           @endif
                           {{-- {{$empSpkl->approve_manager_date ?? ''}} --}}
                        </td>
   
                        
                        <td>
                           @if ($empSpkl->release_employee_date)
                               {{formatDateTime($empSpkl->release_employee_date)}}
                        @endif
                           {{-- {{$empSpkl->release_employee_date ?? ''}} --}}
                        </td>
                     </tr>
                  @endif
                  
               </tbody>
            </table>
            
            
         </div>
      </div>
   </div>
</div>
@endsection