<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospectos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('empresa');
            $table->text('contacto');
            $table->text('telefono');
            $table->text('correo');
            $table->unsignedInteger('procedencia');
            $table->unsignedInteger('industria');
            $table->double('valor');
            $table->unsignedInteger('etapa_id');
            $table->text('estatus');
            $table->unsignedInteger('userid');
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
        Schema::dropIfExists('prospectos');
    }
}
