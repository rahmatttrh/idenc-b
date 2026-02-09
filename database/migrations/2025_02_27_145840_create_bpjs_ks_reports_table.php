<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBpjsKsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bpjs_ks_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_transaction_id');
            $table->integer('location_id');
            $table->string('location_name');
            $table->string('program');
            $table->string('tarif');
            $table->integer('qty');
            $table->integer('upah');
            $table->integer('perusahaan');
            $table->integer('karyawan');
            $table->integer('total_iuran');
            $table->integer('additional_qty')->nullable();
            $table->integer('additional_iuran')->nullable();
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
        Schema::dropIfExists('bpjs_ks_reports');
    }
}
