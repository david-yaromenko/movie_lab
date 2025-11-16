<?php

namespace App\Services;

use App\Interfaces\TelegramInterface;

class TelegramService
{

    public function __construct(protected TelegramInterface $telegramInterface) {}

    public function create(int $chatId, string $userName)
    {

        return $this->telegramInterface->create($chatId, $userName);
    }

    public function getTelegramUsersId()
    {
        return $this->telegramInterface->getTelegramUsersId();
    }
}
