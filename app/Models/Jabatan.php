<?php

namespace App\Models;

class Jabatan extends CrudModel
{
    protected $table = 'jabatan';

    protected $guarded = ['id_'];

    protected $primaryKey = 'id_';
}
