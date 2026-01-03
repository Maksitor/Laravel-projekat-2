@extends('layouts.app')

@section('title', 'Detalji proizvodnog procesa')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admin Panel</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.proizvodni-procesi.index') }}">Proizvodni procesi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalji serije #{{ $proces->broj_serije }}</li>
                </ol>
            </nav>

            <!-- Header card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-industry me-2"></i>
                        Detalji proizvodnog procesa
                    </h4>
                    <div>
                        <span class="badge bg-light text-dark fs-6">Serija #{{ $proces->broj_serije }}</span>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="row">
                <!-- Left column - Basic Info -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Osnovne informacije
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <i class="fas fa-hashtag text-primary me-2"></i>
                                        <strong>Broj serije</strong>
                                    </div>
                                    <span class="badge bg-primary fs-6">{{ $proces->broj_serije }}</span>
                                </div>
                                
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <i class="fas fa-box text-primary me-2"></i>
                                        <strong>Proizvod</strong>
                                    </div>
                                    <span class="text-end">{{ $proces->proizvod->naziv ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <i class="fas fa-cookie-bite text-primary me-2"></i>
                                        <strong>Vrsta čokolade</strong>
                                    </div>
                                    <span class="text-end">{{ $proces->vrstaCokolade->naziv ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <i class="fas fa-tasks text-primary me-2"></i>
                                        <strong>Status</strong>
                                    </div>
                                    <span class="badge 
                                        @if($proces->status == 'zavrseno') bg-success
                                        @elseif($proces->status == 'u_toku') bg-warning text-dark
                                        @else bg-secondary @endif fs-6">
                                        {{ ucfirst(str_replace('_', ' ', $proces->status)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right column - Timeline & Quantities -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Vremenski okvir i količine
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <i class="fas fa-play-circle text-success me-2"></i>
                                        <strong>Datum početka</strong>
                                    </div>
                                    <span class="text-end">{{ date('d.m.Y.', strtotime($proces->datum_pocetka)) }}</span>
                                </div>
                                
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <i class="fas fa-flag-checkered text-danger me-2"></i>
                                        <strong>Datum završetka</strong>
                                    </div>
                                    <span class="text-end">
                                        @if($proces->datum_zavrsetka)
                                            {{ date('d.m.Y.', strtotime($proces->datum_zavrsetka)) }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </span>
                                </div>
                                
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <i class="fas fa-cubes text-info me-2"></i>
                                        <strong>Količina proizvedena</strong>
                                    </div>
                                    <span class="text-end fs-5 fw-bold">
                                        {{ number_format($proces->kolicina_proizvedena, 0) }} kom
                                    </span>
                                </div>
                                
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                                        <strong>Ukupna cena</strong>
                                    </div>
                                    <span class="text-end fs-5 fw-bold text-success">
                                        @if($proces->ukupna_cena && $proces->ukupna_cena > 0)
                                            {{ number_format($proces->ukupna_cena, 2) }} RSD
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Duration calculation -->
            @if($proces->datum_zavrsetka)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-muted small">Trajanje proizvodnje</div>
                                    <div class="h4 mb-0">
                                        @php
                                            $start = new DateTime($proces->datum_pocetka);
                                            $end = new DateTime($proces->datum_zavrsetka);
                                            $interval = $start->diff($end);
                                            echo $interval->days . ' dana';
                                        @endphp
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-muted small">Proizvodnost</div>
                                    <div class="h4 mb-0">
                                        @if($proces->datum_zavrsetka && $interval->days > 0)
                                            @php
                                                $daily_production = $proces->kolicina_proizvedena / $interval->days;
                                                echo number_format($daily_production, 0) . ' kom/dan';
                                            @endphp
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-muted small">Cena po komadu</div>
                                    <div class="h4 mb-0">
                                        @if($proces->ukupna_cena && $proces->kolicina_proizvedena > 0)
                                            @php
                                                $price_per_unit = $proces->ukupna_cena / $proces->kolicina_proizvedena;
                                                echo number_format($price_per_unit, 2) . ' RSD/kom';
                                            @endphp
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action buttons -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('admin.proizvodni-procesi.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Nazad na listu
                            </a>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('admin.proizvodni-procesi.edit', $proces->id) }}" 
                               class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i> Izmeni
                            </a>
                            <form action="{{ route('admin.proizvodni-procesi.destroy', $proces->id) }}" 
                                  method="POST" class="d-inline ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj proizvodni proces?')">
                                    <i class="fas fa-trash me-1"></i> Obriši
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional info if available -->
            @if($proces->napomene)
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-sticky-note me-2"></i>
                        Napomene
                    </h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $proces->napomene }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .card-header {
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
    }
    
    .list-group-item {
        border-left: 0;
        border-right: 0;
    }
    
    .list-group-item:first-child {
        border-top: 0;
    }
    
    .list-group-item:last-child {
        border-bottom: 0;
    }
    
    .badge {
        padding: 0.5em 1em;
        font-weight: 500;
    }
    
    .text-muted {
        color: #6c757d !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>
@endsection