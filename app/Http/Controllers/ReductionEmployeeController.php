<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Log;
use App\Models\Payroll;
use App\Models\Reduction;
use App\Models\ReductionEmployee;
use Illuminate\Http\Request;

class ReductionEmployeeController extends Controller
{
   public function update(Request $req)
   {
      $reductionEmployee = ReductionEmployee::find($req->redEmp);
      // dd($req->status);
      if (auth()->user()->hasRole('Administrator')) {
         // dd($req->value);
      }
      
      $employee = Employee::find($reductionEmployee->employee_id);
      $payroll = Payroll::find($employee->payroll_id);
      $red = Reduction::find($reductionEmployee->reduction_id);
      $payTotal = $payroll->total;

      if ($payTotal <= $red->min_salary) {
         // dd('kurang dari minimum gaji');
         $salary = $red->min_salary;
         $realSalary = $payTotal;
         // dd($employee->nik);

         $bebanPerusahaan = ($red->company * $salary) / 100;
         $bebanKaryawan = ($red->employee * $realSalary) / 100;
         // dd($bebanKaryawan);
         $bebanKaryawanReal = ($red->employee * $salary) / 100;
         $selisih = $bebanKaryawanReal - $bebanKaryawan;
         $bebanPerusahaanReal = $bebanPerusahaan + $selisih;
         // $bebanKaryawanReal = ($red->reduction->employee * $salary) / 100;
         // $selisih = $bebanKaryawanReal - $bebanKaryawan;
         // $bebanPerusahaanReal = $bebanPerusahaan + $selisih;

      } else if ($payTotal >= $red->min_salary) {
         if ($payTotal > $red->max_salary) {
            // dd('ok');
            if ($red->max_salary != 0) {
               $salary = $payTotal;
               $bebanPerusahaan = ($red->company * $red->max_salary) / 100;
               $bebanKaryawan = ($red->employee * $red->max_salary) / 100;
               $bebanKaryawanReal = 0;
               $bebanPerusahaanReal = $bebanPerusahaan;
            } else {
               $salary = $payTotal;
               $bebanPerusahaan = ($red->company * $salary) / 100;
               $bebanKaryawan = ($red->employee * $salary) / 100;
               $bebanKaryawanReal = 0;
               $bebanPerusahaanReal = $bebanPerusahaan;
            }
         } else {
            $salary = $payTotal;
            $bebanPerusahaan = ($red->company * $salary) / 100;
            $bebanKaryawan = ($red->employee * $salary) / 100;
            $bebanKaryawanReal = 0;
            $bebanPerusahaanReal = $bebanPerusahaan;
         }
      }

      $reductionEmployee->update([
         // 'employee_value' => preg_replace('/[Rp. ]/', '', $req->value) ,
         'employee_value' => $bebanKaryawan,
         'employee_value_real' => $bebanKaryawanReal,
         'company_value' => $bebanPerusahaan,
         'company_value_real' => $bebanPerusahaanReal,
         'status' => $req->status
      ]);

      if ($req->status == 1) {
         $stat = 'Enable';
      } else {
         $stat = 'Disable';
      }

      // dd($reductionEmployee->status);
      if (auth()->user()->hasRole('Administrator')) {
         $departmentId = null;
      } else {
         $user = Employee::find(auth()->user()->getEmployeeId());
         $departmentId = $user->department_id;
      }
      Log::create([
         'department_id' => $departmentId,
         'user_id' => auth()->user()->id,
         'action' => $stat,
         'desc' => 'Deduction ' . $reductionEmployee->employee->nik . ' ' . $reductionEmployee->employee->biodata->fullName()
      ]);

      return redirect()->back()->with('status', 'Potongan Karyawan berhasil diubah');
   }

   public function delete(Request $req)
   {
      // dd('ok');
      $req->validate([]);

      $redEmp = ReductionEmployee::find($req->redempId);

      $redEmp->delete();
      return redirect()->back()->with('status', 'Potongan Karyawan berhasil dihapus');
   }
}
