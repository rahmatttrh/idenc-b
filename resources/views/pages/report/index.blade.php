@extends('layouts.app')
@section('title')
Report
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Report Management</li>
      </ol>
   </nav>

   {{-- <b>Management Report</b><br>
   Lorem ipsum dolor sit amet. --}}
   <div class="row">
      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/wallet.png')}}" width="35px" alt="">
                  <br/>
                  <b>Report Gaji Bersih</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <a data-target="#modal-report-gaji-bersih" data-toggle="modal" href="#">Get Report</a>
               </div>
            </div>
         
      </div>
      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/security.png')}}" width="35px" alt="">
                  <br/>
                  <b>Report Payslip</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <a data-target="#modal-report-payslip" data-toggle="modal" href="#"> BSU </a> | 
                   <a data-target="#modal-report-payslip-location" data-toggle="modal" href="#"> Lokasi </a>
               </div>
            </div>
        
      </div>
      {{-- <div class="col-md-3">
         <a data-target="#modal-report-payslip-location" data-toggle="modal" href="#">
            <div class="card">
               <div class="card-body text-center">
                  
                  <img src="{{asset('img/flaticon/protection.png')}}" width="50px" alt="">
                  
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <span>Report Payslip Lokasi</span>
               </div>
            </div>
         </a>
      </div> --}}
      {{-- <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  <img src="{{asset('img/flaticon/medical-report.png')}}" width="50px" alt="">
                  <br/>
                  <b>Report BPJS</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <span>Report BPJS KS Bisnis Unit</span>
               </div>
            </div>
      </div> --}}
      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/medical-report.png')}}" width="35px" alt="">
                  <br/>
                  <b>Report BPJS</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  
                  <a data-target="#modal-report-bpjs-ks" data-toggle="modal" href="#"> BPJS KS </a> | 
                   <a data-target="#modal-report-bpjs-tk" data-toggle="modal" href="#"> BPJS TK </a>
               </div>
            </div>
      </div>
      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/absence.png')}}" width="35px" alt="">
                  <br/>
                  <b> Report Absensi</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <a data-target="#modal-report-absensi-karyawan" data-toggle="modal" href="#"> Personal </a> | 
                   <a data-target="#modal-report-absensi-annual" data-toggle="modal" href="#"> Annual </a>
               </div>
            </div>
      </div>
      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/overtime.png')}}" width="35px" alt="">
                  <br/>
                 <b> Report SPKL</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <a data-target="#modal-report-spkl-karyawan" data-toggle="modal" href="#"> Personal </a> | 
                   <a data-target="#modal-report-spkl-annual" data-toggle="modal" href="#"> Annual </a>
               </div>
            </div>
        
      </div>
      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/protection.png')}}" width="35px" alt="">
                  <br/>
                 <b> Report Komponen Gaji</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  {{-- <a data-target="#modal-report-spkl-karyawan" data-toggle="modal" href="#"> Personal </a> |  --}}
                   <a data-target="#modal-report-komponen" data-toggle="modal" href="#"> Get Report </a>
               </div>
            </div>
        
      </div>

      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/assurance.png')}}" width="35px" alt="">
                  <br/>
                 <b> Report Training History</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  {{-- <a data-target="#modal-report-spkl-karyawan" data-toggle="modal" href="#"> Personal </a> |  --}}
                   <a data-target="#modal-report-training" data-toggle="modal" href="#"> Get Report </a>
               </div>
            </div>
        
      </div>


      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/assurance.png')}}" width="35px" alt="">
                  <br/>
                 <b> Report QPE</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  {{-- <a data-target="#modal-report-spkl-karyawan" data-toggle="modal" href="#"> Personal </a> |  --}}
                   <a data-target="#modal-report-qpe" data-toggle="modal" href="#"> Get Report </a>
               </div>
            </div>
        
      </div>


   </div>
</div>




<div class="modal fade" id="modal-report-gaji-bersih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report Gaji Bersih Semua Karyawan<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.gaji.bersih')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf


               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
                        <label>Month</label>
                        <select name="month" id="month" required class="form-control">
                           <option value="" selected disabled>Select</option>
                           <option value="All">All</option>
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
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
                        <label>Year</label>
                        <select name="year" id="year" required class="form-control">
                           
                           @foreach (array_reverse(range(2024, date('Y'))) as $tahunLoop)
                              <option value="{{ $tahunLoop }}">{{ $tahunLoop }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               
               
               
               

               {{-- <div class="form-group form-group-default">
                  <label>Document Lampiran</label>
                  <input type="file" class="form-control" id="doc" name="doc">
               </div> --}}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-payslip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report Payslip Bisnis Unit<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.payslip')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default ">
                  <label>Bisnis Unit</label>
                  <select name="unit" id="unit" required class="form-control">
                     @foreach ($units as $u)
                     <option value="{{$u->id}}">{{$u->name}}</option>
                     @endforeach
                     
                  </select>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
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
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
                        <label>Year</label>
                        <select name="year" id="year" required class="form-control">
                           
                           @foreach (array_reverse(range(2024, date('Y'))) as $tahunLoop)
                              <option value="{{ $tahunLoop }}">{{ $tahunLoop }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               
               

               {{-- <div class="form-group form-group-default">
                  <label>Document Lampiran</label>
                  <input type="file" class="form-control" id="doc" name="doc">
               </div> --}}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-payslip-location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report Payslip Per Lokasi<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.payslip.location')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default ">
                  <label>Lokasi</label>
                  <select name="location" id="location" required class="form-control">
                     @foreach ($locations as $loc)
                     <option value="{{$loc->id}}">{{$loc->name}}</option>
                     @endforeach
                     
                  </select>
               </div>
               <div class="form-group form-group-default ">
                  <label>Bisnis Unit</label>
                  <select name="unit" id="unit" required class="form-control">
                     @foreach ($units as $u)
                     <option value="{{$u->id}}">{{$u->name}}</option>
                     @endforeach
                     
                  </select>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
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
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
                        <label>Year</label>
                        <select name="year" id="year" required class="form-control">
                           
                          @foreach (array_reverse(range(2024, date('Y'))) as $tahunLoop)
                           <option value="{{ $tahunLoop }}">{{ $tahunLoop }}</option>
                        @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               
               

               {{-- <div class="form-group form-group-default">
                  <label>Document Lampiran</label>
                  <input type="file" class="form-control" id="doc" name="doc">
               </div> --}}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-bpjs-ks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report BPJS Kesehatan<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.bpjs.ks')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default ">
                  <label>Bisnis Unit</label>
                  <select name="unit" id="unit" required class="form-control">
                     @foreach ($units as $u)
                     <option value="{{$u->id}}">{{$u->name}}</option>
                     @endforeach
                     
                  </select>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
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
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
                        <label>Year</label>
                        <select name="year" id="year" required class="form-control">
                           @foreach (array_reverse(range(2024, date('Y'))) as $tahunLoop)
                              <option value="{{ $tahunLoop }}">{{ $tahunLoop }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               
               

               {{-- <div class="form-group form-group-default">
                  <label>Document Lampiran</label>
                  <input type="file" class="form-control" id="doc" name="doc">
               </div> --}}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-bpjs-tk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report BPJS Ketenagakerjaan<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.bpjs.tk')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default ">
                  <label>Bisnis Unit</label>
                  <select name="unit" id="unit" required class="form-control">
                     @foreach ($units as $u)
                     <option value="{{$u->id}}">{{$u->name}}</option>
                     @endforeach
                     
                  </select>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
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
                  <div class="col-md-6">
                     <div class="form-group form-group-default ">
                        <label>Year</label>
                        <select name="year" id="year" required class="form-control">
                           
                           @foreach (array_reverse(range(2024, date('Y'))) as $tahunLoop)
                              <option value="{{ $tahunLoop }}">{{ $tahunLoop }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               
               

               {{-- <div class="form-group form-group-default">
                  <label>Document Lampiran</label>
                  <input type="file" class="form-control" id="doc" name="doc">
               </div> --}}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-absensi-karyawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report Absensi Personal<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.absensi.karyawan')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default ">
                  <label>Karyawan</label>
                  <select name="employee_abs" id="employee_abs" required class="form-control ">
                     @foreach ($employees as $emp)
                     <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                     @endforeach
                     
                  </select>
               </div>

               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group form-group-default ">
                        <label>Dari</label>
                        <input type="date" name="from" id="from" required class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group form-group-default ">
                        <label>Sampai</label>
                        <input type="date" name="to" id="to" required class="form-control">
                     </div>
                  </div>
               </div>
               
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-absensi-annual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report Absensi Tahunan<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.absensi.annual')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default ">
                  <label>Bisnis Unit</label>
                  <select name="unit" id="unit" required class="form-control ">
                     @foreach ($units as $u)
                     <option value="{{$u->id}}">{{$u->name}} </option>
                     @endforeach
                     
                  </select>
               </div>

               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group form-group-default ">
                        <label>Dari</label>
                        <input type="date" name="from" id="from" required class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group form-group-default ">
                        <label>Sampai</label>
                        <input type="date" name="to" id="to" required class="form-control">
                     </div>
                  </div>
               </div>
               
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-spkl-karyawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report SPKL Personal<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.spkl.karyawan')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf
               
               <div class="form-group form-group-default ">
                  <label>Karyawan</label>
                  <select name="employee_spkl" id="employee_spkl" required class="form-control">
                     @foreach ($employees as $emp)
                     <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                     @endforeach
                     
                  </select>
               </div>

               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group form-group-default ">
                        <label>Dari</label>
                        <input type="date" name="from" id="from" required class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group form-group-default ">
                        <label>Sampai</label>
                        <input type="date" name="to" id="to" required class="form-control">
                     </div>
                  </div>
               </div>
               <small><i>Report berupa file Excel</i></small>

               
               
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-spkl-annual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report SPKL Annual<br>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.spkl.annual')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default ">
                  <label>Bisnis Unit</label>
                  <select name="unit" id="unit" required class="form-control">
                     @foreach ($units as $u)
                     <option value="{{$u->id}}">{{$u->name}}</option>
                     @endforeach
                  </select>
               </div>
               
               <div class="form-group form-group-default ">
                  <label>Jenis</label>
                  <select name="type" id="type" required class="form-control">
                     <option value="1">Lembur</option>
                     <option value="2">Piket</option>
                     
                  </select>
               </div>

               <div class="form-group form-group-default ">
                  <label>Tahun</label>
                  <select name="year" id="year" required class="form-control">
                     @foreach (array_reverse(range(2024, date('Y'))) as $tahunLoop)
                        <option value="{{ $tahunLoop }}">{{ $tahunLoop }}</option>
                     @endforeach

                    
                     
                  </select>
               </div>
               {{-- <small><i>Report berupa file Excel</i></small> --}}

               
               
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-komponen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report Komponen Gaji Tahunan<br>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.payslip.komponen')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default ">
                  <label>Bisnis Unit</label>
                  <select name="unit" id="unit" required class="form-control ">
                     @foreach ($units as $u)
                     <option value="{{$u->id}}">{{$u->name}} </option>
                     @endforeach
                     
                  </select>
               </div>

               <div class="form-group form-group-default ">
                  <label>Komponen Gaji</label>
                  <select name="komponen" id="komponen" required class="form-control ">
                     <option value="bruto">Gaji Kotor</option>
                     <option value="total">Gaji Bersih</option>
                     <option value="overtime">Nilai Lembur</option>
                     <option value="additional_penambahan">Lain-lain</option>
                     
                  </select>
               </div>

                <div class="form-group form-group-default ">
                  <label>Tahun</label>
                  <select name="year" id="year" required class="form-control">
                     @foreach (array_reverse(range(2024, date('Y'))) as $tahunLoop)
                        <option value="{{ $tahunLoop }}">{{ $tahunLoop }}</option>
                     @endforeach

                    
                     
                  </select>
               </div>
               
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-training" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report Training History<br>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('report.training.history')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf

               <div class="form-group form-group-default">
                  <label>Unit</label>
                  <select name="unit" id="unit" class="form-control">
                     <option value="" selected disabled>Select</option>
                     @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                     @endforeach
                  </select>
               </div>
               
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-report-qpe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Report QPE<br>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('qpe.report.export')}}" method="POST" enctype="multipart/form-data" target="_blank">
            <div class="modal-body">

               @csrf
               <div class="form-group form-group-default ">
                  <label>Bisnis Unit</label>
                  <select name="unit" id="unit" required class="form-control ">
                     @foreach ($units as $u)
                     <option value="{{$u->id}}">{{$u->name}} </option>
                     @endforeach
                     
                  </select>
               </div>
              <div class="row">
               <div class="col-md-12">
                  <div class="form-group form-group-default">
                     <label>Semester</label>
                     <select class="form-control " required name="semester" id="semester">
                        <option value="" disabled selected>Select</option>
                        <option  value="1">I</option>
                        <option  value="2">II</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group form-group-default">
                     <label>Tahun</label>
                     <select class="form-control " required name="year" id="year">
                        <option value="" disabled selected>Select</option>
                        @foreach (array_reverse(range(2024, date('Y'))) as $tahunLoop)
                        <option value="{{ $tahunLoop }}">{{ $tahunLoop }}</option>
                     @endforeach
                     </select>
                  </div>  
               </div>
            </div>
               
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Get Report</button>
            </div>
         </form>
      </div>
   </div>
</div>





@endsection