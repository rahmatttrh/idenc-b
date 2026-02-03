@extends('layouts.app-doc')
@section('title')
Training History Report
@endsection
@section('content')

<style>
   html {
      -webkit-print-color-adjust: exact;
   }

   table,
   th,
   td {
      
      /* border: 1px solid black;
      border-collapse: collapse; */
   }

   .ttd {
      font-size: 10px;
   }

   table td {
      font-size: 10px;
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 5px;
      padding-right: 5px;
      border: 1px solid rgb(180, 173, 173);
   }

   table th {
      font-size: 10px;
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 5px;
      padding-right: 5px;
      background-color: rgb(200, 200, 202);
      border: 1px solid rgb(180, 173, 173);
   }



   table {
      width: 100%;
      border: 1px solid rgb(180, 173, 173);
   }


   .border-none {
      border: none;
   }

   /* table td {
      font-size: 8px;
   } */
</style>


<div class="page-body">
   {{-- <div class="container-xl"> --}}
      <div class="card card-lg shadow-none border-none">
         {{-- <div class="card-footer d-print-none">
            <small>*Disarankan merubah layout ke mode <b>landscape</b> setelah klik tombol 'Print' untuk hasil yang lebih baik.</small>
         </div> --}}
         <div class="card-body px-2 py-1">
            <h1>TRAINING HISTORY</h1>
            <span class="text-uppercase ">PT {{$unit->name}}</span>

            <div class="border-bottom"></div>

            {{-- <table class="mt-2">
               <tbody>
                  <tr>
                     <td style="width: 100px">Nama</td>
                     <td>{{$employee->biodata->fullName()}}</td>
                  </tr>
                  <tr>
                     <td >NIK</td>
                     <td>{{$employee->nik}}</td>
                  </tr>
                  <tr>
                     <td >Divisi</td>
                     <td>{{$employee->contract->department->name}}</td>
                  </tr>
                  <tr>
                     <td >Jabatan</td>
                     <td>{{$employee->contract->position->name}}</td>
                  </tr>
                  <tr>
                     <td >Lokasi</td>
                     <td>{{$employee->location->name}}</td>
                  </tr>
               </tbody>
            </table> --}}
            {{-- <hr> --}}
            {{-- <br> --}}
            <table class="table-sm mt-3">
               <thead>
                  <tr>
                   
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Dept</th>
                    <th>Jabatan</th>
                    <th>Lokasi</th>
                    <th>Pelatihan</th>
                    <th>Periode</th>
                    <th>Sertifikat</th>
                    {{-- <th>Type</th> --}}
                    <th>Vendor</th>
                    <th>Berlaku</th>
                  </tr>
               </thead>
      
               <tbody>
                  @foreach ($trainingHistories as $his)
                      <tr>
                        
                        <td class="text-truncate"> {{$his->employee->nik}}</td>
                        <td class="text-truncate" style="max-width: 160px">{{$his->employee->biodata->fullName()}}</td>
                        <td class="text-truncate">{{$his->employee->department->name ?? ''}}</td>
                        <td class="">
                           @if (count($his->employee->positions) > 0)
                               {{-- @foreach ($his->employee->positions as $pos)
                                   {{$pos->name}}, 
                               @endforeach --}}
                               {{$his->employee->positions->first()->name}}
                               @else
                               {{$his->employee->position->name  ?? ''}}
                           @endif
                           
                        </td>
                        <td class="text-truncate">{{$his->employee->location->name ?? ''}}</td>
                        
                        <td class="">
                           
                           {{$his->training->title ?? 'Empty'}}
                        </td>
                        <td class="">{{$his->periode}}</td>
                        <td class="text-truncate">{{$his->type_sertificate}}</td>
                        <td class="">{{$his->vendor}}</td>
                        <td>
                           @if ($his->expired != null)
                           {{formatDate($his->expired)}}
                           @else
                           -
                           @endif
                           
                        </td>
                        
                        {{-- <td class="text-truncate">
                           <a href="#" data-target="#modal-sertifikat-training-history-{{$his->id}}" data-toggle="modal">Sertifikat</a> |
                           <a href="{{route('training.history.edit', enkripRambo($his->id))}}">Edit</a> | 
                           <a href="#" data-target="#modal-delete-training-history-{{$his->id}}" data-toggle="modal">Delete</a>
                        </td> --}}
                      </tr>

                     {{-- <div class="modal fade" id="modal-delete-training-history-{{$his->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                           <div class="modal-content text-dark">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Delete Training History?</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body ">
                                
                                {{$his->employee->nik}} {{$his->employee->biodata->fullName()}} : 
                              
                                {{$his->training->title ?? 'Empty'}}
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-danger ">
                                    <a class="text-light" href="{{route('training.history.delete', enkripRambo($his->id))}}">Delete</a>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div> --}}

                     {{-- <div class="modal fade" id="modal-sertifikat-training-history-{{$his->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Sertifikat Pelatihan</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                    
                     
                                       <iframe height="550px" width="100%" src="{{asset('storage/' . $his->doc)}}" frameborder="0"></iframe>
                                       
                                       
                     
                                       
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                </div>
                             
                           </div>
                        </div>
                     </div> --}}
                     
                     
                  @endforeach
               </tbody>
            </table>
         </div>
         
      </div>
   {{-- </div> --}}
</div>
@endsection