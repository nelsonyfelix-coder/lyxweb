@extends('layouts.admin')

@section('title', 'Message from '.$message->name)

@section('content')
<div class="admin-page-heading"><div><p class="overline">Inbox / Message</p><h1>{{ $message->subject }}</h1><p>Received {{ $message->created_at->format('F j, Y \a\t g:i a') }}</p></div><a class="button button-quiet" href="{{ route('admin.messages.index') }}">← Inbox</a></div>
<section class="admin-panel"><div class="message-detail"><div class="message-detail-head"><div><h2>{{ $message->name }}</h2><p><a href="mailto:{{ $message->email }}">{{ $message->email }}</a>@if ($message->service) · {{ $message->service }}@endif</p></div><a class="button button-primary" href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.$message->subject) }}">Reply by email <span aria-hidden="true">↗</span></a></div><div class="message-detail-copy">{{ $message->message }}</div><form action="{{ route('admin.messages.destroy', $message) }}" method="post" onsubmit="return confirm('Permanently delete this message?')">@csrf @method('delete')<button class="button-link" type="submit">Delete this message</button></form></div></section>
@endsection
