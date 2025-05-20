<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PayslipReport;
use App\Models\Unit;
use App\Models\UnitTransaction;
use Illuminate\Http\Request;
use League\Flysystem\Adapter\Local;

class PayslipReportController extends Controller
{
   public function refresh($id){
      // dd('ok');
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $unit = Unit::find($unitTransaction->unit_id);
      $locations = Location::get();


      foreach ($locations as $loc){
         if ($loc->totalEmployee($unit->id) > 0){
            $payslipReport = PayslipReport::where('unit_transaction_id', $unitTransaction->id)->where('location_id', $loc->id)->first();

            if ($payslipReport == null) {
               PayslipReport::create([
                  'unit_transaction_id' => $unitTransaction->id,
                  'location_id' => $loc->id,
                  'location_name' => $loc->name,
                  'qty' => count($loc->getUnitTransaction($unit->id, $unitTransaction)),
                  'pokok' => $loc->getValue($unit->id, $unitTransaction, 'Gaji Pokok'),
                  'jabatan' => $loc->getValue($unit->id, $unitTransaction,  'Tunj. Jabatan'),
                  'ops' => $loc->getValue($unit->id, $unitTransaction, 'Tunj. OPS'),
                  'kinerja' => $loc->getValue($unit->id, $unitTransaction, 'Tunj. Kinerja'),
                  'fungsional' => $loc->getValue($unit->id, $unitTransaction, 'Tunj. Fungsional'),
                  'total' => $loc->getValueGaji($unit->id, $unitTransaction),
   
                  'lain' => $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('additional_penambahan'),
                  'lembur' => $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime'),
   
                  'bruto' => $loc->getValueGaji($unit->id, $unitTransaction) + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime') + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('additional_penambahan'),
   
                  'bpjskt' => $loc->getReduction($unit->id, $unitTransaction, 'JHT'),
                  'bpjsks' => $loc->getReduction($unit->id, $unitTransaction, 'BPJS KS'),
                  'jp' => $loc->getReduction($unit->id, $unitTransaction, 'JP'),
                  'absen' => $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_absence'),
                  'terlambat' => $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_late'),
                  'gaji_bersih' => ($loc->getValueGaji($unit->id, $unitTransaction) + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime') + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('additional_penambahan') - ($loc->getReduction($unit->id, $unitTransaction, 'JHT') + $loc->getReduction($unit->id, $unitTransaction, 'BPJS KS') + $loc->getReductionAdditional($unit->id, $unitTransaction) + $loc->getReduction($unit->id, $unitTransaction, 'JP') + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_absence') + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_late')))
   
               ]);
            } else {
               // dd($loc->getValue($unit->id, $unitTransaction, 'Gaji Pokok'));
               $payslipReport->update([
                  
                  'qty' => count($loc->getUnitTransaction($unit->id, $unitTransaction)),
                  'pokok' => $loc->getValue($unit->id, $unitTransaction, 'Gaji Pokok'),
                  'jabatan' => $loc->getValue($unit->id, $unitTransaction,  'Tunj. Jabatan'),
                  'ops' => $loc->getValue($unit->id, $unitTransaction, 'Tunj. OPS'),
                  'kinerja' => $loc->getValue($unit->id, $unitTransaction, 'Tunj. Kinerja'),
                  'fungsional' => $loc->getValue($unit->id, $unitTransaction, 'Tunj. Fungsional'),
                  'total' => $loc->getValueGaji($unit->id, $unitTransaction),
   
                  'lain' => $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('additional_penambahan'),
                  'lembur' => $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime'),
   
                  'bruto' => $loc->getValueGaji($unit->id, $unitTransaction) + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime') + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('additional_penambahan'),
   
                  'bpjskt' => $loc->getReduction($unit->id, $unitTransaction, 'JHT'),
                  'bpjsks' => $loc->getReduction($unit->id, $unitTransaction, 'BPJS KS'),
                  'jp' => $loc->getReduction($unit->id, $unitTransaction, 'JP'),
                  'absen' => $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_absence'),
                  'terlambat' => $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_late'),
                  'gaji_bersih' => ($loc->getValueGaji($unit->id, $unitTransaction) + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime') + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('additional_penambahan') - ($loc->getReduction($unit->id, $unitTransaction, 'JHT') + $loc->getReduction($unit->id, $unitTransaction, 'BPJS KS') + $loc->getReductionAdditional($unit->id, $unitTransaction) + $loc->getReduction($unit->id, $unitTransaction, 'JP') + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_absence') + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_late')))
   
   
               ]);
            }

         }
      }

      return redirect()->back()->with('success', 'Data Report BPJS berhasil di kalibrasi ulang');
   }
}
