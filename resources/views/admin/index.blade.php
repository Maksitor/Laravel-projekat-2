@extends('layouts.app')

@section('title', 'Admin Panel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-cog me-2"></i> Administrativni Panel</h4>
                    <span class="badge bg-danger">Administrator</span>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        Dobrodosli u Admin Panel, <strong>{{ Auth::user()->name }}</strong>!
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-3 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h1 class="display-4">5</h1>
                                    <p class="mb-0">Proizvoda</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h1 class="display-4">12</h1>
                                    <p class="mb-0">Sirovina</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h1 class="display-4">3</h1>
                                    <p class="mb-0">Aktivne serije</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h1 class="display-4">47</h1>
                                    <p class="mb-0">Narudžbine</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="mt-4 mb-3">Brzi linkovi</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.proizvodni-procesi') }}" class="card text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-industry fa-2x mb-2 text-primary"></i>
                                    <h5>Proizvodni procesi</h5>
                                    <p class="text-muted mb-0">Upravljaj proizvodnim serijama</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="/sirovine" class="card text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-boxes fa-2x mb-2 text-success"></i>
                                    <h5>Sirovine</h5>
                                    <p class="text-muted mb-0">Pregled i upravljanje sirovinama</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="/proizvodi" class="card text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-cookie-bite fa-2x mb-2 text-warning"></i>
                                    <h5>Proizvodi</h5>
                                    <p class="text-muted mb-0">Upravljaj proizvodima</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Korisnici sistema</h6>
                                    <ul class="list-group list-group-flush">
                                        @php
                                            $users = \App\Models\User::take(5)->get();
                                        @endphp
                                        @foreach($users as $user)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $user->name }}
                                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                                {{ $user->role }}
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Sistemske informacije</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Server vreme:</strong></td>
                                                    <td>{{ now()->format('d.m.Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>PHP verzija:</strong></td>
                                                    <td>{{ phpversion() }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Laravel verzija:</strong></td>
                                                    <td>{{ app()->version() }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Ulogovani korisnik:</strong></td>
                                                    <td>{{ Auth::user()->name }} ({{ Auth::user()->email }})</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Korisnička uloga:</strong></td>
                                                    <td>
                                                        <span class="badge bg-danger">Administrator</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection