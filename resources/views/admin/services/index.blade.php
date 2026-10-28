@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div class="admin-page-heading"><div><p class="overline">What you do</p><h1>Services</h1><p>Keep the services and skill tags on your site up to date.</p></div><a class="button button-primary" href="{{ route('admin.services.create') }}">Add service <span aria-hidden="true">＋</span></a></div>
<section class="admin-panel"><table class="admin-table"><thead><tr><th>Service</th><th>Technologies</th><th>Visibility</th><th>Actions</th></tr></thead><tbody>@forelse ($services as $service)<tr><td><a href="{{ route('admin.services.edit', $service) }}">{{ $service->title }}</a><span class="table-secondary">{{ str($service->summary)->limit(65) }}</span></td><td>{{ implode(', ', $service->technologies ?? []) }}</td><td><span class="status-pill {{ $service->is_visible ? '' : 'is-muted' }}">{{ $service->is_visible ? 'Visible' : 'Hidden' }}</span></td><td><div class="admin-actions"><a href="{{ route('admin.services.edit', $service) }}">Edit</a><form action="{{ route('admin.services.destroy', $service) }}" method="post" onsubmit="return confirm('Delete this service?')">@csrf @method('delete')<button type="submit">Delete</button></form></div></td></tr>@empty<tr><td colspan="4">No services have been added yet.</td></tr>@endforelse</tbody></table><div class="pagination-wrap">{{ $services->links() }}</div></section>
@endsection
