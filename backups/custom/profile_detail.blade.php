@php $hideHeaderFooter = true; @endphp
@extends($layout)
@section('title', isset($record->company_name) ? ($seo && $seo->meta_title ? $seo->meta_title : $record->company_name) : 'Company Profile')
@section('pagecss')
    @if(isset($seo))
        <meta name="description" content="{{ $seo->meta_description }}">
        <meta name="keywords" content="{{ $seo->meta_keywords }}">
        <meta property="og:title" content="{{ $seo->meta_title ?? $record->company_name }}">
        <meta property="og:description" content="{{ $seo->meta_description }}">
        @if($seo->og_image)
            <meta property="og:image" content="{{ asset($seo->og_image) }}">
        @endif
    @endif
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root{
            --bg: #f5f7fa;
            --surface: #ffffff;
            --surface-soft: #f8faff;
            --text-main: #334155; 
            --text-heading: #0f172a; 
            --text-muted: #64748b; 
            --accent: #1d7cf2;
            --accent-soft: rgba(29, 124, 242, 0.08);
            --border: #e2e8f0;
            --bezier-lux: cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        body{background:var(--bg); color:var(--text-main); font-family:Inter,ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial; margin:0; min-height:100%; -webkit-font-smoothing:antialiased;}
        a{color:var(--accent); text-decoration: none; transition: all 0.3s ease;}
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
            box-sizing: border-box;
        }

        /* --- MODERN FIXED HEADER & MENU WITH ICONS --- */
        .main-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(16, 39, 83, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px;
            margin-bottom: 20px;
            border-radius: 0 0 16px 16px;
        }
        .main-logo {
            font-weight: 800;
            color: var(--text-heading);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 1.05rem;
            z-index: 1010;
        }
        .main-nav {
            display: flex;
            gap: 4px;
            align-items: center;
        }
        .main-nav a {
            color: var(--text-muted);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem; 
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.25s var(--bezier-lux);
        }
        .main-nav a i {
            font-size: 0.85rem;
            opacity: 0.8;
        }
        .main-nav a:hover, .main-nav a.active {
            color: var(--accent);
            background: var(--accent-soft);
        }
        
        /* Hamburger Mobile Menu Button */
        .mobile-burger-btn {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 22px;
            height: 15px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            z-index: 1010;
        }
        .mobile-burger-btn span {
            width: 100%;
            height: 2px;
            background-color: var(--text-heading);
            border-radius: 2px;
            transition: all 0.3s var(--bezier-lux);
            transform-origin: left center;
        }
        .mobile-burger-btn.open span:nth-child(1) { transform: rotate(45deg) translateY(-1px); }
        .mobile-burger-btn.open span:nth-child(2) { opacity: 0; transform: scale(0); }
        .mobile-burger-btn.open span:nth-child(3) { transform: rotate(-45deg) translateY(1px); }

        /* Fullscreen Mobile Overlay Menu */
        .mobile-navigation-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            z-index: 1005;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding-left: 40px;
            gap: 16px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s var(--bezier-lux);
        }
        .mobile-navigation-overlay.open { opacity: 1; pointer-events: auto; }
        .mobile-navigation-overlay a {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-heading);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transform: translateY(15px);
            opacity: 0;
            transition: transform 0.4s var(--bezier-lux), opacity 0.3s ease;
        }
        .mobile-navigation-overlay.open a { transform: translateY(0); opacity: 1; }
        .mobile-navigation-overlay a i { color: var(--accent); width: 24px; text-align: center; }

        /* --- HERO SLIDESHOW WITH OPTIMIZED CONTRAST DIMMER --- */
        .hero-carousel-wrapper {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(15,23,42,0.08);
            margin-bottom: 28px;
            background: #090d16;
        }
        .hero-swiper-instance { width: 100%; }
        .hero-structural-slide {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 80px 60px;
            min-height: 520px;
            box-sizing: border-box;
            width: 100%;
        }
        .hero-slide-kinetics-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            z-index: 1;
            transform: scale(1.02);
            transition: transform 8s ease-out;
        }
        .swiper-slide-active .hero-slide-kinetics-bg { transform: scale(1.12); }
        
        /* Dimmer Overlay yang Diperkuat untuk Perlindungan Kontras */
        .hero-slide-dimmer {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(10, 15, 30, 0.88) 0%, rgba(15, 23, 42, 0.65) 50%, rgba(15, 23, 42, 0.4) 100%);
            z-index: 2;
        }
        
        .hero-inside-shell {
            position: relative;
            z-index: 3;
            max-width: 620px;
            color: #ffffff;
        }
        /* MODIFIKASI: Judul Dibuat Sangat Terang Ultra-Kontras & Anti-Washed Out */
        .hero-inside-shell h1 {
            font-size: clamp(1.8rem, 3.5vw, 2.6rem); 
            line-height: 1.15;
            margin: 0 0 16px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #ffffff !important;
            text-shadow: 0 2px 12px rgba(0, 0, 0, 0.55), 0 4px 30px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s var(--bezier-lux) 0.15s;
        }
        .hero-inside-shell p {
            font-size: clamp(0.9rem, 1.2vw, 1rem); 
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 1px 6px rgba(0, 0, 0, 0.4);
            margin: 0 0 28px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s var(--bezier-lux) 0.3s;
        }
        .hero-actions-container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s var(--bezier-lux) 0.45s;
        }
        .swiper-slide-active .hero-inside-shell h1,
        .swiper-slide-active .hero-inside-shell p,
        .swiper-slide-active .hero-actions-container { opacity: 1; transform: translateY(0); }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 24px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s var(--bezier-lux);
        }
        .hero-btn.primary { background: var(--accent); color: #fff; box-shadow: 0 10px 25px rgba(29,124,242,0.2); }
        .hero-btn.primary:hover { transform: translateY(-2px); box-shadow: 0 14px 30px rgba(29,124,242,0.35); }
        .hero-btn.secondary { background: rgba(255, 255, 255, 0.12); color: #fff; border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
        .hero-btn.secondary:hover { background: #fff; color: var(--text-heading); transform: translateY(-2px); }
        
        .hero-dynamic-pagination {
            position: absolute;
            bottom: 24px !important;
            right: 32px !important;
            left: auto !important;
            width: auto !important;
            z-index: 10;
        }
        .hero-dynamic-pagination .swiper-pagination-bullet {
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.4);
            opacity: 1;
            margin: 0 4px !important;
            transition: all 0.4s var(--bezier-lux);
        }
        .hero-dynamic-pagination .swiper-pagination-bullet-active { background: var(--accent); width: 24px; border-radius: 4px; }

        /* --- SECTION LAYOUT ARCHITECTURE --- */
        .section {
            margin-bottom: 28px;
            background: var(--surface);
            border-radius: 24px;
            padding: 36px;
            box-shadow: 0 10px 35px rgba(16, 39, 83, 0.02);
            border: 1px solid var(--border);
            box-sizing: border-box;
        }
        .section-header { margin-bottom: 28px; }
        .section-header h2 { font-size: 1.65rem; margin: 0 0 8px; color: var(--text-heading); font-weight: 800; letter-spacing: -0.01em; }
        .section-header p { margin: 0; color: var(--text-muted); font-size: 0.95rem; max-width: 580px; line-height: 1.5; }
        
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
        .feature-card { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(16, 39, 83, 0.02); transition: all 0.3s var(--bezier-lux); height: 100%; box-sizing: border-box; }
        .feature-card:hover { transform: translateY(-6px); box-shadow: 0 16px 36px rgba(16, 39, 83, 0.07); border-color: transparent; }
        .feature-card h3 { margin: 0 0 8px; font-size: 1.1rem; color: var(--text-heading); font-weight: 700; }
        .feature-card p { margin: 0; color: var(--text-muted); font-size: 0.88rem; line-height: 1.6; }
        .feature-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; background: var(--accent-soft); color: var(--accent); font-size: 1.25rem; }
        
        .content-grid { display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 24px; }
        .card-surface { background: #fff; border: 1px solid var(--border); border-radius: 24px; padding: 32px; box-shadow: 0 6px 24px rgba(16, 39, 83, 0.02); box-sizing: border-box; }
        .mini-grid { display: grid; grid-template-columns: 1fr; gap: 16px; margin-top: 20px; }
        .mini-card { background: var(--surface-soft); border: 1px solid var(--border); border-radius: 16px; padding: 20px; }
        .mini-card strong { display: block; margin-bottom: 6px; color: var(--text-heading); font-size: 1rem; }
        .mini-card span { color: var(--text-muted); font-size: 0.88rem; line-height: 1.6; display: block; }
        
        .portfolio { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px; }
        .portfolio-item { background: #fff; border: 1px solid var(--border); border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(16, 39, 83, 0.02); transition: all 0.3s var(--bezier-lux); height: 100%; display: flex; flex-direction: column; }
        .portfolio-item:hover { transform: translateY(-5px); box-shadow: 0 16px 36px rgba(16, 39, 83, 0.06); }
        .portfolio-item img { width: 100%; aspect-ratio: 16/10; object-fit: cover; display: block; }
        .portfolio-meta { padding: 20px; flex-grow: 1; }
        .portfolio-meta h4 { margin: 0 0 6px; font-size: 1.05rem; color: var(--text-heading); }
        .portfolio-meta p { margin: 0; color: var(--text-muted); font-size: 0.88rem; line-height: 1.6; }
        
        .testimonial-card { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(16, 39, 83, 0.02); box-sizing: border-box; display: flex; flex-direction: column; height: 100%; }
        .testimonial-card strong { display: block; font-size: 0.95rem; color: var(--text-heading); margin-bottom: 2px; }
        .testimonial-card p { margin: 0; color: var(--text-muted); font-size: 0.88rem; line-height: 1.6; font-style: italic; }
        .testimonial-swiper { padding: 8px 2px 40px 2px; }
        
        .contact-side { display: grid; gap: 20px; align-content: start; }
        .contact-box { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(16, 39, 83, 0.02); box-sizing: border-box; }
        .contact-box h3 { margin: 0 0 16px; color: var(--text-heading); font-size: 1.15rem; font-weight: 700; }
        .contact-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; }
        .contact-item i { margin-top: 3px; color: var(--accent); font-size: 0.95rem; width: 16px; text-align: center; }
        .contact-item strong { display: block; color: var(--text-heading); font-size: 0.9rem; margin-bottom: 1px; }
        .contact-item span { display: block; color: var(--text-muted); font-size: 0.88rem; line-height: 1.4; }
        
        /* Gaya Khusus Komponen Ikon Media Sosial */
        .social-medias-wrapper {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }
        .social-node-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--surface-soft);
            border: 1px solid var(--border);
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            transition: all 0.25s var(--bezier-lux);
        }
        .social-node-link:hover {
            background: var(--accent);
            color: #ffffff;
            transform: translateY(-2px);
            border-color: transparent;
            box-shadow: 0 6px 14px rgba(29, 124, 242, 0.2);
        }

        .footer-text { color: var(--text-muted); font-size: 0.88rem; text-align: center; margin: 16px 0; }

        /* --- GALLERY POPUP ENGINE --- */
        .gallery-grid-system { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
        .gallery-node-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4/3;
            cursor: pointer;
            box-shadow: 0 6px 24px rgba(16, 39, 83, 0.02);
            border: 1px solid var(--border);
            background: #fff;
        }
        .gallery-node-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s var(--bezier-lux); }
        .gallery-node-card:hover img { transform: scale(1.06) rotate(0.5deg); }
        .gallery-node-blur-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 50%, rgba(15, 23, 42, 0.85) 100%);
            opacity: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            transition: opacity 0.35s ease;
            z-index: 2;
        }
        .gallery-node-card:hover .gallery-node-blur-overlay { opacity: 1; }
        .gallery-node-caption { color: #fff; margin: 0; font-size: 0.88rem; font-weight: 500; transform: translateY(10px); transition: transform 0.35s var(--bezier-lux); }
        .gallery-node-card:hover .gallery-node-caption { transform: translateY(0); }
        
        .gallery-node-trigger {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0.7);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            font-size: 0.9rem;
            z-index: 3;
        }
        .gallery-node-card:hover .gallery-node-trigger { opacity: 1; transform: scale(1); }

        .glass-lightbox-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 19, 32, 0);
            backdrop-filter: blur(0px);
            -webkit-backdrop-filter: blur(0px);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: background 0.4s ease, backdrop-filter 0.4s ease, opacity 0.4s ease;
            padding: 20px;
        }
        .glass-lightbox-overlay.active {
            background: rgba(11, 19, 32, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            opacity: 1;
            pointer-events: auto;
        }
        .lightbox-window {
            position: relative;
            max-width: 85vw;
            max-height: 75vh;
            transform: scale(0.85) translateY(20px);
            opacity: 0;
            transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.35s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .glass-lightbox-overlay.active .lightbox-window { transform: scale(1) translateY(0); opacity: 1; }
        .lightbox-core-img { max-width: 100%; max-height: 65vh; object-fit: contain; border-radius: 16px; box-shadow: 0 25px 60px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); }
        .lightbox-floating-text { color: #fff; text-align: center; margin-top: 12px; font-size: 1rem; font-weight: 500; text-shadow: 0 2px 8px rgba(0,0,0,0.5); }
        .lightbox-dismiss-btn {
            position: absolute;
            top: -45px;
            right: 0;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s var(--bezier-lux);
            font-size: 1rem;
        }
        .lightbox-dismiss-btn:hover { background: #fff; color: #0b1320; transform: scale(1.05); }

        /* --- STABLE MOBILE RESPONSIVENESS --- */
        @media (max-width: 991px) {
            .main-nav { display: none; }
            .mobile-burger-btn { display: flex; }
            .content-grid { grid-template-columns: 1fr; gap: 20px; }
            .hero-structural-slide { padding: 60px 40px; min-height: 460px; }
            .section { padding: 28px; }
        }
        
        @media (max-width: 640px) {
            .main-header { padding: 12px 16px; margin-bottom: 12px; border-radius: 0 0 12px 12px; }
            .hero-carousel-wrapper { border-radius: 16px; }
            .hero-structural-slide { padding: 40px 20px; min-height: 400px; }
            .hero-dynamic-pagination { right: 16px !important; bottom: 16px !important; }
            .section { padding: 20px 16px; border-radius: 16px; margin-bottom: 16px; }
            .section-header h2 { font-size: 1.45rem; }
            .section-header p { font-size: 0.88rem; }
            .cards-grid, .portfolio, .gallery-grid-system { grid-template-columns: 1fr; gap: 14px; }
            .feature-card, .portfolio-item, .card-surface, .contact-box { padding: 18px; border-radius: 16px; }
            .glass-lightbox-overlay { padding: 10px; }
            .lightbox-dismiss-btn { right: 4px; top: -40px; }
        }

        .animate-up{opacity:0; transform:translateY(16px); animation:reveal 0.75s var(--bezier-lux) forwards; animation-delay:var(--delay,0ms);}
        @keyframes reveal{to{opacity:1; transform:none;}}
    </style>
@endsection

@section('content')
<div class="container">
    <header class="main-header">
        <div class="main-logo">
            <img src="{{ $record->logo ? asset($record->logo) : asset('images/hero-default.jpg') }}" alt="logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover">
            <div style="line-height:1">{{ $record->company_name }}</div>
        </div>
        <nav class="main-nav" aria-label="Main navigation">
            <a href="#hero" class="nav-link"><i class="fas fa-home"></i>Home</a>
            <a href="#services" class="nav-link"><i class="fas fa-briefcase"></i>Services</a>
            <a href="#portfolio" class="nav-link"><i class="fas fa-folder-open"></i>Portfolio</a>
            <!--a href="#gallery" class="nav-link"><i class="fas fa-images"></i>Gallery</a -->
            <a href="#about" class="nav-link"><i class="fas fa-building"></i>About</a>
            <a href="#team" class="nav-link"><i class="fas fa-users"></i>Team</a>
            <a href="#contact" class="nav-link"><i class="fas fa-address-book"></i>Contact</a>
            <!--a href="#testimonials" class="nav-link"><i class="fas fa-comment-dots"></i>Testimonials</a -->
            <a href="#insights" class="nav-link"><i class="fas fa-newspaper"></i>Insights</a>
            @if(isset($website) && $website->Maps)<a href="#find-us" class="nav-link"><i class="fas fa-map-marked-alt"></i>Find us</a>@endif
        </nav>
        <button class="mobile-burger-btn" id="mobileMenuBtn" aria-label="Toggle Navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <div class="mobile-navigation-overlay" id="mobileNavOverlay">
        <a href="#hero" class="mobile-nav-link"><i class="fas fa-home"></i>Home</a>
        <a href="#services" class="mobile-nav-link"><i class="fas fa-briefcase"></i>Services</a>
        <a href="#portfolio" class="mobile-nav-link"><i class="fas fa-folder-open"></i>Portfolio</a>
        <a href="#gallery" class="mobile-nav-link"><i class="fas fa-images"></i>Gallery</a>
        <a href="#about" class="mobile-nav-link"><i class="fas fa-building"></i>About</a>
        <a href="#team" class="mobile-nav-link"><i class="fas fa-users"></i>Team</a>
        <a href="#contact" class="mobile-nav-link"><i class="fas fa-address-book"></i>Contact</a>
        <a href="#testimonials" class="mobile-nav-link"><i class="fas fa-comment-dots"></i>Testimonials</a>
        <a href="#insights" class="mobile-nav-link"><i class="fas fa-newspaper"></i>Insights</a>
        @if(isset($website) && $website->Maps)<a href="#find-us" class="mobile-nav-link"><i class="fas fa-map-marked-alt"></i>Find us</a>@endif
    </div>

    <section id="hero" class="hero-carousel-wrapper animate-up" style="--delay:40ms">
        <div class="swiper hero-swiper-instance">
            <div class="swiper-wrapper">
                @if($hero && $hero->count() > 0)
                    @foreach($hero as $index => $h)
                    <div class="swiper-slide hero-structural-slide">
                        <div class="hero-slide-kinetics-bg" style="background-image: url('{{ asset($h->background_image) }}')"></div>
                        <div class="hero-slide-dimmer"></div>
                        <div class="hero-inside-shell">
                            <h1>{{ $h->title }}</h1>
                            <p>{{ $h->subtitle }}</p>
                            <div class="hero-actions-container">
                                <a class="hero-btn primary" href="{{ $h->button_link ?? '#contact' }}">{{ $h->button_text ?? 'Contact Us' }}</a>
                                <a class="hero-btn secondary" href="{{ $record->website ?? '#' }}" target="_blank" rel="noopener">Visit Website</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="swiper-slide hero-structural-slide">
                        <div class="hero-slide-kinetics-bg" style="background-image: url('{{ asset('images/hero-default.jpg') }}')"></div>
                        <div class="hero-slide-dimmer"></div>
                        <div class="hero-inside-shell">
                            <h1>{{ $record->company_name }}</h1>
                            <p>{{ $record->tagline ?? 'Expert solutions tailored for corporate success.' }}</p>
                            <div class="hero-actions-container">
                                <a class="hero-btn primary" href="#contact">Get Started</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="swiper-pagination hero-dynamic-pagination"></div>
        </div>
    </section>

    <section id="services" class="section animate-up" style="--delay:80ms">
        <div class="section-header">
            <h2>Our services</h2>
            <p>Key company capabilities presented as quick-read feature cards with thoughtful spacing and icon accents.</p>
        </div>
        <div class="cards-grid">
            @foreach($services->take(4) as $s)
            <a href="{{ url('/services/view/'.$s->id) }}" style="text-decoration:none;color:inherit;display:block">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-briefcase"></i></div>
                    <h3>{{ $s->name }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($s->description), 110) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <section id="portfolio" class="section animate-up" style="--delay:120ms">
        <div class="section-header">
            <h2>Featured portfolio</h2>
            <p>Showcase of recent work with clean image cards and compelling project summaries.</p>
        </div>
        <div class="portfolio">
            @foreach($portfolios->take(4) as $p)
            <a href="{{ url('/portfolios/view/'.$p->id) }}" style="text-decoration:none;color:inherit;display:block">
                <div class="portfolio-item">
                    <img src="{{ $p->image ? asset($p->image) : asset('images/portfolio-placeholder.jpg') }}" alt="{{ $p->title }}" loading="lazy">
                    <div class="portfolio-meta">
                        <h4>{{ $p->title }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($p->description), 110) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <section id="gallery" class="section animate-up" style="--delay:140ms">
        <div class="section-header">
            <h2>Our Gallery</h2>
            <p>Documentation of our company activities and professional events. Click any frame to zoom.</p>
        </div>
        <div class="gallery-grid-system">
            @foreach($galleries->take(8) as $g)
            <div class="gallery-node-card js-lightbox-trigger" data-src="{{ asset($g->image) }}" data-caption="{{ $g->caption ?? 'Gallery Snapshot' }}">
                <img src="{{ $g->image ? asset($g->image) : asset('images/portfolio-placeholder.jpg') }}" alt="{{ $g->caption ?? 'Gallery Image' }}" loading="lazy">
                <div class="gallery-node-trigger">
                    <i class="fas fa-expand-alt"></i>
                </div>
                <div class="gallery-node-blur-overlay">
                    <p class="gallery-node-caption">{{ $g->caption ?? 'Corporate Activity' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <div class="content-grid">
        <div id="about" class="card-surface animate-up" style="--delay:160ms">
            <div class="section-header">
                <h2>About {{ $record->company_name }}</h2>
                <p>A polished company profile with trusted corporate messaging, professional structure, and clear business value.</p>
            </div>
            <p style="color: var(--text-main); line-height: 1.65; font-size: 0.92rem; margin-bottom: 20px;">{!! nl2br(e($record->description)) !!}</p>
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
            <div id="contact" class="contact-box animate-up" style="--delay:180ms">
                <h3>Contact us</h3>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Address</strong>
                        <span>{{ $record->address }}</span>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email</strong>
                        <span><a href="mailto:{{ $record->email }}">{{ $record->email }}</a></span>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Phone</strong>
                        <span><a href="tel:{{ $record->phone }}">{{ $record->phone }}</a></span>
                    </div>
                </div>

                @if(isset($website) && $website->whatsapp_number)
                <div style="margin-top: 16px;"><a href="https://wa.me/{{ ltrim($website->whatsapp_number,'+') }}" class="btn btn-success w-100" style="border-radius: 12px; font-weight: 700; padding: 10px; font-size:0.9rem;" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp me-2"></i>Hubungi Kami</a></div>
                @endif

                @if(isset($socials) && $socials->count() > 0)
                <div class="social-medias-wrapper">
                    @foreach($socials as $soc)
                    <a href="{{ $soc->url }}" target="_blank" rel="noopener noreferrer" class="social-node-link" title="{{ $soc->name }}">
                        @php
                            $iconClass = 'fas fa-link';
                            if(!empty($soc->icon)) {
                                $iconClass = $soc->icon;
                            } else {
                                $lowName = strtolower($soc->name);
                                if(str_contains($lowName, 'facebook')) $iconClass = 'fab fa-facebook-f';
                                elseif(str_contains($lowName, 'instagram')) $iconClass = 'fab fa-instagram';
                                elseif(str_contains($lowName, 'twitter') || str_contains($lowName, 'x.')) $iconClass = 'fab fa-x-twitter';
                                elseif(str_contains($lowName, 'linkedin')) $iconClass = 'fab fa-linkedin-in';
                                elseif(str_contains($lowName, 'youtube')) $iconClass = 'fab fa-youtube';
                                elseif(str_contains($lowName, 'tiktok')) $iconClass = 'fab fa-tiktok';
                            }
                        @endphp
                        <i class="{{ $iconClass }}"></i>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

            <div id="team" class="contact-box animate-up" style="--delay:200ms">
                <h3>Team members</h3>
                <div style="display: flex; flex-direction: column; gap: 14px;">
                    @foreach($teams->take(6) as $t)
                    <div class="d-flex align-items-center" style="gap:12px;">
                        <img src="{{ $t->photo ? asset($t->photo) : asset('images/user-placeholder.png') }}" class="rounded-circle" style="width:46px;height:46px;object-fit:cover;flex-shrink:0;" loading="lazy" alt="{{ $t->name }}">
                        <div>
                            <div style="font-weight: 700; color: var(--text-heading); font-size: 0.92rem;">{{ $t->name }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $t->position }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>

    <section id="testimonials" class="section animate-up" style="--delay:220ms; margin-top: 24px;">
        <div class="section-header">
            <h2>What people say</h2>
            <p>Testimonials that reinforce trust, expertise, and professional delivery.</p>
        </div>
        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $tt)
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="d-flex" style="gap:12px; align-items:center; margin-bottom: 14px;">
                            <img src="{{ $tt->photo ? asset($tt->photo) : asset('images/user-placeholder.png') }}" class="rounded-circle" style="width:48px;height:48px;object-fit:cover;" loading="lazy" alt="{{ $tt->client_name }}">
                            <div>
                                <strong>{{ $tt->client_name }}</strong>
                                <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $tt->company_name ?? '' }}</div>
                            </div>
                        </div>
                        <p>{{ \Illuminate\Support\Str::limit($tt->testimonial, 220) }}</p>
                        <div style="margin-top: auto; padding-top: 12px;">
                            @php $r = $tt->rating ?? 5; @endphp
                            @for($i=1;$i<=5;$i++)
                                <i class="{{ $i <= $r ? 'fas' : 'far' }} fa-star" style="color:#f5b301; font-size: 0.8rem; margin-right:1px"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination" style="bottom: 0px !important;"></div>
        </div>
    </section>

    <section id="insights" class="section animate-up" style="--delay:240ms">
        <div class="section-header">
            <h2>Latest Insights</h2>
            <p>Recent blog updates to keep visitors informed and connected with the company’s expertise.</p>
        </div>
        <div class="cards-grid">
            @foreach($blogs->take(4) as $b)
            <a href="{{ url('/blogs/view/'.$b->id) }}" style="text-decoration:none;color:inherit;display:block">
                <div class="feature-card" style="padding: 14px;">
                    <img src="{{ $b->thumbnail ? asset($b->thumbnail) : asset('images/blog-placeholder.jpg') }}" alt="{{ $b->title }}" loading="lazy" style="width:100%; aspect-ratio: 16/10; object-fit: cover; border-radius:14px; margin-bottom:14px;">
                    <h3 style="font-size: 1rem; margin-bottom: 6px;">{{ $b->title }}</h3>
                    <p style="font-size: 0.85rem; line-height:1.5;">{{ \Illuminate\Support\Str::limit(strip_tags($b->description ?? ''), 100) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    @if(isset($website) && $website->Maps)
    <section id="find-us" class="section animate-up" style="--delay:260ms">
        <div class="section-header">
            <h2>Find us</h2>
            <p>Interactive map and location details for quick direction and contact.</p>
        </div>
        <div class="card-surface" style="padding: 8px; overflow: hidden; border-radius: 16px;">
            {!! $website->Maps !!}
        </div>
    </section>
    @endif

    <footer class="section animate-up" style="--delay:280ms; background: transparent; box-shadow: none; border: none; margin-bottom:0;">
        <p class="footer-text">{{ $website->footer_text ?? '' }}</p>
    </footer>
</div>

<div class="glass-lightbox-overlay" id="galleryLightbox" role="dialog" aria-modal="true">
    <div class="lightbox-window">
        <button class="lightbox-dismiss-btn" id="lightboxClose" aria-label="Close window"><i class="fas fa-times"></i></button>
        <img src="" alt="Enlarged visualization" class="lightbox-core-img" id="lightboxImg">
        <div class="lightbox-floating-text" id="lightboxText"></div>
    </div>
</div>
@endsection

@section('pagejs')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            if(typeof AOS !== 'undefined') AOS.init({ duration: 800, once: true });

            // Swiper Hero
            try {
                const heroSwiper = new Swiper('.hero-swiper-instance', {
                    slidesPerView: 1,
                    effect: 'fade',
                    fadeEffect: { crossFade: true },
                    loop: true,
                    speed: 1200,
                    autoplay: { delay: 6000, disableOnInteraction: false },
                    pagination: { el: '.hero-dynamic-pagination', clickable: true }
                });
            } catch(e) { console.warn(e); }

            // Mobile Burger Logic
            try {
                const burgerBtn = document.getElementById('mobileMenuBtn');
                const navOverlay = document.getElementById('mobileNavOverlay');
                const mobileLinks = document.querySelectorAll('.mobile-nav-link');

                function toggleMobileMenu() {
                    burgerBtn.classList.toggle('open');
                    navOverlay.classList.toggle('open');
                    document.body.style.overflow = navOverlay.classList.contains('open') ? 'hidden' : '';
                }

                burgerBtn.addEventListener('click', toggleMobileMenu);
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        toggleMobileMenu();
                        const href = link.getAttribute('href');
                        if(href && href.startsWith('#')) {
                            const target = document.querySelector(href);
                            if(target) {
                                setTimeout(() => {
                                    const headerHeight = document.querySelector('.main-header').offsetHeight;
                                    const top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 10;
                                    window.scrollTo({ top, behavior: 'smooth' });
                                }, 300);
                            }
                        }
                    });
                });
            } catch(e) { console.warn(e); }

            // Desktop Nav Link Tracker
            try{
                const headerEl = document.querySelector('.main-header');
                const headerHeight = headerEl ? headerEl.offsetHeight : 0;
                const navLinks = document.querySelectorAll('.main-nav a');
                
                navLinks.forEach(link =>{
                    link.addEventListener('click', function(e){
                        const href = this.getAttribute('href');
                        if(href && href.startsWith('#')){
                            e.preventDefault();
                            const target = document.querySelector(href);
                            if(target){
                                const top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 10;
                                window.scrollTo({ top, behavior: 'smooth' });
                            }
                        }
                    });
                });

                const sections = Array.from(document.querySelectorAll('#hero, #services, #portfolio, #gallery, #about, #team, #contact, #testimonials, #insights, #find-us'));
                window.addEventListener('scroll', function(){
                    const scrollPos = window.pageYOffset + headerHeight + 30;
                    let currentId = null;
                    for(const sec of sections){
                        if(sec && sec.offsetTop <= scrollPos){ currentId = sec.id; }
                    }
                    navLinks.forEach(l=> l.classList.toggle('active', l.getAttribute('href') === ('#'+currentId)));
                });
            }catch(e){ console.warn(e); }

            // Testimonial Swiper
            try{
                new Swiper('.testimonial-swiper', {
                    slidesPerView:3,
                    spaceBetween:16,
                    loop:true,
                    pagination:{ el: '.swiper-pagination', clickable:true },
                    autoplay:{ delay:5000, disableOnInteraction: false },
                    breakpoints:{
                        0:{ slidesPerView:1 },
                        768:{ slidesPerView:2 },
                        1024:{ slidesPerView:3 }
                    }
                });
            }catch(e) { console.warn(e); }

            // Lightbox Pop-up System
            try {
                const lightbox = document.getElementById('galleryLightbox');
                const lightboxImg = document.getElementById('lightboxImg');
                const lightboxText = document.getElementById('lightboxText');
                const closeBtn = document.getElementById('lightboxClose');
                const triggers = document.querySelectorAll('.js-lightbox-trigger');

                triggers.forEach(card => {
                    card.addEventListener('click', function() {
                        lightboxImg.setAttribute('src', this.getAttribute('data-src'));
                        lightboxText.textContent = this.getAttribute('data-caption');
                        lightbox.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    });
                });

                function deactivateLightbox() {
                    lightbox.classList.remove('active');
                    document.body.style.overflow = '';
                }

                closeBtn.addEventListener('click', deactivateLightbox);
                lightbox.addEventListener('click', function(e) {
                    if (e.target === lightbox || e.target.classList.contains('lightbox-window')) deactivateLightbox();
                });
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && lightbox.classList.contains('active')) deactivateLightbox();
                });
            } catch(err) { console.warn(err); }

            @if(Session::has('success'))
                Swal.fire({ icon: 'success', title: 'Success', text: {!! json_encode(Session::get('success')) !!} });
            @endif

            @if(Session::has('danger'))
                Swal.fire({ icon: 'error', title: 'Error', text: {!! json_encode(Session::get('danger')) !!} });
            @endif
        });
    </script>
@endsection