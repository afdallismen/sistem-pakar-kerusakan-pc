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
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->text('deskripsi');
            $table
                ->float('cf', 1, 2)
                ->default(0);
            $table
                ->unsignedBigInteger('kerusakan_id')
                ->nullable();
            $table
                ->foreign('kerusakan_id')
                ->references('id')
                ->on('kerusakans')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasis');
    }
};
