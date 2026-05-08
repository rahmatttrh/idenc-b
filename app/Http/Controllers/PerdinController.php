<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use App\Models\Perdin;
use App\Models\PerdinAccommodation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerdinController extends Controller
{
   public function index()
   {
      $perdins = Perdin::get();
      $employees = Employee::get();
      return view('pages.payroll.perdin', [
         'perdins' => $perdins,
         'employees' => $employees
      ]);
   }

   public function store(Request $req)
   {
      $req->validate([]);
      $employee = Employee::find($req->employee);

      $now = Carbon::now();

      $lastPerdin = Perdin::orderBy('updated_at', 'desc')->get();

      if ($lastPerdin != null) {
         $id = count($lastPerdin) + 1;
      } else {
         $id = 1;
      }

      $date = $now;
      $code = 'PD/' . $date->format('m')  . $date->format('y') . '/' . $id;

      $perdin = Perdin::create([
         'code' => $code,
         'unit_id' => $employee->unit_id,
         'location_id' => $employee->contract->location_id,
         'employee_id' => $employee->id,
         'type_area' => $req->type_area,
         'type_project' => $req->type_project,
         'desc' => $req->description,
         'project' => $req->description_project,
         'destination' => $req->destination,

         'departure_from' => $req->departure_from,
         'departure_transport' => $req->departure_transport,
         'departure_date' => $req->departure_date,
         'return_from' => $req->return_from,
         'return_transport' => $req->return_transport,
         'return_date' => $req->return_date,
         'duration' => $req->duration,
         'note' => $req->note,
         'status' => 0,

      ]);

      PerdinAccommodation::create([
         'perdin_id' => $perdin->id
      ]);

      return redirect()->route('perdin.detail', enkripRambo($perdin->id))->with('success', 'Perdin Data successfully added');
      
      return view('pages.payroll.perdin.detail', [
         'employee' => $employee
      ]);
   }


   public function update(Request $req)
   {
      $req->validate([]);
      $perdin = Perdin::find($req->perdinId);
      $employee = Employee::find($req->employee);

     
      

      $perdin->update([
         'code' => $code,
         'unit_id' => $employee->unit_id,
         'location_id' => $employee->contract->location_id,
         'employee_id' => $employee->id,
         'type_area' => $req->type_area,
         'type_project' => $req->type_project,
         'desc' => $req->description,
         'project' => $req->description_project,
         'destination' => $req->destination,

         'departure_from' => $req->departure_from,
         'departure_transport' => $req->departure_transport,
         'departure_date' => $req->departure_date,
         'return_from' => $req->return_from,
         'return_transport' => $req->return_transport,
         'return_date' => $req->return_date,
         'duration' => $req->duration,
         'note' => $req->note,
         'status' => 0,

      ]);

      return redirect()->route('perdin.detail', enkripRambo($perdin->id))->with('success', 'Perdin Data successfully updated');
      
   }


   public function detail($id)
   {
      $perdin = Perdin::find(dekripRambo($id));
      $perdinAcco = PerdinAccommodation::where('perdin_id', $perdin->id)->first();
      $employees = Employee::get();

      // dd($perdinAcco);
      
      return view('pages.payroll.perdin.detail', [
         'perdin' => $perdin,
         'perdinAcco' => $perdinAcco,
         'employees' => $employees
      ]);
   }

   public function storeB(Request $req)
   {
      $req->validate([]);
      $employee = Employee::find($req->employee);
      $locations = Location::get();

      foreach ($locations as $loc) {
         if ($loc->code == $employee->contract->loc) {
            $location = $loc->id;
         }
      }

      $date = Carbon::create($req->date);
      $month = $date->format('F');
      $year = $date->format('Y');

      Perdin::create([
         'unit_id' => $employee->unit_id,
         'location_id' => $location,
         'employee_id' => $employee->id,
         'date' => $req->date,
         'month' => $month,
         'year' => $year,
         'value' => $req->value,
         'desc' => $req->desc
      ]);

      return redirect()->back()->with('success', 'Perdin Data successfully added');
   }
}
