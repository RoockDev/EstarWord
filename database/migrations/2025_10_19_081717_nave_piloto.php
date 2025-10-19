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
        Schema::create('nave_piloto', function(Blueprint $table){
            $table->unsignedBigInteger('nave_id');
            $table->unsignedBigInteger('piloto_id');
            $table->date('fecha_asociacion');
            $table->date('fecha_fin_asociacion')->nullable();
            $table->foreign('nave_id')->references('id')->on('naves')->onDelete('cascade');
            $table->foreign('piloto_id')->references('id')->on('pilotos')->onDelete('cascade');
            $table->primary(['nave_id','piloto_id']);
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
