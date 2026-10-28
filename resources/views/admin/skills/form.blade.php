@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="admin-page-heading"><div><p class="overline">Your toolkit</p><h1>{{ $pageTitle }}</h1></div><a class="button button-quiet" href="{{ route('admin.skills.index') }}">← All skills</a></div>
<section class="admin-panel"><form class="admin-form" action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="post">
    @csrf @if ($skill->exists) @method('put') @endif
    <label>Skill or technology<input name="name" value="{{ old('name', $skill->name) }}" required maxlength="80" placeholder="Laravel"></label>
    <div class="admin-form-grid"><label>Group<input name="group" value="{{ old('group', $skill->group) }}" required maxlength="60" placeholder="Backend"></label><label>Display order<input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}" min="0" max="65535"></label></div>
    <div class="admin-form-actions"><button class="button button-primary" type="submit">Save skill <span aria-hidden="true">↗</span></button><a class="button button-quiet" href="{{ route('admin.skills.index') }}">Cancel</a></div>
</form></section>
@endsection
