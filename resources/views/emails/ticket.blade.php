@extends('emails.layout')

@section('body')
        <div style="border-bottom:1px solid #efefef; padding-bottom:10px;">
            <span style="color:#aeaeae; font-size:12px"> {{ config('mail.fetch.replyAboveLine') }}</span><br><br>
            <span style="font-size:12px">{{ $title }}</span>
        </div>

        <div style="border-bottom:1px solid #efefef; padding-bottom:10px; margin-left:20px; margin-top:20px;">
            @if( isset($comment) )
                <b> {{ $comment->author()->name }}</b><br>
                <span style="color:gray">{{ $comment->created_at->toDateTimeString() }}</span><br>
                <p>
                    {!! nl2br( strip_tags($comment->body)) !!}
                </p>
            @else
                <b> {{ $ticket->requester->name }}</b><br>
                <span style="color:gray">{{ $ticket->created_at->toDateTimeString() }}</span><br>
                <p>
                    {!! nl2br( strip_tags($ticket->body)) !!}
                </p>
            @endif
        </div>

        <div style="margin-top:40px">
            Bu mesaja cevap vermek için e-postayı yanıtlayabilirsiniz. <a href="{{$url}}">Yardım Merkezinde görüntülemek için tıklayınız.</a>
        </div>

        <span style="color:white">Kayıt numarası: {{$ticket->id}}.</span>

@endsection