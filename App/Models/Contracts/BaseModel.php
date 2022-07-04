<?php

namespace App\Models\Contracts;

abstract class BaseModel implements CrudInterface
{
    protected $connection;
    protected string $primaryKey;
    protected string $table;
    protected array $attributes = [];
}
