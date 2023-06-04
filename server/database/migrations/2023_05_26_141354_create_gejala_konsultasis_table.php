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
        Schema::create('gejala_konsultasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('konsultasi_id');
            $table
                ->foreign('konsultasi_id')
                ->references('id')
                ->on('konsultasis')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('gejala_id');
            $table
                ->foreign('gejala_id')
                ->references('id')
                ->on('gejalas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gejala_konsultasis');
    }
};
