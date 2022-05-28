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
        Schema::create('demande_forage_eaus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_postulant');
            $table->string('prenom');
            $table->bigInteger('cin');
            $table->dateTime('date')->default(Carbon::now());
            $table->dateTime('date_disposition')->default(Carbon::now());
            $table->string('adresse');
            $table->string('tel');
            $table->bigInteger('gouvernorat');
            $table->string('decanat');
            $table->double('superficie', 8, 5);
            $table->string('type_projet');
            $table->string('remarque');
            $table->string('type_plante');
            $table->dateTime('date_signature')->default(Carbon::now());
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
        Schema::dropIfExists('demande_forage_eaus');
    }
};