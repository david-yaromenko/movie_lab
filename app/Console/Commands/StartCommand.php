<?php

namespace App\Console\Commands;

use App\Services\TelegramService;
use Telegram\Bot\Commands\Command;


class StartCommand extends Command
{
    public function __construct(protected TelegramService $telegramService) {}

    protected string $name = 'start';
    protected string $description = 'Bot hello';

    public function handle(): void
    {
        $chatId = $this->update->getMessage()->getChat()->getId();
        $userName = $this->update->getMessage()->getChat()->getFirstName();

        $this->telegramService->create($chatId, $userName);

        $this->replyWithMessage([
            'text' => "Привіт, {$userName}! 🎬 Я бот MovieLab. Буду тобі надсилати нові фільми, які з'являються у нас на сайті!"
        ]);
    }
}
