<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ApiTicketsResource;
use App\Notifications\TicketCreated;
use App\Requester;
use App\Settings;
use App\Ticket;
use App\TicketType;
use Illuminate\Http\Response;

class TicketsController extends ApiController
{
    public function index()
    {
        $requester = Requester::whereName(request('requester'))
            ->orWhere('email', '=', request('requester'))
            ->orWhere('id', '=', request('requester'))
            ->first();

        if (empty($requester)) {
            return $this->respond([]);
        }

        if (request('status') == 'solved') {
            $tickets = $requester->solvedTickets;
        } elseif (request('status') == 'closed') {
            $tickets = $requester->closedTickets;
        } else {
            $tickets = $requester->openTickets;
        }

        return ApiTicketsResource::collection($tickets);
    }


    public function show(Ticket $ticket)
    {
        return ApiTicketsResource::make($ticket->load('comments'));
    }

    public function store()
    {
        $this->validate(request(), [
            'requester'              => 'required|array',
            'requester.email'        => 'email',
            'requester.phone_number' => 'required',
            'requester.name'         => 'required|string',
            'title'                  => 'required|min:3',
        ]);

        $requesterData = request()->get('requester');

        $requester = Requester::updateOrCreate(
            [
                'id' => isset($requesterData['id']) ? $requesterData['id'] : null,
            ],
            $requesterData
        );

        $ticketType = TicketType::where('name', request('ticket_type_name'))->first();

        $ticket = Ticket::createAndNotify(
            $requester,
            request('title'),
            request('body'),
            request('tags'),
            optional($ticketType)->id
        );

        if (request('team_id')) {
            $ticket->assignToTeam(request('team_id'));
        } else {
            $this->notifyDefault($ticket);
        }

        return $this->respond(ApiTicketsResource::make($ticket), Response::HTTP_CREATED);
    }

    private function notifyDefault($ticket)
    {
        $setting = Settings::first();
        if ($setting && $setting->slack_webhook_url) {
            $setting->notify(new TicketCreated($ticket));
        }
    }

    public function update(Ticket $ticket)
    {
        $ticket->updateStatus(request('status'));

        return $this->respond(ApiTicketsResource::make($ticket), Response::HTTP_OK);
    }
}
