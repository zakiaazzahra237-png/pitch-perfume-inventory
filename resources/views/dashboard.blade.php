@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Dashboard</h4>
    <div class="badge px-3 py-2" style="background-color: var(--color-bg); color: var(--color-dark);">
        <i class="fa-solid fa-user me-1"></i> Zakia
    </div>
</div>

<div class="p-4 rounded-4 mb-4" style="background-color: var(--color-bg);">
    <h3 class="fw-bold mb-1">Halo, Zakia</h3>
    <p class="mb-0 text-secondary">Ready to start your day with managing perfume stocks?</p>
</div>

<h6 class="fw-bold text-secondary mb-3">Overview</h6>
<div class="row g-3">
    <div class="col-md-4">
        <div class="p-3 text-white rounded-4" style="background-color: #291C0E;">
            <span class="small opacity-75">Total Varian</span>
            <h2 class="fw-bold mb-0 mt-1">{{ $totalVariants }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 text-white rounded-4" style="background-color: #6E473B;">
            <span class="small opacity-75">Total Stok Botol</span>
            <h2 class="fw-bold mb-0 mt-1">{{ $totalStock ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 text-white rounded-4" style="background-color: #A78D78;">
            <span class="small opacity-75">Stok Kritis</span>
            <h2 class="fw-bold mb-0 mt-1">{{ $lowStock }}</h2>
        </div>
    </div>
</div>
@endsection