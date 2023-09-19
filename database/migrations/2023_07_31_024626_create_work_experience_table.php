<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('period')->nullable();
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->text('net_benefits')->nullable();
            $table->text('leave_reason')->nullable();
            $table->text('duties')->nullable();
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
        Schema::dropIfExists('work_experience');
        Schema::dropIfExists('work_experiences');
    }
}
