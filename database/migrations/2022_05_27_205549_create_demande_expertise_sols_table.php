<?php

use Carbon\Carbon;
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
        Schema::create('demande_expertise_sols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_postulant');
            $table->bigInteger('cin');
            $table->dateTime('date')->default(Carbon::now());
            $table->string('adresse');
            $table->string('tel');
            $table->bigInteger('num_frais_im');
            $table->string('local');
            $table->string('endroit');
            $table->string('decanat');
            $table->string('delegation');
            $table->double('superficie', 8, 5);
            $table->string('ut_act_sol');
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
        Schema::dropIfExists('demande_expertise_sols');
    }
};