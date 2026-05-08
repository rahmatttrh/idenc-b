@extends('layouts.app')
@section('title')
Form Lembur/Piket
@endsection
@section('content')
<style>
               .note-created {
                  border-left: 5px solid #0d6efd;
                  border-radius: 10px;
                  background: #f4f8ff;
               }
               </style>



<style>
   .spkl-card {
      border: 1px solid #e9ecef;
      border-radius: 15px;
      overflow: hidden;
      transition: 0.3s;
      position: relative;
      background: #fff;
   }

   .spkl-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
   }

   .spkl-header {
      background: linear-gradient(135deg, #0753bc, #2aaafa);
      color: white;
      padding: 15px;
      position: relative;
   }

   .spkl-code {
      font-size: 13px;
      opacity: 0.9;
   }

   .spkl-icon {
      position: absolute;
      right: 15px;
      top: 15px;
      font-size: 40px;
      opacity: 0.2;
   }

   .spkl-body {
      padding: 15px;
   }

   .status-badge {
      font-size: 12px;
      padding: 6px 10px;
      border-radius: 20px;
   }

   .spkl-footer {
      border-top: 1px solid #eee;
      padding: 10px 15px;
      display: flex;
      justify-content: space-between;
   }
</style>

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page"><a href="{{route('spkl.team')}}">SPKL Team</a></li>
         
         <li class="breadcrumb-item active" aria-current="page">Detail Form SPKL</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-4">
         {{-- @if ($empSpkl->status == 0)
         <a href="" class="btn mb-2 btn-primary m btn-block" data-target="#modal-release-spkl" data-toggle="modal">Release</a>
         @endif --}}

         @if ($empSpkl->status == 1)
             @if ($empSpkl->leader_id == auth()->user()->getEmployeeId())
             <span class="btn btn-group btn-block p-0" >
               <a href="" class="btn mb-2 btn-primary m btn-block" data-target="#modal-approve-leader-spklteam" data-toggle="modal">Approve as Leader</a>
               <a href="#" class="btn mb-2 btn-danger" data-target="#modal-reject-spkl" data-toggle="modal">Reject</a>
               
            </span>
             
             
             @endif
         @endif
         
         @if ($empSpkl->status == 2)
             @if ( auth()->user()->hasRole('Manager|Asst. Manager'))
             <span class="btn btn-group btn-block p-0" >
               
               
               <a href="" class="btn mb-2 btn-primary m btn-block" data-target="#modal-approve-manager-spklteam" data-toggle="modal">Approve</a>
               <a href="#" class="btn mb-2 btn-danger" data-target="#modal-reject-spkl" data-toggle="modal">Reject</a>
               
            </span>
             
             
             @endif
         @endif
         

          <div class="card spkl-card">

            <!-- HEADER -->
            <div class="spkl-header">
               <div>
                     <h5 class="mb-1">Detail SPKL Team</h5>
                     <div class="spkl-code">
                        <i class="fa fa-barcode"></i> {{$empSpkl->code}}
                     </div>
               </div>

               <i class="fa fa-file-alt spkl-icon"></i>
            </div>

            <!-- BODY -->
            <div class="spkl-body">

               <div class="d-flex justify-content-between align-items-center">

                     <!-- STATUS -->
                     <div>
                        <small class="text-muted">Status</small><br>
                        <div class="mb-1"></div>
                        <span class="badge badge-info status-badge">
                           <i class="fa fa-check-circle"></i> 
                           <x-status.spkl-employee :empspkl="$empSpkl" />
                        </span>
                     </div>

                     <!-- OPTIONAL ACTION -->
                     <div>
                        {{-- <button class="btn btn-sm btn-outline-primary">
                           <i class="fa fa-eye"></i> View Detail
                        </button> --}}
                        @if ($empSpkl->status == 0)
                           <a href="" class="btn mb-2 btn-primary  btn-block" data-target="#modal-release-spkl" data-toggle="modal"><i class="fa fa-paper-plane"></i> Release</a>
                           @endif
                     </div>

               </div>

            </div>

            <!-- FOOTER -->
            <div class="spkl-footer">
               <small class="text-muted">
                     {{-- <a href="{{route('export.spkl', enkripRambo($empSpkl->id))}}" class="" target="_blank"> Export PDF</a> --}}
                     @if ($empSpkl->status == 0)
                     
                     <a href="#" class="">Edit</a> |
                     <a href="#" class="" data-target="#modal-delete-spkl-team" data-toggle="modal">Delete</a> |
                  @endif
               </small>

               <small class="text-muted">
                     @if ($type == 'approval')
                     <a href="{{route('leader.spkl')}}" class="><i class="fa fa-backward"></i> Back</a>
                     @elseif ($type == 'approval-hrd')
                     <a href="{{route('hrd.spkl')}}" class=""><i class="fa fa-backward"></i> Back</a>
                     @elseif($type == 'index')
                     <a href="{{route('spkl.team')}}" class=""><i class="fa fa-backward"></i> Back</a>
                     @elseif($type == 'draft')
                     <a href="{{route('spkl.team.draft')}}" class=""><i class="fa fa-backward"></i> Back</a>
                  @endif
               </small>
            </div>

         </div>


         <table >
            {{-- <thead>
               <tr>
                  <th>SPKL GROUP</th>
               </tr>
               
               <tr>
                  <th>{{$empSpkl->code}}</th>
               </tr>
            </thead> --}}
            <tbody>
              
               

               @if ($empSpkl->status == 301 || $empSpkl->status == 201)
                   <tr>
                     
                     <td class="bg-danger text-white">
                         {{formatDateTime($empSpkl->reject_date)}}
                     </td>
                   </tr>
                   <tr>
                     <td class="bg-danger text-white">{{$empSpkl->rejectBy->biodata->fullName()}}</td>
                   </tr>
                   <tr>
                     
                     <td class="bg-danger text-white pl-4">
                        : {{$empSpkl->reject_desc}}
                     </td>
                   </tr>
               @endif
               
            </tbody>
         </table>
        

         <hr>
         {{-- Dibuat oleh : <br> 
         {{$empSpkl->by->nik}} {{$empSpkl->by->biodata->fullName()}} <br>
         {{$empSpkl->created_at}} --}}

         <div class="card border shadow-none">
            <div class="card-body d-flex align-items-start gap-3">

               <!-- ICON -->
               <div class="text-primary fs-4 mr-2">
                     <i class="fa fa-user-circle"></i>
               </div>

               <!-- CONTENT -->
               <div>
                     

                     <div>
                        Dibuat oleh <strong>{{$empSpkl->by->nik}} {{$empSpkl->by->biodata->fullName()}}</strong>
                     </div>

                     <small class="text-muted">
                        {{$empSpkl->created_at}}
                     </small>
               </div>

            </div>
         </div>

         @if (auth()->user()->hasRole('Administrator'))
             ID : {{$empSpkl->by_id}}
         @endif
      </div>
      <div class="col-md-8">
         {{-- <h4>Detail Lembur/Piket</h4>
         <hr> --}}
         {{-- @if ($empSpkl->status == 0)
         <span class="btn btn-group btn-sm p-0 mb-2">
            <a href="" class="btn btn-primary btn-sm" data-target="#modal-release-spkl" data-toggle="modal">Release</a>
            <a href="" class="btn btn-light btn-sm border">Edit</a>
            <a href="" class="btn btn-light btn-sm border">Delete</a>
         </span>
         @elseif($empSpkl->status == 1)
         <a href="" class="btn btn-light btn-sm border mb-2">Menunggu Approval Atasan</a>
         @endif --}}
         
         {{-- <a href="" class="btn btn-light border btn-sm mb-2"><i class="fa fa-file"></i> Export PDF</a> --}}
         <div class="card">
            <div class="card-body">
               
         <table class="border-none" style="border: none !important; border-collapse: collapse; !important">
            <tbody>
               {{-- <tr>
                  <td style="width: 150px">Nama</td>
                  <td>{{$empSpkl->employee->biodata->fullName()}}</td>
               </tr>
               <tr>
                  <td>NIK</td>
                  <td>{{$empSpkl->employee->nik}}</td>
               </tr>
               <tr>
                  <td>Jabatan</td>
                  <td>{{$empSpkl->employee->position->name}}</td>
               </tr>
               <tr>
                  <td>Departemen</td>
                  <td>{{$empSpkl->employee->department->name}}</td>
               </tr> --}}
               <tr>
                  <th colspan="">
                     <img src="{{asset('img/logo/enc1.png')}}" alt="" width="100">
                  </th>
                  <th>SPKL TEAM</th>
               </tr>
               <tr>
                  <td style="width: 150px">ID</td>
                  <td>{{$empSpkl->code}}</td>
               </tr>
               <tr>
                  <td>Tanggal</td>
                  <td>{{formatDate($empSpkl->date)}}</td>
               </tr>
               <tr>
                  <td>Waktu</td>
                  <td>{{$empSpkl->hours_start}}  sd  {{$empSpkl->hours_end}}</td>
               </tr>
               @if ($empSpkl->type == 1)
                   <tr>
                     <td>Lama Lembur</td>
                     <td>{{$empSpkl->hours}} Jam</td>
                  </tr>
                  @else
                  <tr>
                  <td>Tipe</td>
                  <td>Piket</td>
               </tr>
               @endif
               
               <tr>
                  <td>Pekerjaan</td>
                  <td>{{$empSpkl->description}}</td>
               </tr>
               <tr>
                  <td>Lokasi Pekerjaan</td>
                  <td>{{$empSpkl->location}}</td>
               </tr>
            </tbody>
         </table>
         <table>
            <thead>
               <tr>
                  <td colspan="4">Daftar Karyawan Lembur ({{ count($empSpkl->overtimes) }})</td>
               </tr>
            </thead>
            <tbody>
               @foreach ($empSpkl->overtimes as $over)
                   <tr>
                     <td>
                        <a href="{{route('employee.spkl.detail', [enkripRambo($over->id), enkripRambo('group')])}}">{{$over->employee->nik}} </a>
                       
                     </td>
                     <td>
                        <a href="{{route('employee.spkl.detail', [enkripRambo($over->id), enkripRambo('group')])}}"> {{$over->employee->biodata->fullName()}}</a>
                        @if ($over->remark == 'duplicate') <br>
                              <small class="text-danger">Duplicate : 
                              @if ($over->duplicate->type == 1)
                                  Lembur
                                  @elseif($over->duplicate->type == 2)
                                  Piket
                              @endif   <br>
                              {{formatDate($over->duplicate->date)}} {{$over->duplicate->hours_start}} - {{$over->duplicate->hours_end}}
                              
                              </small> <br>
                              
                        @endif
                     </td>
                     <td>
                        <x-status.spkl-employee :empspkl="$over" />
                     </td>

                     <td>
                        @if ($over->status == 0)
                        
                           {{-- <a href="{{route('employee.spkl.edit', enkripRambo($over->id))}}" class="" >Edit</a> | --}}
                           <a href="#" class="" data-target="#modal-remove-spkl-{{$over->id}}" data-toggle="modal">Delete</a> 
                        @endif
                        {{-- <a href="">Delete</a> --}}
                     </td>
                    
                   </tr>

                   <div class="modal fade" id="modal-remove-spkl-{{$over->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content text-dark">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body ">
                              Delete Form Pengajuan ? 
                              <hr>
                              data akan terhapus permanen dari sistem
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-danger ">
                                 <a class="text-light" href="{{route('employee.spkl.remove', enkripRambo($over->id))}}">Delete</a>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </tbody>
         </table>
         <table>
            <tbody>
               <tr>
                  <td>Requested by <br> Leader</td>
                  <td>Reviewed by <br>Atasan Langsung </td>
                  <td>Approved by <br>Manager </td>
                  {{-- <td>Employee</td> --}}
               </tr>
               <tr>
                  <td class="text-center py-3">
                     @if ($empSpkl->status > 0 && $empSpkl->status < 10)
                     <span class="text-info">Released</span>
                     @else
                     
                     @endif
                     
                  </td>
                  <td>
                     @if ($empSpkl->status > 1 && $empSpkl->status < 10 )
                        <span class="text-info">Approved</span>
                        @else
                        
                        @endif
                  </td>
                  <td>
                     @if ($empSpkl->status > 2 && $empSpkl->status < 10)
                     @if ($empSpkl->asmen_id != null)
                           <span class="text-info">Approved as Manager</span>
                              @else
                              <span class="text-info">Approved</span>
                           @endif
                     @else
                     
                     @endif
                  </td>
                  
               </tr>
               <tr>
                  <td>
                     {{$empSpkl->by->biodata->fullName()}}
                  </td>
                  <td>
                     @if ($empSpkl->leader_id != null)
                     {{$empSpkl->leader->biodata->fullName()}}
                     @else
                     
                     @endif
                  </td>
                  <td>
                     {{-- @if ($empSpkl->status > 2 && $empSpkl->status < 10) --}}
                        @if ($empSpkl->asmen_id != null)
                        {{$empSpkl->asmen->biodata->fullName()}}
                           @elseif($empSpkl->manager_id != null)
                           {{$empSpkl->manager->biodata->fullName()}}
                        @endif
                        {{-- {{$empSpkl->manager->biodata->fullName()}} --}}
                        {{-- @else
                        
                     @endif --}}
                  </td>
                  
               </tr>
               <tr>
                  <td>{{$empSpkl->release_employee_date ?? ''}}</td>
                  <td>
                     @if ($empSpkl->approve_leader_date)
                            {{formatDateTime($empSpkl->approve_leader_date)}}
                        @endif
                  </td>
                  <td>
                     

                  @if ($empSpkl->approve_manager_date)

                            {{formatDateTime($empSpkl->approve_manager_date)}}
                        @endif
                        @if ($empSpkl->approve_asmen_date)
                           
                            {{formatDateTime($empSpkl->approve_asmen_date)}}
                        @endif
                  </td>
                  
               </tr>
            </tbody>
         </table>
         
            </div>
         </div>
         <hr>
         
      </div>
   </div>
   
   <!-- End Row -->


</div>

<div class="modal fade" id="modal-release-spkl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
      <div class="modal-content text-dark">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body ">
            Release Form Pengajuan Multple Karyawan ? 
            <hr>
            <span class="text-muted">Mengirim Form Pengajuan ke atasan terkait untuk proses Approval</span>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary ">
               <a class="text-light" href="{{route('employee.spkl.release.multiple', enkripRambo($empSpkl->id))}}">Release</a>
            </button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-delete-spkl-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content text-dark">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body ">
            Delete Form Pengajuan ? 
            <hr>
            data akan terhapus permanen dari sistem
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger ">
               <a class="text-light" href="{{route('employee.spkl.delete.team', enkripRambo($empSpkl->id))}}">Delete</a>
            </button>
         </div>
      </div>
   </div>
</div>


{{-- Approvall Leader --}}
<div class="modal fade" id="modal-approve-leader-spklteam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content text-dark">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve as Leader</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body ">
            
            Setujui Formulir Pengajuan SPKL Group dengan ID {{$empSpkl->code}} ini?
            <hr>
            {{count($empSpkl->overtimes)}} Karyawan Lembur
            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary ">
               <a class="text-light" href="{{route('leader.spkl.group.approve', enkripRambo($empSpkl->id))}}">Approve</a>
            </button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-approve-manager-spklteam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content text-dark">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve as Manager</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body ">
            {{-- <b>Approve as Manager</b> <br> --}}
            Setujui Formulir Pengajuan SPKL Group dengan ID {{$empSpkl->code}} ini? 
            <hr>
            {{count($empSpkl->overtimes)}} Karyawan Lembur
            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary ">
               <a class="text-light" href="{{route('manager.spkl.group.approve', enkripRambo($empSpkl->id))}}">Approve</a>
            </button>
         </div>
      </div>
   </div>
</div>
{{-- Approval  --}}


{{-- Reject --}}
<div class="modal fade" id="modal-reject-spkl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Reject<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('leader.spkl.multiple.reject')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$empSpkl->id}}" name="spklEmp" id="spklEmp" hidden>
               <span>Reject Pengajuan SPKL ?</span>
               <hr>
               <div class="form-group form-group-default">
                  <label>Remark</label>
                  <input type="text" class="form-control" required name="desc" id="desc"  >
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger ">Reject</button>
            </div>
         </form>
      </div>
   </div>
</div>
{{-- Reject --}}




@endsection