<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowanceUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowance_units', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->integer('unit_id');
            $table->integer('type');
            $table->string('month');
            $table->string('year');
            $table->integer('qty');
            $table->integer('qty_hour');
            $table->integer('qty_day');
            $table->integer('total');
            $table->string('area');
            $table->string('doc');

            $table->integer('created_by');
            $table->dateTime('created_date');
            $table->integer('approve_one_id');
            $table->dateTime('approve_one_date');
            $table->integer('approve_two_id');
            $table->dateTime('approve_two_date');
            $table->integer('approve_three_id');
            $table->dateTime('approve_three_date');
            $table->integer('approve_four_id');
            $table->dateTime('approve_four_date');

            $table->integer('reject_by');
            $table->integer('reject_desc');
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
        Schema::dropIfExists('allowance_units');
    }
}
