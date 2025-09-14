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

        Schema::create('wilayas', function (Blueprint $table) {
            $table->id();
            $table->string('nom_ar'); // Nom en arabe
            $table->string('nom_fr'); // Nom en français
            $table->string('code')->unique(); // Code unique
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayas');
    }
};
