@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="admin-page-heading"><div><p class="overline">What you do</p><h1>{{ $pageTitle }}</h1></div><a class="button button-quiet" href="{{ route('admin.services.index') }}">← All services</a></div>
<section class="admin-panel"><form class="admin-form" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" method="post">
    @csrf @if ($service->exists) @method('put') @endif
    <label>Service name<input name="title" value="{{ old('title', $service->title) }}" required maxlength="120"></label>
    <label>Summary<textarea name="summary" required maxlength="1000" rows="4">{{ old('summary', $service->summary) }}</textarea></label>
    <div class="admin-form-grid"><label>Icon or symbol<input name="icon" value="{{ old('icon', $service->icon ?: '✦') }}" maxlength="12"></label><label>Display order<input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0" max="65535"></label></div>
    <label>Technology tags<input name="tech_stack" value="{{ old('tech_stack', implode(', ', $service->technologies ?? [])) }}" placeholder="Laravel, Livewire, MySQL"><small class="admin-form-hint">Separate each tag with a comma.</small></label>
    <label class="check-row"><input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $service->exists ? $service->is_visible : true))><span>Show this service on the public site</span></label>
    <div class="admin-form-actions"><button class="button button-primary" type="submit">Save service <span aria-hidden="true">↗</span></button><a class="button button-quiet" href="{{ route('admin.services.index') }}">Cancel</a></div>
</form></section>
@endsection
