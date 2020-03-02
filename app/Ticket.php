<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'uuid', 'user_id'];

    private static function generateUUID(): string
    {
        return Str::uuid()->toString();        
    }

    public static function createTicket(string $firstName, string $lastName, string $email, int $userId): Ticket
    {
        $ticket = self::create([
            'first_name' => $firstName, 
            'last_name' => $lastName,
            'email' => $email, 
            'uuid' => self::generateUUID(),
            'user_id' => $userId
        ]);

        return $ticket;
    }

    public static function redeem(string $uuid): array 
    {
        if ($ticket = self::where('uuid', $uuid)->first()) {
            if ($ticket->is_redeemed) {
                return ['status' => false, 'messages' => ['The ticket already is redeemed']];
            }
            $ticket->is_redeemed = true;
            $ticket->save();
            return ['status' => true, 'messages' => ['The ticket is deemed successful']];
        }
        return ['status' => false, 'messages' => ['The ticket not found']];
    }
}
