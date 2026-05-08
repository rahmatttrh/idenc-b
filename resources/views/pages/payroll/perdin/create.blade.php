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
         <li class="breadcrumb-item " aria-current="page">Akomodasi Perjalanan Dinas</li>
         <li class="breadcrumb-item active" aria-current="page">Detail</li>
      </ol>
   </nav>

   <div class="card shadow-sm border-0">

   <!-- HEADER -->
   <div class="card-header bg-primary text-white">
      <i class="fas fa-plane"></i>
      <b>Form Akomodasi Perjalanan Dinas</b>
   </div>

   <form action="{{route('perdin.store')}}" method="POST">
      @csrf

      <div class="card-body">

         <div class="row">

            <!-- LEFT -->
            <div class="col-md-6">

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Nama</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="nama">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">NIK</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="nik">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Berangkat</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="from">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Transport</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="transport_depart">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Tgl Berangkat</label>
                  <div class="col-md-8">
                     <input type="date" class="form-control" name="date_start">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Kepentingan</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="purpose">
                  </div>
               </div>

            </div>

            <!-- RIGHT -->
            <div class="col-md-6">

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Departemen</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="department">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Jabatan</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="position">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Pulang</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="to">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Transport</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="transport_return">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Tgl Pulang</label>
                  <div class="col-md-8">
                     <input type="date" class="form-control" name="date_end">
                  </div>
               </div>

               <div class="form-group row">
                  <label class="col-md-4 col-form-label">Durasi</label>
                  <div class="col-md-8">
                     <input type="number" class="form-control" name="duration">
                  </div>
               </div>

            </div>

         </div>

         <hr>

         <!-- AKOMODASI -->
         <h6 class="mb-2">
            <i class="fas fa-list"></i> Detail Akomodasi
         </h6>

         <div class="table-responsive">
            <table class="table table-sm table-bordered">
               <thead class="bg-light">
                  <tr>
                     <th>Akomodasi</th>
                     <th style="width:120px">Nominal</th>
                     <th style="width:90px">Qty</th>
                     <th>Keterangan</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><input type="text" class="form-control form-control-sm" name="akomodasi[0][name]" value="Akomodasi Perjalanan Dinas"></td>
                     <td><input type="number" class="form-control form-control-sm" name="akomodasi[0][nominal]"></td>
                     <td><input type="number" class="form-control form-control-sm" name="akomodasi[0][qty]"></td>
                     <td><input type="text" class="form-control form-control-sm" name="akomodasi[0][desc]"></td>
                  </tr>
               </tbody>
            </table>
         </div>

         <!-- REKENING -->
         <div class="form-group row mt-3">
            <label class="col-md-2 col-form-label">No Rek</label>
            <div class="col-md-4">
               <input type="text" class="form-control" name="rekening">
            </div>
         </div>

      </div>

      <!-- FOOTER -->
      <div class="card-footer text-right">
         <button class="btn btn-success">
            <i class="fas fa-save"></i> Simpan
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


@endsection