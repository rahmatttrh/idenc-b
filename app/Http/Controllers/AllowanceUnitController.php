<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\AllowanceUnit;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Log;
use App\Models\Payroll;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AllowanceUnitController extends Controller
{
    public function index(){
      
      $employees = Employee::get();
     
      $units = Unit::get();
      $firstUnit = Unit::get()->first();
      $allowanceUnits = AllowanceUnit::where('unit_id', $firstUnit->id)->get();
      return view('pages.payroll.allowance.unit.index', [
         'units' => $units,
         'employees' => $employees,
         'firstUnit' => $firstUnit,
         'allowanceUnits' => $allowanceUnits

      ]);
   }

   public function indexUnit($id){
      
      $employees = Employee::get();
     
      $units = Unit::get();
      $firstUnit = Unit::find(dekripRambo($id));
      $allowanceUnits = AllowanceUnit::where('unit_id', $firstUnit->id)->get();
      return view('pages.payroll.allowance.unit.index', [
         'units' => $units,
         'employees' => $employees,
         'firstUnit' => $firstUnit,
         'allowanceUnits' => $allowanceUnits

      ]);
   }


   public function store(Request $req){
      $req->validate([]);



      $allowanceUnit = AllowanceUnit::create([
         'status' => 0,
         'unit_id' => $req->unit,
         'type' => $req->type,
         'month' => $req->month,
         'year' => $req->year
      ]);

      if ($allowanceUnit->type == 1) {
        $type = 'Perdin';
      } elseif($allowanceUnit->type == 2){
        $type = 'Kompensasi';
      } elseif($allowanceUnit->type == 3){
        $type = 'Uang Duka';
      } elseif($allowanceUnit->type == 4){
        $type = 'Pernikahan';
      } elseif($allowanceUnit->type == 5){
        $type = 'Kelahiran';
      } elseif($allowanceUnit->type == 6){
        $type = 'Insentif';
      }

      if (auth()->user()->hasRole('Administrator')) {
        # code...
      } else {
        $empLogin = Employee::where('nik', auth()->user()->username)->first();

        Log::create([
            'department_id' => $empLogin->department_id,
            'user_id' => auth()->user()->id,
            'action' => 'Create ' ,
            'desc' => 'Tunj. ' . $type . ' ' . $allowanceUnit->unit->name  . " " . $allowanceUnit->month . " " . $allowanceUnit->year
        ]);
      }
      

      return redirect()->route('allowance.unit.detail', enkripRambo($allowanceUnit->id))->with('success', 'Pengajuan Tunjangan berhasil dibuat, klik Add Karyawan untuk menambahkan data karyawan');

   }

   public function detail($id){
      $allowanceUnit = AllowanceUnit::find(dekripRambo($id));
      $allowances = Allowance::where('allowance_unit_id', $allowanceUnit->id)->get();
      $employees = Employee::where('status', 1)->where('unit_id', $allowanceUnit->unit_id)->get();
      $employeeArray = [];
      foreach($employees as $emp){
         $employeeArray[] = $emp->id;
      }
      
      $now = Carbon::now();
      // dd($now);
      $date = Carbon::parse('1 ' . $allowanceUnit->month . ' ' . $allowanceUnit->year);
      // dd($now);
      $contractEnds = Contract::where('type', 'Kontrak')->where('status', 1)->whereIn('employee_id', $employeeArray)->whereMonth('end', $date)->whereYear('end', $date)->get();
      $nowAddTwo = $now->addMonth(2);
      $notifContracts = $contractEnds;


       $date = Carbon::parse('1 ' . $allowanceUnit->month . ' ' . $allowanceUnit->year);
      //  dd($date);
      $employeeResigns = Employee::where('status', 3)->where('unit_id', $allowanceUnit->unit_id)->whereMonth('off', $date)->whereYear('off', $date)->get();

      // $employees += $employeeResigns;
      $contractArray = [];
      foreach($notifContracts as $c){
        $contractArray[] = $c->id;
      }


      $employeeContracts = Employee::whereIn('contract_id', $contractArray)->get();
    //   dd($employeeContracts);
    //   $employees = $employees->merge($employeeResigns);

      $compensationEmployees = $employeeContracts->merge($employeeResigns);


      

      // dd($allowanceUnit);
      return view('pages.payroll.allowance.unit.detail', [
         'allowanceUnit' => $allowanceUnit,
         'employees' => $employees,
         'compensationEmployees' => $compensationEmployees,
         'notifContracts' => $notifContracts,
         'employeeResigns' => $employeeResigns,
         'allowances' => $allowances
      ]);
   }

   public function release($id){
      $allowanceUnit = AllowanceUnit::find(dekripRambo($id));

      $user = Employee::where('nik', auth()->user()->username)->first();

      $allowanceUnit->update([
         'status' => 1,
         'created_by' => $user->id,
         'release_date' => Carbon::now()
      ]);

      if ($allowanceUnit->type == 1) {
        $type = 'Perdin';
      } elseif($allowanceUnit->type == 2){
        $type = 'Kompensasi';
      } elseif($allowanceUnit->type == 3){
        $type = 'Uang Duka';
      } elseif($allowanceUnit->type == 4){
        $type = 'Pernikahan';
      } elseif($allowanceUnit->type == 5){
        $type = 'Kelahiran';
      } elseif($allowanceUnit->type == 6){
        $type = 'Insentif';
      }

      if (auth()->user()->hasRole('Administrator')) {
        # code...
      } else {
        $empLogin = Employee::where('nik', auth()->user()->username)->first();

        Log::create([
            'department_id' => $empLogin->department_id,
            'user_id' => auth()->user()->id,
            'action' => 'Create ' ,
            'desc' => 'Release. ' . $type . ' ' . $allowanceUnit->unit->name  . " " . $allowanceUnit->month . " " . $allowanceUnit->year
        ]);
      }

      return redirect()->back()->with('success', 'Pengajuan berhasil di release untuk proses Validasi');
   }

   public function delete($id){
      $allowanceUnit = AllowanceUnit::find(dekripRambo($id));
      $allowances = Allowance::where('allowance_unit_id', $allowanceUnit->id)->get();

      foreach($allowances as $allow){
         $allow->delete();
      }

      $allowanceUnit->delete();

      return redirect()->route('allowance.unit.index')->with('success', 'Pengajuan berhasil di hapus');
   }




   public function addEmployee(Request $req){
      $req->validate([]);

      $allowanceUnit = AllowanceUnit::find($req->allowanceUnit);
      
      $employee = Employee::find($req->employee_allowance_b);
      $payroll = Payroll::find($employee->payroll_id);

      $total = $payroll->total;

      // Storage::delete($unitTransaction->file);
      if (request('file')) {
         $file = request()->file('file')->store('allowance/attachment');
      }  else {
         $file = null;
      }

      Allowance::create([
         'allowance_unit_id' => $allowanceUnit->id,
         'employee_id' => $employee->id,
         'position_id' => $employee->position_id,
         'location_id' => $employee->location_id,
         
         'total' => $total,
         'doc' => $file
      ]);

      $allowances = Allowance::where('allowance_unit_id', $allowanceUnit->id)->get();
      $allowanceUnit->update([
         'qty' => count($allowances),
         'total' => $allowances->sum('total')
      ]);


      return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan');


   }


   public function addInsentif(Request $req){
      $req->validate([]);

      $allowanceUnit = AllowanceUnit::find($req->allowanceUnit);
     

      // Storage::delete($unitTransaction->file);
      if (request('file')) {
         $file = request()->file('file')->store('allowance/attachment');
      } elseif ($allowanceUnit->doc) {
         $file = $allowanceUnit->doc;
      } else {
         $file = null;
      }

      $allowanceUnit->update([
         'qty' => $req->qty,
         'qty_hour' => $req->qty_hour,
         'total' => $req->total,
         'area' => $req->area,
         'doc' => $file
      ]);


      return redirect()->back()->with('success', 'Data Insentif berhasil diubah');


   }





   public function addEmployeeKompensasi(Request $req){
      $req->validate([]);

      $allowanceUnit = AllowanceUnit::find($req->allowanceUnit);
      
      $employee = Employee::find($req->employee_allowance);
      $payroll = Payroll::find($employee->payroll_id);

      if ($req->qty_month < 12) {
         $total =  $payroll->total / 12 * $req->qty_month;
      } else {
         $total = $payroll->total;
      }

      Allowance::create([
         'allowance_unit_id' => $allowanceUnit->id,
         'employee_id' => $employee->id,
         'position_id' => $employee->position_id,
         'location_id' => $employee->location_id,
         'qty_month' => $req->qty_month,
         'contract_start' => $employee->contract->start,
         'contract_end' => $employee->contract->end,

         'pokok' => $payroll->pokok,
         'tunj_jabatan' => $payroll->tunj_jabatan,
         'tunj_ops' => $payroll->tunj_ops,
         'tunj_fungsional' => $payroll->tunj_fungsional,
         'tunj_kinerja' => $payroll->tunj_kinerja,
         'insentif' => $payroll->insentif,
         'total' => $total,
      ]);

      $allowances = Allowance::where('allowance_unit_id', $allowanceUnit->id)->get();
      $allowanceUnit->update([
         'qty' => count($allowances),
         'total' => $allowances->sum('total')
      ]);


      return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan');


   }


   public function addEmployeeKelahiran(Request $req){
      $req->validate([]);

      $allowanceUnit = AllowanceUnit::find($req->allowanceUnit);
      
      $employee = Employee::find($req->employee_allowance_c);
      $payroll = Payroll::find($employee->payroll_id);

      if ($req->child == 1) {
         $percent = 100;
         $total =  $payroll->total ;
      } elseif($req->child == 2) {
         $percent = 75;
         $total = $payroll->total * 75 / 100;
      }

      Allowance::create([
         'allowance_unit_id' => $allowanceUnit->id,
         'employee_id' => $employee->id,
         'position_id' => $employee->position_id,
         'location_id' => $employee->location_id,
         'child' => $req->child,
         'percent' => $percent,


         'total' => $total,
      ]);

      $allowances = Allowance::where('allowance_unit_id', $allowanceUnit->id)->get();
      $allowanceUnit->update([
         'qty' => count($allowances),
         'total' => $allowances->sum('total')
      ]);


      return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan');


   }


   public function deleteEmployee($id){
      $allowance = Allowance::find(dekripRambo($id));
      $allowanceUnit = AllowanceUnit::find($allowance->allowance_unit_id);

      $allowance->delete();
      $allowances = Allowance::where('allowance_unit_id', $allowanceUnit->id)->get();
      $allowanceUnit->update([
         'qty' => count($allowances),
         'total' => $allowances->sum('total')
      ]);


      return redirect()->back()->with('success', 'Data Karyawan berhasil dihapus dari Daftar Tunjangan');


   }





   public function exportPdf($id){
      $allowanceUnit = AllowanceUnit::find(dekripRambo($id));
      $allowances = Allowance::where('allowance_unit_id', $allowanceUnit->id)->get();
      
      

      // dd($allowanceUnit);
      return view('pages.payroll.allowance.unit.pdf', [
         'allowanceUnit' => $allowanceUnit,
         
         'allowances' => $allowances
      ]);
   }




   public function approvalList($level){

      $allowanceApprovals = AllowanceUnit::where('status', dekripRambo($level))->get();
      return view('pages.payroll.allowance.approval.index', [
         'allowanceApprovals' => $allowanceApprovals,
         'level' => dekripRambo($level)
      ]);
   }
   public function historyList($level){

      $allowanceHistories = AllowanceUnit::where('status', '>', dekripRambo($level))->get();
      return view('pages.payroll.allowance.approval.history', [
         'allowanceHistories' => $allowanceHistories,
         'level' => dekripRambo($level)
      ]);
   }



   public function approve($id, $level){
      $allowanceUnit = AllowanceUnit::find(dekripRambo($id));

      $allowanceUnit->update([
         'status' => dekripRambo($level),
      ]);

      $employee = Employee::where('nik', auth()->user()->username)->first();

      if (dekripRambo($level) == 2) {
         $allowanceUnit->update([
            'approve_one_id' => $employee->id,
            'approve_one_date' => Carbon::now(),
         ]);

         return redirect()->route('allowance.approval.list', enkripRambo(1))->with('success', 'Pengajuan Tunjangan berhasil di setujui');
      }

      if (dekripRambo($level) == 3) {
         $allowanceUnit->update([
            'approve_two_id' => $employee->id,
            'approve_two_date' => Carbon::now(),
         ]);
         return redirect()->route('allowance.approval.list', enkripRambo(2))->with('success', 'Pengajuan Tunjangan berhasil di setujui');
      }

      if (dekripRambo($level) == 4) {
         $allowanceUnit->update([
            'approve_three_id' => $employee->id,
            'approve_three_date' => Carbon::now(),
         ]);
         return redirect()->route('allowance.approval.list', enkripRambo(3))->with('success', 'Pengajuan Tunjangan berhasil di setujui');
      }

      if (dekripRambo($level) == 5) {
         $allowanceUnit->update([
            'approve_four_id' => $employee->id,
            'approve_four_date' => Carbon::now(),
         ]);
         return redirect()->route('allowance.approval.list', enkripRambo(4))->with('success', 'Pengajuan Tunjangan berhasil di setujui');
      }




   }
}
