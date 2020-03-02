<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Laravel\Passport\Passport;

class TicketTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate',['-vvv' => true]);
        \Artisan::call('passport:install',['-vvv' => true]);
        \Artisan::call('db:seed',['-vvv' => true]);
    }

    public function testCreateTicket()
    {
        $response = $this->createTicket();        
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ]);
    }

    public function testRemeedTicketByInvalidUUID()
    {
        $data = [
            'uuid' => 'wrong-uuid',            
        ];
        $user = User::find(1);
        Passport::actingAs(
            $user,
            ['create-servers']
        );
        $response = $this->postJson(route('ticket.redeem'), $data);
        // $response->dump();
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => false,
            ]);
    }


    public function testRemeedTicketByValidUUID()
    {
        $response = $this->createTicket(); 
        
        $response
        ->assertStatus(200)
        ->assertJson([
            'status' => true
            ]);
        $data = $response->decodeResponseJson();
        
        $responseRedeem = $this->postJson(route('ticket.redeem'), ['uuid' => $data['uuid']]);
        // $responseRedeem->dump();
        $responseRedeem
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
                'messages' => ['The ticket is deemed successful']
            ]);
        
        $responseRedeem2 = $this->postJson(route('ticket.redeem'), ['uuid' => $data['uuid']]);
        // $responseRedeem2->dump();
        $responseRedeem2
            ->assertStatus(200)
            ->assertJson([
                'status' => false,
                'messages' => ['The ticket already is redeemed']
            ]);
    }

    public function testUnauthorizedCreateTicket() {
        $data = [
            'email' => 'test@mail.com',
            'fname' => 'Jhon',
            'lname' => 'Baggit',
        ];
        $response = $this->postJson(route('ticket.create'), $data);
        $response->assertStatus(401);
    }

    private function createTicket() {
        $data = [
            'email' => 'test@mail.com',
            'fname' => 'Jhon',
            'lname' => 'Baggit',
        ];
        $user = User::find(1);
        Passport::actingAs(
            $user,
            ['create-servers']
        );

        return $this->postJson(route('ticket.create'), $data);
    }
}
