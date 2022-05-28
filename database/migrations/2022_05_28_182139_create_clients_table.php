<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string('gender');
            $table->tinyInteger('tn_abroad');
            $table->string('country');
            $table->string('birthday_date');
            $table->string('study_grade');
            $table->string('diploma');
            $table->string('capacity');
            $table->string('social_purpose');
            $table->string('cin');
            $table->string('cin_place');
            $table->string('adresse');
            $table->string('city');
            $table->string('code_postal');
            $table->string('phone_number');
            $table->string('fax');
            $table->string('email');
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
        Schema::dropIfExists('clients');
    }
};