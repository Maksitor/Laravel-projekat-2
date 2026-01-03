@extends('layouts.app')

@section('title', 'Stanje sirovina')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Stanje sirovina u magacinu</h3>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Naziv sirovine</th>
                                <th>Kolicina na stanju</th>
                                <th>Jedinica mere</th>
                                <th>Minimalna kolicina</th>
                                <th>Cena po jedinici</th>
                                <th>Status</th>
                                <th>Vrednost zaliha</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $totalVrednost = 0; @endphp

                            @foreach($sirovine as $sirovina)
                                @php
                                    $vrednost = $sirovina->kolicina_na_stanju * $sirovina->cena_po_jedinici;
                                    $totalVrednost += $vrednost;

                                    $isLow = $sirovina->kolicina_na_stanju < $sirovina->min_kolicina;

                                    if ($sirovina->status === 'dostupno') {
                                        $statusClass = 'badge-available';
                                        $statusText = 'Dostupno';
                                    } elseif ($sirovina->status === 'nedostupno') {
                                        $statusClass = 'badge-out';
                                        $statusText = 'Nedostupno';
                                    } else {
                                        $statusClass = 'badge-critical';
                                        $statusText = 'Kriticno';
                                    }
                                @endphp

                                <tr class="{{ $isLow ? 'table-warning' : '' }}">
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $sirovina->naziv }}
                                        @if($isLow)
                                            <span class="badge bg-danger ms-2">Nisko</span>
                                        @endif
                                    </td>

                                    <td>{{ number_format($sirovina->kolicina_na_stanju, 2) }}</td>
                                    <td>{{ $sirovina->jedinica_mere }}</td>
                                    <td>{{ number_format($sirovina->min_kolicina, 2) }}</td>
                                    <td>{{ number_format($sirovina->cena_po_jedinici, 2) }} RSD</td>

                                    <td>
                                        <span class="badge-status {{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>

                                    <td>{{ number_format($vrednost, 2) }} RSD</td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="table-secondary">
                                <td colspan="7" class="text-end fw-bold">
                                    Ukupna vrednost zaliha:
                                </td>
                                <td class="fw-bold">
                                    {{ number_format($totalVrednost, 2) }} RSD
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                {{-- STATISTIKA --}}
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-number">
                                {{ $sirovine->where('status', 'dostupno')->count() }}
                            </div>
                            <div class="stat-label">Dostupno</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-number">
                                {{ $sirovine->where('status', 'nedostupno')->count() }}
                            </div>
                            <div class="stat-label">Nedostupno</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-number">
                                {{ $sirovine->where('status', 'kriticno')->count() }}
                            </div>
                            <div class="stat-label">Kriticno</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
