<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramNewMovieNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected array $movie)
    {
        // $this->movie = $movie;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toTelegram(object $notifiable): TelegramMessage
    {
        $titleEng = is_array($this->movie['title'])
            ? ($this->movie['title']['en'])
            : $this->movie['title']['uk'];

        $titleUk = is_array($this->movie['title'])
            ? ($this->movie['title']['uk'])
            : $this->movie['title']['en'];
        
        return TelegramMessage::create()
            ->to((int) $notifiable->chat_id)
            ->content("Хей!\n".
            "В нас на сайті новий фільм: {$titleUk} / {$titleEng}.\n".
            "Гарного перегляду!\n");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
