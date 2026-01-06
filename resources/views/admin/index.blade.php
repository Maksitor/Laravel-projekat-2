@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 text-primary mb-3">
                    <i class="fas fa-crown me-2"></i>Admin Panel
                </h1>
                <p class="lead">Dobrodošli u administracioni panel Chocolate Factory</p>
            </div>

            <!-- User Info Card -->
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-user-shield me-2"></i>
                        Informacije o nalogu
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-circle fa-3x text-primary"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                    <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="border rounded p-3 text-center mb-3">
                                        <div class="text-muted small">Uloga</div>
                                        <div class="h5 mb-0 text-primary">{{ auth()->user()->role }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-3 text-center mb-3">
                                        <div class="text-muted small">Član od</div>
                                        <div class="h5 mb-0">{{ auth()->user()->created_at->format('d.m.Y.') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row mb-5">
                <div class="col-md-3 col-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-industry fa-2x text-primary mb-3"></i>
                            <h3 class="mb-1">{{ \App\Models\ProizvodniProces::count() }}</h3>
                            <p class="text-muted mb-0">Procesa</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-box fa-2x text-success mb-3"></i>
                            <h3 class="mb-1">{{ \App\Models\Proizvod::count() }}</h3>
                            <p class="text-muted mb-0">Proizvoda</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-boxes fa-2x text-warning mb-3"></i>
                            <h3 class="mb-1">{{ \App\Models\Sirovina::count() }}</h3>
                            <p class="text-muted mb-0">Sirovina</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-cookie-bite fa-2x text-danger mb-3"></i>
                            <h3 class="mb-1">{{ \App\Models\VrstaCokolade::count() }}</h3>
                            <p class="text-muted mb-0">Vrsta čokolade</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stanje sirovina -->
            <div class="card mb-5">
                <div class="card-header bg-light">
                    <h4 class="mb-0"><i class="fas fa-boxes me-2"></i>Stanje sirovina</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Naziv sirovine</th>
                                    <th>Količina na stanju</th>
                                    <th>Jedinica mere</th>
                                    <th>Minimalna količina</th>
                                    <th>Cena po jedinici</th>
                                    <th>Status</th>
                                    <th>Vrednost zaliha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalVrednost = 0; @endphp
                                @foreach(\App\Models\Sirovina::all() as $sirovina)
                                    @php
                                        $vrednost = $sirovina->kolicina_na_stanju * $sirovina->cena_po_jedinici;
                                        $totalVrednost += $vrednost;
                                        $isLow = $sirovina->kolicina_na_stanju < $sirovina->min_kolicina;

                                        if ($sirovina->status === 'dostupno') {
                                            $statusClass = 'badge bg-success';
                                            $statusText = 'Dostupno';
                                        } elseif ($sirovina->status === 'nedostupno') {
                                            $statusClass = 'badge bg-secondary';
                                            $statusText = 'Nedostupno';
                                        } else {
                                            $statusClass = 'badge bg-danger';
                                            $statusText = 'Kritično';
                                        }
                                    @endphp
                                    <tr class="{{ $isLow ? 'table-warning' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sirovina->naziv }} @if($isLow) <span class="badge bg-danger ms-2">Nisko</span> @endif</td>
                                        <td>{{ number_format($sirovina->kolicina_na_stanju,2) }}</td>
                                        <td>{{ $sirovina->jedinica_mere }}</td>
                                        <td>{{ number_format($sirovina->min_kolicina,2) }}</td>
                                        <td>{{ number_format($sirovina->cena_po_jedinici,2) }} RSD</td>
                                        <td><span class="{{ $statusClass }}">{{ $statusText }}</span></td>
                                        <td>{{ number_format($vrednost,2) }} RSD</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-secondary">
                                    <td colspan="7" class="text-end fw-bold">Ukupna vrednost zaliha:</td>
                                    <td class="fw-bold">{{ number_format($totalVrednost,2) }} RSD</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-history me-2"></i>
                                Nedavna aktivnost
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @php
                                    $recentProcesses = \App\Models\ProizvodniProces::with('proizvod')
                                        ->orderBy('created_at', 'desc')
                                        ->limit(5)
                                        ->get();
                                @endphp
                                
                                @forelse($recentProcesses as $proces)
                                <a href="{{ route('admin.proizvodni-procesi.show', $proces->id) }}" class="list-group-item list-group-item-action border-0 py-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <i class="fas fa-industry text-primary me-2"></i>
                                            <strong>Serija #{{ $proces->broj_serije ?? $proces->serijski_broj }}</strong> - {{ $proces->proizvod->naziv ?? 'N/A' }}
                                        </div>
                                        <small class="text-muted">{{ $proces->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge 
                                            @if($proces->status == 'zavrsen') bg-success
                                            @elseif($proces->status == 'u_toku') bg-warning text-dark
                                            @else bg-secondary @endif">
                                            {{ ucfirst(str_replace('_',' ',$proces->status)) }}
                                        </span>
                                        <span class="text-muted ms-3">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ date('d.m.Y.', strtotime($proces->datum_pocetka)) }}
                                        </span>
                                    </div>
                                </a>
                                @empty
                                <div class="list-group-item border-0 py-3 text-center text-muted">
                                    Nema nedavne aktivnosti.
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.proizvodni-procesi.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle me-2"></i> Novi proizvodni proces
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .card { border-radius: 10px; transition: transform 0.2s; }
    .card:hover { transform: translateY(-3px); }
    .list-group-item:hover { background-color: #f8f9fa; }
</style>
@endsection
