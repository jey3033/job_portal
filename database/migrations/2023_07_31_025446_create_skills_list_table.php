<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_list', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('skill')->nullable();
            $table->text('specification')->nullable();
            $table->text('level')->nullable();
            $table->text('certificate')->nullable();
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
        Schema::dropIfExists('skill_list');
    }
}
