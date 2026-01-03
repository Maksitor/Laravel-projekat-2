@extends('layouts.app')

@section('title', 'Kreiraj novi proizvodni proces')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admin Panel</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.proizvodni-procesi.index') }}">Proizvodni procesi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kreiraj novi proces</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Kreiraj novi proizvodni proces
                    </h4>
                </div>
            </div>

            <!-- Form -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('admin.proizvodni-procesi.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Left column -->
                            <div class="col-md-6">
                                <!-- Broj serije -->
                                <div class="mb-4">
                                    <label for="broj_serije" class="form-label fw-bold">
                                        <i class="fas fa-hashtag text-primary me-1"></i>
                                        Broj serije *
                                    </label>
                                    <input type="text" class="form-control form-control-lg @error('broj_serije') is-invalid @enderror" 
                                           id="broj_serije" name="broj_serije" 
                                           value="{{ old('broj_serije') }}" 
                                           placeholder="Npr: SER-2024-001" required>
                                    @error('broj_serije')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Unesite jedinstveni broj serije</small>
                                </div>

                                <!-- Proizvod -->
                                <div class="mb-4">
                                    <label for="proizvod_id" class="form-label fw-bold">
                                        <i class="fas fa-box text-primary me-1"></i>
                                        Proizvod *
                                    </label>
                                    <select class="form-select form-select-lg @error('proizvod_id') is-invalid @enderror" 
                                            id="proizvod_id" name="proizvod_id" required>
                                        <option value="">-- Izaberite proizvod --</option>
                                        @foreach($proizvodi as $proizvod)
                                            <option value="{{ $proizvod->id }}" {{ old('proizvod_id') == $proizvod->id ? 'selected' : '' }}>
                                                {{ $proizvod->naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('proizvod_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Vrsta čokolade -->
                                <div class="mb-4">
                                    <label for="vrsta_cokolade_id" class="form-label fw-bold">
                                        <i class="fas fa-cookie-bite text-primary me-1"></i>
                                        Vrsta čokolade *
                                    </label>
                                    <select class="form-select form-select-lg @error('vrsta_cokolade_id') is-invalid @enderror" 
                                            id="vrsta_cokolade_id" name="vrsta_cokolade_id" required>
                                        <option value="">-- Izaberite vrstu čokolade --</option>
                                        @foreach($vrste as $vrsta)
                                            <option value="{{ $vrsta->id }}" {{ old('vrsta_cokolade_id') == $vrsta->id ? 'selected' : '' }}>
                                                {{ $vrsta->naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('vrsta_cokolade_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Right column -->
                            <div class="col-md-6">
                                <!-- Datum početka -->
                                <div class="mb-4">
                                    <label for="datum_pocetka" class="form-label fw-bold">
                                        <i class="fas fa-calendar-alt text-primary me-1"></i>
                                        Datum početka *
                                    </label>
                                    <input type="date" class="form-control form-control-lg @error('datum_pocetka') is-invalid @enderror" 
                                           id="datum_pocetka" name="datum_pocetka" 
                                           value="{{ old('datum_pocetka', date('Y-m-d')) }}" required>
                                    @error('datum_pocetka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Datum završetka -->
                                <div class="mb-4">
                                    <label for="datum_zavrsetka" class="form-label fw-bold">
                                        <i class="fas fa-calendar-check text-primary me-1"></i>
                                        Datum završetka
                                    </label>
                                    <input type="date" class="form-control form-control-lg @error('datum_zavrsetka') is-invalid @enderror" 
                                           id="datum_zavrsetka" name="datum_zavrsetka" 
                                           value="{{ old('datum_zavrsetka') }}">
                                    @error('datum_zavrsetka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Ostavite prazno ako još nije završeno</small>
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <label for="status" class="form-label fw-bold">
                                        <i class="fas fa-tasks text-primary me-1"></i>
                                        Status *
                                    </label>
                                    <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="">-- Izaberite status --</option>
                                        <option value="planiran" {{ old('status') == 'planiran' ? 'selected' : '' }}>Planirano</option>
                                        <option value="u_toku" {{ old('status') == 'u_toku' ? 'selected' : '' }}>U toku</option>
                                        <option value="zavrseno" {{ old('status') == 'zavrseno' ? 'selected' : '' }}>Završeno</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Bottom row -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Količina proizvedena -->
                                <div class="mb-4">
                                    <label for="kolicina_proizvedena" class="form-label fw-bold">
                                        <i class="fas fa-cubes text-primary me-1"></i>
                                        Količina proizvedena (kom) *
                                    </label>
                                    <input type="number" class="form-control form-control-lg @error('kolicina_proizvedena') is-invalid @enderror" 
                                           id="kolicina_proizvedena" name="kolicina_proizvedena" 
                                           value="{{ old('kolicina_proizvedena', 100) }}" 
                                           min="1" required>
                                    @error('kolicina_proizvedena')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Unesite broj komada</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Ukupna cena -->
                                <div class="mb-4">
                                    <label for="ukupna_cena" class="form-label fw-bold">
                                        <i class="fas fa-money-bill-wave text-primary me-1"></i>
                                        Ukupna cena (RSD)
                                    </label>
                                    <input type="number" step="0.01" class="form-control form-control-lg @error('ukupna_cena') is-invalid @enderror" 
                                           id="ukupna_cena" name="ukupna_cena" 
                                           value="{{ old('ukupna_cena') }}" 
                                           min="0" placeholder="0.00">
                                    @error('ukupna_cena')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Unesite ukupnu cenu proizvodnje</small>
                                </div>
                            </div>
                        </div>

                        <!-- Additional section for sirovine (if you want to use it later) -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">
                                            <i class="fas fa-list-check text-primary me-2"></i>
                                            Sirovine za proizvodnju
                                        </h6>
                                        <p class="text-muted mb-0">
                                            Sirovine će moći da se dodaju nakon kreiranja procesa.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('admin.proizvodni-procesi.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i> Otkaži
                            </a>
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                <i class="fas fa-save me-2"></i> Kreiraj proces
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick tips -->
            <div class="card border-0 bg-light mt-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Saveti za unos:
                    </h6>
                    <ul class="mb-0">
                        <li>Broj serije mora biti jedinstven</li>
                        <li>Datum završetka mora biti nakon datuma početka</li>
                        <li>Status "Završeno" automatski zaključava proces</li>
                        <li>Količina mora biti veća od 0</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-lg, .form-select-lg {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s;
    }
    
    .form-control-lg:focus, .form-select-lg:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .btn-lg {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
    }
    
    .card {
        border-radius: 12px;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .form-label {
        color: #495057;
    }
    
    .text-muted {
        color: #6c757d !important;
    }
</style>

<script>
    // Auto-set end date to 7 days from start date
    document.getElementById('datum_pocetka').addEventListener('change', function() {
        const startDate = new Date(this.value);
        const endDateInput = document.getElementById('datum_zavrsetka');
        
        if (!endDateInput.value) {
            // Add 7 days to start date
            startDate.setDate(startDate.getDate() + 7);
            const formattedDate = startDate.toISOString().split('T')[0];
            endDateInput.value = formattedDate;
        }
    });
    
    // Auto-calculate total price based on quantity
    document.getElementById('kolicina_proizvedena').addEventListener('input', function() {
        const quantity = this.value;
        const priceInput = document.getElementById('ukupna_cena');
        
        // If price is empty, suggest a price (e.g., 50 RSD per unit)
        if (!priceInput.value && quantity > 0) {
            const suggestedPrice = quantity * 50;
            priceInput.value = suggestedPrice.toFixed(2);
        }
    });
</script>
@endsection