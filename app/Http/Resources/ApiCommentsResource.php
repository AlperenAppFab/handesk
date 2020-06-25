<?php


namespace App\Http\Resources;


use App\Comment;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ApiTicketsResource
 *
 * @property-read Comment $resource
 *
 * @package App\Resources
 */
class ApiCommentsResource extends Resource
{
    public function toArray($request)
    {
        $comment = $this->resource;
        return [
            'id'         => $comment->id,
            'body'       => $comment->body,
            'is_user'    => $comment->isAuthorRequester(),
            'created_at' => $comment->created_at,
        ];
    }
}