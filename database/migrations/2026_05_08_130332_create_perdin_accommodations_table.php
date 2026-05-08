<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerdinAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perdin_accommodations', function (Blueprint $table) {
            $table->id();

            // Relasi ke perdin / perjalanan dinas
            $table->unsignedBigInteger('perdin_id')->nullable();

             /*
            ======================================================
            TRANSPORT DEPART
            ======================================================
            */
            $table->integer('transport_depart_qty')->nullable()->default(0);
            $table->decimal('transport_depart_nominal', 15, 2)->nullable()->default(0);
            $table->decimal('transport_depart_total', 15, 2)->nullable()->default(0);
            $table->text('transport_depart_note')->nullable();

            /*
            ======================================================
            TRANSPORT RETURN
            ======================================================
            */
            $table->integer('transport_return_qty')->nullable()->default(0);
            $table->decimal('transport_return_nominal', 15, 2)->nullable()->default(0);
            $table->decimal('transport_return_total', 15, 2)->nullable()->default(0);
            $table->text('transport_return_note')->nullable();

            /*
            ======================================================
            UANG MAKAN - PAGI
            ======================================================
            */
            $table->integer('meal_breakfast_qty')->nullable()->default(0);
            $table->decimal('meal_breakfast_nominal', 15, 2)->nullable()->default(0);
            $table->decimal('meal_breakfast_total', 15, 2)->nullable()->default(0);
            $table->text('meal_breakfast_note')->nullable();

            /*
            ======================================================
            UANG MAKAN - SIANG
            ======================================================
            */
            $table->integer('meal_lunch_qty')->nullable()->default(0);
            $table->decimal('meal_lunch_nominal', 15, 2)->nullable()->default(0);
            $table->decimal('meal_lunch_total', 15, 2)->nullable()->default(0);
            $table->text('meal_lunch_note')->nullable();

            /*
            ======================================================
            UANG MAKAN - MALAM
            ======================================================
            */
            $table->integer('meal_dinner_qty')->nullable()->default(0);
            $table->decimal('meal_dinner_nominal', 15, 2)->nullable()->default(0);
            $table->decimal('meal_dinner_total', 15, 2)->nullable()->default(0);
            $table->text('meal_dinner_note')->nullable();

            /*
            ======================================================
            AKOMODASI HARIAN
            ======================================================
            */
            $table->integer('daily_accommodation_qty')->nullable()->default(0);
            $table->decimal('daily_accommodation_nominal', 15, 2)->nullable()->default(0);
            $table->decimal('daily_accommodation_total', 15, 2)->nullable()->default(0);
            $table->text('daily_accommodation_note')->nullable();

            /*
            ======================================================
            GRAND TOTAL
            ======================================================
            */
            $table->decimal('grand_total', 15, 2)->nullable()->default(0);
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
        Schema::dropIfExists('perdin_accommodations');
    }
}
