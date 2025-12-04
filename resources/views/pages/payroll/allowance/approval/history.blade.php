@extends('layouts.app')
@section('title')
Daftar History Tunjangan
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         {{-- <li class="breadcrumb-item" aria-current="page">Payroll</li> --}}
         <li class="breadcrumb-item active" aria-current="page">Daftar History Tunjangan</li>
      </ol>
   </nav>

   <div class="card">
      <div class="card-header p-3 bg-light text-uppercase d-flex justify-content-between">
         <h3>Daftar History Tunjangan</h3>
         <a href="{{route('allowance.approval.list', enkripRambo($level))}}" class="btn  btn-light border">Approval List</a>
         
      </div>
      <div class="card-body p-0">
         <div class="table-responsive">
            <table class="table table-lg">
               <thead>
                  <tr>
                     <td colspan="8" class="">Daftar <b>Pengajuan Tunjangan</b> yang telah melewati validasi anda, klik 'Detail' untuk melakukan detail.</td>
                     
                  </tr>
                  
                  <tr>
                     <th class="text-white">Jenis</th>
                     <th class="text-center text-white">Month</th>
                     <th class="text-center text-white">Year</th>
                     <th class="text-center text-white">Qty Employee</th>
                     <th class="text-right text-white">Total Value</th>
                     <th class="text-white">Status</th>
                     {{-- <th class="text-white">Action</th> --}}
                  </tr>
                  
               </thead>
               <tbody>
         
                  @foreach ($allowanceHistories as $allowU)
                     <tr>
                        <td>
                           <a href="{{route('allowance.unit.detail', enkripRambo($allowU->id))}}"><x-status.allowance.type-unit :allowanceunit="$allowU" /></a>
                           
                        </td>
                        <td class="text-center">{{$allowU->month}}</td>
                        <td class="text-center">{{$allowU->year}}</td>
                        <td class="text-center">{{$allowU->qty}}</td>
                        <td class="text-right">{{formatRupiahB($allowU->total)}}</td>
                        <td>
                           <x-status.allowance.status-unit :allowanceunit="$allowU" />
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
                  
                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>




@endsection