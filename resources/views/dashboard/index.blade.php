@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#ede9fe">
                    <i class="bi bi-people-fill" style="color:#7c3aed;font-size:1.3rem"></i>
                </div>
                <div>
                    <div style="font-size:1.6rem;font-weight:700;color:#1e293b;line-height:1">{{ $totalUsers }}</div>
                    <div style="font-size:0.78rem;color:#64748b;font-weight:500">Total Users</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fef3c7">
                    <i class="bi bi-journal-richtext" style="color:#d97706;font-size:1.3rem"></i>
                </div>
                <div>
                    <div style="font-size:1.6rem;font-weight:700;color:#1e293b;line-height:1">{{ $totalMenuItems }}</div>
                    <div style="font-size:0.78rem;color:#64748b;font-weight:500">Total Menu Items</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#dcfce7">
                    <i class="bi bi-check-circle-fill" style="color:#16a34a;font-size:1.3rem"></i>
                </div>
                <div>
                    <div style="font-size:1.6rem;font-weight:700;color:#1e293b;line-height:1">{{ $availableCount }}</div>
                    <div style="font-size:0.78rem;color:#64748b;font-weight:500">Available Items</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#e0e7ff">
                    <i class="bi bi-card-list" style="color:#4f46e5;font-size:1.3rem"></i>
                </div>
                <div>
                    <div style="font-size:1.6rem;font-weight:700;color:#1e293b;line-height:1">{{ $myMenuItems }}</div>
                    <div style="font-size:0.78rem;color:#64748b;font-weight:500">My Menu Items</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-600 mb-1" style="color:#1e293b;font-weight:600">Users Registered (Last 6 Months)</h6>
                <p class="text-muted small mb-3">Monthly new registrations</p>
                <canvas id="userChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="mb-1" style="color:#1e293b;font-weight:600">Menu Availability</h6>
                <p class="text-muted small mb-3">Available vs Unavailable</p>
                <canvas id="availabilityChart" height="160"></canvas>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <span class="small"><span style="display:inline-block;width:12px;height:12px;background:#4f46e5;border-radius:3px;margin-right:4px"></span>Available</span>
                    <span class="small"><span style="display:inline-block;width:12px;height:12px;background:#e2e8f0;border-radius:3px;margin-right:4px"></span>Unavailable</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-1" style="color:#1e293b;font-weight:600">Items by Category</h6>
                <p class="text-muted small mb-3">Distribution of menu item categories</p>
                <canvas id="categoryChart" height="180"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3" style="color:#1e293b;font-weight:600">Quick Actions</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary text-start">
                        <i class="bi bi-person-plus me-2"></i>Add New User
                    </a>
                    <a href="{{ route('menu-items.create') }}" class="btn btn-outline-warning text-start">
                        <i class="bi bi-plus-circle me-2"></i>Add Menu Item
                    </a>
                    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary text-start">
                        <i class="bi bi-person-circle me-2"></i>Edit My Profile
                    </a>
                </div>
                <hr class="my-3">
                <div class="small text-muted">
                    <i class="bi bi-person me-1"></i>Logged in as <strong>{{ Auth::user()->name }}</strong>
                    <span class="ms-2 badge" style="background:#e0e7ff;color:#4f46e5">{{ Auth::user()->is_admin ? 'Admin' : 'User' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const primaryColor = '#4f46e5';
const chartDefaults = {
    plugins: { legend: { display: false } },
    scales: {
        x: { grid: { display: false }, ticks: { font: { size: 11 } } },
        y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 }, precision: 0 } }
    }
};

// Users by month
const userLabels = @json($usersByMonth->pluck('month'));
const userCounts = @json($usersByMonth->pluck('count'));

new Chart(document.getElementById('userChart'), {
    type: 'bar',
    data: {
        labels: userLabels.length ? userLabels : ['No data yet'],
        datasets: [{
            label: 'Users',
            data: userCounts.length ? userCounts : [0],
            backgroundColor: primaryColor,
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: { ...chartDefaults, plugins: { legend: { display: false } } }
});

// Availability donut
new Chart(document.getElementById('availabilityChart'), {
    type: 'doughnut',
    data: {
        labels: ['Available', 'Unavailable'],
        datasets: [{
            data: [{{ $availableCount }}, {{ $unavailableCount }}],
            backgroundColor: [primaryColor, '#e2e8f0'],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '70%',
        plugins: { legend: { display: false } }
    }
});

// Category bar
const catLabels = @json($itemsByCategory->pluck('category'));
const catCounts = @json($itemsByCategory->pluck('count'));
const catColors = ['#4f46e5','#7c3aed','#0891b2','#059669','#d97706','#dc2626'];

new Chart(document.getElementById('categoryChart'), {
    type: 'bar',
    data: {
        labels: catLabels.length ? catLabels : ['No data'],
        datasets: [{
            label: 'Items',
            data: catCounts.length ? catCounts : [0],
            backgroundColor: catLabels.map((_, i) => catColors[i % catColors.length]),
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: { ...chartDefaults, indexAxis: 'y', plugins: { legend: { display: false } } }
});
</script>
@endpush
