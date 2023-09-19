<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->text('name')->nullable();
            $table->text('position')->nullable();
            $table->text('duties')->nullable();
            $table->text('location')->nullable();
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
        Schema::dropIfExists('org_history');
        Schema::dropIfExists('organization_histories');
    }
}
