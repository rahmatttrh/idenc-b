@extends('layouts.app')
@section('title')
Payroll Absence
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Absence</li>
      </ol>
   </nav>

   <div class="card shadow-none border col-md-12">
      <div class=" card-header">
         <x-absence-tab :activeTab="request()->route()->getName()" />
      </div>

      <div class="card-body px-0">

         <div class="row">
            <!-- Form -->
            <div class="col-md-4">
               <div class="card shadow-none border">
                  <div class="card-header">
                     Form Ketidakhadiran
                  </div>
                  <div class="card-body">
                     <form action="{{route('payroll.absence.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-group-default">
                           <label>Employee</label>
                           <select class="form-control js-example-basic-single" style="width: 100%" required name="employee" id="employee">
                              <option value="" disabled selected>Select</option>
                              @foreach ($employees as $emp)
                              <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Date</label>
                                 <input type="date" required class="form-control" id="date" name="date">
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-group form-group-default">
                                 <label>Type</label>
                                 <select class="form-control" required name="type" id="type">
                                    <option value="" disabled selected>Select</option>
                                    <option value="1">Alpha</option>
                                    <option value="2">Terlambat</option>
                                    <option value="3">ATL</option>
                                 </select>
                              </div>
                           </div>
                        </div>


                        <div class="form-group form-group-default">
                           <label>Desc</label>
                           <input type="text" class="form-control" id="desc" name="desc">
                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group form-group-default">
                                 <label>Menit</label>
                                 <input type="number" class="form-control" id="minute" name="minute">
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-group form-group-default">
                                 <label>Document</label>
                                 <input type="file" class="form-control" id="doc" name="doc">
                              </div>
                           </div>
                        </div>



                        <button class="btn btn-block btn-primary" type="submit">Add</button>
                     </form>
                  </div>
                  <div class="card-footer">
                     <small>
                        Data pada form ini akan <b>Mengurangi</b> nilai Transaksi Gaji Karyawan
                        Input Field Menit wajib diisi untuk tipe 'Terlambat'
                     </small>
                  </div>
               </div>
            </div>
            <!-- End Form -->
            <!-- Filter Table -->
            <div class="col-md-8">
               <form action="{{route('payroll.absence.filter')}}" method="POST">
                  @csrf
                  <div class="row">

                     <div class="col-md-3">
                        <div class="form-group form-group-default">
                           <label>From</label>
                           <input type="date" name="from" id="from" value="{{$from}}" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group form-group-default">
                           <label>To</label>
                           <input type="date" name="to" id="to" value="{{$to}}" class="form-control">
                        </div>
                     </div>
                     <div class="col">
                        <button class="btn btn-primary" type="submit">Show</button>
                     </div>
                  </div>

                  <!--  End Filter Table  -->
               </form>
               <div class="card shadow-none border">
                  <div class="table-responsive">
                     <table id="data" class="display basic-datatables table-sm">
                        <thead>
                           <tr>
                              <th>Type</th>
                              <th>Date</th>
                              <th>Employee</th>
                              <th></th>
                           </tr>
                        </thead>

                        <tbody>
                           @foreach ($absences as $absence)
                           <tr>
                              <td>
                                 @if ($absence->type == 1)
                                 Alpha
                                 @elseif($absence->type == 2)
                                 Terlambat ({{$absence->minute}})
                                 @elseif($absence->type == 3)
                                 Cuti/Izin
                                 @endif
                              </td>
                              <td>{{formatDate($absence->date)}}</td>
                              <td>{{$absence->employee->nik}} {{$absence->employee->biodata->fullName()}}</td>
                              <td>
                                 <a href="#" data-target="#modal-delete-absence-{{$absence->id}}" data-toggle="modal">Delete</a>
                              </td>
                           </tr>

                           <div class="modal fade" id="modal-delete-absence-{{$absence->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm" role="document">
                                 <div class="modal-content text-dark">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body ">
                                       Delete data
                                       @if ($absence->type == 1)
                                       Alpha
                                       @elseif($absence->type == 2)
                                       Terlambat ({{$absence->minute}})
                                       @elseif($absence->type == 3)
                                       Cuti/Izin
                                       @endif
                                       {{$absence->employee->nik}} {{$absence->employee->biodata->fullName()}}
                                       tanggal {{formatDate($absence->date)}}
                                       ?
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                       <button type="button" class="btn btn-danger ">
                                          <a class="text-light" href="{{route('payroll.absence.delete', enkripRambo($absence->id))}}">Delete</a>
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
               <!-- End Table  -->

            </div>
         </div>


      </div>


   </div>
   <!-- End Row -->


</div>




@endsection