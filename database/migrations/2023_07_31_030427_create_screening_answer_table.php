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
        Schema::create('screening_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('other_benefits')->nullable();
            $table->text('work_contract')->nullable();
            $table->text('close_friend')->nullable();
            $table->text('company_knowledge')->nullable();
            $table->text('position_reason')->nullable();
            $table->text('position_knowledge')->nullable();
            $table->text('work_environment')->nullable();
            $table->text('long_plan')->nullable();
            $table->text('like_person')->nullable();
            $table->text('dislike_person')->nullable();
            $table->text('weakness')->nullable();
            $table->text('strength')->nullable();
            $table->text('leisure_time')->nullable();
            $table->text('topic')->nullable();
            $table->text('reference')->nullable();
            $table->text('reference_source')->nullable();
            $table->text('reference_connection')->nullable();
            $table->text('reference_phone')->nullable();
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
        Schema::dropIfExists('screening_answers');
    }
}
