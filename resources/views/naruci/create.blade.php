@extends('layouts.app')

@section('title', 'Narucivanje proizvoda')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">

        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Narucite nasu cokoladu</h3>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        <h5>Uspesno ste narucili!</h5>
                        <p class="mb-0">Broj narudzbine: <strong>{{ session('narudzbina_broj') }}</strong></p>
                        <p class="mb-0">Ukupna cena: <strong>{{ session('ukupna_cena') }} RSD</strong></p>
                        <p class="mb-0">Status: <span class="badge bg-info">kreirana</span></p>
                    </div>
                @endif

                <form method="POST" action="{{ route('naruci.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Ime i prezime *</label>
                        <input type="text" name="ime_kupca" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email adresa *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefon *</label>
                        <input type="text" name="telefon" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adresa za dostavu *</label>
                        <textarea name="adresa" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ukupna cena (RSD) *</label>
                        <input type="number" step="0.01" name="ukupna_cena" class="form-control" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-lg">Posalji narudzbinu</button>
                        <a href="/" class="btn btn-outline-secondary">Nazad na pocetnu</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
