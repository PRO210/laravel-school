<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classificacaos', function (Blueprint $table) {
            $table->id();
            $table->string('STATUS');
            $table->string('ORDEM_I')->nullable();
            $table->string('ORDEM_II')->nullable();
            $table->string('ORDEM_III')->nullable();
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
        Schema::dropIfExists('classificacaos');
    }
}
