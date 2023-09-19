<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationBackgroundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('name')->nullable();
            $table->text('location')->nullable();
            $table->text('enroll')->nullable();
            $table->text('graduate')->nullable();
            $table->text('major')->nullable();
            $table->text('degree')->nullable();
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
        Schema::dropIfExists('education_background');
        Schema::dropIfExists('education_backgrounds');
    }
}
