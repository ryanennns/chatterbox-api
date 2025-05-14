<?php

namespace Feature\Models;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_many_chats()
    {
        $user = User::factory()->create();
        $chat1 = Chat::factory()->create();
        $chat2 = Chat::factory()->create();

        $user->chatUsers()->create(['chat_id' => $chat1->id]);
        $user->chatUsers()->create(['chat_id' => $chat2->id]);

        $this->assertCount(2, $user->chats);
        $this->assertTrue($user->chats->contains($chat1));
        $this->assertTrue($user->chats->contains($chat2));
    }
}
