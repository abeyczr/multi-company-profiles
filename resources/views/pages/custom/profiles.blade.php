@inject('comp_model', 'App\Models\ComponentsData')
@php
    $hideHeaderFooter = true;
    $pageTitle = "Profiles"; // set dynamic page title
    // safe-get companies (public landing page, no auth)
    $companies = [];
    if(class_exists(\App\Models\CompanyProfiles::class)){
        try{
            $companies = \App\Models\CompanyProfiles::where('status','Aktif')
                ->orderBy('company_name','asc')
                ->get(["id","company_name","tagline","logo","favicon","slug","website"]);
        }catch(\Exception $e){
            $companies = [];
        }
    }
@endphp
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div class="py-5 bg-light modern-wrapper">
    <div class="abstract-glow-1"></div>
    <div class="abstract-glow-2"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row mb-5">
            <div class="col text-center header-section">
                <h1 class="display-5 fw-bold premium-gradient-title" data-aos="fade-down">Our Company Profiles</h1>
                <div class="title-divider mx-auto" data-aos="zoom-in" data-aos-delay="200"></div>
                <p class="lead text-muted custom-subtitle" data-aos="fade-up" data-aos-delay="100">Jelajahi profil singkat perusahaan mitra kami — elegan, profesional, dan responsif.</p>
            </div>
        </div>

        <div class="row g-4" id="profiles-list">
            @forelse($companies as $company)
            @php
                $hasSlug = !empty($company->slug);
                $profileUrl = $hasSlug ? url("/profiles/".$company->slug) : url("/profiles/id/".$company->id);
                $logo = $company->logo ? asset($company->logo) : asset('images/default-company.png');
            @endphp
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ $profileUrl }}" class="text-decoration-none text-reset target-card-link">
                    <div class="card h-100 shadow-sm profile-card premium-modern-card" loading="lazy" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="ratio ratio-16x9 overflow-hidden image-container-shell">
                            <img src="{{ $logo }}" alt="{{ $company->company_name }} logo" class="card-img-top object-fit-cover lazyimg" loading="lazy">
                            <div class="card-image-overlay-glow"></div>
                        </div>
                        <div class="card-body premium-body-layout">
                            <h5 class="card-title mb-1 company-main-title">{{ $company->company_name }}</h5>
                            @if($company->tagline)
                            <p class="text-muted small mb-3 tagline-text-clamped">{{ $company->tagline }}</p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-2 card-footer-action-row">
                                <span class="badge bg-primary premium-action-badge">
                                    View Profile <i class="fas fa-arrow-right ms-1 badge-arrow-icon"></i>
                                </span>
                                @if($company->website)
                                <small class="text-muted modern-domain-text">
                                    <i class="fas fa-globe me-1"></i>{{ parse_url($company->website, PHP_URL_HOST) }}
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12" data-aos="fade-up">
                <div class="alert alert-info custom-empty-state-alert text-center p-5">
                    <div class="empty-state-icon mb-3">
                        <i class="fas fa-building-circle-exclamation fa-3x text-muted"></i>
                    </div>
                    <h4 class="fw-bold text-secondary">No company profiles found.</h4>
                    <p class="text-muted mb-0 small">Belum ada profil perusahaan yang aktif saat ini.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('pagecss')
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
/* --- VARIABEL KODE WARNA PREMIUM --- */
:root {
    --primary-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    --text-gradient: linear-gradient(135deg, #1e293b 0%, #475569 100%);
    --accent-color: #2563eb;
    --accent-soft: rgba(37, 99, 235, 0.05);
    --card-border-radius: 18px;
    --bezier-smooth: cubic-bezier(0.16, 1, 0.3, 1);
}

/* --- WRAPPER UTAMA DENGAN GRADASI HALUS & ORNAMEN GLOW --- */
.modern-wrapper {
    background: radial-gradient(circle at 50% 0%, #f8fafc 0%, #f1f5f9 100%) !important;
    position: relative;
    overflow: hidden;
    min-height: 80vh;
}
.abstract-glow-1 {
    position: absolute;
    top: -10%; left: -10%; width: 40vw; height: 40vw;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.04) 0%, rgba(255,255,255,0) 70%);
    z-index: 1; pointer-events: none;
}
.abstract-glow-2 {
    position: absolute;
    bottom: -10%; right: -10%; width: 50vw; height: 50vw;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.03) 0%, rgba(255,255,255,0) 70%);
    z-index: 1; pointer-events: none;
}

/* --- DOKUMENTASI HEADER & JUDUL ELEGAN --- */
.header-section {
    max-width: 700px;
    margin: 0 auto;
}
.premium-gradient-title {
    font-size: clamp(2rem, 4vw, 2.75rem);
    background: var(--text-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.02em;
    margin-bottom: 16px;
}
.title-divider {
    width: 60px;
    height: 4px;
    background: var(--accent-color);
    border-radius: 99px;
    margin-bottom: 20px;
}
.custom-subtitle {
    font-size: clamp(0.95rem, 1.5vw, 1.1rem);
    line-height: 1.6;
    color: #64748b !important;
}

/* --- KARTU PROFIL PREMIUM MODERN --- */
.profile-card { 
    transform: translateY(12px); 
    opacity: 0; 
    transition: all 0.6s var(--bezier-smooth); 
    border-radius: var(--card-border-radius); 
    overflow: hidden; 
}
.profile-card.in-view { 
    transform: none; 
    opacity: 1; 
}

.premium-modern-card {
    border: 1px solid rgba(226, 232, 240, 0.8) !important;
    background: #ffffff !important;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.02) !important;
}
.target-card-link:hover .premium-modern-card {
    transform: translateY(-8px) !important;
    box-shadow: 0 20px 35px rgba(15, 23, 42, 0.08) !important;
    border-color: rgba(37, 99, 235, 0.2) !important;
}

/* --- MANIPULASI GAMBAR / LOGO PERUSAHAAN --- */
.image-container-shell {
    border-top-left-radius: var(--card-border-radius);
    border-top-right-radius: var(--card-border-radius);
    position: relative;
    background: #f8fafc;
    padding: 12px;
}
.profile-card .card-img-top { 
    width: 100%; 
    height: 100%; 
    object-fit: contain !important;
    padding: 24px;
    transition: transform 0.6s var(--bezier-smooth); 
}
.target-card-link:hover .card-img-top { 
    transform: scale(1.05); 
}
.card-image-overlay-glow {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(255,255,255,0) 60%, rgba(248,250,252,0.4) 100%);
    pointer-events: none;
}

/* --- KONTEN BODY KARTU --- */
.premium-body-layout {
    background: #ffffff !important;
    padding: 24px !important;
    display: flex;
    flex-direction: column;
}
.company-main-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #0f172a;
    transition: color 0.3s ease;
}
.target-card-link:hover .company-main-title {
    color: var(--accent-color);
}
.tagline-text-clamped {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-size: 0.88rem;
    color: #64748b;
    line-height: 1.5;
    min-height: 2.64rem; /* Mengunci tinggi baris agar layout sejajar */
}

/* --- ROW FOOTER & INTERAKSI MIKRO --- */
.card-footer-action-row {
    border-top: 1px solid #f1f5f9;
}
.premium-action-badge {
    background-color: var(--accent-soft) !important;
    color: var(--accent-color) !important;
    padding: 8px 14px !important;
    border-radius: 99px !important;
    font-size: 0.8rem !important;
    font-weight: 600 !important;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease !important;
}
.badge-arrow-icon {
    transition: transform 0.3s var(--bezier-smooth);
}
.target-card-link:hover .premium-action-badge {
    background-color: var(--accent-color) !important;
    color: #ffffff !important;
}
.target-card-link:hover .badge-arrow-icon {
    transform: translateX(4px);
}
.modern-domain-text {
    font-size: 0.82rem;
    color: #94a3b8 !important;
    font-weight: 500;
}

/* --- CUSTOM EMPTY STATE DESIGN --- */
.custom-empty-state-alert {
    background: rgba(255, 255, 255, 0.7) !important;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px dashed #cbd5e1 !important;
    border-radius: 20px !important;
}

/* responsive tweaks */
@media (max-width:576px){ 
    .display-5{ font-size:1.8rem !important; } 
    .premium-body-layout { padding: 18px !important; }
}
</style>
@endsection

@section('pagejs')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        if(typeof AOS !== 'undefined'){
            AOS.init({ duration: 700, once: true });
        }

        // Pengaman pemaksaan kelas pendukung in-view render langsung
        setTimeout(function() {
            document.querySelectorAll('.profile-card').forEach(function(card) {
                card.classList.add('in-view');
            });
        }, 50);

        @if(Session::has('success'))
            Swal.fire({ icon: 'success', title: 'Success', text: {!! json_encode(Session::get('success')) !!} });
        @endif

        @if(Session::has('danger'))
            Swal.fire({ icon: 'error', title: 'Error', text: {!! json_encode(Session::get('danger')) !!} });
        @endif
    });
    </script>
@endsection