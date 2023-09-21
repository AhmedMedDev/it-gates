<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Todo;

interface TodoRepositoryInterface
{
    /**
     * @return Todo[]
     */
    public function get(): array;
    public function create(array $data): Todo;
    public function update(array $data, Todo $todo): bool;
    public function delete(Todo $todo): bool;
}
