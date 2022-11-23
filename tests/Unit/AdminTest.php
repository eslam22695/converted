<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check Admin Logged
     */
    public function test_if_admin_logged_in()
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
    }

    /**
     * Check User Not Logged
     */
    public function test_if_user_not_logged_in()
    {
        //Create user
        $user = User::factory()->create([
            'password' => Hash::make('12345678'),
        ]);

        //Do Login
        $response = $this->post('login',[
            'email' => $user->email,
            'password' => '12345678'
        ]);

        //Ckeck Not login
        $response->assertStatus(302);
    }
}
