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
        Schema::create('meminjam', function (Blueprint $table) {
            $table->unsignedBigInteger('id_karyawan');
            $table->uuid('id_mesin');
            $table->dateTime('tgl_pinjam');
            $table->dateTime('tgl_kembali')->nullable();
            $table->timestamps();

            $table->foreign('id_karyawan')
                ->references('id')
                ->on('karyawan');
            $table->foreign('id_mesin')
                ->references('id')
                ->on('mesin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meminjam');
    }
};
