@extends('layouts.app', [
    'activePage' => 'dashboard',
    'title' => 'Dashboard',
    'navName' => 'Data Analisis',
    'activeButton' => 'Dashboard'
])

@section('content')
<div class="p-4 p-md-6">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Earnings Overview Charts -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="text-primary mb-0 font-weight-bold">Earnings Overview</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center" style="height: 300px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-chart-line fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">Chart data will be displayed here</p>
                            <small>No data available yet</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="text-primary mb-0 font-weight-bold">Earnings Overview</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center" style="height: 300px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-chart-area fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">Chart data will be displayed here</p>
                            <small>No data available yet</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
