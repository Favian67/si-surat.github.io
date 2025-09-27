<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('penerima');
            $table->date('tanggal_surat');

            // Relasi ke perihal
            $table->unsignedBigInteger('perihal_id');
            $table->foreign('perihal_id')
                  ->references('id')
                  ->on('perihals')
                  ->onDelete('cascade');

            // Relasi ke user (pembuat surat)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->string('file')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
