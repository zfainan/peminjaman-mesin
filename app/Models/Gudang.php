<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gudang extends CrudModel
{
    protected $table = 'gudang';

    protected $guarded = ['id'];

    protected $with = ['petugas'];

    public function namaPetugas(): Attribute
    {
        return Attribute::make(fn () => $this->petugas?->nama);
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_petugas_gudang');
    }
}
