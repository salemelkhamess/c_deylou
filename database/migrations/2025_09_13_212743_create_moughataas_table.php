<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moughataas', function (Blueprint $table) {
            $table->id();
            $table->string('nom_fr');
            $table->string('nom_ar');
            $table->string('nom_en');
            $table->string('code')->unique();
            $table->foreignId('wilaya_id')->constrained()->onDelete('cascade');
            $table->integer('population')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moughataas');
    }
};
