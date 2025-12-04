<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\UnitTransaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
      $units = Unit::get();
      $locations = Location::get();
      $employees = Employee::where('status', 1)->get();
      return view('pages.report.index', [
         'units' => $units,
         'locations' => $locations,
         'employees' => $employees
      ]);
   }


   public function reportGajiBersih(Request $req){
      $transactions = Transaction::where('month', $req->month)->where('year', $req->year)->orderBy('name', 'asc')->get();

      return view('pages.pdf.payslip-all-report', [
         'month' => $req->month,
         'year' => $req->year,
         'transactions' => $transactions,
         
      ])->with('i');
   }

   public function reportPayslip(Request $req){
      $unitTransaction = UnitTransaction::where('unit_id', $req->unit)->where('month', $req->month)->where('year', $req->year)->first();
      // dd($unitTransaction);

      if ($unitTransaction) {
         return redirect()->route('payroll.transaction.export.pdf', enkripRambo($unitTransaction->id));
      } else {
         return redirect()->back()->with('danger', 'Report belum tersedia');
      }
   }

   public function reportPayslipLocation(Request $req){
      $unitTransaction = UnitTransaction::where('unit_id', $req->unit)->where('month', $req->month)->where('year', $req->year)->first();
      $location = Location::find($req->location);
      // dd($unitTransaction);

      if ($unitTransaction) {
         return redirect()->route('payroll.transaction.loc.export.pdf', [enkripRambo($unitTransaction->id), enkripRambo($location->id)]);
      } else {
         return redirect()->back()->with('danger', 'Report belum tersedia');
      }
   }

   public function reportBpjsKs(Request $req){
      $unitTransaction = UnitTransaction::where('unit_id', $req->unit)->where('month', $req->month)->where('year', $req->year)->first();
   
      // dd($unitTransaction);

      if ($unitTransaction) {
         return redirect()->route('payroll.report.bpjsks', enkripRambo($unitTransaction->id));
      } else {
         return redirect()->back()->with('danger', 'Report belum tersedia');
      }
   }

   public function reportBpjsTk(Request $req){
      $unitTransaction = UnitTransaction::where('unit_id', $req->unit)->where('month', $req->month)->where('year', $req->year)->first();
   
      // dd($unitTransaction);

      if ($unitTransaction) {
         return redirect()->route('payroll.report.bpjskt', enkripRambo($unitTransaction->id));
      } else {
         return redirect()->back()->with('danger', 'Report belum tersedia');
      }
   }

   public function reportAbsensiKaryawan(Request $req){
      $employee = Employee::find($req->employee_abs);

      if ($employee) {
         return redirect()->route('payroll.absence.export.summary.employee', [enkripRambo($employee->id), $req->from, $req->to]);
      } else {
         return redirect()->back()->with('danger', 'Report belum tersedia');
      }
   }

   public function reportSpklKaryawan(Request $req){
      $employee = Employee::find($req->employee_spkl);

      if ($employee) {
         return redirect()->route('summary.overtime.employee.export.excel', [enkripRambo($req->from), enkripRambo($req->to), enkripRambo($employee->id)] );
      } else {
         return redirect()->back()->with('danger', 'Report belum tersedia');
      }
   }


}
