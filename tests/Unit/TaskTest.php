<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;use App\Http\Controllers\Admin\TaskController;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * get tasks
     */
    public function test_get_tasks_if_admin_logged_in()
    {
        //Create Admin
        $admin = User::factory()->create([
            'password' => Hash::make('12345678'),
            'is_admin' => true
        ]);

        //Do Login
        $response = $this->post('login',[
            'email' => $admin->email,
            'password' => '12345678'
        ]);

        //Ckeck login
        $response->assertRedirect('/home');

        $response = $this->get(route('task.index'));

        $response->assertStatus(200);
    }
}
