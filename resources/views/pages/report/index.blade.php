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
         <a data-target="#modal-report-gaji-bersih" data-toggle="modal" href="#">
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/wallet.png')}}" width="50px" alt="">
                  {{-- <br/> --}}
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <span>Report Gaji Bersih</span>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-3">
         <a data-target="#modal-report-payslip" data-toggle="modal" href="#">
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/security.png')}}" width="50px" alt="">
                  {{-- <br/> --}}
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <span>Report Payslip Bisnis Unit</span>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-3">
         <a data-target="#modal-report-payslip-location" data-toggle="modal" href="#">
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/protection.png')}}" width="50px" alt="">
                  {{-- <br/> --}}
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <span>Report Payslip Lokasi</span>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-3">
         <a data-target="#modal-report-bpjs-ks" data-toggle="modal" href="#">
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/medical-report.png')}}" width="50px" alt="">
                  {{-- <br/> --}}
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <span>Report BPJS KS Bisnis Unit</span>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-3">
         <a data-target="#modal-report-bpjs-tk" data-toggle="modal" href="#">
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/assurance.png')}}" width="50px" alt="">
                  {{-- <br/> --}}
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <span>Report BPJS TK Bisnis Unit</span>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-3">
         <a data-target="#modal-report-absensi-karyawan" data-toggle="modal" href="#">
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  <img src="{{asset('img/flaticon/absence.png')}}" width="50px" alt="">
                  {{-- <br/> --}}
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <span>Report Absensi Personal</span>
               </div>
            </div>
         </a>
      </div>
      <div class="col-md-3">
         
            <div class="card">
               <div class="card-body text-center">
                  {{-- <i class="fa fa-star"></i>  --}}
                  {{-- <img src="{{asset('img/flaticon/overtime.png')}}" width="50px" alt=""> --}}
                  {{-- <br/> --}}
                 <b> Report SPKL</b>
                  
               </div>
               <div class="card-footer bg-smoke text-center">
                  <a data-target="#modal-report-spkl-karyawan" data-toggle="modal" href="#"> Personal </a> | 
                   <a data-target="#modal-report-spkl-annual" data-toggle="modal" href="#"> Annual </a>
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
                           
                           <option value="2025">2025</option>
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
                           
                           <option value="2025">2025</option>
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
                           
                           <option value="2025">2025</option>
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
                           
                           <option value="2025">2025</option>
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
                           
                           <option value="2025">2025</option>
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
            <h5 class="modal-title" id="exampleModalLabel">Report Absensi Karyawan<br>
               
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
                     <option value="2024">2024</option>
                           <option value="2025">2025</option>
                           <option value="2026">2026</option>
                     
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





@endsection