@extends('layouts.app')
@section('title')
PERDIN
@endsection
@section('content')

<style>
   .label {
   width: 140px;       /* bikin semua label sejajar */
   color: #6c757d;
   flex-shrink: 0;
}

.value {
   flex: 1;
   padding-left: 10px;
}
</style>

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         {{-- <li class="breadcrumb-item" aria-current="page">Payroll</li> --}}
         <li class="breadcrumb-item " aria-current="page">Akomodasi Perjalanan Dinas</li>
         <li class="breadcrumb-item active" aria-current="page">Detail</li>
      </ol>
   </nav>



   <!-- INFORMASI UTAMA -->
         <div class="card shadow-sm border-0 mb-3">

            <!-- HEADER -->
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">

               <div class="d-flex align-items-center">
                  <i class="fas fa-plane text-primary mr-2"></i>
                  <div class="mr-3">
                     <h6 class="mb-0 font-weight-bold">Detail Perjalanan Dinas</h6>
                     <small class="text-muted">Pengajuan Akomodasi</small>
                  </div>

                  <x-status.badge.perdin :perdin="$perdin" class="ml-3" />
                  {{-- <span class="badge badge-warning ml-3 px-3 py-2">
                     <i class="fas fa-clock"></i> Draft
                  </span> --}}
               </div>

               <div class="mt-2 mt-md-0">
                  <button class="btn btn-sm btn-primary" data-target="#modal-submit-perdin" data-toggle="modal">
                     <i class="fas fa-paper-plane"></i> Submit
                  </button>
                  
                  <button  data-target="#modal-edit-perdin" data-toggle="modal" class="btn btn-sm btn-outline-primary mr-1">
                     <i class="fas fa-edit"></i> Edit
                  </button>
                  <button class="btn btn-sm btn-outline-danger mr-1">
                     <i class="fas fa-trash"></i>
                  </button>
                  <button class="btn btn-sm btn-success">
                     <i class="fas fa-file-pdf"></i> Export PDF
                  </button>
               </div>

            </div>

            <!-- BODY -->
            <div class="card-body pt-2 pb-2">

               

               <div class="row small">

                  <!-- LEFT -->
                  <div class="col-md-6">

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Nama</span>
                        <span class="value"><b>{{ $perdin->employee->biodata->fullName() }}</b></span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label">NIK</span>
                        <span class="value">{{ $perdin->employee->nik }}</span>
                     </div>
                     <div class="d-flex border-bottom py-1">
                        <span class="label">Tujuan</span>
                        <span class="value">{{ $perdin->destination }}</span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Berangkat dari</span>
                        <span class="value"><i class="fas fa-map-marker-alt text-primary"></i> {{ $perdin->departure_from }}</span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label text-truncate">Transportasi </span>
                        <span class="value"><i class="fas fa-plane text-info"></i> {{ $perdin->departure_transport }}</span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Tgl Keberangkatan</span>
                        <span class="value"><i class="fas fa-calendar-alt text-success"></i> {{ $perdin->departure_date }}</span>
                     </div>

                     <div class="d-flex py-1">
                        <span class="label">Keterangan</span>
                        <span class="value">{{ $perdin->note }}</span>
                     </div>

                  </div>

                  <!-- RIGHT -->
                  <div class="col-md-6">

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Departemen</span>
                        <span class="value"><b>{{ $perdin->employee->unit->name }}</b></span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Jabatan</span>
                        <span class="value">{{ $perdin->employee->position->name }}</span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Kegiatan Dinas</span>
                        <span class="value">{{ $perdin->desc }}</span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Pulang dari</span>
                        <span class="value"><i class="fas fa-map-marker-alt text-danger"></i> {{ $perdin->return_from }}</span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Transportasi </span>
                        <span class="value"><i class="fas fa-plane-departure text-warning"></i> {{ $perdin->return_transport }}</span>
                     </div>

                     <div class="d-flex border-bottom py-1">
                        <span class="label">Tgl Kepulangan</span>
                        <span class="value"><i class="fas fa-calendar-check text-success"></i> {{ $perdin->return_date }}
                     </div>

                     <div class="d-flex py-1">
                        <span class="label">Durasi</span>
                        <span class="value">
                           <span class="badge badge-primary px-2">{{ $perdin->duration }} Hari</span>
                        </span>
                     </div>

                  </div>

               </div>
               

               <div class="row">

               
                  <div class="col-md-4">
                     <div class="d-flex flex-wrap align-items-center gap-3 my-2">

                        <!-- AREA -->
                        <div class="d-flex align-items-center px-3 py-2 rounded-4"
                           style="
                              background-color: #f8fafc;
                              border: 1px solid #e2e8f0;
                           ">

                           <div class="mr-3 d-flex align-items-center justify-content-center rounded-3"
                              style="
                                 width: 42px;
                                 height: 42px;
                                 background: rgba(59, 130, 246, 0.12);
                                 color: #2563eb;
                                 font-size: 18px;
                              ">
                              <i class="fas fa-map-marker-alt"></i>
                           </div>

                           <div>
                              <div class="text-muted" style="font-size: 11px; line-height: 12px;">
                                 KODE AREA
                              </div>

                              <div class="fw-semibold  gap-2 mt-1">
                                 {{-- Area B --}}

                                 <span class="badge rounded-pill text-bg-primary px-2 py-1">
                                    {{ $perdin->type_area }}
                                 </span>
                              </div>
                           </div>

                        </div>

                        <!-- PROJECT -->
                        <div class="d-flex align-items-center px-3 py-2 rounded-4"
                           style="
                              background-color: #f8fafc;
                              border: 1px solid #e2e8f0;
                           ">

                           <div class="mr-3 d-flex align-items-center justify-content-center rounded-3"
                              style="
                                 width: 42px;
                                 height: 42px;
                                 background: rgba(16, 185, 129, 0.12);
                                 color: #059669;
                                 font-size: 18px;
                              ">
                              <i class="fas fa-project-diagram"></i>
                           </div>

                           <div>
                              <div class="text-muted" style="font-size: 11px; line-height: 12px;">
                                 KODE PROJECT
                              </div>

                              <div class="fw-semibold gap-2 mt-1">
                                 {{-- Project Sama --}}

                                 <span class="badge rounded-pill text-bg-success px-2 py-1">
                                    {{ $perdin->type_project }}
                                 </span>
                              </div>
                           </div>

                        </div>

                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="card border shadow-none my-2 bg-light">

                     <div class="card-body py-2 px-3">

                        <!-- TOP: SUMMARY -->
                        <div class="d-flex align-items-center justify-content-between">

                           <!-- LEFT -->
                           <div class="d-flex align-items-center">
                              <div class="mr-2 text-success">
                                 <i class="fas fa-wallet"></i>
                              </div>
                              <div>
                                 <div class="small text-muted">Total Akomodasi</div>
                                 <div class="font-weight-bold">Perjalanan Dinas</div>
                              </div>
                           </div>

                           <!-- RIGHT -->
                           <div class="text-right">
                              <div class="small text-muted">Jumlah</div>
                              <div class="h6 mb-0 text-success font-weight-bold">
                                 Rp 0
                              </div>
                           </div>

                        </div>

                        <!-- DIVIDER -->
                        <hr class="my-2">

                        <!-- NO REKENING -->
                        <div class="d-flex align-items-center small">

                           <span class="text-muted mr-2" style="min-width: 100px;">
                              <i class="fas fa-university"></i> No Rekening
                           </span>

                           <span class="font-weight-bold">
                              123-456-7890
                           </span>

                        </div>

                     </div>

                  </div>
                  </div>
               </div>
               
               
               <table class="mt-2">
                     <tbody>
                        <tr class="bg-dark text-light">
                           <td>Pemberi Perintah</td>
                           <td colspan="2">Disetujui oleh</td>
                        </tr>
                        <tr>
                           <td style="height: 80px" class="text-center">
                              
                           </td>

                           <td style="" class="text-center">
                              
                              {{-- @if ($absenceemp->status >= 4)
                                    @if ($absenceemp->status == 101 || $absenceemp->status == 202 || $absenceemp->status == 303)
                                          
                                    @else
                                    <small class="text-success"><i>APPROVED</i></small> <br>
                                    <small class="text-muted">{{formatDateTime($absenceemp->app_manager_date)}}</small>
                                    @endif
                                    
                              @endif --}}
                           </td>
                           <td style="" class="text-center">
                              
                              {{-- @if ($absenceemp->status >= 4)
                                    @if ($absenceemp->status == 101 || $absenceemp->status == 202 || $absenceemp->status == 303)
                                          
                                    @else
                                    <small class="text-success"><i>APPROVED</i></small> <br>
                                    <small class="text-muted">{{formatDateTime($absenceemp->app_manager_date)}}</small>
                                    @endif
                                    
                              @endif --}}
                           </td>
                        </tr>
                        <tr>
                           <td>
                                 
                           </td>
                           <td>
                              <b>Saruddin Batubara</b>
                           </td>
                           <td>
                              <b>Andrianto</b>
                           </td>
                        </tr>
                        <tr>
                           <td>
                                 HR Staff
                           </td>
                           <td>
                              Manager HRD
                           </td>
                           <td>
                              Manager Finance
                           </td>
                        </tr>

                     </tbody>
               </table>
               <hr>

            </div>
            

         </div>

   <div class="card shadow-sm border-0 mt-3">
      <form action="{{ route('perdin.acco.update') }}" method="POST">
         @csrf
         @method('PUT')

         <input type="number" name="perdinAccoId" id="perdinAccoId" value="{{ $perdinAcco->id }}" hidden>
      
         <div class="card-header bg-light">
            <i class="fas fa-receipt text-primary"></i>
            <b>Detail Akomodasi Perdin</b>
         </div>

         <div class="card-body p-2">

            <div class="table-responsive">
               <table class=" table-sm table-bordered align-middle">

                  <thead class="bg-light text-center">
                     <tr>
                        <th>Akomodasi</th>
                        <th width="80">Qty</th>
                        <th width="120">Nominal</th>
                        <th width="140">Jumlah</th>
                        <th>Keterangan</th>
                     </tr>
                  </thead>

                  <tbody>

                     <!-- TRANSPORT -->
                     <tr>
                        <td>
                           <i class="fas fa-plane text-info"></i>
                           Transport Depart
                        </td>

                        <td>
                           <input 
                              type="number"
                              id="transport_depart_qty"
                              name="transport_depart_qty"
                              class="form-control form-control-sm" value="{{ $perdinAcco->transport_depart_qty }}"
                           >
                        </td>

                        <td>
                           <input 
                              type="number"
                              id="transport_depart_nominal"
                              name="transport_depart_nominal"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->transport_depart_nominal }}"
                           >
                        </td>

                        <td class="text-right font-weight-bold text-success">
                             {{ formatRupiah($perdinAcco->transport_depart_total) }}
                        </td>

                        <td>
                           <input 
                              type="text"
                              id="transport_depart_note"
                              name="transport_depart_note"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->transport_depart_note }}"
                           >
                        </td>
                     </tr>

                     <tr>
                        <td>
                           <i class="fas fa-home text-secondary"></i>
                           Transport Return
                        </td>

                        <td>
                           <input 
                              type="number"
                              id="transport_return_qty"
                              name="transport_return_qty"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->transport_return_qty }}"
                           >
                        </td>

                        <td>
                           <input 
                              type="number"
                              id="transport_return_nominal"
                              name="transport_return_nominal"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->transport_return_nominal }}"
                           >
                        </td>

                        <td class="text-right font-weight-bold text-success">
                            {{ formatRupiah($perdinAcco->transport_return_total) }}
                        </td>

                        <td>
                           <input 
                              type="text"
                              id="transport_return_note"
                              name="transport_return_note"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->transport_return_note }}"
                           >
                        </td>
                     </tr>

                     <!-- UANG MAKAN -->
                     <tr class="bg-light font-weight-bold">
                        <td colspan="5">
                           <i class="fas fa-utensils text-warning"></i>
                           Uang Makan
                        </td>
                     </tr>

                     <tr>
                        <td class="pl-4">Pagi</td>

                        <td>
                           <input 
                              type="number"
                              id="meal_breakfast_qty"
                              name="meal_breakfast_qty"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_breakfast_qty }}"
                           >
                        </td>

                        <td>
                           <input 
                              type="number"
                              id="meal_breakfast_nominal"
                              name="meal_breakfast_nominal"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_breakfast_nominal }}"
                           >
                        </td>

                        <td class="text-right font-weight-bold text-success">
                            {{ formatRupiah($perdinAcco->meal_breakfast_total) }}
                        </td>

                        <td>
                           <input 
                              type="text"
                              id="meal_breakfast_note"
                              name="meal_breakfast_note"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_breakfast_note }}"
                           >
                        </td>
                     </tr>

                     <tr>
                        <td class="pl-4">Siang</td>

                        <td>
                           <input 
                              type="number"
                              id="meal_lunch_qty"
                              name="meal_lunch_qty"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_lunch_qty }}"
                           >
                        </td>

                        <td>
                           <input 
                              type="number"
                              id="meal_lunch_nominal"
                              name="meal_lunch_nominal"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_lunch_nominal }}"
                           >
                        </td>

                        <td class="text-right font-weight-bold text-success">
                            {{ formatRupiah($perdinAcco->meal_lunch_total) }}
                        </td>

                        <td>
                           <input 
                              type="text"
                              id="meal_lunch_note"
                              name="meal_lunch_note"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_lunch_note }}"
                           >
                        </td>
                     </tr>

                     <tr>
                        <td class="pl-4">Malam</td>

                        <td>
                           <input 
                              type="number"
                              id="meal_dinner_qty"
                              name="meal_dinner_qty"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_dinner_qty }}"
                           >
                        </td>

                        <td>
                           <input 
                              type="number"
                              id="meal_dinner_nominal"
                              name="meal_dinner_nominal"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_dinner_nominal }}"
                           >
                        </td>

                        <td class="text-right font-weight-bold text-success">
                            {{ formatRupiah($perdinAcco->meal_dinner_total) }}
                        </td>

                        <td>
                           <input 
                              type="text"
                              id="meal_dinner_note"
                              name="meal_dinner_note"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->meal_dinner_note }}"
                           >
                        </td>
                     </tr>

                     <!-- AKOMODASI HARIAN -->
                     <tr class="bg-light font-weight-bold">
                        <td colspan="5">
                           <i class="fas fa-bed text-primary"></i>
                           Akomodasi Harian
                        </td>
                     </tr>

                     <tr>
                        <td class="pl-4">Area (A/B)</td>

                        <td>
                           <input 
                              type="number"
                              id="daily_accommodation_qty"
                              name="daily_accommodation_qty"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->daily_accommodation_qty }}"
                           >
                        </td>

                        <td>
                           <input 
                              type="number"
                              id="daily_accommodation_nominal"
                              name="daily_accommodation_nominal"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->daily_accommodation_nominal }}"
                           >
                        </td>

                        <td class="text-right font-weight-bold text-success">
                           {{ formatRupiah($perdinAcco->daily_accommodation_total) }}
                        </td>

                        <td>
                           <input 
                              type="text"
                              id="daily_accommodation_note"
                              name="daily_accommodation_note"
                              class="form-control form-control-sm"
                              value="{{ $perdinAcco->daily_accommodation_note }}"
                           >
                        </td>
                     </tr>

                  </tbody>

                  <!-- TOTAL -->
                  <tfoot>
                     <tr class="font-weight-bold bg-light">
                        <td>TOTAL</td>
                        <td colspan="4" class="text-right text-success">
                           {{ formatRupiah($perdinAcco->grand_total) }}
                        </td>
                     </tr>
                  </tfoot>

               </table>
            </div>

         </div>
         <!-- FOOTER -->
         <div class="card-footer py-2 text-right">
            <button class="btn btn-success btn-sm" type="submit">
               <i class="fas fa-save"></i> Save
            </button>
         </div>
      </form>

   </div>
   
   
   
</div>


{{-- @foreach ($overtimes as $over)
<div class="modal fade" id="modal-overtime-doc-{{$over->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Document SPKL</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <div class="modal-body">

         <iframe src="{{asset('storage/' . $over->doc)}}" frameborder="0" style="width:100%"  height="500px"></iframe>
        </div>
      </div>
   </div>
</div>
@endforeach --}}



<div class="modal fade" id="modal-edit-perdin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Perjalanan Dinas </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('perdin.update')}}" method="POST" >
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="number" name="perdinId" id="perdinId" value="{{ $perdin->id }}" hidden>
               {{-- <h3>{{$unit->name}}</h3> --}}
               {{-- <input type="number" name="unit" id="unit" value="{{$unit->id}}" hidden> --}}
               <div class="row">
                  
                  
                  <div class="col-12">
                     <div class="form-group form-group-default">
                        <label>Karyawan</label>
                        <select name="employee" id="employee" required class="form-control">
                           @foreach ($employees as $emp)
                              <option {{ $perdin->employee_id == $emp->id ? 'selected' : '' }} value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Kode Area</label>
                        <select name="type_area" id="type_area" required class="form-control">
                            <option {{ $perdin->type_area == 'A' ? 'selected' : '' }} value="A">Dalam Kota (A)</option>
                              <option {{ $perdin->type_area == 'B' ? 'selected' : '' }} value="B">Luar Kota (B)</option>
                              <option {{ $perdin->type_area == 'C' ? 'selected' : '' }} value="C">Luar Negeri (C)</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Kode Project</label>
                        <select name="type_project" id="type_project" required class="form-control">
                            <option {{ $perdin->type_project == 'SAMA' ? 'selected' : '' }} value="SAMA">Sama</option>
                              <option {{ $perdin->type_project == 'BERBEDA' ? 'selected' : '' }} value="BERBEDA">Berbeda</option>
                        </select>
                     </div>
                  </div>

            
                  
               </div>
               <div class="form-group form-group-default">
                  <label>Kegiatan Dinas (*)</label>
                  <input type="text" class="form-control" name="description" id="description" value="{{ $perdin->desc }}" required>
               </div>
               
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Keperluan Project</label>
                        <input type="text" class="form-control" name="description_project" id="description_project" value="{{ $perdin->project }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Tujuan (Kota/Tempat)</label>
                        <input type="text" class="form-control" name="destination" id="destination" value="{{ $perdin->destination }}">
                     </div>
                  </div>
                  <!-- LEFT -->
                  <div class="col-md-6">

                     <div class="form-group form-group-default">
                        <label>Berangkat dari</label>
                        <input type="text" class="form-control" name="departure_from" id="departure_from" value="{{ $perdin->departure_from }}">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Transportasi Keberangkatan</label>
                        <input type="text" class="form-control" name="departure_transport" id="departure_transport" value="{{ $perdin->departure_transport }}">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Tanggal Keberangkatan</label>
                        <input type="date" class="form-control" name="departure_date" id="departure_date" value="{{ $perdin->departure_date }}">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="note" id="note" value="{{ $perdin->note }}">
                     </div>

                  </div>

                  <!-- RIGHT -->
                  <div class="col-md-6">

                     <div class="form-group form-group-default">
                        <label>Pulang dari</label>
                        <input type="text" class="form-control" name="return_from" id="return_from" value="{{ $perdin->return_from }}">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Transportasi Kepulangan</label>
                        <input type="text" class="form-control" name="return_transport" id="return_transport" value="{{ $perdin->return_transport }}">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Tanggal Kepulangan</label>
                        <input type="date" class="form-control" name="return_date" id="return_date" value="{{ $perdin->return_date }}">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Durasi (Hari)</label>
                        <input type="number" class="form-control" name="duration" id="duration" value="{{ $perdin->duration }}">
                     </div>

                  </div>

               </div>
               <hr>
               
               
               
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info">Save</button>
            </div>
            
         </form>
      </div>
   </div>
</div>


<div class="modal fade" id="modal-submit-perdin" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

         <!-- HEADER -->
         <div class="modal-header border-0 pb-0 px-4 pt-4">

            <div class="d-flex align-items-center">

               <div class="rounded-4 d-flex align-items-center justify-content-center mr-3"
                  style="
                     width: 60px;
                     height: 60px;
                     background: linear-gradient(135deg,#2563eb,#3b82f6);
                     color: white;
                     font-size: 24px;
                  ">
                  <i class="fas fa-paper-plane"></i>
               </div>

               <div>
                  <h4 class="mb-1 font-weight-bold">
                     Submit Perjalanan Dinas
                  </h4>

                  <div class="text-muted small">
                     Pastikan data perjalanan dinas dan akomodasi sudah sesuai sebelum disubmit.
                  </div>
               </div>

            </div>

            <button type="button" class="close ml-2" data-dismiss="modal">
               <span>&times;</span>
            </button>

         </div>

         <form action="{{route('perdin.update')}}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="perdinId" value="{{ $perdin->id }}">

            <div class="modal-body px-4 pt-3">

               <!-- HIGHLIGHT -->
               <div class="rounded-4 p-3 mb-3"
                  style="
                     background: linear-gradient(135deg, rgba(37,99,235,0.06), rgba(59,130,246,0.02));
                     border: 1px solid rgba(37,99,235,0.12);
                  ">

                  <!-- EMPLOYEE -->
                  <div class="d-flex align-items-start mb-3">

                     <div class="mr-3 text-primary" style="font-size: 18px;">
                        <i class="fas fa-user-circle"></i>
                     </div>

                     <div>
                        <div class="text-muted small">
                           Karyawan
                        </div>

                        <div class="font-weight-bold">
                           {{$perdin->employee->nik ?? '-'}} - {{$perdin->employee->biodata->fullName() ?? '-'}}
                        </div>
                     </div>

                  </div>

                  <!-- KEGIATAN -->
                  <div class="d-flex align-items-start mb-3">

                     <div class="mr-3 text-info" style="font-size: 18px;">
                        <i class="fas fa-clipboard-list"></i>
                     </div>

                     <div>
                        <div class="text-muted small">
                           Kegiatan Dinas
                        </div>

                        <div class="font-weight-semibold">
                           {{$perdin->desc ?? '-'}}
                        </div>
                     </div>

                  </div>

                  <!-- DESTINATION -->
                  <div class="d-flex align-items-start mb-3">

                     <div class="mr-3 text-danger" style="font-size: 18px;">
                        <i class="fas fa-map-marker-alt"></i>
                     </div>

                     <div>
                        <div class="text-muted small">
                           Tujuan
                        </div>

                        <div class="font-weight-semibold">
                           {{$perdin->destination ?? '-'}}
                        </div>
                     </div>

                  </div>

                  <!-- TOTAL -->
                  <div class="d-flex align-items-start">

                     <div class="mr-3 text-success" style="font-size: 18px;">
                        <i class="fas fa-wallet"></i>
                     </div>

                     <div class="w-100">

                        <div class="text-muted small">
                           Total Akomodasi
                        </div>

                        <div class="d-flex align-items-center justify-content-between flex-wrap">

                           <div class="font-weight-bold text-success" style="font-size: 24px;">
                              Rp {{number_format($perdin->total_accommodation ?? 0,0,',','.')}}
                           </div>

                           <span class="badge badge-success badge-pill px-3 py-2">
                              <i class="fas fa-check-circle mr-1"></i>
                              Ready to Submit
                           </span>

                        </div>

                     </div>

                  </div>

               </div>

               <!-- ALERT -->
               <div class="rounded-4 p-3"
                  style="
                     background-color: #fff7ed;
                     border: 1px solid #fed7aa;
                  ">

                  <div class="d-flex align-items-start">

                     <div class="mr-3 text-warning" style="font-size: 18px;">
                        <i class="fas fa-exclamation-circle"></i>
                     </div>

                     <div class="small text-muted">
                        Setelah submit, data perjalanan dinas akan diproses untuk approval dan perubahan data mungkin dibatasi.
                     </div>

                  </div>

               </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 px-4 pb-4 pt-2">

               <button type="button"
                  class="btn btn-light border rounded-pill px-4"
                  data-dismiss="modal">

                  <i class="fas fa-times mr-1"></i>
                  Batal

               </button>

               <button type="submit"
                  class="btn btn-primary rounded-pill px-4 shadow-sm">

                  <i class="fas fa-paper-plane mr-2"></i>
                  Submit Perdin

               </button>

            </div>

         </form>

      </div>
   </div>
</div>


@endsection