<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
   use HasFactory;
   protected $guarded = [];

   public function employee()
   {
      return $this->belongsTo(Employee::class);
   }

   public function allowanceUnit(){
      return $this->belongsTo(AllowanceUnit::class, 'allowance_unit_id');
   }

   public function location()
   {
      return $this->belongsTo(Location::class);
   }

   public function position()
   {
      return $this->belongsTo(Position::class);
   }
}
