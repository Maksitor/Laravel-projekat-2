@extends('layouts.app')

@section('title', 'Registracija')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">

        <div class="card">
            <div class="card-header">Registracija</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Ime</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Lozinka</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Potvrda lozinke</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <!-- DROPDOWN ZA ULOGU -->
                    <div class="mb-3">
                        <label>Uloga</label>
                        <select name="role" class="form-select" required>
                            <option value="user" selected>Korisnik</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button class="btn btn-success w-100">Registruj se</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
