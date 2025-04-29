<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->string('nom_ar')->after('nom');
            $table->text('description_ar')->nullable();
            $table->text('adresse_ar')->nullable();
            $table->string('logo')->nullable();

        });
    }

    public function down()
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->dropColumn(['nom_ar', 'description_ar', 'adresse_ar']);
        });
    }
};
