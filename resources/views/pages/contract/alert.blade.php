@extends('layouts.app')
@section('title')
Contract Alert
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         
         <li class="breadcrumb-item active" aria-current="page">Contract Alert</li>
      </ol>
   </nav>

   <div class="card">
      <div class="card-body">
         <b>Contract Alert</b> <br>
         <div class="py-2">
            <b>Note</b>: Kontrak Kerja Karyawan yang akan berakhir dalam waktu 2 bulan kedepan
         </div>
         
         <div class="table-responsive mt-2 border-top pt-3">
            <table id="myTable" class="display basic-datatables table-sm table-bordered  table-striped ">
               <thead>
                  
                  <tr>
                     <th scope="col">NIK</th>
                     <th scope="col" >Name</th>
                     <th>Unit</th>
                     <th>Department</th>
                     <th>Expired</th>
                  </tr>
                  
               </thead>
                <tfoot>
                        <tr>
                           <th class=""></th>
                           <td @disabled(true) colspan=""></td>
                           <th ></th>
                           <th></th>
                           <th></th>
                        </tr>
                     </tfoot>
               <tbody>
                  @foreach ($contractAlerts as $con)
                      <tr>
                        <td>
                           <a href="{{route('employee.detail', [enkripRambo($con->employee->id), enkripRambo('contract')])}}">{{$con->employee->nik ?? ''}}</a> 
                           @if (auth()->user()->hasRole('Administrator'))
                               {{$con->id}}
                           @endif
                        </td>
                        <td>
                           <a href="{{route('employee.detail', [enkripRambo($con->employee->id), enkripRambo('contract')])}}"> {{$con->employee->biodata->fullName()}}</a> 
                          
                        </td>
                        <td>{{$con->employee->unit->name}}</td>
                        <td>{{$con->employee->department->name}}</td>
                        <td>{{formatDateB($con->end)}}</td>
                      </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
   

  


</div>




@endsection