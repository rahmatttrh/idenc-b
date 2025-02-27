<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipReport extends Model
{
   use HasFactory;

   protected $guarded = [];

   public function unit_transaction(){
      return $this->belongsTo(UnitTransaction::class);
   }

   public function location(){
      return $this->belongsTo(Location::class);
   }
}
