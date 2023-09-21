<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

class TodoRepository implements TodoRepositoryInterface
{
    /**
     * @return Todo[]
     */
    public function get(): array
    {
        return Todo::where('user_id', auth()->user()->id)
                ->orderBy('is_completed', 'asc')
                ->latest()->get()->toArray();
    }

    public function create(array $data): Todo
    {
        return Todo::insert($data);
    }

    public function update(array $data, Todo $Todo): bool
    {
        return $Todo->update($data);
    }

    public function delete(Todo $Todo): bool
    {
        return $Todo->delete();
    }
}
