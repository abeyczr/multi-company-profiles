<!doctype html>
<html amp lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $seo->meta_title ?? $record->company_name }}</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    @if(isset($seo))
        <meta name="description" content="{{ $seo->meta_description }}">
        <meta name="keywords" content="{{ $seo->meta_keywords }}">
        @if($seo->og_image)
            <meta property="og:image" content="{{ asset($seo->og_image) }}">
        @endif
    @endif
    <link rel="canonical" href="{{ url()->current() }}" />

    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
    <noscript><style amp-boilerplate>body{-webkit-animation:none;animation:none}</style></noscript>

    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.2.js"></script>
    <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
    <script async custom-element="amp-fx-collection" src="https://cdn.ampproject.org/v0/amp-fx-collection-0.1.js"></script>
    <script async custom-element="amp-animation" src="https://cdn.ampproject.org/v0/amp-animation-0.1.js"></script>
    <script async custom-element="amp-position-observer" src="https://cdn.ampproject.org/v0/amp-position-observer-0.1.js"></script>
    <script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>

    <style amp-custom>
        :root{--bg:#f4f7fb;--surface:#ffffff;--surface-soft:#f8fbff;--text:#11243b;--muted:#6b7790;--accent:#1d7cf2;--accent-soft:rgba(29,124,242,.12);--border:#dee3ea}
        html,body{height:100%}
        body{font-family:Inter,ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial; background:var(--bg); color:var(--text); margin:0; -webkit-font-smoothing:antialiased}
        .container{padding:24px 20px; max-width:1140px; margin:0 auto}
        .hero{display:grid; grid-template-columns:1.2fr .9fr; gap:24px; align-items:center; padding:40px; background:linear-gradient(180deg,#ffffff 0%,#eff5fd 100%); border-radius:28px; box-shadow:0 20px 50px rgba(16,39,83,.08); margin-bottom:28px}
        .hero-copy{max-width:640px}
        .hero-copy .badge{display:inline-flex; align-items:center; justify-content:center; padding:.7rem 1rem; border-radius:999px; margin-bottom:18px; font-size:.95rem; background:var(--accent-soft); color:var(--accent)}
        .hero-copy h1{font-size:clamp(2.5rem,3.2vw,4.2rem); line-height:1.02; margin:0 0 18px; color:#0f1f3b}
        .hero-copy p{font-size:1.05rem; line-height:1.75; color:var(--muted); margin:0 0 24px}
        .hero-actions{display:flex; gap:14px; flex-wrap:wrap}
        .hero-btn{display:inline-flex; align-items:center; justify-content:center; min-height:52px; padding:0 26px; border-radius:999px; font-weight:700; text-decoration:none; transition:transform .25s ease, box-shadow .25s ease}
        .hero-btn.primary{background:var(--accent); color:#fff; box-shadow:0 14px 30px rgba(29,124,242,.18)}
        .hero-btn.secondary{background:#fff; color:var(--accent); border:1px solid rgba(29,124,242,.18)}
        .hero-stats{display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:14px; margin-top:24px}
        .stat-card{background:#fff; border:1px solid var(--border); border-radius:18px; padding:22px; text-align:center; box-shadow:0 10px 30px rgba(16,39,83,.06)}
        .stat-card strong{display:block; font-size:1.55rem; color:#10203e; margin-bottom:6px}
        .stat-card span{color:var(--muted); font-size:.95rem}
        .hero-image{position:relative; min-height:420px; border-radius:24px; overflow:hidden; box-shadow:0 24px 80px rgba(16,39,83,.09)}
        .hero-image amp-img{object-fit:cover}
        .section{margin-bottom:28px; background:var(--surface); border-radius:28px; padding:32px; box-shadow:0 18px 48px rgba(16,39,83,.06)}
        .section-header{display:flex;align-items:center;justify-content:space-between;gap:18px;margin-bottom:22px}
        .section-header h2{font-size:2rem;margin:0;color:#10203e}
        .section-header p{margin:0;color:var(--muted);max-width:560px}
        .cards-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px}
        .feature-card{background:#fff;border:1px solid var(--border);border-radius:22px;padding:28px;box-shadow:0 16px 40px rgba(16,39,83,.07);transition:transform .25s ease,box-shadow .25s ease}
        .feature-card:hover{transform:translateY(-6px);box-shadow:0 22px 48px rgba(16,39,83,.12)}
        .feature-card h3{margin:0 0 12px; font-size:1.15rem;color:#10203e}
        .feature-card p{margin:0;color:var(--muted); line-height:1.75}
        .feature-icon{width:52px;height:52px;border-radius:18px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;background:var(--accent-soft);color:var(--accent);font-size:1.4rem}
        .content-grid{display:grid;grid-template-columns:2fr 1fr; gap:24px}
        .card-surface{background:#fff;border:1px solid var(--border);border-radius:28px;padding:28px;box-shadow:0 16px 44px rgba(16,39,83,.06)}
        .mini-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px;margin-top:18px}
        .mini-card{background:#f8fbff;border:1px solid #e4edf8;border-radius:20px;padding:20px}
        .mini-card strong{display:block;margin-bottom:8px;color:#10203e}
        .portfolio{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px}
        .portfolio-item{background:#fff;border:1px solid var(--border);border-radius:24px;overflow:hidden;box-shadow:0 18px 40px rgba(16,39,83,.06)}
        .portfolio-item amp-img{width:100%;height:auto}
        .portfolio-meta{padding:22px}
        .portfolio-meta h4{margin:0 0 10px;font-size:1.05rem;color:#10203e}
        .portfolio-meta p{margin:0;color:var(--muted);line-height:1.8}
        .testimonial-card{background:#fff;border:1px solid var(--border);border-radius:20px;padding:24px;box-shadow:0 14px 36px rgba(16,39,83,.05)}
        .testimonial-card strong{display:block;font-size:1rem;color:#10203e;margin-bottom:12px}
        .testimonial-card p{margin:0;color:var(--muted);line-height:1.8}
        .benefits{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}
        .benefit-card{background:#fff;border:1px solid var(--border);border-radius:22px;padding:24px; text-align:center;box-shadow:0 14px 30px rgba(16,39,83,.05)}
        .benefit-card strong{display:block;margin-top:16px;font-size:1rem;color:#10203e}
        .benefit-card span{display:block;margin-top:8px;color:var(--muted);line-height:1.75}
        .contact-side{display:grid;gap:18px}
        .contact-box{background:#fff;border:1px solid var(--border);border-radius:22px;padding:24px;box-shadow:0 14px 36px rgba(16,39,83,.05)}
        .contact-box h3{margin:0 0 16px;color:#10203e}
        .contact-item{display:flex;align-items:flex-start;gap:12px;margin-bottom:14px}
        .contact-item strong{display:block;color:#10203e}
        .contact-item span{display:block;color:var(--muted)}
        .badge{display:inline-flex;align-items:center;gap:8px;padding:.65rem 1rem;border-radius:999px;background:var(--accent-soft);color:var(--accent);font-size:.95rem}
        .aside-links{display:flex;flex-wrap:wrap;gap:10px}
        .aside-links a{background:#f8fbff;color:var(--accent);padding:10px 14px;border-radius:999px;text-decoration:none;font-size:.95rem;display:inline-flex;align-items:center}
        .footer-text{color:var(--muted);font-size:.95rem;text-align:center}
        .animate-up{opacity:0; transform:translateY(20px); animation:reveal .7s cubic-bezier(.2,.9,.2,1) forwards; animation-delay:var(--delay,0ms)}
        @keyframes reveal{to{opacity:1; transform:none}}
        @media(max-width:1024px){.hero{grid-template-columns:1fr; padding:30px}.hero-image{min-height:320px}.hero-stats{grid-template-columns:repeat(3,1fr)}.content-grid{grid-template-columns:1fr}.cards-grid,.benefits,.portfolio{grid-template-columns:1fr}}
        @media(max-width:680px){.hero{padding:24px}.hero-copy h1{font-size:2.25rem}.hero-stats{grid-template-columns:1fr}.hero-actions{flex-direction:column}.portfolio-item amp-img{height:auto}.section{padding:0} .container{padding:18px}}
    </style>
</head>
<body>
    <main>
        <div class="container">
            <section class="hero">
                <div class="hero-copy animate-up" style="--delay:80ms">
                    <div class="badge">Company Profile Landing</div>
                    <h1>{{ $record->company_name }}</h1>
                    <p>{{ $hero && $hero->count()>0 ? $hero[0]->subtitle : $record->tagline }}</p>
                    <div class="hero-actions">
                        <a class="hero-btn primary" href="{{ $hero && $hero->count()>0 ? $hero[0]->button_link : '#contact' }}">{{ $hero && $hero->count()>0 ? $hero[0]->button_text : 'Contact Us' }}</a>
                        <a class="hero-btn secondary" href="{{ $record->website ?? '#' }}">Visit Website</a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-card">
                            <strong>{{ $counts['services'] ?? 0 }}</strong>
                            <span>Services Delivered</span>
                        </div>
                        <div class="stat-card">
                            <strong>{{ $portfolios->count() }}</strong>
                            <span>Portfolio Projects</span>
                        </div>
                        <div class="stat-card">
                            <strong>{{ $teams->count() }}</strong>
                            <span>Expert Team</span>
                        </div>
                    </div>
                </div>
                <div class="hero-image animate-up" style="--delay:120ms">
                    <amp-img src="{{ $hero && $hero->count()>0 && $hero[0]->background_image ? asset($hero[0]->background_image) : asset('images/hero-default.jpg') }}" width="900" height="620" layout="responsive" alt="Company hero image"></amp-img>
                </div>
            </section>

            <section class="section animate-up" style="--delay:120ms">
                <div class="section-header">
                    <div>
                        <h2>Professional company profile website</h2>
                        <p>Elegant landing page design with modern sections, clear CTA, and content tailored to corporate branding.</p>
                    </div>
                </div>
                <div class="benefits">
                    <div class="benefit-card">
                        <div class="feature-icon">✓</div>
                        <strong>Clean structure</strong>
                        <span>Simple, readable content areas that help visitors scan quickly and take action.</span>
                    </div>
                    <div class="benefit-card">
                        <div class="feature-icon">⚡</div>
                        <strong>Fast AMP experience</strong>
                        <span>Google-friendly speed for mobile search, while still keeping animation and polish.</span>
                    </div>
                    <div class="benefit-card">
                        <div class="feature-icon">🏆</div>
                        <strong>Premium branding</strong>
                        <span>Elevated visual hierarchy with soft shadows, rounded cards, and refined typography.</span>
                    </div>
                </div>
            </section>

            <section class="section animate-up" style="--delay:160ms">
                <div class="section-header">
                    <div>
                        <h2>Our services</h2>
                        <p>Key company capabilities presented as quick-read feature cards with thoughtful spacing and icon accents.</p>
                    </div>
                </div>
                <div class="cards-grid">
                    @foreach($services as $s)
                    <div class="feature-card">
                        <div class="feature-icon">💼</div>
                        <h3>{{ $s->name }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($s->description), 110) }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <section class="section animate-up" style="--delay:200ms">
                <div class="section-header">
                    <div>
                        <h2>Featured portfolio</h2>
                        <p>Showcase of recent work with clean image cards and compelling project summaries.</p>
                    </div>
                </div>
                <div class="portfolio">
                    @foreach($portfolios->take(4) as $p)
                    <div class="portfolio-item">
                        <amp-img src="{{ $p->image ? asset($p->image) : asset('images/portfolio-placeholder.jpg') }}" width="600" height="380" layout="responsive" alt="Portfolio image"></amp-img>
                        <div class="portfolio-meta">
                            <h4>{{ $p->title }}</h4>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($p->description), 110) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <div class="content-grid">
                <div class="card-surface animate-up" style="--delay:240ms">
                    <div class="section-header">
                        <div>
                            <h2>About {{ $record->company_name }}</h2>
                            <p>A professional company profile with a trusted corporate look, strong messaging, and an emphasis on experience.</p>
                        </div>
                    </div>
                    <div class="mini-grid">
                        <div class="mini-card">
                            <strong>Vision</strong>
                            <span>{!! nl2br(e($record->vision)) !!}</span>
                        </div>
                        <div class="mini-card">
                            <strong>Mission</strong>
                            <span>{!! nl2br(e($record->mission)) !!}</span>
                        </div>
                    </div>
                </div>
                <aside class="contact-side">
                    <div class="contact-box animate-up" style="--delay:260ms">
                        <h3>Contact us</h3>
                        <div class="contact-item"><strong>Address</strong><span>{{ $record->address }}</span></div>
                        <div class="contact-item"><strong>Email</strong><span>{{ $record->email }}</span></div>
                        <div class="contact-item"><strong>Phone</strong><span>{{ $record->phone }}</span></div>
                        @if(isset($website) && $website->whatsapp_number)
                        <div class="contact-item"><strong>WhatsApp</strong><span><a href="https://wa.me/{{ ltrim($website->whatsapp_number,'+') }}">{{ $website->whatsapp_number }}</a></span></div>
                        @endif
                    </div>

                    <div class="contact-box animate-up" style="--delay:280ms">
                        <h3>Team members</h3>
                        @foreach($teams->take(4) as $t)
                        <div class="contact-item"><strong>{{ $t->name }}</strong><span>{{ $t->position }}</span></div>
                        @endforeach
                    </div>
                </aside>
            </div>

            <section class="section animate-up" style="--delay:300ms">
                <div class="section-header">
                    <div>
                        <h2>What people say</h2>
                        <p>Testimonials that reinforce trust, expertise, and professional delivery.</p>
                    </div>
                </div>
                <amp-carousel width="1000" height="230" layout="responsive" type="slides">
                    @foreach($testimonials as $tt)
                    <div class="testimonial-card">
                        <strong>{{ $tt->client_name }}</strong>
                        <p>{{ \Illuminate\Support\Str::limit($tt->testimonial, 160) }}</p>
                    </div>
                    @endforeach
                </amp-carousel>
            </section>

            <section class="section animate-up" style="--delay:320ms">
                <div class="section-header">
                    <div>
                        <h2>Latest Insights</h2>
                        <p>Recent blog updates to keep visitors informed and connected with the company’s expertise.</p>
                    </div>
                </div>
                <div class="cards-grid">
                    @foreach($blogs->take(3) as $b)
                    <div class="feature-card">
                        <amp-img src="{{ $b->thumbnail ? asset($b->thumbnail) : asset('images/blog-placeholder.jpg') }}" width="400" height="240" layout="responsive" alt="Blog post"></amp-img>
                        <h3>{{ $b->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($b->description ?? ''), 110) }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <footer class="footer-text animate-up" style="--delay:340ms">
                {{ $website->footer_text ?? $record->company_name }}
            </footer>
        </div>
    </main>
</body>
</html>
