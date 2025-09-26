@extends('layouts.app')
@section('title')
Payroll Absence
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         {{-- <li class="breadcrumb-item" aria-current="page">Payroll</li> --}}
         <li class="breadcrumb-item active" aria-current="page">Payslip</li>
      </ol>
   </nav>

   <div class="card">
      <div class="card-header p-3 bg-primary text-white text-uppercase d-flex justify-content-between">
         <h1>Approval Payslip</h1>
         @if(auth()->user()->username == 'EN-2-001' || auth()->user()->hasRole('HRD'))
            <a href="{{route('payroll.approval.manhrd.history')}}" class="btn  btn-light">History</a>
            @elseif (auth()->user()->username == '11304')
            <a href="{{route('payroll.approval.manfin.history')}}" class="btn  btn-light">History</a>
            @elseif (auth()->user()->username == 'EN-2-006')
            <a href="{{route('payroll.approval.gm.history')}}" class="btn  btn-light">History</a>
            @elseif (auth()->user()->username == 'BOD-002')
            <a href="{{route('payroll.approval.bod.history')}}" class="btn  btn-light">History</a>
         @endif
         
      </div>
      <div class="card-body p-0">
         <div class="table-responsive">
            <table class="table table-lg">
               <thead>
                  <tr>
                     <td colspan="8" class="">Daftar <b>Payslip Report</b> yang membutuhkan validasi anda, klik 'Detail' untuk melakukan validasi.</td>
                     
                  </tr>
                  <tr class="text-white">
                     <th class="text-white">#</th>
                     <th class="text-white">BSU</th>
                     <th class="text-white">Month</th>
                     <th class="text-white">Year</th>
                     <th class="text-white text-center" >Total Employee</th>
                     <th class="text-white text-center" >Total Salary</th>
                     <th class="text-white text-center" >Status</th>
                     <th class="text-white">Action</th>
                  </tr>
               </thead>
               <tbody>

                  @foreach ($unitTransactions as $trans)
                  @php
                              $projectBersih = 0
                           @endphp

                           @foreach ($trans->payslipReports as $report)

                           @if (count($report->projects) > 0)
                                                   
                                                
                              @foreach ($report->projects as $pro)
                                 @php
                                    $projectBersih = $projectBersih + $pro->gaji_bersih;
                                 @endphp
                              @endforeach
                           @endif

                              
                           @endforeach


                  <tr>
                     <td>{{++$i}}</td>
                     <td>{{$trans->unit->name}}</td>
                     <td>{{$trans->month}}</td>
                     <td>{{$trans->year}}</td>
                     <td class="text-center">{{$trans->total_employee}} / {{count($trans->unit->employees->where('status', 1))}}</td>
                     <td class="text-right"> {{formatRupiahB($trans->payslipReports->sum('gaji_bersih') + $projectBersih)}}</td>
                     <td class="text-center"><x-status.unit-transaction :unittrans="$trans" /></td>
                     <td>
                        <a href="{{route('payroll.transaction.monthly', enkripRambo($trans->id))}}">Detail</a> 
                     </td>
                  </tr>

                  @endforeach
                  
                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>




@endsection