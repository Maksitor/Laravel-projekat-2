<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NaruciController;
use App\Http\Controllers\SirovinaController;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\ProizvodniProcesController;
use App\Http\Controllers\VrstaCokoladeController;
use App\Http\Controllers\NarudzbinaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProizvodPublicController;
use App\Models\Proizvod;

// ------------------- JAVNE RUTE -------------------

// Početna stranica sa listom proizvoda
Route::get('/', function () {
    // Dohvati sve proizvode sa statusom 'active'
    $proizvodi = Proizvod::where('status', 'active')->get();
    return view('welcome', compact('proizvodi'));
});

// Detaljan prikaz proizvoda (javna ruta)
Route::get('/proizvodi/{id}', [ProizvodPublicController::class, 'show'])->name('proizvodi.show');

// USE CASE 1: Naručivanje proizvoda
Route::get('/naruci', [NaruciController::class, 'create'])->name('naruci.create');
Route::post('/naruci', [NaruciController::class, 'store'])->name('naruci.store');

// USE CASE 2: Stanje sirovina (public)
Route::get('/sirovine/stanje', [SirovinaController::class, 'indexPublic'])->name('sirovine.stanje');

// USE CASE 3: Detalji proizvodne serije
Route::get('/proizvodni-procesi/{proizvodni_proce}', [ProizvodniProcesController::class, 'show'])
    ->name('proizvodni-procesi.show');

// USE CASE 4: Lista proizvodnih serija (public)
Route::get('/proizvodni-procesi', [ProizvodniProcesController::class, 'indexPublic'])
    ->name('proizvodni-procesi.index');

// ------------------- AUTH RUTE -------------------

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------- ADMIN PANEL RUTE -------------------

// Admin rute (sve CRUD akcije) - SAMO za admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Admin početna strana
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');
    
    // Admin CRUD rute
    Route::resource('proizvodi', ProizvodController::class);
    Route::resource('sirovine', SirovinaController::class);
    Route::resource('proizvodni-procesi', ProizvodniProcesController::class);
    Route::resource('vrste-cokolade', VrstaCokoladeController::class);
    Route::resource('narudzbine', NarudzbinaController::class);
});
