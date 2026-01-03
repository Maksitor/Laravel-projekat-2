@extends('layouts.app')

@section('title', 'Proizvodni procesi')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Proizvodni procesi</h3>

                <a href="{{ route('proizvodni-procesi.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Novi proces
                </a>
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
                                <th>Vrsta cokolade</th>
                                <th>Datum pocetka</th>
                                <th>Datum zavrsetka</th>
                                <th>Kolicina</th>
                                <th>Status</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($procesi as $proces)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td class="fw-bold">
                                        {{ $proces->broj_serije }}
                                    </td>

                                    <td>{{ $proces->proizvod->naziv ?? 'N/A' }}</td>
                                    <td>{{ $proces->vrstaCokolade->naziv ?? 'N/A' }}</td>

                                    <td>{{ $proces->datum_pocetka->format('d.m.Y.') }}</td>

                                    <td>
                                        @if($proces->datum_zavrsetka)
                                            {{ $proces->datum_zavrsetka->format('d.m.Y.') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>{{ $proces->kolicina_proizvedena }} kom</td>

                                    <td>
                                        @if($proces->status === 'zavrseno')
                                            <span class="badge-status badge-available">Zavrseno</span>
                                        @elseif($proces->status === 'u_toku')
                                            <span class="badge-status badge-out">U toku</span>
                                        @else
                                            <span class="badge-status badge-available">Planirano</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('proizvodni-procesi.show', $proces->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Detalji
                                        </a>

                                        <a href="{{ route('proizvodni-procesi.edit', $proces->id) }}"
                                           class="btn btn-sm btn-outline-warning">
                                            Izmeni
                                        </a>

                                        <form action="{{ route('proizvodni-procesi.destroy', $proces->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Da li ste sigurni?')">
                                                Obrisi
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        Nema proizvodnih procesa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($procesi->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $procesi->links() }}
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
