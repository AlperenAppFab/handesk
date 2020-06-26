@extends('emails.layout')

@section('body')
        <div style="border-bottom:1px solid #efefef; padding-bottom:10px;">
            <span style="font-size:12px">{{ $title }}</span>
        </div>

        <div>
            Şikayet kaydı değerlendirildi:
            {{ $ticket->title }}<br><br>
            {{ $ticket->rating }}
        </div>

        <div style="margin-top:40px">
            <a href="{{$url}}">Yardım Merkezinde görüntülemek için tıklayınız.</a>
        </div>

        <span style="color:white">Kayıt numarası:{{$ticket->id}}.</span>

@endsection