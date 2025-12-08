@extends('layouts.app-doc')
@section('title')
Tunjangan
@endsection
@section('content')

<style>
   html {
      -webkit-print-color-adjust: exact;
   }

   table,
   th,
   td {
      padding-top: 10px;
  padding-bottom: 10px;
      border: 1px solid black;
      border-collapse: collapse;
   }

   .ttd {
      font-size: 10px;
   }

   table td {
      /* font-size: 10px; */
      padding-top: 5px;
  padding-bottom: 5px;
      padding-left: 5px;
      padding-right: 5px;
   }



   table {
      width: 100%;
   }


   .border-none {
      border: none;
   }

   .td-sm {
      font-size: 10px;
   }
   .th-sm {
      font-size: 10px;
   }
</style>


<div class="page-body">
   <div class="container-xl">
      <div class="card card-lg">
         <div class="card-footer d-print-none">
            <small>*Disarankan merubah layout ke mode <b>landscape</b> setelah klik tombol 'Print' untuk hasil yang lebih baik.</small>
         </div>
         <div class="card-body p-0">
           
            <table style="border-bottom: none">
               <thead>
                  <tr>
                     <td colspan="3" class="border-none text-uppercase">
                        <b>PT {{$allowanceUnit->unit->name}}</b> <br>
                        <b>Rekap <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /> Tahun {{$allowanceUnit->year}} </b> <br>
                        <b>Periode : {{$allowanceUnit->month}}</b>
                     </td>
                     
                  </tr>
                  
               </thead>
               
            </table>

            @if ($allowanceUnit->type == 2)
               <table >
                  <thead>
                     
                     <tr>
                        <th class="th-sm text-center">NIK</th>
                        <th class="th-sm text-center">Nama</th>
                        <th class="th-sm text-center">Awal Kontrak</th>
                        <th class="th-sm text-center">Akhir Kontrak</th>
                        <th class="th-sm text-center">Bulan <br> Efektif</th>
                        <th class="th-sm text-center">Jabatan</th>
                        <th class="th-sm text-center">Lokasi</th>

                        <th class="th-sm text-center">Pokok</th>
                        <th class="th-sm text-center">Tunj <br> Kinerja</th>
                        <th class="th-sm text-center">Tunj <br> Fungsional</th>
                        <th class="th-sm text-center">Tunj <br> OPS</th>
                        <th class="th-sm text-center">Tunj <br> Jabatan</th>

                        <th class="th-sm text-center">Kompensasi</th>
                        
                     </tr>
                  </thead>
                  <tbody>

                     @foreach ($allowances as $allow)
                        <tr>
                           {{-- <td>
                              <a href="{{route('allowance.unit.detail', enkripRambo($allowU->id))}}"><x-status.allowance.type-unit :allowanceunit="$allowU" /></a>
                              
                           </td> --}}
                           <td class="td-sm text-center">{{$allow->employee->nik}}</td>
                           <td class="td-sm text-center">{{$allow->employee->biodata->fullName()}}</td>
                           <td class="td-sm text-center">{{formatDate($allow->contract_start)}}</td>
                           <td class="td-sm text-center">{{formatDate($allow->contract_end)}}</td>
                           <td class="td-sm text-center">{{$allow->qty_month}}</td>
                           <td class="td-sm text-center">{{$allow->position->name}}</td>
                           <td class="td-sm text-center text-uppercase">{{$allow->location->code}}</td>
                           
                           <td class="td-sm text-end">{{formatRupiahB($allow->pokok)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->tunj_kinerja)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->tunj_fungsional)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->tunj_ops)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->tunj_jabatan)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->total)}}</td>

                           
                        </tr>

                     
                     @endforeach

                     <tr>
                        <td colspan="7" class="td-sm text-end">Total</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('pokok'))}}</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('tunj_kinerja'))}}</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('tunj_fungsional'))}}</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('tunj_ops'))}}</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('tunj_jabatan'))}}</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('total'))}}</td>
                     </tr>
                     
                     
                  </tbody>
               </table>
            @endif



            {{-- Uang Duka --}}
            @if ($allowanceUnit->type == 3 || $allowanceUnit->type == 4)
            <table>
               <thead>
                  
                  <tr>
                     <th class="th-sm text-center">NIK</th>
                     <th class="th-sm text-center">Nama</th>
                     
                     <th class="th-sm text-center">Jabatan</th>
                     <th class="th-sm text-center">Lokasi</th>

                     <th class="th-sm text-center">Kompensasi</th>
                     
                  </tr>
               </thead>
               <tbody>

                  @foreach ($allowances as $allow)
                     <tr>
                        {{-- <td>
                           <a href="{{route('allowance.unit.detail', enkripRambo($allowU->id))}}"><x-status.allowance.type-unit :allowanceunit="$allowU" /></a>
                           
                        </td> --}}
                        <td class="td-sm text-center">{{$allow->employee->nik}}</td>
                        <td class="td-sm text-center">{{$allow->employee->biodata->fullName()}}</td>
                        
                        <td class="td-sm text-center">{{$allow->position->name}}</td>
                        <td class="td-sm text-center text-uppercase">{{$allow->location->code}}</td>
                        
                        
                        <td class="td-sm text-end">{{formatRupiahB($allow->total)}}</td>

                        
                       
                        
                     </tr>

                  
                  @endforeach
                  <tr>
                     <td colspan="4" class="td-sm text-end">Total</td>
                     
                     <td class="td-sm text-end">{{formatRupiahB($allowances->sum('total'))}}</td>
                  </tr>
                  
                  
               </tbody>
            </table>
            @endif


            @if ($allowanceUnit->type == 5)
            <table>
               <thead>
                  
                  <tr>
                     <th class="th-sm text-center">NIK</th>
                     <th class="th-sm text-center">Nama</th>
                     
                     <th class="th-sm text-center">Jabatan</th>
                     <th class="th-sm text-center">Lokasi</th>

                     <th class="th-sm text-center">Jenis <br> Tunjangan</th>
                     <th class="th-sm text-center">Upah</th>
                     <th class="th-sm text-center">Besar <br> Tunjangan</th>

                     <th class="th-sm text-center">Nilai <br> Tunjangan</th>
                     
                  </tr>
               </thead>
               <tbody>

                  @foreach ($allowances as $allow)
                     <tr>
                        {{-- <td>
                           <a href="{{route('allowance.unit.detail', enkripRambo($allowU->id))}}"><x-status.allowance.type-unit :allowanceunit="$allowU" /></a>
                           
                        </td> --}}
                        <td class="td-sm text-center">{{$allow->employee->nik}}</td>
                        <td class="td-sm text-center">{{$allow->employee->biodata->fullName()}}</td>
                        
                        <td class="td-sm text-center">{{$allow->position->name}}</td>
                        <td class="td-sm text-center text-uppercase">{{$allow->location->code}}</td>

                        <td class="td-sm text-center">
                           @if ($allow->child == 1)
                               Kelahiran Pertama
                               @elseif($allow->child == 2)
                               Kelahiran Kedua
                           @endif
                        </td>

                        <td class="td-sm text-end">{{formatRupiahB($allow->employee->payroll->total)}}</td>
                        <td class="td-sm text-center">{{$allow->percent}} %</td>
                        
                        
                        <td class="td-sm text-end">{{formatRupiahB($allow->total)}}</td>

                       
                       
                        
                     </tr>

                  
                  @endforeach


                  <tr>
                     <td colspan="7" class="td-sm text-end">Total</td>
                     
                     <td class="td-sm text-end">{{formatRupiahB($allowances->sum('total'))}}</td>
                  </tr>
                  
                  
               </tbody>
            </table>
                
            @endif



            @if ($allowanceUnit->type == 6)
            <table>
               <thead>
                  
                  <tr>
                     <th class="th-sm text-center">Wilayah Kerja</th>
                     <th class="th-sm text-center">Jml Pegawai</th>
                     
                     <th class="th-sm text-center">Jml Jam</th>
                     

                     <th class="th-sm text-center">Total Nilai</th>
                     
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="td-sm text-center">{{$allowanceUnit->area ?? '-'}}</td>
                     <td class="td-sm text-center">{{$allowanceUnit->qty ?? '-'}}</td>
                     <td class="td-sm text-center">{{$allowanceUnit->qty_hour ?? '-'}}</td>
                     <td class="td-sm text-end">{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>



                  <tr>
                     <td colspan="" class="td-sm text-end">Total</td>
                     <td class="td-sm text-center">{{$allowanceUnit->qty ?? '-'}}</td>
                     <td class="td-sm text-center">{{$allowanceUnit->qty_hour ?? '-'}}</td>
                     
                     <td class="td-sm text-end">{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>
                  
                  
               </tbody>
            </table>
            @endif


            <table style="border-top: none">
               <tbody>
                  <tr >
                     <td colspan="5" style="height: 50px; border-top: none"></td>
                  </tr>
                  <tr>
                     <td colspan=""  class="td-sm">Jakarta, 
                        @if ($allowanceUnit->release_date != null)
                            {{formatDate($allowanceUnit->release_date)}}
                        @endif
                        
                     </td>
                     
                  </tr>
                  <tr>
                     <td colspan="" class="td-sm">Dibuat oleh,</td>
                     {{-- <td colspan="">-</td> --}}
                     <td colspan="3" class="text-center td-sm">Diperiksa oleh</td>
                     {{-- <td colspan=""></td> --}}
                     <td colspan="1" class="text-center td-sm">Disetujui oleh</td>
                  </tr>
                  <tr>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($allowanceUnit->release_date)
                        <span class="text-info"><i>RELEASED</i></span> <br>
                        <span class="text-info">{{formatDateTime($allowanceUnit->release_date)}} </span>
                        @endif
                        
                     </td>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($allowanceUnit->approve_one_date)
                        <span class="text-info"><i>CHECKED</i></span> <br>
                        <span class="text-info">{{formatDateTime($allowanceUnit->approve_one_date)}} </span>
                        @endif
                     </td>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($allowanceUnit->approve_two_date)
                        <span class="text-info"><i>CHECKED</i></span> <br>
                        <span class="text-info">{{formatDateTime($allowanceUnit->approve_two_date)}} </span>
                        @endif
                     </td>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($allowanceUnit->approve_three_date)
                        <span class="text-info"><i>APPROVED</i></span> <br>
                        <span class="text-info">{{formatDateTime($allowanceUnit->approve_three_date)}} </span>
                        @endif
                     </td>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($allowanceUnit->approve_four_date)
                        <span class="text-info"><i>APPROVED</i></span> <br>
                        <span class="text-info">{{formatDateTime($allowanceUnit->approve_four_date)}} </span>
                        @endif
                     </td>
                  </tr>
                  <tr>
                     <td class="td-sm">
                        @if ($allowanceUnit->created_by)
                        {{$allowanceUnit->createdBy->biodata->fullName()}}
                        @endif
                        
                     </td>
                     <td class="td-sm">
                        {{-- @if ($manHrd)
                           {{$manHrd->employee->biodata->fullName()}}
                        @endif --}}
                        Saruddin Batubara
                     </td>
                     <td class="td-sm">
                              
                        Andrianto
                     </td>
                     
                     <td class="td-sm">
                        Andi Kurniawan Nasution
                        {{-- @if ($gm)
                           {{$gm->employee->biodata->fullName()}}
                        @endif --}}
                        
                     </td>
                     <td class="td-sm">
                        
                        @if ($allowanceUnit->unit->id == 2 || $allowanceUnit->unit->id == 3 || $allowanceUnit->unit->id == 6 || $allowanceUnit->unit->id == 23 || $allowanceUnit->unit->id == 24 || $allowanceUnit->unit->id == 5 || $allowanceUnit->unit->id == 22 || $allowanceUnit->unit->id == 11 || $allowanceUnit->unit->id == 12 || $allowanceUnit->unit->id == 15 || $allowanceUnit->unit->id == 19)
                        Indra Muhammad Anwar
                        @else
                        Wildan Muhammad Anwar
                        @endif
                     </td>
                     {{-- <td class="td-sm">
                        M. Isya Anwar
                     </td> --}}
                  </tr>
                  <tr>
                     <td class="td-sm">Payroll</td>
                     <td class="td-sm">HRD Manager</td>
                     <td class="td-sm">Finance Manager</td>
                     <td class="td-sm">GM Finance & Acc</td>
                     <td class="td-sm">Director</td>
                     {{-- <td class="td-sm">President Director</td> --}}
                  </tr>
               </tbody>
            </table>

            

               
              
         </div>
         
      </div>
   </div>
</div>
@endsection
@push('myjs')
<script>
   console.log('test')
   $(document).ready( function () {
      
      document.addEventListener('contextmenu', function(event) {
         event.preventDefault();
       });
   } );
   
   </script>
@endpush