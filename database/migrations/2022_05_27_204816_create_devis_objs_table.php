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
        Schema::create('devis_objs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('obj_id');
            $table->string('nom');
            $table->string('responsable');
            $table->string('ecartement');
            $table->string('ha');
            $table->double('qts_totale', 8, 5);
            $table->timestamps();

            // foreign
            $table->foreign('obj_id')
                ->references('id')
                ->on('objets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devis_objs');
    }
};