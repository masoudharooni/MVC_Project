<?php

namespace App\Models\Contracts;

abstract class BaseModel implements CrudInterface
{
    protected $connection;
    protected string $primaryKey = 'id';
    protected string $table;
    protected array $attributes = [];
}
