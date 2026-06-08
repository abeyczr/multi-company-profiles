<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
@php $pageTitle = "Dashboard"; @endphp
@extends($layout)
@section('title', $pageTitle)
@section('pagecss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    .stat-card{ border-radius:12px; padding:18px; background:linear-gradient(180deg, #0b1220, #0f1724); color:#e6eef8; box-shadow:0 10px 30px rgba(2,6,23,0.6); }
    .stat-icon{ font-size:28px; opacity:0.9 }
    .recent-list .item{ padding:12px; border-bottom:1px solid rgba(255,255,255,0.03); }
    .glass-soft{ background: rgba(255,255,255,0.02); border-radius:10px; padding:12px }
    .sparkline{ height:48px }
</style>
@endsection
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="mb-0">Dashboard</h2>
            <small class="text-muted">Overview & quick insights</small>
        </div>
        <div>
            <a href="/companyprofiles/add" class="btn btn-primary">Add Company</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-6 col-md-3">
            <div class="stat-card text-center">
                <div class="stat-icon mb-2"><i class="fas fa-building"></i></div>
                <div class="h3">{{ $counts['companies'] ?? 0 }}</div>
                <div class="small-muted">Companies</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center">
                <div class="stat-icon mb-2"><i class="fas fa-concierge-bell"></i></div>
                <div class="h3">{{ $counts['services'] ?? 0 }}</div>
                <div class="small-muted">Services</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center">
                <div class="stat-icon mb-2"><i class="fas fa-briefcase"></i></div>
                <div class="h3">{{ $counts['portfolios'] ?? 0 }}</div>
                <div class="small-muted">Portfolios</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center">
                <div class="stat-icon mb-2"><i class="fas fa-users"></i></div>
                <div class="h3">{{ $counts['teams'] ?? 0 }}</div>
                <div class="small-muted">Team Members</div>
            </div>
        </div>
    </div>

    <div class="row mt-3 g-3">
        <div class="col-lg-8">
            <div class="glass-soft">
                <h5>Blog Activity</h5>
                <canvas id="blogsChart" height="120"></canvas>
            </div>

            <div class="glass-soft mt-3">
                <h5 class="mb-3">Recent Messages</h5>
                <div class="recent-list">
                    @foreach($recent_messages as $m)
                    <div class="item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-bold">{{ $m->name }} <small class="text-muted">({{ $m->email }})</small></div>
                            <div class="small-muted">{{ \Illuminate\Support\Str::limit($m->message, 120) }}</div>
                        </div>
                        <div class="text-end small-muted">{{ \Carbon\Carbon::parse($m->created_at)->diffForHumans() }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="glass-soft">
                <h5>Quick Stats</h5>
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div>Unread Messages</div>
                    <div class="fw-bold">{{ $counts['messages_unread'] ?? 0 }}</div>
                </div>
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div>Testimonials</div>
                    <div class="fw-bold">{{ $counts['testimonials'] ?? 0 }}</div>
                </div>
                <hr />
                <h6>Recent Companies</h6>
                <ul class="list-unstyled">
                    @foreach($recent_companies as $c)
                    <li class="py-2"><a href="/companyprofiles/view/{{ $c->id }}">{{ $c->company_name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection

@section('pagejs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/countup.js@2.0.7/dist/countUp.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const ctx = document.getElementById('blogsChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months->toArray()) !!},
            datasets: [{
                label: 'Blogs published',
                data: {!! json_encode($values->toArray()) !!},
                borderColor: '#4dabf7',
                backgroundColor: 'rgba(77,171,247,0.12)',
                fill: true,
                tension:0.3
            }]
        },
        options: { responsive:true, plugins:{ legend:{ display:false } } }
    });
});
</script>
@endsection
