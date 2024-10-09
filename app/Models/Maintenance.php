<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends CrudModel
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_mesin', 'description', 'in_progress'];

    public function mesin(): BelongsTo
    {
        return $this->belongsTo(Mesin::class, 'id_mesin');
    }
}
