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
        Schema::create('solusi_kerusakans', function (Blueprint $table) {
            $table->id();
            $table->text('deskripsi');
            $table->unsignedBigInteger('kerusakan_id');
            $table
                ->foreign('kerusakan_id')
                ->references('id')
                ->on('kerusakans')
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
        Schema::dropIfExists('solusi_kerusakans');
    }
};
