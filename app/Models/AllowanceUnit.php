<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceUnit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function unit(){
      return $this->belongsTo(Unit::class);
    }

    public function createdBy(){
      return $this->belongsTo(Employee::class, 'created_by');
    }
}
