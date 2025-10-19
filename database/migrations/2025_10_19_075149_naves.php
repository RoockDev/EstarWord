<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('naves', function (Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->string('modelo');
            $table->integer('tripulacion');
            $table->integer('pasajeros');
            $table->string('clase_nave');
            $table->unsignedBigInteger('planeta_id');
            $table->foreign('planeta_id')->references('id')->on('planetas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
