<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->bigIncrements('id');       
            $table->unsignedInteger('prospecto_id');
            $table->date('fecha');
            $table->unsignedInteger('etapa_id');
            $table->unsignedInteger('etapa_anterior_id');
            $table->unsignedInteger('dias');
            $table->unsignedInteger('user_id');
            $table->text('nota');
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
        Schema::dropIfExists('bitacoras');
    }
}
