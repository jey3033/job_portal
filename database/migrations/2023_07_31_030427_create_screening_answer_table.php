<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screening_answer', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('other_benefits');
            $table->text('work_contract');
            $table->text('close_friend');
            $table->text('company_knowledge');
            $table->text('position_reason');
            $table->text('position_knowledge');
            $table->text('work_environment');
            $table->text('long_plan');
            $table->text('like_person');
            $table->text('dislike_person');
            $table->text('weakness');
            $table->text('strength');
            $table->text('leisure_time');
            $table->text('topic');
            $table->text('reference');
            $table->text('reference_source');
            $table->text('reference_connection');
            $table->text('reference_phone');
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
        Schema::dropIfExists('screening_answer');
    }
}
