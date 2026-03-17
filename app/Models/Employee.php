<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   use HasFactory;
   protected $guarded = [];

    public function getSpklDate($date){
      $spkls = Overtime::where('date', $date)->get();

      return $spkls;
   }


   public function getSpklMonthly($month, $year, $type){

      if ($month == 1) {
         $monthName = 'January';
      } elseif ($month == 2) {
         $monthName = 'February';
      } elseif ($month == 3) {
         $monthName = 'March';
      } elseif ($month == 4) {
         $monthName = 'April';
      } elseif ($month == 5) {
         $monthName = 'May';
      } elseif ($month == 6) {
         $monthName = 'June';
      } elseif ($month == 7) {
         $monthName = 'July';
      } elseif ($month == 8) {
         $monthName = 'August';
      } elseif ($month == 9) {
         $monthName = 'September';
      } elseif ($month == 10) {
         $monthName = 'October';
      } elseif ($month == 11) {
         $monthName = 'November';
      } elseif ($month == 12) {
         $monthName = 'December';
      } else {
         $monthName = '-';
      }
      $unitTransaction = UnitTransaction::where('unit_id', $this->unit_id)->where('month', $monthName)->where('year', $year)->first();
      if ($unitTransaction) {
         $start = Carbon::create($unitTransaction->cut_from);
         $end = Carbon::create($unitTransaction->cut_to);
         $spkls = Overtime::where('employee_id', $this->id)->whereBetween('date', [$start, $end])->where('type', $type)->sum('hours');
      } else {
         $spkls = 0;
      }
      

      // $spkls = Overtime::where('employee_id', $this->id)->whereMonth('date', $month)->whereYear('date', $year)->where('type', $type)->sum('hours');

      return $spkls;
   }

   public function getKomponenMonthly($month, $year, $komponen){
    
      if ($month == 1) {
         $monthName = 'January';
      } elseif ($month == 2) {
         $monthName = 'February';
      } elseif ($month == 3) {
         $monthName = 'March';
      } elseif ($month == 4) {
         $monthName = 'April';
      } elseif ($month == 5) {
         $monthName = 'May';
      } elseif ($month == 6) {
         $monthName = 'June';
      } elseif ($month == 7) {
         $monthName = 'July';
      } elseif ($month == 8) {
         $monthName = 'August';
      } elseif ($month == 9) {
         $monthName = 'September';
      } elseif ($month == 10) {
         $monthName = 'October';
      } elseif ($month == 11) {
         $monthName = 'November';
      } elseif ($month == 12) {
         $monthName = 'December';
      } else {
         $monthName = '-';
      }



      $total = Transaction::where('employee_id', $this->id)->where('month', $monthName)->where('year', $year)->sum($komponen);

      return formatRupiahB($total);
   }

   public function getProject(){
      $contract = Contract::find($this->contract_id);
      $project = Project::find($contract->project_id);

      if ($project) {
         return $project->name;
      } else {
         return '';
      }
      
   }

   public function tasks()
   {
      return $this->belongsToMany(Task::class)->orderBy('created_at', 'desc');
   }

   public function project(){
      return $this->belongsTo(Project::class);
   }

   public function biodata()
   {
      return $this->belongsTo(Biodata::class);
   }

   public function unit()
   {
      return $this->belongsTo(Unit::class);
   }

   public function department()
   {
      return $this->belongsTo(Department::class);
   }

   public function designation()
   {
      return $this->belongsTo(Designation::class);
   }

   public function contract()
   {
      return $this->belongsTo(Contract::class);
   }

   public function role()
   {
      return $this->belongsTo(Role::class, 'role');
   }

   public function socialAccounts()
   {
      return $this->hasMany(SocialAccount::class);
   }

   public function bankAccounts()
   {
      return $this->hasMany(BankAccount::class);
   }

   public function contactEmergencies()
   {
      return $this->hasMany(Emergency::class);
   }

   public function educationals()
   {
      return $this->hasMany(Educational::class);
   }

   public function emergency()
   {
      return $this->belongsTo(Emergency::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function position()
   {
      return $this->belongsTo(Position::class);
   }

   // Atasan Langsung
   public function direct_leader()
   {
      return $this->belongsTo(Employee::class, 'direct_leader_id');
   }

   public function manager()
   {
      return $this->belongsTo(Employee::class, 'manager_id');
   }



   // HASH MANY 

   public function documents()
   {
      return $this->hasMany(Document::class);
   }

   public function allowances()
   {
      return $this->hasMany(Allowance::class);
   }

   public function commissions()
   {
      return $this->hasMany(Commission::class);
   }

   public function deductions()
   {
      return $this->hasMany(Deduction::class);
   }

   public function reimbursements()
   {
      return $this->hasMany(Reimbursement::class);
   }

   public function kpa()
   {
      return $this->hasMany(PeKpa::class);
   }

   public function presences()
   {
      return $this->hasMany(Presence::class);
   }

   public function spkls()
   {
      return $this->hasMany(Spkl::class);
   }

   public function sps()
   {
      return $this->hasMany(Sp::class);
   }

   public function contracts()
   {
      return $this->hasMany(Contract::class);
   }

   public function mutations()
   {
      return $this->hasMany(Mutation::class);
   }

   public function sub_dept()
   {
      return $this->belongsTo(SubDept::class);
   }
   // public function shift()
   // {
   //    return $this->belongsTo(Shift::class);
   // }

   public function positions()
   {
      return $this->belongsToMany(Position::class);
   }

   public function getLeaders()
   {
      $leaders = EmployeeLeader::where('employee_id', $this->id)->get();
      return $leaders;
   }

   public function getKpi()
   {
      $kpi = PeKpi::find($this->kpi_id);
      return $kpi;
   }


   public function payroll()
   {
      return $this->belongsTo(Payroll::class);
   }

   public function absences()
   {
      return $this->hasMany(Absence::class);
   }

   public function getQpe($semester, $year)
   {
      $qpe = Pe::where('employe_id', $this->id)->where('semester', $semester)->where('tahun', $year)->first();

      return $qpe;
   }

   public function location()
   {
      return $this->belongsTo(Location::class);
   }

   public function deactivate()
   {
      $deactivate = Deactivate::where('employee_id', $this->id)->first();
      return $deactivate;
   }

   public function getOvertimes($from, $to) {
      // dd($to);
      if ($from == 0) {
         // dd('ok');
         $overtimes = Overtime::where('employee_id', $this->id)->orderBy('updated_at', 'desc')->get();
      } else {
         $overtimes = Overtime::where('employee_id', $this->id)->whereBetween('date', [$from, $to])->orderBy('updated_at', 'desc')->get();

      }
      
      return $overtimes;
   }

   public function getAbsences($from, $to) {
      if ($from == 0) {
         $absences = Absence::where('employee_id', $this->id)->orderBy('updated_at', 'desc')->get();
      } else {
         $absences = Absence::where('employee_id', $this->id)->whereBetween('date', [$from, $to])->orderBy('updated_at', 'desc')->get();

      }
      
      return $absences;
   }

   public function getDailyAbsence($date) {
      $absence = Absence::where('employee_id', $this->id)->where('date', $date)->first();
      if ($absence) {
         $absenceName = absenceName($absence);
      } else {
         $absenceName = 'Hadir';
      }
      
      return $absenceName;
   }

   public function getDailyFormAbsence($date) {
      $absence = Absence::where('employee_id', $this->id)->where('date', $date)->first();
      $absenceEmployeeDetail = AbsenceEmployeeDetail::where('date', $date)->first();
      $absenceEmployeeDetail = AbsenceEmployeeDetail::where('date', $date)
                              ->whereHas('absence_employee', function ($q) {
                                 $q->where('employee_id', $this->id);
                              })
                              ->first();
      if ($absenceEmployeeDetail) {
         $absenceEmployee = AbsenceEmployee::find($absenceEmployeeDetail->absence_employee_id);
         
         $status = statusForm($absenceEmployee->status);
         $absenceName = 'Pengajuan ' . absenceName($absenceEmployee) . ' (' . $status . ')';
      } else {
         $absenceEmployee = AbsenceEmployee::where('employee_id', $this->id)->where('date', $date)->first();
         if ($absenceEmployee) {
            $status = statusForm($absenceEmployee->status);
            $absenceName = 'Pengajuan ' . absenceName($absenceEmployee) . ' (' . $status . ')';
         } else {
            $absenceName = 'Tidak ada pengajuan';
         }
         
      }
      
      return $absenceName;
   }

   public function getSpkl($from, $to) {
      if ($from == 0) {
         $spkl = Overtime::where('employee_id', $this->id)->orderBy('updated_at', 'desc')->get();
      } else {
         $spkl = Overtime::where('employee_id', $this->id)->whereBetween('date', [$from, $to])->orderBy('updated_at', 'desc')->get();

      }
      
      return $spkl;
   }

   public function getLembur($id, $from, $to)
   {
      $employees = Employee::where('location_id', $this->id)->where('unit_id', $id)->where('status', 1)->get();
      $total = 0;
      foreach ($employees as $emp) {
         $lemburs =  $emp->getSpkl($from, $to)->where('type', 1);
         foreach($lemburs as $lembur){
            $total = $total + $lembur->hours;
         }
          
       }
      return $total;
   }

   public function getDiscipline($year, $month){
      $peDiscipline = PeDisciplineDetail::where('employe_id', $this->id)->where('tahun', $year)->where('bulan', $month)->first();

      return $peDiscipline;
   }

   public function getDisciplineYear($year){
      $peDisciplines = PeDisciplineDetail::where('employe_id', $this->id)->where('tahun', $year)->get();

      return $peDisciplines;
   }
}
