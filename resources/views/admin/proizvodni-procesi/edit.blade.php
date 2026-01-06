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
                    <li class="breadcrumb-item active">Izmena serije #{{ $proces->serijski_broj }}</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center py-3">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Izmena proizvodnog procesa</h4>
                    <span class="badge bg-light text-dark fs-6">Serija #{{ $proces->serijski_broj }}</span>
                </div>
            </div>

            <!-- Form -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.proizvodni-procesi.update', $proces->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-4">
                                    <label class="form-label fw-bold">serijski_broj *</label>
                                    <input type="text" 
                                           name="serijski_broj" 
                                           class="form-control form-control-lg @error('serijski_broj') is-invalid @enderror"
                                           value="{{ old('serijski_broj', $proces->serijski_broj) }}" 
                                           required>
                                    @error('serijski_broj')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Proizvod -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Proizvod *</label>
                                    <select name="proizvod_id" class="form-select form-select-lg" required>
                                        @foreach($proizvodi as $proizvod)
                                            <option value="{{ $proizvod->id }}" 
                                                {{ old('proizvod_id', $proces->proizvod_id) == $proizvod->id ? 'selected' : '' }}>
                                                {{ $proizvod->naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Vrsta čokolade -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Vrsta čokolade *</label>
                                    <select name="vrsta_cokolade_id" class="form-select form-select-lg" required>
                                        @foreach($vrste as $vrsta)
                                            <option value="{{ $vrsta->id }}"
                                                {{ old('vrsta_cokolade_id', $proces->vrsta_cokolade_id) == $vrsta->id ? 'selected' : '' }}>
                                                {{ $vrsta->naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <!-- Datum početka -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Datum početka *</label>
                                    <input type="date" name="datum_pocetka" 
                                           class="form-control form-control-lg"
                                           value="{{ old('datum_pocetka', $proces->datum_pocetka) }}" required>
                                </div>

                                <!-- Datum završetka -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Datum završetka</label>
                                    <input type="date" name="datum_zavrsetka" 
                                           class="form-control form-control-lg"
                                           value="{{ old('datum_zavrsetka', $proces->datum_zavrsetka) }}">
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Status *</label>
                                    <select name="status" class="form-select form-select-lg" required>
                                        <option value="planiran" {{ old('status', $proces->status) == 'planiran' ? 'selected' : '' }}>Planirano</option>
                                        <option value="u_toku" {{ old('status', $proces->status) == 'u_toku' ? 'selected' : '' }}>U toku</option>
                                        <option value="zavrseno" {{ old('status', $proces->status) == 'zavrseno' ? 'selected' : '' }}>Završeno</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <!-- Količina i ukupna cena -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Količina (kom)</label>
                                <input type="number" name="kolicina_proizvoda" 
                                       class="form-control form-control-lg" 
                                       value="{{ old('kolicina_proizvoda', $proces->kolicina_proizvoda) }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Ukupna cena (RSD)</label>
                                <input type="number" step="0.01" name="ukupna_cena" 
                                       class="form-control form-control-lg" 
                                       value="{{ old('ukupna_cena', $proces->ukupna_cena) }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                            <a href="{{ route('admin.proizvodni-procesi.index') }}" class="btn btn-outline-dark btn-lg">⬅ Nazad</a>
                            <button type="submit" class="btn btn-warning btn-lg px-5">💾 Sačuvaj izmene</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
