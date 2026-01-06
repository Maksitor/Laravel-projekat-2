<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('narudzbinas', function (Blueprint $table) {
            $table->id();
            $table->string('broj_narudzbine', 50)->unique();
            $table->string('ime_kupca', 100);
            $table->string('email', 100);
            $table->text('adresa');
            $table->string('telefon', 20);
            $table->unsignedBigInteger('proizvod_id'); // NOVO: FK ka proizvods
            $table->integer('kolicina')->default(1);   // NOVO: kolicina proizvoda
            $table->text('napomena')->nullable();      // NOVO: napomena
            $table->decimal('ukupna_cena', 10, 2)->default(0.00);
            $table->enum('status', ["kreirana","potvrdjena","u_obradi","poslata","dostavljena"])
                  ->default('kreirana');
            $table->timestamps();

            $table->foreign('proizvod_id')->references('id')->on('proizvods')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('narudzbinas');
    }
};
