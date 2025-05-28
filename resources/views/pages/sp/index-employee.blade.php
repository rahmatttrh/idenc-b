@extends('layouts.app')
@section('title')
SP
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Surat Peringatan</li>
      </ol>
   </nav>

   <div class="card border shadow-none">
      <div class="card-header d-flex justify-content-between">
          <h2>Surat Peringatan</h2>
          {{-- <div>
             <a href="{{route('task.history')}}" class="btn btn-light border btn-sm">History</a>
             <a href="{{route('task.create')}}" class="btn btn-primary btn-sm">Add New Task</a>
          </div> --}}
      </div>
      
      
      <div class="card-body p-0 pt-3">
         <div class="table-responsive">
            <table id="" class="display basic-datatables table-sm table-bordered  table-striped ">
               <thead>
                  <tr>
                     {{-- <th class="text-center" style="width: 10px">No</th> --}}
                     <th>ID</th>
                     <th>NIK</th>
                     <th>Name</th>
                     
                     
                     <th>Level</th>
                     <th>Status</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>

                  {{-- novi
                  $2y$10$mpL93naoGVjJFMhL/RFR0upzQQRyQZMcnBrJVy6m80BeB1AFxl.M2 --}}

                  {{-- $2y$10$Z5gH9fEqeWD3wbXsDQtUk.i7Ko7HKJOHpo7/WWKkdzDh7cl6R9jQy --}}
                  @if (auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment'))
                  @foreach ($sps as $sp)
                  <tr>
                     {{-- <td class="text-center">{{++$i}}</td> --}}
                     <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->code}}</a> </td>
                     <td>{{$sp->employee->nik}}</td>
                     <td> {{$sp->employee->biodata->fullName()}}</td>
                     {{-- <td>{{$sp->employee->nik}}</td> --}}
                     {{-- <td>{{formatDate($sp->date)}}</td> --}}
                     <td>SP {{$sp->level}}</td>
                     <td>
                        <x-status.sp :sp="$sp" />
                     </td>
                     <td>{{formatDate($sp->date_from)}}</td>
                     {{-- <td class="text-truncate" style="max-width: 240px">{{$sp->desc}}</td> --}}

                  </tr>
                  @endforeach
                  @else
                     @if (count($employee->positions) > 0)
                        @foreach ($employee->positions as $pos)
                           {{-- <tr>
                           <td colspan="6">{{$pos->department->unit->name}} {{$pos->department->name}}</td>
                           </tr> --}}
                           @foreach ($pos->department->sps()->orderBy('updated_at', 'desc')->get() as $sp)
                              <tr>
                                 {{-- <th></th> --}}
                                 <td>{{$sp->code}}</td>
                                 <td>{{$sp->employee->nik}}</td>
                                 <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}"> {{$sp->employee->biodata->fullName()}}</a></td>
                                 
                                 {{-- <td>{{$sp->employee->biodata->first_name}} {{$sp->employee->biodata->last_name}}</td> --}}
                                 
                                 <td>SP {{$sp->level}}</td>
                                 <td>
                                    <x-status.sp :sp="$sp" />
                                 </td>
                                 <td>{{formatDate($sp->date_from)}}</td>
                              </tr>
                           @endforeach
                        @endforeach
                        @else
                        @foreach ($sps as $sp)
                           <tr>
                              {{-- <th></th> --}}
                              <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->code}}</a> </td>
                              <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->employee->nik}} </a></td>
                              <td>{{$sp->employee->biodata->fullName()}}</td>
                              {{-- <td>{{$sp->code}}</td> --}}
                              {{-- <td>{{$sp->employee->biodata->first_name}} {{$sp->employee->biodata->last_name}}</td> --}}
                              
                              <td>SP {{$sp->level}}</td>
                              <td>
                                 <x-status.sp :sp="$sp" />
                              </td>
                              <td>{{formatDate($sp->date_from)}}</td>
                           </tr>
                        @endforeach
                     @endif
                     
                  @endif
               </tbody>
            </table>
         </div>
      </div>
      {{-- <div class="card-footer text-muted">
          <small>Data Task List dapat dilihat oleh atasan untuk tujuan monitoring pekerjaan</small>
      </div> --}}
  </div>
   


   
</div>

@push('myjs')
   <script>
      console.log('get_aktif_sp');
      $(".sp").hide();
   

      $(document).ready(function() {
         $('.employee').change(function() {
            
            var employee = $('#employee').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('employeeId:' + employee);
            
            $.ajax({
               url: "/fetch/sp/active/" + employee ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  // console.log('near :' + result.near);
                  // console.log('result :' + result.result);
                  
                  console.log('status :' + result.success);
                  if (result.success == true) {
                     $('.result').empty()
                     console.log('adaaa');
                     $(".sp").show();
                  } else {
                     $('.result').empty()
                     console.log('kosong');
                     $(".sp").hide();
                  }
                  

                  $.each(result.result, function(i, index) {
                     $('.result').html(result.result);

                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })
      })
   </script>
@endpush



@endsection