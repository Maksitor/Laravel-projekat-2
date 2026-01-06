@extends('layouts.app')

@section('title', 'Pocetna')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Premium Cokolada</h1>
        <p class="lead mb-4 mx-auto" style="max-width: 700px; font-size: 1.2rem;">
            Nasa fabrika proizvodi najkvalitetniju cokoladu koristeci tradicionalne 
            metode i vrhunske sirovine iz celog sveta.
        </p>
        <div class="mt-4">
            <a href="{{ route('naruci.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-shopping-cart me-2"></i> Naruci odmah
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="mb-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="mb-3" style="color: var(--primary-brown);">Nasi proizvodi i usluge</h2>
                <p class="text-muted">Pruzamo vam potpuno iskustvo od proizvodnje do dostave</p>
            </div>
        </div>
        
        <div class="row justify-content-center g-4">
            <!-- Feature 1 -->
            <div class="col-md-4 d-flex">
                <div class="card h-100 border-0 flex-fill text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shopping-bag fa-2x"></i>
                        </div>
                        <h4 class="card-title mb-3">Online narucivanje</h4>
                        <p class="card-text text-muted">
                            Brzo i jednostavno narucite nase proizvode direktno sa sajta.
                            Selektujte kolicinu i vrstu cokolade po vasem izboru.
                        </p>
                        <a href="{{ route('naruci.create') }}" class="btn btn-outline-primary mt-2">Naruci</a>
                    </div>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="col-md-4 d-flex">
                <div class="card h-100 border-0 flex-fill text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-industry fa-2x"></i>
                        </div>
                        <h4 class="card-title mb-3">Proizvodni procesi</h4>
                        <p class="card-text text-muted">
                            Pracenje aktivnih proizvodnih serija, njihovog statusa 
                            i planiranje novih proizvodnih ciklusa.
                        </p>
                        <a href="/proizvodni-procesi" class="btn btn-outline-primary mt-2">Proizvodne serije</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="mb-5">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-12">
                <h2 style="color: var(--primary-brown);">Nasi proizvodi</h2>
                <p class="text-muted">Kliknite na dugme "Detaljnije" da vidite vise informacija o proizvodu</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($proizvodi as $proizvod)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm text-center">

                        @if($proizvod->slika)
                            <img src="{{ asset($proizvod->slika) }}"
                                 class="card-img-top"
                                 alt="{{ $proizvod->naziv }}"
                                 style="height:250px; object-fit:cover;">
                        @else
                            <img src="{{ asset('images/no-image.png') }}"
                                 class="card-img-top"
                                 alt="Nema slike"
                                 style="height:250px; object-fit:cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $proizvod->naziv }}</h5>
                            <p class="card-text text-muted" style="height:60px; overflow:hidden;">
                                {{ \Illuminate\Support\Str::limit($proizvod->opis, 100) }}
                            </p>
                            <a href="{{ route('proizvodi.show', $proizvod->id) }}" class="btn btn-primary mt-2">
                                Detaljnije
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Trenutno nema proizvoda.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
