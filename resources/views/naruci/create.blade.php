@extends('layouts.app')

@section('title', 'Narucivanje proizvoda')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

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

                <form method="POST" action="{{ route('naruci.store') }}" id="narudzbinaForm">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ime i prezime *</label>
                            <input type="text" name="ime_kupca" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email adresa *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefon *</label>
                            <input type="text" name="telefon" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Izaberite proizvod *</label>
                            <select id="proizvod_id" name="proizvod_id" class="form-select" required>
                                <option value="">-- Izaberite cokoladu --</option>
                                @foreach($proizvodi as $proizvod)
                                    <option value="{{ $proizvod->id }}" data-cena="{{ $proizvod->cena }}">
                                        {{ $proizvod->naziv }} - {{ number_format($proizvod->cena, 2) }} RSD
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kolicina *</label>
                            <input type="number" id="kolicina" name="kolicina" class="form-control" value="1" min="1">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ukupna cena</label>
                            <input type="text" id="ukupna_cena" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adresa za dostavu *</label>
                        <textarea name="adresa" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Napomena</label>
                        <textarea name="napomena" class="form-control" rows="2"></textarea>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const proizvod = document.getElementById('proizvod_id');
    const kolicina = document.getElementById('kolicina');
    const ukupno = document.getElementById('ukupna_cena');

    function racunaj() {
        const cena = proizvod.selectedOptions[0]?.dataset.cena || 0;
        ukupno.value = (cena * kolicina.value).toFixed(2) + ' RSD';
    }

    proizvod.addEventListener('change', racunaj);
    kolicina.addEventListener('input', racunaj);
    racunaj();
});
</script>
@endsection
