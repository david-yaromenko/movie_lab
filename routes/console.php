<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('bot:poll', function () {

    $this->info('Bot polling started...');
    Telegram::getUpdates(['offset' => -1]);

    while (true) {

        $updates = Telegram::getUpdates();

        foreach ($updates as $update) {

            $text = $update->getMessage()?->getText();
            $this->info("Got message: " . ($text ?? 'no text'));

            Telegram::commandsHandler();
        }
        sleep(2);
    }
});