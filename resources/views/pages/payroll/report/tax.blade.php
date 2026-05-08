@extends('layouts.app-doc')
@section('title')
Tax Report {{$unitTransaction->unit->name}} {{$unitTransaction->month}} {{$unitTransaction->year}}
@endsection
@section('content')

<style>
   html {
      -webkit-print-color-adjust: exact;
   }

   table,
   th,
   td {
      
      /* border: 1px solid black; */
      border: 1px solid rgb(188, 188, 188);
      border-collapse: collapse;
   }

   .ttd {
      font-size: 10px;
   }

   table td {
      font-size: 8px;
      padding-top: 5px;
  padding-bottom: 5px;
      padding-left: 5px;
      padding-right: 5px;
   }

   table th{
      background-color: rgb(11, 155, 11);
      color: white;
   }



   table {
      width: 100%;
   }


   .border-none {
      border: none;
   }

   table td {
      font-size: 7px;
   } table th {
      font-size: 7px;
   }
</style>


<div class="page-body px-2">
   {{-- <div class="container-xl"> --}}
      <div class="card card-lg">
         <div class="card-footer d-print-none">
            <small>*Disarankan merubah layout ke mode <b>landscape</b> setelah klik tombol 'Print' untuk hasil yang lebih baik.</small>
         </div>
         <div class="card-body p-0">
            {{-- <div class="table-responsive"> --}}
               
               <table style="border-top: none">
                  <tbody>
                     
                     
                     
                     {{-- <tr>
                        <th class="px-1 py-1" style="font-size: 10px">Tahun</th>
                        <th colspan="17" class="px-1 py-1" style="font-size: 10px">{{$unitTransaction->year}}</th>
                     </tr> --}}
                     
                  </tbody>
                  
               </table>

               <table id="data" class="display  table-sm" style="border-top: none">
                  <thead >
                     <tr>
                        <td class=""></td>
                        <td colspan="29" class="" style=""><b>PT {{$unitTransaction->unit->name}}</b></td>
                     </tr>
                      <tr>
                        <td class=""></td>
                        <td colspan="29" class="" style=""><b>List Daftar Karyawan</b></td>
                     </tr>
                    
                    

                     
                     <tr>
                        <td class="" style=""></td>
                        <td colspan="29" class="" style="">Bulan : {{$unitTransaction->month}} {{$unitTransaction->year}}</td>
                     </tr>
                     
                     <tr>
                        <th style="" class="n">NIK</th>
                        <th style="" class="bg">Nama</th>
                        <th style="" class="">NIK KTP</th>
                        <th style="" class="">NIK Kartu Keluarga</th>
                        <th style="" class="text-center ">NPWP</th>
                        <th style="" class="text-center ">Tgl mulai NPWP</th>
                        <th style="" class="text-center ">Lokasi</th>
                        <th style="" class="text-center ">Mulai Kerja</th>
                        <th style="" class="text-center ">Akhir Kerja</th>
                        <th style="" class="text-center ">L/P</th>
                         <th style="" class="text-center ">Status</th>
                        <th style="" class="text-center ">WNI/ <br>WNA</th>
                        <th style="" class="text-center ">Jabatan</th>
                        <th style="" class="text-center ">Alamat</th>
                        <th style="" class="text-center ">Gaji Pokok</th>
                        <th style="" class="text-center ">Tunjangan</th>
                        <th style="" class="text-center ">Lembur</th>
                        <th style="" class="text-center ">Lain-lain</th>
                         <th style="" class="text-center ">BPJS TK</th>
                         
                        <th style="" class="text-center ">JP</th>
                        <th style="" class="text-center ">BPJS KS</th>
                        <th style="" class="text-center ">Absen</th>
                        
                        <th style="" class="text-center ">Terlambat</th>
                        <th style="" class="text-center ">Lain-lain</th>
                        {{-- <th style="" class="text-center ">Total</th>  --}}

                        <th style="" class="text-center ">Kompen <br> sasi</th>
                        <th style="" class="text-center ">Tunj. Hari Raya</th>
                        <th style="" class="text-center ">Pesangon /Uang</th>
                        <th style="" class="text-center ">Perdin</th>
                        <th style="" class="text-center ">Uang Duka/ Tunj. Kelahiran/ Tunj.</th>
                        <th style="" class="text-center ">Bonus</th>
                        
                     </tr>
                  </thead>
   
                  <tbody>
                     @php
                        $totalPokok = 0;
                        $totalJabatan = 0;
                        $totalOps = 0;
                        $totalKinerja = 0;
                        $totalFungsional = 0;
                        $totalGaji = 0;
                        $totalOvertime = 0;
                        $totalAdditionalPenambahan = 0;
                        $totalBruto = 0;
                        $totalTk = 0;
                        $totalKs = 0;
                        $totalJp = 0;
                        $totalAbsence = 0;
                        $totalLate = 0;
                        $totalAdditionalPengurangan = 0;
                        $totalGrand = 0;
                     @endphp
   
                     @foreach ($unitTransaction->transactions as $transaction)
                     
                        <tr>
                           <td class="text-truncate">{{$transaction->employee->nik}} </td>
                           <td class="text-truncate" style="max-width: 150px" >{{$transaction->employee->biodata->fullName()}}</td>
                           <td class="text-truncate" >{{$transaction->employee->biodata->no_ktp}}</td>
                           <td class="text-truncate" >{{$transaction->employee->biodata->no_kk}}</td>
                           <td class="text-truncate" >{{$transaction->employee->biodata->no_npwp}}</td>
                           <td class="text-truncate" >-</td>
                           <td class="text-truncate" >{{$transaction->employee->contract->loc}}</td>
                           <td class="text-truncate" >{{formatDate($transaction->employee->join)}}</td>
                            <td class="text-truncate" >-</td>
                             <td class="text-truncate" >{{$transaction->employee->biodata->gender}}</td>
                             <td class="text-truncate" >{{$transaction->employee->biodata->marital}}</td>
                             <td class="text-truncate" >{{$transaction->employee->biodata->citizenship}}</td>
                           <td class="text-truncate">{{$transaction->employee->contract->position->name ?? ''}}</td>
                           <td class="">{{$transaction->employee->biodata->address ?? ''}}</td>
                            <td class="text-right">{{formatRupiahB($transaction->employee->payroll->pokok)}}</td>
                           <td class="text-right">{{formatRupiahB($transaction->employee->payroll->tunj_jabatan + $transaction->employee->payroll->tunj_ops + $transaction->employee->payroll->tunj_kinerja + $transaction->employee->payroll->tunj_fungsional)}}</td>
                           <td class="text-right">{{formatRupiahB($transaction->overtime)}}</td>
                           <td class="text-right">{{formatRupiahB($transaction->additional_penambahan)}}</td>
                           <td class="text-right">
                              
                              {{formatRupiahB($transaction->getDeduction('JHT', 'employee'))}}
                           </td>
                           <td class="text-right">{{formatRupiahB($transaction->getDeduction('JP', 'employee'))}} </td>
                           <td class="text-right">{{formatRupiahB($transaction->getDeduction('BPJS KS', 'employee') + $transaction->getAddDeductionA( 'employee'))}}
                              
                           </td>
                           <td class="text-right">{{formatRupiahB($transaction->reduction_absence + $transaction->reduction_off)}}</td>
                           <td class="text-right">{{formatRupiahB($transaction->reduction_late)}}</td>
                           <td class="text-right">{{formatRupiahB($transaction->additional_pengurangan)}}</td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           {{--<td class="text-right">{{formatRupiahB($transaction->employee->payroll->tunj_ops)}}</td>
                           <td class="text-right">{{formatRupiahB($transaction->employee->payroll->tunj_kinerja)}}</td>
                           <td class="text-right">{{formatRupiahB($transaction->employee->payroll->tunj_fungsional)}}</td>
                           <td class="text-right">{{formatRupiahB($transaction->employee->payroll->total)}}</td>
                           
                           
                           <td class="text-right">{{formatRupiahB($transaction->employee->payroll->total + $transaction->overtime + $transaction->additional_penambahan)}}</td> --}}
                        
                           {{-- 
                           
                           
                           
                           
                           <td class="text-right">{{formatRupiahB($transaction->total)}}</td> --}}
                        
                        </tr>
   
                        @php
                           $pokok =  $transaction->employee->payroll->pokok;
                           $jabatan = $transaction->employee->payroll->tunj_jabatan;
                           $ops = $transaction->employee->payroll->tunj_ops;
                           $kinerja = $transaction->employee->payroll->tunj_kinerja;
                           $fungsional = $transaction->employee->payroll->tunj_fungsional;
                           $gaji = $transaction->employee->payroll->total;
                           $overtime = $transaction->overtime;
                           $additional_penambahan = $transaction->additional_penambahan;
                           $bruto = $transaction->employee->payroll->total + $transaction->overtime + $transaction->additional_penambahan;
                           // $tk = 2/100 * $transaction->employee->payroll->total;
                           $tk = $transaction->getDeduction('JHT', 'employee');
                           $ks = $transaction->getDeduction('BPJS KS', 'employee') + $transaction->getAddDeductionA( 'employee');
                           $ksAdd = $transaction->getDeductionAdditional();
                           $jp = $transaction->getDeduction('JP', 'employee');
                           $abs = $transaction->reduction_absence;
                           $late = $transaction->reduction_late;
                           $additional_pengurangan = $transaction->additional_pengurangan;
                           $total = $transaction->total;
   
                           $totalPokok += $pokok;
                           $totalJabatan += $jabatan;
                           $totalOps += $ops;
                           $totalKinerja += $kinerja;
                           $totalFungsional += $fungsional;
                           $totalGaji += $gaji;
                           $totalOvertime += $transaction->overtime;
                           $totalAdditionalPenambahan  += $additional_penambahan;
                           
                           $totalBruto += $bruto;
                           $totalTk += $tk;
                           $totalKs += $ks;
                           $totalKsAdd = $ksAdd;
                           $totalJp += $jp;
                           $totalAbsence += $abs;
                           $totalLate += $late;
                           $totalAdditionalPengurangan  += $additional_pengurangan;
                           $totalGrand += $total;
                        @endphp
                    
                        
                     @endforeach
                     
                     
                     {{-- <tr>
                        <td colspan="3" class="text-end"><b> Total</b></td>
                        <td class="text-right text-truncate"><b> {{formatRupiahB($totalPokok)}}</b></b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalJabatan)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalOps)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalKinerja)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalFungsional)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalGaji)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalOvertime)}} </b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalAdditionalPenambahan)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalBruto)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalTk)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalKs)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalJp)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalAbsence)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalLate)}}</b></td>
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalAdditionalPengurangan)}}</b></td>
                        
                        <td class="text-right text-truncate"><b>{{formatRupiahB($totalGrand)}}</b></td>
                     </tr> --}}
                     
                     
                     
                  </tbody>
               </table>

               {{-- <table>
                  <tbody>
                     <tr>
                        <td colspan="">Jakarta, 
                           @if ($hrd)
                               {{formatDateB($hrd->created_at)}} 
                           @endif
                           
                        </td>
                     </tr>
                     <tr>
                        <td colspan="" >
                           Dibuat oleh,
                           
                        </td>
                        <td colspan="">-</td>
                        <td colspan="">Diperiksa oleh</td>
                        <td colspan=""></td>
                        <td colspan="">Disetujui oleh</td>
                     </tr>
                     <tr>
                        <td colspan="" style="height: 80px" class="text-center">
                           @if ($hrd)
                           
                           <h3 ><i>Approved</i></h3>
                           @endif
                        </td>
                        <td colspan="" style="height: 80px" class="text-center">
                           @if ($manHrd)
                           <h3 ><i>Approved</i></h3>
                          
                           @endif
                        </td>
                        <td colspan="" style="height: 80px" class="text-center">
                           @if ($manFin)
                           <h3 ><i>Approved</i></h3>
                          
                           @endif
                        </td>
                        <td colspan="" style="height: 80px" class="text-center">
                           @if ($gm)
                           <h3 ><i>Approved</i></h3>
                          
                           @endif
                        </td>
                        <td colspan="" style="height: 80px" class="text-center">
                           @if ($bod)
                           <h3 ><i>Approved</i></h3>
                           
                           @endif
                        </td>
                     </tr>
                     <tr>
                        <td colspan="">
                           @if ($hrd)
                              {{$hrd->employee->biodata->fullName()}}
                           @endif
                           
                        </td>
                        <td>
                           Saruddin Batubara
                           
                        </td>
                        <td>
                           Andrianto
                          
                        </td>
                        <td>
                           Andi Kurniawan Nasution
                           
                           
                        </td>
                        <td>
                           @if ($unit->id == 2 || $unit->id == 3 || $unit->id == 6 || $unit->id == 23 || $unit->id == 24 || $unit->id == 5 || $unit->id == 22 || $unit->id == 11 || $unit->id == 12 || $unit->id == 15 || $unit->id == 19)
                           Indra Muhammad Anwar
                           @else
                           Wildan Muhammad Anwar
                           @endif
                           
                        </td>
                     </tr>
                     <tr>
                        <td>
                           @if ($hrd)
                           HRD Payroll 
                           {{formatDateTime($hrd->created_at)}} 
                           @endif
                           
                        </td>
                        <td>HRD Manager 
                           @if ($manHrd)
                          
                           {{formatDateTime($manHrd->created_at)}} 
                           @endif
                        </td>
                        <td>Manager Finance
                           @if ($manFin)
                           
                           {{formatDateTime($manFin->created_at)}} 
                           @endif
                        </td>
                        <td>GM Finance & Acc
                           @if ($gm)
                          
                           {{formatDateTime($gm->created_at)}} 
                           @endif
                        </td>
                        <td>Direktur
                           @if ($bod)
                           
                           {{formatDateTime($bod->created_at)}} 
                           @endif
                        </td>
                     </tr>
                  </tbody>
               </table> --}}
            
         </div>
         
      </div>
   {{-- </div> --}}
</div>
@endsection