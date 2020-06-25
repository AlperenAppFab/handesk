<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ApiCommentsResource;
use App\Ticket;
use http\Client\Curl\User;
use Illuminate\Http\Response;

class CommentsController extends ApiController
{
    public function store(Ticket $ticket)
    {
        $comment = $ticket->addComment(null, request('body'), request('new_status'));
        if (! $comment) {
            return $this->respond(['id' => null, 'message' => 'Can not create a comment with empty body'], Response::HTTP_OK);
        }

        return ApiCommentsResource::make($comment);
    }
}
