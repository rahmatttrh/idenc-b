@extends('layouts.app-doc')
@section('title')
<x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /> {{$allowanceUnit->unit->name}} {{$allowanceUnit->month}} {{$allowanceUnit->year}}
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
      border: 1px solid rgb(209, 206, 206);
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
   <div class="p-2">
      <div class="card card-lg">
         <div class="card-footer d-print-none">
            <small>*Disarankan merubah layout ke mode <b>landscape</b> setelah klik tombol 'Print' untuk hasil yang lebih baik.</small>
         </div>
         <div class="card-body p-0 pb-3">
           
            <table style="border-bottom: none">
               <thead>
                  <tr>
                     <td colspan="3" class="border-none text-uppercase">
                        <b>PT {{$allowanceUnit->unit->name}}</b> <br>
                        <b>Rekap <x-status.allowance.type-unit :allowanceunit="$allowanceUnit" /> Tahun {{$allowanceUnit->year}} </b> <br>
                        
                     </td>
                     
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
                  <tr>
                     <td class="border-none text-uppercase">Periode : {{$allowanceUnit->month}} {{$allowanceUnit->year}}</td>
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
                        <th class="th-sm text-center">Bulan Efektif</th>
                        <th class="th-sm text-center">Jabatan</th>
                        <th class="th-sm text-center">Lokasi</th>

                        <th class="th-sm text-center">Gaji Pokok</th>
                        <th class="th-sm text-center">Tunj Jabatan</th>
                        
                        
                        <th class="th-sm text-center">Tunj OPS</th>
                        <th class="th-sm text-center">Tunj Kinerja</th>
                        <th class="th-sm text-center">Tunj Fungsional</th>
                        <th class="th-sm text-center">Gaji Bruto</th>
                        

                        <th class="th-sm text-center">Kompensasi</th>
                        
                     </tr>
                  </thead>
                  <tbody>

                     @foreach ($allowances as $allow)
                        <tr>
                           {{-- <td>
                              <a href="{{route('allowance.unit.detail', enkripRambo($allowU->id))}}"><x-status.allowance.type-unit :allowanceunit="$allowU" /></a>
                              
                           </td> --}}
                           <td class="td-sm ">{{$allow->employee->nik}}</td>
                           <td class="td-sm ">{{$allow->employee->biodata->fullName()}}</td>
                           <td class="td-sm text-center">{{formatDate($allow->contract_start)}}</td>
                           <td class="td-sm text-center">{{formatDate($allow->contract_end)}}</td>
                           <td class="td-sm text-center">{{$allow->qty_month}}</td>
                           <td class="td-sm ">{{$allow->position->name}}</td>
                           <td class="td-sm  text-uppercase">{{$allow->location->code}}</td>
                           
                           <td class="td-sm text-end">{{formatRupiahB($allow->pokok)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->tunj_jabatan)}}</td>
                           
                           
                           <td class="td-sm text-end">{{formatRupiahB($allow->tunj_ops)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->tunj_kinerja)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->tunj_fungsional)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->total)}}</td>
                           <td class="td-sm text-end">{{formatRupiahB($allow->total)}}</td>

                           
                        </tr>

                     
                     @endforeach

                     <tr>
                        <td colspan="7" class="td-sm text-end">Total</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('pokok'))}}</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('tunj_jabatan'))}}</td>
                        
                        
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('tunj_ops'))}}</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('tunj_kinerja'))}}</td>
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('tunj_fungsional'))}}</td>
                        
                        <td class="td-sm text-end">{{formatRupiahB($allowances->sum('total'))}}</td>
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
            {{-- <table>
               <thead>
                  
                  <tr>
                     <th class="th-sm text-center">Wilayah Kerja</th>
                     <th class="th-sm text-center">Jml Pegawai</th>
                     
                     <th class="th-sm text-center">Qty</th>
                     
                    <th class="th-sm text-center">Nilai</th>
                     <th class="th-sm text-center">Total Nilai</th>
                     
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="td-sm text-center">{{$allowanceUnit->area ?? '-'}}</td>
                     <td class="td-sm text-center">{{$allowanceUnit->qty ?? '-'}}</td>
                     <td class="td-sm text-center">{{$allowanceUnit->qty_hour ?? '-'}}</td>
                     <td class="td-sm text-end">{{formatRupiahB($allowanceUnit->value)}}</td>
                     <td class="td-sm text-end">{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>



                  <tr>
                     <td colspan="" class="td-sm text-end">Total</td>
                     <td class="td-sm text-center">{{$allowanceUnit->qty ?? '-'}}</td>
                     <td class="td-sm text-center">{{$allowanceUnit->qty_hour ?? '-'}}</td>
                     <td class="td-sm text-end">{{formatRupiahB($allowanceUnit->value)}}</td>
                     <td class="td-sm text-end">{{formatRupiahB($allowanceUnit->total)}}</td>
                  </tr>
                  
                  
               </tbody>
            </table> --}}
            <table>
                     <thead>
                        <tr>
                           <td>NIK</td>
                           <td>Nama</td>
                           <td class="text-center">Qty</td>
                           <td class="text-center">Nilai</td>
                           <td class="text-center">Total</td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($allowances as $allow)
                            <tr>
                           <td>{{$allow->nik}}</td>
                           <td>{{$allow->name}}</td>
                           <td class="text-center">{{$allow->qty}}</td>
                           <td class="text-end">{{formatRupiahB($allow->bruto)}}</td>
                           <td class="text-end">{{formatRupiahB($allow->total)}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-end">Total</td>
                            <td class="text-center">{{$allowanceUnit->qty}}</td>
                            <td class="text-end">{{formatRupiahB($allowanceUnit->value)}}</td>
                            <td class="text-end">{{formatRupiahB($allowanceUnit->total)}}</td>
                        </tr>
                     </tbody>
                  </table>
            @endif
            @if ($allowanceUnit->type == 7)
                  
                  <table>
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
                           <th class="th-sm text-center">Bruto</th>
                           <th class="th-sm text-center">Nilai</th>
                           
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($allowances as $allow)
                           <tr>
                              
                              <td class="td-sm ">{{$allow->employee->nik}}</td>
                              <td class="td-sm ">{{$allow->employee->biodata->fullName()}}</td>
                              <td class="td-sm text-center">{{formatDate($allow->contract_start)}}</td>
                              <td class="td-sm text-center">{{formatDate($allow->contract_end)}}</td>
                              <td class="td-sm text-center">
                                 @if ($allow->qty_join < 12)
                                     {{ $allow->qty_join }}
                                     @else
                                     12
                                 @endif
                              </td>
                              <td class="td-sm ">{{$allow->position->name}}</td>
                              <td class="td-sm text-center">{{$allow->location->code}}</td>
                              
                              <td class="td-sm text-end">{{formatRupiahB($allow->pokok)}}</td>
                              <td class="td-sm text-end">{{formatRupiahB($allow->tunj_kinerja)}}</td>
                              <td class="td-sm text-end">{{formatRupiahB($allow->tunj_fungsional)}}</td>
                              <td class="td-sm text-end">{{formatRupiahB($allow->tunj_ops)}}</td>
                              <td class="td-sm text-end">{{formatRupiahB($allow->tunj_jabatan)}}</td>
                              <td class="td-sm text-end">{{formatRupiahB($allow->pokok + $allow->tunj_kinerja + $allow->tunj_fungsional + $allow->tunj_ops + $allow->tunj_jabatan)}}</td>
                              
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
                           <td class="td-sm text-end">{{formatRupiahB($allowances->sum('pokok') + $allowances->sum('tunj_kinerja') + $allowances->sum('tunj_fungsional') + $allowances->sum('tunj_ops') + $allowances->sum('tunj_jabatan'))}}</td>
                           
                           <td class="td-sm text-end">{{formatRupiahB($allowances->sum('total'))}}</td>
                        </tr>
                        
                        
                     </tbody>
                  </table>
            @endif

            


            @if ($allowanceUnit->type == 2 || $allowanceUnit->type == 5 || $allowanceUnit->type == 3)
            @else

            
            @endif

            

               
              
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