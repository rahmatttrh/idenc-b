@extends('layouts.app')
@section('title')
SPKL
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">SPKL</li>
      </ol>
   </nav>

   <div class="card shadow-none border col-md-12">
      <div class=" card-header">
        
      </div>

      <div class="card-body px-0">

         <div class="row">
           
            <div class="col-md-12">
            
               
               <div class="table-responsive">
                  <table id="data" class="display basic-datatables table-sm">
                     <thead>
                        <tr>
                           <th>NIK</th>
                           <th>Name</th>
                           <th>Unit</th>
                           <th>Qty SPKL</th>
                           <th>Rate</th>
                           <th></th>
                        </tr>
                     </thead>
                     
                     <tbody>
                        @foreach ($employees as $emp)
                            <tr>
                              
                              <td class="text-truncate">{{$emp->nik}}</td>
                              <td class="text-truncate" style="max-width: 200px">{{$emp->biodata->fullName()}}</td>
                              <td>{{$emp->unit->name}}</td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
      
                           <div class="modal fade" id="modal-delete-overtime-{{$over->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                       @if ($over->type == 1)
                                          Lembur
                                          @else
                                          Piket
                                       @endif
                                       {{$over->employee->nik}} {{$over->employee->biodata->fullName()}}
                                       tanggal {{formatDate($over->date)}}
                                       ?
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                       <button type="button" class="btn btn-danger ">
                                          <a class="text-light" href="{{route('payroll.overtime.delete', enkripRambo($over->id))}}">Delete</a>
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


      </div>
      <div class="card-footer">
         <a href="{{route('overtime.refresh')}}">Refresh</a>
      </div>


   </div>
   <!-- End Row -->


</div>




@endsection