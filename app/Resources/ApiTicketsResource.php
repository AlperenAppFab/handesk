<?php


namespace App\Resources;


use App\Ticket;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ApiTicketsResource
 *
 * @property-read Ticket $resource
 *
 * @package App\Resources
 */
class ApiTicketsResource extends Resource
{
    public function toArray($request)
    {
        $ticket = $this->resource;
        return [
            'id'        => $ticket->id,
            'title'     => $ticket->title,
            'body'      => $ticket->body,
            'rating'    => $ticket->rating,
            'status'    => $ticket->statusName(),
            'priority'  => $ticket->priorityName(),
            'type'      => $ticket->type(),
            'requester' => [
                'id'           => $ticket->requester->id,
                'name'         => $ticket->requester->name,
                'email'        => $ticket->requester->email,
                'phone_number' => $ticket->requester->phone_number,
            ],
        ];
    }
}