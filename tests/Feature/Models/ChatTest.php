<?php

namespace Feature\Models;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_one_user()
    {
        $chat = Chat::factory()->create();
        $chat->chatUsers()->create([
            'user_id' => User::factory()->create()->getKey(),
            'chat_id' => $chat->getKey(),
        ])->save();

        $this->assertDatabaseHas(
            'chat_users',
            [
                'user_id' => User::first()->getKey(),
                'chat_id' => $chat->getKey(),
            ]
        );
        $this->assertEquals(
            $chat->users()->first()->getKey(),
            User::query()->first()->getKey()
        );
    }

    public function test_it_has_many_messages()
    {
        /** @var Chat $chat */
        $user = User::factory()->create();
        $chat = Chat::factory()->create();
        $chat->messages()->create(Message::factory()->raw(['user_id' => $user->getKey()]));

        $this->assertDatabaseHas(
            'messages',
            [
                'user_id' => $user->getKey(),
                'chat_id' => $chat->getKey(),
            ]
        );
        $this->assertEquals(
            $chat->messages()->first()->getKey(),
            Message::query()->first()->getKey()
        );
    }
}
