<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class Requester extends BaseModel
{
    use Notifiable;

    public static function findOrCreate($name, $email = null, $phoneNumber = null, $uuid = null)
    {
        return self::firstOrCreate([
            'email' => $email,
            'name' => $name,
            'phone_number' => $phoneNumber,
            'uuid' => $uuid,
        ]);
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function openTickets()
    {
        return $this->tickets()->where('status', '<', Ticket::STATUS_SOLVED);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function solvedTickets()
    {
        return $this->tickets()->where('status', '=', Ticket::STATUS_SOLVED);
    }

    public function closedTickets()
    {
        return $this->tickets()->where('status', '=', Ticket::STATUS_CLOSED);
    }

    public function shouldBeNotified()
    {
        return $this->no_reply == false;
    }
}
