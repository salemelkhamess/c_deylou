<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->string('nom_en')->nullable();
            $table->text('description_en')->nullable();
            $table->string('adresse_en')->nullable();
        });
    }

    public function down()
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->dropColumn('nom_en');
            $table->dropColumn('description_en');
            $table->dropColumn('adresse_en');
        });
    }
};
