@extends('layouts.app')
@section('title')
PERDIN
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         {{-- <li class="breadcrumb-item" aria-current="page">Payroll</li> --}}
         <li class="breadcrumb-item active" aria-current="page">Akomodasi Perjalanan Dinas</li>
      </ol>
   </nav>

   <div class="row">

      <div class="col-md-8">
         <!-- CARD TABLE AKOMODASI -->
         <div class="card shadow-sm border-0 mb-3">
         <div class="card-header bg-white border-0 py-2">

               <div class="d-flex justify-content-between align-items-center">

                  <!-- LEFT: TITLE + INFO -->
                  <div class="d-flex align-items-center">

                     <div class="mr-2 text-success">
                        <i class="fas fa-clipboard-list"></i>
                     </div>

                     <div>
                        <div class="font-weight-bold">Pengajuan Akomodasi Perdin</div>
                        <small class="text-muted">Daftar pengajuan perjalanan dinas karyawan</small>
                     </div>

                  </div>

                  <!-- RIGHT: ACTION -->
                  <div>
                     <a href="#" data-target="#modal-add-perdin" data-toggle="modal"
                        class="btn btn-success btn-sm shadow-sm">
                        <i class="fas fa-plus"></i> Create
                     </a>
                  </div>

               </div>

            </div>

            <div class="card-body p-2">
               <div class="table-responsive">
                  <table id="data" class="display basic-datatables table-sm">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Employee</th>
                           <th>Destination</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     
                     <tbody>
                        @foreach ($perdins as $perdin)
                           <tr>
                              <td><a href="{{ route('perdin.detail', enkripRambo($perdin->id)) }}">{{$perdin->code}}</a></td>
                              <td><a href="{{ route('perdin.detail', enkripRambo($perdin->id)) }}">{{$perdin->employee->nik}} {{$perdin->employee->biodata->fullName()}}</a> </td>
                              <td>{{$perdin->destination}} ({{ $perdin->type_area }})</td>
                           
                              <td>
                                 <x-status.badge.perdin :perdin="$perdin" />
                              </td>

                           </tr>
                        @endforeach
                     </tbody>
                     
                  </table>
               </div>
            </div>
         </div>
      </div>

   <!-- RIGHT SIDE -->
   <div class="col-md-4">

      

      <!-- CARD FORM PERDIN KARYAWAN -->
      <div class="card shadow-sm border-0">
         <div class="card-header bg-dark text-white">
            <i class="fas fa-briefcase"></i>
            <b>Form Perdin yang Dibuat Karyawan</b>
         </div>

         <div class="card-body text-center text-muted">
            <i class="fas fa-folder-open fa-2x mb-2"></i>
            <p class="mb-0">Belum ada data form perdin</p>
            <small>Data akan muncul setelah karyawan membuat pengajuan</small>
         </div>
      </div>

   </div>

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


<div class="modal fade" id="modal-add-perdin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Akomodasi Perdin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('perdin.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
               {{-- <h3>{{$unit->name}}</h3> --}}
               {{-- <input type="number" name="unit" id="unit" value="{{$unit->id}}" hidden> --}}
               <div class="row">
                  
                  
                  <div class="col-12">
                     <div class="form-group form-group-default">
                        <label>Karyawan</label>
                        <select name="employee" id="employee" required class="form-control">
                           @foreach ($employees as $emp)
                              <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Kode Area</label>
                        <select name="type_area" id="type_area" required class="form-control">
                            <option value="A">Dalam Kota (A)</option>
                              <option value="B">Luar Kota (B)</option>
                              <option value="C">Luar Negeri (C)</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Kode Project</label>
                        <select name="type_project" id="type_project" required class="form-control">
                            <option value="SAMA">Sama</option>
                              <option value="BERBEDA">Berbeda</option>
                        </select>
                     </div>
                  </div>

            
                  
               </div>
               <div class="form-group form-group-default">
                  <label>Kegiatan Dinas (*)</label>
                  <input type="text" class="form-control" name="description" id="description" required>
               </div>
               
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Keperluan Project</label>
                        <input type="text" class="form-control" name="description_project" id="description_project">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Tujuan (Kota/Tempat)</label>
                        <input type="text" class="form-control" name="destination" id="destination">
                     </div>
                  </div>
                  <!-- LEFT -->
                  <div class="col-md-6">

                     <div class="form-group form-group-default">
                        <label>Berangkat dari</label>
                        <input type="text" class="form-control" name="departure_from" id="departure_from">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Transportasi Keberangkatan</label>
                        <input type="text" class="form-control" name="departure_transport" id="departure_transport">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Tanggal Keberangkatan</label>
                        <input type="date" class="form-control" name="departure_date" id="departure_date">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="note" id="note">
                     </div>

                  </div>

                  <!-- RIGHT -->
                  <div class="col-md-6">

                     <div class="form-group form-group-default">
                        <label>Pulang dari</label>
                        <input type="text" class="form-control" name="return_from" id="return_from">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Transportasi Kepulangan</label>
                        <input type="text" class="form-control" name="return_transport" id="return_transport">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Tanggal Kepulangan</label>
                        <input type="date" class="form-control" name="return_date" id="return_date">
                     </div>

                     <div class="form-group form-group-default">
                        <label>Durasi (Hari)</label>
                        <input type="number" class="form-control" name="duration" id="duration">
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


@endsection