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
                        <th colspan="3" class="py-1" ><span class="text-uppercase"><a class="text-white" href="{{route('allowance.unit.detail', enkripRambo($allowanceUnit->id))}}">REKAP <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /></a></span> <br> LOKASI {{$location->name}}</th>
                        <th class="text-right">
                           
                           
                        </th>
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
                           <a href="{{route('allowance.unit.loc.pdf',  [enkripRambo($allowanceUnit->id), enkripRambo($location->id)])}}" target="_blank">Export PDF </a>
                           {{-- @if ($allowanceUnit->status == 0)
                           <a href="#" data-target="#modal-delete-allowance-unit" data-toggle="modal">Delete</a> | 
                           @endif --}}
                          
                          {{-- <a href="{{route('allowance.unit.pdf', enkripRambo($allowanceUnit->id))}}" target="_blank">Export PDF </a> --}}
                        </td>
                     </tr>
                     
                  </tbody>
               </table>
            </div>
            <div class="col-md-12">
               <table>
                  <thead>
                     <tr>
                        <th colspan="7" class="text-uppercase">Daftar Karyawan {{$location->name}}</th>
                        @if ($allowanceUnit->status == 0)
                        <th class="text-right">
                           
                               
                           
                           @if ($allowanceUnit->type == 2)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-employee-kompensasi" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a>
                           @elseif($allowanceUnit->type == 3 || $allowanceUnit->type == 4)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-employee-duka" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a>
                           @elseif($allowanceUnit->type == 5)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-employee-lahir" data-toggle="modal"><i class="fas fa-plus"></i> Add Karyawan</a>
                           @elseif($allowanceUnit->type == 6)
                           <a href="#" class="text-light" data-target="#modal-add-allowance-insentif" data-toggle="modal"><i class="fas fa-plus"></i> Add Data</a>
                           @endif
                           

                        </th>
                        @endif
                     </tr>
                  </thead>
               </table>
               <div class="table-responsive">
                  {{-- Kompensasi --}}
                  @if ($allowanceUnit->type == 2)
                  
                  <table>
                     <thead>
                        
                        <tr>
                           <th class="th-sm text-center">NIK</th>
                           <th class="th-sm text-center">Nama</th>
                           <th class="th-sm text-center">Awal Kontrak</th>
                           <th class="th-sm text-center">Akhir Kontrak</th>
                           <th class="th-sm text-center">Bulan <br> Efektif</th>
                           <th class="th-sm text-center">Jabatan</th>
                           {{-- <th class="th-sm text-center">Lokasi</th> --}}

                           <th class="th-sm text-center">Gaji Pokok</th>
                           <th class="th-sm text-center">Tunj <br> Kinerja</th>
                           <th class="th-sm text-center">Tunj <br> Fungsional</th>
                           <th class="th-sm text-center">Tunj <br> OPS</th>
                           <th class="th-sm text-center">Tunj <br> Jabatan</th>

                           <th class="th-sm text-center">Nilai</th>
                           @if ($allowanceUnit->status == 0)
                           <th class="th-sm text-center">Action</th>
                           @endif
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class="td-sm ">{{$allow->employee->nik}}</td>
                              <td class="td-sm ">{{$allow->employee->biodata->fullName()}}</td>
                              <td class="td-sm text-center">{{formatDate($allow->contract_start)}}</td>
                              <td class="td-sm text-center">{{formatDate($allow->contract_end)}}</td>
                              <td class="td-sm text-center">{{$allow->qty_month}}</td>
                              <td class="td-sm">{{$allow->position->name}}</td>
                              {{-- <td class="td-sm text-center">{{$allow->location->code}}</td> --}}
                              
                              <td class="td-sm text-right">{{formatRupiahB($allow->pokok)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->tunj_kinerja)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->tunj_fungsional)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->tunj_ops)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->tunj_jabatan)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->total)}}</td>

                            
                              @if ($allow->allowanceUnit->status == 0)
                              <td class="td-sm text-center">
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
                           <td colspan="6" class="td-sm text-right">Total</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('pokok'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('tunj_kinerja'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('tunj_fungsional'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('tunj_ops'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('tunj_jabatan'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('total'))}}</td>
                        </tr>
                        
                        
                     </tbody>
                  </table>
                  @endif



                  {{-- Uang Duka --}}
                  @if ($allowanceUnit->type == 3 || $allowanceUnit->type == 4)
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
                           <td colspan="4" class=" text-right">Total</td>
                           
                           <td class=" text-right">{{formatRupiahB($allowances->sum('total'))}}</td>
                        </tr>
                        
                        
                     </tbody>
                  </table>
                  @endif

                  @if ($allowanceUnit->type == 5)
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
                           {{-- @if ($allowanceUnit->status == 0) --}}
                           <th class=" text-center">Action</th>
                           {{-- @endif --}}
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

                             
                               <td class=" text-center">
                                 @if ($allow->allowanceUnit->status == 0)
                                 <a href="#" data-target="#modal-delete-allowance-employee-{{$allow->id}}" data-toggle="modal">Delete</a> |
                                 @endif
                                 <a href="#" data-target="#modal-allowance-employee-file-{{$allow->id}}" data-toggle="modal">Attach</a>
                              </td>
                              
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

                        <div class="modal fade" id="modal-allowance-employee-file-{{$allow->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content text-dark">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Attachment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body ">
                                    {{-- {{$allow->doc}} --}}
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

                                       <h4>Empty</h4>
                                       <form action="{{route('allowance.unit.update.employee.kelahiran')}}" method="POST" enctype="multipart/form-data">
                                          
                                             @csrf

                                             <input type="number" name="allow" id="allow" hidden value="{{$allow->id}}">
                                             {{-- <h3>{{$unit->name}}</h3> --}}
                                             <input type="number" name="allowanceUnit" id="allowanceUnit" value="{{$allowanceUnit->id}}" hidden>
                                             
                                             <div class="row">
                                                
                              
                                                <div class="col-12">
                                                   <div class="form-group form-group-default pb-3">
                                                      <label>Attachment</label>
                                                      <input type="file" name="file" id="file" class="form-control">
                                                   </div>
                                                </div>
                                                
                                                
                                             </div>
                                            
                              
                                          
                                            
                                          <button type="submit" class="btn btn-info">Update</button>
                                          
                                       </form>

                                    @endif
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                    
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
                  @endif

                  @if ($allowanceUnit->type == 6)
                  <table>
                     <thead>
                        
                        <tr>
                           <th class=" text-center">Wilayah Kerja</th>
                           <th class=" text-center">Jml Pegawai</th>
                           
                           <th class=" text-center">Jml Jam</th>
                           

                           <th class=" text-center">Total Nilai</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class=" text-center">{{$allowanceUnit->area ?? '-'}}</td>
                           <td class=" text-center">{{$allowanceUnit->qty ?? '-'}}</td>
                           <td class=" text-center">{{$allowanceUnit->qty_hour ?? '-'}}</td>
                           <td class=" text-right">{{formatRupiahB($allowanceUnit->total)}}</td>
                        </tr>



                        <tr>
                           <td colspan="" class=" text-right">Total</td>
                           <td class=" text-center">{{$allowanceUnit->qty ?? '-'}}</td>
                           <td class=" text-center">{{$allowanceUnit->qty_hour ?? '-'}}</td>
                           
                           <td class=" text-right">{{formatRupiahB($allowanceUnit->total)}}</td>
                        </tr>
                        
                        
                     </tbody>
                  </table>
                  @endif


                  @if ($allowanceUnit->type == 7)
                  
                  <table>
                     <thead>
                        
                        <tr>
                           <th class="th-sm text-center">NIK</th>
                           <th class="th-sm text-center">Nama</th>
                           <th class="th-sm text-center">Awal Kontrak</th>
                           <th class="th-sm text-center">Akhir Kontrak</th>
                           <th class="th-sm text-center">Bulan <br> Efektif</th>
                           <th class="th-sm text-center">Jabatan</th>
                           {{-- <th class="th-sm text-center">Lokasi</th> --}}

                           <th class="th-sm text-center">Pokok</th>
                           <th class="th-sm text-center">Tunj <br> Kinerja</th>
                           <th class="th-sm text-center">Tunj <br> Fungsional</th>
                           <th class="th-sm text-center">Tunj <br> OPS</th>
                           <th class="th-sm text-center">Tunj <br> Jabatan</th>
                           <th class="th-sm text-center">Bruto</th>
                           {{-- <th class="th-sm text-center">Jmlh Bulan</th> --}}
                           <th class="th-sm text-center">Nilai</th>
                           @if ($allowanceUnit->status == 0)
                           <th class="th-sm text-center">Action</th>
                           @endif
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class="td-sm ">{{$allow->employee->nik}}</td>
                              <td class="td-sm ">{{$allow->employee->biodata->fullName()}}</td>
                              <td class="td-sm text-center">{{formatDate($allow->contract_start)}}</td>
                              <td class="td-sm text-center">{{formatDate($allow->contract_end)}}</td>
                              <td class="td-sm text-center">
                                 @if ($allow->qty_join < 12)
                                     {{ $allow->qty_join }}
                                     @else
                                     12
                                 @endif
                              </td>
                              <td class="td-sm ">{{$allow->position->name}}</td>
                              {{-- <td class="td-sm text-center">{{$allow->location->code}}</td> --}}
                              
                              <td class="td-sm text-right">{{formatRupiahB($allow->pokok)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->tunj_kinerja)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->tunj_fungsional)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->tunj_ops)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->tunj_jabatan)}}</td>
                              <td class="td-sm text-right">{{formatRupiahB($allow->pokok + $allow->tunj_kinerja + $allow->tunj_fungsional + $allow->tunj_ops + $allow->tunj_jabatan)}}</td>
                              
                              <td class="td-sm text-right">{{formatRupiahB($allow->total)}}</td>

                            
                              @if ($allow->allowanceUnit->status == 0)
                              <td class="td-sm text-center">
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
                           <td colspan="7" class="td-sm text-right">Total</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('pokok'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('tunj_kinerja'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('tunj_fungsional'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('tunj_ops'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('tunj_jabatan'))}}</td>
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('pokok') + $allowances->sum('tunj_kinerja') + $allowances->sum('tunj_fungsional') + $allowances->sum('tunj_ops') + $allowances->sum('tunj_jabatan'))}}</td>
                           
                           <td class="td-sm text-right">{{formatRupiahB($allowances->sum('total'))}}</td>
                        </tr>
                        
                        
                     </tbody>
                  </table>
                  @endif
               </div>

               <hr>
               
            </div>
          </div>

         
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
                                    <td colspan="3">Daftar Kontrak Berakhir Bulan Ini</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>Nama</td>
                                    <td>Berakhir</td>
                                </tr>
                                @foreach ($notifContracts as $con)
                                    <tr>
                                    <td>{{$con->employee->nik}}</td>
                                    <td>{{$con->employee->biodata->fullName()}}</td>
                                    <td>{{formatDate($con->end)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">Daftar Resign Bulan ini</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>Nama</td>
                                    <td>Berakhir</td>
                                </tr>
                                @foreach ($employeeResigns as $empRes)
                                    <tr>
                                    <td>{{$empRes->nik}}</td>
                                    <td>{{$empRes->biodata->fullName()}}</td>
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

                  <div class="col-6">
                     <div class="form-group form-group-default">
                        <label>Jml Jam</label>
                        <input type="number" name="qty_hour" id="qty_hour" class="form-control" value="{{$allowanceUnit->qty_hour}}">
                     </div>
                  </div>
                  
                  <div class="col-12">
                     <div class="form-group form-group-default">
                        <label>Total Nilai</label>
                        <input type="number" name="total" id="total" class="form-control" value="{{$allowanceUnit->total}}">
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
               
              

            Release Pengajuan Tunjangan <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" />
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



@endsection