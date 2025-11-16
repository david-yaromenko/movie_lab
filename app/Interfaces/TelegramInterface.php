<?php

namespace App\Interfaces;

interface TelegramInterface{

    public function create(int $chatId, string $userName);
    public function getTelegramUsersId();
}