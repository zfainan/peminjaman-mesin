<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mesin extends CrudModel
{
    use HasUuids;

    protected $table = 'mesin';

    protected $guarded = ['id'];

    public function isAvailable(): Attribute
    {
        return Attribute::make(function () {
            if ($this->borrowed?->count() > 0) {
                return $this->borrowed->filter(fn($borrow) => $borrow->tgl_kembali == null)
                    ->count() < 1;
            } else {
                return true;
            }
        });
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }

    public function borrowed(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'id_mesin');
    }
}
