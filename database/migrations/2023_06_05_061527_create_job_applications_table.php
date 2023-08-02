<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('user_short_desc')->nullable();
            $table->text('profile_path')->nullable();
            $table->text('id_city')->nullable();
            $table->text('gender')->nullable();
            $table->text('tax_number')->nullable();
            $table->date('birthdate')->nullable();
            $table->text('birthplace')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_type')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('race')->nullable();
            $table->string('residence_phone')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('wedding_date')->nullable();
            $table->text('address')->nullable();
            $table->text('real_address')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkedin')->nullable();
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
        Schema::dropIfExists('job_applications');
    }
}
