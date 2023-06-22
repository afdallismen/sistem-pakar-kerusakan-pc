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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table
                ->float('mb', 2, 2)
                ->default(0);
            $table
                ->float('md', 2, 2)
                ->default(0);
            $table->unsignedBigInteger('kerusakan_id');
            $table
                ->foreign('kerusakan_id')
                ->references('id')
                ->on('kerusakans')
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
        Schema::dropIfExists('rules');
    }
};
