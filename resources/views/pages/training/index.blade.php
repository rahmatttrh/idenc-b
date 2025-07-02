@extends('layouts.app')
@section('title')
Training
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Training</li>
      </ol>
   </nav>

   <div class="row">
      
      <div class="col-md-4">
         <div class="card shadow-none border">
            <div class="card-header d-flex">
               <div class="d-flex  align-items-center">
                  <div class="card-title">Form Add Training</div>
               </div>
               {{-- <div class="btn-group btn-group-page-header ml-auto">
                     <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-ellipsis-h"></i>
                     </button>
                     <div class="dropdown-menu">
                        
                        
                        <a  class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
            </div>
         </div> --}}
      </div>
      <div class="card-body">
         <form action="{{route('training.store')}}" method="POST">
            @csrf
            {{-- <div class="form-group form-group-default">
               <label>Level</label>
               <select name="level" id="level" class="form-control">
                  <option value="Mandatory">Mandatory</option>
                  <option value="Optional">Optional</option>
               </select>
            </div> --}}
            
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group form-group-default">
                     <label>Code *</label>
                     <input id="code" name="code" required required class="form-control" >

                     
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group form-group-default">
                     <label>Title *</label>
                     <textarea id="title" name="title"  required class="form-control" >

                     </textarea>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group form-group-default">
                     <label>Description</label>
                     <textarea id="desc" name="desc"  class="form-control" ></textarea>
                  </div>
               </div>
               {{-- <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Code</label>
                     <input id="code" name="code" type="text" class="form-control">
                  </div>
               </div> --}}
            </div>
            
            <button type="submit" class="btn btn-block btn-primary">Submit</button>

         </form>
      </div>
      <div class="card-footer">
         {{-- <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni at neque inventore vel.</small> --}}
      </div>
   </div>
</div>
<div class="col-md-8">
   <div class="card">
      <div class="card-header p-2 bg-primary text-white">
         <small>Training List</small>
      </div>
      <div class="card-body p-0">
         <table class="display  table-sm table-bordered   ">
            <thead>
               <tr>
                  {{-- <th class="text-center">#</th> --}}
                  <th>Code</th>
                  <th>Title</th>
                  {{-- <th>Level</th> --}}
                  <th>Desc</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ($trainings as $train)
                   <tr>
                     <td>{{$train->code}}</td>
                     <td>{{$train->title}}</td>
                     {{-- <td>{{$train->level}}</td> --}}
                     <td>{{$train->desc}}</td>
                     <td>
                        <a href="#"  data-target="#modal-edit-training-{{$train->id}}" data-toggle="modal">Edit</a> |
                        <a href="#"  data-target="#modal-delete-training-{{$train->id}}" data-toggle="modal">Delete</a>
                     </td>
                   </tr>


                   <div class="modal fade" id="modal-delete-training-{{$train->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog " role="document">
                        <div class="modal-content text-dark">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete Master Data Training?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body ">
                              {{$train->title}}
                              @if (count($train->histories) > 0)
                              <hr>


                              Data Training sudah di input ke Training History : <br>
                              @foreach ($train->histories as $his)
                                  - {{$his->employee->nik}} {{$his->employee->biodata->fullName()}} <br>
                              @endforeach
                              <hr>
                              <small class="text-muted">Menghapus data ini akan merubah kolom Pelatihan menjadi Empty pada halaman Training History</small>

                              @endif
                              

                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-danger ">
                                 <a class="text-light" href="{{route('training.delete', enkripRambo($train->id))}}">Delete</a>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="modal fade" id="modal-edit-training-{{$train->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog " role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Form Edit Training 
                              </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <form action="{{route('training.update')}}" method="POST" >
                              <div class="modal-body">
                                 @csrf
                                 @method('PUT')
                                 <input type="text" value="{{$train->id}}" name="training" id="training" hidden>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group form-group-default">
                                          <label>Code *</label>
                                          <input id="code" name="code" required required class="form-control" value="{{$train->code}}">
                     
                                          
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group form-group-default">
                                          <label>Title *</label>
                                          <textarea id="title" name="title"  required class="form-control" >{{$train->title}}
                                          </textarea>
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group form-group-default">
                                          <label>Description</label>
                                          <textarea id="desc" name="desc"  class="form-control" >{{$train->desc}}</textarea>
                                       </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                       <div class="form-group form-group-default">
                                          <label>Code</label>
                                          <input id="code" name="code" type="text" class="form-control">
                                       </div>
                                    </div> --}}
                                 </div>
                                    
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-dark ">Update</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  
                  
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
   {{-- <div class="card shadow-none border">
      <div class="card-header d-flex">
         <div class="d-flex  align-items-center">
            <div class="card-title">Level List</div>
         </div>
         <div class="btn-group btn-group-page-header ml-auto">
            <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">


               <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
               
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
            </div>
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table id="basic-datatables" class="display basic-datatables table table-striped ">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Level</th>
                     <th>Golongan</th>
                     <th class="text-right">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($designations as $designation)
                  <tr>
                     <td>{{++$i}}</td>
                     <td>{{$designation->name}}</td>
                     <td>{{$designation->golongan}}</td>
                     <td class="text-right">
                        <a href="{{route('designation.edit', enkripRambo($designation->id) )}}">Edit</a>
                        <a href="#" data-toggle="modal" data-target="#modal-delete-{{$designation->id}}">Delete</a>
                     </td>
                  </tr>
                  <x-modal.delete :id="$designation->id" :body="$designation->name" url="{{route('designation.delete', enkripRambo($designation->id))}}" />
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div> --}}
</div>
</div>
</div>

@endsection