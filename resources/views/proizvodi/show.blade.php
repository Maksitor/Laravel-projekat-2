@extends('layouts.app')

@section('title', $proizvod->naziv)

@section('content')
<div class="container my-5">
    <div class="row align-items-center">
        
        <!-- Slika proizvoda -->
        <div class="col-md-6 text-center mb-4 mb-md-0">
            @if($proizvod->slika)
                <img 
                    src="{{ asset($proizvod->slika) }}" 
                    class="img-fluid rounded shadow" 
                    alt="{{ $proizvod->naziv }}"
                    style="max-height: 450px; object-fit: cover;"
                >
            @else
                <img 
                    src="https://via.placeholder.com/500x400?text=Cokolada" 
                    class="img-fluid rounded shadow" 
                    alt="{{ $proizvod->naziv }}"
                >
            @endif
        </div>

        <!-- Podaci o proizvodu -->
        <div class="col-md-6">
            <h2 class="mb-3" style="color: var(--primary-brown);">
                {{ $proizvod->naziv }}
            </h2>

            <p class="text-muted" style="font-size: 1.1rem;">
                {{ $proizvod->opis }}
            </p>

            <h4 class="mt-4">
                Cena: <strong>{{ number_format($proizvod->cena, 2) }} RSD</strong>
            </h4>

            <p class="mt-2">
                Status:
                <span class="badge bg-{{ $proizvod->status === 'active' ? 'success' : 'secondary' }}">
                    {{ ucfirst($proizvod->status) }}
                </span>
            </p>

            <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-4">
                ← Nazad na početnu
            </a>
        </div>

    </div>
</div>
@endsection
