@extends('layouts.admin')

@section('title', 'Inbox')

@section('content')
<div class="admin-page-heading"><div><p class="overline">Messages <span class="status-pill">{{ $unreadCount }} new</span></p><h1>Your inbox</h1><p>Enquiries sent through the contact form.</p></div></div>
<section class="admin-panel"><table class="admin-table"><thead><tr><th>Sender</th><th>Subject</th><th>Service</th><th>Date</th><th>Status</th></tr></thead><tbody>@forelse ($messages as $message)<tr><td><a href="{{ route('admin.messages.show', $message) }}">{{ $message->name }}</a><span class="table-secondary">{{ $message->email }}</span></td><td><a href="{{ route('admin.messages.show', $message) }}">{{ str($message->subject)->limit(38) }}</a></td><td>{{ $message->service ?: '—' }}</td><td>{{ $message->created_at->format('M j, Y') }}</td><td><span class="status-pill {{ $message->is_read ? 'is-muted' : '' }}">{{ $message->is_read ? 'Read' : 'New' }}</span></td></tr>@empty<tr><td colspan="5">Your inbox is empty.</td></tr>@endforelse</tbody></table><div class="pagination-wrap">{{ $messages->links() }}</div></section>
@endsection
