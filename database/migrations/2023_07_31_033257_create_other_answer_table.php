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
        Schema::create('other_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('residence')->nullable();
            $table->text('transportation')->nullable();
            $table->text('driver_license')->nullable();
            $table->text('credit')->nullable();
            $table->text('financial_support')->nullable();
            $table->text('chronic_illness')->nullable();
            $table->text('recurring_health_issues')->nullable();
            $table->text('work_date')->nullable();
            $table->text('benefit_expectation')->nullable();
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
        Schema::dropIfExists('other_answers');
    }
}
