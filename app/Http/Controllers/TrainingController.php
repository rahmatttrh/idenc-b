<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
   public function index(){
      $trainings = Training::get();
      return view('pages.training.index', [
         'trainings' => $trainings
      ]);
   }


   public function store(Request $req){
      $req->validate([]);

      Training::create([
         'code' => $req->code,
         'level' => $req->level,
         'title' => $req->title,
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'Training added');
   }


   public function update(Request $req){
      $req->validate([

      ]);

      $training = Training::find($req->training);
      $training->update([
         'code' => $req->code,
         'level' => $req->level,
         'title' => $req->title,
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'Training updated');
   }


   public function delete($id){
      $training = Training::find(dekripRambo($id));
      $training->delete();

      return redirect()->back()->with('success', 'Training deleted');
   }
}
