<?php

namespace App\Http\Controllers;

use App\Models\BpjsKtReport;
use App\Models\Location;
use App\Models\PayrollApproval;
use App\Models\PayslipBpjsKs;
use App\Models\PayslipBpjsKt;
use App\Models\ReductionEmployee;
use App\Models\Unit;
use App\Models\Transaction;
use App\Models\TransactionReduction;
use App\Models\UnitTransaction;
use Illuminate\Http\Request;

class PayslipBpjsKtController extends Controller
{
   public function reportBpjsKt($id)
   {
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $unit = Unit::find($unitTransaction->unit_id);
      $locations = Location::get();

      $bpjsKtReports = BpjsKtReport::where('unit_transaction_id', $unitTransaction->id)->get();
      // $reportBpjsKt = PayslipBpjsKt::where('unit_transaction_id', $unitTransaction->id)->get();

      // $reportBpjsKs = PayslipBpjsKs::where('unit_transaction_id', $unitTransaction->id)->first();
      $reportBpjsKt = PayslipBpjsKt::where('unit_transaction_id', $unitTransaction->id)->first();
      if ($reportBpjsKt->iuran_total == null) {
         $reportBpjsKt->update([
            'iuran_total' => $bpjsKtReports->sum('total_iuran')
         ]);
      }

      $bpjsKtReport = BpjsKtReport::where('unit_transaction_id', $unitTransaction->id)->first();
      if ($bpjsKtReport == null) {
         foreach ($locations as $loc) {
            if ($loc->totalEmployee($unitTransaction->unit->id) > 0 || $loc->projectExist() == true) {
               BpjsKtReport::create([
                  'unit_transaction_id' => $unitTransaction->id,
                  'location_id' => $loc->id,
                  'location_name' => $loc->name,
                  'program' => 'Jaminan Kecelakaan Kerja (JKK)',
                  'tarif' => $unitTransaction->unit->reductions->where('name', 'JKK')->first()->company + $unitTransaction->unit->reductions->where('name', 'JKK')->first()->employee,
                  'qty' => count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)),
                  'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKK'),
                  'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JKK', 'company'),
                  'karyawan' => $loc->getDeduction($unitTransaction, 'JKK', 'employee'),
                  'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JKK', 'company') + $loc->getDeduction($unitTransaction, 'JKK', 'employee'),
               ]);
               BpjsKtReport::create([
                  'unit_transaction_id' => $unitTransaction->id,
                  'location_id' => $loc->id,
                  'location_name' => $loc->name,
                  'program' => 'Jaminan Hari Tua (JHT)',
                  'tarif' => $unitTransaction->unit->reductions->where('name', 'JHT')->first()->company + $unitTransaction->unit->reductions->where('name', 'JHT')->first()->employee,
                  'qty' => count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)),
                  'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JHT'),
                  'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JHT', 'company'),
                  'karyawan' => $loc->getDeduction($unitTransaction, 'JHT', 'employee'),
                  'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JHT', 'company') + $loc->getDeduction($unitTransaction, 'JHT', 'employee'),
               ]);
               BpjsKtReport::create([
                  'unit_transaction_id' => $unitTransaction->id,
                  'location_id' => $loc->id,
                  'location_name' => $loc->name,
                  'program' => 'Jaminan Kematian (JKM)',
                  'tarif' => $unitTransaction->unit->reductions->where('name', 'JKM')->first()->company + $unitTransaction->unit->reductions->where('name', 'JKM')->first()->employee,
                  'qty' => count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)),
                  'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKM'),
                  'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JKM', 'company'),
                  'karyawan' => $loc->getDeduction($unitTransaction, 'JKM', 'employee'),
                  'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JKM', 'company') + $loc->getDeduction($unitTransaction, 'JKM', 'employee'),
               ]);
               BpjsKtReport::create([
                  'unit_transaction_id' => $unitTransaction->id,
                  'location_id' => $loc->id,
                  'location_name' => $loc->name,
                  'program' => 'Jaminan Pensiun',
                  'tarif' => $unitTransaction->unit->reductions->where('name', 'JP')->first()->company + $unitTransaction->unit->reductions->where('name', 'JP')->first()->employee,
                  'qty' => count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)),
                  'upah' => $loc->getUnitTransactionKt($unitTransaction->unit_id, $unitTransaction, 'JP'),
                  'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JP', 'company'),
                  'karyawan' => $loc->getDeduction($unitTransaction, 'JP', 'employee'),
                  'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JP', 'company') + $loc->getDeduction($unitTransaction, 'JP', 'employee'),
               ]);
            }
         }

         return redirect()->back()->with('success', 'BPJS TK Report successfully generated, click "BPJS TK Report" to see the report');
      }


      if (auth()->user()->hasRole('Administrator')) {
         // $reportBpjsKt->update([
         //    'payslip_total' => 25200000
         // ]);
         // dd($reportBpjsKt);
      }
      $hrd = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'hrd')->first();
      $manHrd = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-hrd')->first();
      $manFin = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-fin')->first();
      $gm = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'gm')->first();
      $bod = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'bod')->first();

      $lastUnitTransaction = UnitTransaction::where('unit_id', $unitTransaction->unit_id)->orderBy('cut_from', 'desc')->where('cut_from', '<', $unitTransaction->cut_from)->first();
      if ($lastUnitTransaction) {
         $lastReportBpjsKt = PayslipBpjsKt::where('unit_transaction_id', $lastUnitTransaction->id)->first();
      } else {
         $lastReportBpjsKt = null;
      }

      $newTransactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->where('remark', 'Karyawan Baru')->get();
      $outTransactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->where('remark', 'Karyawan Out')->get();

      if (auth()->user()->hasRole('Administrator')) {
         $reductionEmployees = ReductionEmployee::where('employee_id', 419)->get();
         // dd($reductionEmployees);

         // $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();
         // $data = [];
         // foreach($transactions as $trans){
         //    $transReduction = TransactionReduction::where('transaction_id', $trans->id)->where('name', 'JHT')->where('type', 'company')->first();
         //    $test = [$trans->employee->nik, $transReduction->value_real];
         //    $data[] = $test;

         // }

         // dd($data);
         // if ($trans->employee_id == 360) {
         //    $red =ReductionEmployee::where('employee_id', 360)->get();
         //    // dd($red);
         //    $transReduction = TransactionReduction::where('transaction_id', $trans->id)->get();
         //    dd($transReduction);
         // }

      }

      return view('pages.payroll.report.bpjskt', [
         'unit' => $unit,
         'reportBpjsKt' => $reportBpjsKt,
         'lastReportBpjsKt' => $lastReportBpjsKt,
         'newTransactions' => $newTransactions,
         'outTransactions' => $outTransactions,
         'bpjsKtReports' => $bpjsKtReports,
         'unitTransaction' => $unitTransaction,
         'locations' => $locations,
         'hrd' => $hrd,
         'manHrd' => $manHrd,
         'manFin' => $manFin,
         'gm' => $gm,
         'bod' => $bod,
      ]);
   }

   public function refresh($id)
   {
      // dd('oke');
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->totalEmployeeBpjs($unitTransaction->unit->id) > 0) {
            $bpjsKtReports = BpjsKtReport::where('unit_transaction_id', $unitTransaction->id)->where('location_id', $loc->id)->get();
            foreach ($bpjsKtReports as $kt) {
               $kt->delete();
            }
            $upah = $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKK');
            $persenKaryawan = $unitTransaction->unit->reductions->where('name', 'JKK')->first()->employee;
            $persenCompany = $unitTransaction->unit->reductions->where('name', 'JKK')->first()->company;
            $iuranKaryawan = $persenKaryawan  / 100 * $upah;
            $iuranCompany = $persenCompany  / 100 * $upah;
            BpjsKtReport::create([
               'unit_transaction_id' => $unitTransaction->id,
               'location_id' => $loc->id,
               'location_name' => $loc->name,
               'program' => 'Jaminan Kecelakaan Kerja (JKK)',
               'tarif' => $unitTransaction->unit->reductions->where('name', 'JKK')->first()->company + $unitTransaction->unit->reductions->where('name', 'JKK')->first()->employee,
               // 'qty' => count($loc->getUnitTransactionB($unitTransaction->unit_id, $unitTransaction)),
               'qty' => $loc->getUnitTransactionQtyProgram($unitTransaction->unit_id, $unitTransaction, 'JKK'),
               // 'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKK'),
               'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKK'),
               'perusahaan' => $iuranCompany,
               'karyawan' => $iuranKaryawan,
               'total_iuran' => $iuranKaryawan + $iuranCompany,
            ]);

            $upahJht = $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JHT');
            $persenKaryawanJht = $unitTransaction->unit->reductions->where('name', 'JHT')->first()->employee;
            $persenCompanyJht = $unitTransaction->unit->reductions->where('name', 'JHT')->first()->company;
            $iuranKaryawanJht = $persenKaryawanJht  / 100 * $upahJht;
            $iuranCompanyJht = $persenCompanyJht  / 100 * $upahJht;
            BpjsKtReport::create([
               'unit_transaction_id' => $unitTransaction->id,
               'location_id' => $loc->id,
               'location_name' => $loc->name,
               'program' => 'Jaminan Hari Tua (JHT)',
               'tarif' => $unitTransaction->unit->reductions->where('name', 'JHT')->first()->company + $unitTransaction->unit->reductions->where('name', 'JHT')->first()->employee,
               // 'qty' => count($loc->getUnitTransactionB($unitTransaction->unit_id, $unitTransaction)),
               'qty' => $loc->getUnitTransactionQtyProgram($unitTransaction->unit_id, $unitTransaction, 'JHT'),
               // 'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JHT'),
               'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JHT'),
               // 'perusahaan' => $iuranCompanyJht,
               // 'karyawan' => $iuranKaryawanJht,
               // 'total_iuran' => $iuranCompanyJht + $iuranKaryawanJht,
               'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JHT', 'company'),
               'karyawan' => $loc->getDeduction($unitTransaction, 'JHT', 'employee'),
               'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JHT', 'company') + $loc->getDeduction($unitTransaction, 'JHT', 'employee'),
            ]);


            $upahJkm = $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKM');
            $persenKaryawanJkm = $unitTransaction->unit->reductions->where('name', 'JKM')->first()->employee;
            $persenCompanyJkm = $unitTransaction->unit->reductions->where('name', 'JKM')->first()->company;
            $iuranKaryawanJkm = $persenKaryawanJkm  / 100 * $upahJkm;
            $iuranCompanyJkm = $persenCompanyJkm  / 100 * $upahJkm;
            BpjsKtReport::create([
               'unit_transaction_id' => $unitTransaction->id,
               'location_id' => $loc->id,
               'location_name' => $loc->name,
               'program' => 'Jaminan Kematian (JKM)',
               'tarif' => $unitTransaction->unit->reductions->where('name', 'JKM')->first()->company + $unitTransaction->unit->reductions->where('name', 'JKM')->first()->employee,
               // 'qty' => count($loc->getUnitTransactionB($unitTransaction->unit_id, $unitTransaction)),
               'qty' => $loc->getUnitTransactionQtyProgram($unitTransaction->unit_id, $unitTransaction, 'JKM'),
               // 'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKM'),
               'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKM'),
               'perusahaan' => $iuranCompanyJkm,
               'karyawan' => $iuranKaryawanJkm,
               'total_iuran' => $iuranCompanyJkm + $iuranKaryawanJkm,
            ]);


            $upahJp = $loc->getUnitTransactionKt($unitTransaction->unit_id, $unitTransaction, 'JP');
            $persenKaryawanJp = $unitTransaction->unit->reductions->where('name', 'JP')->first()->employee;
            $persenCompanyJp = $unitTransaction->unit->reductions->where('name', 'JP')->first()->company;
            $iuranKaryawanJp = $persenKaryawanJp  / 100 * $upahJp;
            $iuranCompanyJp = $persenCompanyJp  / 100 * $upahJp;
            BpjsKtReport::create([
               'unit_transaction_id' => $unitTransaction->id,
               'location_id' => $loc->id,
               'location_name' => $loc->name,
               'program' => 'Jaminan Pensiun',
               'tarif' => $unitTransaction->unit->reductions->where('name', 'JP')->first()->company + $unitTransaction->unit->reductions->where('name', 'JP')->first()->employee,
               // 'qty' => count($loc->getUnitTransactionB($unitTransaction->unit_id, $unitTransaction)),
               'qty' => $loc->getUnitTransactionQtyProgram($unitTransaction->unit_id, $unitTransaction, 'JP'),
               'upah' => $loc->getUnitTransactionKt($unitTransaction->unit_id, $unitTransaction, 'JP'),
               // 'perusahaan' => $iuranCompanyJp,
               // 'karyawan' => $iuranKaryawanJp,
               // 'total_iuran' => $iuranCompanyJp + $iuranKaryawanJp,
               'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JP', 'company'),
               'karyawan' => $loc->getDeduction($unitTransaction, 'JP', 'employee'),
               'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JP', 'company') + $loc->getDeduction($unitTransaction, 'JP', 'employee'),
            ]);
         }
      }

      return redirect()->back()->with('success', 'BPJS TK Report successfully generated, click "BPJS TK Report" to see the report');
   }

   public function refreshOld($id)
   {
      // dd('oke');
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->totalEmployeeBpjs($unitTransaction->unit->id) > 0) {
            $bpjsKtReports = BpjsKtReport::where('unit_transaction_id', $unitTransaction->id)->where('location_id', $loc->id)->get();
            foreach ($bpjsKtReports as $kt) {
               $kt->delete();
            }
            BpjsKtReport::create([
               'unit_transaction_id' => $unitTransaction->id,
               'location_id' => $loc->id,
               'location_name' => $loc->name,
               'program' => 'Jaminan Kecelakaan Kerja (JKK)',
               'tarif' => $unitTransaction->unit->reductions->where('name', 'JKK')->first()->company + $unitTransaction->unit->reductions->where('name', 'JKK')->first()->employee,
               'qty' => count($loc->getUnitTransactionB($unitTransaction->unit_id, $unitTransaction)),
               // 'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKK'),
               'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKK'),
               'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JKK', 'company'),
               'karyawan' => $loc->getDeduction($unitTransaction, 'JKK', 'employee'),
               'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JKK', 'company') + $loc->getDeduction($unitTransaction, 'JKK', 'employee'),
            ]);
            BpjsKtReport::create([
               'unit_transaction_id' => $unitTransaction->id,
               'location_id' => $loc->id,
               'location_name' => $loc->name,
               'program' => 'Jaminan Hari Tua (JHT)',
               'tarif' => $unitTransaction->unit->reductions->where('name', 'JHT')->first()->company + $unitTransaction->unit->reductions->where('name', 'JHT')->first()->employee,
               'qty' => count($loc->getUnitTransactionB($unitTransaction->unit_id, $unitTransaction)),
               // 'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JHT'),
               'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JHT'),
               'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JHT', 'company'),
               'karyawan' => $loc->getDeduction($unitTransaction, 'JHT', 'employee'),
               'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JHT', 'company') + $loc->getDeduction($unitTransaction, 'JHT', 'employee'),
            ]);
            BpjsKtReport::create([
               'unit_transaction_id' => $unitTransaction->id,
               'location_id' => $loc->id,
               'location_name' => $loc->name,
               'program' => 'Jaminan Kematian (JKM)',
               'tarif' => $unitTransaction->unit->reductions->where('name', 'JKM')->first()->company + $unitTransaction->unit->reductions->where('name', 'JKM')->first()->employee,
               'qty' => count($loc->getUnitTransactionB($unitTransaction->unit_id, $unitTransaction)),
               // 'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKM'),
               'upah' => $loc->getUnitTransactionKtB($unitTransaction->unit_id, $unitTransaction, 'JKM'),
               'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JKM', 'company'),
               'karyawan' => $loc->getDeduction($unitTransaction, 'JKM', 'employee'),
               'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JKM', 'company') + $loc->getDeduction($unitTransaction, 'JKM', 'employee'),
            ]);
            BpjsKtReport::create([
               'unit_transaction_id' => $unitTransaction->id,
               'location_id' => $loc->id,
               'location_name' => $loc->name,
               'program' => 'Jaminan Pensiun',
               'tarif' => $unitTransaction->unit->reductions->where('name', 'JP')->first()->company + $unitTransaction->unit->reductions->where('name', 'JP')->first()->employee,
               'qty' => count($loc->getUnitTransactionB($unitTransaction->unit_id, $unitTransaction)),
               'upah' => $loc->getUnitTransactionKt($unitTransaction->unit_id, $unitTransaction, 'JP'),
               'perusahaan' => $loc->getDeductionReal($unitTransaction, 'JP', 'company'),
               'karyawan' => $loc->getDeduction($unitTransaction, 'JP', 'employee'),
               'total_iuran' => $loc->getDeductionReal($unitTransaction, 'JP', 'company') + $loc->getDeduction($unitTransaction, 'JP', 'employee'),
            ]);
         }
      }

      return redirect()->back()->with('success', 'BPJS TK Report successfully generated, click "BPJS TK Report" to see the report');
   }
}
