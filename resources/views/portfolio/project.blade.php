@extends('layouts.portfolio')

@section('title', $project->title.' — '.$settings->full_name)

@section('content')
<section class="project-detail section-pad">
    <div class="wrap detail-wrap">
        <a class="back-link" href="{{ route('home') }}#work">← Back to selected work</a>
        <div class="detail-head">
            <div><p class="overline">{{ $project->category }}</p><h1>{{ $project->title }}</h1><p class="detail-lede">{{ $project->short_description }}</p></div>
            @if ($project->live_url)<a class="button button-primary" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">Visit project <span aria-hidden="true">↗</span></a>@endif
        </div>
        <div class="detail-art" style="--project-accent: {{ $project->accent_color }}">
            @if ($project->cover_image_url)<img src="{{ $project->cover_image_url }}" alt="{{ $project->title }}" fetchpriority="high">@else<span class="art-grid" aria-hidden="true"></span><span class="art-orb" aria-hidden="true"></span><span class="detail-monogram" aria-hidden="true">{{ str($project->title)->substr(0, 1)->upper() }}</span>@endif
        </div>
        <div class="detail-content">
            <div class="detail-main"><p class="overline">The project</p><h2>Overview</h2><p class="detail-description">{!! nl2br(e($project->description)) !!}</p></div>
            <aside class="detail-aside"><p class="overline">Built with</p><div class="detail-tags">@foreach ($project->technologies ?? [] as $technology)<span>{{ $technology }}</span>@endforeach</div>@if ($project->repository_url)<a class="text-link" href="{{ $project->repository_url }}" target="_blank" rel="noopener noreferrer">View source <span aria-hidden="true">↗</span></a>@endif</aside>
        </div>
        @if ($relatedProjects->isNotEmpty())<div class="related-work"><p class="overline">Keep exploring</p><h2>More selected work</h2><div class="related-grid">@foreach ($relatedProjects as $related)<a href="{{ route('projects.show', $related->slug) }}" class="related-card"><span>{{ $related->category }}</span><strong>{{ $related->title }}</strong><i aria-hidden="true">↗</i></a>@endforeach</div></div>@endif
        <div class="detail-cta"><p>Have a similar challenge?</p><a class="button button-primary" href="{{ route('home') }}#contact">Let’s talk about it <span aria-hidden="true">↗</span></a></div>
    </div>
</section>
@endsection
