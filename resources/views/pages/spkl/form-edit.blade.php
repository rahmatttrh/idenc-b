@extends('layouts.app')
@section('title')
Form Lembur/Piket
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         
         <li class="breadcrumb-item active" aria-current="page">Form Lembur - Piket</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-3">
         {{-- <h4><b>SPKL SAYA</b></h4>
         <hr> --}}
         <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link  text-left pl-3" id="v-pills-basic-tab" href="{{route('employee.spkl')}}" aria-controls="v-pills-basic" aria-selected="true">
               <i class="fas fa-address-book mr-1"></i>
               List SPKL
            </a>
            <a class="nav-link   text-left pl-3" id="v-pills-contract-tab" href="{{route('employee.spkl.progress')}}" aria-controls="v-pills-contract" aria-selected="false">
               <i class="fas fa-file-contract mr-1"></i>
               {{-- {{$panel == 'contract' ? 'active' : ''}} --}}
               Progress
            </a>
            
            <a class="nav-link  text-left pl-3" id="v-pills-personal-tab" href="{{route('employee.spkl.draft')}}" aria-controls="v-pills-personal" aria-selected="true">
               <i class="fas fa-user mr-1"></i>
               Draft
            </a>
           

            <a class="nav-link  text-left pl-3" id="v-pills-document-tab" href="{{route('employee.spkl.create')}}" aria-controls="v-pills-document" aria-selected="false">
               <i class="fas fa-file mr-1"></i>
               Form SPKL 
            </a>
            {{-- <a class="nav-link text-left pl-3" id="v-pills-document-tab" href="{{route('employee.spkl.create.multiple')}}" aria-controls="v-pills-document" aria-selected="false">
               <i class="fas fa-file mr-1"></i>
               Form SPKL B
            </a> --}}
            
         </div>
         <hr>
         <b>#INFO</b> <br>
         <small>Form SPKL digunakan untuk pengajuan lembur/piket satu karyawan</small> <br> <br>
         <small>"Jam Mulai" dan "Jam Selesai" wajib diisi untuk pengajuan Lembur</small>
        
         <hr>
      </div>
      <div class="col-md-9">
         <h4>Form Edit SPKL</h4>
         <hr>
         <form action="{{route('employee.spkl.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="empSpkl" id="empSpkl" value="{{$empSpkl->id}}" hidden>
            <div class="row">
               <div class="col-12">
                  
                     
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Date</label>
                              <input type="date" required class="form-control" id="date" value="{{$empSpkl->date}}" name="date" >
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Piket/Lembur</label>
                              <select class="form-control " required name="type" id="type">
                                 {{-- <option value="" disabled selected>Select</option> --}}
                                 <option {{$empSpkl->type == 1 ? 'selected' : ''}} value="1">Lembur</option>
                                 <option {{$empSpkl->type == 2 ? 'selected' : ''}}  value="2">Piket</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default ">
                              <label>Atasan</label>
                              <select class="form-control " required name="leader" id="leader">
                                 {{-- <option selected value="{{$leader->id}}">{{$leader->biodata->fullName()}}</option> --}}
                                 <option value="" disabled selected>Select</option>
                                 @foreach ($employeeLeaders as $lead)
                                    <option {{$empSpkl->leader_id == $lead->leader->id ? 'selected' : ''}}  value="{{$lead->leader->id}}">{{$lead->leader->biodata->fullName()}}</option>
                                 @endforeach
                                
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default ">
                              <label>Manager</label>
                              <select class="form-control " required  name="manager" id="manager">
                                 {{-- <option value="" disabled selected>Select</option> --}}
                                 @foreach ($managers as $man)
                                    <option selected value="{{$man->id}}">{{$man->biodata->fullName()}}</option>
                                 @endforeach
                                 {{-- <option  value="4">Izin</option>
                                 <option value="5">Cuti</option>
                                 <option  value="6">SPT</option>
                                 <option value="7">Sakit</option> --}}
                              </select>
                           </div>
                           
                        </div>
                        {{-- <div class="col">
                           <div class="form-group form-group-default">
                              <label>Type</label>
                              <select class="form-control " required name="holiday_type" id="holiday_type">
                                 <option value="" disabled selected>Select</option>
                                 <option value="1">Hari Kerja</option>
                                 <option value="2">Hari Libur</option>
                                 <option value="3">Hari Libur Nasional</option>
                                 <option value="4">Hari Libur Idul Fitri</option>
                              </select>
                           </div>
                        </div> --}}
                        
                        
                        
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Type</label>
                              <select class="form-control " required name="holiday_type" id="holiday_type">
                                 <option value="" disabled selected>Select</option>
                                 <option {{$empSpkl->holiday_type == 1 ? 'selected' : ''}} value="1">Hari Kerja</option>
                                 <option {{$empSpkl->holiday_type == 2 ? 'selected' : ''}}>Hari Libur</option>
                                 <option {{$empSpkl->holiday_type == 3 ? 'selected' : ''}}>Hari Libur Nasional</option>
                                 <option {{$empSpkl->holiday_type == 4 ? 'selected' : ''}}>Hari Libur Idul Fitri</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Jam Mulai</label>
                              <input type="time" class="form-control" id="hours_start" name="hours_start" value="{{$empSpkl->hours_start}}" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Jam Selesai</label>
                              <input type="time" class="form-control" id="hours_end" name="hours_end" value="{{$empSpkl->hours_end}}">
                           </div>
                        </div>
                        {{-- <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Jam Mulai</label>
                              <input type="datetime-local" class="form-control" id="hours_start" name="hours_start" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Jam Selesai</label>
                              <input type="datetime-local" class="form-control" id="hours_end" name="hours_end" >
                           </div>
                        </div> --}}
         
                     </div>
                     <div class="form-group form-group-default">
                        <label>Pekerjaan</label>
                        <textarea type="text"  class="form-control" id="desc" name="desc" rows="3" >{{$empSpkl->description}}</textarea>
                     </div>
                    
                     
                     
                     
                     
                  
               </div>
               
               
            </div>

            <div class="row">
               <div class="col-md-4">
                  <div class="form-group form-group-default">
                     <label>Lokasi Pekerjaan</label>
                     <select class="form-control "  required name="location" id="location">
                        <option value="" disabled selected>Select</option>
                        @foreach ($locations as $loc)
                        <option {{$empSpkl->location_id == $loc->id ? 'selected' : ''}} value="{{$loc->id}}">{{$loc->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
              
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Document</label>
                     <input type="file"  class="form-control" id="doc" name="doc" >
                  </div>
                  
               </div>
            </div>
            <div class="form-check">
               <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" value="" name="rest" {{$empSpkl->rest == 1 ? 'checked' : ''}}>
                  <span class="form-check-sign">Kurangi jam istirahat</span>
               </label>
            </div>
            <div class="row">
              
            </div>
            <button class="btn btn-primary " type="submit"><i class="fa fa-save"></i> Update</button>
         </form>
      </div>
   </div>
   
   <!-- End Row -->


</div>




@endsection