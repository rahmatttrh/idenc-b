<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\PayrollHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PayrollHistoryController extends Controller
{
   public function store(Request $req){
      $req->validate([]);
      // dd($req->pokok);
      $payroll = Payroll::find($req->payroll);
      PayrollHistory::create([
         'employee_id' => $req->employee,
         'location_id' => $payroll->location_id,
         'pokok' => $payroll->pokok,
         'tunj_jabatan' => $payroll->tunj_jabatan,
         'tunj_ops' => $payroll->tunj_ops,
         'tunj_fungsional' => $payroll->tunj_fungsional,
         'tunj_kinerja' => $payroll->tunj_kinerja,
         'insentif' => $payroll->insentif,
         'total' => $payroll->total,
         // 'payslip_status' => $payroll->payslip_status,
         'doc' => $payroll->doc,
         'berlaku' => $payroll->berlaku
      ]);

      $total = preg_replace('/[Rp. ]/', '', $req->pokok) + preg_replace('/[Rp. ]/', '', $req->tunj_jabatan) + preg_replace('/[Rp. ]/', '', $req->tunj_ops) + preg_replace('/[Rp. ]/', '', $req->tunj_kinerja) + preg_replace('/[Rp. ]/', '', $req->tunj_fungsional) + preg_replace('/[Rp. ]/', '', $req->insentif);
      if (request('doc')) {
         // if ($payroll->doc) {
         //    Storage::delete($payroll->doc);
         // }


         $doc = request()->file('doc')->store('doc/payroll');
      } elseif ($payroll->doc) {
         $doc = $payroll->doc;
      } else {
         $doc = null;
      }
      
      $payroll->update([
         'pokok' => preg_replace('/[Rp. ]/', '', $req->pokok),
         'tunj_jabatan' => preg_replace('/[Rp. ]/', '', $req->tunj_jabatan),
         'tunj_ops' => preg_replace('/[Rp. ]/', '', $req->tunj_ops),
         'tunj_kinerja' => preg_replace('/[Rp. ]/', '', $req->tunj_kinerja),
         'tunj_fungsional' => preg_replace('/[Rp. ]/', '', $req->tunj_fungsional),
         'insentif' => preg_replace('/[Rp. ]/', '', $req->insentif),
         'total' => $total,
         'payslip_status' => 1,
         'doc' => $doc,
         'berlaku' => $req->date
      ]);

      return redirect()->back()->with('success', 'Perubaha Nominal berhasil dilakukan');

   }
}
