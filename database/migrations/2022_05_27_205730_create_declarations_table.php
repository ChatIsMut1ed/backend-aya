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
        Schema::create('declarations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('resg_Dec');
            $table->string('resg_Enr');
            $table->string('resg_projet');
            $table->string('licence_projet');
            $table->string('lieu_projet');
            $table->string('emplois');
            $table->string('caracte_projet');
            $table->string('struct_finance');
            $table->string('declaration_equip');
            $table->string('mat_per_semi');
            $table->string('calendrier');
            $table->string('resg_inst_droite');
            $table->string('liv_cert_per_inves');
            $table->string('incitation_requises');
            $table->string('repar_capital_social');
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
        Schema::dropIfExists('declarations');
    }
};