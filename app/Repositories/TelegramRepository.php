<?php

namespace App\Repositories;

use App\Interfaces\TelegramInterface;
use App\Models\TelegramUser;

class TelegramRepository implements TelegramInterface
{
    public function create(int $chatId, string $userName)
    {

        return TelegramUser::updateOrCreate(
            [
                'chat_id' => $chatId,
                'name' => $userName
            ]
        );
    }

    public function getTelegramUsersId()
    {

        $users = TelegramUser::whereNotNull('chat_id')->get();

        return $users;
    }
}
