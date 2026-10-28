@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="admin-page-heading"><div><p class="overline">Portfolio content</p><h1>{{ $pageTitle }}</h1><p>Project details are shown on your public site when published.</p></div><a class="button button-quiet" href="{{ route('admin.projects.index') }}">← All projects</a></div>
<section class="admin-panel"><form class="admin-form" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="post">
    @csrf @if ($project->exists) @method('put') @endif
    <div class="admin-form-grid"><label>Project title<input name="title" value="{{ old('title', $project->title) }}" required maxlength="140"></label><label>Category<select name="category" required>@foreach (['Web Development', 'Enterprise Platforms', 'Mobile Apps', 'Branding'] as $category)<option value="{{ $category }}" @selected(old('category', $project->category) === $category)>{{ $category }}</option>@endforeach</select></label></div>
    <label>Short description<input name="short_description" value="{{ old('short_description', $project->short_description) }}" required maxlength="240"><small class="admin-form-hint">A concise summary shown on the project card.</small></label>
    <label>Project overview<textarea name="description" required maxlength="5000" rows="6">{{ old('description', $project->description) }}</textarea></label>
    <label>Technology stack<input name="tech_stack" value="{{ old('tech_stack', implode(', ', $project->technologies ?? [])) }}" placeholder="Laravel, Livewire, MySQL"><small class="admin-form-hint">Separate each technology with a comma.</small></label>
    <div class="admin-form-grid"><label>Live project URL<input type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}" placeholder="https://example.com"></label><label>Source code URL<input type="url" name="repository_url" value="{{ old('repository_url', $project->repository_url) }}" placeholder="https://github.com/..."></label></div>
    <label>Preview image URL<input type="url" name="cover_image_url" value="{{ old('cover_image_url', $project->cover_image_url) }}" placeholder="https://..."><small class="admin-form-hint">Optional. The project uses an optimized CSS artwork card when this is blank.</small></label>
    <div class="admin-form-grid"><label>Accent color<input type="text" name="accent_color" value="{{ old('accent_color', $project->accent_color ?: '#42d7e8') }}" pattern="#[0-9A-Fa-f]{6}" required><small class="admin-form-hint">Hex code, for example #42d7e8.</small></label><label>Display order<input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0" max="65535"></label></div>
    <div class="admin-form-grid"><label class="check-row"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project->is_featured))><span>Mark as featured</span></label><label class="check-row"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $project->exists ? $project->is_published : true))><span>Publish on the site</span></label></div>
    <div class="admin-form-actions"><button class="button button-primary" type="submit">Save project <span aria-hidden="true">↗</span></button><a class="button button-quiet" href="{{ route('admin.projects.index') }}">Cancel</a></div>
</form></section>
@endsection
