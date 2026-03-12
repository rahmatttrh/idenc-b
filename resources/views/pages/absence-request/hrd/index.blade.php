@extends('layouts.app')
@section('title')
Monitoring Form Absensi
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         
         <li class="breadcrumb-item active" aria-current="page">Monitoring Form Absensi </li>
      </ol>
   </nav>

   <div class="card ">
      

      <div class="card-body">

          {{-- <ul class="nav nav-tabs px-3">
            <li class="nav-item">
               <a class="nav-link active" href="{{route('hrd.spkl')}}">Approval SPKL  
                  
                  @if (count($spklApprovals) > 0)
                  <span class="text-danger"><b>({{count($spklApprovals)}})</b></span>
                  @endif
                  
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{route('hrd.spkl.monitoring')}}">Monitoring SPKL</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="{{route('hrd.spkl.history')}}">History SPKL</a>
             </li>
           
          </ul> --}}
          <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link  {{$activeTab == 'approval' ? 'active' : ''}} " id="pills-home-tab"  href="{{route('hrd.absence.approval')}}" >
                 Approval Form Absence
                  @if ($totalApproval > 0)
                     <span class="">({{$totalApproval}})</span>
                  @endif
               </a>
            </li>
            
            
            <li class="nav-item">
               <a class="nav-link {{$activeTab == 'index' ? 'active' : ''}}" id="pills-profile-tab" href="{{route('hrd.absence')}}">Monitoring  Form Absence</a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{$activeTab == 'history' ? 'active' : ''}}" id="pills-profile-tab" href="{{route('hrd.absence.history')}}">History  Form Absence</a>
            </li>
            
           
         </ul>
          

         {{-- <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link {{$activeTab == 'approval' ? 'active' : ''}}" href="{{route('hrd.absence.approval')}}">
                  Approval Absence
                  @if ($totalApproval > 0)
                     <span class="badge badge-danger">{{$totalApproval}}</span>
                  @endif
               </a>
            </li>
            

            
            <li class="nav-item">
               <a class="nav-link {{$activeTab == 'index' ? 'active' : ''}}" href="{{route('hrd.absence')}}">
                  Monitoring  Form Absence
               </a>
             </li>

             <li class="nav-item">
               <a class="nav-link {{$activeTab == 'history' ? 'active' : ''}}" href="{{route('hrd.absence.history')}}">History  Form Absence</a>
             </li>
           
         </ul> --}}

         @if ($activeTab == 'history')
            <div class="row">
               <div class="col-md-6 py-2">
                  @if ($from == null)
                      
                  <b>Note</b>: Untuk menjaga performa sistem, secara default hanya 800 data yang ditampilkan. Silahkan gunakan filter atau pencarian untuk menampilkan data yang lebih spesifik.
                  @else
                  <b>Note</b>: Menampilkan total {{count($reqForms)}} data dari {{ \Carbon\Carbon::parse($from)->format('d M Y') }} hingga {{ \Carbon\Carbon::parse($to)->format('d M Y') }}.
                  @endif
               </div>
               <div class="col-md-6">
                   <form action="{{route('hrd.absence.history.filter')}}" class="mt-2" method="POST">
               @csrf
               <div class="row mx-1">
                  <div class="col-md-4">
                     <input type="date" class="form-control" name="from" id="from" value="{{$from}}">
                  </div>
                  <div class="col-md-4">
                     <input type="date" class="form-control" name="to" id="to" value="{{$to}}">
                  </div>
                  <div class="col-md-4">
                     <button class="btn btn-primary btn-blockubmit">Filter</button>
                  </div>
               </div>
                  
              </form>
               </div>
            </div>
            @elseif($activeTab == 'approval')
            <div class="py-2">
               <b>Note</b>: Daftar Formulir Absensi (Cuti/SPT/Izin/Sakit) yang menunggu approval HRD.
            </div>
             
             @elseif($activeTab == 'index')
             <div class="py-2">
             <b>Note</b>: Daftar Formulir Absensi (Cuti/SPT/Izin/Sakit) yang dibuat oleh semua Karyawan yang masih dalam proses approval atasan.
             </div>
         @endif
          

         <div class="table-responsive mt-2 border-top pt-2">
            <table id="data" class="datatables-6">
               <thead>
                  <tr>
                     <th>ID</th>
                     
                     <th>NIK</th>
                      <th>Name</th>
                      <th>Type</th>
                      {{-- <th>Loc</th> --}}
                     
                     {{-- <th>Day</th> --}}
                     <th>Date</th>
                     {{-- <th>Desc</th> --}}
                     <th>Status</th>
                     {{-- <th>Last Updated</th> --}}
                     <th>Atasan</th>
                     <th>Manager</th>
                  </tr>
               </thead>

               <tbody>
                  @foreach ($reqForms as $absence)
                  <tr>
                     <td class="text-truncate">
                        <a href="{{route('employee.absence.detail', [enkripRambo($absence->id), enkripRambo('monitoring')])}}">
                           {{$absence->code}}
                        </a>
                     </td>
                     
                     <td class="text-truncate"><a href="{{route('employee.absence.detail', [enkripRambo($absence->id), enkripRambo('monitoring')])}}"> {{$absence->employee->nik}}</a></td>
                      <td class="text-truncate"> {{$absence->employee->biodata->fullName()}}</td>
                      <td class="text-truncate">
                        <a href="{{route('employee.absence.detail', [enkripRambo($absence->id), enkripRambo('monitoring')])}}">
                           <x-status.absence :absence="$absence" />
                           @if (count($absence->details) > 1)
                               ({{count($absence->details)}} hari)
                           @endif
                        
                        </a>
                        
                     </td>
                      {{-- <td>{{$absence->employee->location->name}}</td> --}}
                     
                     {{-- <td>{{formatDayName($absence->date)}}</td> --}}
                     <td class="text-truncate" >
                       <x-absence.date :absence="$absence" />
                     </td>
                     {{-- <td>{{$absence->desc}}</td> --}}
                     <td class="text-truncate">
                        <x-status.form :form="$absence" />
                        {{-- @if ($absence->status == 1)
                            <span class="text-primary">Approval Atasan</span>
                        @endif --}}
                     </td>
                     {{-- <td class="text-truncate">
                      <a  href="{{route('employee.absence.detail', enkripRambo($absence->id))}}" class="">Detail</a> |
                        <a href="#"  data-target="#modal-delete-absence-employee-{{$absence->id}}" data-toggle="modal">Delete</a>
                     </td> --}}
                     {{-- <td class="text-truncate">
                        {{$absence->updated_at}}
                     </td> --}}
                     <td class="text-truncate">
                        @if ($absence->leader_id != null)
                            {{$absence->leader->biodata->fullName()}}
                        @endif
                     </td>
                     <td class="text-truncate">
                        @if ($absence->manager_id != null)
                            {{$absence->manager->biodata->fullName()}}
                        @endif
                     </td>
                  </tr>

                  
                  @endforeach
               </tbody>

            </table>
         </div>


      </div>
      <div class="card-footer">
         @if ($activeTab == 'approval')
             
         @endif

         @if ($activeTab == 'index')
             <small></small>
         @endif
         {{-- <a href="{{route('overtime.refresh')}}">Refresh</a> --}}
      </div>


   </div>




  


</div>




@endsection