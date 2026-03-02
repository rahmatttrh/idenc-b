@extends('layouts.app')
@section('title')
Export History Training
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         
         <li class="breadcrumb-item active" aria-current="page">Export History Training</li>
      </ol>
   </nav>


   <div class="card">
      <div class="card-body">
         <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link " id="pills-home-tab"  href="{{route('training.history')}}">Training History</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="pills-profile-tab" href="{{route('training.history.create')}}">Input Training History</a>
            </li>
            <li class="nav-item">
               <a class="nav-link active" id="pills-profile-tab" href="{{route('training.history.export')}}">Export PDF</a>
            </li>
           
           
         </ul>
        
         <hr>
         <div class="row">
            <div class="col-md-8">
               <form action="{{ route('training.history.export') }}" method="POST" target="_blank">
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
                  {{-- <div class="row">
                     <div class="col-md-6">
                        <input type="date" name="start" id="start" class="form-control">
                     </div>
                     <div class="col-md-6">
                        <input type="date" name="end" id="end" class="form-control">
                     </div>
                  </div> --}}
                  <button type="submit" class="btn btn-primary">Export to PDF</button>
               </form>
            </div>
         </div>
         
      </div>
   </div>
   


</div>




@endsection