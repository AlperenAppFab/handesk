<?php


namespace App\Http\Resources;

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
            'id'           => $ticket->id,
            'title'        => $ticket->title,
            'body'         => $ticket->body,
            'status'       => $ticket->statusName(),
            'created_at'   => $ticket->created_at,
            'updated_at'   => $ticket->updated_at,
            'type'         => [
                'name'  => $ticket->type->name,
                'color' => $ticket->type->color,
            ],
            'requester'    => [
                'id'           => $ticket->requester->id,
                'name'         => $ticket->requester->name,
                'email'        => $ticket->requester->email,
                'phone_number' => $ticket->requester->phone_number,
            ],
            'comments'     => ApiCommentsResource::collection($this->whenLoaded('comments'))
        ];
    }
}