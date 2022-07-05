<?php

namespace App\Models\Contracts;

interface CrudInterface
{
    # Create
    public function create(array $data): int;

    # Read 
    public function find(int $id, string|array $columns = '*'): object;

    public function get(array $where = [], string|array $columns = '*'): array;

    # Update 
    public function update(array $data, array $where): int;

    # Delete
    public function delete(array $where): int;
}
