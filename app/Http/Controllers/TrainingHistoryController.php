<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Training;
use App\Models\TrainingHistory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingHistoryController extends Controller
{
   public function index(){
      $trainingHistories = TrainingHistory::orderBy('updated_at', 'desc')->get();

      if (auth()->user()->hasRole('Administrator')) {
         $qtyDup = 0;
         // dd('ok');
         // $trainingHistories = TrainingHistory::where('type_sertificate', 'Attendence')->get();
         // // dd($trainingHistories);
         // foreach($trainingHistories as $his){
         //    $his->update([
         //       'type_sertificate' => 'Attendance'
         //    ]);   
         // }
         $testHistories = [];

         // $testHistories = TrainingHistory::where('expired', '9999-01-01')->get();
         // dd($testHistories);
         // foreach($testHistories as $t){
         //    $t->update([
         //       'expired' => null
         //    ]);
         // }
         // foreach($trainingHistories as $tr){
         //    $sameTrs = TrainingHistory::where('employee_id', $tr->employee_id)
         //    ->where('training_id', $tr->training_id)
         //    ->where('desc', $tr->desc)
         //    ->where('vendor', $tr->vendor)
         //    ->where('type', $tr->type)
         //    ->where('periode', $tr->periode)
         //    ->where('type_sertificate', $tr->type_sertificate)
         //    ->where('expired', $tr->expiredss)
         //    ->get();
         //    if(count($sameTrs) > 1){
               
         //       $first = $sameTrs->first();
               
         //       $prepareDeletes = $sameTrs->where('id', '!=', $first->id);
               
         //       foreach($sameTrs as $t){
                  
         //       }
         //       $qtyDup += 1;
         //    }
         // }
         // dd($qtyDup);
      }

      return view('pages.training.history.index', [
         'trainingHistories' => $trainingHistories
      ]);
   }

   public function export(){
      
      $units = Unit::get();
      return view('pages.training.history.export', [
        'units'  => $units,
         // 'trainingHistories' => $trainingHistories
      ]);
   }

   public function exportPdf(Request $req){
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

   public function create(){
      $employees = Employee::where('status', 1)->get();
      $trainings = Training::get();
      return view('pages.training.history.create', [
         'employees' => $employees,
         'trainings' => $trainings
      ]);
   }

   public function store(Request $req){
      $req->validate([

      ]);

      if (request('doc')) {
         
         $doc = request()->file('doc')->store('doc/employee/training');
      }  else {
         $doc = null;
      }

      TrainingHistory::create([
         'status' => 1,
         'type' => $req->type,
         'type_sertificate' => $req->type_sertificate,
         'employee_id' => $req->employee,
         'training_id' => $req->training,
         'periode' => $req->periode,
         'doc' => $req->sertifikat,
         'vendor' => $req->vendor,
         'expired' => $req->expired,
         'doc' => $doc ,
      ]);

      return redirect()->route('training.history')->with('success', 'Training History added');
   }


   public function edit($id){
      $trainingHistory = TrainingHistory::find(dekripRambo($id));
      $employees = Employee::where('status', 1)->get();
      $trainings = Training::get();
      return view('pages.training.history.edit', [
         'trainingHistory' => $trainingHistory,
         'employees' => $employees,
         'trainings' => $trainings
      ]);


   }


   public function update(Request $req){
      $req->validate([
         
      ]);
      $trainingHistory = TrainingHistory::find($req->history);

      if (request('doc')) {
         // dd('ok');
         Storage::delete($trainingHistory->doc);
         $doc = request()->file('doc')->store('images/employee/training');
      } elseif ($trainingHistory->doc) {
         $doc = $trainingHistory->doc;
      } else {
         $doc = null;
      }

      // if (auth()->user()->hasRole('Administrator')) {
      //    dd($doc);
      // }

      
      $trainingHistory->update([
         'type' => $req->type,
         'type_sertificate' => $req->type_sertificate,
         'employee_id' => $req->employee,
         'training_id' => $req->training,
         'periode' => $req->periode,
         'doc' => $req->sertifikat,
         'vendor' => $req->vendor,
         'expired' => $req->expired,
         'doc' => $doc ,
      ]);

      return redirect()->route('training.history')->with('success', 'Training History updated');

   }


   public function delete($id){
      $trainingHistory = TrainingHistory::find(dekripRambo($id));

      Storage::delete($trainingHistory->doc);
      $trainingHistory->delete();

      return redirect()->route('training.history')->with('success', 'Training History deleted');

   }
}
