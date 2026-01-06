<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('narudzbine', function (Blueprint $table) {
            if (!Schema::hasColumn('narudzbine', 'proizvod_id')) {
                $table->unsignedBigInteger('proizvod_id')->after('telefon');
            }
            if (!Schema::hasColumn('narudzbine', 'kolicina')) {
                $table->integer('kolicina')->default(1)->after('proizvod_id');
            }
            if (!Schema::hasColumn('narudzbine', 'napomena')) {
                $table->text('napomena')->nullable()->after('adresa');
            }

            $table->foreign('proizvod_id')->references('id')->on('proizvods')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('narudzbine', function (Blueprint $table) {
            $table->dropForeign(['proizvod_id']);
            $table->dropColumn(['proizvod_id', 'kolicina', 'napomena']);
        });
    }
};
