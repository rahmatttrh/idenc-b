@extends('layouts.app')

@section('title')
Detail Transaction Payroll Employee
@endsection

@section('content')
<div class="page-inner">
   
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         
         <li class="breadcrumb-item active" aria-current="page">Detail Transaction</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-4">
         {{-- <a href=""  class="btn btn-primary btn-block">Submit</a> --}}
         <h1>Slip Gaji</h1>
         <hr>
         <div class="card card-light shadow-none border">
            <div class="card-header">
               
               
               <div class="card-list">
                  <div class="item-list">
                     
                     <div class="info-user">
                        <div class="username">
                           <h3>{{$transaction->employee->biodata->first_name}} {{$transaction->employee->biodata->last_name}}</h3>
                        </div>
                        
                     </div>
                  </div>
               </div>
              
               <div class="d-flex justify-content-between">
                  <div>
                     Unit <br>
                     NIK <br>
                     Department <br>
                     Position 

                  </div>
                  <div class="text-right">
                     {{$transaction->employee->contract->unit->name ?? '-'}} <br>
                     {{$transaction->employee->nik ?? '-'}} <br>
                     {{$transaction->employee->department->name ?? '-'}} <br>
                     {{$transaction->employee->position->name ?? '-'}}

                  </div>
               </div>
            </div>
          
            <div class="card-body">
               <b>{{formatRupiah($transaction->employee->payroll->total ?? 0)}}</b>
            </div>
            <div class="card-footer d-flex justify-content-between">
               <div>
                  @foreach ($transaction->details->where('type', 'basic') as $trans)
                      {{$trans->desc}} <br>
                  @endforeach
                  
               </div>
               <div class="text-right">
                  @if ($transaction->employee->payroll_id != null)
                  {{formatRupiah($transaction->employee->payroll->pokok) ?? 0}} <br>
                  {{formatRupiah($transaction->employee->payroll->tunj_jabatan) ?? 0}} <br>
                  {{formatRupiah($transaction->employee->payroll->tunj_ops) ?? 0}}  <br>
                  {{formatRupiah($transaction->employee->payroll->tunj_kinerja) ?? 0}} <br>
                  {{formatRupiah($transaction->employee->payroll->tunj_fungsional) ?? 0}} <br>
                  {{formatRupiah($transaction->employee->payroll->insentif) ?? 0}}
                      @else
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                  @endif
                  
               </div>
               
               
            </div> 
         </div>
      </div>
      <div class="col-md-8">
         

         <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
               <div class="card card-with-nav shadow-none border">
                  <div class="card-header">
                     <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                           <li class="nav-item"> <a class="nav-link show active" id="pills-basic-tab-nobd" data-toggle="pill" href="#pills-basic-nobd" role="tab" aria-controls="pills-basic-nobd" aria-selected="true">Detail Transaksi Agustus</a> </li>
                           <li class="nav-item"> <a class="nav-link " id="pills-deduction-tab-nobd" data-toggle="pill" href="#pills-deduction-nobd" role="tab" aria-controls="pills-deduction-nobd" aria-selected="true">Deduction</a> </li>
                           <li class="nav-item"> <a class="nav-link " id="pills-deduction-tab-nobd" data-toggle="pill" href="#pills-deduction-nobd" role="tab" aria-controls="pills-deduction-nobd" aria-selected="true">Penambahan</a> </li>
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                        <div class="tab-pane fade show active" id="pills-basic-nobd" role="tabpanel" aria-labelledby="pills-basic-tab-nobd">
                           <div class="row">
                              <div class="col-md-12">
                                 <table>
                                    <thead>
                                       <tr>
                                          <th colspan="2">Period Cut Off {{formatDate($transaction->cut_from)}} - {{formatDate($transaction->cut_to)}}</th>
                                       </tr>
                                       <tr>
                                          <th>Description</th>
                                          <th class="text-right">Nominal</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>Pendapatan</td>
                                          <td class="text-right">{{formatRupiah($payroll->total)}}</td>
                                       </tr>
                                       <tr>
                                          <td>Lembur & Piket</td>
                                          <td class="text-right">{{formatRupiah($totalOvertime)}}</td>
                                       </tr>
                                       <tr>
                                          <td>Additional</td>
                                          <td class="text-right">{{formatRupiah($addPenambahan)}}</td>
                                       </tr>
                                       <tr>
                                          <td>Bruto</td>
                                          <td class="text-right">{{formatRupiah($transaction->bruto)}}</td>
                                       </tr>
                                       <tr>
                                          <td><b>Gaji Bersih</b></td>
                                          <th class="text-right"><b> {{formatRupiah($transaction->total)}}</b></th>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        
                           {{-- <div class="row">
                              <div class="col-3">
                                 <span><b>Gaji Bersih</b></span> <br>
                                 <span>Pendapatan</span> <br>
                                 <span>Lembur</span> <br>
                                 <span>Potongan</span>
                              </div>
                              <div class="col-md-9">
                                 <span>: <b>{{formatRupiah($transaction->total)}}</b></span> <br>
                                 <span>: {{formatRupiah($payroll->total)}}</span> <br>
                                 <span>: {{formatRupiah($totalOvertime)}} </span> <br>
                                 <span>: {{formatRupiah($transaction->reduction)}}</span> <br>
                              </div>
                           </div> --}}
                           <hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="5">Lembur & Piket</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($overtimes as $over)
                                           <tr>
                                             <td>{{formatDate($over->date)}}</td>
                                             <td>
                                                @if ($over->type == 1)
                                                    L
                                                    @else
                                                    P
                                                @endif
                                             </td>
                                             <td class="text-right">{{$over->hours}} Jam</td>
                                             <td class="text-right text-info">{{formatRupiah($over->rate)}}</td>
                                             <td><a href="{{route('payroll.overtime.delete', enkripRambo($over->id))}}">Delete</a></td>
                                           </tr>
                                       @endforeach
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                              
                           </div>
                           {{-- <div class="row">
                              
                              <div class="col">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Beban Perusahaan</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('type', 'company') as $red)
                                           <tr>
                                             <td>{{$red->name}}</td>
                                             <td class="text-right">{{formatRupiah($red->value)}}</td>
                                           </tr>
                                           @if ($red->value_real != $red->value)
                                           <tr>
                                             <td class="text-right">+ Selisih</td>
                                             <td class="text-right"><b>{{formatRupiah($red->value_real)}}</b></td>
                                           </tr>
                                           @endif
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div> --}}
                           <hr>

                           <table class="mt-2">
                              <thead>
                                 <tr>
                                    <th colspan="5">Additional</th>
                                    
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($additionals as $add)
                                    <tr>
                                       <td>
                                          @if ($add->type == 1)
                                              Penambahan
                                              @else
                                              Pengurangan
                                          @endif
                                       </td>
                                       <td>{{formatDate($add->date)}}</td>
                                       <td>{{formatRupiah($add->value)}}</td>
                                       <td>{{$add->desc}}</td>
                                       <td><a href="">Delete</a></td>
                                    </tr>
                                 @endforeach
                                 
                                 
                                 
                              </tbody>
                           </table>
                           
                           <hr>
                           <p>
                              <a class="btn btn-light btn-sm border" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                #Info
                              </a>
                              
                            </p>
                            <div class="collapse" id="collapseExample">
                              <table>
                                 <tbody>
                                    
                                    <tr>
                                       <td><b>Desc</b> </td>
                                       <td><b>Min. Salary</b></td>
                                       <td><b>Max. Salary</b></td>
                                       <td><b>Beban Perusahaan</b></td>
                                       <td><b>Beban Karyawan</b></td>
                                    </tr>
                                    @foreach ($employee->unit->reductions as $unitRed)
                                       <tr>
                                          <td>{{$unitRed->name}}</td>
                                          <td>{{formatRupiah($unitRed->min_salary)}}</td>
                                          <td>{{formatRupiah($unitRed->max_salary)}}</td>
                                          <td>{{$unitRed->company}} %</td>
                                          <td>{{$unitRed->employee}} %</td>
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                            </div>
                           
                        </div>
            
                        <div class="tab-pane fade " id="pills-deduction-nobd" role="tabpanel" aria-labelledby="pills-deduction-tab-nobd">
                           <div class="row">
                              <div class="col">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Bisnis Unit</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('class', 'Default')->where('type', 'employee') as $red)
                                           <tr>
                                             <td>{{$red->name}}</td>
                                             {{-- <td></td> --}}
                                             <td class="text-right text-danger"><b>{{formatRupiah($red->value)}}</b></td>
                                             {{-- <td><a href="{{route('transaction.reduction.delete', enkripRambo($red->id))}}">Delete</a></td> --}}
                                           </tr>
                                           @if ($red->value_real != 0)
                                           <tr>
                                             <td class="text-right text-muted">Seharusnya</td>
                                             <td class="text-right text-muted text-danger">{{formatRupiah($red->value_real)}}</td>
                                           </tr>
                                           @endif
                                           
                                       @endforeach
                                       <tr>
                                          <td class="text-right"><b>Total</b></td>
                                          <td class="text-right"><b>{{formatRupiah($transaction->reductions->where('type', 'employee')->where('class', 'Default')->sum('employee_value'))}}</b></td>
                                       </tr>
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Additional</th>
                                          
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('class', 'Additional')->where('type', 'employee') as $red)
                                           <tr>
                                             <td>{{$red->name}}</td>
                                             {{-- <td></td> --}}
                                             <td class="text-right text-danger"><b>{{formatRupiah($red->value)}}</b></td>
                                             {{-- <td><a href="{{route('transaction.reduction.delete', enkripRambo($red->id))}}">Delete</a></td> --}}
                                           </tr>
                                           @if ($red->value_real != 0)
                                           <tr>
                                             <td class="text-right text-muted">Seharusnya</td>
                                             <td class="text-right text-muted text-danger">{{formatRupiah($red->value_real)}}</td>
                                           </tr>
                                           @endif
                                           
                                       @endforeach
                                       <tr>
                                          <td class="text-right"><b>Total</b></td>
                                          <td class="text-right"><b>{{formatRupiah($transaction->reductions->where('type', 'employee')->where('class', 'Additional')->sum('value'))}}</b></td>
                                       </tr>
                                       <tr>
                                          <td class="text-right"><b>Total Deduction</b></td>
                                          <td class="text-right"><b>{{formatRupiah($transaction->reductions->where('type', 'employee')->sum('value'))}}</b></td>
                                       </tr>

                                       <tr>
                                          <td></td>
                                          <td></td>
                                       </tr>

                                       @foreach ($transaction->reductions->where('type', 'employee') as $redu)
                                           <tr>
                                             <td>{{$redu->name}}</td>
                                             <td>{{$redu->value}}</td>
                                           </tr>
                                       @endforeach
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           
                           <hr>
                           <table class="mt-2">
                              <thead>
                                 <tr>
                                    <th colspan="5">Potongan Kehadiran</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($absences as $abs)
                                     <tr>
                                       <td>
                                          @if ($abs->type == 1)
                                             Alpha
                                             @elseif($abs->type == 2)
                                             Terlambat ({{$abs->minute}})
                                             @elseif($abs->type == 3)
                                             Cuti/Izin
                                          @endif
                                       </td>
                                       <td>{{formatDate($abs->date)}}</td>
                                       <td class="text-danger">{{formatRupiah($abs->value)}}</td>
                                    </tr>
                                 @endforeach
                                 
                                 
                                 
                              </tbody>
                           </table>
                        </div>
            
                     </div>
            
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>

@endsection