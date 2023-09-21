<?php

declare(strict_types=1);

use App\Models\Todo;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodosControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching todos.
     *
     * @return void
     */
    public function test_fetching_todos()
    {
        $user = User::create([
            'name' => 'jr user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user);

        $response = $this->get('/api/todos');

        $response->assertStatus(200);
        $response->assertJsonStructure(['payload' => []]);
    }

    /**
     * Test creating a todo.
     *
     * @return void
     */
    public function test_creating_a_todo()
    {
        $user = User::create([
            'name' => 'jr user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user);

        $response = $this->post('/api/todos', [
            'title' => 'New Todo',
            'notes' => 'Todo notes',
            'due_date' => '2023-12-31',
            'is_completed' => false,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'payload' => []]);

        $this->assertDatabaseHas('todos', [
            'title' => 'New Todo',
            'notes' => 'Todo notes',
            'due_date' => '2023-12-31',
            'is_completed' => false,
            'user_id' => $user->id,
        ]);
    }
    /**
     * Test updating a todo.
     *
     * @return void
     */
    public function test_updating_a_todo()
    {
        $user = User::create([
            'name' => 'jr user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user);

        $todo = Todo::create([
            'title' => 'Test Todo',
            'notes' => 'Test notes',
            'due_date' => '2023-12-31',
            'is_completed' => false,
            'user_id' => $user->id,
        ]);

        $response = $this->put("/api/todos/{$todo->id}", [
            'title' => 'Updated Todo',
            'notes' => 'Updated notes',
            'due_date' => '2023-12-31',
            'is_completed' => true,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'Updated Todo',
            'notes' => 'Updated notes',
            'due_date' => '2023-12-31',
            'is_completed' => true,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test deleting a todo.
     *
     * @return void
     */
    public function test_deleting_a_todo()
    {
        $user = User::create([
            'name' => 'jr user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user);

        $todo = Todo::create([
            'title' => 'Test Todo',
            'notes' => 'Test notes',
            'due_date' => '2023-12-31',
            'is_completed' => false,
            'user_id' => $user->id,
        ]);

        $response = $this->delete("/api/todos/{$todo->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);

        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }

    /**
     * Test validation when creating a todo.
     *
     * @return void
     */
    public function test_todo_creation_validation()
    {
        $user = User::create([
            'name' => 'jr user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user);

        $response = $this->postJson('/api/todos', [
            'notes' => 'Todo notes',
            'due_date' => '2023-12-31',
            'is_completed' => false,
        ]);

        $response->assertStatus(422);

    }

    /**
     * Test validation when updating a todo.
     *
     * @return void
     */
    public function test_todo_update_validation()
    {
        $user = User::create([
            'name' => 'jr user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user);

        $todo = Todo::create([
            'title' => 'Test Todo',
            'notes' => 'Test notes',
            'due_date' => '2023-12-31',
            'is_completed' => false,
            'user_id' => $user->id,
        ]);

        $response = $this->putJson("/api/todos/{$todo->id}", [
            'due_date' => 'test date validation',
        ]);

        $response->assertStatus(422);
    }
}
