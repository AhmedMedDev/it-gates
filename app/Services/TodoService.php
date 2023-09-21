<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Todo;
use App\Repositories\TodoRepository;

class TodoService
{
    private TodoRepository $TodoRepository;

    public function __construct(TodoRepository $TodoRepository)
    {
        $this->TodoRepository = $TodoRepository;
    }

    /**
     * @return Todo[]
     */
    public function getTodos(): array
    {
        return $this->TodoRepository->get();
    }

    public function store(array $data): Todo
    {
        return $this->TodoRepository->create($data);
    }

    public function update(array $request, Todo $Todo): bool
    {
        return $this->TodoRepository->update($request, $Todo);
    }

    public function delete(Todo $Todo): void
    {
        $this->TodoRepository->delete($Todo);
    }
}
