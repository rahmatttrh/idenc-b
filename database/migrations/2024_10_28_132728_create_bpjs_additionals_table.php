<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBpjsAdditionalsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('bpjs_additionals', function (Blueprint $table) {
         $table->id();
         $table->integer('employee_id');
         $table->string('description');
         $table->decimal('employee');
         $table->decimal('company');
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('bpjs_additionals');
   }
}
