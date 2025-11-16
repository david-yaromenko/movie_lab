<?php

namespace App\Listeners;

use App\Events\MovieCreated;
use App\Models\TelegramUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\TelegramNewMovieNotification;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Log;

class SendNewMovieNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(protected TelegramService $telegramService)
    {
        
    }

    public function handle(MovieCreated $event)
    {
        $movie = $event->movie;

        $users = $this->telegramService->getTelegramUsersId();

        foreach ($users as $user) {
        try {
            $user->notify(new TelegramNewMovieNotification($movie));
        } catch (\Throwable $e) {
            Log::error("Помилка при відправці TelegramNotification: ".$e->getMessage(), [
                'user' => $user->id,
                'movie' => $movie,
            ]);
        }
    }
    }
}
