@extends('layouts.app')
@section('title')
Tunjangan
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Tunjangan</li>
      </ol>
   </nav>



   <div class="card">
      <div class="card-body ">
         <ul class="nav nav-tabs ">
            
            <li class="nav-item">
              <a class="nav-link active" href="{{route('allowance.unit.index')}}">Tunjangan BSU</a>
            </li>
            <li class="nav-item">
               <a class="nav-link " href="#">Progress</a>
            </li>
            {{-- <li class="nav-item">
               <a class="nav-link " href="{{route('admin.employee.spkl.reject')}}">Rejected</a>
            </li> --}}
            {{-- <li class="nav-item">
               <a class="nav-link " data-target="#modal-add-master-allowance-{{$firstUnit->id}}" data-toggle="modal"><i class="fa fa-plus"></i> Create</a>
            </li> --}}
            
           
          </ul>

          

          
            <div class="row mt-2">
               <div class="col-md-3">
                  {{-- <a class="" href="{{route('payroll.transaction.loc.export.pdf', [enkripRambo($unitTransaction->id), enkripRambo($payslipReport->location_id)])}}" target="_blank"><i class="fa fa-file"></i> Export All PDF</a> --}}
                  {{-- <div class="card shadow-none border">
                     
                     <div class="card-body"> --}}
                        <div class="table-responsive overfloe-auto" style="height: 500px">
                           <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              @foreach ($units as $unit)
                                 <a class="nav-link {{$firstUnit->id == $unit->id ? 'active' : ''}} text-left pl-3"  href="{{route('allowance.unit.index.a', enkripRambo($unit->id))}}" role="tab" aria-controls="v-pills-{{$unit->id}}" aria-selected="true">
                                    
                                     {{$unit->name}}
                                 </a>
                              @endforeach
                           </div>
                        </div>
                     {{-- </div>
                     
                  </div> --}}
               </div>
               <div class="col-md-9">
                  <div class="tab-content" id="v-pills-tabContent">
                     
                     <div class="tab-pane fade show active " id="v-pills-a" role="tabpanel" aria-labelledby="v-pills-a-tab">
                        <div class="table-responsive">
                           <table>
                              <thead>
                                 <tr>
                                    <th colspan="6" class="text-uppercase">TUNJANGAN {{$firstUnit->name}}</th>
                                    <th>
                                       <a href="" class="btn  btn-light btn-block" data-target="#modal-add-master-allowance-{{$firstUnit->id}}" data-toggle="modal"><i class="fas fa-sync"></i> Create</a>
                                    </th>
                                 </tr>
                                 <tr>
                                    <th>Jenis</th>
                                    <th class="text-center">Month</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Qty Employee</th>
                                    <th class="text-right">Total Value</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
         
                                 @foreach ($allowanceUnits as $allowU)
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
                                       <td>
                                          <a href="">Delete</a>
                                       </td>
                                    </tr>
         
                                 <div class="modal fade" id="modal-delete-master-transaction-{{$allowU->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                 </div>
                                 @endforeach
                                 
                                 
                              </tbody>
                           </table>
                        </div>
         
                        
                     </div>
         
                     
         
         
                      
                  </div>
                  <hr>
                  
               </div>
            </div>
      
      </div>
   </div>
   
   
   
</div>


<div class="modal fade" id="modal-add-master-allowance-{{$firstUnit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Pengajuan Tunjangan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.store')}}" method="POST" >
            <div class="modal-body"> 
               @csrf
               {{-- <h3>{{$unit->name}}</h3> --}}
               <input type="number" name="unit" id="unit" value="{{$firstUnit->id}}" hidden>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group form-group-default">
                        <label>Bisnis Unit</label>
                        <div class="mt-2">{{$firstUnit->name}}</div>
                     </div>
                  </div>
                  
                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Month</label>
                        <select name="month" id="month" required class="form-control">
                           <option value="January">January</option>
                           <option value="February">February</option>
                           <option value="March">March</option>
                           <option value="April">April</option>
                           <option value="May">May</option>
                           <option value="June">June</option>
                           <option value="July">July</option>
                           <option value="August">August</option>
                           <option value="September">September</option>
                           <option value="October">October</option>
                           <option value="November">November</option>
                           <option value="December">December</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Year</label>
                        <select name="year" id="year" required class="form-control">
                           
                           <option value="2025">2025</option>
                           <option value="2026">2026</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="form-group form-group-default">
                        <label>Jenis Tunjangan</label>
                        <select name="type" id="type" required class="form-control">
                           {{-- <option value="1">Akomodasi Perdin</option> --}}
                           <option value="2">Kompensasi</option>
                           <option value="3">Uang Duka</option>
                           <option value="4">Tunjangan Pernikahan</option>
                           <option value="5">Tunjangan Kelahiran</option>
                           <option value="6">Insentif</option>
                           
                        </select>
                     </div>
                  </div>
               </div>
              

               <hr>
               <small>
                  Klik "Generate" button dan tunggu beberapa saat <br>
                  Sistem akan secara otomatis menarik data Gaji, Lembur, Potongan dll sesuai "Cut Off Period" yang dipilih
               </small>
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Save</button>
            </div>
            
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">

           
            
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">SIMPLE DATA</button> --}}
            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            <a  href="{{route('employee.export.simple')}}" class="btn btn-info">SIMPLE DATA</a>
            <a  href="{{route('employee.export')}}" class="btn btn-primary">FULL DATA</a>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-create-transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Transaction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.transaction.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <div class="row">
                  <div class="col">

                  </div>
               </div>
               <div class="form-group form-group-default">
                  <label>Employee</label>
                  <select class="form-control" name="employee" id="employee" required>
                      <option value="">--- Choose Employe ---</option>
                      @foreach ($employees as $employe)
                          <option value="{{$employe->id}}">{{$employe->nik}} {{$employe->biodata->fullName()}} </option>
                          @endforeach
                      
                  </select>
              </div>
              <small>Daftar Karyawan yang belum memiliki transaksi gaji bulan ini</small>
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info ">Create</button>
            </div>
            
         </form>
      </div>
   </div>
</div>
@endsection