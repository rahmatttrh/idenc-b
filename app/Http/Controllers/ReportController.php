<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Location;
use App\Models\TrainingHistory;
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
      $departments = Department::get();
      return view('pages.report.index', [
         'units' => $units,
         'locations' => $locations,
         'employees' => $employees,
         'departments' => $departments
      ]);
   }


   public function reportGajiBersih(Request $req){
      $transactions = Transaction::where('month', $req->month)->where('year', $req->year)->orderBy('name', 'asc')->get();

      if ($req->month == 'all') {
         return view('pages.pdf.payslip-all-annual-report', [
            'month' => $req->month,
            'year' => $req->year,
            'transactions' => $transactions,
            
         ])->with('i');
      }

      return view('pages.pdf.payslip-all-report', [
         'month' => $req->month,
         'year' => $req->year,
         'transactions' => $transactions,
         
      ])->with('i');
   }

   public function reportPayslipOld(Request $req){
      $unitTransaction = UnitTransaction::where('unit_id', $req->unit)->where('month', $req->month)->where('year', $req->year)->first();
      // dd($unitTransaction);

      if ($unitTransaction) {
         return redirect()->route('payroll.transaction.export.pdf', enkripRambo($unitTransaction->id));
      } else {
         return redirect()->back()->with('danger', 'Report belum tersedia');
      }
   }

   public function reportPayslip(Request $req){
      $unitTransaction = UnitTransaction::where('unit_id', $req->unit)->where('month', $req->month)->where('year', $req->year)->first();
      // dd($unitTransaction);

      if ($unitTransaction) {
         if ($req->location == 'all') {
            return redirect()->route('payroll.transaction.export.pdf', enkripRambo($unitTransaction->id));
         } else {
             $location = Location::find($req->location);
             return redirect()->route('payroll.transaction.loc.export.pdf', [enkripRambo($unitTransaction->id), enkripRambo($location->id)]);
         }
         
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


   public function reportPayslipKomponen(Request $req){
      $unit = Unit::find($req->unit);
      $employees = Employee::where('unit_id', $unit->id)->where('status', 1)->get();

      if ($req->komponen == 'bruto') {
         $title = 'Gaji Kotor';
      } elseif ($req->komponen == 'total') {
         $title = 'Gaji Bersih';
      } elseif ($req->komponen == 'overtime') {
         $title = 'Nilai Lembur/Piket';
      } elseif ($req->komponen == 'additional_penambahan') {
         $title = 'Lain-lain';
      }

      return view('pages.pdf.payslip-komponen', [
         'employees' => $employees,
         'title' => $title,
         'komponen' => $req->komponen,
         'unit' => $unit,
         'year' => $req->year
         
      ])->with('i');
      
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

   public function reportTax(Request $req){
      $unitTransaction = UnitTransaction::where('unit_id', $req->unit)->where('month', $req->month)->where('year', $req->year)->first();
   
      // dd($unitTransaction);

      return view('pages.payroll.report.tax', [
         'unitTransaction' => $unitTransaction
      ]);
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

   public function reportAbsensiAnnual(Request $req){
      $unit = Unit::find($req->unit);


      $employees = Employee::where('unit_id', $unit->id)->where('status', 1)->get();
      



      return view('pages.pdf.summary-absence-annual', [
            
            'employees' => $employees,
            'unit' => $unit,
            'from' => $req->from,
            'to' => $req->to
            
         ])->with('i');
   }

   public function reportSpklKaryawan(Request $req){
      $employee = Employee::find($req->employee_spkl);

      if ($employee) {
         return redirect()->route('summary.overtime.employee.export.excel', [enkripRambo($req->from), enkripRambo($req->to), enkripRambo($employee->id)] );
      } else {
         return redirect()->back()->with('danger', 'Report belum tersedia');
      }
   }

   public function reportSpklAnnual(Request $req){
      $unit = Unit::find($req->unit);

      if ($req->department == 'all') {
         $employees = Employee::where('unit_id', $unit->id)->where('status', 1)->get();
      } else {
         $employees = Employee::where('unit_id', $unit->id)->where('department_id', $req->department)->where('status', 1)->get();
      }


      if ($req->location == 'all') {
         $employees = $employees;
      } else {
         $employees = $employees->where('location_id', $req->location);
      }
      
      
      if($req->type == 1){
         $typeName = 'Lembur';
      } elseif($req->type == 2){
         $typeName = 'Piket';
      }

      $department = Department::find($req->department);
      $location = Location::find($req->location);

      return view('pages.pdf.spkl-annual-report', [
            'typeName' => $typeName,
            'type' => $req->type,
            'year' => $req->year,
            'employees' => $employees,
            'unit' => $unit,
            'department' => $department,
            'location' => $location
            
         ])->with('i');
   }


   public function reportTrainingHistory(Request $req){
      $req->validate([
         'unit' => 'required',
      ]);

      $trainingHistories = TrainingHistory::whereHas('employee', function($q) use ($req){
         $q->where('unit_id', $req->unit);
      })->get();

      $unit = Unit::find($req->unit);

      return view('pages.training.pdf.history', [
         'trainingHistories' => $trainingHistories,
         'unit' => $unit
      ]);
   }


}
