@extends('layouts.admin')

@section('title', 'Skills')

@section('content')
<div class="admin-page-heading"><div><p class="overline">Your toolkit</p><h1>Skills</h1><p>Organise the technologies and tools shown in your profile.</p></div><a class="button button-primary" href="{{ route('admin.skills.create') }}">Add skill <span aria-hidden="true">＋</span></a></div>
<section class="admin-panel"><table class="admin-table"><thead><tr><th>Skill</th><th>Group</th><th>Order</th><th>Actions</th></tr></thead><tbody>@forelse ($skills as $skill)<tr><td><a href="{{ route('admin.skills.edit', $skill) }}">{{ $skill->name }}</a></td><td>{{ $skill->group }}</td><td>{{ $skill->sort_order }}</td><td><div class="admin-actions"><a href="{{ route('admin.skills.edit', $skill) }}">Edit</a><form action="{{ route('admin.skills.destroy', $skill) }}" method="post" onsubmit="return confirm('Delete this skill?')">@csrf @method('delete')<button type="submit">Delete</button></form></div></td></tr>@empty<tr><td colspan="4">No skills have been added yet.</td></tr>@endforelse</tbody></table><div class="pagination-wrap">{{ $skills->links() }}</div></section>
@endsection
