<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('relation')->nullable();
            $table->text('name')->nullable();
            $table->text('pdob')->nullable();
            $table->text('age')->nullable();
            $table->text('gender')->nullable();
            $table->text('job')->nullable();
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
        Schema::dropIfExists('family');
        Schema::dropIfExists('families');
    }
}
