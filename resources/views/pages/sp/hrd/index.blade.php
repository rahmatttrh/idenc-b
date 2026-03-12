@extends('layouts.app')
@section('title')
Approval SP & Teguran
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         
         <li class="breadcrumb-item active" aria-current="page">Approval SP dan Teguran</li>
      </ol>
   </nav>


    <div class="card">
      <div class="card-body">
         <b>Approval SP dan Teguran</b> <br>
         <div class="py-2">
            <b>Note</b>: Daftar Pengajuan SP & Teguran yang membutuhkan Approval HRD
         </div>
         
         
          <div class="table-responsive mt-2 border-top pt-3 ">
            <table id="data" class="display datatables-4 table-sm p-0">
               <thead>
                  <tr>
                     {{-- <th class="text-center" style="width: 10px">No</th> --}}
                     <th>ID</th>
                     <th>NIK</th>
                     <th>Name</th>
                     
                     
                     <th>Level</th>
                     <th>Status</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>

                  @foreach ($spApprovals as $sp)
                  <tr>
                     {{-- <td class="text-center">{{++$i}}</td> --}}
                     <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->code}}</a> </td>
                     <td class="text-truncate" >{{$sp->employee->nik}}</td>
                     <td class="text-truncate"> {{$sp->employee->biodata->fullName()}}</td>
                     {{-- <td>{{$sp->employee->nik}}</td> --}}
                     {{-- <td>{{formatDate($sp->date)}}</td> --}}
                     <td>SP {{$sp->level}}</td>
                     <td class="text-truncate">{{$sp->date}}</td>
                     <td class="text-truncate">
                        <x-status.sp :sp="$sp" />
                     </td>
                     
                     {{-- <td class="text-truncate" style="max-width: 240px">{{$sp->desc}}</td> --}}

                  </tr>
                  @endforeach

                  @foreach ($stApprovals as $st)
                  <tr>
                     {{-- <td class="text-center">{{++$i}}</td> --}}
                     <td><a href="{{route('st.detail', enkripRambo($st->id))}}">{{$st->code}}</a> </td>
                     <td class="text-truncate">{{$st->employee->nik}}</td>
                     <td class="text-truncate"> {{$st->employee->biodata->fullName()}}</td>
                     {{-- <td>{{$st->employee->nik}}</td> --}}
                     {{-- <td>{{formatDate($st->date)}}</td> --}}
                     <td>Teguran</td>
                     <td class="text-truncate">{{$st->date}}</td>
                     <td class="text-truncate">
                        <x-status.st :st="$st" />
                     </td>
                     
                     {{-- <td class="text-truncate" style="max-width: 240px">{{$sp->desc}}</td> --}}

                  </tr>
                  @endforeach
               </tbody>

            </table>
         </div>
      </div>
   </div>

   

   


</div>




@endsection