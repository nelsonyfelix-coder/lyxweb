@extends('layouts.admin')

@section('title', 'Projects')

@section('content')
<div class="admin-page-heading"><div><p class="overline">Portfolio content</p><h1>Projects</h1><p>Manage the work shown on your public portfolio.</p></div><a class="button button-primary" href="{{ route('admin.projects.create') }}">Add project <span aria-hidden="true">＋</span></a></div>
<section class="admin-panel"><div class="table-scroll"><table class="admin-table"><thead><tr><th>Project</th><th>Category</th><th>Featured</th><th>Status</th><th>Actions</th></tr></thead><tbody>@forelse ($projects as $project)<tr><td><div class="admin-project-cell">@if ($project->cover_image_url)<img class="admin-project-thumb" src="{{ $project->cover_image_url }}" alt="" loading="lazy" decoding="async">@endif<div><a href="{{ route('admin.projects.edit', $project) }}">{{ $project->title }}</a><span class="table-secondary">{{ str($project->short_description)->limit(58) }}</span></div></div></td><td>{{ $project->category }}</td><td>{{ $project->is_featured ? 'Yes' : '—' }}</td><td><span class="status-pill {{ $project->is_published ? '' : 'is-muted' }}">{{ $project->is_published ? 'Published' : 'Draft' }}</span></td><td><div class="admin-actions"><a href="{{ route('admin.projects.edit', $project) }}">Edit</a><form action="{{ route('admin.projects.destroy', $project) }}" method="post" onsubmit="return confirm('Delete this project?')">@csrf @method('delete')<button type="submit">Delete</button></form></div></td></tr>@empty<tr><td colspan="5">No projects yet. Add the first one to your portfolio.</td></tr>@endforelse</tbody></table></div><div class="pagination-wrap">{{ $projects->links() }}</div></section>
@endsection

