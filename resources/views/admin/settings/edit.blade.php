@extends('layouts.admin')

@section('title', 'Profile settings')

@section('content')
<div class="admin-page-heading"><div><p class="overline">Site identity</p><h1>Profile & settings</h1><p>These details appear across your public portfolio.</p></div></div>
<section class="admin-panel"><form class="admin-form" action="{{ route('admin.settings.update') }}" method="post">
    @csrf @method('put')
    <div class="admin-form-grid"><label>Full name<input name="full_name" value="{{ old('full_name', $settings->full_name) }}" required maxlength="120"></label><label>Brand / studio<input name="brand_name" value="{{ old('brand_name', $settings->brand_name) }}" maxlength="120"></label></div>
    <label>Role or title<input name="role" value="{{ old('role', $settings->role) }}" required maxlength="160"></label>
    <label>Hero headline<input name="headline" value="{{ old('headline', $settings->headline) }}" required maxlength="180"></label>
    <label>Hero supporting line<input name="tagline" value="{{ old('tagline', $settings->tagline) }}" required maxlength="180"></label>
    <label>About paragraph<textarea name="about" required maxlength="2500" rows="5">{{ old('about', $settings->about) }}</textarea></label>
    <div class="admin-form-grid"><label>Availability label<input name="availability" value="{{ old('availability', $settings->availability) }}" required maxlength="80"></label><label>Location<input name="location" value="{{ old('location', $settings->location) }}" maxlength="120"></label></div>
    <div class="admin-form-grid"><label>Years of experience<input type="number" name="years_experience" value="{{ old('years_experience', $settings->years_experience) }}" min="0" max="100" required></label><label>Projects delivered<input type="number" name="projects_count" value="{{ old('projects_count', $settings->projects_count) }}" min="0" max="65535" required></label></div>
    <div class="admin-form-grid"><label>Clients served<input type="number" name="clients_count" value="{{ old('clients_count', $settings->clients_count) }}" min="0" max="65535" required></label><label>Contact email<input type="email" name="email" value="{{ old('email', $settings->email) }}" required maxlength="190"></label></div>
    <div class="admin-form-grid"><label>Phone<input name="phone" value="{{ old('phone', $settings->phone) }}" maxlength="40"></label><label>Website URL<input type="url" name="website_url" value="{{ old('website_url', $settings->website_url) }}" maxlength="255"></label></div>
    <div class="admin-form-grid"><label>WhatsApp URL<input type="url" name="whatsapp_url" value="{{ old('whatsapp_url', $settings->whatsapp_url) }}" placeholder="https://wa.me/..."></label><label>GitHub URL<input type="url" name="github_url" value="{{ old('github_url', $settings->github_url) }}"></label></div>
    <label>LinkedIn URL<input type="url" name="linkedin_url" value="{{ old('linkedin_url', $settings->linkedin_url) }}"></label>
    <label>Search description<textarea name="meta_description" maxlength="320" rows="3">{{ old('meta_description', $settings->meta_description) }}</textarea><small class="admin-form-hint">Used by search engines and link previews.</small></label>
    <div class="admin-form-actions"><button class="button button-primary" type="submit">Save profile <span aria-hidden="true">↗</span></button></div>
</form></section>
@endsection
