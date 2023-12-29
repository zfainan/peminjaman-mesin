<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'meminjam';

    protected $fillable = ['id_mesin', 'id_karyawan', 'tgl_pinjam'];

    protected $casts = [
        'tgl_pinjam' => 'datetime',
        'tgl_kembali' => 'datetime',
    ];

    public function status(): Attribute
    {
        return Attribute::make(fn () => $this->tgl_kembali ? 'Dikembalikan' : 'Belum Dikembalikan');
    }

    public function mesin(): BelongsTo
    {
        return $this->belongsTo(Mesin::class, 'id_mesin');
    }

    public function peminjam(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_karyawan');
    }
}
