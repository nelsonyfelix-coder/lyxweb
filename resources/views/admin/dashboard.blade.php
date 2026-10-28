@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
<div class="admin-page-heading"><div><p class="overline">Workspace</p><h1>Good to see you, {{ str(auth()->user()->name)->before(' ') }}.</h1><p>Here’s what’s happening across your portfolio.</p></div><a class="button button-primary" href="{{ route('home') }}#contact" target="_blank" rel="noopener noreferrer">Preview site <span aria-hidden="true">↗</span></a></div>
<div class="admin-stats">
    <article class="admin-stat"><small>Portfolio projects</small><strong>{{ $projectCount }}</strong><a href="{{ route('admin.projects.index') }}">Manage projects →</a></article>
    <article class="admin-stat"><small>Services listed</small><strong>{{ $serviceCount }}</strong><a href="{{ route('admin.services.index') }}">Manage services →</a></article>
    <article class="admin-stat"><small>Unread messages</small><strong>{{ $unreadCount }}</strong><a href="{{ route('admin.messages.index') }}">Open inbox →</a></article>
</div>
<div class="admin-dashboard-grid">
    <section class="admin-panel"><div class="admin-panel-head"><h2>Recent enquiries</h2><a href="{{ route('admin.messages.index') }}">View inbox →</a></div><table class="admin-table"><thead><tr><th>From</th><th>Subject</th><th>Status</th></tr></thead><tbody>@forelse ($recentMessages as $message)<tr><td><a href="{{ route('admin.messages.show', $message) }}">{{ $message->name }}</a><span class="table-secondary">{{ $message->created_at->diffForHumans() }}</span></td><td>{{ str($message->subject)->limit(28) }}</td><td><span class="status-pill {{ $message->is_read ? 'is-muted' : '' }}">{{ $message->is_read ? 'Read' : 'New' }}</span></td></tr>@empty<tr><td colspan="3">No messages yet.</td></tr>@endforelse</tbody></table></section>
    <section class="admin-panel"><div class="admin-panel-head"><h2>Recently updated work</h2><a href="{{ route('admin.projects.index') }}">All projects →</a></div><table class="admin-table"><thead><tr><th>Project</th><th>Visibility</th><th></th></tr></thead><tbody>@forelse ($recentProjects as $project)<tr><td><a href="{{ route('admin.projects.edit', $project) }}">{{ $project->title }}</a><span class="table-secondary">{{ $project->category }}</span></td><td><span class="status-pill {{ $project->is_published ? '' : 'is-muted' }}">{{ $project->is_published ? 'Published' : 'Draft' }}</span></td><td><a href="{{ route('admin.projects.edit', $project) }}">Edit</a></td></tr>@empty<tr><td colspan="3">Add your first project to get started.</td></tr>@endforelse</tbody></table></section>
</div>
@endsection
