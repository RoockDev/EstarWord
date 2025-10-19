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
        Schema::create('mantenimientos', function(Blueprint $table){
            $table->id();
            $table->date('fecha');
            $table->text('descripcion');
            $table->decimal('coste',8,2);
            $table->unsignedBigInteger('nave_id');
            $table->foreign('nave_id')->references('id')->on('naves')->onDelete('cascade');
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
