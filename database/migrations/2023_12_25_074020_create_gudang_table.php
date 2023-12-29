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
        Schema::create('gudang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gudang')->nullable();
            $table->string('lokasi_gudang')->nullable();
            $table->unsignedBigInteger('id_petugas_gudang')->nullable();
            $table->timestamps();

            $table->foreign('id_petugas_gudang')
                ->references('id')
                ->on('karyawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gudang');
    }
};
