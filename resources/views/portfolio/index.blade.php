@extends('layouts.portfolio')

@section('content')
<section class="hero section-pad" id="hero">
    <div class="wrap hero-grid">
        <div class="hero-copy">
            <div class="eyebrow"><span class="status-dot"></span>{{ $settings->availability }} <span class="eyebrow-divider">/</span> {{ $settings->location }}</div>
            <p class="overline">Independent software engineer · Founder at {{ $settings->brand_name }}</p>
            <h1>{{ $settings->headline }}</h1>
            <p class="hero-lede">Hi, I’m <strong>{{ $settings->full_name }}</strong>. {{ $settings->tagline }} I partner with teams to make ambitious ideas useful, beautiful, and ready to grow.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#work">Explore my work <span aria-hidden="true">↓</span></a>
                <a class="button button-quiet" href="#contact">Start a conversation <span aria-hidden="true">↗</span></a>
            </div>
            <div class="hero-proof">
                <div class="proof-avatars" aria-hidden="true"><span>FN</span><span>✳</span><span>↗</span></div>
                <p><strong>Thoughtful engineering,</strong><br>made for people and the real world.</p>
            </div>
        </div>
        <div class="hero-visual" aria-label="A snapshot of my engineering process">
            <div class="visual-orbit orbit-large"></div><div class="visual-orbit orbit-small"></div>
            <div class="code-window">
                <div class="window-bar"><div class="window-dots"><i></i><i></i><i></i></div><span>product-thinking.php</span><span class="window-lock">⌑</span></div>
                <div class="code-body">
                    <p class="code-muted">01 <span>&lt;?php</span></p>
                    <p class="code-line">02 <b>class</b> <em>GoodSoftware</em></p>
                    <p class="code-line indent">03 <b>public function</b> <em>build</em>()</p>
                    <p class="code-line indent-more">04 <span>$idea</span> = <i>understand_the_problem</i>();</p>
                    <p class="code-line indent-more">05 <span>$work</span> = <i>design_with_intent</i>($idea);</p>
                    <p class="code-line indent-more">06 <b>return</b> <i>ship_something_useful</i>($work);</p>
                    <p class="code-muted">07 }</p>
                    <div class="code-cursor"></div>
                </div>
                <div class="window-footer"><span><span class="online-dot"></span> Building with purpose</span><span>Laravel · Flutter · APIs</span></div>
            </div>
            <div class="float-note note-top"><span class="note-icon">✦</span><span><b>Built to scale</b><small>Ready for what’s next</small></span></div>
            <div class="float-note note-bottom"><span class="note-number">{{ str_pad((string) $settings->projects_count, 2, '0', STR_PAD_LEFT) }}+</span><span><b>Projects delivered</b><small>Across ideas & industries</small></span></div>
            <div class="visual-caption"><span>Dar es Salaam, TZ</span><span>06°48′S · 39°17′E</span></div>
        </div>
    </div>
</section>

<section class="metrics-strip" aria-label="Experience at a glance">
    <div class="wrap metrics-grid">
        <div class="metric"><strong>{{ $settings->years_experience }}<span>+</span></strong><small>Years building</small></div>
        <div class="metric"><strong>{{ $settings->projects_count }}<span>+</span></strong><small>Projects delivered</small></div>
        <div class="metric"><strong>{{ $settings->clients_count }}<span>+</span></strong><small>Happy clients</small></div>
        <p>Good work makes complex things<br><span>feel simple.</span></p>
    </div>
</section>

<section class="section-pad section-services" id="services">
    <div class="wrap">
        <div class="section-heading">
            <div><p class="overline">What I do</p><h2>From first idea<br>to <span>finished product.</span></h2></div>
            <p class="section-intro">A small, focused practice for teams that want clear thinking, careful craft, and technology that earns its place.</p>
        </div>
        <div class="service-grid">
            @foreach ($services as $service)
                <article class="service-card">
                    <span class="service-icon" aria-hidden="true">{{ $service->icon }}</span>
                    <span class="service-index">0{{ $loop->iteration }}</span>
                    <h3>{{ $service->title }}</h3>
                    <p>{{ $service->summary }}</p>
                    <div class="tag-row">@foreach ($service->technologies ?? [] as $technology)<span>{{ $technology }}</span>@endforeach</div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section-pad section-work" id="work">
    <div class="wrap">
        <div class="section-heading work-heading">
            <div><p class="overline">A few things I’ve made</p><h2>Selected <span>work.</span></h2></div>
            <p class="section-intro">A mix of platforms, products, and experiments built with good people.</p>
        </div>
        <div class="filter-row" role="group" aria-label="Filter projects">
            <button type="button" class="filter-chip is-active" data-project-filter="all" aria-pressed="true">All projects <span>{{ $projects->count() }}</span></button>
            @foreach (['Web App', 'Mobile App', 'SaaS', 'Enterprise App'] as $category)
                <button type="button" class="filter-chip" data-project-filter="{{ str($category)->slug() }}" aria-pressed="false">{{ $category }} <span>{{ $projects->where('category', $category)->count() }}</span></button>
            @endforeach
        </div>
        <div class="project-grid" id="project-grid">
            @forelse ($projects as $project)
                <article class="project-card" data-project-card data-category="{{ str($project->category)->slug() }}">
                    <a class="project-art" href="{{ route('projects.show', $project->slug) }}" style="--project-accent: {{ $project->accent_color }}" aria-label="View {{ $project->title }}">
                        @if ($project->cover_image_url)
                            <img src="{{ $project->cover_image_url }}" alt="Preview of {{ $project->title }}" loading="lazy" decoding="async">
                        @else
                            <span class="art-grid" aria-hidden="true"></span>
                            <span class="art-orb" aria-hidden="true"></span>
                            <span class="art-mark" aria-hidden="true">{{ str($project->title)->substr(0, 1)->upper() }}</span>
                            <span class="art-label" aria-hidden="true">{{ $project->category }}</span>
                            <span class="art-ui" aria-hidden="true"><i></i><i></i><i></i><b></b><b></b><b></b></span>
                        @endif
                        @if ($project->is_featured)<span class="featured-label">Featured</span>@endif
                        <span class="project-open" aria-hidden="true">↗</span>
                    </a>
                    <div class="project-info">
                        <div class="project-meta"><span>{{ $project->category }}</span><span>{{ $project->created_at?->format('Y') ?: now()->year }}</span></div>
                        <h3><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a></h3>
                        <p>{{ $project->short_description }}</p>
                        <div class="tag-row">@foreach (array_slice($project->technologies ?? [], 0, 4) as $technology)<span>{{ $technology }}</span>@endforeach</div>
                    </div>
                </article>
            @empty
                <div class="empty-state"><p>New work is on its way.</p></div>
            @endforelse
        </div>
        <div class="work-footer"><span>Have a project in mind?</span><a href="#contact">Let’s make it happen <span aria-hidden="true">↗</span></a></div>
    </div>
</section>

<section class="section-pad section-about" id="about">
    <div class="wrap about-grid">
        <div class="about-label"><p class="overline">A bit about me</p><span class="about-stamp">FN<span>•</span>TZ</span></div>
        <div class="about-content">
            <h2>Curious by nature.<br><span>Engineer by choice.</span></h2>
            <p class="about-copy">{{ $settings->about }}</p>
            <div class="skill-groups">
                @foreach ($skillGroups as $group => $skills)
                    <div class="skill-group"><h3>{{ $group }}</h3><div class="skill-list">@foreach ($skills as $skill)<span>{{ $skill->name }}</span>@endforeach</div></div>
                @endforeach
            </div>
            <a class="text-link" href="#contact">More about working together <span aria-hidden="true">↗</span></a>
        </div>
    </div>
</section>

<section class="section-pad section-process">
    <div class="wrap">
        <div class="section-heading"><div><p class="overline">How I work</p><h2>Clear steps.<br><span>Good outcomes.</span></h2></div><p class="section-intro">Every project gets the same care: understand the goal, make a thoughtful plan, and keep improving until it feels right.</p></div>
        <div class="process-grid">
            <article><span>01</span><h3>Listen & clarify</h3><p>Start with the people, the problem, and what a better outcome looks like.</p></article>
            <article><span>02</span><h3>Shape the solution</h3><p>Choose the right scope and architecture before the details take over.</p></article>
            <article><span>03</span><h3>Build with care</h3><p>Work in clear steps, share progress early, and keep the quality bar high.</p></article>
            <article><span>04</span><h3>Launch & support</h3><p>Ship confidently, learn from real use, and help the product keep growing.</p></article>
        </div>
    </div>
</section>

<section class="section-pad section-contact" id="contact">
    <div class="wrap contact-grid">
        <div class="contact-copy">
            <p class="overline">Have something in mind?</p>
            <h2>Let’s build<br><span>something good.</span></h2>
            <p>Tell me what you’re working on. I’ll get back to you and we can figure out the next step together.</p>
            <div class="contact-details">
                <a href="mailto:{{ $settings->email }}"><small>Email</small><strong>{{ $settings->email }}</strong><span aria-hidden="true">↗</span></a>
                @if ($settings->phone)<a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}"><small>Phone</small><strong>{{ $settings->phone }}</strong><span aria-hidden="true">↗</span></a>@endif
                @if ($settings->whatsapp_url)<a href="{{ $settings->whatsapp_url }}" target="_blank" rel="noopener noreferrer"><small>WhatsApp</small><strong>Send me a WhatsApp</strong><span aria-hidden="true">↗</span></a>@endif
                @if ($settings->github_url)<a href="{{ $settings->github_url }}" target="_blank" rel="noopener noreferrer"><small>GitHub</small><strong>Find me on GitHub</strong><span aria-hidden="true">↗</span></a>@endif
            </div>
        </div>
        <div class="contact-panel">
            @if (session('contact_sent'))<div class="form-success" role="status"><span>✓</span>Thanks for reaching out. Your message is in my inbox.</div>@endif
            @if ($errors->any())<div class="form-error" role="alert">Please check the highlighted fields and try again.</div>@endif
            <form action="{{ route('contact.store') }}" method="post" class="contact-form">
                @csrf
                <div class="honeypot" aria-hidden="true"><label for="website">Leave this field empty</label><input type="text" id="website" name="website" tabindex="-1" autocomplete="off"></div>
                <div class="form-row"><label>Name<input type="text" name="name" value="{{ old('name') }}" autocomplete="name" required maxlength="120" placeholder="Your name">@error('name')<small class="field-error">{{ $message }}</small>@enderror</label><label>Email<input type="email" name="email" value="{{ old('email') }}" autocomplete="email" required maxlength="190" placeholder="you@example.com">@error('email')<small class="field-error">{{ $message }}</small>@enderror</label></div>
                <label>What can I help with?<select name="service"><option value="">Choose a service</option>@foreach ($services as $service)<option value="{{ $service->title }}" @selected(old('service') === $service->title)>{{ $service->title }}</option>@endforeach<option value="Something else" @selected(old('service') === 'Something else')>Something else</option></select></label>
                <label>Subject<input type="text" name="subject" value="{{ old('subject') }}" required maxlength="180" placeholder="A few words about your project">@error('subject')<small class="field-error">{{ $message }}</small>@enderror</label>
                <label>Tell me a little more<textarea name="message" rows="5" required minlength="20" maxlength="5000" placeholder="What are you hoping to build or improve?">{{ old('message') }}</textarea>@error('message')<small class="field-error">{{ $message }}</small>@enderror</label>
                <button class="button button-primary button-submit" type="submit">Send message <span aria-hidden="true">↗</span></button>
                <p class="form-note">Your details stay private and are only used to reply.</p>
            </form>
        </div>
    </div>
</section>
@endsection

