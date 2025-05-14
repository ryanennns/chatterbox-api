<?php

namespace App\Models;

// 56157

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Chat extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            ChatUser::class,
            'chat_id',
            'id',
            'id',
            'user_id',
        );
    }

    public function chatUsers(): HasMany
    {
        return $this->hasMany(ChatUser::class);
    }
}
