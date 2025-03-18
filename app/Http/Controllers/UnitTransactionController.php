<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PayrollApproval;
use App\Models\PayslipBpjsKs;
use App\Models\PayslipBpjsKt;
use App\Models\PayslipReport;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\UnitTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UnitTransactionController extends Controller
{

   public function detail($id)
   {
      // dd('ok');
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $unit = Unit::find($unitTransaction->unit_id);
      $units = Unit::get();
      $locations = Location::get();
      $firstLoc = Location::orderBy('id', 'asc')->first();
      $locations = Location::get();
      $firstLoc = Location::orderBy('id', 'asc')->first();
      $transactions = Transaction::where('unit_id', $unit->id)->where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->orderBy('name', 'asc')->get();


      $manhrd = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-hrd')->where('type', 'approve')->first();
      $manfin = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'man-fin')->where('type', 'approve')->first();
      $gm = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'gm')->where('type', 'approve')->first();
      $bod = PayrollApproval::where('unit_transaction_id', $unitTransaction->id)->where('level', 'bod')->where('type', 'approve')->first();

      $reportBpjsKs = PayslipBpjsKs::where('unit_transaction_id', $unitTransaction->id)->first();
      $reportBpjsKt = PayslipBpjsKt::where('unit_transaction_id', $unitTransaction->id)->first();

      $now = Carbon::create($unitTransaction->month);
      // dd($now->addMonth()->format('F'));
      if (!$reportBpjsKt) {
         PayslipBpjsKt::create([
            'unit_transaction_id' => $unitTransaction->id,
            'month' => $now->format('F'),
            'year' => $unitTransaction->year,
            'status' => 0,
            'payslip_employee' => count($transactions),
            'payslip_total' => $transactions->sum('total')
         ]);
      } else {
         $reportBpjsKt->update([
            'unit_transaction_id' => $unitTransaction->id,
            'month' => $now->format('F'),
            'year' => $unitTransaction->year,
            'status' => 0,
            'payslip_employee' => count($transactions),
            'payslip_total' => $transactions->sum('total')
         ]);
      }


      if (!$reportBpjsKs) {
         PayslipBpjsKs::create([
            'unit_transaction_id' => $unitTransaction->id,
            'month' => $now->addMonth()->format('F'),
            'year' => $unitTransaction->year,
            'status' => 0,
            'payslip_employee' => count($transactions),
            'payslip_total' => $transactions->sum('total')
         ]);
      } else {
         $reportBpjsKs->update([
            'unit_transaction_id' => $unitTransaction->id,
            'month' => $now->addMonth()->format('F'),
            'year' => $unitTransaction->year,
            'status' => 0,
            'payslip_employee' => count($transactions),
            'payslip_total' => $transactions->sum('total')
         ]);
      }

      // test create report bpjs ks
      // PayslipBpjsKs::create([
      //    'unit_transaction_id' => $unitTransaction->id,
      //    'month' => $unitTransaction->month,
      //    'year' => $unitTransaction->year,
      //    'status' => 0,
      // ]);

      $payslipReports = PayslipReport::where('unit_transaction_id', $unitTransaction->id)->get();

      return view('pages.payroll.transaction.monthly-all', [
         'unit' => $unit,
         'units' => $units,
         'locations' => $locations,
         'firstLoc' => $firstLoc,
         'locations' => $locations,
         'firstLoc' => $firstLoc,
         'unitTransaction' => $unitTransaction,
         'transactions' => $transactions,
         'payslipReports' => $payslipReports,

         'manhrd' => $manhrd,
         'manfin' => $manfin,
         'gm' => $gm,
         'bod' => $bod,
      ])->with('i');
   }

   public function refresh ($id){
      // dd('okeee');
      $unitTransaction = UnitTransaction::find(dekripRambo($id));
      $transactionCon = new TransactionController;
      $transactions = Transaction::where('unit_transaction_id', $unitTransaction->id)->get();
      foreach ($transactions as $tran) {
         $employee = Employee::find($tran->employee_id)
         if ($tran->remark == 'Karyawan baru') {
            // dd'karyawan'
            $transReductions = TransactionReduction::where('transaction_id', $tran->id)->get();
            foreach ($transReductions as $redu) {
               $redu->delete();
            }
            $reductionEmployees = ReductionEmployee::where('employee_id', $employee->id)->where('type', 'Default')->get();
            foreach ($reductionEmployees as $red) {
              

               if ($red->status == 1) {

                  //09 Create Transaction Reduction berdasarkan Reduction Employee beban perusahaan
                  TransactionReduction::create([
                     'transaction_id' => $transaction->id,
                     'reduction_id' => $red->reduction_id,
                     'reduction_employee_id' => $red->id,
                     'class' => $red->type,
                     'type' => 'company',
                     'location_id' => $location,
                     'name' => $red->reduction->name . $red->description,
                     'value' => $red->company_value,
                     'value_real' => $red->company_value_real,
                     // 'value' => $bebanPerusahaan,
                     // 'value_real' => $bebanPerusahaanReal
                  ]);

                  //10 Create Transaction Reduction berdasarkan Reduction Employee beban karyawan
                  TransactionReduction::create([
                     'transaction_id' => $transaction->id,
                     'reduction_id' => $red->reduction_id,
                     'reduction_employee_id' => $red->id,
                     'class' => $red->type,
                     'type' => 'employee',
                     'location_id' => $location,
                     'name' => $red->reduction->name . $red->description,
                     'value' => $red->employee_value,
                     'value_real' => $red->employee_value_real,
                     // 'value' => $bebanKaryawan,
                     // 'value_real' => $bebanKaryawanReal
                  ]);
               }
            }

            $reductionAddEmployees = ReductionEmployee::where('employee_id', $employee->id)->where('type', 'Additional')->get();
            foreach ($reductionAddEmployees as $red) {

               //11 Create Transaction Reduction Additional berdasarkan Reduction Employee beban perusahaan
               TransactionReduction::create([
                  'transaction_id' => $transaction->id,
                  'reduction_id' => $red->reduction_id,
                  'reduction_employee_id' => $red->id,
                  'class' => $red->type,
                  'type' => 'company',
                  'location_id' => $location,
                  'name' => $red->reduction->name . $red->description,
                  'value' => $red->company_value,
                  'value_real' => $red->company_value_real,
               ]);

               //12 Create Transaction Reduction Additional berdasarkan Reduction Employee beban karyawan
               TransactionReduction::create([
                  'transaction_id' => $transaction->id,
                  'reduction_id' => $red->reduction_id,
                  'reduction_employee_id' => $red->id,
                  'class' => $red->type,
                  'type' => 'employee',
                  'location_id' => $location,
                  'name' => $red->reduction->name . $red->description,
                  'value' => $red->employee_value,
                  'value_real' => $red->employee_value_real,
               ]);
            }

            $transactionCon->calculateTotalTransaction($tran, $tran->cut_from, $tran->cut_to);
         }
      }

      return redirect()->back()->with('success', "Transaction data refreshed");
   }
}
