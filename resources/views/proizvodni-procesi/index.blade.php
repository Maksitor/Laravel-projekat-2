@extends('layouts.app')

@section('title', 'Proizvodni procesi')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Proizvodni procesi</h3>

                {{-- Dugme vidi samo ADMIN --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.proizvodni-procesi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Novi proces
                        </a>
                    @endif
                @endauth
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Broj serije</th>
                                <th>Proizvod</th>
                                <th>Vrsta čokolade</th>
                                <th>Datum početka</th>
                                <th>Datum završetka</th>
                                <th>Količina</th>
                                <th>Status</th>

                                {{-- Kolona akcije samo za admina --}}
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <th>Akcije</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($procesi as $proces)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold">{{ $proces->broj_serije ?? 'SER-' . $proces['id'] }}</td>
                                    <td>{{ $proces->proizvod->naziv ?? ($proces['naziv'] ?? 'N/A') }}</td>
                                    <td>{{ $proces->vrstaCokolade->naziv ?? ($proces['vrsta'] ?? 'N/A') }}</td>
                                    <td>
                                        @if(isset($proces->datum_pocetka))
                                            {{ $proces->datum_pocetka->format('d.m.Y.') }}
                                        @elseif(isset($proces['datum']))
                                            {{ date('d.m.Y.', strtotime($proces['datum'])) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($proces->datum_zavrsetka))
                                            {{ $proces->datum_zavrsetka->format('d.m.Y.') }}
                                        @elseif(isset($proces['datum_zavrsetka']))
                                            {{ date('d.m.Y.', strtotime($proces['datum_zavrsetka'])) }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $proces->kolicina_proizvedena ?? ($proces['kolicina'] ?? 0) }} kom</td>
                                    <td>
                                        @php
                                            $status = $proces->status ?? $proces['status'] ?? 'planirano';
                                        @endphp
                                        @if($status === 'zavrseno' || $status === 'završeno')
                                            <span class="badge bg-success">Završeno</span>
                                        @elseif($status === 'u_toku' || $status === 'u toku')
                                            <span class="badge bg-warning text-dark">U toku</span>
                                        @else
                                            <span class="badge bg-secondary">Planirano</span>
                                        @endif
                                    </td>

                                    {{-- Akcije samo za admina --}}
                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <td>
                                                <a href="{{ route('admin.proizvodni-procesi.show', $proces->id ?? $proces['id']) }}" class="btn btn-sm btn-outline-primary">
                                                    Detalji
                                                </a>

                                                <a href="{{ route('admin.proizvodni-procesi.edit', $proces->id ?? $proces['id']) }}" class="btn btn-sm btn-outline-warning">
                                                    Izmeni
                                                </a>

                                                <form action="{{ route('admin.proizvodni-procesi.destroy', $proces->id ?? $proces['id']) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Da li ste sigurni?')">
                                                        Obriši
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Nema proizvodnih procesa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginacija - samo ako postoji i ako je to Eloquent kolekcija --}}
                @if(isset($procesi) && method_exists($procesi, 'hasPages') && $procesi->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $procesi->links() }}
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection