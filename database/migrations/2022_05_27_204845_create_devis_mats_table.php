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
        Schema::create('devis_mats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('responsable');
            $table->double('superficie', 8, 5);
            $table->double('qts', 8, 5);
            $table->unsignedBigInteger('mat_id');
            $table->timestamps();

            // foreign
            $table->foreign('mat_id')
                ->references('id')
                ->on('mats')
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
        Schema::dropIfExists('devis_mats');
    }
};