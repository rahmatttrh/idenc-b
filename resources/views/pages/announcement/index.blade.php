@extends('layouts.app')
   @section('title')
      Announcement
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Announcement</li>
         </ol>
      </nav>

      <div class="card ">
      

      <div class="card-body ">
         <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link  active " id="pills-home-tab"  href="{{route('announcement')}}" >
                 Announcement List
                 
               </a>
            </li>
            
            
            <li class="nav-item">
               <a class="nav-link " id="pills-profile-tab" href="{{route('announcement.create')}}">Form Create</a>
            </li>
            {{-- <li class="nav-item">
               <a class="nav-link " id="pills-profile-tab" href="{{route('hrd.spkl.history')}}">History  SPKL</a>
            </li> --}}
            
           
         </ul>

         {{-- <ul class="nav nav-tabs px-3">
            <li class="nav-item">
               <a class="nav-link active" href="{{route('hrd.spkl')}}">Approval SPKL  
                  
                  @if (count($spklApprovals) > 0)
                  <span class="text-danger"><b>({{count($spklApprovals)}})</b></span>
                  @endif
                  
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{route('hrd.spkl.monitoring')}}">Monitoring SPKL</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="{{route('hrd.spkl.history')}}">History SPKL</a>
             </li>
            
           
          </ul> --}}
          <div class="py-2">
               <b>Note</b>: Daftar Announcement.
            </div>

         <div class="table-responsive mt-2 border-top pt-3">
            <table class="display basic-datatables-plain table-sm table-bordered   ">
               <thead>
                  
                  <tr>
                     {{-- <th scope="col" class="text-center">ID</th> --}}
                     <th scope="col">Type</th>
                     <th>Title</th>
                     <th>To</th>
                     
                     {{-- <th>Body</th> --}}
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  
                  @foreach ($announcements as $announ)
                     <tr>
                        <td>
                           @if ($announ->type == 1)
                              Broadcast

                              @elseif($announ->type == 2)
                              Personal
                              @elseif($announ->type == 3)
                              Bisnis Unit
                              @elseif($announ->type == 4)
                              Lokasi
                           @endif
                        </td>
                        <td><a href="{{route('announcement.detail', enkripRambo($announ->id))}}">{{$announ->title}}</a> </td>
                        <td>
                           @if ($announ->type == 1)
                              All
                              @elseif($announ->type == 2)
                              {{$announ->employee->nik}} {{$announ->employee->biodata->fullName() ?? ''}}
                              @elseif($announ->type == 3)
                              {{$announ->unit->name}}
                              @elseif($announ->type == 4)
                              {{-- {{$announ->location_id}} --}}
                              {{$announ->location->name}}
                           @endif
                        </td>
                        
                        {{-- <td class="text-truncate" style="max-width: 250px">{{strip_tags($announ->body)}}</td> --}}
                        <td>
                           @if ($announ->status == 1)
                              <span class="text-primary">Active</span>
                              @elseif($announ->status == 0)
                              <span class="text-muted">Off</span>
                           @endif
                        </td>
                     </tr>
                  @endforeach
                  
               </tbody>
            </table>
         </div>


      </div>
      


   </div>
   </div>

     

@endsection