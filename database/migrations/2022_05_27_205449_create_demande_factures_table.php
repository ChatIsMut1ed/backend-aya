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
        Schema::create('demande_factures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('qts', 8, 5);
            $table->DateTime('date')->default(Carbon::now());
            $table->string('doit');
            $table->unsignedBigInteger('act_id');
            $table->unsignedBigInteger('des_soc');
            $table->unsignedBigInteger('var_chang');
            $table->timestamps();

            // foreign
            $table->foreign('act_id')
                ->references('id')
                ->on('activites')
                ->onDelete('cascade');
            $table->foreign('des_soc')
                ->references('id')
                ->on('description_societes')
                ->onDelete('cascade');
            $table->foreign('var_chang')
                ->references('id')
                ->on('variable_changeantes')
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
        Schema::dropIfExists('demande_factures');
    }
};