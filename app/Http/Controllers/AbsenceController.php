<?php

namespace App\Http\Controllers;

use App\Exports\AbsenceExport;
use App\Models\Absence;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Payroll;
use App\Models\Transaction;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsenceController extends Controller
{
   public function index()
   {
      $now = Carbon::now();
      $absences = Absence::get();
      return view('pages.payroll.absence.index', [
         'absences' => $absences,
         'month' => $now->format('F'),
         'year' => $now->format('Y'),
         'from' => null,
         'to' => null
      ])->with('i');
   }

   public function create()
   {
      $now = Carbon::now();
      $employees = Employee::with('biodata')->get();
      $absences = Absence::get();
      return view('pages.payroll.absence.form', [
         'employees' => $employees,
         'absences' => $absences,
         'month' => $now->format('F'),
         'year' => $now->format('Y'),
         'from' => null,
         'to' => null
      ])->with('i');
   }

   public function downloadTemplate(Request $req)
   {
      $req->validate([]);

      $data = [
         'date' => $req->date,
         'bu' => $req->bu,
         'location' => $req->location,
      ];

      if ($req->location == 'all') {
         # code...
         $location = 'semua-lokasi';
      } else {
         # code...
         $loc = Location::find($req->location);
         $location = $loc->name;
      }


      return Excel::download(new AbsenceExport($data), 'template-import-ketidakhadiran-' . $location . '.xlsx');
   }

   public function import()
   {
      $now = Carbon::now();
      $employees = Employee::get();
      $absences = Absence::get();
      $units = Unit::orderBy('name')->get();
      $locations = Location::orderBy('name')->get();


      return view('pages.payroll.absence.import', [
         'employees' => $employees,
         'absences' => $absences,
         'units' => $units,
         'locations' => $locations,
         'month' => $now->format('F'),
         'year' => $now->format('Y'),
         'from' => null,
         'to' => null
      ])->with('i');
   }

   public function export()
   {

      return Excel::download(new AbsenceExport('ini'), 'employee.xlsx');
   }

   public function filter(Request $req)
   {
      $req->validate([]);


      $absences = Absence::whereBetween('date', [$req->from, $req->to])->get();

      $employees = Employee::get();
      return view('pages.payroll.absence.form', [
         'employees' => $employees,
         'absences' => $absences,
         'from' => $req->from,
         'to' => $req->to
      ])->with('i');
   }

   public function store(Request $req)
   {

      // dd('ok');
      $employee = Employee::find($req->employee);
      $payroll = Payroll::find($employee->payroll_id);
      // Cek jika karyawan tsb blm di set payroll
      if (!$payroll) {
         return redirect()->back()->with('danger', $employee->nik . ' ' . $employee->biodata->fullName() . ' belum ada data Gaji Karyawan');
      }

      if ($req->type == 2) {
         $req->validate([
            'minute' => 'required'
         ]);
      }



      $date = Carbon::create($req->date);
      if (request('doc')) {
         $doc = request()->file('doc')->store('doc/overtime');
      } else {
         $doc = null;
      }

      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $location = $loc->id;
         }
      }

      $value =  1 * 1 / 30 * $payroll->total;

      // $reductionAlpha = null;
      // foreach ($alphas as $alpha) {
      //    $reductionAlpha =  1 * 1 / 30 * $payroll->total;
      //    $alpha->update([
      //       'value' => $reductionAlpha
      //    ]);
      // }

      Absence::create([
         'type' => $req->type,
         'employee_id' => $req->employee,
         'month' => $date->format('F'),
         'year' => $date->format('Y'),
         'date' => $req->date,
         'desc' => $req->desc,
         'doc' => $doc,
         'minute' => $req->minute,
         'location_id' => $location,
         'value' => $value
      ]);

      return redirect()->back()->with('success', 'Data Absence successfully added');
   }

   public function delete($id)
   {
      $absence = Absence::find(dekripRambo($id));
      $transaction = Transaction::where('employee_id', $absence->employee_id)->where('month', $absence->month)->where('year', $absence->year)->first();
      $absence->delete();

      if ($transaction) {
         $trans = new TransactionController;
         $trans->calculateTotalTransaction($transaction);
      }

      return redirect()->back()->with('success', 'Absence Data successfully deleted');
   }
}
