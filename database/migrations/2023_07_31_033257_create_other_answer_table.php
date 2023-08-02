<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_answer', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('driver_license');
            $table->text('credit');
            $table->text('financial_support');
            $table->text('chronic_illness');
            $table->text('recurring_health_issues');
            $table->text('work_date');
            $table->text('benefit_expectation');
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
        Schema::dropIfExists('other_answer');
    }
}
