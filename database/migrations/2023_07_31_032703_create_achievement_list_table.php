<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('achievement')->nullable();
            $table->text('institution')->nullable();
            $table->text('year')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('achiev_list');
        Schema::dropIfExists('achievement_lists');
    }
}
