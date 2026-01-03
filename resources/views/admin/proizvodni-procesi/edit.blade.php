@extends('layouts.app')

@section('title', 'Izmena proizvodnog procesa')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admin Panel</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.proizvodni-procesi.index') }}">Proizvodni procesi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Izmena serije #{{ $proces->broj_serije }}</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Izmena proizvodnog procesa
                    </h4>
                    <div>
                        <span class="badge bg-light text-dark fs-6">Serija #{{ $proces->broj_serije }}</span>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('admin.proizvodni-procesi.update', $proces->id) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                                           value="{{ old('broj_serije', $proces->broj_serije) }}" 
                                           placeholder="Npr: SER-2024-001" required>
                                    @error('broj_serije')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                            <option value="{{ $proizvod->id }}" 
                                                {{ old('proizvod_id', $proces->proizvod_id) == $proizvod->id ? 'selected' : '' }}>
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
                                            <option value="{{ $vrsta->id }}" 
                                                {{ old('vrsta_cokolade_id', $proces->vrsta_cokolade_id) == $vrsta->id ? 'selected' : '' }}>
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
                                           value="{{ old('datum_pocetka', date('Y-m-d', strtotime($proces->datum_pocetka))) }}" required>
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
                                           value="{{ old('datum_zavrsetka', $proces->datum_zavrsetka ? date('Y-m-d', strtotime($proces->datum_zavrsetka)) : '') }}">
                                    @error('datum_zavrsetka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <label for="status" class="form-label fw-bold">
                                        <i class="fas fa-tasks text-primary me-1"></i>
                                        Status *
                                    </label>
                                    <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="planiran" {{ old('status', $proces->status) == 'planiran' ? 'selected' : '' }}>Planirano</option>
                                        <option value="u_toku" {{ old('status', $proces->status) == 'u_toku' ? 'selected' : '' }}>U toku</option>
                                        <option value="zavrseno" {{ old('status', $proces->status) == 'zavrseno' ? 'selected' : '' }}>Završeno</option>
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
                                           value="{{ old('kolicina_proizvedena', $proces->kolicina_proizvedena) }}" 
                                           min="1" required>
                                    @error('kolicina_proizvedena')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                           value="{{ old('ukupna_cena', $proces->ukupna_cena) }}" 
                                           min="0">
                                    @error('ukupna_cena')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sirovine section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">
                                            <i class="fas fa-list-check text-primary me-2"></i>
                                            Sirovine za proizvodnju
                                        </h6>
                                        <div class="row">
                                            @foreach($sirovine as $sirovina)
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                           id="sirovina_{{ $sirovina->id }}" 
                                                           name="sirovine[]" 
                                                           value="{{ $sirovina->id }}">
                                                    <label class="form-check-label" for="sirovina_{{ $sirovina->id }}">
                                                        {{ $sirovina->naziv }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <div>
                                <a href="{{ route('admin.proizvodni-procesi.show', $proces->id) }}" 
                                   class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-eye me-2"></i> Pregled
                                </a>
                                <a href="{{ route('admin.proizvodni-procesi.index') }}" 
                                   class="btn btn-outline-dark btn-lg ms-2">
                                    <i class="fas fa-arrow-left me-2"></i> Nazad
                                </a>
                            </div>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-warning btn-lg px-5">
                                    <i class="fas fa-save me-2"></i> Sačuvaj izmene
                                </button>
                                <a href="{{ route('admin.proizvodni-procesi.create') }}" 
                                   class="btn btn-success btn-lg ms-2">
                                    <i class="fas fa-plus me-2"></i> Novi proces
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete section -->
            <div class="card border-danger border-2 mt-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Opasna zona
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-danger mb-3">
                        <strong>Upozorenje:</strong> Brisanje je trajna operacija i ne može se poništiti.
                    </p>
                    <form action="{{ route('admin.proizvodni-procesi.destroy', $proces->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Da li ste SIGURNI da želite da obrišete ovaj proizvodni proces? Ova akcija je nepovratna!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fas fa-trash-alt me-2"></i> Obriši ovaj proces
                        </button>
                    </form>
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
    
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .border-danger {
        border-width: 2px !important;
    }
</style>

<script>
    // Auto-calculate total price based on quantity
    document.getElementById('kolicina_proizvedena').addEventListener('input', function() {
        const quantity = this.value;
        const priceInput = document.getElementById('ukupna_cena');
        
        // Only suggest if price is currently 0 or empty
        if ((!priceInput.value || priceInput.value == 0) && quantity > 0) {
            const suggestedPrice = quantity * 50; // 50 RSD per unit as example
            priceInput.value = suggestedPrice.toFixed(2);
        }
    });
    
    // Set end date to 7 days after start date if empty
    document.getElementById('datum_pocetka').addEventListener('change', function() {
        const startDate = new Date(this.value);
        const endDateInput = document.getElementById('datum_zavrsetka');
        
        if (!endDateInput.value) {
            startDate.setDate(startDate.getDate() + 7);
            const formattedDate = startDate.toISOString().split('T')[0];
            endDateInput.value = formattedDate;
        }
    });
    
    // Confirm before deleting
    document.querySelector('form[onsubmit]').addEventListener('submit', function(e) {
        if (!confirm('JESTE LI SIGURNI? Ova akcija će trajno obrisati proizvodni proces i sve povezane podatke!')) {
            e.preventDefault();
        }
    });
</script>
@endsection