@extends('layouts.app')
@section('title')
Tunjangan
@endsection
@section('content')


<style>
   .th-sm {
      font-size: 11px !important;
      padding-right: 2px !important;
      padding-left: 2px !important;
   }

   .td-sm {
      font-size: 11px !important;
      padding-right: 5px !important;
      padding-left: 5px !important;
      padding-top: 5px !important;
      padding-bottom: 5px !important;
   }
</style>

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
               <a class="nav-link active" href="#">Detail Tunjangan</a>
            </li>

            @if (auth()->user()->hasRole('HRD|HRD-Spv|HRD-Payroll|HRD-Recruitment'))
               @if (auth()->user()->username != 'EN-2-001')
               <li class="nav-item">
                  <a class="nav-link" href="{{route('allowance.unit.index')}}">Tunjangan BSU</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link " href="#">Progress</a>
               </li>
               @endif
               
            @endif
            
            
            {{-- <li class="nav-item">
               <a class="nav-link " href="{{route('admin.employee.spkl.reject')}}">Rejected</a>
            </li> --}}
            {{-- <li class="nav-item">
               <a class="nav-link " data-target="#modal-add-master-allowance-{{$firstUnit->id}}" data-toggle="modal"><i class="fa fa-plus"></i> Create</a>
            </li> --}}
            
           
          </ul>

          <div class="row mt-2">
            <div class="col-md-12">
               {{-- <a href="" class="btn btn-block btn-primary mb-2">Release</a> --}}
               <table>
                  <thead>
                     <tr>
                        <th colspan="3">REKAP <span class="text-uppercase"><x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></span></th>
                        <td class="text-right">
                           @if (auth()->user()->hasRole('HRD|HRD-Payroll|Administrator'))
                           <a href="" class="btn  btn-info btn-sm " data-target="#modal-update-status-allowance" data-toggle="modal"> Update Status</a>
                           @endif

                           {{-- <a href="" class="btn  btn-light btn-block" data-target="#modal-add-master-allowance-{{$allowanceUnit->id}}" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a> --}}
                           @if ($allowanceUnit->status == 0)
                              <a href="" class="btn  btn-light btn-sm " data-target="#modal-release-allowance-unit" data-toggle="modal"> Release</a>
                              
                           @endif

                           @if ($allowanceUnit->status == 1 && auth()->user()->hasRole('HRD'))
                              <a href="" class="btn  btn-light btn-sm " data-target="#modal-approve-allowance-hrd" data-toggle="modal"> Approve</a>
                              {{-- <a href="" class="btn  btn-danger btn-sm " data-target="#" data-toggle="modal"> Reject</a> --}}
                           @endif

                           @if ($allowanceUnit->status == 2 && auth()->user()->username == '11304')
                              <a href="" class="btn  btn-light btn-sm " data-target="#modal-approve-allowance-finman" data-toggle="modal"> Approve</a>
                              {{-- <a href="" class="btn  btn-danger btn-sm " data-target="#" data-toggle="modal"> Reject</a> --}}
                           @endif

                           @if ($allowanceUnit->status == 3 && auth()->user()->username == 'EN-2-006')
                              <a href="" class="btn  btn-light btn-sm " data-target="#modal-approve-allowance-gm" data-toggle="modal"> Approve</a>
                              {{-- <a href="" class="btn  btn-danger btn-sm " data-target="#" data-toggle="modal"> Reject</a> --}}
                           @endif
                           @if ($allowanceUnit->status == 4 && auth()->user()->hasRole('BOD'))
                              <a href="" class="btn  btn-primary btn-sm " data-target="#modal-approve-allowance-bod" data-toggle="modal"> Approve</a>
                              {{-- <a href="" class="btn  btn-danger btn-sm " data-target="#" data-toggle="modal"> Reject</a> --}}
                           @endif

                           @if ($allowanceUnit->status != 101)
                           <a href="" class="btn  btn-danger btn-sm " data-target="#modal-reject-allowance" data-toggle="modal"> Reject</a>
                           @endif

                           {{-- @if ($allowanceUnit->status != 101)
                           <a href="" class="btn  btn-danger btn-sm " data-target="#modal-reject-allowance" data-toggle="modal"> Reject</a>
                           @endif --}}
                           
                           
                        </td>
                     </tr>
                  </thead>
                  <tbody>
                     
                     <tr>
                        <td>Bisnis Unit</td>
                        <td>{{$allowanceUnit->unit->name}}</td>
                        <td>Bulan</td>
                        <td>{{$allowanceUnit->month}}</td>
                     </tr>
                    
                     <tr>
                        <td>Jenis</td>
                        <td><x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></td>
                        
                        <td>Tahun</td>
                        <td>{{$allowanceUnit->year}}</td>
                     </tr>
                     <tr>
                        <td>Jumlah Karyawan</td>
                        <td>{{$allowanceUnit->qty}}</td>
                        
                        <td>Total <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></td>
                        <td>{{formatRupiahB($allowanceUnit->total)}}</td>
                     </tr>
                     <tr>
                        <td colspan="4"></td>
                     </tr>
                     <tr>
                        <td>Status</td>
                        <td colspan=""><x-status.allowance.status-unit :allowanceunit="$allowanceUnit" /></td>
                        <td colspan="2">

                           @if ($allowanceUnit->status == 0 || $allowanceUnit->status == 101)
                           <a href="#" data-target="#modal-delete-allowance-unit" data-toggle="modal">Delete</a> | 
                           @endif

                            @if ($allowanceUnit->type == 2 || $allowanceUnit->type == 5 || $allowanceUnit->type == 7 || $allowanceUnit->type == 3 || $allowanceUnit->type == 6 || $allowanceUnit->type == 4)
                           <a href="{{route('allowance.unit.rekap.pdf', enkripRambo($allowanceUnit->id))}}" target="_blank">Export Rekap PDF </a> |
                           <a href="{{route('allowance.unit.pdf', enkripRambo($allowanceUnit->id))}}" target="_blank">Export Daftar Karyawan PDF </a>
                           @else
                           <a href="{{route('allowance.unit.pdf', enkripRambo($allowanceUnit->id))}}" target="_blank">Export PDF </a>
                           @endif
                          
                          {{-- <a href="{{route('allowance.unit.pdf', enkripRambo($allowanceUnit->id))}}" target="_blank">Export PDF </a> --}}
                        </td>
                     </tr>

                     @if ($allowanceUnit->status == 101)
                         <tr>
                           <td></td>
                           <td class="text-right">{{$allowanceUnit->rejectBy->biodata->fullName()}} :</td>
                           <td colspan="2">{{$allowanceUnit->reject_desc}}</td>
                         </tr>
                     @endif
                     @if ($allowanceUnit->type == 7)
                     
                         <tr>
                        <td>Tanggal Hari Raya</td>
                        <td colspan="3">
                           @if ($allowanceUnit->status == 0)
                               <form action="{{ route('allowance.unit.refresh') }}" class="d-flex" method="POST">
                              @csrf
                              <input type="number" name="allowanceUnitId" id="allowanceUnitId" value="{{ $allowanceUnit->id }}" hidden>
                              <input type="date" class="form-control" style="width: 150px" name="date_raya" id="date_raya" value="{{$allowanceUnit->date_raya}}">
                              <button type="submit" class="btn btn-primary btn-sm">Update</button>
                              </form>
                              @else
                              {{formatDate($allowanceUnit->date_raya)}}
                           @endif
                           
                        </td>
                     </tr>
                     @endif
                     
                  </tbody>
               </table>
            </div>
            <div class="col-md-12">
               <table>
                  <thead>
                     <tr>
                        <th colspan="8" class="text-uppercase">
                           @if($allowanceUnit->type == 6)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-insentif" data-toggle="modal"> Edit Data</a>
                           @else
                           DAFTAR KARYAWAN
                           @endif
                           
                        </th>
                        @if ($allowanceUnit->status == 0)
                        <th class="text-right">
                           
                               
                           
                           @if ($allowanceUnit->type == 2)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-employee-kompensasi" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a>
                           @elseif($allowanceUnit->type == 3 || $allowanceUnit->type == 4)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-employee-duka" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a>
                           @elseif($allowanceUnit->type == 5)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-employee-lahir" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a>
                           @elseif($allowanceUnit->type == 6)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-insentif-karyawan" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a>
                           @elseif($allowanceUnit->type == 7)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-employee-thr" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a>
                           @endif
                           

                        </th>
                        @endif
                     </tr>
                  </thead>
               </table>
               <div class="table-responsive">
                  {{-- Kompensasi --}}
                  @if ($allowanceUnit->type == 2 )
                  <table>
                     <thead>
                        
                        <tr>
                           <th class="th-sm text-center">Lokasi</th>
                           <th class="th-sm text-center">Jml Peg</th>
                          

                           <th class="th-sm text-center">Gaji Pokok</th>
                           <th class="th-sm text-center">Tunj <br> Jabatan</th>
                           
                           <th class="th-sm text-center">Tunj <br> OPS</th>
                           <th class="th-sm text-center">Tunj <br> Kinerja</th>
                           <th class="th-sm text-center">Tunj <br> Fungsional</th>
                           <th class="th-sm text-center">Gaji Bruto</th>
                           <th class="th-sm text-center">Kompensasi</th>
                          
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class="td-sm text-center"><a href="{{route('allowance.unit.detail.loc', [enkripRambo($allowanceUnit->id), enkripRambo($allow->first()->location_id)])}}">{{ $allow->first()->location->name }}</a></td>
                              <td class="td-sm text-center">{{$allow->count()}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('pokok'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('tunj_jabatan'))}}</td>
                              
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('tunj_ops'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('tunj_kinerja'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('tunj_fungsional'))}}</td>
                              
                              <td class="td-sm text-right">{{formatRupiahB( $allow->sum('pokok')+$allow->sum('tunj_jabatan')+$allow->sum('tunj_ops')+$allow->sum('tunj_kinerja')+$allow->sum('tunj_fungsional') )}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('total'))}}</td>

                            
                             
                              
                           </tr>

                        
                        @endforeach
                        
                        
                        
                     </tbody>
                  </table>
                  @endif

                  @if ($allowanceUnit->type == 5 )
                  <table>
                     <thead>
                        
                        <tr>
                           <th class="th-sm text-center">Lokasi</th>
                           <th class="th-sm text-center">Jml Peg</th>
                           <th class="th-sm text-center">Upah</th>

                           <th class="th-sm text-center">Besar Tunjangan</th>
                           <th class="th-sm text-center">Nilai Tunjangan</th>
                           
                           
                           <th class="th-sm text-center">Total Diterima</th>
                          
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class="td-sm text-center"><a href="{{route('allowance.unit.detail.loc', [enkripRambo($allowanceUnit->id), enkripRambo($allow->first()->location_id)])}}">{{ $allow->first()->location->name }}</a></td>
                              <td class="td-sm text-center">{{$allow->count()}}</td>
                              <td class="td-sm text-right">{{formatRupiahB( $allow->sum('pokok')+$allow->sum('tunj_jabatan')+$allow->sum('tunj_ops')+$allow->sum('tunj_kinerja')+$allow->sum('tunj_fungsional') )}}</td>

                              <td class="td-sm text-right">{{$allow->first()->percent}} %</td>

                              
                              
                              
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('total'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('total'))}}</td>

                            
                             
                              
                           </tr>

                        
                        @endforeach
                        
                        
                        
                     </tbody>
                  </table>
                  @endif



                  {{-- Uang Duka --}}
                  @if ( $allowanceUnit->type == 4)
                  <table>
                     <thead>
                        
                        <tr>
                           <th class=" text-center">NIK</th>
                           <th class=" text-center">Nama</th>
                           
                           <th class=" text-center">Jabatan</th>
                           <th class=" text-center">Lokasi</th>

                           <th class=" text-center">Nilai</th>
                           @if ($allowanceUnit->status == 0)
                           <th class=" text-center">Action</th>
                           @endif
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              {{-- <td>
                                 <a href="{{route('allowance.unit.detail', enkripRambo($allowU->id))}}"><x-status.allowance.type-unit :allowanceunit="$allowU" /></a>
                                 
                              </td> --}}
                              <td class=" text-center">{{$allow->employee->nik}}</td>
                              <td class=" text-center">{{$allow->employee->biodata->fullName()}}</td>
                              
                              <td class=" text-center">{{$allow->position->name}}</td>
                              <td class=" text-center text-uppercase">{{$allow->location->code}}</td>
                              
                              
                              <td class=" text-right">{{formatRupiahB($allow->total)}}</td>

                             
                              @if ($allow->allowanceUnit->status == 0 || $allow->allowanceUnit->status == 101)
                              <td class=" text-center">
                                 <a href="#" data-target="#modal-delete-allowance-employee-{{$allow->id}}" data-toggle="modal">Delete</a>
                              </td>
                              @endif
                              
                           </tr>

                        <div class="modal fade" id="modal-delete-allowance-employee-{{$allow->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content text-dark">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body ">
                                    Delete data Karyawan dari daftar Tunjangan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" />  ?
                                    <hr>
                                    {{$allow->employee->nik}} <br>
                                    {{$allow->employee->biodata->fullName()}}
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger ">
                                       <a class="text-light" href="{{route('allowance.unit.delete.employee', enkripRambo($allow->id))}}">Delete</a>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach


                        <tr>
                           <td colspan="4" class=" text-right">Total</td>
                           
                           <td class=" text-right">{{formatRupiahB($allowances->sum('total'))}}</td>
                        </tr>
                        
                        
                     </tbody>
                  </table>

                  
                  @endif

                  @if ( $allowanceUnit->type == 3)
                  <table>
                     <thead>
                        
                        <tr>
                           <th class="th-sm text-center">Lokasi</th>
                           <th class="th-sm text-center">Jml Peg</th>
                           <th class="th-sm text-center">Upah</th>

                           {{-- <th class="th-sm text-center">Besar Tunjangan</th> --}}
                           <th class="th-sm text-center">Nilai Tunjangan</th>
                           
                           
                           <th class="th-sm text-center">Total Diterima</th>
                          
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class="td-sm text-center"><a href="{{route('allowance.unit.detail.loc', [enkripRambo($allowanceUnit->id), enkripRambo($allow->first()->location_id)])}}">{{ $allow->first()->location->name }}</a></td>
                              <td class="td-sm text-center">{{$allow->count()}}</td>
                              <td class="td-sm text-right">{{formatRupiahB( $allow->first()->employee->payroll->total )}}</td>

                              {{-- <td class="td-sm text-right">{{$allow->first()->percent}} %</td> --}}

                              
                              
                              
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('total'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('total'))}}</td>

                            
                             
                              
                           </tr>

                        
                        @endforeach
                        
                        
                        
                     </tbody>
                  </table>
                  @endif



                  @if ($allowanceUnit->type == 5 )
                  <table>
                     <thead>
                        
                        <tr>
                           <th class="th-sm text-center">Lokasi</th>
                           <th class="th-sm text-center">Jml Peg</th>
                           <th class="th-sm text-center">Upah</th>

                           <th class="th-sm text-center">Besar Tunjangan</th>
                           <th class="th-sm text-center">Nilai Tunjangan</th>
                           
                           
                           <th class="th-sm text-center">Total Diterima</th>
                          
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class="td-sm text-center"><a href="{{route('allowance.unit.detail.loc', [enkripRambo($allowanceUnit->id), enkripRambo($allow->first()->location_id)])}}">{{ $allow->first()->location->name }}</a></td>
                              <td class="td-sm text-center">{{$allow->count()}}</td>
                              <td class="td-sm text-right">{{formatRupiahB( $allow->first()->employee->payroll->total )}}</td>

                              <td class="td-sm text-center">{{$allow->first()->percent}} %</td>

                              
                              
                              
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('total'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('total'))}}</td>

                            
                             
                              
                           </tr>

                        
                        @endforeach
                        
                        
                        
                     </tbody>
                  </table>
                  @endif

                  {{-- @if ($allowanceUnit->type == 5)
                  <table>
                     <thead>
                        
                        <tr>
                           <th class=" text-center">NIK</th>
                           <th class=" text-center">Nama</th>
                           
                           <th class=" text-center">Jabatan</th>
                           <th class=" text-center">Lokasi</th>

                           <th class=" text-center">Jenis <br> Tunjangan</th>
                           <th class=" text-center">Upah</th>
                           <th class=" text-center">Besar <br> Tunjangan</th>

                           <th class=" text-center">Nilai <br> Tunjangan</th>
                           @if ($allowanceUnit->status == 0)
                           <th class=" text-center">Action</th>
                           @endif
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class=" text-center">{{$allow->employee->nik}}</td>
                              <td class=" text-center">{{$allow->employee->biodata->fullName()}}</td>
                              
                              <td class=" text-center">{{$allow->position->name}}</td>
                              <td class=" text-center text-uppercase">{{$allow->location->code}}</td>

                              <td class=" text-center">
                                 @if ($allow->child == 1)
                                     Kelahiran Pertama
                                     @elseif($allow->child == 2)
                                     Kelahiran Kedua
                                 @endif
                              </td>

                              <td class=" text-right">{{formatRupiahB($allow->employee->payroll->total)}}</td>
                              <td class=" text-center">{{$allow->percent}} %</td>
                              
                              
                              <td class=" text-right">{{formatRupiahB($allow->total)}}</td>

                             
                              @if ($allow->allowanceUnit->status == 0)
                              <td class=" text-center">
                                 <a href="#" data-target="#modal-delete-allowance-employee-{{$allow->id}}" data-toggle="modal">Delete</a>
                              </td>
                              @endif
                              
                           </tr>

                           <div class="modal fade" id="modal-delete-allowance-employee-{{$allow->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm" role="document">
                                 <div class="modal-content text-dark">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Delete</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body ">
                                       Delete data Karyawan dari daftar Tunjangan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" />  ?
                                       <hr>
                                       {{$allow->employee->nik}} <br>
                                       {{$allow->employee->biodata->fullName()}}
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                       <button type="button" class="btn btn-danger ">
                                          <a class="text-light" href="{{route('allowance.unit.delete.employee', enkripRambo($allow->id))}}">Delete</a>
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endforeach


                        <tr>
                           <td colspan="7" class=" text-right">Total</td>
                           
                           <td class=" text-right">{{formatRupiahB($allowances->sum('total'))}}</td>
                        </tr>
                        
                        
                     </tbody>
                  </table>
                  @endif --}}

                  @if ($allowanceUnit->type == 6)
                  <table>
                     <thead>
                        
                        <tr>
                           <th class="">Wilayah Kerja</th>
                           <th class=" text-center">Jml Pegawai</th>
                           
                           {{-- <th class=" text-center">Qty</th> --}}
                           
                            {{-- <th class=" text-center"> Nilai</th> --}}
                           <th class=" text-center">Total Nilai</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class=""><a href="{{ route('allowance.unit.detail.insentif', enkriprambo($allowanceUnit->id)) }}">{{$allowanceUnit->area ?? '-'}}</a></td>
                           
                           <td class=" text-center">{{$allowanceUnit->qty ?? '-'}}</td>
                           {{-- <td class=" text-center">{{$allowanceUnit->qty_hour ?? '-'}}</td> --}}
                           
                           {{-- <td class=" text-right">{{formatRupiahB($allowanceUnit->value)}}</td> --}}
                           <td class=" text-right">{{formatRupiahB($allowanceUnit->total)}}</td>
                        </tr>



                        <tr>
                           <td colspan="" class=" text-right">Total</td>
                           <td class=" text-center">{{$allowanceUnit->qty ?? '-'}}</td>
                           {{-- <td class=" text-center">{{$allowanceUnit->qty_hour ?? '-'}}</td> --}}
                           {{-- <td class=" text-right">{{formatRupiahB($allowanceUnit->value)}}</td> --}}
                           <td class=" text-right">{{formatRupiahB($allowanceUnit->total)}}</td>
                        </tr>
                        
                        
                     </tbody>
                  </table>

                  
                  @endif



                  @if ($allowanceUnit->type == 7)
                   <table>
                     <thead>
                        
                        <tr>
                           <th class="th-sm text-center">Lokasi</th>
                           <th class="th-sm text-center">Jml Peg</th>
                          

                           <th class="th-sm text-center">Gaji Pokok</th>
                           <th class="th-sm text-center">Tunj Jabatan</th>
                           
                           <th class="th-sm text-center">Tunj OPS</th>
                           <th class="th-sm text-center">Tunj Kinerja</th>
                           <th class="th-sm text-center">Tunj Fungsional</th>
                           <th class="th-sm text-center">Gaji Bruto</th>
                           <th class="th-sm text-center">THR</th>
                          
                        </tr>
                     </thead>
                     <tbody>
                        @php
                            $totalPeg = 0;
                            $totalPokok = 0;
                            $totalKinerja = 0;
                            $totalFungsi = 0;
                            $totalOps = 0;
                            $totalJabatan = 0;
                            $totalBruto = 0;
                            $grandTotal = 0;
                        @endphp

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class="td-sm text-center"><a href="{{route('allowance.unit.detail.loc', [enkripRambo($allowanceUnit->id), enkripRambo($allow->first()->location_id)])}}">{{ $allow->first()->location->name }}</a></td>
                              <td class="td-sm text-center">{{$allow->count()}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('pokok'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('tunj_jabatan'))}}</td>
                              
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('tunj_ops'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('tunj_kinerja'))}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('tunj_fungsional'))}}</td>
                              
                              <td class="td-sm text-right">{{formatRupiahB( $allow->sum('pokok')+$allow->sum('tunj_jabatan')+$allow->sum('tunj_ops')+$allow->sum('tunj_kinerja')+$allow->sum('tunj_fungsional') )}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->sum('total'))}}</td>

                            
                             
                              
                           </tr>
                           @php
                                $totalPeg = $totalPeg + $allow->count();
                                $totalPokok = $totalPokok + $allow->sum('pokok') ;
                                $totalKinerja = $totalKinerja + $allow->sum('tunj_kinerja');
                                $totalFungsi = $totalFungsi + $allow->sum('tunj_fungsional');
                                $totalOps = $totalOps + $allow->sum('tunj_ops');
                                $totalJabatan = $totalJabatan + $allow->sum('tunj_jabatan');

                                $totalBruto = $totalBruto + $allow->sum('pokok')+$allow->sum('tunj_jabatan')+$allow->sum('tunj_ops')+$allow->sum('tunj_kinerja')+$allow->sum('tunj_fungsional');
                                $grandTotal = $grandTotal + $allow->sum('total');

                            @endphp

                        
                        @endforeach
                        <tr>
                     <td class="td-sm text-center"><b>Grand Total</b>  </td>
                        <td class="td-sm text-center"><b>{{ $totalPeg }}</b></td>
                        <td class="td-sm text-right"><b>{{formatRupiahB($totalPokok)}}</b></td>
                        <td class="td-sm text-right"><b>{{formatRupiahB($totalJabatan)}}</b></td>
                        
                        <td class="td-sm text-right"><b>{{formatRupiahB($totalOps)}}</b></td>
                        <td class="td-sm text-right"><b>{{formatRupiahB($totalKinerja)}}</b></td>
                        <td class="td-sm text-right"><b>{{formatRupiahB($totalFungsi)}}</b></td>
                        
                        <td class="td-sm text-right"><b>{{formatRupiahB($totalBruto)}}</b></td>
                        <td class="td-sm text-right"><b>{{formatRupiahB($grandTotal)}}</b></td>
                     </tr>
                        
                        
                        
                     </tbody>
                  </table>
                  @endif



                  
               </div>

               <hr>
               <div class="table-responsive">

               
                  <table class="mt-2">
                     <tbody>
                        <tr>
                           <td colspan="">Jakarta, 
                              @if ($allowanceUnit->release_date != null)
                                 {{formatDate($allowanceUnit->release_date)}}
                              @endif
                              
                           </td>
                           
                        </tr>
                        <tr>
                           <td colspan="">Dibuat oleh,</td>
                           
                           <td colspan="3" class="text-center">Diperiksa oleh</td>
                          
                           <td colspan="" class="text-center">Disetujui oleh</td>
                        </tr>
                        <tr>
                           <td colspan="" style="height: 80px" class="text-center">
                              @if ($allowanceUnit->release_date)
                              <span class="text-info"><i>RELEASED</i></span> <br>
                              <span class="text-info">{{formatDateTime($allowanceUnit->release_date)}} </span>
                              @endif
                              
                           </td>
                           <td colspan="" style="height: 80px" class="text-center">
                              @if ($allowanceUnit->approve_one_date)
                              <span class="text-info"><i>CHECKED</i></span> <br>
                              <span class="text-info">{{formatDateTime($allowanceUnit->approve_one_date)}} </span>
                                 @else
                                    @if ($allowanceUnit->status > 1)
                                        <span class="text-info"><i>Approval Manual</i></span> <br>
                                    @endif
                              @endif
                           </td>
                           <td colspan="" style="height: 80px" class="text-center">
                              @if ($allowanceUnit->approve_two_date)
                              <span class="text-info"><i>CHECKED</i></span> <br>
                              <span class="text-info">{{formatDateTime($allowanceUnit->approve_two_date)}} </span>
                                 @else
                                    @if ($allowanceUnit->status > 2)
                                        <span class="text-info"><i>Approval Manual</i></span> <br>
                                    @endif
                              @endif
                           </td>
                           <td colspan="" style="height: 80px" class="text-center">
                              @if ($allowanceUnit->approve_three_date)
                              <span class="text-info"><i>APPROVED</i></span> <br>
                              <span class="text-info">{{formatDateTime($allowanceUnit->approve_three_date)}} </span>
                              @else
                                    @if ($allowanceUnit->status > 3)
                                        <span class="text-info"><i>Approval Manual</i></span> <br>
                                    @endif
                              @endif
                           </td>
                           <td colspan="" style="height: 80px" class="text-center">
                              @if ($allowanceUnit->approve_four_date)
                              <span class="text-info"><i>APPROVED</i></span> <br>
                              <span class="text-info">{{formatDateTime($allowanceUnit->approve_four_date)}} </span>
                              @else
                                    @if ($allowanceUnit->status > 4)
                                        <span class="text-info"><i>Approval Manual</i></span> <br>
                                    @endif
                              @endif
                           </td>
                           {{-- <td colspan="" style="height: 80px" class="text-center">
                              @if ($allowanceUnit->approve_five_date)
                              <span class="text-info"><i>APPROVED</i></span> <br>
                              <span class="text-info">{{formatDateTime($allowanceUnit->approve_four_date)}} </span>
                              @endif
                           </td> --}}
                        </tr>
                        <tr>
                           <td>
                              {{-- @if ($allowanceUnit->created_by)
                              {{$allowanceUnit->createdBy->biodata->fullName()}}
                              @endif --}}
                              @if ($allowanceUnit->unit->id == 2 || $allowanceUnit->unit->id == 3 || $allowanceUnit->unit->id == 6 || $allowanceUnit->unit->id == 23 || $allowanceUnit->unit->id == 24 || $allowanceUnit->unit->id == 5 || $allowanceUnit->unit->id == 22 || $allowanceUnit->unit->id == 11 || $allowanceUnit->unit->id == 12 || $allowanceUnit->unit->id == 15 || $allowanceUnit->unit->id == 19 || $allowanceUnit->unit->id == 25 || $allowanceUnit->unit->id == 26 || $allowanceUnit->unit->id == 27)
                                Tri Buanawati Asri
                                @else
                                Cheppy Anugrah
                                @endif
                              
                           </td>
                           <td>
                              
                              Saruddin Batubara
                           </td>
                           <td>
                              
                              Andrianto
                           </td>
                           
                           <td>
                              Andi Kurniawan Nasution
                             
                              
                           </td>
                           <td>

                            
                              
                              @if ($allowanceUnit->unit->id == 2 || $allowanceUnit->unit->id == 3 || $allowanceUnit->unit->id == 6 || $allowanceUnit->unit->id == 23 || $allowanceUnit->unit->id == 24 || $allowanceUnit->unit->id == 5 || $allowanceUnit->unit->id == 22 || $allowanceUnit->unit->id == 11 || $allowanceUnit->unit->id == 12 || $allowanceUnit->unit->id == 15 || $allowanceUnit->unit->id == 19  || $allowanceUnit->unit->id == 25 || $allowanceUnit->unit->id == 26 || $allowanceUnit->unit->id == 27)
                                Indra Muhammad Anwar
                                @else
                                Wildan Muhammad Anwar
                                @endif
                           </td>
                           {{-- <td>
                              M. Isya Anwar
                           </td> --}}
                        </tr>
                        <tr>
                           <td>Payroll</td>
                           <td>HRD Manager</td>
                           <td>Finance Manager</td>
                           <td>GM Finance & Acc</td>
                           <td>Director</td>
                           {{-- <td>President Director</td> --}}
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
          </div>

         
      </div>
   </div>



   <div class="card">
      <div class="card-header">
         Attachment
         {{-- {{$allowanceUnit->doc}} --}}
      </div>
      <div class="card-body">
         @if ($allowanceUnit->doc != null)
            @php
            $ekstensi = strtolower(pathinfo($allowanceUnit->doc, PATHINFO_EXTENSION));
            @endphp 
            @if ($ekstensi == 'pdf')
            <iframe  src="/storage/{{$allowanceUnit->doc}}" style="width:100%; height:570px;" frameborder="0"></iframe>
            @else
            <img width="100%" src="/storage/{{$allowanceUnit->doc}}" alt="">
            @endif

         @endif
         
         @if ($allowanceUnit->type == 2 || $allowanceUnit->type == 5 || $allowanceUnit->type == 7 )
            @else 
         
         @foreach ($allowanceUnit->allowances as $allow)
            @if ($allow->doc != null)

            @php

            $ekstensi = strtolower(pathinfo($allow->doc, PATHINFO_EXTENSION));


            @endphp  

                     
                  
               @if ($ekstensi == 'pdf')
               <iframe  src="/storage/{{$allow->doc}}" style="width:100%; height:570px;" frameborder="0"></iframe>
               @else
               <img width="100%" src="/storage/{{$allow->doc}}" alt="">
               @endif
            
               
               @else
               
            @endif
         @endforeach
         @endif
         
      </div>
   </div>

   <div class="card">
      <div class="card-header">
         Attachment Approval
      </div>
      <div class="card-body">
         @php
            $ekstensi = strtolower(pathinfo($allowanceUnit->file, PATHINFO_EXTENSION));
            @endphp 
            @if ($ekstensi == 'pdf')
            <iframe  src="/storage/{{$allowanceUnit->file}}" style="width:100%; height:570px;" frameborder="0"></iframe>
            @else
            <img width="100%" src="/storage/{{$allowanceUnit->file}}" alt="">
            @endif


      </div>
   </div>
   
   
   
</div>

<div class="modal fade" id="modal-add-allowance-employee-kompensasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Karyawan Kompensasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.add.employee.kompensasi')}}" method="POST" >
            <div class="modal-body">
               @csrf
               {{-- <h3>{{$unit->name}}</h3> --}}
               <input type="number" name="allowanceUnit" id="allowanceUnit" value="{{$allowanceUnit->id}}" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="4">Daftar Kontrak Berakhir Bulan Ini</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>Nama</td>
                                    <td>Awal</td>
                                    <td>Berakhir</td>
                                </tr>
                                @foreach ($notifContracts as $con)
                                    <tr>
                                    <td>{{$con->employee->nik}}</td>
                                    <td>{{$con->employee->biodata->fullName()}}</td>
                                    <td>{{formatDate($con->start)}}</td>
                                    <td>{{formatDate($con->end)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">Daftar Resign Bulan ini</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>Nama</td>
                                    <td></td>
                                    <td>Berakhir</td>
                                </tr>
                                @foreach ($employeeResigns as $empRes)
                                    <tr>
                                    <td>{{$empRes->nik}}</td>
                                    <td>{{$empRes->biodata->fullName()}}</td>
                                    <td></td>
                                    <td>{{formatDate($empRes->off)}}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>
               
               <hr>
               <div class="row">
                  {{-- <div class="col-md-12">
                     <div class="form-group form-group-default">
                        <label>Bisnis Unit</label>
                        <div class="mt-2">{{$firstUnit->name}}</div>
                     </div>
                  </div> --}}
                  
                  <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Karyawan</label>
                        <select name="employee_allowance" id="employee_allowance" required class="form-control ">
                           <option value="" disabled selected>Select</option>
                           @foreach ($compensationEmployees as $emp)
                               <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                           @endforeach
                           
                        </select>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group form-group-default">
                        <label>Bulan Efektif</label>
                        <input type="number" name="qty_month" id="qty_month" required class="form-control">
                        {{-- <select name="year" id="year" required class="form-control">
                           
                           <option value="2025">2025</option>
                        </select> --}}
                     </div>
                  </div>
                  
               </div>
              

            
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Add</button>
            </div>
            
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-add-allowance-employee-thr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Karyawan THR</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.add.employee.thr')}}" method="POST" >
            <div class="modal-body">
               @csrf
               {{-- <h3>{{$unit->name}}</h3> --}}
               <input type="number" name="allowanceUnit" id="allowanceUnit" value="{{$allowanceUnit->id}}" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="4">Daftar Non Active</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>Nama</td>
                                    <td>Awal</td>
                                    <td>Berakhir</td>
                                </tr>
                                
                                @foreach ($employeeResigns as $empRes)
                                    <tr>
                                    <td>{{$empRes->nik}}</td>
                                    <td>{{$empRes->biodata->fullName()}}</td>
                                    <td></td>
                                    <td>{{formatDate($empRes->off)}}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>
               
               <hr>
               <div class="row">
                  {{-- <div class="col-md-12">
                     <div class="form-group form-group-default">
                        <label>Bisnis Unit</label>
                        <div class="mt-2">{{$firstUnit->name}}</div>
                     </div>
                  </div> --}}
                  
                  <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Karyawan</label>
                        <select name="employee_allowance" id="employee_allowance" required class="form-control ">
                           <option value="" disabled selected>Select</option>
                           @foreach ($employeeResigns as $emp)
                               <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                           @endforeach
                           
                        </select>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group form-group-default">
                        <label>Bulan Efektif</label>
                        <input type="number" name="qty_month" id="qty_month" required class="form-control">
                        {{-- <select name="year" id="year" required class="form-control">
                           
                           <option value="2025">2025</option>
                        </select> --}}
                     </div>
                  </div>
                  
               </div>
              

            
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Add</button>
            </div>
            
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-add-allowance-employee-duka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.add.employee')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               @csrf
               {{-- <h3>{{$unit->name}}</h3> --}}
               <input type="number" name="allowanceUnit" id="allowanceUnit" value="{{$allowanceUnit->id}}" hidden>
               
               <div class="row">
                  {{-- <div class="col-md-12">
                     <div class="form-group form-group-default">
                        <label>Bisnis Unit</label>
                        <div class="mt-2">{{$firstUnit->name}}</div>
                     </div>
                  </div> --}}
                  
                  <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Karyawan</label>
                        <select name="employee_allowance_b" id="employee_allowance_b" required class="form-control ">
                           <option value="" disabled selected>Select</option>
                           @foreach ($employees as $emp)
                               <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                           @endforeach
                           
                        </select>
                     </div>
                  </div>

                  <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Attachment</label>
                        <input type="file" name="file" id="file" class="form-control">
                     </div>
                  </div>
                  
                  
               </div>
              

            
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Add</button>
            </div>
            
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-add-allowance-employee-lahir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.add.employee.kelahiran')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               @csrf
               {{-- <h3>{{$unit->name}}</h3> --}}
               <input type="number" name="allowanceUnit" id="allowanceUnit" value="{{$allowanceUnit->id}}" hidden>
               
               <div class="row">
                  {{-- <div class="col-md-12">
                     <div class="form-group form-group-default">
                        <label>Bisnis Unit</label>
                        <div class="mt-2">{{$firstUnit->name}}</div>
                     </div>
                  </div> --}}
                  
                  <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Karyawan</label>
                        <select name="employee_allowance_c" id="employee_allowance_c" required class="form-control ">
                           <option value="" disabled selected>Select</option>
                           @foreach ($employees as $emp)
                               <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                           @endforeach
                           
                        </select>
                     </div>
                  </div>

                  <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Urutan Kelahiran</label>
                        <select name="child" id="child" required class="form-control ">
                           <option value="" disabled selected>Select</option>
                           <option value="1">Kelahiran Pertama</option>
                           <option value="2">Kelahiran Kedua</option>
                           
                        </select>
                     </div>
                  </div>

                  <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Attachment</label>
                        <input type="file" name="file" id="file" class="form-control">
                     </div>
                  </div>
                  
                  
               </div>
              

            
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Add</button>
            </div>
            
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-add-allowance-insentif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.add.insentif')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               @csrf
               {{-- <h3>{{$unit->name}}</h3> --}}
               <input type="number" name="allowanceUnit" id="allowanceUnit" value="{{$allowanceUnit->id}}" hidden>
               
               <div class="row">
                 
                  
                  <div class="col-12">
                     <div class="form-group form-group-default">
                        <label>Wilayah Kerja</label>
                        <input type="text" name="area" id="area" class="form-control" value="{{$allowanceUnit->area}}">
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Jml Pegawai</label>
                        <input type="number" name="qty" id="qty" class="form-control" value="{{$allowanceUnit->qty}}">
                     </div>
                  </div>

                  {{-- <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Qty</label>
                        <input type="number" name="qty_hour" id="qty_hour" class="form-control" value="{{$allowanceUnit->qty_hour}}">
                     </div>
                  </div> --}}
                  
                  {{-- <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Nilai</label>
                        <input type="number" name="value" id="value" class="form-control" value="{{$allowanceUnit->value}}">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Total Nilai</label>
                        <input type="number" name="total" id="total" class="form-control" value="{{$allowanceUnit->total}}">
                     </div>
                  </div> --}}


                  <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Attachment</label>
                        <input type="file" name="file" id="file" class="form-control">
                     </div>
                  </div>
                  
                  
               </div>
              

            
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Add</button>
            </div>
            
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-add-allowance-insentif-karyawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Karyawan Insentif</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.add.insentif.employee')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               @csrf
               {{-- <h3>{{$unit->name}}</h3> --}}
               <input type="number" name="allowanceUnit" id="allowanceUnit" value="{{$allowanceUnit->id}}" hidden>
               
               <div class="row">
                 
                  
                  <div class="col-12">
                     <div class="form-group form-group-default">
                        <label>NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" >
                     </div>
                  </div>

                  <div class="col-12">
                     <div class="form-group form-group-default">
                        <label>Nama</label>
                        <input type="text" name="name" id="name" class="form-control" value="">
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Qty</label>
                        <input type="number" name="qty" id="qty" class="form-control" value="">
                     </div>
                  </div>
                  
                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Nilai</label>
                        <input type="number" name="value" id="value" class="form-control" value="">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Total</label>
                        <input type="number" name="total" id="total" class="form-control" value="">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Pajak</label>
                        <select name="tax" id="tax" class="form-control">
                           <option value="0">Non Pajak</option>
                           <option value="1">Pajak</option>
                        </select>
                        {{-- <input type="number" name="total" id="total" class="form-control" value=""> --}}
                     </div>
                  </div>


                  {{-- <div class="col-12">
                     <div class="form-group form-group-default pb-3">
                        <label>Attachment</label>
                        <input type="file" name="file" id="file" class="form-control">
                     </div>
                  </div> --}}
                  
                  
               </div>
              

            
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Add</button>
            </div>
            
         </form>
      </div>
   </div>
</div>





<div class="modal fade" id="modal-release-allowance-unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Release</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            <div class="modal-body">
               
              

            Release Pengajuan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" />
            <hr>

            <table>
               <tbody>
                     
                  <tr>
                     <td>Bisnis Unit</td>
                     <td>{{$allowanceUnit->unit->name}}</td>
                     
                  </tr>
                  <tr>
                     <td>Bulan</td>
                     <td>{{$allowanceUnit->month}}</td>
                  </tr>
                 
                  <tr>
                     
                     
                     <td>Tahun</td>
                     <td>{{$allowanceUnit->year}}</td>
                  </tr>
                  <tr>
                     <td>Jumlah Karyawan</td>
                     <td>{{$allowanceUnit->qty}}</td>
                     
                     
                  </tr>
                  <tr>
                     <td>Total <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></td>
                     <td>{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>
                  
                  
                  
               </tbody>
            </table>
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               {{-- <button type="submit" class="btn btn-info">Add</button> --}}
               <a href="{{route('allowance.unit.release', enkripRambo($allowanceUnit->id))}}" class="btn btn-primary">Release</a>
            </div>
          
      </div>
   </div>
</div>

<div class="modal fade" id="modal-delete-allowance-unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            <div class="modal-body">
               
              

            Delete Pengajuan Tunjangan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" />
            <hr>

            <table>
               <tbody>
                     
                  <tr>
                     <td>Bisnis Unit</td>
                     <td>{{$allowanceUnit->unit->name}}</td>
                     
                  </tr>
                  <tr>
                     <td>Bulan</td>
                     <td>{{$allowanceUnit->month}}</td>
                  </tr>
                 
                  <tr>
                     
                     
                     <td>Tahun</td>
                     <td>{{$allowanceUnit->year}}</td>
                  </tr>
                  <tr>
                     <td>Jumlah Karyawan</td>
                     <td>{{$allowanceUnit->qty}}</td>
                     
                     
                  </tr>
                  <tr>
                     <td>Total <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></td>
                     <td>{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>
                  
                  
                  
               </tbody>
            </table>
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               {{-- <button type="submit" class="btn btn-info">Add</button> --}}
               <a href="{{route('allowance.unit.delete', enkripRambo($allowanceUnit->id))}}" class="btn btn-danger">Delete</a>
            </div>
          
      </div>
   </div>
</div>



<div class="modal fade" id="modal-approve-allowance-hrd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve as HRD Manager</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            <div class="modal-body">
               
              

            Setujui Pengajuan Tunjangan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /> :
            <hr>

            <table>
               <tbody>
                     
                  <tr>
                     <td>Bisnis Unit</td>
                     <td>{{$allowanceUnit->unit->name}}</td>
                     
                  </tr>
                  <tr>
                     <td>Bulan</td>
                     <td>{{$allowanceUnit->month}}</td>
                  </tr>
                 
                  <tr>
                     
                     
                     <td>Tahun</td>
                     <td>{{$allowanceUnit->year}}</td>
                  </tr>
                  <tr>
                     <td>Jumlah Karyawan</td>
                     <td>{{$allowanceUnit->qty}}</td>
                     
                     
                  </tr>
                  <tr>
                     <td>Total <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></td>
                     <td>{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>
                  
                  
                  
               </tbody>
            </table>
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               {{-- <button type="submit" class="btn btn-info">Add</button> --}}
               <a href="{{route('allowance.unit.approve', [enkripRambo($allowanceUnit->id), enkripRambo(2)])}}" class="btn btn-primary">Approve</a>
            </div>
          
      </div>
   </div>
</div>

<div class="modal fade" id="modal-approve-allowance-finman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve as Finance Manager</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            <div class="modal-body">
               
              

            Setujui Pengajuan Tunjangan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /> :
            <hr>

            <table>
               <tbody>
                     
                  <tr>
                     <td>Bisnis Unit</td>
                     <td>{{$allowanceUnit->unit->name}}</td>
                     
                  </tr>
                  <tr>
                     <td>Bulan</td>
                     <td>{{$allowanceUnit->month}}</td>
                  </tr>
                 
                  <tr>
                     
                     
                     <td>Tahun</td>
                     <td>{{$allowanceUnit->year}}</td>
                  </tr>
                  <tr>
                     <td>Jumlah Karyawan</td>
                     <td>{{$allowanceUnit->qty}}</td>
                     
                     
                  </tr>
                  <tr>
                     <td>Total <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></td>
                     <td>{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>
                  
                  
                  
               </tbody>
            </table>
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               {{-- <button type="submit" class="btn btn-info">Add</button> --}}
               <a href="{{route('allowance.unit.approve', [enkripRambo($allowanceUnit->id), enkripRambo(3)])}}" class="btn btn-primary">Approve</a>
            </div>
          
      </div>
   </div>
</div>

<div class="modal fade" id="modal-approve-allowance-gm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve as General Manager</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            <div class="modal-body">
               
              

            Setujui Pengajuan Tunjangan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /> :
            <hr>

            <table>
               <tbody>
                     
                  <tr>
                     <td>Bisnis Unit</td>
                     <td>{{$allowanceUnit->unit->name}}</td>
                     
                  </tr>
                  <tr>
                     <td>Bulan</td>
                     <td>{{$allowanceUnit->month}}</td>
                  </tr>
                 
                  <tr>
                     
                     
                     <td>Tahun</td>
                     <td>{{$allowanceUnit->year}}</td>
                  </tr>
                  <tr>
                     <td>Jumlah Karyawan</td>
                     <td>{{$allowanceUnit->qty}}</td>
                     
                     
                  </tr>
                  <tr>
                     <td>Total <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></td>
                     <td>{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>
                  
                  
                  
               </tbody>
            </table>
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               {{-- <button type="submit" class="btn btn-info">Add</button> --}}
               <a href="{{route('allowance.unit.approve', [enkripRambo($allowanceUnit->id), enkripRambo(4)])}}" class="btn btn-primary">Approve</a>
            </div>
          
      </div>
   </div>
</div>

<div class="modal fade" id="modal-approve-allowance-bod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve as Board of Directors</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            <div class="modal-body">
               
              

            Setujui Pengajuan Tunjangan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /> :
            <hr>

            <table>
               <tbody>
                     
                  <tr>
                     <td>Bisnis Unit</td>
                     <td>{{$allowanceUnit->unit->name}}</td>
                     
                  </tr>
                  <tr>
                     <td>Bulan</td>
                     <td>{{$allowanceUnit->month}}</td>
                  </tr>
                 
                  <tr>
                     
                     
                     <td>Tahun</td>
                     <td>{{$allowanceUnit->year}}</td>
                  </tr>
                  <tr>
                     <td>Jumlah Karyawan</td>
                     <td>{{$allowanceUnit->qty}}</td>
                     
                     
                  </tr>
                  <tr>
                     <td>Total <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></td>
                     <td>{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>
                  
                  
                  
               </tbody>
            </table>
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               {{-- <button type="submit" class="btn btn-info">Add</button> --}}
               <a href="{{route('allowance.unit.approve', [enkripRambo($allowanceUnit->id), enkripRambo(5)])}}" class="btn btn-primary">Approve</a>
            </div>
          
      </div>
   </div>
</div>


<div class="modal fade" id="modal-reject-allowance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Reject<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.reject')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$allowanceUnit->id}}" name="allowanceUnit" id="allowanceUnit" hidden>
               <span>Reject pengajuan Tunjangan?</span>
               <hr>
               <div class="form-group form-group-default">
                  <label>Remark</label>
                  <input type="text" class="form-control"  name="remark" id="remark"  >
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger ">Reject</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-update-status-allowance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Perubahan Status Approval<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('allowance.unit.update.status')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$allowanceUnit->id}}" name="allowanceUnitId" id="allowanceUnitId" hidden>
               
               <div class="form-group form-group-default">
                  <label>Status Approval</label>
                  <select name="status" id="status" required class="form-control">
                     <option value="" disabled selected>Select</option>
                     {{-- @if ($unitTransaction->status > 3)
                     <option value="5">Complete</option>
                     @endif --}}
                     {{-- <option value="1">Approval Manager HR</option> --}}
                     <option value="2">Menunggu Approval Manager Finance</option>
                     <option value="3">Menunggu Approval General Manager</option>
                     <option value="4">Menunggu Approval Direksi</option>
                     <option value="5">Complete</option>
                  </select>
               </div>
               <input type="file" class="form-control" required name="file" id="file">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info ">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>


@endsection