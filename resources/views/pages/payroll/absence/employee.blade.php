@extends('layouts.app')
@section('title')
Summary Absence
@endsection
@section('content')
<style>
   .btn-rm {
    background: none;
    color: inherit;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;
}
</style>

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Summary Absence</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-3">
         <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active text-left pl-3" id="v-pills-basic-tab" href="{{route('payroll.absence')}}" aria-controls="v-pills-basic" aria-selected="true">
               <i class="fas fa-address-book mr-1"></i>
               Summary Absence
            </a>
            <a class="nav-link   text-left pl-3" id="v-pills-contract-tab" href="{{route('payroll.absence.create')}}" aria-controls="v-pills-contract" aria-selected="false">
               <i class="fas fa-file-contract mr-1"></i>
               {{-- {{$panel == 'contract' ? 'active' : ''}} --}}
               Form Absence
            </a>
            
            <a class="nav-link  text-left pl-3" id="v-pills-personal-tab" href="{{route('payroll.absence.import')}}" aria-controls="v-pills-personal" aria-selected="true">
               <i class="fas fa-user mr-1"></i>
               Import by Excel
            </a>
           

            
            
         </div>
         {{-- <hr> --}}
         {{-- <a class="btn btn-light border btn-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Show Form Filter
          </a> --}}
          <hr>
          <table>
            <thead>
               <tr><th colspan="2">Absence</th></tr>
            </thead>
            <tbody>
               <tr>
                  <td colspan="2">
                     <a  data-toggle="collapse" href="#collapseExample">Show Form Filter</a>
                  </td>
               </tr>
               <tr>
                  <td colspan="2">Periode</td>
                  
               </tr>
               <tr>
                  <td></td>
                  <td>
                     @if ($from != 0)
                     {{formatDate($from)}} - {{formatDate($to)}}
                     @else
                     All
                     @endif
                  </td>
               </tr>
               {{-- <tr>
                  <td colspan="2">Unit</td>
               </tr>
               <tr>
                  <td></td>
                  <td>
                     @if ($unitAll == 1)
                         All
                         @else
                         @foreach ($units as $u)
                           {{$u->name}}, 
                        @endforeach
                     @endif
                     
                  </td>
               </tr>

               <tr>
                  <td colspan="2">Location</td>
               </tr>
               <tr>
                  <td></td>
                  <td>
                     @if ($locAll == 1)
                         All
                         @else
                         @foreach ($locations as $l)
                           {{$l->name}}, 
                        @endforeach
                     @endif
                     
                  </td>
               </tr> --}}
               
            </tbody>
          </table>
         {{-- <span class="badge badge-info mb-1 badge-block">Filter</span>
         <form action="{{route('payroll.absence.filter.employee')}}" method="POST">
            @csrf
            <div class="row">
               
               <div class="col-md-12">
                  <div class="form-group form-group-default">
                     <label>From</label>
                     <input type="date" name="from" id="from" value="{{$from}}" class="form-control">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group form-group-default">
                     <label>To</label>
                     <input type="date" name="to" id="to" value="{{$to}}" class="form-control">
                  </div>
               </div>
              
               
            </div>
            <div class="form-group form-group-default">
               <label>Unit</label>
               <select name="unit" id="unit" class="form-control">
                  <option value="all" selected>All</option>
                  @foreach ($units as $unit)
                      <option value="{{$unit->id}}">{{$unit->name}}</option>
                  @endforeach
               </select>
            </div>
            <div class="form-group form-group-default">
               <label>Location</label>
               <select name="unit" id="unit" class="form-control">
                  <option value="all" selected>All</option>
                  @foreach ($locations as $loc)
                      <option value="{{$loc->id}}">{{$loc->code}}</option>
                  @endforeach
               </select>
            </div>
            <button class="btn btn-light border btn-block" type="submit" ><i class="fa fa-search"></i> Filter</button> 
         </form>  --}}
         {{-- <form action="">
            <select name="" id="" class="form-control">
               <option value="">Januari</option>
               <option value="">Februari</option>
            </select>
         </form> --}}
         {{-- <a href="" class="btn btn-light border btn-block">Absensi</a> --}}
      </div>
      <div class="col-md-9">
         
          
          <div class="collapse" id="collapseExample">
            
               <form action="{{route('payroll.absence.filter.employee')}}" method="POST">
                  @csrf
                  <div class="row">
                     
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>From</label>
                           <input type="date" name="from" id="from" value="{{$from}}" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>To</label>
                           <input type="date" name="to" id="to" value="{{$to}}" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <button class="btn btn-primary btn-block" type="submit" >Filter</button> 
                     </div>
                     {{-- @if (auth()->user()->hasRole('Administrator|HRD-Payroll'))
                     <div class="col-md-2">
                        <div class="form-group form-group-default">
                           <label>Lokasi</label>
                           
                           <select name="loc" id="loc" required class="form-control">
                              <option selected value="" disabled>Choose </option>
                             
                                  <option {{$loc == 'KJ45' ? 'selected' : ''}} value="KJ45">KJ 4-5</option>
                              
                           </select>
                        </div>
                     </div>
                     @endif --}}
                     
                     
                     
                     {{-- <div class="col text-right">
                        
                     </div> --}}
      
                     {{-- @if (auth()->user()->hasRole('Administrator|HRD-Payroll'))
                     <div class="col">
                        @if ($export == true)
                           <a href="{{route('payroll.overtime.export', [$from, $to, $loc] )}}" target="_blank" class="btn btn-block btn-dark"><i class="fa fa-file-excel"></i> Export</a>
                           @endif
                           <a href="{{route('payroll.overtime.index.delete')}}">Delete multiple data? click here</a>
                        <hr>
                     </div>
                     @endif --}}
                     
                  </div>
                  
               </form> 
          </div>
          <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     <th>NIK</th>
                     <th>Name</th>
                     {{-- <th>Location</th> --}}
                     <th>Unit</th>
                     <th class="text-center">Alpha</th>
                     <th class="text-center">Terlambat</th>
                     <th class="text-center">ATL</th>
                     <th class="text-center">Izin</th>
                     <th class="text-center">Cuti</th>
                     <th class="text-center">Sakit</th>
                     {{-- <th class="text-right">Rate</th> --}}
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($employees as $emp)
                      <tr>
                        <td class="text-truncate">{{$emp->nik}}</td>
                        <td class="text-truncate" style="max-width: 140px"> 
                           <a href="{{route('payroll.absence.employee.detail', [enkripRambo($emp->id), $from, $to])}}">{{$emp->biodata->fullName()}}</a>
                        </td>
                        {{-- <td>{{$emp->location->name ?? '-'}}</td> --}}
                        <td class="text-truncate" style="max-width: 100px">{{$emp->unit->name}}</td>
                        {{-- <td>{{$emp->department->name}}</td> --}}
                        <td class="text-center">{{count($emp->getAbsences($from, $to)->where('type', 1))}}</td>
                        <td class="text-center">{{count($emp->getAbsences($from, $to)->where('type', 2))}}</td>
                        <td class="text-center">{{count($emp->getAbsences($from, $to)->where('type', 3))}}</td>
                        <td class="text-center">{{count($emp->getAbsences($from, $to)->where('type', 4))}}</td>
                        <td class="text-center">{{count($emp->getAbsences($from, $to)->where('type', 5))}}</td>
                        <td class="text-center">{{count($emp->getAbsences($from, $to)->where('type', 7))}}</td>
                        {{-- <td class="text-right">{{formatRupiahB($emp->getOvertimes($from, $to)->sum('rate'))}}</td> --}}
                      </tr>
                  @endforeach
               </tbody>
               
            </table>
         </div>
      </div>
   </div>
   
   <!-- End Row -->


</div>




@endsection