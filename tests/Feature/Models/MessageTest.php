<?php

namespace Feature\Models;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_user()
    {
        $user = User::factory()->create();
        $chat = Chat::factory()->create();
        $message = Message::factory()->create(['user_id' => $user->id, 'chat_id' => $chat->id]);

        $this->assertInstanceOf(User::class, $message->user);
        $this->assertEquals($user->getKey(), $message->user->getKey());
    }

    public function test_it_has_a_chat()
    {
        $user = User::factory()->create();
        $chat = Chat::factory()->create();
        $message = Message::factory()->create(['user_id' => $user->getKey(), 'chat_id' => $chat->getKey()]);

        $this->assertInstanceOf(Chat::class, $message->chat);
        $this->assertEquals($chat->getKey(), $message->chat->getKey());
    }
}
