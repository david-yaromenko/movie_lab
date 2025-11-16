<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TelegramUser extends Model
{
    use Notifiable;

    protected $table = 'telegram_user';

    protected $fillable = [
        'name',
        'chat_id',
    ];
}
