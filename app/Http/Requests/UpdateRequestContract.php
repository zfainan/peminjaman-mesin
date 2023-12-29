<?php

declare(strict_types=1);

namespace App\Http\Requests;

interface UpdateRequestContract
{
    public function all();

    public function validated();

    public function input(string $field, mixed $default = null);

    public function except(string $field);

    public function rules();

    public function merge(array $input);

    public function only(array $keys);
}
