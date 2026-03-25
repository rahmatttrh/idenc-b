@extends('layouts.app')
@section('title')
Summary Absence
@endsection
@section('content')
<style>
   .btn-rm {
    background: none;
    color: inherit;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;
}
</style>

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Absence<ee/li>
      </ol>
   </nav>


   <div class="card">
      <div class="card-body">
         <b>ABSENSI KARYAWAN</b>
         <ul class="nav nav-pills nav-secondary border-top mt-2" id="pills-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link  active " id="pills-home-tab"  href="{{route('payroll.absence.daily')}}" >
                 Daily
               </a>
            </li>
            
            
            <li class="nav-item">
               <a class="nav-link " id="pills-profile-tab" href="{{route('payroll.absence')}}">Summary</a>
            </li>
            <li class="nav-item">
               <a class="nav-link " id="pills-profile-tab" href="{{route('payroll.absence.recent')}}">Recent Input</a>
            </li>
            <li class="nav-item">
               <a class="nav-link " id="pills-profile-tab" href="{{route('payroll.absence.create')}}">Form Create</a>
            </li>
            <li class="nav-item">
               <a class="nav-link " id="pills-profile-tab" href="{{route('payroll.absence.import')}}">Form Import</a>
            </li>
            
           
         </ul>
         <form action="{{route('payroll.absence.daily.filter')}}" class="mt-2" method="POST">
            @csrf
            <div class="row">
               <div class="col-md-3">
                  
                  <div class="input-group">
                     <input type="date" class="form-control form-control-sm" style="width: 100px" required name="date" id="date" value="{{ $date }}">
                    
                     <button class="btn btn-primary" type="submit">Get Data</button>
                     {{-- <button class="btn btn-dark mx-2" type="button">Add Data</button> --}}
                  </div>
                   <select name="location" id="location" class="form-control py-2">
                        @foreach($locations as $loc)
                        <option {{ $location == $loc->id ? 'selected' : ''  }} value="{{ $loc->id }}">{{$loc->name}}</option>
                        @endforeach
                     </select>
               </div>
            </div>
            
                  {{-- <input type="date" class="form-control" name="date" id="date" value="">
                  <button class="btn btn-primary" type="submit">Filter</button> --}}
            
               
         </form>

         @if ($date != null)
             
         
         <div class="table-responsive mt-2 border-top pt-2">
            <table id="data" class="datatables-2-asc ">
               <thead>
                  <tr>
                     {{-- <th class="text-center">No</th> --}}
                     <th>NIK</th>
                     <th>Nama Karyawan</th>
                     {{-- <th>{{ formatDate($date) }}</th> --}}
                     <th>Kehadiran</th>
                     <th>Pengajuan</th>
                     {{-- <th>Status</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @php
                      $no = 0;
                  @endphp
                  @foreach ($employees as $emp)
                  <tr>
                     {{-- <td style="width: 30px" class="text-center">{{++$i}}</td> --}}
                     <td>{{$emp->nik}}</td>
                     <td>{{$emp->biodata->fullName()}}</td>
                     <td> <a href="#" data-target="#modal-add-absence-{{$emp->id}}" data-toggle="modal">{{ $emp->getDailyAbsence($date) }}</a> </td>
                     <td>{{ $emp->getDailyFormAbsence($date) }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         @else
         <br><br>
         <span >No data available for the selected date.</span>
         @endif
      </div>
   </div>


   
   
   <!-- End Row -->


</div>

@if ($date != null)
   @foreach($employees as $emp)

   <div class="modal fade" id="modal-add-absence-{{$emp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Form Kehadiran<br>
                  
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="{{route('payroll.absence.store.daily')}}" method="POST" >
               @csrf
               <div class="modal-body">
                  @csrf
                  <input type="text"  name="employee" id="employee" value="{{$emp->id}}" hidden>
                  <input type="date"  name="date" id="date" value="{{$date}}" hidden>
                  <input type="number"  name="location" id="location" value="{{$location}}" hidden>

                  <table class="border-bottom mb-2 pb-2">
                     <tr>
                        <th>Karyawan</th>
                        <th>Tanggal</th>
                     </tr>
                     <tr>
                        <td>{{$emp->nik}} {{$emp->biodata->fullName()}}</td>
                        <td>{{formatDate($date)}}</td>
                     </tr>
                     
                  </table>
                 

                  <div class="row mb-2">
                     <div class="col-md-7">
                        <div class="form-group form-group-default">
                           <label>Type</label>
                           <select class="form-control" required name="type" id="type">
                              <option value="" disabled selected>Select</option>
                              <option value="1">Alpha</option>
                              <option value="2">Terlambat</option>
                              <option value="3">ATL</option>
                              {{-- <option value="4">Izin</option>
                              <option value="10">Izin Resmi</option>
                              <option value="5">Cuti</option>
                              <option value="6">SPT</option>
                              <option value="7">Sakit</option>
                              <option value="8">Dinas Luar</option>
                              <option value="9">Off Kontrak</option> --}}
                           </select>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="form-group form-group-default">
                           <label>Keterlambatan</label>
                           {{-- <input type="number" class="form-control" id="minute" name="minute"> --}}
                           <select class="form-control"  name="minute" id="minute">
                              <option value="" disabled selected>Select</option>
                              <option value="T1">T1</option>
                              <option value="T2">T2</option>
                              <option value="T3">T3</option>
                              <option value="T4">T4</option>
                           </select>
                        </div>
                     </div>
                  </div>

                  <div class="">
                     <b>Note</b>: Input data sesuai data mesin absensi.
                  </div>

                  

               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary ">Add</button>
               </div>
            </form>
         </div>
      </div>
   </div>
      
   @endforeach
    
@endif




@endsection