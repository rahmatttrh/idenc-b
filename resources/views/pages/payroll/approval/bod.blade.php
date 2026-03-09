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
         <h1>{{ count($unitTransactions) + count($allowanceApprovals) + count($absenceApprovals) }} Form Menunggu Approval</h1>
         {{-- <div>
            @if(auth()->user()->username == 'EN-2-001' || auth()->user()->hasRole('HRD'))
            <a href="{{route('payroll.approval.manhrd.history')}}" class="btn  btn-light">History</a>
            @elseif (auth()->user()->username == '11304')
            <a href="{{route('payroll.approval.manfin.history')}}" class="btn  btn-light">History</a>
            @elseif (auth()->user()->username == 'EN-2-006')
            <a href="{{route('payroll.approval.gm.history')}}" class="btn  btn-light">History</a>
            @elseif (auth()->user()->username == 'BOD-002')
            <a href="{{route('payroll.approval.bod.history')}}" class="btn  btn-light">History</a>
         @endif
         </div> --}}
         
         
      </div>
      <div class="card-body p-0">
         <div class="table-responsive">
            <table class="table table-lg">
               <thead>
                  <tr>
                     <td colspan="7" class="">Daftar <b>Payslip Report</b> yang membutuhkan validasi anda, klik 'Detail' untuk melakukan validasi.</td>
                     <td><a href="{{route('payroll.approval.bod.history')}}" class="btn btn-sm border  btn-light">History</a></td>
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
                  @if(count($unitTransactions) > 0)
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
                        <td><a href="{{route('payroll.transaction.monthly', enkripRambo($trans->id))}}">{{$trans->unit->name}}</a></td>
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
                  @else
                     <tr>
                        <td colspan="9" class="text-center">Tidak ada data</td>
                     </tr> 
                     @endif
                  
                  
               </tbody>
            </table>
         </div>
         <hr>

         <div class="table-responsive">
            <table class="table table-lg">
               <thead>
                  <tr>
                     <td colspan="8" class="">Daftar <b>Pengajuan Tunjangan</b> yang membutuhkan validasi anda, klik 'Detail' untuk melakukan validasi.</td>
                     <td><a href="{{route('allowance.history.list', enkripRambo(4))}}" class="btn btn-sm border  btn-light">History</a></td>
                  </tr>
                  
                  <tr>
                     <th class="text-white">#</th>
                     <th class="text-white">Jenis</th>
                     <th class="text-white">Unit</th>
                     <th class="text-white">Month</th>
                     <th class="text-center text-white">Year</th>
                     <th class="text-center text-white">Qty Employee</th>
                     <th class="text-right text-white">Total Value</th>
                     <th class="text-white">Status</th>
                     <th class="text-white">Action</th>
                  </tr>
                  
               </thead>
               <tbody>
                  @php
                      $no = 0;
                  @endphp

                  @if(count($allowanceApprovals) > 0)
                  @foreach ($allowanceApprovals as $allowU)
                     <tr>
                        <td>{{++$no}}</td>
                        <td>
                           <a href="{{route('allowance.unit.detail', enkripRambo($allowU->id))}}"><x-status.allowance.type-unit :allowanceunit="$allowU" /></a>
                           
                        </td>
                        <td class="">{{$allowU->unit->name}}</td>
                        <td class="">{{$allowU->month}}</td>
                        <td class="text-center">{{$allowU->year}}</td>
                        <td class="text-center">{{$allowU->qty}}</td>
                        <td class="text-right">{{formatRupiahB($allowU->total)}}</td>
                        <td>
                           <x-status.allowance.status-unit :allowanceunit="$allowU" />
                        </td>
                        <td>
                           <a href={{route('allowance.unit.detail', enkripRambo($allowU->id))}}"">Detail</a>
                        </td>
                        {{-- <td>
                           <a href="">Delete</a>
                        </td> --}}
                     </tr>

                  {{-- <div class="modal fade" id="modal-delete-master-transaction-{{$allowU->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content text-dark">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body ">
                              Delete data transaction  ?
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-danger ">
                                 <a class="text-light" href="{{route('payroll.delete.master.transaction', enkripRambo($allowU->id))}}">Delete</a>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div> --}}
                  @endforeach
                  @else
                     <tr>
                        <td colspan="9" class="text-center">Tidak ada data</td>
                     </tr> 
                  @endif
                  
                  
               </tbody>
            </table>
         </div>

         <hr>
         <div class="table-responsive">
            <table class="table table-lg">
               <thead>
                  <tr>
                     <td colspan="5" class="">Daftar <b>Pengajuan Form Absensi</b> yang membutuhkan validasi anda, klik 'Detail' untuk melakukan validasi.</td>
                    
                     <td><a  href="{{ route('leader.absence.history') }}" class="btn btn-sm border  btn-light">History</a></td>
                  </tr>
                  
                 <tr>
                        <th class="text-white">#</th>
                        <th class="text-white">Employee</th>
                        {{-- <th class="text-white">Name</th> --}}
                        {{-- <th class="text-white">ID</th> --}}
                        <th class="text-white">Type</th>
                        
                        <th class="text-white">Date</th>
                        <th class="text-white">Status</th>
                         <th class="text-white">Detail</th>
                     </tr>
                  
               </thead>
               <tbody>
                  @php
                      $no = 0;
                  @endphp
         

         @if(count($absenceApprovals) > 0)    
                  @foreach ($absenceApprovals as $absence)
                      <tr>
                        <td>{{++$no}}</td>
                        <td class="text-truncate"><a href="{{route('employee.absence.detail', [enkripRambo($absence->id), enkripRambo('approval')])}}"> {{$absence->employee->nik}} {{$absence->employee->biodata->fullName()}}</a></td>
                        {{-- <td class="text-truncate"> </td> --}}
                        {{-- <td>
                           <a href="{{route('employee.absence.detail', [enkripRambo($absence->id), enkripRambo('approval')])}}">
                              {{$absence->code}}
                           </a>
                           
                        </td> --}}
                        <td class="text-truncate">
                           <a href="{{route('employee.absence.detail', [enkripRambo($absence->id), enkripRambo('approval')])}}">
                              <x-status.absence :absence="$absence" />
                        </a>
                           
                        </td>
                        
                        {{-- <td>{{$absence->employee->location->name}}</td> --}}
                        
                        {{-- <td>{{formatDayName($absence->date)}}</td> --}}
                        <td class="text-truncate">
                           @if ($absence->type == 5 || $absence->type == 10)
                              @if (count($absence->details) > 0)
                                    @if (count($absence->details) > 1)
                                          {{count($absence->details)}} Hari (
                                          @foreach ($absence->details  as $item)
                                          {{ formatDate($item->date) }} ,
                                          @endforeach
                                          )
                                          {{-- {{$absence->details->first()->date}} --}}
                                          @else
                                          @foreach ($absence->details  as $item)
                                          {{-- {{$item->date}}  --}}
                                          {{$absence->details->first()->date}}
                                          @endforeach
                                    @endif
                                    
                                 @else
                                 {{-- Tanggal belum dipilih --}}
                              @endif
                           {{-- {{count($absence->details)}} Hari --}}
                              @else
                              {{$absence->date}}
                        @endif
                        </td>
                        {{-- <td>{{$absence->desc}}</td> --}}
                        <td class="text-truncate">
                           <x-status.form :form="$absence" />
                           
                        </td>
                        <td class="text-truncate"><a href="{{route('employee.absence.detail', [enkripRambo($absence->id), enkripRambo('approval')])}}"> Detail</a></td>
                        {{-- <td>
                           {{$absence->release_date}}
                        </td> --}}
                     
                     </tr>
                  @endforeach
                  @else
                     <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                     </tr>
                     @endif
                  
                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>




@endsection