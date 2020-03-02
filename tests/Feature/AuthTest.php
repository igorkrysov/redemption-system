<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;

class AuthTest extends TestCase
{

    use DatabaseMigrations;
    // use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate',['-vvv' => true]);
        \Artisan::call('passport:install',['-vvv' => true]);
        \Artisan::call('db:seed',['-vvv' => true]);
    }

    
    public function testLogin()
    {
        $data = [
            'email' => 'test@mail.com',
            // 'name' => 'test',
            'password' => 'secret',
        ];
        // User::create($data);
        
        $response = $this->postJson(route('login'), $data);

        // $response->dump();
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ]);
    }

    public function testFailLogin()
    {
        $data = [
            'email' => 'test@mail.com',
            'password' => 'secret',
        ];
        $response = $this->postJson(route('login'), $data);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ]);
    }
}
